<?php

namespace App\Http\Controllers;
use Request,Session;
use App\Model\ShopRelationModel as Relation;
use App\Model\SellGoodModel as Good;
use App\Model\OrderModel as OrderModel;
use EasyWeChat\Payment\Order;
use App\Model\UserModel as User;

class AppOrderController extends Controller
{
    public function index()
    {
        header('Location:'.asset('/'));
        exit;
    }


    public function show($id){
        $qr = Request::input('qr','');
        if($qr=='') $this->index();
        $title= Relation::getDinnerTitle($qr);
        $data = Good::find($id);
        $title = $title->name."-下单";

        $user_status = Session::get('user_status');

        return view('App.order',compact('title','data','qr','user_status'));
    }

    public function store()
    {
        $data = Request::all();

        $goods_info = Good::find($data['id']);

        if($goods_info->max_num!=-1 && $goods_info->max_num<$data['order_num']){
            echo self::json_return(10011,'失败');
            exit;
        }

        $relation_info = Relation::where('qr_id',$data['qr'])->first();

        $data['order_id']=uniqid().Session::get('user_id').mt_rand(1000,9999);
        $data['bs_id']=$relation_info->bs_id;
        $data['u_id']=Session::get('user_id');
        $data['g_id']=$data['id'];
        $data['ss_id']=$relation_info->ss_id;
        $data['relation_id']=$relation_info->id;
        $data['order_cash']=$goods_info->price*$data['order_num'];
        $data['order_single_price']=$goods_info->price;
        $data['status']=0;

        unset($data['id']);
        unset($data['qr']);
        unset($data['type']);
        unset($data['_token']);

        $res = OrderModel::insertOrder($data);
        if($res){

            //起支付
            $user_info = User::find(Session::get('user_id'));
            $wechat = app('wechat');
            $payment = $wechat->payment;
            $attributes = [
                'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
                'body'             => $goods_info->name,
                'detail'           => $goods_info->name." ".$data['order_num']."份 共".$data['order_cash']."元",
                'out_trade_no'     => $data['order_id'],
                'total_fee'        => $data['order_cash'],
                'notify_url'       => asset('/')."wechatCallBack", // 支付结果通知网址，如果不设置则会使用配置里的默认地址
                'openid'           => $user_info->openid, // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
                // ...
            ];

            $order = new Order($attributes);
            $result = $payment->prepare($order);

            if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS')
            {
                $prepayId = $result->prepay_id;
                $json = $payment->configForPayment($prepayId);
                echo $json;
            }
            else  echo 0;
        }
        else
            echo 0;

    }
}
