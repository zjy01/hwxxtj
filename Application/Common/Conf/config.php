<?php
return array(
	//'配置项'=>'配置值'
	'URL_PARAMS_BIND'	=>	true,		//URL变量绑定到操作方法作业参数
	'URL_PARAMS_BIND_TYPE'  =>  1, // 设置参数绑定按照变量顺序绑定
	'URL_HTML_SUFFIX'	=>	'',	//伪静态效果，为了满足更好的SEO效果
	'URL_DENY_SUFFIX'	=>	'pdf|ico',	//禁止访问的后缀
	'URL_CASE_INSENSITIVE'	=>	true,	//URL访问不区分大小写


	//数据库配置信息
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => 'localhost', // 服务器地址
	'DB_NAME'   => 'hwxxtj', // 数据库名
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => '111111', // 密码
	'DB_PORT'   => 3306, // 端口
	'DB_PREFIX' => '', // 数据库表前缀


	'TAGLIB_PRE_LOAD'    =>    'html',//模板标签定义
);