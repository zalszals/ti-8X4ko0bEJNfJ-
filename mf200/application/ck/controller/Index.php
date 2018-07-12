<?php
namespace app\ck\controller;

class Index {

	public function Index(){
		$co['group_id']=2;
		$db=db('role');
		$res=$db->where($co)->select();
		print_r($res);
//		$re['status']=1;
//		$re['data']['info']='成功';
//		$re['data']['list']=$res;
//		ajaxReturnJson($re);
//		return 0;
	}
}
