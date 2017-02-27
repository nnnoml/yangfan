<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdminLoginModel extends Model
{
    protected $table = 'admin';

    public static function getUser($name){
    	return self::where('name',$name)->first();
    }
}
