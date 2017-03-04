<?php

namespace App\Http\Controllers;

use Request,Session;
use App\Model\ShopRelationModel as Relation;

class AppController extends Controller
{
    public function index(){
        $title='首页';
        $shop_list = Relation::getIndexList();
        return view('App.index',compact('title','shop_list'));
    }
}
