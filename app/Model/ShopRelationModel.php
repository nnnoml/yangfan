<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class ShopRelationModel extends Model
{
    protected $table = 'shops_relation';

    //首页获取店铺列表
    public static function getIndexList()
    {
        return self::leftJoin('buy_shops as bs','bs.id','=','shops_relation.bs_id')
            ->where(function ($query){
                $query->where(function ($query){
                    $query->where('bs.start_time','<',date('H:i:s'))
                        ->where('bs.end_time','>',date('H:i:s'));
                });
                $query->orwhere('bs.start_time','');
            })
            ->where('shops_relation.status',1)
            ->select('bs.*','shops_relation.qr_id')
            ->get();
    }

    //前台获取产品列表
    public static function getDinnerList($qr_id)
    {
        return self::rightJoin('sell_goods as sg','sg.s_id','=','shops_relation.ss_id')
                ->where('shops_relation.qr_id',$qr_id)
                ->where('sg.status',1)
                ->where(function ($query){
                    $query->where('max_num','>',0);
                    $query->orwhere('max_num',-1);
                })
                ->where(function ($query){
                    $query->where(function ($query){
                        $query->where('sg.start_time','<',date('H:i:s'))
                            ->where('sg.end_time','>',date('H:i:s'));
                    });
                    $query->orwhere('sg.start_time','');
                })
                ->select('sg.*')
                ->get();
    }

    //前台根据pr获取店铺名称
    public static function getDinnerTitle($qr_id)
    {
        return self::leftJoin('buy_shops as bs','bs.id','=','shops_relation.bs_id')
            ->where('shops_relation.qr_id',$qr_id)
            ->select('bs.name')
            ->first();
    }


    //后台获取关系列表
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
            $relation_2->qr_id = md5(uniqid().$relation->id);
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
