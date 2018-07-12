<?php

namespace app\home\controller;
use app\base\controller\Base;
use think\Loader;
use think\Db;

class Gd extends Base {

	public function lists() {
		$worker = $this->worker;

		$worker_id = $worker['worker_id'];
		$worker_code = $worker['worker_code'];
		$node_str = $worker['node_str'];
		$group_id = $worker['group_id'];
		$phone = trim($worker['phone']);
		$token = trim($worker['token']);

/*		$node_str = '2,5';
		$group_id = 1;
		$worker_id = 1;
		$worker_code = '1';*/

		if(strpos($node_str,',5') !== false){

			$code = 1;

			if($group_id != 1){

				$con['add_worker_id'] = $worker_id;
			}

			$con['status'] = array('neq',-1);
			$con['type'] = array('eq',1);

			$data = array();

			$data = Db::name('product_plan')->where($con)->field('plan_id,plan_name')->select();
			
			$arr = array();

			$con1['status'] = array(['gt',0],['lt',3]);

			foreach($data as $k=>$v){

				$find = Db::name('pro_grow_task')->where('plan_id',$v['plan_id'])->where($con1)->find();
				
				if($find){
					$arr[] = $v;
				}
			}

			$planlist = $arr;

		}else{

			$con['worker_id'] = $worker_id;
			$con['status'] = array(['gt',0],['lt',3]);

			$tasklist = db()->table('mf_pro_grow_task')

						->field('t_id,t_name')
						
						->where($con)
						
						->select();


			$code = 0;
		}

		$skill = Db::name('work_skill')->field('skill_id,skill_name')->select();

		$con2 = "w.status = 1 and FIND_IN_SET($worker_id ,worker_code)";

		$workers = Db::name('worker w')
				->field('w.worker_id,w.worker_name,r.node_str')
				->join('role r','r.role_id = w.role_id')
				->where($con2)
				->select();

		$array = array();
		$i = 0;

		if(!empty($workers)){
			foreach($workers as $k=>$v){
				if(strpos($v['node_str'],'13') !== false){
					$array[$i]['worker_id'] = $v['worker_id'];
					$array[$i]['worker_name'] = $v['worker_name'];
					$i++;
				}
			}

		}

		$worker = $array;

		$this->assign('code', $code);
		$this->assign('phone', $phone);
		$this->assign('token', $token);
		$this->assign('skill', $skill);
		$this->assign('worker', $worker);

		if($code == 1){

			$this->assign('planlist', $planlist);

		}else{

			$this->assign('tasklist', $tasklist);

		}
		return $this->fetch();
	}

	public function ajaxTask() {

		$plan_id = trim(request()->param('plan_id'));

		$con['b.plan_id'] = $plan_id;

		$con['b.status'] = array(['gt',0],['lt',3]);

		$task = db()->table('mf_pro_grow_task')

				->alias('b')

				->join('mf_product_plan a', 'a.plan_id = b.plan_id')

				->field('t_id,t_name')
				
				->where($con)
				
				->select();
	
		if($task){

			return json(['status' => 1, 'data' => $task]);

		}else{

			return json(['status' => 0,'msg'=>'种植任务查询为空' ,'data' =>array()]);
		}


	}

	public function ajaxArea() {

		$t_id	= trim(request()->param('task_id'));

		$info =  Db::name('pro_grow_task')
						->alias('b')
						->join('mf_product_plan p','b.plan_id = p.plan_id')
						->field('b.worker_id,p.cat_id,b.zhu_ju,b.hang_ju,b.grow_date,b.grow_mode_id')
						->where('b.t_id',$t_id)
						->find();
		$worker = Db::name('worker')->where('worker_id ='.$info['worker_id'])->value('worker_name');

		$child_info = Db::name('materiel_category')->field(['cat_id','cat_name','pid','cat_no'])->where('cat_id ='.$info['cat_id'])->find();
		
		$parent_info = Db::name('materiel_category')->field(['cat_id','cat_name'])->where('cat_id ='.$child_info['pid'])->find();

		$color_info = Db::name('fruits_color')->field(['ft_name','ft_id'])->where('cat_id = '.$info['cat_id'])->find();

		$type_info = Db::name('fruits_type')->field(['ft_name','ft_id'])->where('cat_id = '.$info['cat_id'])->find();

		$mode = Db::name('grow_mode')->where('mode_id = '.$info['grow_mode_id'])->value('mode_name');

		$area = db()->table('mf_pro_grow_task_area')
					->alias('b')
					->join('mf_grow_area a', 'a.area_id = b.area_id', 'LEFT')
					->where('b.t_id='.$t_id)
					->field('a.area_id,area_name,b.grow_num')
					->select();
		if($area){

			$data['area'] = $area;
			$data['area_list']['worker_name'] = $worker;
			$data['area_list']['cat_name'] = $child_info['cat_name'];
			$data['area_list']['cat_no'] = $child_info['cat_no'];
			$data['area_list']['p_cat_name'] = $parent_info['cat_name'];
			$data['area_list']['color'] = $color_info['ft_name'];
			$data['area_list']['type'] = $type_info['ft_name'];
			$data['area_list']['zhu_ju'] = $info['zhu_ju'];
			$data['area_list']['hang_ju'] = $info['hang_ju'];
			$data['area_list']['grow_date'] = $info['grow_date'];
			$data['area_list']['mode_name'] = $mode;

			return json(['status' => 1, 'data' => $data]);

		}else{

			return json(['status' => 0,'msg'=>'种植区域查询为空' ,'data' =>array()]);
		}							

	}

	public function ajaxNum() {

		$area_id	= trim(request()->param('area_id'));
		$t_id	= trim(request()->param('task_id'));

		$con['area_id'] = $area_id;
		$con['t_id'] = $t_id;

		$grow_num = db()->table('mf_pro_grow_task_area')
					->where($con)
					->value('grow_num');

		if($grow_num){

			$data = $grow_num;

			return json(['status' => 1, 'data' => $data]);

		}else{

			return json(['status' => 0,'msg'=>'种植任务信息查询为空' ,'data' =>array()]);
		}

	}

	public function ajaxUnit() {

		$skill_id	= trim(request()->param('skill_id'));

		$con['skill_id'] = $skill_id;

		$unit_str = Db::name('work_skill')->where($con)->value('unit_str');

		$unit = array();
		
		$unit_str = str_replace('，',',',$unit_str);

		$unit = explode(',',$unit_str);

		if($unit){

			$data = $unit;

			return json(['status' => 1, 'data' => $data]);

		}else{

			return json(['status' => 0,'msg'=>'工序单位查询为空' ,'data' =>array()]);
		}

	}

	public function add() {

		$t_id = trim(request()->param('t_id'));

		$area_id = trim(request()->param('area_id'));

		$skill_id = trim(request()->param('skill_id'));

		$worknum = trim(request()->param('worknum'));

		$unit_name = trim(request()->param('unit_name'));

		$date = trim(request()->param('date'));
	
		$s_time = trim(request()->param('s_time'));

		$e_time = trim(request()->param('e_time'));

		$day = trim(request()->param('day'));

		$workers = trim(request()->param('worker_id'));

		$num = trim(request()->param('num'));

		$info = Db::name('pro_grow_task')
			->alias('b')
			->join('product_plan p','b.plan_id = p.plan_id')
			->field('b.plan_id,p.plan_name,b.t_name')
			->where('b.t_id',$t_id)
			->find();

		$worker = $this->worker;
		$worker_id = $worker['worker_id'];
		//$worker_id = 1;

		$worker_name = Db::name('worker')->where('worker_id',$worker_id)->field('worker_id,worker_name')->find();

		$area = Db::name('grow_area')->where('area_id',$area_id)->field('area_id,area_name')->find();

		$skill = Db::name('work_skill')->where('skill_id',$skill_id)->field('skill_id,skill_name')->find();

		$workerlist = explode(',',$workers);

		$array = array();

		foreach($workerlist as $k=>$v){

			$array[$k] = Db::name('worker')->where('worker_id',$v)->field('worker_id,worker_name')->find();

		}

		$numlist = explode(',',$num);

		$date1 = date('Y/m/d',strtotime($date));

		$days = $day - 1;

		$date2 = date('Y/m/d',strtotime("+{$days} days",strtotime($date)));
		$s_time = date('H:i:s',strtotime($s_time));

		$e_time = date('H:i:s',strtotime($e_time));

		$data['t_id'] = $t_id;
		$data['plan_id'] = $info['plan_id'];
		$data['plan_name'] = $info['plan_name'];
		$data['t_name'] = $info['t_name'];
		$data['worker_name'] = $worker_name;
		$data['area_id'] = $area['area_id'];	
		$data['area_name'] = $area['area_name'];		
		$data['skill_id'] = $skill['skill_id'];	
		$data['skill_name'] = $skill['skill_name'];	
		$data['worker'] = $array;
		$data['num'] = $numlist;
		$data['date1'] = $date1;
		$data['date2'] = $date2;
		$data['s_time'] = $s_time;
		$data['e_time'] = $e_time;
		$data['work_num'] = $worknum;
		$data['unit'] = $unit_name;
		$data['day'] = $day;

		return json(['status' => 1, 'data' => $data]);
	}

	public function preview() {

		$worker = $this->worker;

		$phone = trim($worker['phone']);
		$token = trim($worker['token']);

		$this->assign('phone', $phone);
		$this->assign('token', $token);

		return $this->fetch();
	}

	public function confirm() {

		$t_id = $_POST['t_id'];

		$plan_id = $_POST['plan_id'];

		$area_id = $_POST['area_id'];

		$skill_id =  $_POST['skill_id'];

		$unit =  $_POST['unit'];

		$work_date =  $_POST['date1'];

		$require_time_1 =  $_POST['s_time'];

		$require_time_2 =  $_POST['e_time'];

		$add_worker = $_POST['worker_name'];

		$worker = $_POST['worker'];

		$days_num =  $_POST['day'];

		$work_num =  $_POST['work_num'];

		$num = $_POST['num'];


		if(!isset($plan_id)){

			$plan_id = Db::name('pro_grow_task')->where('t_id',$t_id)->value('plan_id');	
		}

		$plan_no = Db::name('product_plan')->where('plan_id',$plan_id)->value('plan_no');

		$data['t_id'] = $t_id;
		$data['plan_id'] = $plan_id;
		$data['plan_no'] = $plan_no;
		$data['area_id'] = $area_id;
		$data['skill_id'] = $skill_id;
		$data['unit'] = $unit;
		$data['require_time_1'] = $require_time_1;
		$data['require_time_2'] = $require_time_2;
		$data['add_worker_id'] = $add_worker['worker_id'];
		$data['plant_num'] = 0;
		$data['days_num'] = $days_num;
		$data['total_num'] = $work_num;
		$data['status'] = 0;

		for($i=0;$i<$days_num;$i++){

			$data['work_date'] = date('Y-m-d',($i*3600*24 + strtotime($work_date)));


			for($j=0;$j<count($worker);$j++){

				$data['gd_no'] = $this->get_plan_sn();
				$data['add_time'] = date('Y-m-d H:i:s',time());
				$data['worker_id'] = $worker[$j]['worker_id'];
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