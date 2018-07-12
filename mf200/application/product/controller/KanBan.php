<?php
namespace app\product\controller;
use app\base\controller\Base;
use think\Db;


class kanBan extends Base{
	/**
	* [1 kanban_list 生产看板列表]
	* @param post传参 
	* @return [type] status 状态值 msg 返回信息 data 返回数据
	*/
	public function kanban_list(){
		//要以登陆者的部门id为条件：分三种条件判断返回信息
		$worker = $this->worker;
		$group_id = $worker['group_id'];
		$role_id = $worker['role_id'];
		$type = $this->request->param('type');
		$worker_id = $worker['worker_id'];
/*		if($role_id==1){
			$con['w.status'] = 1;
		}else{
			$con['w.status'] = 1;
			$con['w.worker_code'] = array('like','%'.$worker_code.'%');
		}*/
		$con['w.worker_id'] = $worker_id;
		$worker = Db::name('worker w')
				->join('role r','w.role_id = r.role_id')
				->field('w.worker_id,w.worker_name')
				->where($con)
				->select();
		$data1 = array();
		if($worker){
			foreach($worker as $k=>$v){
				$field[] = 'wj.gd_id';
				$field[] = 'p.cat_id';
				$field[] = 'w.worker_name';
				$field[] = 'ws.skill_name';
				$field[] = 'ga.area_name';
				$field[] = 'wj.num';
				$field[] = 'wj.real_num';
				$field[] = 'wj.work_date';
				$field[] = 'wj.require_time_1';  //要求工作开始的时间1
				$field[] = 'wj.require_time_2';  //要求工作结束的时间
				$field[] = 'w1.worker_name as add_worker_name';   //工单发布者
				$field[] = 'w1.role_id  as role_id'; 
				$field[] = 'wj.status';
				$field[] = 'wj.unit'; 
				$field[] = 'wj.worker_id';

				/*$con1['wj.status'] = array('lt',3);*/
				if($type == 0){
					$con1['wj.status'] = array('lt',2);
				}elseif($type == 1){
					$con1['wj.status'] = 2;
				}else{
					$con1['wj.status'] = 3;
				}

				$con1['wj.worker_id'] = $v['worker_id'];
				//$con1['ws.status'] = 1;
				$con1['wj.type'] = 1; //1:生管 2：育苗1
				
				$all_info = Db::name('pro_worker_job wj')
						->field(implode(',',$field))
						->join('mf_product_plan p','p.plan_id = wj.plan_id')
						->join('mf_worker w','w.worker_id = wj.worker_id')
						->join('mf_worker w1','w1.worker_id = wj.add_worker_id')
						//->join('mf_role r','r.role_id = w1.role_id')
						->join('mf_work_skill ws','ws.skill_id = wj.skill_id')
						->join('mf_grow_area ga','ga.area_id = wj.area_id')
						->where($con1)
						->select();	
				foreach($all_info as $ke=>$ve){
					$role_info = Db::name('role')->field('role_name')->where(' role_id = '.$ve['role_id'])->find();
					if($role_info){
						$all_info[$ke]['role_name'] = $role_info['role_name'];
					}
					$cat = Db::name('materiel_category c')->join('materiel_category ca','c.pid = ca.cat_id')->field('c.cat_name,ca.cat_name as p_name')->where('c.cat_id',$ve['cat_id'])->find();
					$all_info[$ke]['cat_name'] = $cat['p_name'].' '.$cat['cat_name'];
				}	
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
			$data['e_time'] = date('Y-m-d H:i:s');
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
	* [kanban_old_list 历史工单列表]
	* @param post传参 
	* @return [type] status 状态值 msg 返回信息 data 返回数据
	*/
	public function kanban_old_list1(){
		if($_REQUEST){
			//$con['w.group_id'] = 2;
			$worker = $this->worker;
			$role_id = $worker['role_id'];
			$worker_code = $worker['worker_code'];
			if($role_id==1){
				$con['w.status'] = 1;
			}else{
				$con['w.status'] = 1;
				$con['w.worker_code'] = array('like','%'.$worker_code.'%');
			}
			$worker = Db::name('worker')
					->alias('w')
					->join('role r','w.role_id = r.role_id')
					//->where($con)
					->field('worker_id,worker_name')
					->select();
			$arr = array();
			foreach($worker as $k=>$v){
				$condition['w.worker_id'] = $v['worker_id'];
				$condition['w.status'] = array('eq',3);
				$job_info = Db::name('pro_worker_job')
						->alias('w')
						->join('work_skill s','w.skill_id = s.skill_id')
						->join('grow_area a','w.area_id = a.area_id')
						->join('worker e','w.check_worker_id = e.worker_id')
						->join('role r','e.role_id = r.role_id')
						->where($condition)
						->field('w.gd_id,w.work_date,w.require_time_1,w.require_time_2,w.num,w.unit,w.real_num,w.status,w.check_time,w.s_time,w.e_time,w.score,w.photo,s.skill_name,a.area_name,e.worker_name as check_worker_name,r.role_name')
						->select();
				if($job_info){
					foreach($job_info as $k1=>$v1){
						$job_info[$k1]['require_time_1'] = date('H:i',strtotime($job_info[$k1]['require_time_1']));
						$job_info[$k1]['require_time_2'] = date('H:i',strtotime($job_info[$k1]['require_time_2']));
						$job_info[$k1]['check_time'] = date('Y-m-d,H:i',strtotime($job_info[$k1]['check_time']));
						$job_info[$k1]['s_time'] = date('Y-m-d,H:i',strtotime($job_info[$k1]['s_time']));
						$job_info[$k1]['e_time'] = date('Y-m-d,H:i',strtotime($job_info[$k1]['e_time']));
						$photo = explode(',',$v1['photo']);
						$job_info[$k1]['photo'] = $photo;
					}
					$array['worker_id'] = $v['worker_id'];
					$array['worker_name'] = $v['worker_name'];
					$array['info'] = $job_info;
					$arr[] = $array;
				}
				$array = array();
			}
			return(json(array('status'=>1,'msg'=>'查询成功','data'=>$arr)));
		}else{
			return(json(array('status'=>0,'msg'=>'参数错误')));
		}
	}
	
	
	/**
	* [3 kanban_old_list 历史工单列表]
	* @param post传参 
	* @return [type] status 状态值 msg 返回信息 data 返回数据
	*/
	public function kanban_old_list(){
		$worker = $this->worker;
		$role_id = $worker['role_id'];
		$worker_id = $worker['worker_id'];
		$worker_code = $worker['worker_code'];
		if($role_id==1){
			$con['w.status'] = 1;
		}else{
			$con['w.status'] = 1;
			$con['w.worker_id'] = $worker_id;
		}

		$worker = Db::name('worker w')
				->join('role r','w.role_id = r.role_id')
				->field('w.worker_id,w.worker_name')
				->where($con)
				->select();
		$data1 = array();
		if($worker){
			foreach($worker as $k=>$v){
				$field[] = 'wj.gd_id';
				$field[] = 'p.cat_id';
				$field[] = 'ws.skill_name';
				$field[] = 'ga.area_name';
				$field[] = 'wj.num';
				$field[] = 'wj.unit';
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
						->join('mf_product_plan p','p.plan_id = wj.plan_id')
						->join('mf_worker w','w.worker_id = wj.worker_id')
						->join('mf_worker w1','w1.worker_id = wj.check_worker_id')
						->join('mf_role r','r.role_id = w1.role_id')
						->join('mf_work_skill ws','ws.skill_id = wj.skill_id')
						->join('mf_grow_area ga','ga.area_id = wj.area_id')
						->where($con1)
						->order('wj.check_time')
						->select();
				if($all_info){
					foreach($all_info as $k1=>$v1){
						$photo = explode(',',$v1['photo']);
						$all_info[$k1]['photo'] = $photo;
						$cat = Db::name('materiel_category c')->join('materiel_category ca','c.pid = ca.cat_id')->field('c.cat_name,ca.cat_name as p_name')->where('c.cat_id',$v1['cat_id'])->find();
						$all_info[$k1]['cat_name'] = $cat['p_name'].' '.$cat['cat_name'];
					}
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
}