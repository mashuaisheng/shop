<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品修改</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>商品修改页面</h2></center>
<form  action="{{url('/goods/upd/'.$res->goods_id)}}" method='post' class="form-horizontal" role="form">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name='goods_name' id="firstname" value="{{$res->goods_name}}">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name='goods_price' id="firstname" value="{{$res->goods_price}}">
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品描述</label>
		<div class="col-sm-8">
			 <textarea name="goods_desc" cols="50" rows="5">{{$res->goods_desc}}</textarea>
		</div>
	</div> 
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-8">
			<input type="submit" value='修改'>
		</div>
	</div>
</form>

</body>
</html>