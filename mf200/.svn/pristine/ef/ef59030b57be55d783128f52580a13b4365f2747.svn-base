<?php
/**
 * 部门管理
 */
namespace app\baseset\controller;
use app\base\controller\Base;
use think\Loader;

class Group extends Base {
	
	/*
	 * 根据部门名称获取部门ID
	 */
	public function id() {
		
		$groupName	= trim(request()->param('group_name'));
		
		if (!$groupName) {
			
			return json(['status' => 0, 'msg' => '部门名称错误']);
		}
		
		$groupModel	= Loader::model('Group');
		
		$groupId	= $groupModel->getGroupIdByName($groupName);
		
		return ($groupId) ? json(['status' => 1, 'group_id' => $groupId]) : json(['status' => 0, 'msg' => '该部门不存在']);
	}
	
	/*
	 * 获取部门列表
	 */
	public function lists() {
		
		$groupModel	= Loader::model('Group');
		$groups		= $groupModel->getAllGroups();
		
		return json(['status' => 1, 'data' => $groups]);
	}
}