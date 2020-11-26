<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redis;

use App\Model\WxwModel;
use App\Model\CartModel;
use Illuminate\Http\Request;
use App\Model\GoodsModel;
use DB;
class ApiController extends Controller
{
    public function __construct()
    {
        app('debugbar')->disable();     //关闭调试
    }
    //测试
    public function test(){
        $goods_info=[
            'goods_id' =>12345,
            'goods_name' => "IPHONE",
            'price' =>12.345
        ];
        echo json_encode($goods_info);
    }
    //登录
    public function Login(Request $request){
        //接收code
        $code = $request->get('code');
        
        //使用code
        $url='https://api.weixin.qq.com/sns/jscode2session?appid='.env('WX_WXC_APPID').'&secret='.env('WX_XCX_SECRET').'&js_code='.$code.'&grant_type=authorization_code';

        $data=json_decode(file_get_contents($url),true);
        //自定义登录状态
        if (isset($data['errno'])) {
            //错误处理
            $response = [
                'error'=>50001,
                'msg'  =>'登录失败',
            ];
        }else{
            $openid=$data['openid'];
            //判断新老用户
            $u=WxwModel::where(['openid'=>$openid])->first();
            if($u){

            }else{
                $u_info=[
                'openid' =>$openid,
                'add_time'=>time()
            ];
            WxwModel::insertGetId($u_info);
            }
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
    //商品数据
    public function goods(){
        $data=DB::table('goods')->limit(10)->get()->toArray();
        return $data;
    }
    //商品详情接口
    public function list(Request $request){
        $goods_id = $request->get('goods_id');
        $data=GoodsModel::select('goods_id','goods_name','shop_price','goods_img','goods_imgs','goods_desc')->where('goods_id',$goods_id)->first()->toArray();
        $array=[
            "goods_id"=>$data['goods_id'],
            "goods_name"=>$data['goods_name'],
            "shop_price"=>$data['shop_price'],
            "goods_desc"=>$data['goods_desc'],
            "goods_img"=>$data['goods_img'],
            "goods_imgs"=>explode(',',$data['goods_imgs'])
 
        ];
        return $array;
    }
    
    public function wxclogin(Request $request){
        $code= $request->get('code');
        echo $code;
    }
    //加入购物车
    public function addCart(Request $request){
        $token = $request->get('token');
        $goods_id = $request->get('goodsid');
        $goodsinfo=[
            'goods_id'=>$goods_id,
            'ctime'=>time(),
            'buy_number'=>1,
            'user_id'=>1,
        ];
        $res=CartModel::insertGetId($goodsinfo);
        return $res;
    }
    //购物车列表
     public function cartList()
    {
        $user_id = 1;
        $goods = CartModel::where(['user_id'=>$user_id])->get();
        if($goods)      //购物车有商品
        {
            $goods = $goods->toArray();
            foreach($goods as $k=>&$v)
            {
                $g = GoodsModel::find($v['goods_id']);
                $v['goods_name'] = $g->goods_name;
            }
        }else{          //购物车无商品
            $goods = [];
        }

        //echo '<pre>';print_r($goods);echo '</pre>';die;
        $response = [
            'errno' => 0,
            'msg'   => 'ok',
            'data'  => [
                'list'  => $goods
            ]
        ];

        return $response;
    }
    //收藏
    public function fav(Request $request){
        $goods_id = $request->get('id');
        $token = $request->get('token');
        $uid = 1;
        $redis_key='ss:goods:fav:'.$uid;//用户收藏的商品有序集合
        Redis::Zadd($redis_key,time(),$goods_id);//将商品id加入有序集合,并给排序值
        $response = [
            'errno' => 0,
            'msg'   => 'ok'
        ];
        return $response;
    }

}
