<?php
namespace app\product\controller;
use app\base\controller\Base;
use think\Db;

class ProSum extends Base{
	
	/**
	 * [1 prosum_list_new 生产汇总列表]
	 * @param post传参 
	 * @return [type] status 状态值 msg 返回信息 data 返回数据
	 */
	
	public function prosum_list_new(){
		/* $row = 3;
		$page = $this->request->param('page');
		if($page==1 || !$page){
			$page = 0;
		}else{
			$page=($page-1)*$row;
		} */
		
		$s_time = $this->request->param('time1'); //开始日期
		if($s_time){
			
			$e_time = $this->request->param('time2'); //结束日期
			if(!$e_time){
				$result['status'] = 0;
				$result['msg'] = "请选择结束日期";
				ajaxReturnJson($result);
			}
			
			
			$con['p.estimate_get_date_1'] = array('egt',$s_time);//（条件）
			$con['p.estimate_get_date_2'] = array('elt',$e_time);
		}
		
		$fzr_name = $this->request->param('fzr_name'); //获取负责人姓名（条件）
		if($fzr_name){
			$con['w.worker_name'] = array('like','%'.$fzr_name.'%');
		}
		
		$field[] = 'mc1.cat_name';//作物名
		$field[] = 'ps.cat_id';
		$field[] = 'mc.cat_name as cat_p_name';//品种名
		$field[] = 'w.worker_name';//负责人
		$field[] = 'mc.fcolor'; //果色
		$field[] = 'mc.ftype'; //果型
		$field[] = 'ps.n1_output';//一级果产量
		$field[] = 'ps.n2_output';//二级果产量
		$field[] = 'ps.total_output'; //总产量
		$field[] = 'ps.working_time_z'; //工时
		$field[] = 'ps.m_z'; //物料成本
		$field[] = 'ps.los_z'; //能耗成本
		$field[] = 'ps.total_z'; //总成本
		
		$con['w.status'] = 1;
		
		$sts = $this->request->param('sts');//状态(条件): 1:进行中 2:已经完成
		if($sts){
			switch($sts){
				case 1:
					$con['ps.status'] = array('eq',0);
					break;
				case 2:
					$con['ps.status'] = array('eq',1);
					break;
			}
		}
		
		$pmc_name = $this->request->param('pmc_name'); //获取作物名或品种名（条件）
		if($pmc_name){
			$con1['mc1.cat_name'] = array('like','%'.$pmc_name.'%');  //作物
			$con2['mc.cat_name'] = array('like','%'.$pmc_name.'%'); //品种
			/* $count = Db::name('pro_sum ps')
			   ->join('product_plan p','p.cat_id = ps.cat_id')
			   ->join('worker w','w.worker_id = p.add_worker_id')
			   ->join('materiel_category mc','mc.cat_id = ps.cat_id')
			   ->join('materiel_category mc1','mc1.cat_id= mc.pid')
			   ->where($con)->where($con1)->whereOr($con2)
			   ->count();  */
			   
			$data = Db::name('pro_sum ps')
			  ->field(implode(',',$field))
			  ->join('product_plan p','p.plan_id = ps.plan_id')
			  ->join('worker w','w.worker_id = p.add_worker_id')
			  ->join('materiel_category mc','mc.cat_id = ps.cat_id')
			  ->join('materiel_category mc1','mc1.cat_id= mc.pid')
			  ->where($con)->where($con1)->whereOr($con2)
			  /* ->limit($page,$row) */->select(); 
		}else{
			/* $count = Db::name('pro_sum ps')
			   ->join('product_plan p','p.cat_id = ps.cat_id')
			   ->join('worker w','w.worker_id = p.add_worker_id')
			   ->join('materiel_category mc','mc.cat_id = ps.cat_id')
			   ->join('materiel_category mc1','mc1.cat_id= mc.pid')
			   ->where($con)
			   ->count(); 
			    */
			$data = Db::name('pro_sum ps')
			  ->field(implode(',',$field))
			  ->join('product_plan p','p.plan_id = ps.plan_id')
			  ->join('worker w','w.worker_id = p.add_worker_id')
			  ->join('materiel_category mc','mc.cat_id = ps.cat_id')
			  ->join('materiel_category mc1','mc1.cat_id= mc.pid')
			  ->where($con)
			  /* ->limit($page,$row) */->select();   
		}
		
		$newdata1 = array();
		if($data){
			$newdata = array();
			foreach($data as $row){
				$key = $row['cat_id'];
				if(array_key_exists($key, $newdata)){
					//dump($newdata[$key]['n1_output']);die;
					
					$newdata[$key]['n1_output'] = $newdata[$key]['n1_output']+$row['n1_output'];
					$newdata[$key]['n2_output'] = $newdata[$key]['n2_output']+$row['n2_output'];
					$newdata[$key]['total_output'] = $newdata[$key]['total_output']+$row['total_output'];
					$newdata[$key]['fcolor'] = $row['fcolor'];
					$newdata[$key]['ftype'] = $row['ftype'];
					$newdata[$key]['cat_name'] = $row['cat_name'];
					$newdata[$key]['cat_p_name'] = $row['cat_p_name'];
					$num1 = $newdata[$key]['n1_output'];
					$num2 = $newdata[$key]['n2_output'];
					$total_output = $newdata[$key]['total_output'];
					if($total_output){
						$first_rate = (round($num1/$total_output,4)*100).'%';
						$second_rate = (round($num2/$total_output,4)*100).'%';
					}else{
						$first_rate = '0%';
						$second_rate = '0%';
					}
					$newdata[$key]['first_rate'] = $first_rate;
					$newdata[$key]['second_rate'] = $second_rate;
					
					$newdata[$key]['working_time_z'] = round($newdata[$key]['working_time_z']+$row['working_time_z'],2);
					$newdata[$key]['m_z'] = round($newdata[$key]['m_z']+$row['m_z'],2);
					$newdata[$key]['los_z'] = round($newdata[$key]['los_z']+$row['los_z'],2);
					
					if($s_time){
						$newdata[$key]['estimate_get_date_1'] = $s_time;
						$newdata[$key]['estimate_get_date_2'] = $e_time;
					}
					
				}else{
					$n1_output = $row['n1_output'];
					$n2_output = $row['n2_output'];
					$total_output = $row['total_output'];
					if($total_output){
						$first_rate = (round($n1_output/$total_output,4)*100).'%';
						$second_rate = (round($n2_output/$total_output,4)*100).'%';
					}else{
						$first_rate = '0%';
						$second_rate = '0%';
					}
					$row['first_rate'] = $first_rate;
					$row['second_rate'] = $second_rate;
					$newdata[$key] = $row;
				}
			}
			
			$work_z = 0;//总工时
			$total_m = 0;//物料总成本
			$total_los = 0;//能耗总成本
			//$total_sum = 0; //所有总成本之和（工时除外）
			
			foreach($newdata as $v1){
				$newdata1[] = $v1;
				
			}
			
			foreach($newdata1 as $k2=>$v2){
				$work_z += $newdata1[$k2]['working_time_z'];
				$total_m += $newdata1[$k2]['m_z'];
				$total_los += $newdata1[$k2]['los_z'];
			}
			$sum['work_z'] = $work_z;
			$sum['total_m'] = $total_m;
			$sum['total_los'] = $total_los;
			$sum['total_sum'] = ($total_m+$total_los);
			
			
			
			
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $newdata1;
			$result['sum'] = $sum;
			ajaxReturnJson($result);
		}else{
			$newdata1 = array();
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['count'] = 0;
			$result['data'] = $newdata1;
			ajaxReturnJson($result);
		}
		
	}
	
	/**
	 * [2 prosum_crop1 作物详情（含其下所有生产计划）]
	 * @param post传参 cat_id 品种id
	 * @return [type] status 状态值 msg 返回信息 data 返回数据
	 */
	
	public function prosum_crop1(){
		//获取变量
		$cat_id = $this->request->param('cat_id');
		//验证变量
		if(!$cat_id){
			$result['status'] = 0;
			$result['msg'] = "品种id为空";
			ajaxReturnJson($result);
		}
		//程序主体
		
		$field[] = 'mc1.cat_name';//作物名
		$field[] = 'mc.cat_id';
		$field[] = 'mc.cat_name as cat_p_name';//品种名
		$field[] = 'mc.fcolor'; //果色
		$field[] = 'mc.ftype'; //果型
		$field[] = 'ms.n1_output';//一级果产量
		$field[] = 'ms.n2_output';//二级果产量
		$field[] = 'ms.total_output'; //总产量
		$con['ms.cat_id'] = $cat_id;
		$info = Db::name('mc_sum ms')
			  ->field(implode(',',$field))
			  ->join('materiel_category mc','mc.cat_id = ms.cat_id')
			  ->join('materiel_category mc1','mc1.cat_id= mc.pid')
			  ->where($con)
			  ->find();
		if($info){
			$n1_output = $info['n1_output'];
			$n2_output = $info['n2_output'];
			$total_output = $info['total_output'];
			if($total_output){
				$first_rate = (round($n1_output/$total_output,4)*100).'%';
				$second_rate = (round($n2_output/$total_output,4)*100).'%';
			}else{
				$first_rate = '0%';
				$second_rate = '0%';
			}
			$info['first_rate'] = $first_rate;
			$info['second_rate'] = $second_rate;
			
			$field1[] = 'ps.plan_id'; 
			$field1[] = 'p.plan_name';
			$field1[] = 'w.worker_name';
			$field1[] = 'ps.n1_output';
			$field1[] = 'ps.n2_output';
			$field1[] = 'ps.total_output';
			$field1[] = 'p.grow_area_1';
			$field1[] = 'ps.working_time_z';//生产计划工时
			$field1[] = 'ps.m_z';
			$field1[] = 'ps.los_z';
			
			$con1['ps.cat_id'] = $cat_id;
			//搜索生产计划（条件）
			$pf_name = $this->request->param('pf_name');//生产计划或负责人名称
			
			if($pf_name){
				$con2['p.plan_name'] = array('like','%'.$pf_name.'%');
				$con3['w.worker_name'] = array('like','%'.$pf_name.'%');
				$son = Db::name('pro_sum ps')
				   ->field(implode(',',$field1))
				   ->join('product_plan p','p.plan_id = ps.plan_id')
				   ->join('worker w','w.worker_id = p.add_worker_id')
				   ->where($con1)->where($con2)->whereOr($con3)
				   ->select();
				   
				if($son){
					foreach($son as $k=>$v){
						$num1 = $v['n1_output'];
						$num2 = $v['n2_output'];
						$num = $v['total_output'];
						$son[$k]['working_time_z'] = round($son[$k]['working_time_z'],2);
						if($num){
							$first_rate = (round($num1/$num,4)*100).'%';
							$second_rate = (round($num2/$num,4)*100).'%';
						}else{
							$first_rate = '0%';
							$second_rate = '0%';
						}
						
						$son[$k]['first_rate'] = $first_rate;
						$son[$k]['second_rate'] = $second_rate;
					}
				}
				$result['status'] = 1;
				$result['msg'] = "获取成功";
				$result['data'] = $son;
				ajaxReturnJson($result);
			}else{
				$son = Db::name('pro_sum ps')
				   ->field(implode(',',$field1))
				   ->join('product_plan p','p.plan_id = ps.plan_id')
				   ->join('worker w','w.worker_id = p.add_worker_id')
				   ->where($con1)
				   ->select();
				   
				if($son){
					foreach($son as $k=>$v){
						$num1 = $v['n1_output'];
						$num2 = $v['n2_output'];
						$num = $v['total_output'];
						$son[$k]['working_time_z'] = round($son[$k]['working_time_z'],2);
						if($num){
							$first_rate = (round($num1/$num,4)*100).'%';
							$second_rate = (round($num2/$num,4)*100).'%';
						}else{
							$first_rate = '0%';
							$second_rate = '0%';
						}
						
						$son[$k]['first_rate'] = $first_rate;
						$son[$k]['second_rate'] = $second_rate;
					}
				}
				//$info['son'] = $son;
				$result['status'] = 1;
				$result['msg'] = "获取成功";
				$result['data'] = $son;
				ajaxReturnJson($result);   
			}
		}else{
			$result['status'] = 0;
            $result['msg'] = "获取失败";
			$result['data'] = '';
			ajaxReturnJson($result);
		}	  
		
	}
	
	/**
	 * [3 prosum_grow1 生产计划详情（含其下所有种植任务及种植任务详情）]
	 * @param post传参 plan_id 生产计划id
	 * @return [type] status 状态值 msg 返回信息 data 返回数据
	 */
	public function prosum_grow1(){
		//获取变量
		$plan_id = $this->request->param('plan_id');
		//验证变量
		if(!$plan_id){
			$result['status'] = 0;
			$result['msg'] = "生产计划id为空";
			ajaxReturnJson($result);
		}
		//程序主体
		$con['ps.plan_id'] = $plan_id;
		$field[] = 'ps.plan_id';
		$field[] = 'p.plan_name';
		$field[] = 'mc.cat_name';
		$field[] = 'mc.fcolor';
		$field[] = 'mc.ftype';
		$field[] = 'ps.n1_output';
		$field[] = 'ps.n2_output';
		$field[] = 'ps.total_output';
		$field[] = 'ps.status';
		
		$info = Db::name('pro_sum ps')
			  ->field(implode(',',$field))
			  ->join('product_plan p','p.plan_id = ps.plan_id')
			  ->join('materiel_category mc','mc.cat_id = ps.cat_id')
			  ->where($con)
			  ->find();
			  
		if($info){
			if($info['status']==0){
				$info['first_rate'] = '0%';
				$info['second_rate'] = '0%';
			}else{
				$num1 = $info['n1_output'];
				$num2 = $info['n2_output'];
				$total_output = $info['total_output'];
				if($total_output){

					$first_rate = (round($num1/$total_output,4)*100).'%';
					$second_rate = (round($num2/$total_output,4)*100).'%';
				}else{
					$first_rate = '0%';
					$second_rate = '0%';
				}
				
				$info['first_rate'] = $first_rate;
				$info['second_rate'] = $second_rate;
			}
			
			
			$con1['ts.plan_id'] = $plan_id;
			$field1[] = 'ts.t_id';
			$field1[] = 'w.worker_name';
			$field1[] = 'gm.mode_name';
			$field1[] = 'gt.t_name';
			$field1[] = 'gt.grow_area_1';
			$field1[] = 'ts.total_output';
			$field1[] = 'ts.n1_output';
			$field1[] = 'ts.n2_output';
			$field1[] = 'ts.working_time_z';
			$field1[] = 'ts.m_z';
			$field1[] = 'ts.los_z';
			//搜索条件
			$tf_name = $this->request->param('tf_name');
			if($tf_name){
				$map['ts.plan_id'] = $plan_id;
				$son = Db::name('task_sum ts')
				 ->field(implode(',',$field1))
				 ->join('pro_grow_task gt','gt.t_id = ts.t_id')
				 ->join('worker w','w.worker_id = gt.worker_id')
				 ->join('grow_mode gm','gm.mode_id = gt.grow_mode_id')
				 ->where($map)->where('w.worker_name|gt.t_name','like','%'.$tf_name.'%')
				 ->select();
				if($son){				
					foreach($son as $k=>$v){
						$num1 = $v['n1_output'];
						$num2 = $v['n2_output'];
						$num = $v['total_output'];
						if($num){
							$first_rate = (round($num1/$num,4)*100).'%';
							$second_rate = (round($num2/$num,4)*100).'%';
						}else{
							$first_rate = '0%';
							$second_rate = '0%';
						}
						
						$son[$k]['first_rate'] = $first_rate;
						$son[$k]['second_rate'] = $second_rate;
					}
					
				}
				$result['status'] = 1;
				$result['msg'] = "获取成功";
				$result['data'] = $son;
				ajaxReturnJson($result);
				
			}else{
				$son = Db::name('task_sum ts')
				 ->field(implode(',',$field1))
				 ->join('pro_grow_task gt','gt.t_id = ts.t_id')
				 ->join('worker w','w.worker_id = gt.worker_id')
				 ->join('grow_mode gm','gm.mode_id = gt.grow_mode_id')
				/* ->join('pro_grow_task_area gta','gta.t_id = gt.t_id')
				 ->join('grow_area ga','ga.area_id = gta.area_id') */
				 ->where($con1)
				 ->select();
				if($son){
					foreach($son as $k=>$v){
						$num1 = $v['n1_output'];
						$num2 = $v['n2_output'];
						$num = $v['total_output'];
						if($num1==0){
							$son[$k]['first_rate'] = (0).'%';
						}else{
							$first_rate = (round($num1/$num,4)*100).'%';
							$son[$k]['first_rate'] = $first_rate;
						}
						if($num2==0){
							$son[$k]['second_rate'] = (0).'%';
						}else{
							$second_rate = (round($num2/$num,4)*100).'%';
						    $son[$k]['second_rate'] = $second_rate;
						}
						
						
					}
					//$info['son'] = $son;
					$result['status'] = 1;
					$result['msg'] = "获取成功";
					$result['data'] = $son;
					ajaxReturnJson($result);
				} 
				$result['status'] = 1;
				$result['msg'] = "此计划下无种植任务";
				$result['data'] = array();
				ajaxReturnJson($result);
			} 	
		}else{
			$result['status'] = 0;
            $result['msg'] = "获取失败";
			$result['data'] = array();
			ajaxReturnJson($result);
		}
			  
	}
	
	
	
	
	
	/**
	* [prosum_gd_time 工时详情列表]
	* @param post传参 t_id 种植任务id
	* @return [type] status 状态值 msg 返回信息 data 返回数据
	*/
	public function prosum_gd_time(){
		if($_REQUEST){
			if(!$_REQUEST['t_id']){
				return(json(array('status'=>0,'msg'=>'种植任务id为空')));
			}
			if($_REQUEST['name']){
				$where['w.worker_name'] = array('like','%'.$_REQUEST['name'].'%');
			}
			$where['p.status'] = array(['=',2],['=',3],'or');
			$time = Db::name('pro_worker_job')
				->alias('p')
				->join('worker w','w.worker_id = p.worker_id')
				->where('t_id',$_REQUEST['t_id'])
				->where($where)
				->field('p.t_id,p.worker_id,w.worker_name')
				->group('p.worker_id')
				->select();
			if($time){
				foreach($time as $k=>$v){
					$con['p.status'] = array(['=',2],['=',3],'or');
					$con['worker_id'] = $v['worker_id'];
					$timeout = Db::name('pro_worker_job')
						->alias('p')
						->where('t_id',$_REQUEST['t_id'])
						->where($con)
						->select();
					$timenum = 0;
					foreach($timeout as $k1=>$v1){
						$timeout1 = round((strtotime($v1['e_time'])- strtotime($v1['s_time']))/3600);
						$timenum += $timeout1;
					}
					$time[$k]['timeout'] = $timenum; 
				}
			}
			return(json(array('status'=>1,'msg'=>'查询成功','data'=>$time)));
		}else{
			return(json(array('status'=>0,'msg'=>'参数错误')));
		}
	}
	/**
	* [prosum_gd_list 工人工时详情列表]
	* @param post传参 t_id 种植任务id worker_id 工人id
	* @return [type] status 状态值 msg 返回信息 data 返回数据
	*/
	public function prosum_gd_list(){
		if($_REQUEST){
			if(!$_REQUEST['t_id']){
				return(json(array('status'=>0,'msg'=>'种植任务id为空')));
			}
			if(!$_REQUEST['worker_id']){
				return(json(array('status'=>0,'msg'=>'工人id为空')));
			}
			$worker = Db::name('worker')->where('worker_id',$_REQUEST['worker_id'])->field('worker_id,worker_name')->find();
			$where['p.status'] = array(['=',2],['=',3],'or');
			$where['p.worker_id'] = $_REQUEST['worker_id'];
			$where['p.t_id'] = $_REQUEST['t_id'];
			$time = Db::name('pro_worker_job')
				->alias('p')
				->join('work_skill w','w.skill_id = p.skill_id')
				->where('t_id',$_REQUEST['t_id'])
				->where($where)
				->field('w.skill_name,s_time,e_time')
				->select();
			$arr = array();
			if($time){
				$timenum = 0;
				foreach($time as $k=>$v){
					$arr[$k]['timeout'] = round((strtotime($v['e_time'])- strtotime($v['s_time']))/3600);
					$arr[$k]['skill_name'] = $v['skill_name'];
					$timenum += $arr[$k]['timeout'];
				}
				$worker['timenum'] = $timenum;
			}
			$worker['info'] = $arr;
			return(json(array('status'=>1,'msg'=>'查询成功','data'=>$worker)));
		}else{
			return(json(array('status'=>0,'msg'=>'参数错误')));
		}
	}
}