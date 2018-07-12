<?php
namespace app\product\controller;
use app\base\controller\Base;
use think\Db;


class ProductPlanNew extends Base{
	
/**
 * 1 [get_plan_sn 获取生产计划工单编号]
 * @return [type] [description]
 */	
private function get_plan_sn(){
	//获取变量
	$shijian = date('Ymd');//当天时间
	$con['plan_date'] = array('eq',$shijian);
	$number = Db::name('product_plan')->count();
	$number++;
	//填充0；str_pad()填充字符串；STR_PAD_LEFT:填充到字符串的左侧
	
	$numbered = str_pad($number,3,"0",STR_PAD_LEFT);
	$head = Db::name('confing_prex')->where('prex_id=2')->value('prex_name');
	$plan_no = $head.$shijian.$numbered;
	return $plan_no;
}	

/**
 * 2 [get_plan_name 获取生产计划名称]
 * @return [type] [description]
 */
private function get_plan_name(){
	//获取变量
	
	$name = "生产计划";
	
	$number = Db::name('product_plan')->count();
	$number++;
	//填充0；str_pad()填充字符串；STR_PAD_LEFT:填充到字符串的左侧
	
	
	$plan_name = $name.$number;
	return $plan_name;
}
	
/**
* 3 [crop 发布生产计划_作物列表(下拉)]
* @return [type] [description]
*/
public function crop(){
	$where['status'] = 1;
	$where['type'] = 3;//3为作物
	$where['pid'] = 0;
	$data = Db::name('materiel_category')->field(['cat_id','cat_name'])->where($where)->select();
	
	if($data){
		$result['status'] = 1;
		$result['msg'] = "获取成功";
		$result['data'] = $data;
		ajaxReturnJson($result);
	}else{
		$result['status'] = 0;
		$result['msg'] = "获取失败";
		ajaxReturnJson($result);
	}
}	

/**
* 4 [crop_p 发布生产计划_品种列表(下拉)]
* @return [type] [description]
*/	
public function crop_p(){
	//获取变量
	$cat_id = $this->request->param('cat_id');//在页面 上的作物的下拉中的某个作物选项的id，根据此id查询其所有的品种
	//验证变量
	if(!$cat_id){
		$result['status'] = 0;
		$result['msg'] = "作物id为空";
		ajaxReturnJson($result);
	}
	//程序主体
	$where['status'] = 1;
	$where['type'] = 1;//父辈为作物的品种类型：1果蔬
	$where['pid'] = $cat_id;
	$data = Db::name('materiel_category')->field(['cat_id','cat_name'])->where($where)->select();
	if($data){
		$result['status'] = 1;
		$result['msg'] = "获取成功";
		$result['data'] = $data;
		ajaxReturnJson($result);
	}else{
		$result['status'] = 0;
		$result['msg'] = "此作物中还没有品种，快去基础设置中添加吧";
		$result['data'] = '';
		ajaxReturnJson($result);
	}
	
}
/**
* 5 [plan_manager 发布生产计划_负责人列表(下拉)]
* @return [type] [description]
*/	
public function plan_manager(){
	$con['w.group_id'] = array(array('eq',1),array('eq',2), 'or');
	$con['w.status'] = 1;
	$worker = Db::name('worker w')
		    ->field(['w.worker_id','w.worker_name','r.role_name'])
			->join('mf_role r','r.role_id = w.role_id')
			->where($con)
			->select();
	if($worker){
		$result['status'] = 1;
		$result['msg'] = "获取成功";
		$result['data'] = $worker;
		ajaxReturnJson($result);
	}else{
		$result['status'] = 0;
		$result['msg'] = "无数据查询";
		$result['data'] = '';
		ajaxReturnJson($result);
	}
}	
/**
* 6 [pro_ft_fc_desc 获取发布生产计划中果型、果色、作物描述的值]
* @return [type] [description]
*/
public function pro_ft_fc_desc(){
	//获取变量（根据品种的id查找果型果色,作物的描述都在一张表里）
	$cat_id = $this->request->param('cat_id');
	//验证变量
	if(!$cat_id){
		$result['status'] = 0;
		$result['msg'] = "品种的id为空";
		ajaxReturnJson($result);
	}
	//程序主体
	$con['cat_id'] = $cat_id;
	$data = Db::name('materiel_category')->field(['ftype','fcolor','cat_desc'])->where($con)->find();
	
	
	if($data){
		$result['status'] = 1;
		$result['msg'] = "获取成功";
		$result['data'] = $data;
		ajaxReturnJson($result);
	}else{
		$result['status'] = 0;
		$result['msg'] = "查询不到数据";
		ajaxReturnJson($result);
	}
}

	
/**
* 7 [add_product_plan 添加生产计划接口(发布)]
* @return [type] [description]
*/	
public function add_product_plan(){
	//获取变量
	$plan_no = $this->get_plan_sn();//生产计划编号是自动生成的
	$plan_name = $this->get_plan_name();//生产计划名称是自动生成
	$cat_id = $this->request->param('cat_id'); //品种 (生产计划列表中只有品种id，so不用添加作物)
	$grow_date = $this->request->param('grow_date'); //定植时间
	$estimate_get_date_1 = $this->request->param('estimate_get_date_1');//预计采收期（开始）
	$estimate_get_date_2 = $this->request->param('estimate_get_date_2');//预计采收期（结束）
	$grow_area_1 = $this->request->param('grow_area_1');//种植面积（亩）
	$grow_area_2 = $this->request->param('grow_area_2');//种植面积（亩）
	$estimate_amount = $this->request->param('estimate_amount');//预估总产量（kg）
	$estimate_amount_one_date = $this->request->param('estimate_amount_one_date');//预估日产量（kg）
	$cost_worker = $this->request->param('cost_worker');//人工成本（元）
	$cost_materiel = $this->request->param('cost_materiel');//物料成本（元）
	$cost_amount = $this->request->param('cost_amount');//能耗成本（元）
	$plan_date = $this->request->param('plan_date');//计划发布的日期
	$add_time = date('Y-m-d H:i:s');//新增数据的日期
	$worker = $this->worker;
	$add_worker_id = $worker['worker_id'];//计划发布者
	$fzr_worker = json_decode($this->request->param('fzr_worker'),true);//负责人数组
	$status = 0;
	$type = 1;
	
	//验证变量
	if(!$fzr_worker){
		$result['status']  = 0;
		$result['msg'] = "生产计划子计划数据为空";
		ajaxReturnJson($result);
	} 
	if(!$cat_id){
		$result['status'] = 0;
		$result['msg'] = "请选择品种（id）";
		return json($result);
	}
	if(!$grow_date){
		$result['status'] = 0;
		$result['msg'] = "请选择定植日期";
		return json($result);
	}
	if(!$estimate_get_date_1){
		$result['status'] = 0;
		$result['msg'] = "请选择开始的预计采收期";
		return json($result);
	}
	if(!$estimate_get_date_2){
		$result['status'] = 0;
		$result['msg'] = "请选择结束的预计采收期";
		return json($result);
	}
	if(!$grow_area_2){
		$result['status'] = 0;
		$result['msg'] = "请输入种植面积（亩）";
		return json($result);
	}
	
	if(!$estimate_amount){
		$result['status'] = 0;
		$result['msg'] = "请输入预估总产量（kg）";
		return json($result);
	}
	if(!$estimate_amount_one_date){
		$result['status'] = 0;
		$result['msg'] = "请输入预估日产量（kg）";
		return json($result);
	}
	if(!$add_worker_id){
		$result['status'] = 0;
		$result['msg'] = "发布者（id）为空";
		return json($result);
	}
	$data['plan_no'] = $plan_no;
	$data['plan_name'] = $plan_name;
	$data['cat_id'] = $cat_id;
	$data['grow_date'] = $grow_date;
	$data['estimate_get_date_1'] = $estimate_get_date_1;
	$data['estimate_get_date_2'] = $estimate_get_date_2;
	$data['grow_area_2'] = $grow_area_2;
	$data['estimate_amount'] = $estimate_amount;
	$data['estimate_amount_one_date'] = $estimate_amount_one_date;
	$data['cost_worker'] = $cost_worker;
	$data['cost_materiel'] = $cost_materiel;
	$data['cost_amount'] = $cost_amount;
	$data['plan_date'] = $plan_date;
	$data['add_time'] = $add_time;
	$data['add_worker_id'] = $add_worker_id;
	$data['status'] = 0;
	$data['type']  = 1;		
	$plan_id = Db::name('product_plan')->insert($data);//添加生产计划		
	if($plan_id==false){
		$result['status'] = 0;
		$result['msg'] = "生产计划添加失败";
		return json($result);
	}
	
	$re = $this->add_p_worker($plan_id,$fzr_worker);//添加生产计划负责人（添加生产计划子计划）
	if($re){
		$result['status'] = 1;
		$result['msg'] = "添加成功";
		return json($result);
	}else{
		$result['status'] = 0;
		$result['msg'] = "添加失败";
		return json($result);
	}	
}	
	
/**
* [8 add_p_worker 添加生产计划负责人]
* @return [type] [description]
*/	

public function add_p_worker($plan_id,$fzr_worker){
	foreach ($fzr_worker as $k=>$v){
		$ps_name = $this->get_ps_name();
		if(!$v[0]){
			$result['status'] = 0;
			$result['msg'] = "负责人的id为空";
			ajaxReturnJson($result);
		}
		if(!$v[1]){
			$result['status'] = 0;
			$result['masg'] = "个人负责的种植面积（平米）为空";
			ajaxReturnJson($result);
		}	
		
		if(!$v[2]){
			$result['status'] = 0;
			$result['msg'] = "个人负责的种植面积（亩）为空";
			ajaxReturnJson($result);
		}
		if(!$v[3]){
			$result['status'] = 0;
			$result['msg'] = "个人负责的产量为空";
			ajaxReturnJson($result);
		}
	
		$info['plan_id'] = $plan_id;
		$info['ps_name'] = $ps_name;
		$info['worker_id'] = $v[0];
		$info['p_grow_area_1'] = $v[1];
		$info['p_grow_area_2'] = $v[2];
		$info['p_amount'] = $v[3];
		$res = Db::name('pro_plan_son_worker')->insert($info);
	}
	if($res){
		return true;
	}else{
		return false;
	}
}	
/**
* [9 add_pp_process 添加生产计划审批流接口]
* @return [type] [description]
*/
public  function add_pp_process(){
	//获取变量
	$plan_id = $this->request->param('plan_id');
	$check_time = date('Y-m-d H:i:s');
	$reason = $this->request->param('reason');
	$status = $this->request->param('status');
	//验证变量
	if(!$plan_id){
		$result['status'] = 0;
		$result['msg'] = "生产计划为空";
		ajaxReturnJson($result);
	}
	
	if(!$reason){
		$result['status'] = 0;
		$result['msg'] = "请输入审批原因";
		ajaxReturnJson($result);
	}
	if(!$status){
		$result['status'] = 0;
		$result['msg'] = "请选择是否通过";
		ajaxReturnJson($result);
	}
	//根据生产计划中的发布人找到他的上级	
	$con['plan_id'] = $plan_id;
	$con['type'] = 1;
	$fbr = Db::name('product_plan')->where($con)->value('add_worker_id');
	$con1['worker_id'] = $fbr;
	$check_worker_id = Db::name('worker')->where($con1)->value('pid');
	if($check_worker_id==0){
		$check_worker_id = 1;
	}
	//程序主体
	$data['plan_id'] = $plan_id;
	$data['check_time'] = $check_time;
	$data['check_worker_id'] = $check_worker_id;
	$data['reason'] = $reason;
	$data['status'] = $status;
	$process_id = Db::name('pro_plan_process')->insert($data);	
	//更改生产计划表的信息
	$data1['check_worker_id'] = $check_worker_id;
	$data1['check_time'] = $check_time;
	$data1['status'] = $status;
	$re = Db::name('product_plan')->where($con)->update($data1);	
	if($re==false){
		$result['status'] = 0;
		$result['msg'] = "更改失败";
		ajaxReturnJson($result);
	}
	
	if($process_id){
		$result['status'] = 1;
		$result['msg'] = "添加成功";
		ajaxReturnJson($result);
	}else{
		$result['status'] = 0;
		$result['msg'] = "添加失败";
		ajaxReturnJson($result);
	}	
	
	
}
/**
* [10 pp_process_list 生产计划审批流列表接口]
* @return [type] [description]
*/	
	
public function pp_process_list(){
	//分页
	$row = 10;
	$count = Db::name('pro_plan_process')->count();//总条数
	$page = $this->request->param('page');
	//程序主体
	if($page==1||!$page){
	$page = 0;
	}else{
	$page = ($page-1)*$row;
	}

	$data = Db::name('pro_plan_process')->limit($page,$row)->select();
	$result['status']=1;
	$result['msg']="获取成功";
	$result['data']=$data;
	$result['count']=$count;
	ajaxReturnJson($result);
}	
/**
* [11 product_list_detail 获取总生产计划详情接口]
* @return [type] [description]
*/		
		
public function product_list_detail(){
	//获取变量
	$plan_id = $this->request->param('plan_id');
	//验证变量
	if(!$plan_id){
		$result['status'] = 0;
		$result['msg'] = "生产计划id为空";
		ajaxReturnJson($result);
	}
	//程序主体
	
	$con['pp.plan_id'] = $plan_id;
	$field[] = 'pp.plan_id';
	$field[] = 'pp.plan_name';
	$field[] = 'pp.cat_id';
	$field[] = 'mc.pid';
	$field[] = 'mc.cat_name cat_p_name';
	$field[] = 'mc.fcolor';
	$field[] = 'mc.ftype';
	$field[] = 'mc1.cat_name';
	$field[] = 'mc.cat_desc';
	$field[] = 'pp.plan_no';
	$field[] = 'pp.grow_date';
	$field[] = 'pp.estimate_get_date_1';
	$field[] = 'pp.estimate_get_date_2';
	$field[] = 'pp.grow_area_2';
	$field[] = 'pp.estimate_amount';
	$field[] = 'pp.estimate_amount_one_date';
	$field[] = 'pp.cost_worker';
	$field[] = 'pp.cost_materiel';
	$field[] = 'pp.cost_amount';
	
	$data = Db::name('product_plan pp')
			->field(implode(',',$field))
			->join('mf_materiel_category mc','mc.cat_id = pp.cat_id','left')
			->join('mf_materiel_category mc1','mc1.cat_id = mc.pid','left')
			->where($con)->where('pp.status','neq',-1)
			->select();
	foreach($data as $k=>$info){
		foreach($info as $k1=>$v1){
			if(!$v1){
				$info[$k1] = '';
			}
			if(!$info['cost_materiel']){
				$info['cost_materiel'] = 0.00;
			}
			if(!$info['cost_worker']){
				$info['cost_worker'] = 0.00;
			}
			if(!$info['cost_amount']){
				$info['cost_amount'] = 0.00;
			}
			
			$total = $info['cost_worker']+$info['cost_materiel']+$info['cost_amount'];

			$info['total_cost'] = $total;
			
			//获取子类
			$con1['psw.plan_id'] = $plan_id;
			//$field1[] = 'psw.plan_id';
			$field1[] = 'psw.ps_id';
			$field1[] = 'w.worker_id';
			$field1[] = 'w.worker_name';
			$field1[] = 'psw.p_amount';
			//$field1[] = 'psw.p_grow_area_1';
			$field1[] = 'psw.p_grow_area_2';
			
			$son = Db::name('pro_plan_son_worker psw')
				->field(implode(',',$field1))
				->join('mf_worker w','w.worker_id = psw.worker_id')
				->where($con1)
				->select();
			
			if($son){
				$info['son'] = $son;
			}else{
				$info['son'] = [];
			}
			
			
			
		}
		$data[$k] = $info;	
	}
	//dump($data);die();	
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
* [12 product_list 获取生产计划列表接口]
* @return [type] [description]
*/	
public function product_list(){
	//获取条件变量
	$row = 3;
	$page = $this->request->param('page');
	$type = $this->request->param('type');
	$worker = $this->worker;
	$add_worker_id = $worker['worker_id'];
	$worker_fzr = $this->request->param('worker_name');
	$cat_name = $this->request->param('cat_name');//作物
	$s_time = $this->request->param('s_time');//开始时间
	if($s_time){
		$e_time = $this->request->param('e_time');//结束时间
		if(!$e_time){
			$result['status'] = 0;
			$result['msg'] = "请选择结束日期";
			ajaxReturnJson($result);
		}
		$condition['pp.estimate_get_date_1'] = array('egt',$s_time);
		$condition['pp.estimate_get_date_2'] = array('elt',$e_time);
		$field[] = 'pp.estimate_get_date_1';
		$field[] = 'pp.estimate_get_date_2';
	}
	
	
	$condition['w.worker_name'] = $worker_fzr ? array('like',"%{$worker_fzr}%") : NULL;
	
	$condition['mc1.cat_name'] = $cat_name ? array('like',"%{$cat_name}%") : NULL;//品种
	
	
	foreach($condition as $k => $v){
		if(!$v){
			unset($condition[$k]);
		}
	}
	
	if($type){
		if($add_worker_id==1){
			$con['pp.type'] = $type;//1:未完成 2：已完成
			$con['pp.status'] = array('neq',-1);//状态值 0 ：未审核， -1：删除 1 ：审核通过 2 ：未通过
		}else{
			$con['pp.type'] = $type;
			$con['pp.status'] = array('neq',-1);
			$con['pp.add_worker_id'] = $add_worker_id;
		}
	}else{
		if($add_worker_id==1){
			$con['pp.status'] = array('neq',-1);
		}else{
			$con['pp.status'] = array('neq',-1);
			$con['pp.add_worker_id'] = $add_worker_id;
		}
		
	}
	
	if($page==1||!$page){
		$page = 0;
	}else{
		$page = ($page-1)*$row;
	}
	
	//程序主体
	$field[] = 'pp.plan_id';
	$field[] = 'pp.cat_id';
	$field[] = 'mc.cat_name cat_p_name';
	$field[] = 'mc.fcolor';
	$field[] = 'mc.ftype';
	$field[] = 'mc1.cat_name';
	$field[] = 'w.worker_name';
	$field[] = 'pp.plan_no';
	$field[] = 'pp.grow_area_2';
	$field[] = 'pp.add_time';
	$field[] = 'pp.estimate_amount';
	
	$count = Db::name('product_plan pp')
			->field(implode(',',$field))
			->join('mf_materiel_category mc','mc.cat_id = pp.cat_id','LEFT')
			->join('mf_materiel_category mc1','mc1.cat_id = mc.pid','LEFT')
			->join('mf_worker w','pp.add_worker_id = w.worker_id','LEFT')
			->where($con)->where($condition)
			->count();
			
	$data = Db::name('product_plan pp')
			->field(implode(',',$field))
			->join('mf_materiel_category mc','mc.cat_id = pp.cat_id','LEFT')
			->join('mf_materiel_category mc1','mc1.cat_id = mc.pid','LEFT')
			->join('mf_worker w','pp.add_worker_id = w.worker_id','LEFT')
			->where($con)->where($condition)
			->limit($page,$row)
			->select();
			
	$result['status'] = 1;
	$result['msg'] = "获取成功";
	$result['count'] = $count;
	$result['data'] = $data;
	ajaxReturnJson($result);
	
}	
/**
* [13 product_son_detail 获取生产子计划详情接口]
* @return [type] [description]
*/	
public function product_son_detail(){
	//获取变量
	$plan_id=request()->param('plan_id');
	$ps_id=request()->param('ps_id');
	//验证变量
	if(!$plan_id){return json(['status'=>0,'msg'=>"计划id为空"]);}
	if(!$ps_id){return json(['status'=>0,'msg'=>"计划id为空"]);}
	//程序主体
	
	//查询当前子计划详情信息
	$where['son.plan_id'] = $plan_id;
	$where['son.ps_id'] = $ps_id;
	
	$fields[] = 'son.ps_id';													//生计划id
	//$fields[] = 'plan_name';													//生产计划名称
	$fields[] = 'plan_no';														//生产计划编号
	$fields[] = 'w.worker_name';												//子计划负责人
	$fields[] = 'mc.ftype';										//果型
	$fields[] = 'mc.fcolor';										//果色
	$fields[] = 'son.p_amount';													//子计划负责的产量
	$fields[] = 'estimate_amount_one_date as plan_estimate_amount_one_date';	//总计划预计日产量
	$fields[] = 'estimate_get_date_1';											//预计采收期（开始）
	$fields[] = 'estimate_get_date_2';											//预计采收期（结束）
	$fields[] = 'son.p_grow_area_2 as grow_mianji_mu';	
	$fields[] = 'p.grow_date';													//总计划定植日期
	
	$fields[] = 'mc1.cat_name';
	$fields[] = 'mc.cat_name as cat_p_name';
	$fields[] = 'mc.cat_desc';
	
	$info = Db::name('pro_plan_son_worker')->alias('son')
		->join('mf_product_plan p','p.plan_id = son.plan_id')
		->join('mf_worker w','w.worker_id = son.worker_id')
		->join('mf_materiel_category mc','mc.cat_id = p.cat_id')//品种名称
		->join('mf_materiel_category mc1','mc1.cat_id = mc.pid')//作物名称					
		->where($where)
		->field(join(',',$fields))
		->find();
		
	if(!$info){
		return json(['status'=>0,'msg'=>"无效的ps_id"]);
	}	
	$task_where['ps_id'] = $ps_id;
	//种植任务下的预计产量之和 和预计费用之和(查出来的是二维数组，相同的字段值要相加)
	$info['task_cost'] = Db::name('pro_grow_task')->where($task_where)->field('task_weight_1,total_cost')->select();
	//查询子计划下边的所有种植任务
	
	$field[] = 't.t_id';
	$field[] = 'gm.mode_name';
	//$field[] = 'ga.area_name';
	$field[] = 'gm.mode_name';
	$field[] = 'w.worker_name';
	$field[] = 't.task_weight_1';
	$field[] = 't.total_cost';
	
	$info['task_list'] = Db::name('pro_grow_task t')
					->join('mf_grow_mode gm','gm.mode_id = t.grow_mode_id')
					/* ->join('mf_pro_grow_task_area gta','gta.t_id = t.t_id')  //这里暂将种植区域拿掉（一个种植任务可以有多个种植区域，而在子计划下边只显示
																				一个种植任务，逻辑不符，所以将其拿掉）
					->join('mf_grow_area ga','ga.area_id = gta.area_id') */
					->join('mf_worker w','w.worker_id = t.worker_id')
					->field(implode(',',$field))
					->where($task_where)
					->select();
	return json([
		'status' => 1,
		'msg'    => "获取成功",
		'data'   => $info
	]);
	exit;
}

/**
* [14 pp_process_detail 生产计划审批流详情接口]
* @return [type] [description]
*/

public function pp_process_detail(){
	//获取变量
	$plan_id = $this->request->param('plan_id');
	//验证变量
	if(!$plan_id){
		$result['status'] = 0;
		$result['msg'] = "生产计划id为空";
		ajaxReturnJson($result);
	}
	//程序主体
	$con['plan_id'] = $plan_id;
	$data = Db::name('pro_plan_process')->where($con)->select();
	if($data){
		$result['status'] = 1;
		$result['msg'] = "获取成功";
		$result['data'] = $data;
		ajaxReturnJson($result);
	}else{
		$result['status'] = 0;
		$result['msg'] = "查询的数据无效";
		$result['data'] = '';
		ajaxReturnJson($result);
	}
}
/**
* [15 edit_product_plan 生产计划编辑]
* @return [type] [description]
*/
public function edit_product_plan(){
	//获取变量
	$plan_id = $this->request->param('plan_id');
	$cat_id = $this->request->param('cat_id');
	$grow_date = $this->request->param('grow_date');
	$estimate_get_date_1 = $this->request->param('estimate_get_date_1');
	$estimate_get_date_2 = $this->request->param('estimate_get_date_2');
	$grow_area_1 = $this->request->param('grow_area_1');
	$grow_area_2 = $this->request->param('grow_area_2');
	$estimate_amount = $this->request->param('estimate_amount');
	$estimate_amount_one_date = $this->request->param('estimate_amount_one_date');
	$cost_worker = $this->request->param('cost_worker');
	$cost_materiel = $this->request->param('cost_materiel');//物料成本（元）
	$cost_amount = $this->request->param('cost_amount');//总成本（元）
	$plan_date = $this->request->param('plan_date');
	
	
	//验证变量
	if(!$plan_id){
		$result['status'] = 0;
		$result['msg'] = "生产计划id为空";
		ajaxReturnJson($result);
	}
	if(!$cat_id){
		$result['status'] = 0;
		$result['msg'] = "品种id为空";
		ajaxReturnJson($result);
	}
	if(!$grow_date){
		$result['status'] = 0;
		$result['msg'] = "定植日期为空";
		ajaxReturnJson($result);
	}
	if(!$estimate_get_date_1){
		$result['status'] = 0;
		$result['msg'] = "预计采收期（开始）为空";
		ajaxReturnJson($result);
	}
	if(!$estimate_get_date_2){
		$result['status'] = 0;
		$result['msg'] = "预计采收期（结束）为空";
		ajaxReturnJson($result);
	}
	if(!$grow_area_1){
		$result['status'] = 0;
		$result['msg'] = "种植面积（平米）为空";
		ajaxReturnJson($result);
	}
	if(!$grow_area_2){
		$result['status'] = 0;
		$result['msg'] = "种植面积（亩）为空";
		ajaxReturnJson($result);
	}
	if(!$estimate_amount){
		$result['status'] = 0;
		$result['msg'] = "预估总产量（kg）为空";
		ajaxReturnJson($result);
	}
	if(!$estimate_amount_one_date){
		$result['status'] = 0;
		$result['msg'] = "预估日产量（kg）为空";
		ajaxReturnJson($result);
	}
	if(!$cost_worker){
		$result['status'] = 0;
		$result['msg'] = "人工成本为空";
		ajaxReturnJson($result);
	}
	if(!$cost_materiel){
		$result['status'] = 0;
		$result['msg'] = "物料成本为空";
		ajaxReturnJson($result);
	}
	if(!$cost_amount){
		$result['status'] = 0;
		$result['msg'] = "能耗成本为空";
		ajaxReturnJson($result);
	}
	
	//程序主体
	$con['plan_id'] = $plan_id;
	$con['type'] = 1;
	//获取要编辑的数据信息
	$find = Db::name('product_plan')->where($con)->find();
	if($find){
		$data['plan_name'] = $find['plan_name'];
		$data['plan_no'] = $find['plan_no'];
		$data['cat_id'] = $cat_id;
		$data['grow_date'] = $grow_date;
		$data['estimate_get_date_1'] = $estimate_get_date_1;
		$data['estimate_get_date_2'] = $estimate_get_date_2;
		$data['grow_area_1'] = $grow_area_1;
		$data['grow_area_2'] = $grow_area_2;
		$data['estimate_amount'] = $estimate_amount;
		$data['estimate_amount_one_date'] = $estimate_amount_one_date;
		$data['cost_worker'] = $cost_worker;
		$data['cost_materiel'] = $cost_materiel;
		$data['cost_amount'] = $cost_amount;
		$data['plan_date'] = $plan_date;
		$data['add_time'] = $find['add_time'];
		$data['add_worker_id'] = $find['add_worker_id'];
		$data['status'] = 0;
		$data['type'] = 1;
		
		$uppro = Db::name('product_plan')->where($con)->update($data);//修改生产计划
		if($uppro!==false){
			$upro_son = $this->edit_p_worker($plan_id);//修改生产计划负责人（修改生产计划子计划）
			if($upro_son){
				$result['status'] = 1;
				$result['msg'] = "修改成功";
				return json($result);
			}
		}else{
			$result['status'] = 0;
			$result['msg'] = "修改失败";
			return json($result);
		}
	}
}

/**
* [16 edit_p_worker 编辑生产计划子计划]
* @return [type] [description]
*/
public function edit_p_worker($plan_id){
	//获取变量
	$worker_id = $this->request->param('worker_id');
	$p_amount = $this->request->param('p_amount');//个人负责的产量
	$p_grow_area_1 = $this->request->param('p_grow_area_1');//个人负责的种植面积（平米）
	$p_grow_area_2 = $this->request->param('p_grow_area_2');//个人负责的种植面积（亩）
	//验证变量
	if(!$worker_id){
		$result['status'] = 0;
		$result['msg'] = "用户id为空";
		ajaxReturnJson($result);
	}
	if(!$p_amount){
		$result['status'] = 0;
		$result['msg'] = "请输入个人负责的产量";
		ajaxReturnJson($result);
	}
	if(!$p_grow_area_1){
		$result['status'] = 0;
		$result['msg'] = "请输入个人负责的种植面积（平米）";
		ajaxReturnJson($result);
	}
	if(!$p_grow_area_2){
		$result['status'] = 0;
		$result['msg'] = "请输入个人负责的种植面积（亩）";
		ajaxReturnJson($result);
	}
	//判断传值是否是个数组
	if(!is_array($worker_id)){
		$worker_id = explode(',',$worker_id);
	}
	if(!is_array($p_amount)){
		$p_amount = explode(',',$p_amount);
	}
	if(!is_array($p_grow_area_1)){
		$p_grow_area_1 = explode(',',$p_grow_area_1);
	}
	if(!is_array($p_grow_area_2)){
		$p_grow_area_2 = explode(',',$p_grow_area_2);
	}
	//条件查询
	$con1['plan_id'] = $plan_id;
	$info = Db::name('pro_plan_son_worker')->where($con1)->select();
	//判断是否有info
	if($info){
		foreach($info as $k=>$row){
			//修改数据后的条数少于修改数据前的条数：删除
			if(empty($worker_id[$k])){
				$res = Db::name('pro_plan_son_worker')->where(array('ps_id'=>$row['ps_id']))->delete();
			}else if(count($worker_id)==count($info)){//修改数据后的条数等于修改数据前的条数：更新
				$newinfo = array();
				$newinfo['worker_id'] = $worker_id[$k];
				$newinfo['p_amount'] = $p_amount[$k];
				$newinfo['p_grow_area_1'] = $p_grow_area_1[$k];
				$newinfo['p_grow_area_2'] = $p_grow_area_2[$k];
				$res = Db::name('pro_plan_son_worker')->where(array('ps_id'=>$row['ps_id']))->update($newinfo);
			}
			
		}
		if(count($worker_id)>count($info)){//修改数据后的条数大于修改数据前的条数：添加
				
			$k++;
			$newinfo2 = array();
			$newinfo2['plan_id'] = $plan_id;
			$newinfo2['worker_id'] = $worker_id[$k];
			$newinfo2['p_amount'] = $p_amount[$k];
			$newinfo2['p_grow_area_1'] = $p_grow_area_1[$k];
			$newinfo2['p_grow_area_2'] = $p_grow_area_2[$k];
			$res = Db::name('pro_plan_son_worker')->insert($newinfo2);
		}
	}else{
		//查询不到数据的情况下：添加
		foreach($worker_id as $k=>$wd){
			$data['worker_id'] = $wd;
			$data['plan_id'] = $plan_id;
			$data['p_amount'] = $p_amount[$k];
			$data['p_grow_area_1'] = $p_grow_area_1;
			$data['p_grow_area_2'] = $p_grow_area_2;
			$res = Db::name('pro_plan_son_worker')->insert($data);
		}
		
	}
	if($res!==false){
		return true;
	}else{
		return false;
	}
}

/**
* [17 del_product_plan 删除生产计划接口]
* @return [type] [description]
*/
public function del_product_plan(){
	//获取可变量
	$plan_id = $this->request->param('plan_id');
	//验证变量
	if(!$plan_id){
		$result['status'] = 0;
		$result['msg'] = "生产计划id为空";
		ajaxReturnJson($result);
	}
	//程序主体
	$con['plan_id'] = $plan_id;
	$con1['status'] = -1; 
	$con['type'] = 1;
	$re = Db::name('product_plan')->where($con)->update($con1);
	if($re!==false){
		$result['status'] = 1;
		$result['msg'] = "删除成功";
		ajaxReturnJson($result);
	}else{
		$result['status'] = 0;
		$result['msg'] = "删除失败";
		ajaxReturnJson($result);
	}
}

/**
* [18 ndo_edit_product_plan 生产计划编辑显示页面（此接口未用到，跟获取详情接口意思等同 ，再议）]
* @return [type] [description]
*/

public function ndo_edit_product_plan(){
	//获取变量
	$plan_id = $this->request->param('plan_id');
	//验证变量
	if(!$plan_id){
		$result['status'] = 0;
		$result['msg'] = "生产计划id为空";
		ajaxReturnJson($result);
	}
	//程序主体
	$con['plan_id'] = $plan_id;
	$con['type'] = 1;
	$find = Db::name('product_plan')
		->where($con)
		->find();
	
	if($find){
		foreach($find as $k=>$v){
			if(!$v){
				$find[$k] = '';
			}
			if($find['status']==0){
				$find['status'] = 0;
			}
		}
		
		$info = $this->ndo_edit_p_worker($plan_id,1);
		if($info){
			$find['son'] = $info;
		}else{
			$find['son'] = '';
		}
		
		
		$result['status'] = 1;
		$result['msg'] = "获取成功";
		$result['data'] = $find;
		ajaxReturnJson($result);
	}else{
		$result['status'] = 0;
		$result['msg'] = "获取失败";
		$result['data'] = '';
		ajaxReturnJson($result); 
	}
}
/**
* [19 ndo_edit_p_worker 生产计划子计划编辑显示页面(此接口没有用到，再议)]
* @return [type] [description]
*/
public function ndo_edit_p_worker($plan_id,$a=0){
	//获取变量
	$ps_id = $this->request->param('ps_id');
	$con['plan_id'] = $plan_id;
	if($ps_id){
		$con['ps_id'] = $ps_id;
	}
	//程序主体
	$fun = $ps_id ? 'find' : 'select';	
	$field[] = 'ps.ps_id';
	$field[] = 'ps.worker_id';
	$field[] = 'w.worker_name';
	$field[] = 'ps.plan_id';
	$field[] = 'ps.p_amount';
	$field[] = 'ps.p_grow_area_1';
	$field[] = 'ps.p_grow_area_2';
	
	$info = Db::name('pro_plan_son_worker ps')
			->field(join(',',$field))
			->join('worker w ','w.worker_id = ps.worker_id')
			->where($con)
			->$fun();
	if($a){
		return $info;
	}	
	
	if($info){
		$result['status'] = 1;
		$result['msg'] = '获取成功';
		$result['data'] = $info;
	}else{
		$result['status'] = 0;
		$result['msg'] = '获取失败';
		$result['data'] = '';
	}
	ajaxReturnJson($result);
}
/**
 * 20 [get_ps_name 获取生产计划名称（pc）]
 * @return [type] [description]
 */
private function get_ps_name(){
	//获取变量
	
	$name = "分配任务";
	
	$number = Db::name('pro_plan_son_worker')->count();
	$number++;
	//填充0；str_pad()填充字符串；STR_PAD_LEFT:填充到字符串的左侧
	
	
	$ps_name = $name.$number;
	return $ps_name;
}

/**
* [21 p_son_all 所有任务列表 （pc）]
* @return [type] [description]
*/
public function p_son_all (){
	//获取变量
	$row = 18;
	$page = $this->request->param('page');
	$type = $this->request->param('type');//完成状态  1:未完成 2：已完成
	//判断变量
	if($page==1||!$page){
		$page = 0;
	}else{
		$page = ($page-1)*$row;
	}
	
	$field[] = 'psw.ps_id';
	$field[] = 'p.plan_id';
	$field[] = 'psw.ps_name';
	$field[] = 'w.worker_name as fzr_name';
	$field[] = 'w1.worker_name as fbr_name';
	$field[] = 'p.grow_date';
	$field[] = 'p.estimate_get_date_1';
	$field[] = 'p.estimate_get_date_2';
	$field[] = 'psw.p_grow_area_2';
	$field[] = 'psw.p_amount';//总产量预估
	
	if($type){
		switch($type){
			case 1:
				$con['p.type'] = $type;
				break;
			case 2:
				$con['p.type'] = $type;
				break;
		}
		$count = Db::name('pro_plan_son_worker psw')
			  ->field(implode(',',$field))
			  ->join('worker w','w.worker_id = psw.worker_id')
			  ->join('product_plan p','p.plan_id = psw.plan_id')
			  ->join('worker w1','w1.worker_id = p.add_worker_id')
			  ->where($con)
			  ->count();
		
		$data = Db::name('pro_plan_son_worker psw')
			  ->field(implode(',',$field))
			  ->join('worker w','w.worker_id = psw.worker_id')
			  ->join('product_plan p','p.plan_id = psw.plan_id')
			  ->join('worker w1','w1.worker_id = p.add_worker_id')
			  ->where($con)
			  ->limit($page,$row)->select();
	}else{
		$count = Db::name('pro_plan_son_worker psw')
			  ->field(implode(',',$field))
			  ->join('worker w','w.worker_id = psw.worker_id')
			  ->join('product_plan p','p.plan_id = psw.plan_id')
			  ->join('worker w1','w1.worker_id = p.add_worker_id')
			  ->count();
		$data = Db::name('pro_plan_son_worker psw')
			  ->field(implode(',',$field))
			  ->join('worker w','w.worker_id = psw.worker_id')
			  ->join('product_plan p','p.plan_id = psw.plan_id')
			  ->join('worker w1','w1.worker_id = p.add_worker_id')
			  ->limit($page,$row)->select();
	}
	$result['status'] = 1;
	$result['msg'] = "获取成功";
	$result['count'] = $count;
	$result['data'] = $data;
	ajaxReturnJson($result);
	
	
}



/**
* [22 product_list_pcdetail 获取总生产计划详情接口 （pc）]
* @return [type] [description]
*/		
		
public function product_list_pcdetail(){
	//获取变量
	$plan_id = $this->request->param('plan_id');
	//验证变量
	if(!$plan_id){
		$result['status'] = 0;
		$result['msg'] = "生产计划id为空";
		ajaxReturnJson($result);
	}
	//程序主体
	
	$con['pp.plan_id'] = $plan_id;
	$field[] = 'pp.plan_id';
	$field[] = 'pp.plan_name';
	$field[] = 'pp.cat_id';
	$field[] = 'mc.pid';
	$field[] = 'mc.cat_name cat_p_name';
	$field[] = 'mc.fcolor';
	$field[] = 'mc.ftype';
	$field[] = 'mc1.cat_name';
	$field[] = 'mc.cat_desc';
	$field[] = 'pp.plan_no';
	$field[] = 'pp.grow_date';
	$field[] = 'pp.estimate_get_date_1';
	$field[] = 'pp.estimate_get_date_2';
	$field[] = 'pp.grow_area_2';
	$field[] = 'pp.estimate_amount';
	$field[] = 'pp.estimate_amount_one_date';
	$field[] = 'pp.cost_worker';
	$field[] = 'pp.cost_materiel';
	$field[] = 'pp.cost_amount';
	
	$data = Db::name('product_plan pp')
			->field(implode(',',$field))
			->join('mf_materiel_category mc','mc.cat_id = pp.cat_id','left')
			->join('mf_materiel_category mc1','mc1.cat_id = mc.pid','left')
			->where($con)->where('pp.status','neq',-1)
			->select();
	foreach($data as $k=>$info){
		foreach($info as $k1=>$v1){
			if(!$v1){
				$info[$k1] = '';
			}
			if(!$info['cost_materiel']){
				$info['cost_materiel'] = 0.00;
			}
			if(!$info['cost_worker']){
				$info['cost_worker'] = 0.00;
			}
			if(!$info['cost_amount']){
				$info['cost_amount'] = 0.00;
			}
			
			$total = $info['cost_worker']+$info['cost_materiel']+$info['cost_amount'];

			$info['total_cost'] = $total;
			
			//获取子类
			$con1['psw.plan_id'] = $plan_id;
			//$field1[] = 'psw.plan_id';
			$field1[] = 'psw.ps_id';
			$field1[] = 'w.worker_id';
			$field1[] = 'w.worker_name';
			$field1[] = 'psw.p_amount';
			$field1[] = 'pp.grow_date';
			$field1[] = 'psw.p_grow_area_2';
			$field1[] = 'pp.estimate_get_date_1';
			$field1[] = 'pp.estimate_get_date_2';
			
			
			$son = Db::name('pro_plan_son_worker psw')
				->field(implode(',',$field1))
				->join('product_plan pp','pp.plan_id = psw.plan_id')
				->join('mf_worker w','w.worker_id = psw.worker_id')
				->where($con1)
				->select();
			
			if($son){
				$info['son'] = $son;
			}else{
				$info['son'] = [];
			}
			
			
			
		}
		$data[$k] = $info;	
	}
	//dump($data);die();	
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
* [23 product_son_pcdetail 获取生产子计划详情接口(pc)]
* @return [type] [description]
*/	
public function product_son_pcdetail(){//此接口逻辑问题还在处理中，稍后调整代码
	//获取变量
	$plan_id=request()->param('plan_id');
	$ps_id=request()->param('ps_id');
	//验证变量
	if(!$plan_id){return json(['status'=>0,'msg'=>"计划id为空"]);}
	if(!$ps_id){return json(['status'=>0,'msg'=>"计划id为空"]);}
	//程序主体
	
	//查询当前子计划详情信息
	$where['son.plan_id'] = $plan_id;
	$where['son.ps_id'] = $ps_id;
	
	$fields[] = 'son.ps_id';													//生计划id
	//$fields[] = 'plan_name';													//生产计划名称
	$fields[] = 'plan_no';														//生产计划编号
	$fields[] = 'w.worker_name';												//子计划负责人
	$fields[] = 'mc.ftype';										//果型
	$fields[] = 'mc.fcolor';										//果色
	$fields[] = 'son.p_amount';													//子计划负责的产量
	$fields[] = 'estimate_amount_one_date as plan_estimate_amount_one_date';	//总计划预计日产量
	$fields[] = 'estimate_get_date_1';											//预计采收期（开始）
	$fields[] = 'estimate_get_date_2';											//预计采收期（结束）
	$fields[] = 'son.p_grow_area_2 as grow_mianji_mu';	
	$fields[] = 'p.grow_date';													//总计划定植日期
	
	$fields[] = 'mc1.cat_name';
	$fields[] = 'mc.cat_name as cat_p_name';
	$fields[] = 'mc.cat_desc';
	
	$info = Db::name('pro_plan_son_worker')->alias('son')
		->join('mf_product_plan p','p.plan_id = son.plan_id')
		->join('mf_worker w','w.worker_id = son.worker_id')
		->join('mf_materiel_category mc','mc.cat_id = p.cat_id')//品种名称
		->join('mf_materiel_category mc1','mc1.cat_id = mc.pid')//作物名称					
		->where($where)
		->field(join(',',$fields))
		->find();
		
	if(!$info){
		return json(['status'=>0,'msg'=>"无效的ps_id"]);
	}	
	$task_where['ps_id'] = $ps_id;
	//获取此生产子计划的预估成本(未完)
	//$yg_total = 
	
	
	
	
	
	//种植任务下的预计产量之和 和预计费用之和(查出来的是二维数组，相同的字段值要相加)
	$info['task_cost'] = Db::name('pro_grow_task')->where($task_where)->field('task_weight_1,total_cost')->select();
	//查询子计划下边的所有种植任务
	
	$field[] = 't.t_id';
	$field[] = 'gm.mode_name';
	$field[] = 'ga.area_name';
	$field[] = 'gm.mode_name';
	$field[] = 'w.worker_name';
	$field[] = 't.task_weight_1';
	$field[] = 't.total_cost';
	
	$info['task_list'] = Db::name('pro_grow_task t')
					->join('mf_grow_mode gm','gm.mode_id = t.grow_mode_id')
					->join('mf_pro_grow_task_area gta','gta.t_id = t.t_id')
					->join('mf_grow_area ga','ga.area_id = gta.area_id')
					->join('mf_worker w','w.worker_id = t.worker_id')
					->field(implode(',',$field))
					->where($task_where)
					->select();
	return json([
		'status' => 1,
		'msg'    => "获取成功",
		'data'   => $info
	]);
	exit;
}



	
}

