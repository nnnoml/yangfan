<?php

namespace App\Http\Controllers;

use Request;
use App\Model\BuyShopModel as BuyShop;
use App\Model\UserModel as User;
class AdminBuyShopController extends Controller
{
    public function index()
    {
        $title="餐馆列表";
        $nav='2-2';
        $key=Request::input('key','');
        $shop_list = BuyShop::getAll($key);

        $searchitem = [];
        if($key) $searchitem['key'] = $key;

        return view('Admin.BuyShop.index',compact('title','nav','shop_list','key','searchitem'));
    }

    public function create()
    {
        $title="新增餐馆";
        $nav='2-2';
        $shopkeeper = User::getShopkeeper();
        $shopkeeper_list='';
        foreach($shopkeeper as $vo){
            $shopkeeper_list .="<option value='{$vo->openid}'>{$vo->nick}({$vo->openid})</option>";
        }
        return view('Admin.BuyShop.add',compact('title','nav','shopkeeper_list'));
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
        $title="修改餐馆";
        $nav='2-1';
        $shop_list = BuyShop::getOne($id);

        $shopkeeper = User::getShopkeeper();
        $shopkeeper_list='';
        foreach($shopkeeper as $vo){
            if($vo->openid == $shop_list->	user_wechat) $flag ="selected";
            else $flag ="";
            $shopkeeper_list .="<option $flag value='{$vo->openid}'>{$vo->nick}({$vo->openid})</option>";
        }

        return view('Admin.BuyShop.edit',compact('title','nav','shop_list','shopkeeper_list'));
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
