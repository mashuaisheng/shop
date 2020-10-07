<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品展示列表</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>商品展示列表</h2></center>
<table class="table">
  <thead>
    <tr>
      <th>商品id</th>
      <th>商品名称</th>
      <th>商品价格</th>
      <th>商品描述</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody>
  @foreach($data as $k=>$v)
    <tr>
      <td>{{$v->goods_id}}</td>
      <td>{{$v->goods_name}}</td>
      <td>{{$v->goods_price}}</td> 
      <td>{{$v->goods_desc}}</td>
      <td>
        <a href="{{url('goods/update/'.$v->goods_id)}}" class="btn btn-info">编辑</a> |
        <a href="{{url('goods/del/'.$v->goods_id)}}" class="btn btn-danger del">删除</a>
      </td> 
    </tr>
    @endforeach
    <tr><td colspan="11">{{$data->links()}}</td></tr>
  </tbody>
</table>
</body>
</html>