<?php

namespace App\Http\Controllers;

use App\Model\SellShopModel;
use Request,QrCode;;
use App\Model\ShopRelationModel as Relation;
use App\Model\SellShopModel as SellShop;
use App\Model\BuyShopModel as BuyShop;

class AdminRelationController extends Controller
{
    public function index()
    {
        $title='关系列表';
        $nav='2-3';
        $key=Request::input('key','');
        $data = Relation::getAll($key);

        foreach($data as $keys=>$vo){
            $data[$keys]->qrcode =  QrCode::format('png')->size(100)->generate(''.asset('/').$vo->id.'');
        }

        $searchitem = [];
        if($key) $searchitem['key'] = $key;

        return view('Admin.Relation.index',compact('title','nav','data','key','searchitem'));
    }

    public function create()
    {
        $title='新增对应关系';
        $nav='2-3';
        $sell_shop_list = SellShop::all();
        $sell_shop_option='';
        foreach($sell_shop_list as $vo){
            $sell_shop_option .= "<option value='{$vo->id}'/>{$vo->name}</option>";
        }
        $buy_shop_list = BuyShop::all();
        $buy_shop_option='';
        foreach($buy_shop_list as $vo){
            $buy_shop_option .= "<option value='{$vo->id}'/>{$vo->name}</option>";
        }

        return view('Admin.Relation.add',compact('title','nav','sell_shop_option','buy_shop_option'));

    }

    public function store()
    {
        $data = Request::all();
        unset($data['type']);
        unset($data['_token']);
        $res = Relation::updateRelation($data);
        if($res){
            echo self::json_return(0,'新增成功');
        }
        else
            echo self::json_return(10003,'新增失败');
    }

    public function edit($id)
    {
        $data = Relation::find($id);
        $title ="修改对应关系";
        $nav='2-3';

        $sell_shop_list = SellShop::all();
        $sell_shop_option='';
        foreach($sell_shop_list as $vo){
            if($vo->id == $data->ss_id) $flag ="selected";
            else $flag ="";
            $sell_shop_option .= "<option {$flag} value='{$vo->id}'/>{$vo->name}</option>";
        }
        $buy_shop_list = BuyShop::all();
        $buy_shop_option='';
        foreach($buy_shop_list as $vo){
            if($vo->id == $data->bs_id) $flag ="selected";
            else $flag ="";
            $buy_shop_option .= "<option {$flag} value='{$vo->id}'/>{$vo->name}</option>";
        }

        return view('Admin.Relation.edit',compact('title','nav','data','id','sell_shop_option','buy_shop_option'));
    }

    public function update($id)
    {
        $data = Request::all();

        unset($data['type']);
        unset($data['_token']);

        $res = Relation::updateRelation($data,$id);
        if($res){
            echo self::json_return(0,'修改成功');
        }
        else
            echo self::json_return(10003,'修改失败');
    }
}
