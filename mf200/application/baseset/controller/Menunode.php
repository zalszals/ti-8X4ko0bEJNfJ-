<?php
/**
 * 权限菜单管理
 * @author Chen Chao
 *
 */
namespace app\baseset\controller;
use app\base\controller\Base;
use think\Loader;

class Menunode extends Base {
	
	/**
	 * 获取所有一级菜单
	 * @return json
	 */
	public function index() {
		
		$menunode	= Loader::model('MenuNode');
		
		$results	= $menunode->getMenuByLevel(1);
		
		return json($results);
	}
	
	/**
	 * 获取某部门下权限菜单列表
	 */
	public function lists() {
		
		$groupId	= trim(request()->param('group_id'));
		
		if (!is_numeric($groupId)) return json(['status' => 0, 'msg' => '参数错误']);
		
		$menuNode	= Loader::model('MenuNode');
		$nodes		= $menuNode->getNodesByGroupId($groupId);
		
		return json(['status' => 1, 'total' => count($nodes), 'data' => $nodes]);
	}
}