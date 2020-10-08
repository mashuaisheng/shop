<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\UserModel;
class TestController extends Controller
{
    public function aa(){
    	$user=UserModel::where('user_id','=',5)->first();
    	print_r($user);
    }
}
