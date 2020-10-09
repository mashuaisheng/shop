<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UserModel;
class UserController extends Controller
{
    public function reg(){
        return view('user.reg');
    }
    public function regdo(request $request){
        $data=$request->except('_token');
        $password = $request->input('password');
        $data["password"] = password_hash($password,PASSWORD_DEFAULT);
        //$data['password']=md5(md5($data['password']));
        $data['reg_time']=time();
        //dd($data);
    	$res=UserModel::insert($data);
    	if($res){
    		return redirect('/user/login');
    	}
    }
    //登录
    public function login(){
        return view('user.login');
    }
    public function logindo(request $request){
        $user=$request->except('_token');
        $date['last_login'] = time();
        $date["last_ip"] = ip2long($_SERVER['DB_HOST']);

        //$user['password']=md5(md5($user['password']));
        $admin=UserModel::find();
        $admins=UserModel::where("uid",$admin->uid)->update($date);
        if($admin){
            session(['adminuser'=>$admin]);
            $request->session()->save();
            return redirect('/user/index');
        }
        return redirect('/user/login')->with('msg','没有此用户');
    }
    public function index(){
        return view('user.index');
    }
}
