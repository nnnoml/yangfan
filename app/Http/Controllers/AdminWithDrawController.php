<?php

namespace App\Http\Controllers;

use Request;
use App\Model\WithdrawModel as Withdraw;

class AdminWithdrawController extends Controller
{
    public function index()
    {
        $title = '提现日志';
        $nav = '';
        $key = Request::input('key', '');
        $data = Withdraw::getAll($key);

        $searchitem = [];
        if ($key) $searchitem['key'] = $key;

        return view('Admin.Withdraw.index', compact('title', 'nav', 'data', 'key', 'searchitem'));
    }

    public function update($id)
    {
        $flag = Request::input('flag');
        if ($flag == 'check')
            $return = Withdraw::withdrawDo($id, 1);
        else if ($flag == 'pass')
            $return = Withdraw::withdrawDo($id, 2);
        else if ($flag == 'reset')
            $return = Withdraw::withdrawDo($id, 0);
        echo  $return;
    }
}
