<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]

// 定义应用目录
$token = $_REQUEST['token'];
session_id($token);
session_start();

//var_dump($_REQUEST);exit;
//var_dump($_SESSION['db_name']);exit;

$_SESSION['db_name'] = $_SESSION['db_name'] ? $_SESSION['db_name'] : $_REQUEST['db_name'];

/*if(!$_SESSION['db_name']){
	header('Content-Type:application/json; charset=utf-8');
	$data['status'] = 0;
	$data['msg'] = '非法请求001';
    exit(json_encode($data,JSON_UNESCAPED_UNICODE));
}*/

define('APP_PATH', __DIR__ . '/../application/');
// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';