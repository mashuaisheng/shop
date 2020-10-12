<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\UserModel;
use Illuminate\Support\Facades\Redis;
class TestController extends Controller
{
    public function aa(){
    	$user=UserModel::where('user_id','=',5)->first();
    	print_r($user);
    }
    public function test1(){
    	Redis::incr('2233','900');
    	$kay=Redis::get('2233');
    	dd($kay);
    }
}
