<?php
namespace App\Http\Controllers;

use Wechat,Log;

class WechatController extends Controller
{
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function($message){
            if ($message->MsgType == 'event') {
                switch ($message->Event) {
                    case 'subscribe':
                        $text = "纯真的少女哟，你以为来到了这里就结束了么？然而世事难料，你的老公就是这么贱，哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈，来吧少女，猜猜看吧，第二条线索是什么? 多夸我几句说不定我就告诉你了哟";
                }
                return $text;
            }

            else if ($message->MsgType == 'text'){
                if($message->Content=="21") $text = "思路对了哟，可是并没有这么简单呢";
                else if(strpos($message->Content,'老公')!==false) $text = "叫老公不好使呢";
                else if(strpos($message->Content,'帅')!==false) $text = "那都不是事儿 ,快试试 \"耍赖皮0\"";
                else if(strpos($message->Content,'亲丁丁')!==false) $text = "快输入想亲几口";
                else if(strpos($message->Content,'丁丁')!==false) $text = "叫丁丁也也不够哟";
                else if(strpos($message->Content,'刘诗韵')!==false || strpos($message->Content,'诗韵')!==false || strpos($message->Content,'嘟嘟')!==false) $text = "既然你叫闺女了，快试试 \"耍赖皮1\"";
                else if(strpos($message->Content,'我也爱你哟么么哒')!==false) $text = "好吧好吧，给你个提示，关键词是英文";
                else if(strpos($message->Content,'爱你')!==false) $text = "\"我也爱你哟么么哒\"";
                else if(strpos($message->Content,'耍赖皮0')!==false) $text = "好吧好吧，给你个提示，关键词是数字";
                else if(strpos($message->Content,'耍赖皮1')!==false) $text = "好吧好吧，给你个提示，关键词是日期";
                else if(strpos($message->Content,'耍赖皮2')!==false) $text = "哼还想继续作弊么";


                else if(stripos($message->Content,'twenty one')!==false) $text = '啊咧，这都被你猜到了，没办法，那你就赶紧去下一关吧 http://suo.im/28KjuK';
                else if(time()%7==0) $text = '嗯~让我想想，不对哦';
                else if(time()%7==1) $text = '别闹了快猜！多夸我几句';
                else if(time()%7==2) $text = '再想想看 和上一条线索有关哦:-D';
                else if(time()%7==3) $text = '亲爱的，还是不对哦';
                else if(time()%7==4) $text = '我最近在学英语 啦啦啦';
                else if(time()%7==5) $text = '其实可简单了呢，转换个思路，提示已经很足了哦~';
                else if(time()%7==6) $text = "（掀桌子）
 （╯' - ')╯︵ ┻━┻
 {摆好摆好）
 ┬─┬ ノ( ' - 'ノ)
 (再掀一次）
 (╯°Д°)╯︵ ┻━┻
 不对不对不对!";
                Log::info("input:".$message->Content);
                Log::info("answer:".$text);
                return $text;
            }

        });
        return $wechat->server->serve();
    }
}
