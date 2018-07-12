<?php

namespace app\home\model;
use think\Model;
use think\Db;

class Role extends Model {
	
	private $db;
	
	public function initialize() {
		
		$this->db	= Db::name('role');
	}
	
	public function getRole($group_id, $role_name) {
		
		$result	= $this->db->where(['role_name' => $role_name, 'group_id' => $group_id ,'status' => 0])->find();
		
		return $result;
	}
	
	public function getRoleById($role_id) {
		
		$result	= $this->db->where('role_id', $role_id)->find();
		
		return $result;
	}
	
	public function getRoles($group_id) {
		
		$results	= $this->db->where(['group_id'=>$group_id, 'status'=>0])->select();
		return $results;
	}

	public function delRole($role_id) {
		
		$results	= $this->db->where('role_id', $role_id)->setField('status',-1);
		return $results;
	}

}