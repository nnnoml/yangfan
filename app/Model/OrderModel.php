<?php

namespace App\Model;

use App\Http\Controllers\WechatController;
use DB;
use Illuminate\Database\Eloquent\Model;
use App\Model\SellGoodModel as SellGood;
use App\Model\UserModel as User;
use App\Model\CashFlowModel as CashFlow;
class OrderModel extends Model
{
    protected $table = 'order';

    //后台获取订单列表
    public static function getAll($key='')
    {
        return self::leftJoin('buy_shops as bs','bs.id','=','order.bs_id')
                    ->leftJoin('sell_shops as ss','ss.id','=','order.ss_id')
                    ->leftJoin('sell_goods as sg','sg.id','=','order.g_id')
                    ->leftJoin('user as u','u.id','=','order.u_id')
            ->where(function($query) use($key){
                if($key){
                    $query->where('order.order_id','like','%'.$key.'%');
                    $query->Orwhere('u.nick','like','%'.$key.'%');
                }
            })
            ->select('order.*','bs.name as bs_name','ss.name as ss_name','sg.name as sg_name','u.nick')
            ->orderby('order.created_at','desc')
            ->paginate(15);
    }

    //前台生成预支付订单，不减库存
    public static function insertOrder($data){
        $order = new self;
        foreach($data as $key=>$vo){
            $order->$key = $vo;
        }
        return $order->save();
    }
    //查询用户三天内订单
    public static function selectOrder($u_id){
        return self::leftJoin('buy_shops as bs','bs.id','=','order.bs_id')
                    ->leftJoin('sell_goods as sg','sg.id','=','order.g_id')
                    ->where('order.u_id',$u_id)
                    ->where('order.created_at','>',date('Y-m-d H:i:s',strtotime("-3 day")))
                    ->select('order.*','bs.name as bs_name','sg.name as g_name','sg.price')
                    ->orderby('order.created_at','desc')
                    ->get();
    }


    public static function OrderCallBack($order_id){

        $order_info = self::where('order_id',$order_id)->first();
        $goods_info = SellGood::find($order_info['g_id']);

        $buy_user_info = User::find($order_info->u_id);

        $account_buyer = self::leftJoin('buy_shops as bs','bs.id','=','order.bs_id')
                                ->leftJoin('user as u','u.openid','=','bs.user_wechat')
                                ->select('u.id','u.nick','u.openid','bs.name')
                                ->where('order.order_id',$order_id)
                                ->first();

        $account_buyer_info = User::find($account_buyer->id);

        $account_seller = self::leftJoin('sell_shops as ss','ss.id','=','order.ss_id')
                                ->leftJoin('user as u','u.openid','=','ss.user_wechat')
                                ->select('u.id','u.nick','u.openid','ss.name')
                                ->where('order.order_id',$order_id)
                                ->first();
        $account_seller_info = User::find($account_seller->id);


        DB::beginTransaction();
        //如果限制了库存，那么先减库存
            if($goods_info->max_num!=-1)
                $rs1 = SellGood::where('id',$order_info['g_id'])->where('max_num','>=',$order_info['order_num'])->decrement('max_num',$order_info['order_num']);
            else
                $rs1 = 1;

        //修改订单表状态 乐观锁
            $rs2 = self::where(['order_id'=>$order_id,'status'=>0])->update(['status' => 1]);

        //购买用户做统计
            $buy_user_info->reserve_num +=1;
            $buy_user_info->reserve_price +=$order_info->order_cash;
            $rs3 = $buy_user_info->save();

        //分账用户购买者分成
            $buyer_get_price = $goods_info->buyer_precent*$order_info->order_num;
            $account_buyer_info->account_num += 1;
            $account_buyer_info->account_sum += $buyer_get_price;
            $account_buyer_info->account_cash += $buyer_get_price;
            $rs4 = $account_buyer_info->save();
        //分账用户购买者 写订单流水表
            $rs5 = CashFlow::newFlow($order_id,$account_buyer->id,$buyer_get_price);

        //分账用户销售者分成
            $seller_get_price = $goods_info->seller_precent*$order_info->order_num;
            $account_seller_info->account_num += 1;
            $account_seller_info->account_sum += $seller_get_price;
            $account_seller_info->account_cash += $seller_get_price;
            $rs6 = $account_seller_info->save();
        //分账用户销售者 写订单流水表
            $rs7 = CashFlow::newFlow($order_id,$account_seller->id,$seller_get_price);

        if($rs1 && $rs2 && $rs3 && $rs4 && $rs5 && $rs6 && $rs7){
                DB::commit();
                //发起微信通知
                $wechat = new WechatController();
                //通知餐馆和网吧
                $wechat->sendNoticeSeller($account_seller->openid,$goods_info,$order_info,$account_seller->name,$account_buyer->name);
                $wechat->sendNoticeBuyer($account_buyer->openid,$goods_info,$order_info,$account_seller->name,$account_buyer->name);
                //通知杨帆
                $wechat->sendYangfan($goods_info,$order_info,$account_seller->name,$account_buyer->name);
                //通知用户
                $wechat->customerNotice($buy_user_info->openid,$goods_info,$order_info,$account_seller->name,$account_buyer->name);

                return true;
        }
        else {
            DB::rollback();
            return false;
        }
    }

    //额外要做个提现
}
