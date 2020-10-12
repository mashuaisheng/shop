<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use App\Model\UserModel;
use Cookie;
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
        $user_name=$request->input('user_name');
        $password=$request->input('password');
        $date['last_login'] = time();
        $date["last_ip"] = ip2long($_SERVER['DB_HOST']);

        //$user['password']=md5(md5($user['password']));
        $admin=UserModel::where(['user_name'=>$user_name])
            ->orWhere(['email'=>$user_name])
            ->orWhere(['tel'=>$user_name])
            ->first();
        //$admins=UserModel::where("uid",$admin->uid)->update($date);
        $p=password_verify($password,$admin->password);
        //存入redis
        $key='login:count:'.$user_name;
        $count=Redis::get($key);
        
        if($count>=5){
            //echo "密码错误次数太多了，已被锁定";exit;
            $expire = Redis::ttl($key);
            if ($expire < 60) {
                $msg = $expire . '秒';
            } else if ($expire < 3600) {
                $minutes = intval($expire / 60);
                $msg = $minutes . '分钟';
            } else {
                $hout = intval($expire / 3600);
                $minutes = intval(($expire - 3600) / 60);
                $msg = $hout . '小时' . $minutes . '分钟后';
            }
            echo '账号被锁定,' . $msg . '接触锁定';
        }
        if(!$p){
            $count=Redis::incr($key);//添加数值
            echo "密码错误次数:".$count;exit;
        }
        
        
        
        if($admin){
            setcookie('uid',$admin->uid,time()+3600,'/');
            setcookie('name',$admin->user_name,time()+3600,'/');
            // session(['adminuser'=>$admin]);
            // $request->session()->save();
            return redirect('/user/index');
        }
        return redirect('/user/login')->with('msg','没有此用户');
    }
    public function index(){
        session_start();
        if(isset($_COOKIE['uid']) && isset($_COOKIE['name'])){
                return view('user.index');
            }else{
                return redirect('/user/login');
            }
    }
    //退出登录
    public function quit(){
        //清除session
        Cookie::queue(Cookie::forget('uid'));
        Cookie::queue(Cookie::forget('name'));
        return redirect('/user/login');
        //跳转页面
        
    }
}
