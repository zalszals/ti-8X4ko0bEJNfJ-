<?php
namespace app\baseset\model;
use think\Model;
use think\Db;

class GrowArea extends Model {
	
	private $db;
	
	public function initialize() {
		
		$this->db	= Db::name('GrowArea');
	}
	
	public function getGrowAreaById($id) {
		
		if (!is_numeric($id)) return array();
		
		$result	= $this->db->where(['area_id' => $id, 'status' => 1])->find();
		
		return ($result) ? $result : array();
	}
	
	public function getAllAreas() {
		
		$results	= $this->db->where(['status' => 1])->select();
		return $results;
	}
	
	public function getListsByGTypeId($id) {
		
		$results	= $this->db->where(['status' => 1, 'g_type_id' => $id])->order('area_id asc')->select();
		return $results;
	}
}