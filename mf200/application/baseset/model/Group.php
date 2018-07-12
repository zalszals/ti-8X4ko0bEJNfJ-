<?php

namespace app\baseset\model;
use think\Model;
use think\Db;

class Group extends Model {
	
	private $db;
	
	public function initialize() {
		
		$this->db	= Db::name('group');
	}
	
	public function getGroupIdByName($name) {
		
		if (!$name) return 0;
		
		$result	= $this->db->where('group_name', $name)->find();
		
		return (empty($result)) ? 0 : $result['group_id'];
	}
	
	public function getAllGroups() {
		
		$results	= $this->db->select();
		return $results;
	}
}