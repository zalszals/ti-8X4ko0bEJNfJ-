<?php
namespace app\baseset\controller;
use app\base\controller\Base;
use think\Controller;
use think\Db;
class Bccc extends Base{

	/**
	 * [index 登录]
	 * @return [type] [description]
	 */
    public function index(){    
        return '验证ok了';
    }

    /**
     * [get_group_str description]
     * @return [type] [description]
     */
    public function get_group_str()
    {
    	$role_id = 1;//$this->request->param('role_id');
    	$info = db('role')->where('role_id',$role_id)->field('group_str')->find();
    	
    	$re['data'] = $info['group_str']; 
    	$re['status'] = 1;
    	$re['msg'] = '查询成功';   	
    	ajaxReturnJson($re);
    }
	
}
