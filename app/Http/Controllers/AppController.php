<?php

namespace App\Http\Controllers;

use Request;

class AppController extends Controller
{
    public function index(){
        $title='首页';
        return view('App.index',compact('title'));
    }
}
