<?php

namespace App\Http\Controllers;

use Request,Session;
use App\Model\AdminModel as Admin;

class AdminAuthController extends Controller
{
    //管理员修改个人信息
    public function index(){
        $title = "修改个人资料";
        $nav = '';
        $user_name = Session::get('admin');
        return view('Admin.Auth.index',compact('title','user_name','nav'));
    }

    public function store(){
        $salt = uniqid();
        $new_pwd = md5($salt.Request::input('pwd'));
        $res = Admin::changePwd(Session::get('admin'),$salt,$new_pwd);
        if($res){
            Session::forget('admin');
            echo self::json_return(0,'修改成功');
        }
        else
            echo self::json_return(10003,'修改失败');
    }
}
