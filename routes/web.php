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

Route::get('/', function () {
    return view('welcome');
});
Route::any('/info', function () {
    phpinfo();
});
Route::any("/cc","TestController@aa");
Route::any("/test1","TestController@test1");

Route::any("/api/test","TestController@test");

Route::get("/goods/create","GoodsController@create");
Route::post("/goods/add","GoodsController@add");
Route::get("/goods/index","GoodsController@index");
Route::get("/goods/update/{id}","GoodsController@update");
Route::post("/goods/upd/{id}","GoodsController@upd");
Route::any("/goods/del/{id}","GoodsController@del");
Route::get("/goods/list","GoodsController@list");
Route::get("/goods/defail/{id}","GoodsController@defail");

Route::get("/user/reg","UserController@reg");
Route::post("/user/regdo","UserController@regdo");

Route::get("/user/login","UserController@login");
Route::post("/user/logindo","UserController@logindo");
Route::get("/user/index","UserController@index");
Route::get("/user/quit","UserController@quit");


Route::get("/api/onLogin","TestController@Login");