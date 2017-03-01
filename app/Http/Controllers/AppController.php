<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use QrCode;
use App\Http\Requests;

class AppController extends Controller
{
    public function index(){
        $qr =  QrCode::format('png')->size(100)->generate('http://www.nnnoml.com');
        return view('App.index',compact('qr'));
    }
}
