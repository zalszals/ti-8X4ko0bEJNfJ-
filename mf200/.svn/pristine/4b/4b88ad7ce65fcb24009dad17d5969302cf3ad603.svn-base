<?php
namespace app\gdmanage\controller;
use app\base\controller\Base;
use think\Db;
class Gd extends Base{
	
	
	
	/**
     * [get_plan_sn 获取生产计划工单编号]
     * @return [type] [description]
     */
    private function get_plan_sn(){
    	//获取变量
    	$shijian = date('Ymd');//当天时间
    	$con['work_date']  = array('eq',$shijian);
		$con['type'] = 1;
    	$number = Db::name('worker_job')->where($con)->count();
    	$number++;
    	//填充0；str_pad（）填充字符串；STR_PAD_LEFT：填充到字符串的左侧
    	
    	$numbered = str_pad($number,3,"0",STR_PAD_LEFT);
    	$head  = Db::name('confing_prex')->where('prex_id = 2')->value('prex_name');
    	$gd_no = $head.$shijian.$numbered;
    	return $gd_no;
    	

    }
	
	//工单添加（生管）
	public function add_product_gd(){
		
		$canshu  = $this->request->param();
		//判断：如果获取变量就是执行添加否则显示页面
		if($canshu){
			//获取变量
			$gd_no = $this->get_plan_sn();
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
			if(!$gd_no){
				$result['status'] = 0;
				$result['msg'] = "工单编号为空";
				/* echo json_encode($result);die; */
				return json($result);
			}
			if(!$skill_id){
				$result['status'] = 0;
				$result['msg'] = "工序id为空";
				/* echo json_encode($result);die; */
				return json($result);
			}
			if(!$skill_type){
				$result['status'] = 0;
				$result['msg'] = "请选择绩效方式";
				/* echo json_encode($result);die; */
				return json($result);
			}
			if(!$worker_id){
				$result['status'] = 0;
				$result['msg'] = "员工id为空";
				/* echo json_encode($result);die; */
				return json($result);
			}
			if(!$worker_name){
				$result['status'] = 0;
				$result['msg'] = "员工姓名为空";
				/* echo json_encode($result);die; */
				return json($result);
			}
			if(!$group_name){
				$result['status'] = 0;
				$result['msg'] = "部门名称为空";
				/* echo json_encode($result);die; */
				return json($result);
			}
			if(!$role_name){
				$result['status'] = 0;
				$result['msg'] = "职务名称为空";
				/* echo json_encode($result);die; */
				return json($result);
			}
			if(!$add_worker_id){
				$result['status'] = 0;
				$result['msg'] = "工单发布者id为空";
				/* echo json_encode($result);die; */
				return json($result);
			}
			if(!$add_worker_name){
				$result['status'] = 0;
				$result['msg'] = "工单发布者为空";
				/* echo json_encode($result);die; */
				return json($result);
			}
			if(!$require_time_1){
				$require_time_1='00:00:00';
			}
			if(!$require_time_2){
				$require_time_2='00:00:00';
			}
			
			//程序主体
			$data['gd_no']  = $gd_no;
			$data['type']  = 1;
			$data['skill_id']  = $skill_id;
			$data['skill_type']  = $skill_type;
			$data['worker_id']  = $worker_id;
			$data['worker_name']  = $worker_name;
			$data['group_name']  = $group_name;
			$data['role_name']  = $role_name;
			$data['work_date']  = $work_date;
			$data['require_time_1']  = $require_time_1;
			$data['require_time_2']  = $require_time_2;
			$data['add_time']  = $add_time;
			$data['add_worker_id']  = $add_worker_id;
			$data['add_worker_name']  = $add_worker_name;
			$data['check_worker_id']  = $check_worker_id;
			$data['check_worker_name']  = $check_worker_name;
			$re=Db::name('worker_job')->insert($data); 
			if($re){
				$result['status'] = 1;
				$result['msg'] = "添加成功";
				/* echo json_encode($result);die; */
				return json($result);
			}else{
				$result['status'] = 0;
				$result['msg'] = "添加失败";
				/* echo json_encode($result);die; */
				return json($result);
			}
			
		}else{
			return $this->fetch();
		}
	}
	
	//工单修改（生管）
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
			//dump($data);die;
			$re = Db::name('work_skill')->where($con)->update($data);
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
	
	
	
}