<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>用户页面</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
	<center>
<h2>用户页面</h2>
</center>
<p>欢迎 {{$_COOKIE['name']}} 登录</p>
<a href="{{url('/user/quit')}}">退出</a>
</body>
</html>