<?php

namespace App\Http\Controllers;

use Request,Log,Wechat,Session;

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
                        $text = "欢迎关注～！";
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
}
