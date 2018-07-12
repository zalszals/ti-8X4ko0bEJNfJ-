<?php

namespace app\baseset\model;
use think\Model;
use think\Db;

class GrowType extends Model {
	
	private $db;
	
	public function initialize() {
		
		$this->db	= Db::name('GrowType');
	}
	
	public function getAllType() {
		
		$results	= $this->db->field('id, type_name')->where('status', 'NEQ', 0)->select();
		
		return $results;
	}

	public function getType($type) {
		
		$results = $this->db->field('id, type_name')->where('status', 'NEQ', 0)->where('type_name','like'.'%'.$type['type_name'].'%')->select();
		
		return $results;
	}
}