<?php
namespace app\login\controller;
use think\Controller;
use think\Db;

class Login extends Controller{

	/**
	 * [index 登录]
	 * @return [type] [description]
	 */
    public function index(){    
        return '非法请求';
    }

	/**
	 * [login 登录]
	 * @return [type] [description]
	 */
    public function login(){
    	//接受变量    
        $phone = $this->request->param('phone');
        $token = $this->request->param('token');
        $prex  = $this->request->param('prex');
        $re = array();
        //验证手机
        if(!$phone){
        	$re['status'] = 0;
        	$re['msg'] = '无效的传值01';
        }
        //验证token
        if(!$token){
        	$re['status'] = 0;
        	$re['msg'] = '无效的传值02';
        }

        //验证账号包前缀
        if(!$prex){
            $re['status'] = 0;
            $re['msg'] = '无效的传值03';
        }
        if($re){
        	return json($re);
            exit;
        }

        $db = Db::table('mf_worker');
        
        //更新用户token
        $db->where('phone',$phone)->setField('token',$token);	

        //查询用户信息
        $row = Db::table('mf_worker')->alias('w')
        		->join('__GROUP__ g','g.group_id = w.group_id')
        		->join('__ROLE__ r','r.role_id = w.role_id')
        		->field('w.*,r.*,g.group_name,g.router_url,g.group_id')
        		->where('w.phone',$phone)->find();
               
        //session_id($token);
        //session_start();
        $_SESSION['worker'] = $row;
        $_SESSION['worker']['prex'] = $prex;
        $re['status'] = 1;
        $re['msg']    = '登录成功';
        $re['data']   = $_SESSION['worker'];
        return json($re);
    }

    /**
     * [get_menu 获取用户菜单]
     * @return [type] [description]
     */
    public function get_menu(){
    	$re = array();
    	return $re;
/*        session_start();

        $k=0;

        $menuArr =  array();
 

        if(strpos($_SESSION['worker']['node_str'],'100') !== false){
            $menuArr[$k]['name'] = '生产计划列表';
            $menuArr[$k]['url'] = '';
            $k++;
        }
        if(strpos($_SESSION['worker']['node_str'],'150') !== false){
            $menuArr[$k]['name'] = '生产任务列表';
            $menuArr[$k]['url'] = '';
            $k++;
        }

        if(strpos($_SESSION['worker']['node_str'],'151') !== false){
            $menuArr[$k]['name'] = '种植任务列表';
            $menuArr[$k]['url'] = '';
            $k++;
        }
        if(strpos($_SESSION['worker']['node_str'],'63') !== false){
            $menuArr[$k]['name'] = '产量及分拣';
            $menuArr[$k]['url'] = '';
            $k++;
        }
        $data['status'] = 1;
        $data['msg'] = '获取成功';
        $data['menu'] = $menuArr;
        return json($data);*/
    }
}
