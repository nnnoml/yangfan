<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SellGoodModel extends Model
{
    protected $table = 'sell_goods';

    public static function getAll($id,$key=''){
        return self::where('s_id',$id)
                    ->where(function($query) use($key){
                      if($key!='') $query->where('name','like','%'.$key.'%');
                    })
                    ->paginate(15);
    }

    public static function updateGood($data,$id=0){
        if($id!=0)
            $good = self::find($id);
        //如果不存在 就新增
        if(!isset($good)) $good = new self;

        foreach($data as $key=>$vo){
            $good->$key = $vo;
        }
        return $good->save();
    }
}
