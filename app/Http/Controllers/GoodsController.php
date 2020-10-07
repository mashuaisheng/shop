<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\GoodsModel;
class GoodsController extends Controller
{
    public function create(){
        return view('goods.create');
    }
    public function add(request $request){
    	$data=$request->except('_token');
    	$res=GoodsModel::insert($data);
    	if($res){
    		return redirect('/goods/index');
    	}
    }
    public function index(){
    	$pageSize=config('app.pageSize');
    	$data=GoodsModel::paginate($pageSize);
    	return view('goods.index',['data'=>$data]);
    }
    public function update($id){
        $res=GoodsModel::where('goods_id',$id)->first();
        return view('goods.update',['res'=>$res]);
    }
    public function upd(Request $request, $id){
        $data=$request->except('_token');
        $res=GoodsModel::where('goods_id',$id)->update($data);
        if($res){
            return redirect('/goods/index');
        }
    }
    public function del($id){
        $res=GoodsModel::where('goods_id',$id)->delete();
        if($res){
            return redirect('/goods/index');
        }
    }
}
