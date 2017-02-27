<?php

namespace App\Http\Controllers;

use Request,Session,URL;

use App\Http\Requests;



class AdminController extends Controller
{
    public function __construct(){

    	if(!Session::has('admin')){
    		$url = route('login');
    		header('Location:'.$url);
    		exit;
    	}
    }

    public function index(){
		echo Session::get('admin');
    }

    public function show(){
    }
}
