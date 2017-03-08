<?php

namespace App\Model;

use DB;
use Illuminate\Database\Eloquent\Model;
use App\Model\UserModel as User;

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

    //后台流水手动操作
    public static function withdrawDo($w_id,$status){
        $widtdraw_info = self::find($w_id);
        $user_info = User::where('id',$widtdraw_info->user_id)->first();

        if($widtdraw_info->status == $status) return false;
        if($widtdraw_info->price > $user_info->account_cash) return false;

        DB::beginTransaction();
            //目前是驳回状态的话，不操作user表
            if($widtdraw_info->status == 2) $rs1 = 1;
            //如果要修改为驳回状态，不操作user表
            else if($status==2)
                $rs1 = 1;
                //修改为未审核状态，需要把钱加回去
            else if($status==0)
                $rs1 = $user_info->where(['account_cash'=>$user_info->account_cash,'id'=>$widtdraw_info->user_id])
                    ->increment('account_cash',$widtdraw_info->price);
                //修改为审核状态，给玩家减钱
            else if($status==1)
                $rs1 = $user_info->where(['account_cash'=>$user_info->account_cash,'id'=>$widtdraw_info->user_id])
                             ->decrement('account_cash',$widtdraw_info->price);

            $widtdraw_info->status=$status;
            $rs2 = $widtdraw_info->save();

        if($rs1 && $rs2){
            DB::commit();
            return true;
        }
        else {
            DB::rollback();
            return false;
        }
    }

    public static function newWithdraw ($user_id,$num) {
        $withdraw = new self;
        $withdraw->user_id = $user_id;
        $withdraw->price = $num;
        $withdraw->status = 0;
        return $withdraw->save();
    }
}
