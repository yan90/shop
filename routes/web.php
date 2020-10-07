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
Route::get('/wo/logindo2','Wo\WoController@logindo2');
//登录后跳转
Route::get('/wo/aaa','Wo\WoController@aaa');
