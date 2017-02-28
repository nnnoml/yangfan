<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
	Route::resource('/','AppController');

	//后台登录相关路由
	Route::get('/admin/login','AdminLoginController@login')->name('adminLogin');
	Route::post('/admin/login','AdminLoginController@loginCheck');
	Route::get('/admin/loginOut','AdminLoginController@loginOut');

	//后台修改用户信息路由
	Route::resource('/admin/auth','AdminAuthController');
	//后台配置信息路由
	Route::resource('/admin/conf','AdminConfigController');
	//后台销售门店路由
	Route::resource('/admin/sellshop','AdminSellShopController');
	//后台购买门店路由
	Route::resource('/admin/buyshop','AdminBuyShopController');

    Route::resource('/admin','AdminController');
});
