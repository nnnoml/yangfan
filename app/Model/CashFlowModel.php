<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CashFlowModel extends Model
{
    protected $table = 'cash_flow';

    //每次分账都写日志
    public static function newFlow($order_id,$u_id,$price)
    {
        $flow = new self;
        $flow->order_id = $order_id;
        $flow->user_id = $u_id;
        $flow->price = $price;
        return $flow->save();
    }

    public static function getAll($key=''){
        return self::leftJoin('user as u','u.id','=','cash_flow.user_id')
            ->where(function($query) use($key){
                if($key!='') $query->where('u.nick','like','%'.$key.'%')
                                    ->orwhere('u.openid','like','%'.$key.'%')
                                    ->orwhere('cash_flow.order_id','like','%'.$key.'%');
            })
            ->select('cash_flow.*','u.nick','u.openid')
            ->paginate(15);
    }
}
