<?php

namespace App\Http\Controllers;

use Request,Session;
use App\Model\UserModel as User;
use App\Model\OrderModel as Order;
use App\Model\CashFlowModel as Cash;
use App\Model\WithdrawModel as Withdraw;
use App\Http\Controllers\WechatController;
use App\Model\ConfigModel as Config;

class AppUserController extends Controller
{
    public $user_info;
    public function __construct()
    {
        $user_info = User::find(Session::get('user_id'));
        $user_status = $user_info->status;
        Session::set('user_status',$user_status);
        Session::save();
        $this->user_info = $user_info;
    }

    public function index(){
        $title="个人订单";
        $user_order_list = Order::selectOrder(Session::get('user_id'));
        $user_status = Session::get('user_status');

        return view('App.user',compact('title','user_order_list','user_status'));
    }

    public function account(){
        if($this->user_info->status==0){
            header('Location:'.asset('/'));
            exit;
        }

        $title="账户信息";
        $user_status = Session::get('user_status');
        $user_info = $this->user_info;

        return view('App.account',compact('title','user_info','user_status'));
    }

    public function accountDetail($flag){
        if($this->user_info->status==0){
            header('Location:'.asset('/'));
            exit;
        }

        $title="账户明细";
        $user_status = Session::get('user_status');
        if($flag == 'cash')
            $detail = Cash::where('user_id',Session::get('user_id'))->orderby('created_at','desc')->get();
        else
            $detail = WithDraw::where('user_id',Session::get('user_id'))->orderby('created_at','desc')->get();

        return view('App.accountDetail',compact('title','detail','user_status','flag'));
    }

    public function withdraw(){
        if($this->user_info->status==0){
            header('Location:'.asset('/'));
            exit;
        }
        $title="申请提现";
        $user_status = Session::get('user_status');

        $user_info = $this->user_info;

        return view('App.withdraw',compact('title','user_status','user_info'));

    }

    public function withdrawDo(){

        $num = Request::input('num',0);
        $num = $num*100;
        $has_info = Withdraw::where(['user_id'=>Session::get('user_id'),'status'=>0])->first();
        if($has_info){
            echo self::json_return(10025,'您有未审核的提现申请，请等待审核');
            exit;
        }
        $rs = Withdraw::newWithdraw(Session::get('user_id'),$num);
        if($rs){
            $wechat = new WechatController();
            $user_info = $this->user_info;
            $site_config = Config::getConfig();
            $wechat->sendWithdrawNotice($site_config->withdraw_notice_openid,$user_info,$num);

            echo self::json_return(0,'成功');
            exit;
        }
        else{
            echo self::json_return(10011,'提交失败，请重试');
            exit;
        }
    }
}
