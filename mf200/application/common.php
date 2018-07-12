<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
 
/**
 * 新添加json 转换
 * @param unknown $data
 */
function ajaxReturnJson(array $data){
    header('Content-Type:application/json; charset=utf-8');
    exit(json_encode($data,JSON_UNESCAPED_UNICODE));
}

/**
 * [httpRequest 模拟get/post请求]
 * @param  [type]  $url        [description]
 * @param  string  $method     [description]
 * @param  [type]  $postfields [description]
 * @param  array   $headers    [description]
 * @param  boolean $debug      [description]
 * @return [type]              [description]
 */
function httpRequest($url, $method="GET", $postfields = null, $headers = array(), $debug = false) {
	$method = strtoupper($method);
	$ci = curl_init();
	/* Curl settings */
	curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
	curl_setopt($ci, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0");
	curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 60); /* 在发起连接前等待的时间，如果设置为0，则无限等待 */
	curl_setopt($ci, CURLOPT_TIMEOUT, 7); /* 设置cURL允许执行的最长秒数 */
	curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
	switch ($method) {
		case "POST":
			curl_setopt($ci, CURLOPT_POST, true);
			if (!empty($postfields)) {
				$tmpdatastr = is_array($postfields) ? http_build_query($postfields) : $postfields;
				curl_setopt($ci, CURLOPT_POSTFIELDS, $tmpdatastr);
			}
			break;
		default:
			curl_setopt($ci, CURLOPT_CUSTOMREQUEST, $method); /* //设置请求方式 */
			break;
	}
	$ssl = preg_match('/^https:\/\//i',$url) ? TRUE : FALSE;
	curl_setopt($ci, CURLOPT_URL, $url);
	if($ssl){
		curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
		curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, FALSE); // 不从证书中检查SSL加密算法是否存在
	}
	//curl_setopt($ci, CURLOPT_HEADER, true); /*启用时会将头文件的信息作为数据流输出*/
	curl_setopt($ci, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ci, CURLOPT_MAXREDIRS, 2);/*指定最多的HTTP重定向的数量，这个选项是和CURLOPT_FOLLOWLOCATION一起使用的*/
	curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ci, CURLINFO_HEADER_OUT, true);
	/*curl_setopt($ci, CURLOPT_COOKIE, $Cookiestr); * *COOKIE带过去** */
	$response = curl_exec($ci);
	$requestinfo = curl_getinfo($ci);
	$http_code = curl_getinfo($ci, CURLINFO_HTTP_CODE);
	if ($debug) {
		echo "=====post data======\r\n";
		var_dump($postfields);
		echo "=====info===== \r\n";
		print_r($requestinfo);
		echo "=====response=====\r\n";
		print_r($response);
	}
	curl_close($ci);
	return $response;
	//return array($http_code, $response,$requestinfo);
}
function pushMess($title='测试',$content='测试信息',$phone){  

		vendor('Jpush.Jpush');  
		$pushObj = new \Jpush();  
		//组装需要的参数  
		//$receive = 'all';     //全部  
		//$receive = array('tag'=>array('1','2','3'));      //标签  
		$receive = array('alias'=>array($phone));    //别名  

		$m_time = 86400;        //离线保留时间  
		$extras = array("versionname"=>'***', "versioncode"=>'***');   //自定义数组  
		//调用推送,并处理  
		$result = $pushObj->push($receive,$title,$content,$extras,$m_time);  
		if($result){  
			$res_arr = json_decode($result, true);  
			if(isset($res_arr['error'])){   //如果返回了error则证明失败  
				//echo '成功';
				//错误信息 错误码  
				//$this->error($res_arr['error']['message'].'：'.$res_arr['error']['code']);      
			}else{
				//echo '成功';					
				//处理成功的推送......  
				//可执行一系列对应操作~  
				//$this->success('推送成功~');  
			}  
		}else{      
			//echo '成功';
			//接口调用失败或无响应  
			//$this->error('接口调用失败或无响应~');  
		}  
} 
		
/**
 * [M 还原TP3的M函数]
 * @param [type] $tableName [description]
 */
function M($tableName){
	return Db::name($tableName);
}

/**
 *函数名称:encrypt
 *函数作用:加密解密字符串
 *参数说明:
 *$string :需要加密解密的字符串
 *$operation:判断是加密还是解密:E:加密 D:解密
 *$key  :加密的钥匙(密匙);
 *$expiry 秘钥有效期
 */
function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {  
    if($operation == 'DECODE') {
        $string = str_replace('%2B','+',$string);
        $string = str_replace('%26','&',$string);
        $string = str_replace('%2F','/',$string);
    }
    $ckey_length = 4;
    $key = md5($key ? $key : 'livcmsencryption ');
    $keya = md5(substr($key, 0, 16));
    $keyb = md5(substr($key, 16, 16));
    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';
    $cryptkey = $keya.md5($keya.$keyc);
    $key_length = strlen($cryptkey);
    $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
    $string_length = strlen($string);
    $result = '';
    $box = range(0, 255);
    $rndkey = array();
    for($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
    }
    for($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }
    for($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }
    if($operation == 'DECODE') {
        if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
    
            return substr($result, 26);
        } else {
            return '';
        }
    } else {
        $ustr = $keyc.str_replace('=', '', base64_encode($result));
        $ustr = str_replace('+','%2B',$ustr);
        $ustr = str_replace('&','%26',$ustr);
        $ustr = str_replace('/','%2F',$ustr);
        return $ustr;
    }
}

/**
 * [work_tree_more 分类树 多维]
 * @param  [type] $arr [description]
 * @param  string $pid [description]
 * @return [type]      [description]
 */
function node_tree($arr,$pid=0){
	
	if (!isset($reArray)) {
    	$reArray = [];
	}      
    $rows = get_node_son($arr,$pid);
    if($rows){          
        foreach($rows as $row){
            $tmp = node_tree($arr,$row['node_id']);          
            $tmp = $tmp ? $tmp : [];
            $row['child'] = $tmp;
            $reArray[] = $row;                
        }
    }
    return $reArray;        
}

/**
 * [get_son 获取子类]
 * @param  [type] $arr [description]
 * @param  string $pid [description]
 * @return [type]      [description]
 */
function get_node_son($arr,$pid=0){
    $tmp = array();
    foreach($arr as $k => $row){
        if($row['pid'] == $pid){
            $tmp[] = $row;
        }
    }
    return $tmp;
}