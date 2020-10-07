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
Route::any('/aa', function () {
    echo "hello world";
});
Route::any("/cc","TestController@aa");

Route::get("/goods/create","GoodsController@create");
Route::post("/goods/add","GoodsController@add");
Route::get("/goods/index","GoodsController@index");
Route::get("/goods/update/{id}","GoodsController@update");
Route::post("/goods/upd/{id}","GoodsController@upd");
Route::any("/goods/del/{id}","GoodsController@del");