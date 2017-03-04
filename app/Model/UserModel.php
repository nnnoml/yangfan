<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'user';

    public static function getAll($key=''){
        return self::where(function($query) use($key){
            if($key!='') $query->where('name','like','%'.$key.'%');
        })->paginate(15);
    }

    public static function updateUser($data,$id=0){
        if($id!=0)
            $shop = self::find($id);
        //如果不存在 就新增
        if(!isset($shop)) $shop = new self;

        foreach($data as $key=>$vo){
            $shop->$key = $vo;
        }
        return $shop->save();
    }

    //微信授权后来查是否存在，不存在新增
    public static function wechatLogin($id,$name,$avatar){
        $is_insert = self::where('openid',$id)->first();
        if($is_insert) return $is_insert->id;
        else{
            $new_user = new self;
            $new_user->openid=$id;
            $new_user->nick=$name;
            $new_user->avatar=$avatar;
            $new_user->save();
            return $new_user->id;
        }
    }
}
