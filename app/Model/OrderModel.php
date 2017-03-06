<?php

namespace App\Model;

use DB;
use Illuminate\Database\Eloquent\Model;
use App\Model\SellGoodModel as SellGood;
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

    //处理 减库存，写日志

    //支付成功回调后修改状态 微信通知发货 分账
    public static function WechatCallBack($data){
        $check_qty = SellGood::find($data['g_id']);
        if($check_qty->max_num!=-1)
            SellGood::where('id',$data['g_id'])->where('max_num','>=',$data['order_num'])->decrement('max_num',$data['order_num']);
        DB::beginTransaction();
        DB::commit();
        DB::rollback();
    }
}
