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
//微信路由
Route::any('/wechat', 'WechatController@serve');
Route::any('/wechatCallBack', 'WechatController@wechatCallBack');


Route::group(['middleware' => ['web', 'wechat.oauth','insert.user']], function () {
//Route::group(['middleware' => ['web']], function () {
	/*
	 * 前台路由
	 */
	Route::resource('/','AppController');
	Route::resource('/dinner','AppDinnerController');
	Route::resource('/order','AppOrderController');
	Route::get('/user','AppUserController@index');
	Route::get('/account','AppUserController@account');
	Route::get('/account/detail/{flag}','AppUserController@accountDetail');
	Route::get('/withdraw','AppUserController@withdraw');
	Route::post('/withdraw','AppUserController@withdrawDo');
});


Route::group(['middleware' => ['web']], function () {

	/*
	 * 后台路由
	 */
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
		//与销售门店关联的商品路由
		Route::resource('/admin/sellgood','AdminSellGoodController');
		//商品上传图片
		Route::post('/admin/sellgood/uploadImg','AdminSellGoodController@uploadImg');

	//后台购买门店路由
	Route::resource('/admin/buyshop','AdminBuyShopController');

	//后台关系 路由
	Route::resource('/admin/relation','AdminRelationController');

	//后台用户 路由
	Route::resource('/admin/user','AdminUserController');

	//后台订单 路由
	Route::resource('/admin/order','AdminOrderController');

	//后台分账 路由
	Route::resource('/admin/cashflow','AdminCashFlowController');

	//后台提现日志 路由
	Route::resource('/admin/withdraw','AdminWithdrawController');

	//后台主页路由
    Route::resource('/admin','AdminController');
});
