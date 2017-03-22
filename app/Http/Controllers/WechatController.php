<?php

namespace App\Http\Controllers;

use Request,Log;
use EasyWeChat\Message\Text;
use App\Model\OrderModel as Order;
use App\Model\ConfigModel as Config;

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
            else if ($message->MsgType == 'text'){
                $text = "";
            }

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

    //提现微信通知杨帆
    public function sendWithdrawNotice($openid,$user_info,$num){
        $wechat = app('wechat');
        $notice = $wechat->notice;
        $userId = $openid;
        $templateId = 'eQiilj-xPpGnaNXLscc9RZITKGPKlxE6YKyqgdoh_bI';
        //$url = 'http://overtrue.me';//->withUrl($url)
        $data = array(
            "first"  => "新的提现申请：",
            "keyword1"   => $user_info->id.' ('.$user_info->nick.')',//会员卡号
            "keyword2"  => ($num/100).'元', //提现金额
            "keyword3" => date('Y-m-d H:i:s'), //提现时间
            "keyword4" => (($user_info->account_cash-$num)/100).'元', //剩余金额
            "remark" => "请您及时到后台进行处理", //remark
        );
        $result = $notice->uses($templateId)->andData($data)->andReceiver($userId)->send();
    }

//    public function sendWithdrawNotice($openid,$user_info,$num){
//        $message = new Text(['content' => '新的提现申请：
//提现用户：'.$user_info->nick.'
//金额：'.($num/100).'元
//请您及时到后台进行处理']);
//        $wechat = app('wechat');
//        $result = $wechat->staff->message($message)->to($openid)->send();
//    }


//餐馆通知
    public function sendNoticeSeller($openid,$goods,$order,$seller,$buyer){
        //分账用户餐馆分成
        $seller_get_price = $goods->seller_precent*$order->order_num;

        $wechat = app('wechat');
        $notice = $wechat->notice;
        $userId = $openid;
        $templateId = '4FsgPHudiLwqqd8QJ1rhmob1WGq01SSdx3DJHoLWPTA';
        $url = 'http://nnnoml.com/yangfan/public/account';
        $data = array(
            "first"  => "您有新的订单啦：",
            "keyword1"  => $seller, //店铺名称
            "keyword2"   => $order->order_id,//编号
            "keyword3" => $goods->name.' 共'.$order->order_num.'份', //内容
            "keyword4" => ($seller_get_price/100).'元 (分成金额)', //订单金额
            "remark" => '配送地址：'.$buyer.'-'.$order->machine_num, //配送地址
        );
        $result = $notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($userId)->send();

//
//
//        //分账用户销售者分成
//        $seller_get_price = $goods->seller_precent*$order->order_num;
//
//        $message = new Text(['content' => '：
//商品名称：'.$goods->name.'
//份数：'.$order->order_num.'份
//分得：'.($seller_get_price/100).'元
//位置：'.$area.'_'.$order->machine_num.'
//下单时间：
//'.$order->created_at]);
//        $wechat = app('wechat');
//        $result = $wechat->staff->message($message)->to($openid)->send();
    }

//娱乐场所通知
    public function sendNoticeBuyer($openid,$goods,$order,$seller,$buyer){
        //分账用户娱乐场所分成
        $buyer_get_price = $goods->buyer_precent*$order->order_num;

        $wechat = app('wechat');
        $notice = $wechat->notice;
        $userId = $openid;
        $templateId = '4FsgPHudiLwqqd8QJ1rhmob1WGq01SSdx3DJHoLWPTA';
        $url = 'http://nnnoml.com/yangfan/public/account';
        $data = array(
            "first"  => "新的订单分成信息：",
            "keyword1"  => $seller, //店铺名称
            "keyword2"   => $order->order_id,//编号
            "keyword3" => $goods->name.' 共'.$order->order_num.'份', //内容
            "keyword4" => ($buyer_get_price/100).'元 (分成金额)', //订单金额
            "remark" => '配送地址：'.$buyer.'-'.$order->machine_num, //配送地址
        );
        $result = $notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($userId)->send();

//        $message = new Text(['content' => '您有一份新的订单：
//商品名称：'.$goods->name.'
//份数：'.$order->order_num.'份
//分得：'.($buyer_get_price/100).'元
//位置：'.$area.'_'.$order->machine_num.'
//下单时间：
//'.$order->created_at]);
//        $wechat = app('wechat');
//        $result = $wechat->staff->message($message)->to($openid)->send();
    }

    //用户下单微信通知
    public function customerNotice($openid,$goods,$order,$seller,$buyer){
        $wechat = app('wechat');
        $notice = $wechat->notice;
        $userId = $openid;
        $templateId = '4FsgPHudiLwqqd8QJ1rhmob1WGq01SSdx3DJHoLWPTA';
        $url = 'http://nnnoml.com/yangfan/public/user';
        $data = array(
            "first"  => "您的订单：",
            "keyword1"  => $seller, //店铺名称
            "keyword2"   => $order->order_id,//编号
            "keyword3" => $goods->name.' 共'.$order->order_num.'份', //内容
            "keyword4" => ($order->order_cash/100).'元', //订单金额
            "remark" => '配送地址：'.$buyer.'-'.$order->machine_num, //配送地址
        );
        $result = $notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($userId)->send();

//        $message = new Text(['content' => '您的订单：
//商品名称：'.$goods->name.'
//份数：'.$order->order_num.'份
//总价：'.($order->order_cash/100).'元
//位置：'.$area.'_'.$order->machine_num.'
//下单时间：
//'.$order->created_at.'
//请您稍等片刻，美味即刻送达']);
//        $wechat = app('wechat');
//        $result = $wechat->staff->message($message)->to($openid)->send();
    }

    //杨帆龟孙通知
    public function sendYangfan($goods,$order,$seller,$buyer){
        $site_config = Config::getConfig();

        $wechat = app('wechat');
        $notice = $wechat->notice;
        //杨帆这狗日的，openid写死在mysql配置里了，操。
        $userId = $site_config->withdraw_notice_openid;
        $templateId = '4FsgPHudiLwqqd8QJ1rhmob1WGq01SSdx3DJHoLWPTA';
        $data = array(
            "first"  => "新的订单：",
            "keyword1"  => $seller, //店铺名称
            "keyword2"   => $order->order_id,//编号
            "keyword3" => $goods->name.' 共'.$order->order_num.'份', //内容
            "keyword4" => ($order->order_cash/100).'元', //订单金额
            "remark" => '配送地址：'.$buyer.'-'.$order->machine_num, //配送地址
        );
        $result = $notice->uses($templateId)->andData($data)->andReceiver($userId)->send();
//        $message = new Text(['content' => '有订单：
//商品名称：'.$goods->name.'
//送餐餐馆：'.$seller_name.'
//份数：'.$order->order_num.'份
//总价：'.($order->order_cash/100).'元
//位置：'.$buyer_name.'_'.$order->machine_num.'
//下单时间：
//'.$order->created_at]);
//        $wechat = app('wechat');
//        $result = $wechat->staff->message($message)->to($openid)->send();
    }


}
