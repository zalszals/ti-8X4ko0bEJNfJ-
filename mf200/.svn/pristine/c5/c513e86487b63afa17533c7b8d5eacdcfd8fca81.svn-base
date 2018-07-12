<?php
namespace app\pc\controller;
use app\base\controller\Base;
use think\Db;
class Work extends Base{
	
	
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

		if(strpos($worker['node_str'],',5') !== false){

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

			$result['state'] = 1;

			ajaxReturnJson($result);

		}else{
			$con['b.worker_id'] = $worker_id;
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
					
				$result['status'] = 1;
				
				$result['msg'] = "查询数据为空";
				
				$result['data'] = array();
				
				$result['work_info'] = array();

				$result['state'] = 0;

				return json($result);
			}else{
				
				$result['status'] = 1;
				
				$result['msg'] = "已查询到数据";
				
				$result['data'] = $task;
				
				$result['work_info'] =$work_info;

				$result['state'] = 0;

				return json($result);
			}
		}
    }

	/**
     * [get_plan_order 查询种植任务]
     * @return [type] [description]
     */
    public function get_plan_order(){
		
		$worker = $this->worker;

		$worker_id = $worker['worker_id'];

		$plan_id = $this->request->param('plan_id');

		if(!$plan_id){

			$result['status'] = 0;

			$result['msg'] = "无效的id值";

			ajaxReturnJson($result);
		}

		$con['b.plan_id'] = $plan_id;
		

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
	
		$t_id = $this->request->param('t_id');
		$cat_id = $this->request->param('cat_id');
		$add_worker_id = $this->request->param('add_worker_id');
 
		
		if(!$t_id || !$cat_id || !$add_worker_id){
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
			$return_info['work_name'] = array();
		}
		if($child_info){
			$return_info['child_name'] = $child_info['cat_name'];
		}else{
			$return_info['child_name'] = array();
		}
		if($parent_info){
			$return_info['parent_name'] = $parent_info['cat_name'];
		}else{
			$return_info['parent_name'] = array();
		}
		if($color_info){
			$return_info['color_info'] = $color_info['ft_name'];
		}else{
			$return_info['color_info'] =array();
		}
		if($type_info){
			$return_info['type_info'] = $type_info['ft_name'];
		}else{
			$return_info['type_info'] = array();
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
	/**
	* [1 kanban_list 生产看板列表]
	* @param post传参 
	* @return [type] status 状态值 msg 返回信息 data 返回数据
	*/
	public function kanban_list(){
		//要以登陆者的部门id为条件：分三种条件判断返回信息
		$worker = $this->worker;
		$type = $this->request->param('type');
		$worker_id = $worker['worker_id'];
/*		if($role_id==1){
			$con['w.status'] = 1;
		}else{
			$con['w.status'] = 1;
			$con['w.worker_code'] = array('like','%'.$worker_code.'%');
		}*/
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
		$field[] = 'wj.s_time';
		$field[] = 'wj.e_time';
		$field[] = 'w1.worker_name as add_worker_name';   //工单发布者
		$field[] = 'wj.check_worker_id';	//审核时间
		$field[] = 'wj.check_time';	 //审核时间
		$field[] = 'w1.role_id  as role_id'; 
		$field[] = 'wj.status';
		$field[] = 'wj.unit'; 
		$field[] = 'wj.worker_id';
		$field[] = 'wj.photo';

		/*$con1['wj.status'] = array('lt',3);*/
		if($type == 1){
			$con1['wj.status'] = array('lt',2);
		}elseif($type == 2){
			$con1['wj.status'] = 2;
		}else{
			$con1['wj.status'] = 3;
		}

		$con1['wj.worker_id'] = $worker_id;
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
				->paginate(6);
		$page = $all_info->render();
        $list = $all_info->items();        
        $jsonStr = json_encode($all_info);
        $info = json_decode($jsonStr,true);
        $pages = $info['last_page']; 
        $page_list = array();
        $page_list['page'] = $page;
        $page_list['pages'] = $pages;
        $arr = array();
       	if($info['data']){
       		$str = '';
			$str = str_replace(':null', ':""', json_encode($info['data']));
			$arr = json_decode($str,'true');
			foreach($arr as $ke=>$ve){
				$role_info = Db::name('role')->field('role_name')->where(' role_id = '.$ve['role_id'])->find();
				if($role_info){
					$arr[$ke]['role_name'] = $role_info['role_name'];
				}
				$cat = Db::name('materiel_category c')->join('materiel_category ca','c.pid = ca.cat_id')->field('c.cat_name,ca.cat_name as p_name')->where('c.cat_id',$ve['cat_id'])->find();
				$arr[$ke]['cat_name'] = $cat['p_name'].' '.$cat['cat_name'];
				if($ve['check_worker_id']){
					$array = Db::name('worker w')->join('role r','r.role_id = w.role_id')->where('worker_id',$ve['check_worker_id'])->field('worker_name,role_name')->find();
					$arr[$ke]['check_worker_name'] = $array['worker_name'];
					$arr[$ke]['check_role_name'] = $array['role_name'];
				}else{
					$arr[$ke]['check_worker_name'] = '';
					$arr[$ke]['check_role_name'] = '';
				}
				$arr[$ke]['photo'] = explode(',',$ve['photo']);
			}
		}
		$data['worker_id'] = $worker_id;
		$data['worker_name'] = $this->worker['worker_name'];
		$data['info'] = $arr;
			
		$result['status'] = 1;
		$result['msg'] = "获取成功";
		$result['total'] = $page_list;
		$result['data'] = $data;
		ajaxReturnJson($result);			
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
	 * [1 worker_manage_list 工人管理列表(此接口不需要分页)]
	 * @param post传参 
	 * @return [type] status 状态值 msg 返回信息 data 返回数据
	 */
	public function worker_manage_list(){
		//获取变量
		$mark = $this->request->param('mark');
		$sort = $this->request->param('sort');
		$page = $this->request->param('page');
		$worker = $this->worker;
		$group_id = $worker['group_id'];
		$worker_id = $worker['worker_id'];
		$worker_code = $worker['worker_code'];
		$role_id = $worker['role_id'];
		$line = 3;
		//验证变量
		
		if($page==1||!$page){
			$page=0;
		}else{
			$page = ($page-1)*$line;
		} 
		
		if(!$sort){
			$sort=1;
		}
		
		
		$where_son = '';		
		switch($mark){
			case 2:
				$start_time = date('Y-m-01',time());
				$end_time = date('Y-m-d',strtotime("$start_time +1 month -1 day"));
				//$con['check_time'] = array(['egt',$start_time],['elt',$end_time],'and');
				$where_son .= "and (wj.work_date between '{$start_time}' and '{$end_time}') and wj.status = 3 ";
				break;
			case 3:
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
					$arrayInfo[$k]['score'] = round($arrayInfo[$k]['score'],2);
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
					$arrayInfo[$k]['score'] = round($arrayInfo[$k]['score'],2);
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
					$arrayInfo[$k]['score'] = round($arrayInfo[$k]['score'],2);
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
		$pages = ceil($total/$line);
		$arr3 = array();
		for($i=0;$i<$line;$i++){
			if(isset($arr2[$page+$i])){
				$arr3[$i] = $arr2[$page+$i];
			}
		}
		$re['status'] = 1;
		$re['msg'] = '获取成功';
		$re['total'] = $pages;
		$re['data'] = $arr3;
		
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
		$field[] = 'p.cat_id';
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
				->join('mf_product_plan p','p.plan_id = wj.plan_id')
				->join('work_skill ws','ws.skill_id = wj.skill_id')
				->join('grow_area ga','ga.area_id = wj.area_id')
				->join('worker w','w.worker_id = wj.worker_id')
				->join('worker w1','w1.worker_id = wj.check_worker_id')
				->join('role r','r.role_id = w1.role_id')
				->where($con1)
				->paginate(6);
		$page = $wj_list->render();
        $list = $wj_list->items();        
        $jsonStr = json_encode($wj_list);
        $info = json_decode($jsonStr,true);
        $pages = $info['last_page']; 
        $page_list = array();
        $page_list['page'] = $page;
        $page_list['pages'] = $pages;
				
		if($info['data']){
			foreach($info['data'] as $k=>$v){
				$photo = explode(',',$v['photo']);
				$info['data'][$k]['photo'] = $photo;
				$cat = Db::name('materiel_category c')->join('materiel_category ca','c.pid = ca.cat_id')->field('c.cat_name,ca.cat_name as p_name')->where('c.cat_id',$v['cat_id'])->find();
				$info['data'][$k]['cat_name'] = $cat['p_name'].' '.$cat['cat_name'];
			}
			$data['worker_id'] = $v['worker_id'];
			$data['worker_name'] = $v['wname'];
			$data['info'] = $info['data'];
			$data1[] = $data;
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['total'] = $page_list;
			$result['data'] = $data1;
			ajaxReturnJson($result);
		}else{
			$data1 = array();
			$result['status'] = 1;
			$result['msg'] = "暂无数据";
			$result['total'] = $page_list;
			$result['data'] = array();
			ajaxReturnJson($result);
		}
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
		
}