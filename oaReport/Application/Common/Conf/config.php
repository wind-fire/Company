<?php
return array(
	//'配置项'=>'配置值'
	'SHOW_PAGE_TRACE'=>false,
	// URL模式
	'URL_MODEL'=>3,
	// 数据库配置
	'DB_TYPE'   => 'mysql',         // 数据库类型我们是mysql，就对于的是mysql
	'DB_HOST'   => '103.250.224.134',   // 服务器地址，就是我们配置好的php服务器地址，也可以使用localhost，
	'DB_NAME'   => 'wintimes',  // 数据库名：mysq创建的要连接我们项目的数据库名称
	'DB_USER'   => 'root',           // 用户名：mysql数据库的名称
	'DB_PWD'    => 'ftp@wifi',       //mysql数据库的 密码
	'DB_PORT'   => 3306,            // 端口服务端口一般选3306
	'DB_PREFIX' => '',            //  数据库表前缀
	'DB_CHARSET'=> 'utf8',         // 字符集
	// 'DB_DEBUG'  =>  TRUE,         // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增
);