<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
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
        //新增 完毕后根据自增id写一个uuid
        if($id==0){
            DB::beginTransaction();
            $relation = new self;
            foreach($data as $key=>$vo){
                $relation->$key = $vo;
            }
            $rs1 = $relation->save();

            $relation_2 = self::find($relation->id);
            $relation_2->qr_id = uniqid().$relation->id;
            $rs2 = $relation_2->save();

            if($rs1 && $rs2) {
                DB::commit();
                return 1;
            }
            else {
                DB::rollback();
                return 0;
            }

        }
        else{
            $relation = self::find($id);
            foreach($data as $key=>$vo){
                $relation->$key = $vo;
            }
            return $relation->save();
        }
    }
}
