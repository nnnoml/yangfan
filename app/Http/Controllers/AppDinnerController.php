<?php

namespace App\Http\Controllers;

use Request,Session;
use App\Model\ShopRelationModel as Relation;

class AppDinnerController extends Controller
{
    public function index()
    {
        header('Location:'.asset('/'));
        exit;
    }
    public function show($qr_id)
    {
        $info= Relation::getDinnerInfo($qr_id);
        if($info->status){
            $title = $info->name."-预定";
            $dinner_list = Relation::getDinnerList($qr_id);

            return view('App.dinner',compact('title','dinner_list','qr_id'));
        }
        else echo "<script>alert('抱歉 该店铺目前打烊了');window.location.href='".asset('/')."'</script>";
    }
}
