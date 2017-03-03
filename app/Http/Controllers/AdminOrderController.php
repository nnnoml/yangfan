<?php

namespace App\Http\Controllers;

use Request;
use App\Model\OrderModel as Order;

class AdminOrderController extends Controller
{
    public function index()
    {
        $title='订单列表';
        $nav='';
        $key=Request::input('key','');
        $data = Order::getAll($key);

        $searchitem = [];
        if($key) $searchitem['key'] = $key;

        return view('Admin.Order.index',compact('title','nav','data','key','searchitem'));
    }
}
