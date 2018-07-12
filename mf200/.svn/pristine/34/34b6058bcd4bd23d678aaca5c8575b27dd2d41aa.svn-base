<?php

namespace app\baseset\model;
use think\Model;
use think\Db;

class Worker extends Model {
	
	private $db;
	
	public function initialize() {
		
		$this->db	= Db::name('worker');
	}
	
	public function getWorkersByRoleId($role_id) {
		
		if (!is_numeric($role_id)) return array();
		
		$workers	= $this->db->where('role_id', $role_id)->select();
		
		return $workers;
	}
}