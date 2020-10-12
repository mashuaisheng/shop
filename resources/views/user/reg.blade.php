<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>用户注册页面</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
	<center>
	<a href="{{url('/user/login')}}" class="btn btn-info">登录</a>
<h2>用户注册页面</h2>
</center>
<form  action="{{url('/user/regdo')}}" method='post' class="form-horizontal" role="form">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">用户名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name='user_name' id="firstname">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">邮箱</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name='email' id="firstname">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">手机号</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name='tel' id="firstname">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">密码</label>
		<div class="col-sm-8">
			<input type="password" class="form-control" name='password' id="firstname">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-8">
			<input type="submit" value='注册'>
		</div>
	</div>
</form>

</body>
</html>