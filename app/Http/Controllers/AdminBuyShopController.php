<?php

namespace App\Http\Controllers;

use Request;
use App\Model\BuyShopModel as BuyShop;

class AdminBuyShopController extends Controller
{
    public function index()
    {
        $title="购买商铺列表";
        $nav='2-2';
        $key=Request::input('key','');
        $shop_list = BuyShop::getAll($key);

        $searchitem = [];
        if($key) $searchitem['key'] = $key;

        return view('Admin.BuyShop.index',compact('title','nav','shop_list','key','searchitem'));
    }

    public function create()
    {
        $title="新增购买店铺";
        $nav='2-2';
        return view('Admin.BuyShop.add',compact('title','nav'));
    }

    public function store()
    {
        $data = Request::all();
        unset($data['type']);
        unset($data['_token']);
        unset($data['time_limit']);

        $res = BuyShop::updateShop($data);
        if($res){
            echo self::json_return(0,'新增成功');
        }
        else
            echo self::json_return(10003,'新增失败');
    }

    public function edit($id)
    {
        $title="修改购买店铺";
        $nav='2-1';
        $shop_list = BuyShop::getOne($id);
        return view('Admin.BuyShop.edit',compact('title','nav','shop_list'));
    }

    public function update($id)
    {
        $data = Request::all();
        unset($data['type']);
        unset($data['_token']);
        if($data['time_limit']==0){
            $data['start_time']='';
            $data['end_time']='';
        }
        unset($data['time_limit']);

        $res = BuyShop::updateShop($data,$id);
        if($res){
            echo self::json_return(0,'修改成功');
        }
        else
            echo self::json_return(10003,'修改失败');
    }
}
