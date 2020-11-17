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
    public function __construct()
    {
        app('debugbar')->disable();     //关闭调试
    }
    public function test(){
        $goods_info=[
            'goods_id' =>12345,
            'goods_name' => "IPHONE",
            'price' =>12.345
        ];
        echo json_encode($goods_info);
    }
    public function Login(Request $request){
    	//接收code
    	$code = $request->get('code');

    	//使用code
    	$url='https://api.weixin.qq.com/sns/jscode2session?appid='.env('WX_WXC_APPID').'&secret='.env('WX_XCX_SECRET').'&js_code='.$code.'&grant_type=authorization_code';

		$data=json_decode(file_get_contents($url),true);
		//echo '<pre>';print_r($data);echo '</pre>';

		//自定义登录状态
		if (isset($data['errcode'])) {
			//错误处理
			$response = [
				'error'=>50001,
				'msg'  =>'登录失败',
			];
		}else{
			//成功
			$token=sha1($data['openid'].$data['session_key'].mt_rand(0,999999));
			//保存token
			$redis_key='xcx_token:'.$token;
			Redis::set($redis_key,time());
			//设置过期时间
			Redis::expire($redis_key,7200);

			$response = [
				'error'=>0,
				'msg'  =>'ok',
				'data' =>[
					'token' =>$token
				]
			];
		}
	return $response;

    }


}
