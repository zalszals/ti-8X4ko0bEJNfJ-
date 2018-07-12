<?php

namespace app\baseset\model;
use think\Model;
use think\Db;

class MenuNode extends Model {
	
	private $db;
	
	public function initialize() {
		
		$this->db	= Db::name('MenuNode');
	}
	
	public function getMenuByLevel($level) {
		
		if (!is_numeric($level)) return array();
		
		$results	= $this->db->field('node_id,title')->where(['status' => 1, 'level' => $level])->order('node_id')->select();
		
		return $results;
	}
	
	public function getNodesByGroupId($groupId) {
		
		if (!is_numeric($groupId)) return array();
		
		/* $results	= $this->db->where(['group_id' => $groupId, 'status' => 1])->order('node_id')->select(); */ /* 3/16 */
		$results	= $this->db->where(['group_id' => $groupId])->order('node_id')->select();
		
		if (empty($results)) return array();
		
		$modules	 = [];
		$controllers = [];
		$actions	 = [];
		
		
		foreach ($results as $value) {
			
			if ($value['level'] == 1) {
				
				$modules[] = $value;
			}
			
			if ($value['level'] == 2) {
				
				$controllers[] = $value;
			}
			
			if ($value['level'] == 3) {
				
				$actions[] = $value;
			}
			
		}
		
		
		
		/* foreach ($modules as $module) {
			
			$m['node_id']	= $module['node_id'];
			$m['title']		= $module['title'];
			$m['child']		= [];
			
			foreach ($controllers as $controller) {
				
				$c	= [];
				
				if ($controller['pid'] == $module['node_id']) {
					
					$c['node_id']	= $controller['node_id'];
					$c['title']		= $controller['title'];
					$c['child']		= [];
					
					foreach ($actions as $action) {
						
						$a	= [];
						
						if ($action['pid'] == $controller['node_id']) {
							
							$a['node_id']	= $action['node_id'];
							$a['title']		= $action['title'];
						}
						
						$c['child'][] = $a;
					}
				}
				$m['child'][]	= $c;
			}
			
			$data[]	= $m;
		} */
		
		foreach ($controllers as $controller) {
		
			$c	= [];
			$c['node_id']	= $controller['node_id'];
			$c['title']		= $controller['title'];
			$c['child']		= [];
					
			foreach ($actions as $action) {
		
				$a	= [];
		
				if ($action['pid'] == $controller['node_id']) {
							
					$a['node_id']	= $action['node_id'];
					$a['title']		= $action['title'];
				}
		
				if (!empty($a)) {
					
					$c['child'][] = $a;
				}
				
			}
			
			if (!empty($c)) {
				$data[]	= $c;
			}
		}
		
		return (isset($data)) ? $data : array();
	}
}