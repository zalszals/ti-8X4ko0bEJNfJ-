<?php
namespace app\product\controller;
use app\base\controller\Base;
use think\Db;
class Workorder extends Base{
	
	
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

	/**
     * [get_work_plan 查询生产计划]
     * @return [type] [description]
     */
    public function get_work_plan(){

		
		$worker = $this->worker;
		
		$worker_id = $worker['worker_id'];

		$group_id = $worker['group_id'];

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

		$result['status'] = 1;

		$result['msg'] = "获取成功";

		$result['data'] = $arr;

		ajaxReturnJson($result);
    }

	/**
     * [get_plan_order 查询种植任务]
     * @return [type] [description]
     */
    public function get_plan_order(){
		
		$worker = $this->worker;

		$worker_id = $worker['worker_id'];


		if(strpos($worker['node_str'],',5') !== false){

			$plan_id = $this->request->param('plan_id');

			if(!$plan_id){

				$result['status'] = 0;

				$result['msg'] = "无效的id值";

				ajaxReturnJson($result);
			}

			$con['b.plan_id'] = $plan_id;
		
		}else{

			$con['b.worker_id'] = $worker_id;
		
		}

		$con['b.status'] = array(['gt',0],['lt',3]);
 
		$task = db()->table('mf_pro_grow_task')

		->alias('b')

		->join('mf_product_plan a', 'a.plan_id = b.plan_id')

		->field('t_no,t_name,t_id,b.plan_id,a.cat_id,a.add_worker_id as worker_id,b.add_worker_id as ps_worker_id,b.worker_id as add_worker_id,plan_name')
		
		->where($con)
		
		->select();

		$work_info = Db::name('work_skill')->field('skill_id,skill_name,unit_str')->select();
		
		foreach($work_info as $k=>$v){
			
			$v['unit_str'] = str_replace('，',',',$v['unit_str']);
			
			$new_unit = explode(',',$v['unit_str']);
			
			if(is_array($new_unit)){
				
			}else{

				$new_unit = explode('，',$v['unit_str']);
			}
			
			$work_info[$k]['new_unit'] = $new_unit;
		}
		
 
		if(empty($data) && empty($work_info)){
				
			$result['status'] = 0;
			
			$result['msg'] = "查询数据为空";
			
			$result['data'] = array();
			
			$result['work_info'] = array();
			
			return json($result);
		}else{
			
			$result['status'] = 1;
			
			$result['msg'] = "已查询到数据";
			
			$result['data'] = $task;
			
			$result['work_info'] =$work_info;

			return json($result);
		}
 
    }
	
	/**
     * [get_plan_orderinfo 查询生产任务详情]11
     * @return [type] [description]
     */
    public function get_plan_orderinfo(){
	
		$plan_id = $this->request->param('plan_id');
		$t_id = $this->request->param('t_id');
		$cat_id = $this->request->param('cat_id');
		$add_worker_id = $this->request->param('add_worker_id');
 
		
		if(!$plan_id || !$t_id || !$cat_id || !$add_worker_id){
			$result['status'] = 0;
			$result['msg'] = "参数错误";
			$result['data'] = array();
			/* echo json_encode($result);die; */
			return json($result);
		}
		
	 
		$return_info = array();
		
		//获取负责人信息
		$work_people =  Db::name('worker')->field('worker_id,worker_name')->where('worker_id = '.$add_worker_id)->find();
		
		//获取果型 国色 品种
		
		$child_info = Db::name('materiel_category')->field(['cat_id','cat_name','pid'])->where('cat_id ='.$cat_id)->find();
		
		$parent_info = Db::name('materiel_category')->field(['cat_id','cat_name'])->where('cat_id ='.$child_info['pid'])->find();
		
		$color_info = Db::name('fruits_color')->field(['ft_name','ft_id'])->where('cat_id = '.$cat_id)->find();// 查询所有果色
		$type_info = Db::name('fruits_type')->field(['ft_name','ft_id'])->where('cat_id = '.$cat_id)->find();// 查询所有果型
		
		//获取种植任务信息
		
		$grow_task =  Db::name('pro_grow_task')->field('grow_mode_id,t_name,zhu_ju,hang_ju,total_grow_num,grow_date')->where('t_id = '.$t_id)->find();
		
		if($grow_task['grow_mode_id']){
			$model_info = Db::name('grow_mode')->field(['mode_name'])->where('mode_id = '.$grow_task['grow_mode_id'])->find();
		
			if($model_info['mode_name']){
				$return_info['mode_name'] =$model_info['mode_name'];
			}else{
				$return_info['mode_name'] = array();
			}
		}
		//获取种植区域
 
		$area_info = 
		db()->table('mf_pro_grow_task_area')
		->alias('b')
		->join('mf_grow_area a', 'a.area_id = b.area_id', 'LEFT')
		->where('b.t_id='.$t_id)
		->field('a.area_id,area_name,b.grow_num')
		->select();
		if($area_info){
			$return_info['area_info'] = $area_info;
		}else{
			$return_info['area_info'] = array();
		}
	 
		//获取工人信息
		$worker = $this->worker;
		$worker_id = $worker['worker_id'];
		$worker_code = $worker['worker_code'];
		
		/*$con1['status'] = 1; 
		$con1['worker_code'] = array('like','%'.$worker_code.'%');*/
		
		$con1 = "w.status = 1 and FIND_IN_SET($worker_id ,worker_code)";
			
		$workers = Db::name('worker w')
				->field('w.worker_id,w.worker_name,r.node_str')
				->join('role r','r.role_id = w.role_id')
				->where($con1)
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
			$return_info['work_info'] = $array;
		}else{
			$return_info['work_info']= array();
		}
		
		
		if($work_people){
			$return_info['work_name'] = $work_people['worker_name'];
		}else{
			$return_info['work_name'] = '';
		}
		if($child_info){
			$return_info['child_name'] = $child_info['cat_name'];
		}else{
			$return_info['child_name'] = '';
		}
		if($parent_info){
			$return_info['parent_name'] = $parent_info['cat_name'];
		}else{
			$return_info['parent_name'] = '';
		}
		if($color_info){
			$return_info['color_info'] = $color_info['ft_name'];
		}else{
			$return_info['color_info'] = '';
		}
		if($type_info){
			$return_info['type_info'] = $type_info['ft_name'];
		}else{
			$return_info['type_info'] = '';
		}
		$return_info['grow_task'] = $grow_task;
		
		$result['status'] = 1;
		$result['msg'] = "已查询到数据";
		$result['data'] =$return_info;
		 
 
 
		return json($result);
 
    }
	
	public function add_worker_job(){
 
 
		$array_info = $this->request->param('array_info');	

		$t_id = $this->request->param('t_id');	 
		$array_info = json_decode($array_info,true);
 		
		$plan_info = '';
		
		
		//根据tid获取
		$task_info = Db::name('pro_grow_task')->field('plan_id,ps_id')->where('t_id = '.$t_id)->find();
		if($task_info){
			$plan_id = $task_info['plan_id'];
			$ps_id = $task_info['ps_id'];
			$plan_info = Db::name('product_plan')->field('plan_no')->where('plan_id = '.$plan_id)->find();
		}else{
			
		}
		if($plan_info){
			$plan_no = $plan_info['plan_no'];
		}else{
			
		}
		$num = count($array_info);
		for($i=0;$i<$num;$i++){
			$array_info[$i][11]=$plan_no;
			$array_info[$i][12]=$plan_id;
			$array_info[$i][13]=$ps_id;
			//$array_info[$i][14] =$this->get_plan_sn();
			
		}
		//获取工人信息
		$worker = $this->worker;
		$group_id = $worker['group_id'];
		$worker_id = $worker['worker_id'];

		for($i=0;$i<$num;$i++){		 
			$days =  (int)$array_info[$i][10];
 
			for($j=0;$j<$days;$j++){
	 
				$new_time = '';
				if($j==0){
					$array_info[$i][9] = $array_info[$i][9];
				}else{
					$new_time  = strtotime($array_info[$i][9]); 
					$new_time = $j*3600*24 + $new_time;
					
					$array_info[$i][9] = date('Y-m-d',$new_time);
							 
				}
				 
			 
				
				//循环插入多条工单
				$data['t_id'] = $array_info[$i][0];
				$data['worker_id'] = $array_info[$i][1];
				$data['area_id'] = $array_info[$i][2];
				$data['plant_num'] = $array_info[$i][3];
				$data['skill_id'] = $array_info[$i][4];
				$data['unit'] = $array_info[$i][5];
				$data['num'] = $array_info[$i][6];
				$data['require_time_1'] = $array_info[$i][7];
				$data['require_time_2'] = $array_info[$i][8];
				$data['work_date'] = $array_info[$i][9];
				$data['days_num'] = $array_info[$i][10];
				$data['plan_no'] = $array_info[$i][11];
				$data['plan_id'] = $array_info[$i][12];
				$data['ps_id'] = $array_info[$i][13];
				$data['gd_no'] = $this->get_plan_sn(); 
				$data['add_worker_id'] =$worker_id; 
				$data['add_time'] = date('Y-m-d H:i:s',time());
				
			 
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
	 * [get_gd_num 获取个人发布的工单各种状态的数量]
	 * @return [type] [description]
	 */
	public function get_gd_num()
	{
		$worker_id = $this->worker['worker_id'];
		$sql = "select worker_id from mf_worker where FIND_IN_SET('{$worker_id}',worker_code)";
		$arr = Db::query($sql);
		/*$arr = db('worker')
			->where('worker_code','exp',"FIND_IN_SET('{$worker_id}',worker_code)")
			->select();*/

		$worker_id_arr = [];
		foreach($arr as $v){
			$worker_id_arr[] = $v['worker_id'];
		}

		$condition['worker_id'] = array('in',$worker_id_arr);
		$condition['status'] = 0;

		$num_1 = db('pro_worker_job')->where($condition)->count();

		$condition['status'] = 1;
		$num_2 = db('pro_worker_job')->where($condition)->count();

		$condition['status'] = 2;
		$num_3 = db('pro_worker_job')->where($condition)->count();

		$re['status'] = 1;
		$re['data'] = [$num_1,$num_2,$num_3];
		ajaxReturnJson($re);
	}
 
 	/**
	 * [del_gd]
	 * @return [type] [description]
	 */
	public function del_gd(){

		$gd_id = $this->request->param('gd_id');

		if(!$gd_id){

			$result['status'] = 0;
			$result['msg'] = "工单id为空";
			return json($result);
		}

		$status = Db::name('pro_worker_job')->where('gd_id',$gd_id)->value('status');
		if($status != 0){

			$result['status'] = 0;
			$result['msg'] = "工单已进行，不允许删除";
			return json($result);
		}

		$re = Db::name('pro_worker_job')->where('gd_id',$gd_id)->delete();

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