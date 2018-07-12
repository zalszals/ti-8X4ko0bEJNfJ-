<?php
namespace app\product\controller;
use app\base\controller\Base;
use think\Db;

//此控制器为 物料管理——生产领料（控制器）
class ProTake extends Base{
	/**
     * [1 pro_area_list 获取种植区域列表]
     * @return [type] [description]
     */
	public function pro_area_list(){
		$con['pgt.status'] = 2;        //0:未完成 1：已完成
		$pgt_list = Db::name('pro_grow_task pgt')
				  ->join('pro_grow_task_area pgta','pgta.t_id = pgt.t_id')
				  ->join('grow_area ga','ga.area_id = pgta.area_id')
				  ->field('pgta.area_id,ga.area_name')
				  ->where($con)
				  ->select(); 	  
		if($pgt_list){
			foreach($pgt_list as $k=>$v){
				$v = join(",",$v);
				$temp[$k] = $v;
			}
			$temp = array_unique($temp);
			foreach($temp as $k => $v){
				$arr = explode(",",$v);
				$area_list[$k]['area_id'] = $arr[0];
				$area_list[$k]['area_name'] = $arr[1];
			}
			$new = array();
			foreach($area_list as $value){
				$new[] = $value;
			}
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $new;
			ajaxReturnJson($result);
		}else{
			$result['status'] = 0;
			$result['msg'] = "查询无数据";
			$result['data'] = array();
			ajaxReturnJson($result);
		}
				  
		
	}
	/**
     * [2 pro_task_list 获取种植任务列表]
     * @return [type] [description]
     */
	public function pro_task_list(){
		//获取变量
		$area_id = $this->request->param('area_id');
		//验证变量
		if(!$area_id){
			$result['status'] = 0;
			$result['msg'] = "种植区域id为空";
			ajaxReturnJson($result);
		}

		$worker = $this->worker;

		$worker_id = $worker['worker_id'];

		/*$role_id = $worker['role_id'];

		$worker_code = $worker['worker_code'];

		if($role_id != 1){
			$con['w.worker_code'] = array('like','%'.$worker_code.'%'); 
		}*/
		//程序主体
		$con['area_id'] = $area_id;
		$con['pgt.status'] = 2;

		//$con['pgt.worker_id'] = $worker_id;
		$ptask_list = Db::name('pro_grow_task_area pgta')
					->field('pgt.t_id,p.plan_id,pgt.ps_id,pgt.t_name,p.plan_name')
					->join('pro_grow_task pgt','pgt.t_id = pgta.t_id')
					->join('product_plan p','p.plan_id = pgta.plan_id')
					->join('worker w','w.worker_id = pgt.worker_id')
					->where($con)
					->select();	
		//echo Db::name('pro_grow_task_area pgta')->getLastSql();die;
		$list = array();
		foreach($ptask_list as $k=>$v){
			$k1=$k;
			$k1++;
			$ps_name = Db::name('pro_plan_son_worker')->where('ps_id',$v['ps_id'])->value('ps_name');
			$task_name = $v['plan_name'].'-'.$ps_name.'-'.$v['t_name'];
			$t_id = $v['t_id'];
			$list[$k]['t_id'] = $t_id;
			//$list[$k]['task_name'] = $task_name;
			$list[$k]['task_name'] = $v['t_name'];
			$list[$k]['plan_id'] = $v['plan_id'];
			 
		}	
		$result['status'] = 1;
		$result['msg'] = "获取成功";
		$result['data'] = $list;
		ajaxReturnJson($result);
	}
	/**
     * [3 pt_addinfo 获取物料管理-生产领料-申请领料（负责人显示信息）]
     * @return [type] [description]
     */
	
	public  function pt_addinfo(){
		//获取变量
		$t_id = $this->request->param('t_id'); 
		//验证变量
		if(!$t_id){
			$result['status'] = 0;
			$result['msg'] = "种植任务id为空";
			ajaxReturnJson($result);
		}
		
		$nowtime = time();
		
		$field[] = 'gt.t_id';
		$field[] = 'w.worker_name';
		$field[] = 'mc.cat_name as cat_p_name'; //品种
		$field[] = 'mc.fcolor';
		$field[] = 'mc.ftype';
		$field[] = 'mc1.cat_name'; //作物
		$field[] = 'gt.grow_date';  //定植日期
		$field[] = 'g.mode_name';  
		
		$con['gt.t_id'] = $t_id;
		//$con['gt.status'] = 0;
		$info = Db::name('pro_grow_task gt')
			  ->field(implode(',',$field))
			  ->join('worker w','gt.worker_id = w.worker_id')
			  ->join('grow_mode g','g.mode_id = gt.grow_mode_id')
			  ->join('mf_product_plan p','p.plan_id = gt.plan_id')
			  ->join('mf_materiel_category mc','mc.cat_id = p.cat_id') //品种
			  ->join('mf_materiel_category mc1','mc1.cat_id = mc.pid') //作物
			  ->where($con)
			  ->find();
		if($info){
			$gd_num = 0;
			$grow_date = strtotime($info['grow_date']);
			if($grow_date>=$nowtime){
				$gd_num = 0;
				$info['gd_num'] = "0天";
			}else{
				$gd_num = $nowtime - $grow_date;
				$info['gd_num'] = floor($gd_num/86400)."天";
			}
		}else{
			$info = (object)array();
		}	
		$result['status'] = 1;
		$result['msg'] = "获取成功";
		$result['data'] = $info;
		ajaxReturnJson($result);	
	}
	
	/**
     * [4 takeworker_list 获取领料人列表（下拉）]
     * @return [type] [description]
     */
	public function takeworker_list(){
		
		$worker_id = $this->request->param('worker_id');

		$con = " w.status = 1 and FIND_IN_SET($worker_id ,worker_code)";
		
		$condition['w.group_id'] = array('in','1,2');
		$list = Db::name('worker w')
			  ->field('w.worker_id,w.worker_name')
			  ->join('role r','r.role_id = w.role_id')
			  ->where($con)
			  ->where($condition)
			  ->select();
		
		if($list){
			foreach($list as $k=>$v){
				$v = join(",",$v);
				$temp[$k] = $v;
			}
			$temp = array_unique($temp);
			foreach($temp as $k => $v){
				$arr = explode(",",$v);
				$lw_list[$k]['worker_id'] = $arr[0];
				$lw_list[$k]['worker_name'] = $arr[1];
			}
			
			foreach($lw_list as $k=>$v){
				$arr2[] = $v;
			}
			
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $arr2;
			ajaxReturnJson($result);
		}else{
			$result['status'] = 0;
			$result['msg'] = "查询无数据";
			$result['data'] = array();
			ajaxReturnJson($result);
		}
	}
	/**
     * [5 mc_list 获取物料列表（模糊下拉）]
     * @return [type] [description]
     */
	
	public function mc_list(){
		//获取变量
		if(isset($_REQUEST['mc_name'])){
			$mc_name = $this->request->param('mc_name');
			//验证变量
			if(empty($mc_name)){
				$result['status'] = 0;
				$result['msg'] = "请输入物料名称";
				ajaxReturnJson($result);
			}
			//程序主体
			//$con['m.m_name'] = array('like','%'.$mc_name.'%'); 
		}
		$con['m.status'] = 1;
		$con['mc.status'] = 1;
		$con['m.type'] = array(array('eq',0),array('eq',4), 'or');
		$con['mc.type'] = array(array('eq',0),array('eq',4), 'or');
		$list = Db::name('materiel m')
			  ->field('m.m_id,m.m_name,m.unit,mc.cat_name,m_desc,m.m_no')
			  ->join('mf_materiel_category mc','mc.cat_id = m.cat_id')
			  //->where($con)
			  //->where('m.m_name|m.m_no','like','%'.$mc_name.'%')
			  ->select();

		foreach($list as $k=>$v){
			$list[$k]['m_name'] = trim($v['m_no']).trim($v['m_name']);
		}	

		if($list){
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $list;
			ajaxReturnJson($result);
		}else{
			$result['status'] = 0;
			$result['msg'] = "查询无数据"; 
			$result['data'] = '';
			ajaxReturnJson($result);
		}
	}
	
	/**
     * [6 plan_list 获取生产计划列表（下拉）]
     * @return [type] [description]
     */
	
	public function plan_list(){

		$worker = $this->worker;

		$worker_id = $worker['worker_id'];

		$group_id = $worker['group_id'];

		$list = array();

		$con['status'] = array('neq',-1);
		$con['type'] = array('eq',1);

		if($group_id != 1){
			
			$con['add_worker_id'] = array('eq',$worker_id);
		}

		$list = Db::name('product_plan')->field('plan_id,plan_name')->where($con)->select();

		$arr = array();

		foreach($list as $k=>$v){
			$find = Db::name('pro_grow_task')->where('plan_id',$v['plan_id'])->where('status',2)->find();
			if($find){
				$arr[] = $v;
			}
		}

		$data['status'] = 1;

        $data['msg'] = '获取成功';

        $data['data'] = $arr;

        return json($data);
	}

	/**
    * [7 task_list 获取生产任务列表（下拉）]
    * @return [type] [description]
    */
	
	public function task_list(){

		$worker = $this->worker;

		$role_id = $worker['role_id'];

		$worker_id = $worker['worker_id'];

		$list = array();

		$con['status'] = array('neq',-1);

		if($role_id == 1){

			$plan_id = $this->request->param('plan_id');

			if(!isset($plan_id)){

				$data['status'] = 0;

       			$data['msg'] = '无效的生产计划id';

       			return json($data);	
			}

			$list = Db::name('pro_plan_son_worker')->field('ps_id,ps_name')->where('plan_id',$plan_id)->where($con)->select();

		}else{

			if(strpos($worker['node_str'],'150') !== false){

				$list = Db::name('pro_plan_son_worker')->field('ps_id,ps_name')->where('worker_id',$worker_id)->where($con)->select();
			
			}
		}

		$data['status'] = 1;

        $data['msg'] = '获取成功';

        $data['data'] = $list;

        return json($data);
	}

	/**
    * [8 grow_list 获取种植任务列表（下拉）]
    * @return [type] [description]
    */
	
	public function grow_list(){

		$worker = $this->worker;

		$role_id = $worker['role_id'];

		$worker_id = $worker['worker_id'];

		$list = array();

		$con['status'] = array(['gt',0],['lt',3]);

		if(strpos($worker['node_str'],',5') !== false){

			$plan_id = $this->request->param('plan_id');

			if(!isset($plan_id)){

				$data['status'] = 0;

       			$data['msg'] = '无效的生产计划id';

       			return json($data);	
			}

			$list = Db::name('pro_grow_task')->field('t_id,t_name,worker_id')->where('plan_id',$plan_id)->where($con)->select();
		
		}else{

			$con['worker_id'] = $worker_id;

			$list = Db::name('pro_grow_task')->field('t_id,t_name,worker_id')->where($con)->select();

		}
		if($list){

			foreach($list as $k=>$v){

				$list[$k]['area'] = Db::name('pro_grow_task_area e')

							->join('mf_grow_area a','e.area_id = a.area_id')
							
							->field('a.area_id,a.area_name')
							
							->where('t_id',$v['t_id'])
							
							->select();
			}
		}

		$data['status'] = 1;

        $data['msg'] = '获取成功';

        $data['data'] = $list;

        return json($data);
	}
}
