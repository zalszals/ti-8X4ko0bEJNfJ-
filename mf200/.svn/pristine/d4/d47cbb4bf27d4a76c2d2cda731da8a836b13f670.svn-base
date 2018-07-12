<?php
namespace app\product\controller;
use app\base\controller\Base;
use think\Db;
class Gd extends Base{//此控制器不被工单所使用
	
	/**
     * [1 pro_task_list 获取种植任务列表]
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
		//程序主体
		$con['area_id'] = $area_id;
		$ptask_list = Db::name('pro_grow_task_area pgta')
					->field('pgt.t_id,pgt.t_name,p.plan_name')
					->join('pro_grow_task pgt','pgt.t_id = pgta.t_id')
					->join('product_plan p','p.plan_id = pgta.plan_id')
					->where($con)
					->select();
					
		foreach($ptask_list as $k=>$v){
			$k1=$k;
			$k1++;
			$task_name = $v['plan_name']."—".$v['t_name'];
			$t_id = $v['t_id'];
			$list[$k]['t_id'] = $t_id;
			$list[$k]['task_name'] = $task_name;
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
     * [2 work_skill_list 获取所有工序列表]
     * @return [type] [description]
     */
	public function work_skill_list(){
		$con['status'] = 1; //0:删除 1：启用
		$data = Db::name('work_skill')->where($con)->select();
		if($data){
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $data;
			ajaxReturnJson($result);
		}else{
			$result['status'] = 0;
			$result['msg'] = "获取失败";
			$result['data'] = '';
			ajaxReturnJson($result);
		}
	}
	/**
     * [3 pro_area_list 获取种植区域列表]
     * @return [type] [description]
     */
	public function pro_area_list(){
		$con['pgt.status'] = 0;        //0:未完成 1：已完成
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
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $area_list;
			ajaxReturnJson($result);
		}else{
			$result['status'] = 0;
			$result['msg'] = "查询无数据";
			$result['data'] = '';
			ajaxReturnJson($result);
		}
				  
		
	}
	
	
	
	
	
	/**
     * [get_plan_sn 获取生产计划工单编号]
     * @return [type] [description]
     */
    private function get_plan_sn(){
    	//获取变量
    	$shijian = date('Ymd');//当天时间
    	$con['work_date']  = array('eq',$shijian);
		$con['type'] = 1;
    	$number = Db::name('worker_job')->count();
    	$number++;
    	//填充0；str_pad（）填充字符串；STR_PAD_LEFT：填充到字符串的左侧
    	
    	$numbered = str_pad($number,3,"0",STR_PAD_LEFT);
    	$head  = Db::name('confing_prex')->where('prex_id = 2')->value('prex_name');
    	$gd_no = $head.$shijian.$numbered;
    	return $gd_no;
    	

    }
	
	
	
	/**
	 * [edit_product_gd 工单修改]
	 * @return [type] [description]
	 */
	public function edit_product_gd(){
		//获取变量
		$gd_id  = $this->request->param('gd_id');
		//$gd_no = $this->get_plan_sn();
		$skill_id = $this->request->param('skill_id');
		$skill_type  = $this->request->param('skill_type');
		$worker_id = $this->request->param('worker_id');
		$worker_name = $this->request->param('worker_name');
		$group_name  = $this->request->param('group_name');
		$role_name  =$this->request->param('role_name');
		$work_date  = date('Y-m-d');
		$require_time_1 = $this->request->param('require_time_1');
		$require_time_2 = $this->request->param('require_time_2');
		//$s_time  = date('Y-m-d H:i:s');
		//$e_time = date('Y-m-d H:i:s');
		$add_time = date('Y-m-d H:i:s');
		$add_worker_id = $this->request->param('add_worker_id');
		$add_worker_name  = $this->request->param('add_worker_name');
		$check_worker_id = $this->request->param('check_worker_id');
		$check_worker_name  = $this->request->param('check_worker_name');
		
		//验证变量
		if(!$gd_id){
			$result['status'] = 0;
			$result['msg'] = "工单id为空";
			/* echo json_encode($result);die; */
			return json($result);
		}
		
		//程序主体
		$con['gd_id'] = $gd_id;
		$find = Db::name('worker_job')->where($con)->find();
		if($find){
			//dump($find);die;
			if($skill_id){
				$data['skill_id'] = $skill_id;
			}else{
				$data['skill_id'] = $find['skill_id'];
			}
			
			if($skill_type){
				$data['skill_type'] = $skill_type;
			}else{
				$data['skill_type'] = $find['skill_type'];
			}
			
			if($worker_id){
				$data['worker_id'] = $worker_id;
			}else{
				$data['worker_id'] = $find['worker_id'];
			}
			
			if($worker_name){
				$data['worker_name'] = $worker_name;
			}else{
				$data['worker_name'] = $find['worker_name'];
			}
			
			if($group_name){
				$data['group_name'] = $group_name;
			}else{
				$data['group_name'] = $find['group_name'];
			}
			
			if($role_name){
				$data['role_name'] = $role_name;
			}else{
				$data['role_name'] = $find['role_name'];
			}
			if($work_date){
				$data['work_date'] = $work_date;
			}else{
				$data['work_date'] = $find['work_date'];
			}
			if($require_time_1){
				$data['require_time_1'] = $require_time_1;
			}else{
				$data['require_time_1'] = $find['require_time_1'];
			}
			if($require_time_2){
				$data['require_time_2'] = $require_time_2;
			}else{
				$data['require_time_2'] = $find['require_time_2'];
			}
			if($add_time){
				$data['add_time'] = $add_time;
			}else{
				$data['add_time'] = $find['add_time'];
			}
			if($add_worker_id){
				$data['add_worker_id'] = $add_worker_id;
			}else{
				$data['add_worker_id'] = $find['add_worker_id'];
			}
			if($add_worker_name){
				$data['add_worker_name'] = $add_worker_name;
			}else{
				$data['add_worker_name'] = $find['add_worker_name'];
			}
			
			if($check_worker_id){
				$data['check_worker_id'] = $check_worker_id;
			}else{
				$data['check_worker_id'] = $find['check_worker_id'];
			}
			
			if($check_worker_name){
				$data['check_worker_name'] = $check_worker_name;
			}else{
				$data['check_worker_name'] = $find['check_worker_name'];
			}
			
			//dump($data);die;
			$re = Db::name('worker_job')->where($con)->update($data);

			if($re!==false){
				$result['status']  = 1;
				$result['msg'] = "修改成功";
				/* echo json_encode($result);die; */
				return json($result);
			}else{
				$result['status']  = 0;
				$result['msg'] = "修改失败";
				/* echo json_encode($result);die; */
				return json($result);
			}
			
		}
	}
	
	/**
	 * [edit_product_gd 工单删除]
	 * @return [type] [description]
	 */
	public function del_product_gd() {
		//获取变量
		$gd_id = $this->request->param('gd_id');
		//验证变量
		if(!$gd_id){
			$result['status'] = 0;
			$result['msg'] = "工单id为空";
			return json($result);
		}
		//程序主体
		$con['gd_id'] = $gd_id;
		$find = Db::name('worker_job')->where($con)->find();
		if($find){
			if(!empty($find['s_time'])||!empty($find['e_time'])){
				$result['status'] = 0;
				$result['msg'] = "工人已经打卡，不能删除此工单";
				return json($result);
			}else{
				$re = Db::name('worker_job')->where($con)->delete();
				if($re){
					$result['status'] = 1;
					$result['msg'] = "删除成功";
					return json($result);
				}else{
					$result['status'] = 0;
					$result['msg'] = "删除失败";
					return json($result);
				}	
			}
		}
	}
	
}