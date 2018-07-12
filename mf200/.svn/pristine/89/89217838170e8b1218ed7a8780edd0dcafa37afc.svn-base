<?php

namespace app\home\model;
use think\Model;
use think\Db;

class MenuNode extends Model {
	
	private $db;
	
	public function initialize() {
		
		$this->db	= Db::name('MenuNode');
	}
	
	public function nodeStrToArr($node_str) {
		
		$arr	= explode(',', $node_str);
		$cs		= [];
		$as		= [];
		
		foreach ($arr as $value) {
			
			$menuNode	= $this->db->where(['node_id' => $value, 'status' => 1])->find();
			
			if ($menuNode) {
				
				if ($menuNode['level'] == 2) {
					
					$cs[]	= $menuNode;
				}
				
				if ($menuNode['level'] == 3) {
					
					$as[]	= $menuNode;
				}
			}
		}
		
		$results	= [];
		
		foreach ($cs as $value) {
			
			$item['node_id']	= $value['node_id'];
			$item['title']		= $value['title'];
			$item['child']		= [];
			
			foreach ($as as $val) {
				
				if ($val['pid'] == $value['node_id']) {
					
					$ass['node_id']	= $val['node_id'];
					$ass['title']	= $val['title'];
					
					$item['child'][]	= $ass;
				}
			}
			
			$results[] = $item;
		}
		
		return $results;
	}
	
	public function getNodesByGroupId($groupId) {
		
		if (!is_numeric($groupId)) return array();
		$condition['group_id'] = $groupId == 1 ? array('gt',0) : $groupId;
		$condition['status'] = array('in',[1,2,3]);
		$results	= $this->db->where($condition)->whereOr('group_id',0)->select();
		
		if (empty($results)) return array();
		
		$modules	 = [];
		$controllers = [];
		$actions	 = [];
		$data		 = [];
		//print_r($results);
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
			$c['job_status']= $controller['job_status'];
			$c['child']		= [];
					
			foreach ($actions as $action) {
		
				$a	= [];
		
				if ($action['pid'] == $controller['node_id']) {
							
					$a['node_id']	= $action['node_id'];
					$a['title']		= $action['title'];
					$a['job_status']		= $controller['job_status'];
				}
		
				if (!empty($a)) {
					
					$c['child'][] = $a;
				}
				
			}
			
			if (!empty($c)) {
				$data[]	= $c;
			}
		}
		
		return $data;
	}
}