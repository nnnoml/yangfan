<?php

namespace App\Http\Controllers;

use Request,Session;
use App\Model\UserModel as User;
use App\Model\OrderModel as Order;
use App\Model\CashFlowModel as Cash;
use App\Model\WithdrawModel as WithDraw;

class AppUserController extends Controller
{
    public $user_info;
    public function __construct()
    {
        $this->user_info = User::find(Session::get('user_id'));
        if($this->user_info->status==0){
            header('Location:'.asset('/'));
            exit;
        }
    }

    public function index(){
        $title="个人订单";
        $user_order_list = Order::selectOrder(Session::get('user_id'));
        $user_status = Session::get('user_status');

        return view('App.user',compact('title','user_order_list','user_status'));
    }

    public function account(){
        $title="账户信息";
        $user_status = Session::get('user_status');
        $user_info = $this->user_info;

        return view('App.account',compact('title','user_info','user_status'));
    }

    public function accountDetail($flag){
        $title="账户明细";
        $user_status = Session::get('user_status');
        if($flag == 'cash')
            $detail = Cash::where('user_id',Session::get('user_id'))->orderby('created_at','desc')->get();
        else
            $detail = WithDraw::where('user_id',Session::get('user_id'))->orderby('created_at','desc')->get();

        return view('App.accountDetail',compact('title','detail','user_status','flag'));
    }
}
