<?php

namespace app\baseset\model;
use think\Model;
use think\Db;

class Role extends Model {
	
	private $db;
	
	public function initialize() {
		
		$this->db	= Db::name('role');
	}
	
	public function getRolesByGroupId($group_id) {
		
		if (!is_numeric($group_id)) return array();
		
		$results	= $this->db->field('*')->where('group_id', $group_id)->select();
		
		return $results;
	}
}