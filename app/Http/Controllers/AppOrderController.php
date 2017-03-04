<?php

namespace App\Http\Controllers;
use Request,Session;
use App\Model\ShopRelationModel as Relation;
use App\Model\SellGoodModel as Good;
use App\Model\OrderModel as Order;

class AppOrderController extends Controller
{
    public function index()
    {
        header('Location:'.asset('/'));
        exit;
    }
    public function show($id){
        $qr = Request::input('qr','');
        if($qr=='') $this->index();
        $title= Relation::getDinnerTitle($qr);
        $data = Good::find($id);
        $title = $title->name."-下单";

        return view('App.order',compact('title','data','qr'));
    }

    public function store()
    {
        $data = Request::all();

        $goods_info = Good::find($data['id']);
        $relation_info = Relation::where('qr_id',$data['qr'])->first();

        $data['order_id']=uniqid().Session::get('user_id').mt_rand(1000,9999);
        $data['bs_id']=$relation_info->bs_id;
        $data['u_id']=Session::get('user_id');
        $data['g_id']=$data['id'];
        $data['ss_id']=$relation_info->ss_id;
        $data['relation_id']=$relation_info->id;
        $data['order_cash']=$goods_info->price*$data['order_num'];
        $data['order_single_price']=$goods_info->price;
        $data['status']=0;

        unset($data['id']);
        unset($data['qr']);
        unset($data['type']);
        unset($data['_token']);

        $res = Order::insertOrder($data);
        if($res){
            echo self::json_return(0,'成功');
        }
        else
            echo self::json_return(10003,'失败');
    }
}
