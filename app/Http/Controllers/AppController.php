<?php

namespace App\Http\Controllers;

use App\Model\BuyShopModel;
use Request;
use App\Model\BuyShopModel as BuyShop;
use App\Model\ShopRelationModel as Relation;

class AppController extends Controller
{
    public function index(){
        $title='首页';
        $shop_list = Relation::getIndexList();

        return view('App.index',compact('title','shop_list'));
    }
}
