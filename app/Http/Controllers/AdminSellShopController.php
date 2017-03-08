<?php

namespace App\Http\Controllers;

use Request;
use App\Model\SellShopModel as SellShop;
use App\Model\UserModel as User;

class AdminSellShopController extends Controller
{
    public function index()
    {
        $title="娱乐场所列表";
        $nav='2-1';
        $key=Request::input('key','');
        $shop_list = SellShop::getAll($key);

        $searchitem = [];
        if($key) $searchitem['key'] = $key;

        return view('Admin.SellShop.index',compact('title','nav','shop_list','key','searchitem'));
    }

    public function create()
    {
        $title="新增娱乐场所";
        $nav='2-1';
        $shopkeeper = User::getShopkeeper();
        $shopkeeper_list='';
        foreach($shopkeeper as $vo){
            $shopkeeper_list .="<option value='{$vo->openid}'>{$vo->nick}({$vo->openid})</option>";
        }
        return view('Admin.SellShop.add',compact('title','nav','shopkeeper_list'));
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
        $title="修改娱乐场所";
        $nav='2-1';
        $shop_list = SellShop::find($id);
        $shopkeeper = User::getShopkeeper();
        $shopkeeper_list='';
        foreach($shopkeeper as $vo){
            if($vo->openid == $shop_list->	user_wechat) $flag ="selected";
            else $flag ="";
            $shopkeeper_list .="<option $flag value='{$vo->openid}'>{$vo->nick}({$vo->openid})</option>";
        }

        return view('Admin.SellShop.edit',compact('title','nav','shop_list','shopkeeper_list'));
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

        $res = SellShop::updateShop($data,$id);
        if($res){
            echo self::json_return(0,'修改成功');
        }
        else
            echo self::json_return(10003,'修改失败');
    }
}
