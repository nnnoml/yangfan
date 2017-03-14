<?php

namespace App\Http\Controllers;

use Request,Storage;
use App\Model\SellGoodModel as SellGood;
use App\Model\SellShopModel as SellShop;

class AdminSellGoodController extends Controller
{
    public function show($id)
    {
        $key=Request::input('key','');
        //找到商品列表
        $goods_list = SellGood::getAll($id,$key);

        $title = SellShop::find($id);
        $title = $title->name."-商品列表";

        $nav = '2-1';

        $searchitem = [];
        if($key) $searchitem['key'] = $key;

        return view('Admin.SellGood.index',compact('title','nav','key','searchitem','id','goods_list'));
    }

    public function create()
    {
        $id=Request::input('id',0);
        $title = SellShop::find($id);
        $title = $title->name."-新增关系";
        $nav = '2-1';

        return view('Admin.SellGood.add',compact('title','nav','id'));
    }

    public function store()
    {
        $data = Request::all();
        $data['s_id'] = Request::input('id',0);
        $data['price'] = intval(abs($data['price'])*100);
        $data['seller_precent'] = intval(abs($data['seller_precent'])*100);
        $data['buyer_precent'] = intval(abs($data['buyer_precent'])*100);
        unset($data['id']);
        unset($data['type']);
        unset($data['_token']);
        unset($data['time_limit']);

        $res = SellGood::updateGood($data);
        if($res){
            echo self::json_return(0,'新增成功');
        }
        else
            echo self::json_return(10003,'新增失败');
    }

    public function edit($id)
    {
        $data = SellGood::find($id);
        $title = $data->name."-修改";
        $nav='2-1';
        return view('Admin.SellGood.edit',compact('title','nav','data','id'));
    }

    public function update($id)
    {
        $data = Request::all();
        $data['price'] = intval(abs($data['price'])*100);
        $data['seller_precent'] = intval(abs($data['seller_precent'])*100);
        $data['buyer_precent'] = intval(abs($data['buyer_precent'])*100);
        unset($data['type']);
        unset($data['_token']);
        if($data['time_limit']==0){
            $data['start_time']='';
            $data['end_time']='';
        }
        unset($data['time_limit']);

        $res = SellGood::updateGood($data,$id);
        if($res){
            echo self::json_return(0,'修改成功');
        }
        else
            echo self::json_return(10003,'修改失败');
    }

    public function uploadImg(){

        $file = Request::file('file');
        if ($file->isValid()) {

            // 获取文件相关信息
            $originalName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $type = $file->getClientMimeType();     // image/jpeg

            // 上传文件
            $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
            // 使用我们新建的uploads本地存储空间（目录）
            Storage::disk('uploads')->put($filename, file_get_contents($realPath));

        }

        echo json_encode(array(
            'name'  => 'uploads/'.date('Y').'/'.date('m').'_'.date('d').'/'.$filename
        ));
    }
}
