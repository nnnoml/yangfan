<?php

namespace App\Http\Middleware;

use Closure,Log,Session;
use App\Model\UserModel as User;

class InsertUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //有用户信息，查插
        if(Session::has('wechat.oauth_user')){
            $user = Session::get('wechat.oauth_user');
            $rs = User::wechatLogin($user->getId(),$user->getNickname(),$user->getAvatar());
            if($rs){
                session::set('user_id',$rs);
                session::save();
                return $next($request);
            }
            else header('Location:'.asset('/'));
        }
        header('Location:'.asset('/'));
        exit;
    }
}
