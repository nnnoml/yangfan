<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    protected $table = 'admin';

    public static function getAdmin($name){
    	return self::where('name',$name)->first();
    }

    public static function updateAdmin($name,$ip=''){
        $now_user = self::where('name',$name)->first();
        $now_user->last_login_ip = $ip;
        $now_user->login_count = $now_user->login_count + 1;
        return $now_user->save();
    }
    public static function changePwd($name,$salt,$new_pwd){
        $now_user = self::where('name',$name)->first();
        $now_user->salt = $salt;
        $now_user->pwd = $new_pwd;
        return $now_user->save();
    }
}
