<?php

namespace app\home\model;
use think\Model;
use think\Db;

class Worker extends Model {

	private $db;
	
	public function initialize() {
		
		$this->db	= Db::name('worker');
	}

	public function getworker($role_id) {
		
		$result	= $this->db->where(['role_id' => $role_id, 'status' => 1])->find();
		
		return $result;
	}

}