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
