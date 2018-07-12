<?php
namespace app\publics\controller;
use app\base\controller\Base;
use think\Db;
class Publics extends Base{
	
	/**
     * [groups_list 部门列表接口]
     * @return [type] [description]
     */
	public function groups_list(){
		//程序主体
		$data = Db::name('group')->select();
		if($data){
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $data;
			ajaxReturnJson($result);
		}else{
			$result['status'] = 0;
			$result['msg'] = "获取失败";
			$result['data'] = '';
			ajaxReturnJson($result);
		}
		
	}
	/**
     * [wg_list 按部门显示人员列表接口]
     * @return [type] [description]
     */
	public function wg_list(){
		//获取变量
		$group_id = $this->request->param('group_id');
		
		//验证变量
		if(!$group_id){
			$result['status'] = 0;
			$result['msg'] = "部门id为空";
			ajaxReturnJson($result);
		}
		//程序主体
		$con['group_id'] = $group_id;
		$con['status'] = array('neq',0);
		
		
		$field[] = 'worker_id';
		//$field[] = 'status';
		$field[] = 'worker_name';
		$field[] = 'group_id';
		$field1[] = 'group_name';
		$field[] = 'role_id';
		$field2[] = 'role_name';
		
		
		$workers = Db::view('mf_worker w',$field)
		
				->view('mf_group g',$field1,'w.group_id = g.group_id')
				->view('mf_role r',$field2,'r.role_id = w.role_id')
				//->field(implode(',',$field))
				->where($con)
				->select();
		
		if($workers){
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $workers;
			ajaxReturnJson($result);
		}else{
			$result['status'] = 0;
			$result['msg'] = "获取失败";
			$result['data'] = '';
			ajaxReturnJson($result);
		}
	}
	
}




