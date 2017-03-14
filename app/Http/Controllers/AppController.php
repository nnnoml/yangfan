<?php

namespace App\Http\Controllers;

use Request,Session;
use App\Model\UserModel as User;
use App\Model\ShopRelationModel as Relation;

class AppController extends Controller
{
    public function index(){

//        $title='首页';
//        $shop_list = Relation::getIndexList();
        $user_info = User::find(Session::get('user_id'));
        $user_status = $user_info->status;
//        Session::set('user_status',$user_status);
//        Session::save();
//
//        return view('App.index',compact('title','shop_list','user_status'));
        $notice = '';
        $title ='非常抱歉';
        return view('App.error',compact('notice','title','user_status'));
    }
}
