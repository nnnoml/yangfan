<?php

namespace App\Http\Controllers;

use Request;
use App\Model\WithdrawModel as Withdraw;

class AdminWithdrawController extends Controller
{
    public function index()
    {
        $title='提现日志';
        $nav='';
        $key=Request::input('key','');
        $data = Withdraw::getAll($key);

        $searchitem = [];
        if($key) $searchitem['key'] = $key;

        return view('Admin.Withdraw.index',compact('title','nav','data','key','searchitem'));
    }
}
