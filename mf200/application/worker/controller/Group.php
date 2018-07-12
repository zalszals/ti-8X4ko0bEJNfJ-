<?php
namespace app\worker\controller;

use app\base\controller\Base;
use think\Db;
use think\Request;

class Group extends Base{

	// 部门列表
    public function group_list(){

    	$group = array();

    	$group = Db::name('group')->field('group_id,group_name')->where('is_buy',1)->select();

        return json(['status'=>1,'msg'=>'查询成功','data'=>$group]);

    }

    // 部门添加
    public function group_add(){

        $data['group_name'] = request()->param('group_name');

        if(!$data['group_name']){

        	return json(['status'=>0,'msg'=>'请输入部门名称']);
        }

        $re = Db::name('group')->insert($data);

        if($re){

        	return json(['status'=>1,'msg'=>'添加成功']);	

        }else{

        	return json(['status'=>0,'msg'=>'添加失败']);

        }

    }

     // 部门修改
    public function group_edit(){

    	$group_id = request()->param('group_id');


    	if(!$group_id){

    		return json(['status'=>0,'msg'=>'部门id有误']);
    	}

		$group_name = request()->param('group_name');

		if(!$group_name){

			return json(['status'=>0,'msg'=>'请输入部门名称']);
		}

		$re = Db::name('group')->where('group_id',$group_id)->setField('group_name',$group_name);

		if($re){

        	return json(['status'=>1,'msg'=>'修改成功']);	

        }else{

        	return json(['status'=>0,'msg'=>'修改失败']);

        }

    }

    // 部门删除
    public function group_del(){

    	$group_id = request()->param('group_id');

    	if(!$group_id){

    		return json(['status'=>0,'msg'=>'部门id有误']);
    	}

    	$find = Db::name('worker')->where('group_id',$group_id)->find();

    	if($find){

    		return json(['status'=>0,'msg'=>'部门下存在员工，不允许删除！']);
    	}

    	$re = Db::name('group')->where('group_id',$group_id)->delete();

    	if($re){

	        return json(['status'=>1,'msg'=>'删除成功']);	

	    }else{

	        return json(['status'=>0,'msg'=>'删除失败']);

	    }

    }

}