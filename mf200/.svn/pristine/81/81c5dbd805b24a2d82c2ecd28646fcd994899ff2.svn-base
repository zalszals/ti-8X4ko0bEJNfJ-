<?php
header('Access-Control-Allow-Origin:*');
header("Content-type:text/html;charset=utf-8");
ini_set("display_errors", "Off");


/*
session_start();
$token = $_SESSION['archiver']['token'];

if(!$token){
	$re['status'] = -1;
    $re['info'] = '没有登录，请先登录';
    ajaxReturnJson($re);
    exit;
}*/

$_POST['data']['token'] = $_GET['token'];

$url = $_POST['url'] ? $_POST['url'] : 'index.php';


if(strpos($url,'http://') === false){
	$url = 'http://127.0.0.1:81/'.$url; 
}
//echo $url;exit;
$data = $_POST['data'] ? http_build_query($_POST['data']) : array();


$re = https_request($url,$data);

echo $re;

/**
 * [curl_post 模拟post请求]
 * @param  [type] $url  [description]
 * @param  [type] $post [description]
 * @return [type]       [description]
 */
function https_request($url, $data = null){
	
	$curl = curl_init();  //初始化一个cURL会话
	
	//设置请求选项, 包括具体的url
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);  //禁用后cURL将终止从服务端进行验证
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
	
	if (!empty($data)){
		curl_setopt($curl, CURLOPT_POST, 1);  //设置为post请求类型
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);  //设置具体的post数据
	}
	
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);		
	$response = curl_exec($curl);  //执行一个cURL会话并且获取相关回复
	curl_close($curl);  //释放cURL句柄,关闭一个cURL会话
	
	return $response;
}