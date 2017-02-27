<?php

namespace App\Http\Controllers;

use Request,Session;
use App\Http\Requests;
use App\Model\AdminLoginModel as Login;

class AdminLoginController extends Controller
{
    public function login(){
    	return view('login');
    }

    public function loginCheck(){
    	$name = Request::input('user_name');
        $pwd = Request::input('user_password');

        $user_info = Login::getUser($name);
        if(isset($user_info)){
        	$md5_pwd = md5($user_info->salt.$pwd);
        	if($user_info->pwd == $md5_pwd){
        		Session::put('admin', $name);
                Session::save();
        		echo self::json_return(0,'登录成功');
        	}
        	else 
        		echo self::json_return(10001,'账号或密码错误');
        	exit;
        }
        	echo self::json_return(10001,'账号或密码错误');
        exit;
    }
}
