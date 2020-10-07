<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class TestController extends Controller
{
    public function aa(){
    	$user = DB::table('news')->where('news_title', '垃圾')->first();
		echo $user->news_title;
		$email = DB::table('news')->where('news_title', '垃圾')->value('news_content');
		echo $email;
        // $users = DB::table('news')->get();
        // dd($users);
    }
}
