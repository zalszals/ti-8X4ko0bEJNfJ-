<?php

namespace app\pc\controller;
use app\home\controller\Base;
use think\Controller;
use think\Loader;
use think\Db;
class Role extends Base {
	
	public function rolelist() {

		$grouplists	= Db::name('group')->field('group_id,group_name')->where('is_buy',1)->where('group_id','neq',1)->select();
		$group_id = request()->param('group_id');
		if($group_id){
			$g = $group_id;
		}else{
			$g = $grouplists[0]['group_id'];
		}
		$role = Db::name('role')->field('role_id,role_name')->where('status',0)->where('group_id',$g)->paginate(30);
		$page = $role->render();
        $list = $role->items();        
        $jsonStr = json_encode($role);
        $info = json_decode($jsonStr,true);
        $pages = $info['last_page']; 
        $page_list = array();
        $page_list['page'] = $page;
        $page_list['pages'] = $pages;
        $page_list['group_id'] = $g;
		if($info['data']){
			return json(['status' => 1,'msg' => "查询成功",'total'=>$page_list,'group'=>$grouplists,'role'=>$info['data']]);
		}else{
			return json(['status' => 1,'msg' => "查询成功",'total'=>$page_list,'group'=>$grouplists,'role'=>array()]);
		}
	}

	public function add() {
		$grouplists	= Db::name('group')->field('group_id,group_name')->where('is_buy',1)->where('group_id','neq',1)->select();	
		if($grouplists){
			return json(['status' => 1,'msg' => "查询成功",'group'=>$grouplists]);
		}else{
			return json(['status' => 1,'msg' => "查询成功",'group'=>array()]);
		}
	}

	/**
	 * [all_list 节点树]
	 * @return [type] [description]
	 */
	public function all_list(){
		$group_id = $this->request->param('group_id');
		if($group_id != 1){
			$condition['group_id'] = $group_id;
		}else{
			$condition = [];
		}
		$menu_node = db('menu_node')->where($condition)->order('group_id asc')->field('node_id,title,pid,group_id')->select();
		
		$tree = node_tree($menu_node);	
		return json(['status' => 1,'msg' => "查询成功",'data'=>$tree]);
	}

	public function change() {

		$group_id = request()->param('group_id');
		if($group_id){
			$con['group_id'] = $group_id;
			$menu_node = Db::name('menu_node')->where($con)->where('level',2)->order('node_id asc')->field('node_id,title')->select();
			if($menu_node){
				foreach($menu_node as $k=>$v){
					$child = Db::name('menu_node')->where($con)->where('pid',$v['node_id'])->where('level',3)->field('node_id,title')->select();
					if(!$child){
						$child = array();
					}
					$menu_node[$k]['child'] = $child;
				}
			}else{
				$menu_node = array();
			}
			$common = Db::name('menu_node')->where('group_id',0)->where('level',2)->field('node_id,title')->order('node_id asc')->select();
			if($common){
				foreach($common as $k=>$v){
					$child1 = Db::name('menu_node')->where('group_id',0)->where('pid',$v['node_id'])->where('level',3)->field('node_id,title')->select();
					if(!$child1){
						$child1 = array();
					}
					$common[$k]['child'] = $child1;
				}
			}else{
				$common = array();	
			}
		}else{
			$menu_node = array();
			$common  = array();
		}
		return json(['status' => 1,'msg' => "查询成功",'data'=>$menu_node,'common'=>$common]);
	}

	public function lists() {
		
		$grouplists	= Db::name('group')->field('group_id,group_name')->where('is_buy',1)->where('group_id','neq',1)->select();
		
		if($grouplists){
			foreach($grouplists as $k=>$v){
				$role =  Db::name('role')->field('role_id,role_name,node_str')->where('status',0)->where('group_id',$v['group_id'])->select();
				$menu_node = Db::name('menu_node')->where('group_id',$v['group_id'])->where('level',2)->order('node_id asc')->field('node_id,title')->select();
				if($menu_node){
					foreach($menu_node as $k1=>$v1){
						$child = Db::name('menu_node')->where('group_id',$v['group_id'])->where('pid',$v1['node_id'])->where('level',3)->field('node_id,title')->select();
						if(!$child){
							$child = array();
						}
						$menu_node[$k1]['child'] = $child;

					}
				}else{
					$menu_node = array();
				}

				if($role){
					$grouplists[$k]['role'] = $role;
				}else{
					$grouplists[$k]['role'] = array();
				}
				$grouplists[$k]['qx'] = $menu_node;
			}
			$common = Db::name('menu_node')->where('group_id',0)->where('level',2)->field('node_id,title')->order('node_id asc')->select();
			if($common){
				foreach($common as $k=>$v){
					$child1 = Db::name('menu_node')->where('group_id',0)->where('pid',$v['node_id'])->where('level',3)->field('node_id,title')->select();
					if(!$child1){
						$child1 = array();
					}
					$common[$k]['child'] = $child1;
				}
			}else{
				$common = array();	
			}
		}else{
			$grouplists = array();
		}
		return json(['status' => 1,'msg' => "查询成功",'data'=>$grouplists,'common'=>$common]);
	}
	
	/**
	 * [save 职务保存]
	 * @return [type] [description]
	 */
	public function save() {
		
		$groupid	= trim(request()->param('group_id'));
		$rolename	= trim(request()->param('role_name'));
		$nodestr	= trim(request()->param('node_str'));
		$group_str  = NULL;
		
		if(strpos($nodestr,'1') !== false){//生产部
			$group_str .= ',2';
		}
		if(strpos($nodestr,'25') !== false){//人事部
			$group_str .= ',3';
		}
		if(strpos($nodestr,'26') !== false){//仓库部
			$group_str .= ',4';
		}
		if(strpos($nodestr,'27') !== false){//采购部
			$group_str .= ',5';
		}
		if(strpos($nodestr,'28') !== false){//财务部
			$group_str .= ',6';
		}
		if(strpos($nodestr,'32') !== false){//销售部
			$group_str .= ',7';
		}
		if($group_str){
			$group_str = substr($group_str,1);	
		}		
		
		$node_info = Db::name('menu_node')->field(['node_id'])->where('job_status = 2 ')->select(); // 查询所有作物分类
		$node_array = array();
		foreach($node_info as $k=>$v){
			array_push($node_array,$v['node_id']);
		}
		
		$check_array = $nodestr;
		$check_array = explode(',',$check_array);
		$flag = 2;  
		foreach ($check_array as $va) {  
			if (in_array($va, $node_array)) {  
				continue;  
			}else {  
				$flag = 1;  
				break;  
			}  
		}  

		
		$result	= Db::name('role')->where(['role_name' => $rolename, 'group_id' => $groupid,'status' => 0])->find();

		if ($result) {
			return json(['status' => 0,'msg' => "该部门已存在此职务，不能重复添加"]);
		} else {
			
			$re = Db::name('role')->insert(['role_name' => $rolename, 'group_id' => $groupid, 'node_str' => $nodestr,'job_status'=> $flag,'group_str'=>$group_str]);
			
			if($re){
				return json(['status' => 1,'msg' => "添加成功"]);
			}else{
				return json(['status' => 0,'msg' => "添加失败"]);
			}
		}
	}

	public function edit() {

		$roleid		= trim(request()->param('role_id'));
		$grouplists	= Db::name('group')->field('group_id,group_name')->where('is_buy',1)->where('group_id','neq',1)->select();
		$role = Db::name('role')->where('role_id',$roleid)->field('role_id,role_name,node_str,group_id')->find();
		$menu_node = Db::name('menu_node')->where('group_id',$role['group_id'])->where('level',2)->order('node_id asc')->field('node_id,title')->select();
		if($menu_node){
			foreach($menu_node as $k=>$v){
				$child = Db::name('menu_node')->where('group_id',$role['group_id'])->where('pid',$v['node_id'])->where('level',3)->field('node_id,title')->select();
				if(!$child){
					$child = array();
				}
				$menu_node[$k]['child'] = $child;
			}
		}else{
			$menu_node = array();
		}
		$common = Db::name('menu_node')->where('group_id',0)->where('level',2)->field('node_id,title')->order('node_id asc')->select();
		if($common){
			foreach($common as $k=>$v){
				$child1 = Db::name('menu_node')->where('group_id',0)->where('pid',$v['node_id'])->where('level',3)->field('node_id,title')->select();
				if(!$child1){
					$child1 = array();
				}
				$common[$k]['child'] = $child1;
			}
		}else{
			$common = array();	
		}
		if(!$grouplists){
			$grouplists = array();
		}
		if(!$role){
			$role = array();
		}
		return json(['status' => 1,'msg' => "查询成功",'data'=>$grouplists,'role'=>$role,'menu'=>$menu_node,'common'=>$common]);
	}

	public function editsave() {
		
		$roleid		= trim(request()->param('role_id'));
		$rolename	= trim(request()->param('role_name'));
		$nodestr	= trim(request()->param('node_str'));
		
		$node_info = Db::name('menu_node')->field(['node_id'])->where('job_status = 2 ')->select(); // 查询所有作物分类
		$node_array = array();
		foreach($node_info as $k=>$v){
			array_push($node_array,$v['node_id']);
		}
		
		$check_array = $nodestr;
		$check_array = explode(',',$check_array);
		$flag = 2;  
		foreach ($check_array as $va) {  
			if (in_array($va, $node_array)) {  
				continue;  
			}else {  
				$flag = 1;  
				break;  
			}  
		}  
		
		
		
		$result	= Db::name('role')->where('role_id',$roleid)->find();
		
		if (!$result) {
			
			return json(['status' => 0,'msg' => "职务不存在"]);
		} else {
			
			$re = Db::name('role')->update(['role_name' => $rolename, 'node_str' => $nodestr,'job_status'=> $flag,'role_id' => $roleid]);
			
			if($re !== false){
				return json(['status' => 1,'msg' => "修改成功"]);
			}else{
				return json(['status' => 0,'msg' => "修改失败"]);
			}
		}
	}

	public function del(){

		$role_id	= trim(request()->param('role_id'));

		$role = Db::name('role')->where('role_id', $role_id)->find();;
		$worker	= Db::name('worker')->where(['role_id' => $role_id,'status' => 1])->find();

		if (!$role) {
			
			return json(['status' => 0, 'msg' => "该职务不存在"]);
		}
		
		if ($worker) {
			
			return json(['status' => 0, 'msg' => "该职务还有人员使用，暂不能删除"]);
		}
		
		$re = Db::name('role')->where('role_id', $role_id)->setField('status',-1);
		
		if($re !== false){
			return json(['status' => 1, 'msg' => "删除成功",'data'=>$role['group_id']]);
		}else{
			return json(['status' => 0, 'msg' => "删除失败"]);
		}
	}
}