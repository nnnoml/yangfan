<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BuyShopModel extends Model
{
    protected $table = 'buy_shops';
    public static function getAll($key=''){
        return self::leftJoin('user as u','u.openid','=','buy_shops.user_wechat')
            ->where(function($query) use($key){
                if($key!='') $query->where('buy_shops.name','like','%'.$key.'%');
            })
            ->select('buy_shops.*','u.nick')
            ->paginate(15);
    }
    public static function getOne($id){
        return self::find($id);
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
