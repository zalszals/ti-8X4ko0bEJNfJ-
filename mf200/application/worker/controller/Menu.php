<?php
namespace app\worker\controller;

use app\base\controller\Base;
use think\Db;
use think\Request;

class Menu extends Base{

	//主界面菜单
	public function get_menu(){

		$group = Db::name('group')->where('is_buy',1)->field('group_id,group_name')->select();

		$menuArr = array();

		if($group){

			foreach($group as $k=>$v){

				$menuArr[$k]['group_id'] = $v['group_id'];
				$menuArr[$k]['group_name'] = $v['group_name'];
			}

		}

		return json(['status'=>1,'msg'=>'查询成功','data'=>$menuArr]);
	}
}