<?php

namespace App\Http\Controllers;

use Request,Session;
use App\Model\UserModel as User;
use App\Model\ShopRelationModel as Relation;

class AppDinnerController extends Controller
{
    public function index()
    {
        header('Location:'.asset('/'));
        exit;
    }
    public function show($qr_id)
    {

        $info= Relation::getDinnerInfo($qr_id);

        $user_info = User::find(Session::get('user_id'));
        $user_status = $user_info->status;
        Session::set('user_status',$user_status);
        Session::save();

        if(date('H:i:s') < $info->start_time || date('H:i:s') > $info->end_time){
            $title="非常抱歉";
            $notice="开始时间：".$info->start_time."  结束时间：".$info->end_time;
            return view('App.error',compact('notice','title','user_status'));
        }
        else if($info->status){
            $title = $info->name."-预定";
            $dinner_list = Relation::getDinnerList($qr_id);

            $user_info = User::find(Session::get('user_id'));
            $user_status = $user_info->status;
            Session::set('user_status',$user_status);
            Session::save();

            return view('App.dinner',compact('title','dinner_list','qr_id','user_status'));
        }
        else{
            $title="非常抱歉";
            $notice="";
            return view('App.error',compact('notice','title','user_status'));
            // echo "<script>alert('抱歉 该店铺目前打烊了');window.location.href='".asset('/')."'</script>";
        }
    }
}
