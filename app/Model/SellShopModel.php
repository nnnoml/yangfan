<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SellShopModel extends Model
{
    protected $table = 'sell_shops';
    public static function getAll($key=''){
        return self::where(function($query) use($key){
            if($key!='') $query->where('name','like',$key);
        })->paginate(15);
    }
    public static function getOne($id){
        return self::find($id);
    }
    public static function updateShop($data){
        $conf = self::first();
        //如果不存在 就新增
        if(!isset($conf)) $conf = new self;

        foreach($data as $key=>$vo){
            $conf->$key = $vo;
        }
        return $conf->save();
    }
}
