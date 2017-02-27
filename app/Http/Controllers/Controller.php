<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function json_return($status,$msg,$info=''){
    	$data['errorno']=$status;
    	$data['msg']=$msg;
    	if(is_array($info)) $data['info']=$info;
    	return json_encode($data);
    }
}
