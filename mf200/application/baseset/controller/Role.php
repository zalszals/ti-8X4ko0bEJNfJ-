<?php

namespace app\baseset\controller;
use app\base\controller\Base;
use think\Loader;
use think\Db;

class Role extends Base {
	
	public function lists() {
		
		$group_id	= trim(request()->param('group_id'));
		
		//载入model
		$roleModel	= Loader::model('Role'); 
		
		$results	= $roleModel->getRolesByGroupId($group_id);
		
		if (empty($results)) {
			
			return json(['status' => 0, 'msg' => '部门ID错误']);
		}
		
		foreach ($results as $result) {
			
			$value['role_id']	= $result['role_id'];
			$value['role_name']	= $result['role_name'];
			
			$node_str	= $result['node_str'];
			$node_arr	= explode(',', $node_str);
			
			$data				= $this->_findChildren($node_arr);
			$value['menu_node'] = $data;
			
			$rolelist[] = $value;
		}
		
		return json(['status' => 1, 'msg' => '成功', 'data' => $rolelist]);
	}
	
	private function _findChildren($node_arr) {
		
		if (!$node_arr) return array();
		
		$nodeModel	 = Loader::model('MenuNode');
		
		$modules	 = array();
		$controllers = array();
		$actions	 = array();
		$results	 = array();
		
		foreach ($node_arr as $node_id) {
			
			$node_info	= $nodeModel->get(['node_id' => $node_id, 'status' => 1])->getData();
			
			if ($node_info['level'] == 1) {
				
				$modules[]	= $node_info;
			}
			
			if ($node_info['level'] == 2) {
				
				$controllers[]	= $node_info;
			}
			
			if ($node_info['level'] == 3) {
				
				$actions[]	= $node_info;
			}
		}
		
		foreach ($modules as $v) {
			
			$data['m']	= $v['title'];
			$data['c']	= [];
			
			foreach ($controllers as $val) {
				
				$cc	= '';
				
				if($val['pid'] == $v['node_id']) {
					
					$cc	= $cc.$val['title'].':';
					
					foreach ($actions as $value) {
						
						if ($value['pid'] == $val['node_id']) {
							
							$cc = $cc.$value['title'].',';
						}
					}
				}
				
				$data['c'][] = $cc;
			}
			
			$results[]	= $data;
		}
		
		return $results;
	}
	
	public function add() {
		
		$group_id	= trim(request()->param('group_id'));
		$role_name	= trim(request()->param('role_name'));
		$node_str	= trim(request()->param('node_str'));
		
		if (!$group_id || !$role_name || !$node_str) {
				
			return json(['status' => 0, 'msg' => "参数不完整"]);
		}
		
		$role_model		= Loader::model('Role');
		$group_model	= Loader::model('Group');
		
		if (!$group_model->get(['group_id' => $group_id])) {
			
			return json(['status' => 0, 'msg' => "部门不存在"]);
		}
		
		if ($role_model->get(['group_id' => $group_id, 'role_name' => $role_name])) {
			
			return json(['status' => 0, 'msg' => "该职务已存在，请换一个名字"]);
		}
		
		$data	= array(
			'group_id'	=> $group_id,
			'role_name'	=> $role_name,
			'node_str'	=> $node_str
		);
		
		$role_model->data($data);
		$role_model->save();
		
		return json(['status' => 1, 'msg' => "成功"]);
	}
	
	public function edit() {
		
		$role_id	= trim(request()->param('role_id'));
		$role_model	= Loader::model('Role');
		
		if (!$role_model->get($role_id)) {
			
			return json(['status' => 0, 'msg' => "该职务不存在"]);
		}
		
		$role_name	= request()->param('role_name');
		$node_str	= request()->param('node_str');
		
		if ($role_name && !$node_str) {
			
			$result	= $role_model->save(['role_name' => trim($role_name)], ['role_id' => $role_id]);
			$return	= ($result) ? ['status' => 1, 'msg' => "修改成功"] : ['status' => 0, 'msg' => "修改失败"];
			return json($return);
		}
		
		if ($node_str && !$role_name) {
			
			$result = $role_model->save(['node_str' => trim($node_str)], ['role_id' => $role_id]);
				
			if (!$result) {
			
				return json(['status' => 0, 'msg' => "修改失败"]);
			}
				
			$worker_model		= Loader::model('Worker');
			$worker_node_model	= Loader::model('WorkerNode');
			$workers			= $worker_model->getWorkersByRoleId($role_id);
				
			if (!empty($workers)) {
			
				foreach ($workers as $worker) {
						
					$worker_node_model->save(['node_str' => $node_str], ['worker_id' => $worker['worker_id']]);
				}
			}
				
			return json(['status' => 1, 'msg' => "修改成功"]);
		}
		
		if ($role_name && $node_str) {
			
			$result	= $role_model->save(['role_name' => trim($role_name), 'node_str' => trim($node_str)], ['role_id' => $role_id]);
			
			if (!$result) {
				
				return json(['status' => 0, 'msg' => "修改失败"]);
			}
			
			$worker_model		= Loader::model('Worker');
			$worker_node_model	= Loader::model('WorkerNode');
			$workers			= $worker_model->getWorkersByRoleId($role_id);
			
			if (!empty($workers)) {
				
				foreach ($workers as $worker) {
					
					$worker_node_model->save(['node_str' => $node_str], ['worker_id' => $worker['worker_id']]);
				}
			}
			
			return json(['status' => 1, 'msg' => "修改成功"]);
		}
	}
	
	public function del() {
		
		$role_id	= trim(request()->param('role_id'));
		
		$role_model		= Loader::model('Role');
		$worker_model	= Loader::model('Worker');
		
		if (!$role_model->get($role_id)) {
			
			return json(['status' => 0, 'msg' => "该职务不存在"]);
		}
		
		if ($worker_model->get(['role_id' => $role_id])) {
			
			return json(['status' => 0, 'msg' => "该职务还有人员使用，暂不能删除"]);
		}
		
		$role	= $role_model->get($role_id);
		$role->delete();
		
		return json(['status' => 1, 'msg' => "删除成功"]);
	}

	
	// 职务列表 pc端使用 true
	public function pc_lists() {
		
		
		$group_id	= trim(request()->param('group_id'));

		if($group_id){
			$data['group_id']=$group_id;					
		}else{
			$data=array();
		}

		$newsql=Db::name('role')
		->alias('a')
		->join('group b','a.group_id=b.group_id')
		->where($data)
		->where('a.status',0)
		->select();
		
		$result= array();$arr= array();
	    foreach ($newsql as $k => $v) {

	        $result[$v['group_id']][]= $v;
	        $arr[$v['group_id']]['group_name']=$v['group_name'];
	        $arr[$v['group_id']]['group_id']=$v['group_id'];
	        $arr[$v['group_id']]['child']=$result[$v['group_id']];
	    }
	    
	   

	    /*foreach ($newsql as $key => $value) {
	    	$arr[$key]['name']=$value['group_name'];
	    	$arr[$key]['group_id']=$value['group_id'];
	    	$arr[$key]['child']=$result[$value['group_id']];
	    }*/
	    

		if($newsql){
			return json(['status'=>1,'msg'=>"查询成功",'data'=>$arr]);	
		}else{
			return json(['status'=>0,'msg'=>"查询失败"]);	
		}
		
	}




}