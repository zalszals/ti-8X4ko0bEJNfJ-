<?php

namespace app\home\controller;
use app\base\controller\Base;
use think\Loader;
use think\Db;
class Role extends Base {
	
	public function add() {
		
		$groupModel	= Loader::model('group');
		
		$roles	= $groupModel->getAll();

		$worker = $this->worker;
		$phone = trim($worker['phone']);
		$token = trim($worker['token']);
		$this->assign('phone', $phone);
		$this->assign('token', $token);
		
		$this->assign('roles', $roles);
		
		return $this->fetch();
	}
	
	public function edit() {
		
		$roleid	= trim(request()->param('role_id'));
		
		if (!is_numeric($roleid)) {
			
			$this->error("职务ID错误");
			exit();
		}
		
		$roleModel	= Loader::model('Role');
		
		if (!$roleModel->get($roleid)) {
			
			$this->error("该职务不存在");
			exit();
		}
		$workers = $this->worker;
		$phone = trim($workers['phone']);
		$token = trim($workers['token']);
		$this->assign('phone', $phone);
		$this->assign('token', $token);
		
		$role	= $roleModel->getRoleById($roleid);
		$this->assign('role', $role);
		
		$groupModel	= Loader::model('group');
		$roleLists	= $groupModel->getAll();
		
		$this->assign('roles', $roleLists);
		
		$menuNode	= Loader::model('MenuNode');
		$menus		= $menuNode->getNodesByGroupId($role['group_id']);
		
		$this->assign('menus', $menus);
		$this->assign('group_id', $role['group_id']);
		
		return $this->fetch();
	}
	
	public function lists() {
		
		$groupModel	= Loader::model('Group');
		$grouplists	= $groupModel->getAll();
		$worker = $this->worker;
		$phone = trim($worker['phone']);
		$token = trim($worker['token']);
		$arr = array();

		foreach($grouplists as $k=>$v){
			if($v['group_id'] != 1){
				$arr[] = $v;
			}
		}

		$this->assign('grouplists', $arr);
		$this->assign('phone', $phone);
		$this->assign('token', $token);
		
		return $this->fetch();
	}
	
	public function save() {
		
		$groupid	= trim(request()->param('group_id'));
		$rolename	= trim(request()->param('role_name'));
		$nodestr	= trim(request()->param('node_str'));
		
		
		$node_info = Db::name('menu_node')->field(['node_id'])->where('job_status = 2 ')->select(); // 查询所有作物分类
		$node_array = array();
		foreach($node_info as $k=>$v){
			array_push($node_array,$v['node_id']);
		}
		
		$check_array = $nodestr;
		$check_array = explode(',',$check_array);
		$flag = 2;  
		foreach ($check_array as $va) {  
			if (in_array($va, $node_array)) {  
				continue;  
			}else {  
				$flag = 1;  
				break;  
			}  
		}  

		$roleModel	= Loader::model('Role');
		
		$result	= $roleModel->getRole($groupid, $rolename);

		if ($result) {
			
			return '该部门已存在此职务，不能重复添加';
		} else {
			
			$roleModel->data(['role_name' => $rolename, 'group_id' => $groupid, 'node_str' => $nodestr,'job_status'=> $flag]);
			$roleModel->save();
			
			return '添加成功';
		}
	}
	
	public function editsave() {
		
		$roleid		= trim(request()->param('role_id'));
		$rolename	= trim(request()->param('role_name'));
		$nodestr	= trim(request()->param('node_str'));
		
		$node_info = Db::name('menu_node')->field(['node_id'])->where('job_status = 2 ')->select(); // 查询所有作物分类
		$node_array = array();
		foreach($node_info as $k=>$v){
			array_push($node_array,$v['node_id']);
		}
		
		$check_array = $nodestr;
		$check_array = explode(',',$check_array);
		$flag = 2;  
		foreach ($check_array as $va) {  
			if (in_array($va, $node_array)) {  
				continue;  
			}else {  
				$flag = 1;  
				break;  
			}  
		}  
		
		
		
		$roleModel	= Loader::model('Role');
		
		if (!$roleModel->get($roleid)) {
			
			return "该职务不存在";
		} else {
			
			$roleModel->save(['role_name' => $rolename, 'node_str' => $nodestr,'job_status'=> $flag], ['role_id' => $roleid]);
			return "修改成功";
		}
	}
	
	public function ajaxReturnR() {
		
		$groupid = trim(request()->param('group_id'));
		
		if (!is_numeric($groupid)) {
			
			return json(['status' => 0, 'msg' => '错误ID']);
		} else {
			
			$roleModel	= Loader::model('role');
			$roles		= $roleModel->getRoles($groupid);
			
			if (empty($roles)) {
				
				return json(['status' => 0, 'msg' => '没有职务', 'data' => []]);
			} else {
				
				$results	= $this->_toResults($roles);
				return json(['status' => 1, 'data' => $results]);
			}
		}
	}
	
	private function _toResults($roles) {
		
		$results	= [];
		$menuNode	= Loader::model('MenuNode');
		
		foreach ($roles as $role) {
			
			$item['role_id']	= $role['role_id'];
			$item['role_name']	= $role['role_name'];
			$item['node_arr']	= $menuNode->nodeStrToArr($role['node_str']);
			
			$results[]	= $item;
		}
		
		return $results;
	}

	public function del(){

		$role_id	= trim(request()->param('role_id'));

		$role_model		= Loader::model('Role');
		$worker_model	= Loader::model('Worker');
		
		if (!$role_model->getRoleById($role_id)) {
			
			return json(['status' => 0, 'msg' => "该职务不存在"]);
		}
		
		if ($worker_model->getworker($role_id)) {
			
			return json(['status' => 0, 'msg' => "该职务还有人员使用，暂不能删除"]);
		}
		
		$role_model->delRole($role_id);
		
		return json(['status' => 1, 'msg' => "删除成功"]);
	}
}