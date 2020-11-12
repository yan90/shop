<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',function(){
    return view('/welcome');
});
//视图
Route::get('/admin/index','Admin\AdminController@index');
//添加
Route::get('/save','Admin\AdminController@save');
//展示
Route::get('/admin/zhan','Admin\AdminController@zhan');
//删除
Route::get('/admin/delete/{c_id}','Admin\AdminController@delete');
//修改
Route::get('/admin/update/{c_id}','Admin\AdminController@update');
//执行修改
Route::post('/admin/updatedo/{c_id}','Admin\AdminController@updatedo');


//wo注册
Route::get('/wo/login','Wo\WoController@login');
//注册验证
Route::get('/wo/save','Wo\WoController@save');
//登录
Route::get('/wo/logindo','Wo\WoController@logindo');
//执行登录
Route::post('/wo/logindo2','Wo\WoController@logindo2');
//登录后跳转
Route::get('/wo/list','Wo\WoController@list')->middleware("CheckLogin");
//取出session
Route::get('/wo/exit','Wo\WoController@exit');
Route::post('/wo/aaa','Wo\WoController@aaa');

//防非法

//商品 视图
Route::get('/goods/index','Goods\GoodsController@index');
//执行添加
Route::post('/goods/save','Goods\GoodsController@save');
//展示
Route::get('/goods/list','Goods\GoodsController@list');

//微信
Route::post('/wx','TextController@checkSignature');  //接口微信
Route::get('/wx/token','TextController@token');  //access_token

Route::get('/custom','TextController@custom');  //自定义菜单

//TEST 路由分组
//Route::prefix('/text')get()->group(function (){
//
//});
Route::get('getweather','TextController@getweather');
Route::get('/guzzle',"TextController@guzzle");  //guzzle 测试  GET
Route::get('/guzzle2',"TextController@guzzle2");  //guzzle 测试  POST
