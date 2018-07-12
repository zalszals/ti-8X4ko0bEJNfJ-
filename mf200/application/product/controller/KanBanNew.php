<?php
namespace app\product\controller;
use app\base\controller\Base;
use think\Db;


class kanBanNew extends Base{
	/**
	* [1 kanban_list 生产看板列表]
	* @param post传参 
	* @return [type] status 状态值 msg 返回信息 data 返回数据
	*/
	public function kanban_list(){
		//要以登陆者的部门id为条件：分三种条件判断返回信息
		$worker = $this->worker;
		$group_id = $worker['group_id'];
		if($group_id){
			if($group_id==1){
				$con['w.status'] = 1;
			}else {
				$con['w.status'] = 1;
				$con['w.group_id'] = $group_id;
			}
		}
		
		$worker = Db::name('worker w')
				->join('role r','w.role_id = r.role_id')
				->field('w.worker_id,w.worker_name')
				->where($con)
				->select();
		
		if($worker){
			foreach($worker as $k=>$v){
				$field[] = 'wj.gd_id';
				//$field[] = 'w.worker_name';
				$field[] = 'ws.skill_name';
				$field[] = 'ga.area_name';
				$field[] = 'wj.num';
				$field[] = 'wj.real_num';
				$field[] = 'wj.work_date';
				$field[] = 'wj.require_time_1';  //要求工作开始的时间
				$field[] = 'wj.require_time_2';  //要求工作结束的时间
				$field[] = 'w1.worker_name as add_worker_name';   //工单发布者
				$field[] = 'r.role_name'; 
				$field[] = 'wj.status'; 
				
				$con1['wj.status'] = array('lt',2);
				$con1['wj.worker_id'] = $v['worker_id'];
				$con1['ws.status'] = 1;
				$con1['wj.type'] = 1; //1:生管 2：育苗
				
				$all_info = Db::name('pro_worker_job wj')
						->field(implode(',',$field))
						->join('mf_worker w','w.worker_id = wj.worker_id')
						->join('mf_worker w1','w1.worker_id = wj.add_worker_id')
						->join('mf_role r','r.role_id = w1.role_id')
						->join('mf_work_skill ws','ws.skill_id = wj.skill_id')
						->join('mf_grow_area ga','ga.area_id = wj.area_id')
						->where($con1)
						->select();
						
						
				if($all_info){
					$data['worker_id'] = $v['worker_id'];
					$data['worker_name'] = $v['worker_name'];
					$data['info'] = $all_info;
					$data1[] = $data;
				}
			}
			
			if($data1){
				$result['status'] = 1;
				$result['msg'] = "获取成功";
				$result['data'] = $data1;
				ajaxReturnJson($result);
			}else{
				$result['status'] = 1;
				$result['msg'] = "暂无数据";
				$result['data'] = array();
				ajaxReturnJson($result);
			}
			
		}
			
	}
	
	/**
	* [2 punch 打卡]//未测试
	* @param post传参 gd_id 工单id check 开始/结束打卡:1,2
	* @return [type] status 状态值 msg 返回信息 
	*/
	public  function punch(){
		//获取变量
		$gd_id = $this->request->param('gd_id');
		$check = $this->request->param('check');
		//验证变量
		if(!$gd_id){
			$result['status'] = 0;
			$result['msg'] = "工单id为空";
			ajaxReturnJson($result);
		}
		if(!$check){
			$result['status'] = 0;
			$result['msg'] = "请输入check值";
			ajaxReturnJson($result);
		}
		//程序主体
		$con['gd_id'] = $gd_id;
		
		if($check==1){
			$data['s_time'] = date('Y-m-d H:i:s');
			$data['status'] = 1;
			$status = Db::name('pro_worker_job')->where($con)->value('status');
			if($status==1){
				$result['msg'] = "请勿重复打卡";
				ajaxReturnJson($result);
			}
			
			$re = Db::name('pro_worker_job')->where($con)->update($data);
		}else if($check==2){
			$data['s_time'] = date('Y-m-d H:i:s');
			$data['status'] = 2;
			$re = Db::name('pro_worker_job')->where($con)->update($data);
		}
		if($re!==false){
			$result['status'] = 1;
			$result['msg'] = "打卡成功";
			ajaxReturnJson($result);
		}else{
			$result['status'] = 0;
			$result['msg'] = "打卡失败";
			ajaxReturnJson($result);
		}
		
	}
	/**
	* [3 kanban_old_list 历史工单列表]
	* @param post传参 
	* @return [type] status 状态值 msg 返回信息 data 返回数据
	*/
	public function kanban_old_list(){
		$worker = $this->worker;
		$group_id = $worker['group_id'];
		if($group_id){
			if($group_id==1){
				$con['w.status'] = 1;
			}else {
				$con['w.status'] = 1;
				$con['w.group_id'] = $group_id;
			}
		}
		$worker = Db::name('worker w')
				->join('role r','w.role_id = r.role_id')
				->field('w.worker_id,w.worker_name')
				->where($con)
				->select();
		
		if($worker){
			foreach($worker as $k=>$v){
				$field[] = 'wj.gd_id';
				$field[] = 'ws.skill_name';
				$field[] = 'ga.area_name';
				$field[] = 'wj.num';
				$field[] = 'wj.real_num';
				$field[] = 'wj.work_date';
				$field[] = 'wj.s_time';
				$field[] = 'wj.e_time';
				$field[] = 'wj.require_time_1';  //要求工作开始的时间
				$field[] = 'wj.require_time_2';  //要求工作结束的时间
				$field[] = 'w1.worker_name as check_worker_name';   //审核人
				$field[] = 'wj.check_time';	 //审核时间
				$field[] = 'wj.score';	 //评分
				$field[] = 'r.role_name';  //职位名称
				$field[] = 'wj.photo';
				$field[] = 'wj.status';    //状态值
				
				$con1['wj.status'] = array('eq',3);
				$con1['wj.worker_id'] = $v['worker_id'];	
				
				$all_info = Db::name('pro_worker_job wj')
						->field(implode(',',$field))
						->join('mf_worker w','w.worker_id = wj.worker_id')
						->join('mf_worker w1','w1.worker_id = wj.check_worker_id')
						->join('mf_role r','r.role_id = w1.role_id')
						->join('mf_work_skill ws','ws.skill_id = wj.skill_id')
						->join('mf_grow_area ga','ga.area_id = wj.area_id')
						->where($con1)
						->order('wj.check_time')
						->select();
				
				if($all_info){
					foreach($all_info as $k=>$v1){
						$photo = explode(',',$v1['photo']);
						$all_info[$k]['photo'] = $photo;
					}
					$data['worker_id'] = $v['worker_id'];
					$data['worker_name'] = $v['worker_name'];
					$data['info'] = $all_info;
					$data1[] = $data;
					$result['status'] = 1;
					$result['msg'] = "获取成功";
					$result['data'] = $data1;
					ajaxReturnJson($result);
				}else{
					$data1 = array();
					$result['status'] = 1;
					$result['msg'] = "暂无数据";
					$result['data'] = array();
					ajaxReturnJson($result);
				}
			}
		}
	}
	
	

}