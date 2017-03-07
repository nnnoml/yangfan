<?php

namespace App\Http\Controllers;

use Request;
use App\Model\CashFlowModel as CashFlow;

class AdminCashFlowController extends Controller
{
    public function index()
    {
        $title='分账流水';
        $nav='';
        $key=Request::input('key','');
        $data = CashFlow::getAll($key);

        $searchitem = [];
        if($key) $searchitem['key'] = $key;

        return view('Admin.CashFlow.index',compact('title','nav','data','key','searchitem'));
    }
}
