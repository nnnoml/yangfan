<?php

namespace App\Http\Controllers;

use Request;
use App\Model\ShopRelationModel as Relation;

class AdminRelationController extends Controller
{
    public function index()
    {
        $title='关系列表';
        $nav='2-3';
        $key=Request::input('key','');
        $data = Relation::getAll($key);

        $searchitem = [];
        if($key) $searchitem['key'] = $key;

        return view('Admin.Relation.index',compact('title','nav','data','key','searchitem'));
    }

    public function create()
    {
        $title='关系列表';
        $nav='2-3';
        return view('Admin.Relation.add',compact('title','nav'));
    }
}
