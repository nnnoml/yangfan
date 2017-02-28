<?php

namespace App\Http\Controllers;

use Request,Session;
use App\Model\ConfigModel as Config;

class AdminConfigController extends Controller
{
    public function index()
    {
        $title="系统配置";
        $nav='0';
        $site_config = Config::getConfig();

        return view('Admin.Config.index',compact('title','nav','site_config'));
    }

    public function store()
    {
        $data = Request::all();
        unset($data['type']);
        unset($data['_token']);

        $res = Config::updateConfig($data);
        if($res){
            echo self::json_return(0,'修改成功');
        }
        else
            echo self::json_return(10003,'修改失败');
    }
}
