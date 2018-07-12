<?php
namespace app\home\controller;
use app\home\controller\Base;
use think\Loader;

class MenuNode extends Base {
	
	public function lists() {
		
		$groupId	= trim(request()->param('group_id'));
		
		if (!is_numeric($groupId)) return json(['status' => 0, 'msg' => '参数错误']);
		
		$menuNode	= Loader::model('MenuNode');
		$nodes		= $menuNode->getNodesByGroupId($groupId);
		
		return json(['status' => 1, 'total' => count($nodes), 'data' => $nodes ,'group_id' => $groupId]);
	}
}