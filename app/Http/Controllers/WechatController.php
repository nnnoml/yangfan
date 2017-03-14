<?php

namespace App\Http\Controllers;

use Request,Log;
use EasyWeChat\Message\Text;
use App\Model\OrderModel as Order;
class WechatController extends Controller
{
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
//        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function($message){

            if ($message->MsgType == 'event') {
                switch ($message->Event) {
                    case 'subscribe':
                        //<a href='http://nnnoml.com/yangfan/public'>点击订餐</a>
                        $text = "欢迎关注～请您直接扫描桌面上的二维码进行下单，我们会第一时间给您送达！";
                    case 'CLICK':
                        if($message->EventKey=='zsjm')
                            $text = "请联系微信：Fashionyf
或致电：13096952812";

                }

            }
//            else if ($message->MsgType == 'text'){
//                $text = "<a href='http://nnnoml.com/yangfan/public'>点击订餐</a>";
//            }

            return $text;
        });

//        Log::info('return response.');

        return $wechat->server->serve();
    }

    public function wechatCallBack(Request $request){
//        Order::OrderCallBack('58c125274089514624');
//        exit;
        $wechat = app('wechat');

        $response = $wechat->payment->handleNotify(function($notify, $successful){

            $order = Order::where('order_id',$notify->out_trade_no)->first();
            if (!$order) {
                return 'Order not exist.';
            }
            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($order->status) {
                return true; // 已经支付成功了就不再更新了
            }
            //支付成功回调，并且没有被执行过的订单
            if ($successful) {
                return Order::OrderCallBack($notify->out_trade_no);
            }
        });
        return $response;
    }

    public function sendWithdrawNotice($openid,$user_info,$num){
        $message = new Text(['content' => '新的提现申请：
提现用户：'.$user_info->nick.'
金额：'.($num/100).'元
请您及时到后台进行处理']);
        $wechat = app('wechat');
        $result = $wechat->staff->message($message)->to($openid)->send();
    }


    public function sendNoticeSeller($openid,$goods,$order,$area){
        //分账用户销售者分成
        $seller_get_price = $goods->seller_precent*$order->order_num;

        $message = new Text(['content' => '您有一份新的订单：
商品名称：'.$goods->name.'
份数：'.$order->order_num.'份
分得：'.($seller_get_price/100).'元
位置：'.$area.'_'.$order->machine_num.'
下单时间：
'.$order->created_at]);
        $wechat = app('wechat');
        $result = $wechat->staff->message($message)->to($openid)->send();
    }

    public function sendNoticeBuyer($openid,$goods,$order,$area){
        //分账用户购买者分成
        $buyer_get_price = $goods->buyer_precent*$order->order_num;
        $message = new Text(['content' => '您有一份新的订单：
商品名称：'.$goods->name.'
份数：'.$order->order_num.'份
分得：'.($buyer_get_price/100).'元
位置：'.$area.'_'.$order->machine_num.'
下单时间：
'.$order->created_at]);
        $wechat = app('wechat');
        $result = $wechat->staff->message($message)->to($openid)->send();
    }

    public function customerNotice($openid,$goods,$order,$area){
        $message = new Text(['content' => '您的订单：
商品名称：'.$goods->name.'
份数：'.$order->order_num.'份
总价：'.($order->order_cash/100).'元
位置：'.$area.'_'.$order->machine_num.'
下单时间：
'.$order->created_at.'
请您稍等片刻，美味即刻送达']);
        $wechat = app('wechat');
        $result = $wechat->staff->message($message)->to($openid)->send();
    }

    public function sendYangfan($goods,$order,$area){
        $openid = 'oSU0W1ey68ur7bUzsnQjMySOgZ1Y';
        $message = new Text(['content' => '有订单：
商品名称：'.$goods->name.'
份数：'.$order->order_num.'份
总价：'.($order->order_cash/100).'元
位置：'.$area.'_'.$order->machine_num.'
下单时间：
'.$order->created_at]);
        $wechat = app('wechat');
        $result = $wechat->staff->message($message)->to($openid)->send();
    }


}
