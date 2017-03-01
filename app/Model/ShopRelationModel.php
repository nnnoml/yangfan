<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShopRelationModel extends Model
{
    protected $table = 'shops_relation';

    public static function getAll($key='')
    {
        return self::leftJoin('buy_shops as bs','bs.id','=','shops_relation.bs_id')
                    ->leftJoin('sell_shops as ss','ss.id','=','shops_relation.ss_id')
                    ->where(function($query) use($key){
                        if($key){
                            $query->where('bs.name','like','%'.$key.'%');
                            $query->Orwhere('ss.name','like','%'.$key.'%');
                        }
                    })
                    ->select('shops_relation.*','bs.name as bs_name','ss.name as ss_name')
                    ->paginate(15);
    }

    public static function updateRelation($data,$id=0){
        if($id!=0)
            $relation = self::find($id);
        //如果不存在 就新增
        if(!isset($relation)) $relation = new self;

        foreach($data as $key=>$vo){
            $relation->$key = $vo;
        }
        return $relation->save();
    }
}
