<?php

namespace App\Http\Controllers;

use Request;
use App\Model\UserModel as User;

class AdminUserController extends Controller
{
    public function index()
    {
        $title="用户列表";
        $nav='';
        $key=Request::input('key','');
        $data = User::getAll($key);

        $searchitem = [];
        if($key) $searchitem['key'] = $key;
        return view('Admin.User.index',compact('title','nav','data','key','searchitem'));
    }

    public function edit($id)
    {
        $title="修改用户信息";
        $nav='';

        $data = User::find($id);

        return view('Admin.User.edit',compact('title','nav','data'));
    }

    public function update($id)
    {
        $data = Request::all();
        unset($data['_token']);

        $res = User::updateUser($data,$id);
        if($res){
            echo self::json_return(0,'修改成功');
        }
        else
            echo self::json_return(10003,'修改失败');
    }

}
