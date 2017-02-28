<?php

namespace App\Http\Controllers;

use Request,Session;
use App\Model\SellShopModel as SellShop;

class AdminSellShopController extends Controller
{
    public function index()
    {
        $title="销售商铺列表";
        $nav='2-1';
        $key=Request::input('key','');
        $shop_list = SellShop::getAll($key);

        $searchitem = [];
        if($key) $searchitem['key'] = $key;

        return view('Admin.SellShop.index',compact('title','nav','shop_list','key','searchitem'));
    }

    public function create()
    {
        $title="新增销售店铺（net bar）";
        $nav='2-1';
        return view('Admin.SellShop.add',compact('title','nav'));
    }

    public function store()
    {
        $data = Request::all();
        unset($data['type']);
        unset($data['_token']);
        unset($data['time_limit']);

        $res = SellShop::updateShop($data);
        if($res){
            echo self::json_return(0,'新增成功');
        }
        else
            echo self::json_return(10003,'新增失败');
    }

    public function edit($id)
    {
        $title="修改销售店铺（net bar）";
        $nav='2-1';
        $shop_list = SellShop::getOne($id);
        return view('Admin.SellShop.edit',compact('title','nav','shop_list'));
    }

    public function update()
    {
        $data = Request::all();
        unset($data['type']);
        unset($data['_token']);
        if($data['time_limit']==0){
            $data['start_time']=0;
            $data['end_time']=0;
        }
        unset($data['time_limit']);

        $res = SellShop::updateShop($data);
        if($res){
            echo self::json_return(0,'修改成功');
        }
        else
            echo self::json_return(10003,'修改失败');
    }
}
