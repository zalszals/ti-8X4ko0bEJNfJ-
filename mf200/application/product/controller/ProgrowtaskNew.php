<?php
namespace app\product\controller;
use app\base\controller\Base;
use think\Db;

class ProgrowtaskNew extends Base{   
	/**
	 * [1 p_son_detail 生产计划子计划详情（加此计划下所有的种植任务）]
	 * @return [type] [description]
	 */

	public function p_son_detail(){
		//获取变量
		$plan_id = $this->request->param('plan_id');
		$ps_id = $this->request->param('ps_id');
		//验证变量
		if(!$plan_id){
			$result['status'] = 0;
			$result['msg'] = "生产计划id为空";
			ajaxReturnJson($result);
		}
		if(!$ps_id){
			$result['status'] = 0;
			$result['msg'] = "生产计划子计划id为空";
			ajaxReturnJson($result);
		}
		
		//程序主体
		$con['son.plan_id'] = $plan_id;
		$con['son.ps_id'] = $ps_id;
		
		$field[] = 'son.ps_id';
		$field[] = 'mc1.cat_name';
		$field[] = 'mc.cat_name as cat_p_name';
		$field[] = 'mc.ftype cat_type';
		$field[] = 'mc.fcolor cat_color';
		$field[] = 'mc.cat_desc';
		$field[] = 'p.grow_date';
		$field[] = 'p.estimate_get_date_1';											//预计采收期（开始）
		$field[] = 'p.estimate_get_date_2';											//预计采收期（结束）
		$field[] = 'son.p_amount';													//个人负责的产量
		$field[] = 'son.p_grow_area_2 as grow_mianji_mu';							//种植面积
		
		
		$info = Db::name('pro_plan_son_worker son')
				->join('mf_product_plan p','son.plan_id = p.plan_id')
				->join('mf_worker w','w.worker_id = son.worker_id')
				->join('mf_materiel_category mc','mc.cat_id = p.cat_id')//品种名称
				->join('mf_materiel_category mc1','mc1.cat_id = mc.pid')//作物名称	
				->field(implode(',',$field))
				->where($con)
				->find();
		
		if(!$info){
			return json(['status'=>0,'msg'=>"无效的ps_id"]);
		}
		$task_where['ps_id'] = $ps_id;
		$info['t_cost'] = Db::name('pro_grow_task')->where($task_where)->field('task_weight_1,total_cost')->select();//查询出来的是每一个种植任务的，相同的数据值要相加
		//查询子计划的所有种植任务
		$fields[] = 't.t_id';
		$fields[] = 'gm.mode_name';
		//$fields[] = 'ga.area_name';
		$fields[] = 'w.worker_name';
		$fields[] = 't.task_weight_1';
		$fields[] = 't.total_cost';
		
		$info['t_list'] = Db::name('pro_grow_task t')
						/* ->join('mf_pro_grow_task_area ta','ta.t_id = t.t_id')
						->join('mf_grow_area ga','ga.area_id = ta.area_id') */
						->join('mf_worker w','w.worker_id = t.worker_id')
						->join('mf_grow_mode gm','gm.mode_id=t.grow_mode_id')
						->where($task_where)
						->field(implode(',',$fields))
						->select();
		
		if($info){
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $info;
			ajaxReturnJson($result);
		}else{
			$result['status'] = 0;
			$result['msg'] = "获取失败";
			$result['data'] = '';
			ajaxReturnJson($result);
		}
	}

	/**
	* [2 p_son_names 获取所有子计划的名称]
	* @return [type] [description]
	*/
	public function p_son_names(){
		//跟当前登陆者有关的所有未完成的子计划
		$worker = $this->worker;
		$worker_id = $worker['worker_id'];
		$role_id = $worker['role_id'];
		//$con['ps.worker_id'] = $add_worker_id;
		$con['p.type'] = 1;
		
		$field[] = 'p.plan_id';
		$field[] = 'p.plan_name';
		$field[] = 'ps.ps_id';
		$field[] = 'p.add_worker_id';
		$field[] = 'ps.worker_id';
		$field[] = 'ps.ps_name';
		//$field[] = 't.worker_id';
		$plan_info = Db::name('product_plan p')
				->join('mf_pro_plan_son_worker ps','ps.plan_id = p.plan_id')
				->field(implode(',',$field))
				->where($con)
				->order('p.add_time desc')
				->select();
		
		foreach($plan_info as $k => $row){
			$rwnum = $this->get_zynum($row['ps_id'],$row['plan_id'],$plan_info);			
			//dump($rwnum);
			$plan_info[$k]['plan_son_name'] = $row['plan_name'].'-'.$row['ps_name'];
		}
		$data = array();
		if($role_id  == 1){
			$data = $plan_info;
		}else{
			foreach($plan_info as $k=>$v){
				if($v['add_worker_id'] == $worker_id){
					$data[] = $v;
				}else{
					if($v['worker_id'] == $worker_id){
						$data[] = $v;
					}else{
						$re = Db::name('pro_grow_task')->where(['ps_id'=>$v['ps_id'],'worker_id'=>$worker_id])->find();
						if($re){
							$data[] = $v;
						}
					}
				}
			}
		}
		$arr = array();
		if($data){
			foreach($data as $k=>$v){
				$arr[$k]['plan_id'] = $v['plan_id'];
				$arr[$k]['plan_name'] = $v['plan_name'];
				$arr[$k]['ps_id'] = $v['ps_id'];
				$arr[$k]['plan_son_name'] = $v['plan_son_name'];
			}
		}
		if($arr){
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $arr;
			ajaxReturnJson($result);
		}else{
			$result['status'] = 0;
			$result['msg'] = "查询无种植任务";
			ajaxReturnJson($result);
		}
		
	}

	/**
	 *[2 p_son_names 获取所有子计划的名称]
	 * @return [type] [description]
	 */
	function get_zynum($ps_id,$plan_id,$plan_array){
		$offset = 0;
		$tempArray = [];
		foreach($plan_array as $row){
			if($row['plan_id'] == $plan_id){
				$tempArray[] = $row['ps_id'];
			}
		}
		$offset = array_search($ps_id,$tempArray);
		$offset++;
		return $offset;
	}

	/**
	 * [3 progrowtask_add_plan_info 种植任务添加的 所有外显的数据]
	 * @return [type] [description]
	 */
	public function progrowtask_add_all(){
		//获取变量
		$plan_id = $this->request->param('plan_id');
		//验证变量
		if(!$plan_id){
			$result['status'] = 0;
			$result['msg'] = "生产计划的id为空";
			ajaxReturnJson($result);
		}
		//程序主体
		$con['p.plan_id'] = $plan_id;
		
		$field[] = 'mc1.cat_name';
		$field[] = 'mc.cat_name cat_p_name';
		$field[] = 'mc.ftype';
		$field[] = 'mc.fcolor';
		$field[] = 'mc.cat_desc';
		$field[] = 'p.grow_date';
		$field[] = 'p.estimate_get_date_1';
		$field[] = 'p.estimate_get_date_2';
		//种植计划信息(头部)
		$t_title = Db::name('product_plan p')
			->field(implode(',',$field))
			->join('mf_materiel_category mc','p.cat_id = mc.cat_id')
			->join('mf_materiel_category mc1','mc1.cat_id = mc.pid')
			->where($con)
			->find();
		//负责人下拉列表
		$con1['w.group_id'] = array(array('eq',1),array('eq',2), 'or');
		$con1['w.status'] = 1;
		$worker = Db::name('worker w')
				->field(['w.worker_id','w.worker_name','r.role_name'])
				->join('mf_role r','r.role_id = w.role_id')
				->where($con1)
				->select();
		
		//种植模式的下拉列表
		$con2['status'] = 1;
		$con2['status'] = array('neq',0);
		$gm = Db::name('grow_mode')->where($con2)->field('mode_id,mode_name')->select();
		//种植环境的下拉列表
		$hj = Db::name('grow_type')->where($con2)->field('id,type_name')->select();
		
		$data['info'] = $t_title;
		$data['pep_info'] = $worker;
		$data['ms_info'] = $gm;
		$data['hj_info'] = $hj;
		if($data){
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $data;
			ajaxReturnJson($result);
		}else{
			$result['status'] = 0;
			$result['msg'] = "查询无数据";
			ajaxReturnJson($result);
		}
	}
	/**
	 *[4 getprowtask_get_area 获取环境下的所有区域]
	 * @return [type] [description]
	 */
	public function getprowtask_get_area(){
		//获取变量
		$id = $this->request->param('id');
		//验证变量
		if(!$id){
			$result['status'] = 0;
			$result['msg'] = "请先选取您想要的种植模式";
			ajaxReturnJson($result);
		}
		//程序主体
		$con['status'] = 1;
		$con['g_type_id'] = $id;
		$qy_info=Db::name('grow_area')
				->where($con)
				->field('area_id,area_name,area_num')
				->select();
		if($qy_info){
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $qy_info;
			ajaxReturnJson($result);
		}else{
			$result['status'] = 0;
			$result['msg'] = "查询无数据";
			ajaxReturnJson($result);
		}
		
	}
	
	/**
     * [5 get_t_sn 获取种植任务编号接口]
     * @return [type] [description]
     */
	private function get_t_sn(){
		//获取变量
		$shijian = date('Ymd');//当天时间
		$con['grow_date'] = array('eq',$shijian);
		$number = Db::name('pro_grow_task')->where($con)->count();
		$number++;
		//填充0；str_pad()填充字符串；STR_PAD_LEFT:填充到字符串的左侧
		
		$numbered = str_pad($number,3,"0",STR_PAD_LEFT);
		$head = Db::name('confing_prex')->where('prex_id=3')->value('prex_name');
		$t_no = $head.$shijian.$numbered;
		return $t_no;
	}
	
	
	
	/**
     * [6 add_pg_task 添加种植任务接口]
     * @return [type] [description]
     */
	
	public function add_pg_task(){
		//添加环境 区域信息
		$array_info = json_decode($this->request->param('array_info'),true);
		$data = [];
		$data['grow_area_1'] = 0;
		$data['grow_area_2'] = 0;
		foreach($array_info as $k=>$info){
			$data['grow_area_1'] += $info[3];
			$data['grow_area_2'] += $info[4];				
		}
		
		
		//获取变量
		$ps_id= $this->request->param('ps_id');
		$t_no = $this->get_t_sn();
		//以子计划id为条件查询总计划的id；
		$con['ps_id'] = $ps_id;
		$plan_id = $this->request->param('plan_id');
		$grow_mode_id = $this->request->param('grow_mode_id');
		$zhu_ju = $this->request->param('zhu_ju');
		$hang_ju = $this->request->param('hang_ju');
		$total_grow_num = $this->request->param('total_grow_num');
		$one_weight = $this->request->param('one_weight');
		$sm_weight = $this->request->param('sm_weight');
		$year_weight = $this->request->param('year_weight');
		$grow_date = $this->request->param('grow_date');
		$estimate_get_date_1 = $this->request->param('estimate_get_date_1');
		$estimate_get_date_2 = $this->request->param('estimate_get_date_2');
		$total_cost = $this->request->param('total_cost');
		$worker_id = $this->request->param('worker_id');
		$add_time = date('Y-m-d H:i:S');
		$worker = $this->worker;
		$add_worker_id = $worker['worker_id'];
		
		$data['cost_worker'] = $this->request->param('cost_worker');//人工成本（元）
		$data['cost_materiel'] = $this->request->param('cost_materiel');//物料成本（元）
		$data['cost_amount']= $this->request->param('cost_amount');//总成本（元）
		
		if(!$data['cost_worker']){
			$result['status'] = 0;
			$result['msg'] = "请输入预估人工成本";
			ajaxReturnJson($result);
		}
		if(!$data['cost_materiel']){
			$result['status'] = 0;
			$result['msg'] = "请输入预估物料成本";
			ajaxReturnJson($result);
		}
		if(!$data['cost_amount']){
			$result['status'] = 0;
			$result['msg'] = "请输入预估能耗成本";
			ajaxReturnJson($result);
		}
		if(!$plan_id){
			$result['status'] = 0;
			$result['msg'] = "生产计划id为空";
			ajaxReturnJson($result);
		}
		
		if(!$ps_id){
			$result['status'] = 0;
			$result['msg'] = "生产子计划id为空";
			ajaxReturnJson($result);
		}
		if(!$t_no){
			$result['status'] = 0;
			$result['msg'] = "任务编号为空";
			ajaxReturnJson($result);
		}
		if(!$grow_mode_id){
			$result['status'] = 0;
			$result['msg'] = "种植模式id为空";
			ajaxReturnJson($result);
		}
		if(!$zhu_ju){
			$result['status'] = 0;
			$result['msg'] = "请输入株距";
			ajaxReturnJson($result);
		}
		if(!$hang_ju){
			$result['status'] = 0;
			$result['msg'] = "请输入行距";
			ajaxReturnJson($result);
		}
		if(!$total_grow_num){
			$result['status'] = 0;
			$result['msg'] = "请输入总种植株数";
			ajaxReturnJson($result);
		}
		if(!$one_weight){
			$result['status'] = 0;
			$result['msg'] = "请输入目标单果重量（单位g）";
			ajaxReturnJson($result);
		}
		if(!$sm_weight){
			$result['status'] = 0;
			$result['msg'] = "请输入目标每平米产量";
			ajaxReturnJson($result);
		}
		if(!$year_weight){
			$result['status'] = 0;
			$result['msg'] = "请输入目标年产量";
			ajaxReturnJson($result);
		}
		if(!$grow_date){
			$result['status'] = 0;
			$result['msg'] = "请选择定植日期";
			ajaxReturnJson($result);
		}
		if(!$estimate_get_date_1){
			$result['status'] = 0;
			$result['msg'] = "请选择预计采收期（开始）";
			ajaxReturnJson($result);
		}
		if(!$estimate_get_date_2){
			$result['status'] = 0;
			$result['msg'] = "请选择预计采收期（结束）";
			ajaxReturnJson($result);
		}
		if(!$total_cost){
			$result['status'] = 0;
			$result['msg'] = "请输入预估费用成本";
			ajaxReturnJson($result);
		}
		if(!$worker_id){
			$result['status'] = 0;
			$result['msg'] = "任务负责人不能为空";
			ajaxReturnJson($result);
		}
		if(!$add_worker_id){
			$result['status'] = 0;
			$result['msg'] = "任务发布人不能为空";
			ajaxReturnJson($result);
		}
		
		//程序主体
		
		$data['plan_id'] = $plan_id;
		$data['ps_id'] = $ps_id;
		$data['t_name'] = $this->get_task_name();
		$data['t_no'] = $t_no;
		$data['grow_mode_id'] = $grow_mode_id;
		$data['zhu_ju'] = $zhu_ju;
		$data['hang_ju'] = $hang_ju;
		$data['total_grow_num'] = $total_grow_num;
		$data['one_weight'] = $one_weight;
		$data['sm_weight'] = $sm_weight;
		$data['year_weight'] = $year_weight;
		$data['grow_date'] = $grow_date;
		$data['estimate_get_date_1'] = $estimate_get_date_1;
		$data['estimate_get_date_2'] = $estimate_get_date_2;
		$data['total_cost'] = $total_cost;
		$data['worker_id'] = $worker_id;
		$data['add_time'] = $add_time;
		$data['add_worker_id'] = $add_worker_id;
		$t_id = Db::name('pro_grow_task')->insertGetId($data);	//添加种植任务
		
		if($t_id){
			$con1['t_id'] = $t_id;
			$t_sum_info = Db::name('task_sum')->where($con1)->find();
			if(!$t_sum_info){
				$data2['t_id'] = $t_id;
				$data2['plan_id'] = $plan_id;
				$t_sum_id = Db::name('task_sum')->insert();
				if($t_sum_id==false){
					$result['status'] = 0;
					$result['msg'] = "种植任务汇总表添加失败";
					ajaxReturnJson($result);
				}
			}
			
			foreach($array_info as $k=>$info){
				$data1['t_id'] = $t_id;
				$data1['plan_id'] = $plan_id;
				$data1['g_type_id'] = $info[0];
				$data1['area_id'] = $info[1];
				$data1['grow_num'] = $info[2];
				$data1['t_grow_area_1'] = $info[3];
				$data1['t_grow_area_2'] = $info[4];
				$re = Db::name('pro_grow_task_area')->insert($data1);
				if(!$re){
					$result['status'] = 0;
					$result['msg'] = "种植区域和定植数量信息添加失败";
					ajaxReturnJson($result);
				}
			}
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
     * [get_task_name 获取生产计划名称]
     * @return [type] [description]
     */
	private function get_task_name(){
		//获取变量
		
		$name = "种植任务";
		
		$number = Db::name('pro_grow_task')->count();
		$number++;
		//填充0；str_pad()填充字符串；STR_PAD_LEFT:填充到字符串的左侧
		
		
		$get_task_name = $name.$number;
		return $get_task_name;
	}
	
	/**
     * [7 task_detail 添加种植任务接口]//与页面不符 明天继续
     * @return [type] [description]
     */
	
	public function task_detail(){
		//获取变量
		$plan_id = $this->request->param('plan_id');
		$ps_id = $this->request->param('ps_id');
		$t_id = $this->request->param('t_id');
		
		//验证变量
		if(!$plan_id){
			$result['status'] = 0;
			$result['msg'] = "生产计划id为空";
			ajaxReturnJson($result);
		}
		if(!$ps_id){
			$result['status'] = 0;
			$result['msg'] = "生产子计划的id为空";
			ajaxReturnJson($result);
		}
		if(!$t_id){
			$result['status'] = 0;
			$result['msg'] = "种植任务的id为空";
			ajaxReturnJson($result);
		}
		//程序主体
		$con['t.plan_id'] = $plan_id;
		$con['t.ps_id'] = $ps_id;
		$con['t.t_id'] = $t_id;
		//查询当前种植任务详情
		$fields[] = 't.t_id';													//生计划id
		$fields[] = 'w.worker_name';											//子计划负责人
		$fields[] = 'mc.ftype as cat_type';										//果型
		$fields[] = 'mc.fcolor as cat_color';									//果色
		$fields[] = 'gm.mode_name';												//种植模式
		$fields[] = 'ga.area_name';
		$fields[] = 't.estimate_get_date_1';											//预计采收期（开始）
		$fields[] = 't.estimate_get_date_2';											//预计采收期（结束）
		$fields[] = 't.grow_area_2 as grow_mianji_mu';	
		$fields[] = 'p.grow_date';													//总计划定植日期
		$fields[] = 't.year_weight';
		$fields[] = 'mc.cat_name';
		$fields[] = 'mc1.cat_name as cat_p_name';
		$fields[] = 'mc.cat_desc';
		
		
		$info = Db::name('pro_grow_task t')
			->join('mf_pro_plan_son_worker son','son.plan_id = t.plan_id')
			->join('mf_grow_mode gm','gm.mode_id = t.grow_mode_id')
			->join('mf_pro_grow_task_area gta','gta.t_id = t.t_id')
			->join('mf_grow_area ga','ga.area_id = gta.area_id')
			->join('mf_worker w','w.worker_id = t.worker_id')
			->join('mf_product_plan p','t.plan_id = p.plan_id')
			->join('mf_materiel_category mc','mc.cat_id = p.cat_id')//品种名称
			->join('mf_materiel_category mc1','mc1.cat_id = mc.pid')//作物名称
			->where($con)
			->field(join(',',$fields))
			->find();
			
		if(!$info){
			['status'=>0,'msg'=>"无效的t_id"];
		}
		$task_where['ps_id'] = $ps_id;
		$task_list = Db::name('pro_grow_task')->where($task_where)->field('task_weight_1,total_cost')->select();
		//暂时给到预计产量之和和预计费用之和为0；(这里值得获取是每个数组相同的值相加之和)
		/* if($task_list){
			$info['task_list']['task_weight_1'] = 0;
			$info['task_list']['total_cost'] = 0;
		}
		 */

		$info['task_list'] = $task_list;
		$result['status'] = 1;
		$result['msg'] = "获取成功";
		$result['data'] = $info;
		ajaxReturnJson($result);
	}
	
	
	
    
}
