<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use QrCode;
use App\Http\Requests;

class AppController extends Controller
{
    public function index(){
        echo QrCode::size(100)->generate('http://www.baidu.com');
        return view('App.index');
    }
}
