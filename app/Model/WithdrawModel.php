<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WithdrawModel extends Model
{
    protected $table = 'withdraw_flow';

    public static function getAll($key=''){
        return self::leftJoin('user as u','u.id','=','withdraw_flow.user_id')
            ->where(function($query) use($key){
                if($key!='') $query->where('u.nick','like','%'.$key.'%')
                                    ->orwhere('u.openid','like','%'.$key.'%');
            })
            ->select('withdraw_flow.*','u.nick','u.openid')
            ->paginate(15);
    }
}
