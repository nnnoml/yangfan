<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SellShopModel extends Model
{
    protected $table = 'sell_shops';
    public static function getAll($key=''){
        return self::where(function($query) use($key){
            if($key!='') $query->where('name','like','%'.$key.'%');
        })->paginate(15);
    }

    public static function updateShop($data,$id=0){
        if($id!=0)
            $shop = self::find($id);
        //如果不存在 就新增
        if(!isset($shop)) $shop = new self;

        foreach($data as $key=>$vo){
            $shop->$key = $vo;
        }
        return $shop->save();
    }
}
