<?php

namespace app\home\model;
use think\Model;
use think\Db;

class Group extends Model {
	
	private $db;
	
	public function initialize() {
		
		$this->db	= Db::name('Group');
	}
	
	public function getAll() {
		
		$results	= $this->db->field('*')->where('is_buy',1)->where('group_id','neq',1)->select();
		return $results;
	}
}