<?php

namespace App\Http\Controllers;

use Request,Log;
use EasyWeChat\Message\Text;
class WechatController extends Controller
{
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function($message){
            if ($message->MsgType == 'event') {
                switch ($message->Event) {
                    case 'subscribe':
                        $text = "欢迎关注～！<a href='http://nnnoml.com/yangfan/public'>点击订餐</a>";
                }

            }
            else if ($message->MsgType == 'text'){
                $text = "<a href='http://nnnoml.com/yangfan/public'>点击订餐</a>";
            }
            return $text;
        });

        Log::info('return response.');

        return $wechat->server->serve();
    }

    public function wechatCallBack(){
        $wechat = app('wechat');
        $response = $wechat->payment->handleNotify(function($notify, $successful){
            // 你的逻辑
            return true; // 或者错误消息
        });
        return $response;
    }


    public function sendNotice($openid,$goods,$order,$area){
        $message = new Text(['content' => '您有一份新的订单：
商品名称：'.$goods->name.'
份数：'.$order->order_num.'份
总价：'.$order->order_cash.'元
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
总价：'.$order->order_cash.'元
位置：'.$area.'_'.$order->machine_num.'
下单时间：
'.$order->created_at.'
请您稍等片刻，美味即刻送达']);
        $wechat = app('wechat');
        $result = $wechat->staff->message($message)->to($openid)->send();
    }


}
