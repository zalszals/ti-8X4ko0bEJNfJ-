<?php
namespace app\pc\controller;
use app\base\controller\Base;
use think\Db;

class WorkerOrder extends Base{
	/**
	 * [1 worker_manage_list 工人管理列表(此接口不需要分页)]
	 * @param post传参 
	 * @return [type] status 状态值 msg 返回信息 data 返回数据
	 */
	public function worker_manage_list(){
		//获取变量
		$mark = $this->request->param('mark');
		$sort = $this->request->param('sort');
		//$page = $this->request->param('page');
		$worker = $this->worker;
		$group_id = $worker['group_id'];
		$worker_id = $worker['worker_id'];
		$worker_code = $worker['worker_code'];
		$role_id = $worker['role_id'];
		$row = 3;
		//验证变量
		
		/* if($page==1||!$page){
			$page=0;
		}else{
			$page = ($page-1)*$row;
		} */
		
		if(!$sort){
			$sort=1;
		}
		
		
		$where_son = '';		
		switch($mark){
			case 1:
				$start_time = date('Y-m-01',time());
				$end_time = date('Y-m-d',strtotime("$start_time +1 month -1 day"));
				//$con['check_time'] = array(['egt',$start_time],['elt',$end_time],'and');
				$where_son .= "and (wj.work_date between '{$start_time}' and '{$end_time}') and wj.status = 3 ";
				break;
			case 2:
				$start_time = date('Y-m-d', (time() - ((date('w') == 0 ? 7 : date('w')) - 1) * 24 * 3600)); 
				$end_time = date('Y-m-d', (time() + (7 - (date('w') == 0 ? 7 : date('w'))) * 24 * 3600));
				//$con['check_time'] = array(['egt',$start_time],['elt',$end_time],'and');
				$where_son .= "and (wj.work_date between '{$start_time}' and '{$end_time}') and wj.status = 3 ";
				break;
			default:
				$where_son .= "and wj.status = 3 ";	
				break;	
		}
		
		$sorce_sql = "select avg(score) from mf_pro_worker_job wj where wj.worker_id = w.worker_id {$where_son}";
		
		$sql  = "select w.worker_name,w.worker_id,w.sex,r.role_name,w1.worker_name as p_name,r1.role_name as p_rname,({$sorce_sql}) as score from mf_worker w ";
		$sql .= "inner join mf_worker w1 on w1.worker_id = w.pid ";
		$sql .= "inner join mf_role r on r.role_id = w.role_id ";		
		$sql .= "inner join mf_role r1 on r1.role_id = w1.role_id ";
		$sql .= "inner join mf_pro_worker_job wj on wj.worker_id = w.worker_id ";
		//$sql .= "where w.group_id <> 1 ";
		$where = '';
		if($role_id != 1){
			$where = " where w.worker_code like '%{$worker_code}%' and wj.status = 3 and w.status = 1 ";
		}else{
			$where = " where wj.status = 3 and w.status = 1 ";
		}	
		
		switch($sort){
			case 1:
				$order = 'order by score desc';
				$group =  'group by w.worker_id ';
				$sql .= $where.$where_son.$group.$order;
				$arrayInfo = Db::query($sql);
				//$name_array = array();
				foreach($arrayInfo as $k => $row){
					if($row['sex'] == 0){
						$arrayInfo[$k]['sex'] = '女';
					}else{
						$arrayInfo[$k]['sex'] = '男';
					}
					
					if(!$row['score']){
						unset($arrayInfo[$k]);	
					}
				}
				$arr2=array();    
				foreach($arrayInfo as $key=>$value){
					$arr2[] = $value;
				}
				break;
			case 2:
				$order = 'order by score';
				$group =  'group by w.worker_id ';
				$sql .= $where.$where_son.$group.$order;
				$arrayInfo = Db::query($sql);
				//$name_array = array();
				foreach($arrayInfo as $k => $row){
					if($row['sex'] == 0){
						$arrayInfo[$k]['sex'] = '女';
					}else{
						$arrayInfo[$k]['sex'] = '男';
					}
					
					if(!$row['score']){
						unset($arrayInfo[$k]);	
					}
				}
				$arr2=array();    
				foreach($arrayInfo as $key=>$value){
					$arr2[] = $value;
				}
				break;
			case 3:
				$group = 'group by w.worker_id';
				$sql .= $where.$where_son.$group;
				//print_r($sql);die;
				$arrayInfo = Db::query($sql);
				$name_array = array();
				foreach($arrayInfo as $k => $row){
					if(!$row['score']){
						unset($arrayInfo[$k]);	
					}
					if($row['score']){
						$name = $row['worker_name'];
						$char = $this->getFirstCharter($name); 
						$name_array[$char][] = $row;
					} 
				}
				ksort($name_array);
				$arrayInfo = $name_array;
				$arr2=array();    
				foreach($arrayInfo as $key=>$value){
					foreach($value as $k2=>$v2){
						if($v2['sex'] == 0){
							$v2['sex'] = '女';
						}else{
							$v2['sex'] = '男';
						}
						$arr2[] = $v2;
					}
				}
				//dump($arr2);die;
		}
		
		$total = count($arrayInfo);
		$re['status'] = 1;
		$re['msg'] = '获取成功';
		$re['total'] = $total;
		$re['data'] = $arr2;
		
		ajaxReturnJson($re);	
	}
	/**
	* [worker_old_list 工人历史工单列表]
	* @param post传参 worker_id 工人id
	* @return [type] status 状态值 msg 返回信息 data 返回数据
	*/
	public function worker_old_list(){
		//获取变量
		$worker_id = $this->request->param('worker_id');
		//验证变量
		if(!$worker_id){
			$result['status'] = 0;
			$result['msg'] = "工人编号为空";
			ajaxReturnJson($result);
		}
		//程序主体
		$con1['wj.worker_id'] = $worker_id;
		$con1['wj.status'] = 3;
		
		$field[] = 'wj.worker_id';
		$field[] = 'wj.gd_id';
		$field[] = 'wj.work_date';
		$field[] = 'wj.require_time_1';
		$field[] = 'wj.require_time_2';
		$field[] = 'wj.num';
		$field[] = 'wj.unit';
		$field[] = 'wj.real_num';
		$field[] = 'wj.status';
		$field[] = 'wj.check_time';
		$field[] = 'wj.s_time';
		$field[] = 'wj.e_time';
		$field[] = 'wj.score';
		$field[] = 'wj.photo';
		$field[] = 'ws.skill_name';
		$field[] = 'ga.area_name';
		$field[] = 'w1.worker_name as check_worker_name';
		$field[] = 'r.role_name';
		$field[] = 'w.worker_name as wname';
		
		
		$wj_list = Db::name('pro_worker_job wj')
				->field(implode(',',$field))
				->join('work_skill ws','ws.skill_id = wj.skill_id')
				->join('grow_area ga','ga.area_id = wj.area_id')
				->join('worker w','w.worker_id = wj.worker_id')
				->join('worker w1','w1.worker_id = wj.check_worker_id')
				->join('role r','r.role_id = w1.role_id')
				->where($con1)
				->select();
				
		if($wj_list){
			foreach($wj_list as $k=>$v){
				$photo = explode(',',$v['photo']);
				$wj_list[$k]['photo'] = $photo;
			}
			$data['worker_id'] = $v['worker_id'];
			$data['worker_name'] = $v['wname'];
			$data['info'] = $wj_list;
			$data1[] = $data;
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $data1;
			ajaxReturnJson($result);
		}else{
			$data1 = array();
			$result['status'] = 0;
			$result['msg'] = "暂无数据";
			$result['data'] = array();
			ajaxReturnJson($result);
		}
	}

	/**
	* [gd_check_list 工单审核列表]
	* @param post传参 
	* @return [type] status 状态值 msg 返回信息 data 返回数据
	*/
	public function gd_check_list(){
		
		$page = request()->param('page');
		$type = request()->param('type');
		$start = request()->param('start');
		$end = request()->param('end');
		$worker = request()->param('worker');
		if(!isset($type)){
			return(json(array('status'=>0,'msg'=>'type值有误')));	
		}
		if($type != 0){
			if(!$type){
				return(json(array('status'=>0,'msg'=>'type值有误')));	
			}
		}
		if($start){

			$condition['w.work_date'] = array('egt',date('Y-m-d',strtotime($start)));
		}

		if($end){

			$condition['w.work_date'] = array('elt',date('Y-m-d',strtotime($end)));
		}

		if($start && $end){
			$condition['w.work_date'] = array(array('egt',date('Y-m-d',strtotime($start))),array('elt',date('Y-m-d',strtotime($end))));
		}

		if($worker){
			$condition['e.worker_name'] = array('like','%'.trim($worker).'%');
		}
		$row = 3;
    	if($page==1 || !$page){
            $page=0;
        }else{
            $page=($page-1)*$row;
        }
        $worker = $this->worker;
		$worker_id = $worker['worker_id'];
		$con = "e.status = 1 and FIND_IN_SET($worker_id ,worker_code)";
/*			if(strpos($worker['node_str'],'8') !== false){
			$condition['ps.worker_id'] = $worker_id;
		}elseif(strpos($worker['node_str'],'151') !== false){
			$condition['t.worker_id'] = $worker_id;
		}*/
        $arr = array();
        $data = array();
        /*if($type==0){
        	$condition['w.status'] = array('lt',3);
        }else{
        	$condition['w.status'] = array('eq',3);
        }*/
        switch($type){
        	case 0:
        		$condition['w.status'] = array('eq',0);
        		break;

        	case 1:
				$condition['w.status'] = array('eq',1);
        		break;

        	case 2:
        		$condition['w.status'] = array('eq',2);
        		break;

        	case 3:
        		$condition['w.status'] = array('eq',3);
        		break; 
        }
		$job_info = Db::name('pro_worker_job')
				->alias('w')
				->join('work_skill s','w.skill_id = s.skill_id')
				->join('grow_area a','w.area_id = a.area_id')
				->join('worker e','w.worker_id = e.worker_id')
				->join('role r','e.role_id = r.role_id')
				->join('mf_pro_grow_task t','w.t_id = t.t_id')
				->where($condition)
				->where($con)
				->field('w.gd_id,w.work_date,w.add_time,w.require_time_1,w.require_time_2,w.s_time,w.e_time,w.num,w.unit,w.status,s.skill_name,a.area_name,e.worker_name,e.worker_id')
				->order('w.add_time desc')
				->paginate(8);
		$page = $job_info->render();
        $list = $job_info->items();        
        $jsonStr = json_encode($job_info);
        $info = json_decode($jsonStr,true);
        $pages = $info['last_page']; 
        $page_list = array();
        $page_list['page'] = $page;
        $page_list['pages'] = $pages;
		if($info['data']){
			foreach($info['data'] as $k1=>$v1){
				if(!$info['data'][$k1]['s_time']){
					$info['data'][$k1]['s_time'] = '';
				}
				if(!$info['data'][$k1]['e_time']){
					$info['data'][$k1]['e_time'] = '';
				}
				$info['data'][$k1]['require_time_1'] = date('H:i',strtotime($info['data'][$k1]['require_time_1']));
				$info['data'][$k1]['require_time_2'] = date('H:i',strtotime($info['data'][$k1]['require_time_2']));
				$info['data'][$k1]['add_time'] = date('Y-m-d',strtotime($info['data'][$k1]['add_time']));
			}
			$arr[] = $info['data'];
		}
		if($arr){
			foreach($arr as $k=>$v){
				foreach($v as $k1=>$v1){
					$data[] = $v1;
				}
			}
		}
		return(json(array('status'=>1,'msg'=>'查询成功','data'=>$data,'total'=>$page_list)));	
	}
	/**
	* [gd_old_list 工单详情列表]
	* @param post传参 
	* @return [type] status 状态值 msg 返回信息 data 返回数据
	*/
	public function gd_old_list(){
		//获取变量
		$gd_id = $this->request->param('gd_id');
		//验证变量
		if(!$gd_id){
			$result['status'] = 0;
			$result['msg'] = "工单id为空";
			ajaxReturnJson($result);
		}
		//程序主体
		$con['wj.gd_id'] = $gd_id;
		
		$field[] = 'wj.worker_id';
		$field[] = 'wj.gd_id';
		$field[] = 'wj.work_date';
		$field[] = 'wj.require_time_1';
		$field[] = 'wj.require_time_2';
		$field[] = 'wj.num';
		$field[] = 'wj.unit';
		$field[] = 'wj.real_num';
		$field[] = 'wj.status';
		$field[] = 'wj.check_time';
		$field[] = 'wj.s_time';
		$field[] = 'wj.e_time';
		$field[] = 'wj.score';
		$field[] = 'wj.photo';
		$field[] = 'wj.beizhu';
		$field[] = 'wj.check_worker_id';
		$field[] = 'ws.skill_name';
		$field[] = 'ga.area_name';
		$field[] = 'w.worker_name as wname';
		$field[] = 'w1.worker_name as add_worker_name';
		$field[] = 't.t_name';
		
		
		$wj_list = Db::name('pro_worker_job wj')
				->field(implode(',',$field))
				->join('pro_grow_task t','t.t_id = wj.t_id')
				->join('work_skill ws','ws.skill_id = wj.skill_id')
				->join('grow_area ga','ga.area_id = wj.area_id')
				->join('worker w','w.worker_id = wj.worker_id')
				->join('worker w1','w1.worker_id = wj.add_worker_id')
				->where($con)
				->find();
		$list =  Db::name('worker w')->join('role r','r.role_id = w.role_id')->where('w.worker_id',$wj_list['check_worker_id'])->field('worker_name,role_name')->find();

		$wj_list['check_worker_name'] = $list['worker_name'];
		$wj_list['role_name'] = $list['role_name'];

		$photo = explode(',',$wj_list['photo']);
		$wj_list['photo'] = $photo;

		if(!$wj_list['photo']){
			$wj_list['photo'] = array();
		}

		if(!$wj_list['beizhu']){
			$wj_list['beizhu'] = '';
		}

		if(!$wj_list['s_time']){
			$wj_list['s_time'] = '';
		}

		if(!$wj_list['e_time']){
			$wj_list['e_time'] = '';
		}

		if(!$wj_list['check_time']){
			$wj_list['check_time'] = '';
		}

		if(!$wj_list['check_worker_id']){
			$wj_list['check_worker_id'] = '';
		}

		if(!$wj_list['check_worker_name']){
			$wj_list['check_worker_name'] = '';
		}

		if(!$wj_list['role_name']){
			$wj_list['role_name'] = '';
		}

		if($wj_list){
			$data['info'] = $wj_list;
			$data1[] = $data;
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $data1;
			ajaxReturnJson($result);
		}else{
			$data1 = array();
			$result['status'] = 0;
			$result['msg'] = "暂无数据";
			$result['data'] = array();
			ajaxReturnJson($result);
		}
	}
	//工单核查界面
	public function edit(){
		$gd_id = request()->param('gd_id');
		if(!$gd_id){
			return json(['status'=>0,'msg'=>'工单id有误']);
		}
		$con['wj.gd_id'] = $gd_id;
		$wj_list = Db::name('pro_worker_job wj')
			->field('wj.gd_id,ws.skill_id,ws.skill_name,wj.num,wj.unit')
			->join('work_skill ws','ws.skill_id = wj.skill_id')
			->where($con)
			->find();
		return json(['status'=>1,'msg'=>'查询成功','data'=>$wj_list]);
	}
	/**
	* [gd_check 工单审核]
	* @param post传参  gd_id工单id real_num 实际完成量 score评分 beizhu 备注 image 图片
	* @return [type] status 状态值 msg 返回信息
	*/

	public function gd_check(){
		if($_REQUEST){
			if(!$_REQUEST['real_num'] && !isset($_REQUEST['real_num'])){
				return(json(array('status'=>0,'msg'=>'请输入实际完成量')));
			}
			if(!$_REQUEST['score'] && !isset($_REQUEST['score'])){
				return(json(array('status'=>0,'msg'=>'请输入评分')));
			}
			if(!$_REQUEST['gd_id'] && !isset($_REQUEST['gd_id'])){
				return(json(array('status'=>0,'msg'=>'不存在工单')));
			}
			$con['gd_id'] = $_REQUEST['gd_id'];
			$worker = $this->worker;
			$data['check_worker_id'] = $worker['worker_id'];
			$data['check_time'] = date('Y-m-d H:i:s',time());
			$data['status'] = 3;
			$data['real_num'] = $_REQUEST['real_num'];
			$data['score'] = $_REQUEST['score'];
			if(isset($_REQUEST['beizhu'])){
				$data['beizhu'] = $_REQUEST['beizhu'];
			}else{
				$data['beizhu'] = '';
			}
			/*$files = request()->file('photo');
			$arr = array();
			if($files){
				foreach($files as $k=>$file){
					$info = $file->validate(['ext'=>'jpg,png,gif'])->move(ROOT_PATH.'public/upload/');
					if($info){
		                $arr[] = 'http://27.221.53.90:880/upload/'.str_replace("\\","/",$info->getSaveName());
		            }else{
		                // 上传失败获取错误信息
		                $msg = $file->getError();
		                return(json(array('status'=>0,'msg'=>$msg)));
		            }
				}
			}
			$data['photo'] = implode(',',$arr);*/
			if(isset($_REQUEST['photo'])&&$_REQUEST['photo']){
				$image = explode(',',$_REQUEST['photo']);
				$photo  = base64_decode($image[1]);
				//$root = str_replace('/index.php','',request()->root(true));
				$filename = date('YmdHis',time());
				$result = file_put_contents('./upload/'.$filename.'.jpg',$photo);
				if($result){
					//$data['photo'] = $root.'/upload/'.$filename.'.jpg';
					//$data['photo'] = 'http://27.221.53.90:881/upload/'.$filename.'.jpg';
					$data['photo'] = 'http://'. $_SERVER["HTTP_HOST"].'/upload/'.$filename.'.jpg';
				}
			}
			$re = Db::name('pro_worker_job')->where($con)->update($data);

			$add_worker_id = Db::name('pro_worker_job')->where($con)->value('worker_id');
			$p = Db::name('worker')->where('worker_id',$add_worker_id)->value('phone');

			if($re !== false){

				$title='工单消息提醒';
				$content='有新的完成工单';
				$phone = trim($p);
				pushMess($title,$content,$phone);

				//种植任务汇总表（更新用工用时）
				$re_info = Db::name('pro_worker_job')->where($con)->field('e_time,s_time,t_id,plan_id')->find();
				if($re_info){
					$e_time = strtotime($re_info['e_time']); 
					$s_time = strtotime($re_info['s_time']);
					$cha_time = ($s_time - $e_time)/3600;
					$con2['t_id'] = $re_info['t_id'];
					$con3['plan_id'] = $re_info['plan_id'];
					db('task_sum')->where($con2)->setInc('working_time_z',$cha_time);  //用工用时 //种植任务汇总表（更新用工用时）
					db('pro_sum')->where($con3)->setInc('working_time_z',$cha_time);  //用工用时 //生产计划汇总表（更新用工用时）
					$cat_id = db('product_plan')->where($con3)->value('cat_id');
					$con4['cat_id'] = $cat_id;
					db('mc_sum')->where($con4)->setInc('working_time_z',$cha_time);  //用工用时 //品种汇总表（更新用工用时）

					//2018-05-05 工人工资 计算规则 宗
				
						$doprice = \think\Loader::controller('workerwages/workerwages');
						$dosum = $doprice->workerwages_wages_count(); 

					//2018-05-05 工人工资 计算规则 宗
					
				}

				
				
				return(json(array('status'=>1,'msg'=>'审核成功')));
			}else{
				return(json(array('status'=>0,'msg'=>'审核失败')));
			}
		}else{
			return(json(array('status'=>0,'msg'=>'参数错误')));
		}	
	}

	//按工序添加工单
	public function confirm() {
		
		$plan_id = trim(request()->param('plan_id'));

		$t_id = trim(request()->param('t_id'));
		
		$area_id = trim(request()->param('area_id'));

		$skill_id = trim(request()->param('skill_id'));

		$work_num = trim(request()->param('worknum'));

		$unit = trim(request()->param('unit_name'));

		$date = trim(request()->param('date'));
	
		$s_time = trim(request()->param('s_time'));

		$e_time = trim(request()->param('e_time'));

		$days_num = trim(request()->param('day'));

		$workers = trim(request()->param('worker_id'));

		$nums = trim(request()->param('num'));

		$worker = $this->worker;
		if(strpos($worker['node_str'],',5') !== false){
			if(!$plan_id){
				return json(['status'=>0,'msg'=>'请选择生产计划']);
			}
		}

		if(!$t_id){
			return json(['status'=>0,'msg'=>'请选择种植任务']);
		}

		if(!$area_id){
			return json(['status'=>0,'msg'=>'请选择种植区域']);
		}

		if(!$skill_id){
			return json(['status'=>0,'msg'=>'请选择工序']);
		}
		if(!$work_num){
			return json(['status'=>0,'msg'=>'请输入工作量']);
		}
		if(!$date){
			return json(['status'=>0,'msg'=>'请选择工作日期']);
		}
		if(!$s_time){
			return json(['status'=>0,'msg'=>'请选择开始时间']);
		}
		if(!$e_time){
			return json(['status'=>0,'msg'=>'请选择结束时间']);
		}
		if(!$days_num){
			return json(['status'=>0,'msg'=>'请输入持续天数']);
		}
		if(!preg_match("/^[1-9][0-9]*$/",$days_num)){
			return json(['status'=>0,'msg'=>'持续天数必须为整数']);
		}
		if(!$workers){
			return json(['status'=>0,'msg'=>'请选择工人']);
		}
		if(!$nums){
			return json(['status'=>0,'msg'=>'请输入工人工作量']);
		}

		$work_date = date('Y/m/d',strtotime($date));

		$require_time_1 = date('H:i:s',strtotime($s_time));

		$require_time_2 = date('H:i:s',strtotime($e_time));

		if(!$plan_id){

			$plan_id = Db::name('pro_grow_task')->where('t_id',$t_id)->value('plan_id');	
		}

		$plan_no = Db::name('product_plan')->where('plan_id',$plan_id)->value('plan_no');

		$worker_id = $this->worker['worker_id'];

		$worker = explode(',',$workers);
		$num = explode(',',$nums);

		if(count($worker) != count($num)){
			return json(['status'=>0,'msg'=>'请完善工人信息']);
		}
		$data['t_id'] = $t_id;
		$data['plan_id'] = $plan_id;
		$data['plan_no'] = $plan_no;
		$data['area_id'] = $area_id;
		$data['skill_id'] = $skill_id;
		$data['unit'] = $unit;
		$data['require_time_1'] = $require_time_1;
		$data['require_time_2'] = $require_time_2;
		$data['add_worker_id'] = $worker_id;
		$data['plant_num'] = 0;
		$data['days_num'] = $days_num;
		$data['total_num'] = $work_num;
		$data['status'] = 0;

		for($i=0;$i<$days_num;$i++){

			$data['work_date'] = date('Y-m-d',($i*3600*24 + strtotime($work_date)));


			for($j=0;$j<count($worker);$j++){

				$data['gd_no'] = $this->get_plan_sn();
				$data['add_time'] = date('Y-m-d H:i:s',time());
				$data['worker_id'] = $worker[$j];
				$data['num'] = $num[$j];

				$res = Db::name('pro_worker_job')->insertGetId($data);

				$p = Db::name('worker')->where('worker_id',$data['worker_id'])->value('phone');

				$title='工单消息提醒';
				$content='您有新的工单';
				$phone = trim($p);
				pushMess($title,$content,$phone);			
			}
		}
		if($res){
			$status = Db::name('pro_grow_task')->where('t_id',$t_id)->value('status');
			if($status == 1){
				$resu = Db::name('pro_grow_task')->where('t_id',$t_id)->setField('status',2);
			}	
			$result['status'] = 1;
			$result['msg'] = "发布工单成功！";
			 
		}else{
			$result['status'] = 0;
			$result['msg'] = "发布工单失败！";
		 
		}
		
		return json($result);
	}

	/**
	* [getFirstCharter 获取姓氏首字母]
	* @param 参数 姓名字符串
	* @return [type] return返回数据
	*/
	public function getFirstCharter($str){ 
		if(empty($str)){return '';} 
		$fchar=ord($str{0}); 
		if($fchar>=ord('A')&&$fchar<=ord('z')) return strtoupper($str{0}); 
		$s1=iconv('UTF-8','gb2312',$str); 
		$s2=iconv('gb2312','UTF-8',$s1); 
		$s=$s2==$str?$s1:$str; 
		$asc=ord($s{0})*256+ord($s{1})-65536; 
		if($asc>=-20319&&$asc<=-20284) return 'A'; 
		if($asc>=-20283&&$asc<=-19776) return 'B'; 
		if($asc>=-19775&&$asc<=-19219) return 'C'; 
		if($asc>=-19218&&$asc<=-18711) return 'D'; 
		if($asc>=-18710&&$asc<=-18527) return 'E'; 
		if($asc>=-18526&&$asc<=-18240) return 'F'; 
		if($asc>=-18239&&$asc<=-17923) return 'G'; 
		if($asc>=-17922&&$asc<=-17418) return 'H'; 
		if($asc>=-17417&&$asc<=-16475) return 'J'; 
		if($asc>=-16474&&$asc<=-16213) return 'K'; 
		if($asc>=-16212&&$asc<=-15641) return 'L'; 
		if($asc>=-15640&&$asc<=-15166) return 'M'; 
		if($asc>=-15165&&$asc<=-14923) return 'N'; 
		if($asc>=-14922&&$asc<=-14915) return 'O'; 
		if($asc>=-14914&&$asc<=-14631) return 'P'; 
		if($asc>=-14630&&$asc<=-14150) return 'Q'; 
		if($asc>=-14149&&$asc<=-14091) return 'R'; 
		if($asc>=-14090&&$asc<=-13319) return 'S'; 
		if($asc>=-13318&&$asc<=-12839) return 'T'; 
		if($asc>=-12838&&$asc<=-12557) return 'W'; 
		if($asc>=-12556&&$asc<=-11848) return 'X'; 
		if($asc>=-11847&&$asc<=-11056) return 'Y'; 
		if($asc>=-11055&&$asc<=-10247) return 'Z'; 
		return null; 
	}

	private function get_plan_sn(){
		//获取变量
		$shijian = date('Ymd');//当天时间
		$con['plan_date'] = array('eq',$shijian);
		$number = Db::name('pro_worker_job')->count();
		$number++;
		//填充0；str_pad()填充字符串；STR_PAD_LEFT:填充到字符串的左侧
		
		$numbered = str_pad($number,3,"0",STR_PAD_LEFT);
		
		//$head = Db::name('confing_prex')->where('prex_id=2')->value('prex_name');
		$plan_no = 'PG'.$shijian.$numbered;
		return $plan_no;
	}
}