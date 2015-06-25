<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="ie6 ielt7 ielt8 ielt9"><![endif]--><!--[if IE 7 ]><html lang="en" class="ie7 ielt8 ielt9"><![endif]--><!--[if IE 8 ]><html lang="en" class="ie8 ielt9"><![endif]--><!--[if IE 9 ]><html lang="en" class="ie9"> <![endif]--><!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en"><!--<![endif]--> 
	<head>
		<meta charset="utf-8">
		<title>会务信息统计系统--Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="/hwxxtj/Public/login/css/bootstrap.min.css" rel="stylesheet">
		<link href="/hwxxtj/Public/login/css/site.css" rel="stylesheet">
		<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
		<script src="/hwxxtj/Public/login/js/site.js"></script>
	</head>
	<body>
		<div id="login-page" class="container">
			<h1>Login</h1>
			<div class="web_title">会务信息统计系统</div>
			<form id="login-form" name="login" class="well" action="/hwxxtj/index.php/Home/Index/loginVerify" method='post'>
			<input type="text" class="span2" placeholder="职工号" name='number' id="number" /><br />
			<input type="password" class="span2" placeholder="Password"  name='password' id="password"/><br />

			<button type="submit" class="btn btn-primary" name='submit' value='login' onclick="return check()">Sign in</button>

		</form>	
		</div>
	</body>
</html>