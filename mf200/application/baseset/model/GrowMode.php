<?php

namespace app\baseset\model;
use think\Model;
use think\Db;

class GrowMode extends Model {
	
	private $db;
	
	public function initialize() {
		
		$this->db	= Db::name('GrowMode');
	}
	
	public function getAllModes() {
		
		$results	= $this->db->where('status', 1)->select();
		return $results;
	}
	
	public function getModeById($id) {
		
		$result	= $this->db->field('mode_id, mode_name')->where(['mode_id' => $id, 'status' => 1])->find();
		return $result;
	}
}