<?php
namespace app\public\controller;
use app\base\controller\Base;
use think\Db;
class Publics extends Base{
	
	/**
     * [groups_list 部门列表接口]
     * @return [type] [description]
     */
	public function groups_list(){//
		//程序主体
		$data = Db::name('group')->select();
		if($data){
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			ajaxReturnJson($result);
		}else{
			$result['status'] = 0;
			$result['msg'] = "获取失败";
			ajaxReturnJson($result);
		}
		
	}
	
}




