<?php

namespace App\Http\Controllers;

use Request,Session;
use App\Model\ShopRelationModel as Relation;

class AppController extends Controller
{
    public function __construct()
    {
        if(!Session::has('user_id')){
            header("Content-type: text/html; charset=utf-8");
            echo "<script>alert('请从微信进入本页面')</script>";
            exit;
        }
    }
    public function index(){
        $title='首页';
        $shop_list = Relation::getIndexList();
        Session::set('user_id',2);
        Session::save();
        return view('App.index',compact('title','shop_list'));
    }
}
