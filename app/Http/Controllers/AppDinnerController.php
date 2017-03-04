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
        $title= Relation::getDinnerTitle($qr_id);
        $title = $title->name."-预定";
        $dinner_list = Relation::getDinnerList($qr_id);
        return view('App.dinner',compact('title','dinner_list','qr_id'));
    }
}
