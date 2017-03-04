<?php

namespace App\Http\Controllers;

use Request,Session;
use App\Model\OrderModel as Order;

class AppUserController extends Controller
{
    public function index(){
        $title="个人订单";
        $user_order_list = Order::selectOrder(Session::get('user_id'));

        return view('App.user',compact('title','user_order_list'));
    }
}
