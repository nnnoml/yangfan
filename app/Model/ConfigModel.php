<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ConfigModel extends Model
{
    protected $table = 'conf';

    public static function getConfig(){
        return self::first();
    }

    public static function updateConfig($data){
        $conf = self::first();
        //如果不存在 就新增
        if(!isset($conf)) $conf = new self;

        foreach($data as $key=>$vo){
            $conf->$key = $vo;
        }
        return $conf->save();
    }
}
