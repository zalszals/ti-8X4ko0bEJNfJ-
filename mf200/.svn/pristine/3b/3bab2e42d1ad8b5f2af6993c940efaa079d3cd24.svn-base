<?php
namespace app\product\controller;
use app\base\controller\Base;
use think\Db;


class ProductPlan extends Base{
	
	/**
     * [get_plan_sn 获取生产计划编号]
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
		$head = Db::name('confing_prex')->where('prex_id=1')->value('prex_name');
		$plan_no = $head.$shijian.$numbered;
		return $plan_no;
	}
	
	/**
     * [get_plan_name 获取生产计划名称]
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
     * [pro_del 删除生产计划]
     * @return [type] [description]
     */
	public function pro_del(){
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
		$info = Db::name('product_plan')->where($con)->find();
		if($info){
			$info_son = Db::name('pro_plan_son_worker')->where($con)->select();
			if($info_son){
				$result['status'] = 0;
				$result['msg'] = '此生产计划下边有生产任务，不能删除';
				ajaxReturnJson($result);
			}else{
				$con2['status'] = -1;
				Db::name('product_plan')->where($con)->update($con2);
				
				$result['status'] = 1;
				$result['msg'] = '删除成功';
				ajaxReturnJson($result);
				
			}
		}else{
			$result['status'] = -1;
			$result['msg'] = '对不起，没有找到您要的生产计划';
			ajaxReturnJson($result);
		}
	}
	
	/**
     * [proson_del 删除生产计划子计划]
     * @return [type] [description]
     */
	public function proson_del(){ //未完 待续
		//获取变量
		$ps_id = $this->request->param('ps_id');
		if(!$ps_id){
			$result['status'] = 0;
			$result['msg'] = '生产任务id为空';
			ajaxReturnJson($result);
		}
		//程序主体
		$con['ps_id'] = $ps_id;
		$info = Db::name('pro_plan_son_worker')->where($con)->find();
		if($info){
			$info_son = Db::name('pro_grow_task')->where($con)->select();
			if($info_son){
				$result['status'] = 0;
				$result['msg'] = '此生产任务下边有种植任务，不能删除';
				ajaxReturnJson($result);
			}else{
				$con2['status'] = -1;
				Db::name('pro_plan_son_worker')->where($con)->update($con2);
				
				$result['status'] = 1;
				$result['msg'] = '删除成功';
				ajaxReturnJson($result);
			}
		}else{
			$result['status'] = -1;
			$result['msg'] = '对不起，没有找到您要的生产任务';
			ajaxReturnJson($result);
		}
	}
	
	/**
     * [task_del 删除种植任务]
     * @return [type] [description]
     */
	
	public function task_del(){
		$t_id = $this->request->param('t_id');
		if(!$t_id){
			$result['status'] = 0;
			$result['msg'] = '种植任务id为空';
			ajaxReturnJson($result);
		}
		$con['t_id'] = $t_id;
		$info = Db::name('pro_grow_task')->where($con)->find();
		if($info){
			$info_son = Db::name('pro_worker_job')->where($con)->select();
			if($info_son){
				$result['status'] = 0;
				$result['msg'] = '此种植任务下边有工单，不能删除';
				ajaxReturnJson($result);
			}else{
				$con2['status'] = -1;
				Db::name('pro_grow_task')->where($con)->update($con2);
				
				$result['status'] = 1;
				$result['msg'] = '删除成功';
				ajaxReturnJson($result);
			}
		}else{
			$result['status'] = -1;
			$result['msg'] = '对不起，没有找到您要的种植任务';
			ajaxReturnJson($result);
		}
	}
	
	/**
     * [workerjob_del 删除工单]
     * @return [type] [description]
     */
	public function workerjob_del(){
		$gd_id = $this->request->param('gd_id');
		if(!$gd_id){
			$result['status'] = 0;
			$result['msg'] = "工单id为空";
			ajaxReturnJson($result);
		}
		$con['gd_id'] = $gd_id;
		$info = Db::name('pro_worker_job')->where($con)->find();
		if($info){
			$s_time = $info['s_time'];
			if(!$s_time){
				Db::name('pro_worker_job')->where($con)->delete();
				$result['status'] = 1;
				$result['msg'] = '删除成功';
				ajaxReturnJson($result);
			}else{
				$result['status'] = 0;
				$result['msg'] = '此工单已经开始执行，不能删除';
				ajaxReturnJson($result);
			}
		}else{
			$result['status'] = -1;
			$result['msg'] = '对不起，没有找到您想要的工单';
			ajaxReturnJson($result);
		}
		
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
		foreach($data as $k=>$v){
			if(!$v['cat_name']){
				$data[$k]['cat_name'] = '';
			}
		}
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
	* [crop 作物列表]
    * @return [type] [description]
	*/
	public function crop_old(){
		$arr = array();
		$where['status'] = 1;
		$where['type'] = 3;
		$where['pid'] = 0;
		$data = Db::name('materiel_category')->field(['cat_id','cat_name'])->where($where)->select();
		foreach($data as $k=>$v){
			$condition['type'] = 1;
			$condition['status'] = 1;
			$condition['pid'] = $v['cat_id'];
			$info = Db::name('materiel_category')->where($condition)->find();
			if($info){
				$arr[] = $v;
			}
			$info = array();
		}

		if(!$arr){
			$arr = array();
		}
		return(json(array('status'=>1,'msg'=>'查询成功','data'=>$arr)));
	}
	/**
	* 4 [crop_child 发布生产计划_品种列表(下拉)]
	* @return [type] [description]
	*/	
	public function crop_child(){
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
		$data = Db::name('materiel_category')->field(['cat_id','cat_name','cat_desc','ftype as cat_type','fcolor as cat_color','cat_no'])->where($where)->select();
		
		/* foreach($data as $k => $v){
			//获取当前catid 所有果型颜色
			$info_cat_type_where['cat_id'] = $v['cat_id'];
			$info_cat_type = Db::name('fruits_type')->field(['ft_id','ft_name'])->where($info_cat_type_where)->find();
			$info_cat_color = Db::name('fruits_color')->field(['ft_id','ft_name'])->where($info_cat_type_where)->find();
			
			$data[$k]['cat_type'] = $info_cat_type['ft_name'];
			$data[$k]['cat_color'] = $info_cat_color['ft_name'];
			
		} */
		if($data){
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $data;
			ajaxReturnJson($result);
		}else{
			$result['status'] = 0;
			$result['msg'] = "此作物中还没有品种，快去基础设置中添加吧";
			$result['data'] = array();
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
	* [crop_child 作物品种列表]
    * @return [type] [description]
	*/

	public function crop_child1(){
		$cat_id = $this->request->param('cat_id');
		if(!$cat_id){
			$result['status'] = 0;
			$result['msg'] = "作物id为空";
			ajaxReturnJson($result);
		}
		
		
		if($cat_id){
			$condition['type'] = 1;
			$condition['status'] = 1;
			$condition['pid'] = $_REQUEST['cat_id'];
			$data = Db::name('materiel_category')->field(['cat_id','cat_name','cat_desc','cat_no','ftype as cat_type','fcolor as cat_color'])->where($condition)->select();
			
			
			if(!$data){
				$data = array();
				return(json(array('status'=>0,'msg'=>'查询无数据','data'=>$data)));
			}
			return(json(array('status'=>1,'msg'=>'查询成功','data'=>$data)));
		}else{
			return(json(array('status'=>0,'msg'=>'参数错误')));
		}
		
		
	}

	/**
     * [plan_manager 生产计划负责人列表]
     * @return [type] [description]
     */
	public function plan_manager(){
		$worker = $this->worker;
		$worker_id = $worker['worker_id'];
		$worker_code = $worker['worker_code'];
		//$con['status'] = 1;
		//$con['_string'] = array('like','%'.$worker_code.'%');
		$con = "w.status = 1 and FIND_IN_SET($worker_id ,worker_code)";
	 
		$workerlist = Db::name('worker w')
				->field('w.worker_id,w.worker_name,r.node_str')
				->join('role r','r.role_id = w.role_id')
				->where($con)
				->select();
		$arr = array();
		$i = 0;
		foreach($workerlist as $k=>$v){
			if(strpos($v['node_str'],'11') !== false){
				$arr[$i]['worker_id'] = $v['worker_id'];
				$arr[$i]['worker_name'] = $v['worker_name'];
				$i++;
			}
		}
		if(!$arr){
			return(json(array('status'=>0,'msg'=>'查询不到数据')));	
		}
		$data = $arr;
		return(json(array('status'=>1,'msg'=>'查询成功','data'=>$data)));
	}

	
	/**
     * [add_product_plan 添加生产计划]
     * @return [type] [description]
     */
	public function add_product_plan(){
		//$do = $this->request->param('do');
		//判断：如果获取了参数是执行添加，否则为显示添加页面
		//if($do){
			//获取变量
			$plan_no = $this->get_plan_sn();
			//$plan_name = $this->get_plan_name();
			$cat_id = $this->request->param('cat_id');
			$grow_date = $this->request->param('grow_date');
			$estimate_get_date_1 = $this->request->param('estimate_get_date_1');//预计采收期（开始）
			$estimate_get_date_2 = $this->request->param('estimate_get_date_2');//预计采收期（结束）
			//$grow_area_1 = $this->request->param('grow_area_1');//种植面积（平米）
			$grow_area_2 = $this->request->param('grow_area_2');//种植面积（亩）
			$estimate_amount = $this->request->param('estimate_amount');//预估总产量（kg）
			//$estimate_amount_one_date = $this->request->param('estimate_amount_one_date');//预估日产量（kg）
			$cost_worker = $this->request->param('cost_worker');//人工成本（元）
			$cost_materiel = $this->request->param('cost_materiel');//物料成本（元）
			$cost_amount = $this->request->param('cost_amount');//能耗成本（元）
			$cost_total = $this->request->param('cost_total');//总成本（元）
			$add_time = date('Y-m-d H:i:s');//新增数据的日期
			$worker = $this->worker;
			$add_worker_id = $worker['worker_id'];
			//$plan_name = $this->get_plan_name();
			$fzr_worker = json_decode($this->request->param('fzr_worker'),true);//负责人数组
			//var_dump($fzr_worker);die;
			$status = 0;
			$type = 1;
			//验证变量
			if(!$fzr_worker){
				$result['status']  = 0;
				$result['msg'] = "负责人数据为空";
				ajaxReturnJson($result);
			} 
			/* if(!$plan_no){
				$result['status'] = 0;
				$result['msg'] = "计划编号为空";
				return json($result);
			} */
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
/*			if(!$grow_area_1){
				$result['status'] = 0;
				$result['msg'] = "请输入种植面积（平米）";
				return json($result);
			}*/
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
/*			if(!$estimate_amount_one_date){
				$result['status'] = 0;
				$result['msg'] = "请输入预估日产量（kg）";
				return json($result);
			}*/
			/* if(!$add_time){
				$result['status'] = 0;
				$result['msg'] = "新增数据日期为空）";
				return json($result);
			} */
			if(!$add_worker_id){
				$result['status'] = 0;
				$result['msg'] = "发布者（id）为空";
				return json($result);
			}
			$cat_no  =  Db::name('materiel_category')->where('cat_id',$cat_id)->value('cat_no');
			$plan_name = date('Y/m/d',time()).' '.$cat_no;
			$data['plan_no'] = $plan_no;
			$data['plan_name'] = $plan_name;
			$data['cat_id'] = $cat_id;
			$data['grow_date'] = $grow_date;
			$data['estimate_get_date_1'] = $estimate_get_date_1;
			$data['estimate_get_date_2'] = $estimate_get_date_2;
			$data['grow_area_1'] = round($grow_area_2,2);
			$data['grow_area_2'] = round(($grow_area_2/666.67),2);
			$data['estimate_amount'] = $estimate_amount;
			//$data['estimate_amount_one_date'] = $estimate_amount_one_date;
			$data['cost_worker'] = $cost_worker;
			$data['cost_materiel'] = $cost_materiel;
			$data['cost_amount'] = $cost_amount;
			$data['cost_total'] = $cost_total;
			//$data['plan_date'] = $plan_date;
			$data['add_time'] = $add_time;
			$data['add_worker_id'] = $add_worker_id;
			$data['status'] = $status;
			$data['sell_product_id'] = $this->request->param('sell_product_id');
			$data['grow_mode_id'] = $this->request->param('grow_mode_id');
			
			$info_str = $data['sell_product_id'];
			if($info_str){
				$sell_data['status'] = 1;
				$order_num =  Db::name('sell_product_task')->where('sell_product_id in ('.$info_str.')')->update($sell_data);
			}
		 

			
			$data['type']  = 1;
			$plan_id = Db::name('product_plan')->insertGetId($data);//添加生产计划
			if($plan_id==false){
				$result['status'] = 0;
				$result['msg'] = "生产计划添加失败";
				return json($result);
			}
			$con['cat_id'] = $cat_id;
			$con1['plan_id'] = $plan_id;
			$mc_info = Db::name('mc_sum')->where($con)->find();
			if(!$mc_info){
				$data1['cat_id'] = $cat_id;
				$mc_sum_id = Db::name('mc_sum')->insert($data1);//添加品种汇总表
				if($mc_sum_id==false){
					$result['status'] = 0;
					$result['msg'] = "品种汇总表添加失败";
					return json($result);
				}
			}
			$pro_info = Db::name('pro_sum')->where($con1)->find();
			if(!$pro_info){
				$data2['cat_id'] = $cat_id;
				$data2['plan_id'] = $plan_id;
				$pro_sum_id = Db::name('pro_sum')->insert($data2);
				if($pro_sum_id == false){
					$result['status'] = 0;
					$result['msg'] = "生产计划汇总表添加失败";
					return json($result);
				}
			}
			$re = $this->add_p_grow($plan_id,$fzr_worker,$plan_name,$grow_date,$estimate_get_date_1,$estimate_get_date_2);//添加种植任务
			
			
			if($re){
				$result['status'] = 1;
				$result['msg'] = "添加成功";
				return json($result);
			}else{
				$result['status'] = 0;
				$result['msg'] = "添加失败";
				return json($result);
			}
			
			
/*		}else{
			return $this->fetch();
		}*/
	}


	/**
    * [ add_p_grow 添加种植任务]
    * @return [type] [description]
    */
	public function add_p_grow($plan_id,$fzr_worker,$plan_name,$grow_date,$estimate_get_date_1,$estimate_get_date_2){
		$arr = array();
		$arr = explode(' ',$plan_name);
		foreach ($fzr_worker as $k=>$v){
				$worker_name = Db::name('worker')->where('worker_id',$v[0])->value('worker_name');
				$p = Db::name('worker')->where('worker_id',$v[0])->value('phone');
				$info['t_name'] = date('ymd',time()).' '.$arr[1].' '.$worker_name;
				$info['plan_id'] = $plan_id;
				$info['t_no'] = $this->get_t_sn();
				$info['grow_date'] = $grow_date;
				$worker = $this->worker;
				$info['add_worker_id'] = $worker['worker_id'];
				$info['worker_id'] = $v[0];
				$info['grow_area_1'] = $v[1];
				$info['grow_area_2'] = round(($v[1]/666.67),2);
				$info['task_weight_1'] = $v[2];
				$info['estimate_get_date_1'] = $estimate_get_date_1;
				$info['estimate_get_date_2'] = $estimate_get_date_2;
				$info['add_time'] = date('Y-m-d H:i:s',time());
			$res = Db::name('pro_grow_task')->insert($info);
			$title='种植任务消息提醒';
			$content='您有新的种植任务';
			$phone = trim($p);
			pushMess($title,$content,$phone);
		}
		if($res){
			return true;
		}else{
			return false;
		}
	}
	
	/**
     * [edit_product_plan 编辑生产计划]
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
			$result['msg'] = "计划id为空";
			ajaxReturnJson($result);
		}
		//程序主体
		$con['plan_id'] = $plan_id;
		$con['type'] = 1;
		$find = Db::name('product_plan')->where($con)->find();
		if($find){
			if($cat_id){
				$data['cat_id'] = $cat_id;
			}else{
				$data['cat_id'] = $find['cat_id'];
			}
			if($grow_date){
				$data['grow_date'] = $grow_date;
			}else{
				$data['grow_date'] = $find['grow_date'];
			}
			if($estimate_get_date_1){
				$data['estimate_get_date_1'] = $estimate_get_date_1;
			}else{
				$data['estimate_get_date_1'] = $find['estimate_get_date_1'];
			}
			if($estimate_get_date_2){
				$data['estimate_get_date_2'] = $estimate_get_date_2;
			}else{
				$data['estimate_get_date_2'] = $find['estimate_get_date_2'];
			}
			if($grow_area_1){
				$data['grow_area_1'] = $grow_area_1;
			}else{
				$data['grow_area_1'] = $find['grow_area_1'];
			}
			if($grow_area_2){
				$data['grow_area_2'] = $grow_area_2;
			}else{
				$data['grow_area_2'] = $find['grow_area_2'];
			}
			if($estimate_amount){
				$data['estimate_amount'] = $estimate_amount;
			}else{
				$data['estimate_amount'] = $find['estimate_amount'];
			}
			if($estimate_amount_one_date){
				$data['estimate_amount_one_date'] = $estimate_amount_one_date;
			}else{
				$data['estimate_amount_one_date'] = $find['estimate_amount_one_date'];
			}
			if($cost_worker){
				$data['cost_worker'] = $cost_worker;
			}else{
				$data['cost_worker'] = $find['cost_worker'];
			}
			if($cost_materiel){
				$data['cost_materiel'] = $cost_materiel;
			}else{
				$data['cost_materiel'] = $find['cost_materiel'];
			}
			if($cost_amount){
				$data['cost_amount'] = $cost_amount;
			}else{
				$data['cost_amount'] = $find['cost_amount'];
			}
			
			if($plan_date){
				$data['plan_date'] = $plan_date;
			}else{
				$data['plan_date'] = $find['plan_date'];
			}
			
			$upp = Db::name('product_plan')->where($con)->update($data);//修改生产计划
			/* if($upp==false){
				$result['status'] = 0;
				$result['msg'] = "修改失败";
				return json($result);
			} */
			$upre = $this->edit_p_worker($plan_id);//修改生产计划负责人（修改生产计划子计划）
			
			if($upre){
				$result['status'] = 1;
				$result['msg'] = "修改成功";
				return json($result);
			}else{
				$result['status'] = 0;
				$result['msg'] = "修改失败";
				return json($result);
			}
			
			
		}
		
	}
	
	/**
     * [edit_p_worker 修改生产计划负责人]
     * @return [type] [description]
     */
	public function edit_p_worker($plan_id){
		//获取变量
		$worker_id = $this->request->param('worker_id');
		$p_amount = $this->request->param('p_amount');//个人负责的产量
		$p_grow_area_1 = $this->request->param('p_grow_area_1');//个人负责的种植面积（平米）
		$p_grow_area_2 = $this->request->param('p_grow_area_2');//个人负责的种植面积（亩）
		
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
				$newinfo = array();
				if(empty($worker_id[$k])){//新更改的数据比原有数据少的情况删除多余的原有数据
					
					$res = Db::name('pro_plan_son_worker')->where(array('ps_id'=>$row['ps_id']))->delete();
				}else if(count($worker_id)==count($info)){//新更改的数据跟原有数据一样多的情况 直接更新
				
					$newinfo['worker_id'] = $worker_id[$k];
					$newinfo['p_amount'] = $p_amount[$k];
					$newinfo['p_grow_area_1'] = $p_grow_area_1[$k];
					$newinfo['p_grow_area_2'] = $p_grow_area_2[$k];
					$res = Db::name('pro_plan_son_worker')->where(array('ps_id'=>$row['ps_id']))->update($newinfo);
				}
				
				
			}
			
			if(count($worker_id)>count($info)){//新更改的数据的个数大于原有数据的个数 添加
				
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
			//原有数据没有的情况，直接执行添加
			foreach ($worker_id as $k=>$worker_id){
				$data['worker_id'] = $worker_id;
				$data['plan_id'] = $plan_id;
				$data['p_amount'] = $p_amount[$k];
				$data['p_grow_area_1'] = $p_grow_area_1[$k];
				$data['p_grow_area_2'] = $p_grow_area_2[$k];
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
     * [ndo_edit_product_plan 编辑生产计划显示页面]
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
		$find = Db::name('product_plan')->where($con)->find();
		
		
		
		
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
     * [ndo_edit_p_worker 获取生产计划负责人信息]
     * @return [type] [description]
     */
	public function ndo_edit_p_worker($plan_id,$a=0){
		//获取变量		
		$ps_id = $this->request->param('ps_id');
		
		//程序主体
		$con['plan_id'] = $plan_id;
		if($ps_id){
			$con['ps_id'] = $ps_id;
		}
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
     * [add_p_worker 添加生产计划负责人]
     * @return [type] [description]
     */
	public function add_p_worker($plan_id,$fzr_worker,$plan_name){
		//dump($fzr_worker);die;
		
		//获取变量
/*		$worker_id = $this->request->param('worker_id');
		
		$p_amount = $this->request->param('p_amount');//个人负责的产量
		$p_grow_area_1 = $this->request->param('p_grow_area_1');//个人负责的种植面积（平米）
		$p_grow_area_2 = $this->request->param('p_grow_area_2');//个人负责的种植面积（亩）
		
		//验证变量
		if(!$worker_id){
			//dump(12345);die;
			$result['status']  = 0;
			$result['msg'] = "负责人的id为空";
			//return json($result);
			//echo json_encode($result);die;
			//$this->ajaxReturn($result);die;
			ajaxReturnJson($result);
		} 
		if(!$p_amount){
			$result['status']  = 0;
			$result['msg'] = "个人负责的产量为空";
			//return json($result);
			ajaxReturnJson($result);
		}
		if(!$p_grow_area_1){
			$result['status']  = 0;
			$result['msg'] = "个人负责的种植面积（平米）为空";
			//return json($result);
			ajaxReturnJson($result);
		}
		if(!$p_grow_area_2){
			$result['status']  = 0;
			$result['msg'] = "个人负责的种植面积（亩）为空";
			//return json($result);
			ajaxReturnJson($result);
		}*/
		
		//判断传值是否是个数组
		/*if(!is_array($worker_id)){
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
		}*/
		//程序主体
		$arr = array();
		$arr = explode(' ',$plan_name);
		foreach ($fzr_worker as $k=>$v){
				//$ps_name = $this->get_ps_name();
				$worker_name = Db::name('worker')->where('worker_id',$v[0])->value('worker_name');
				$info['ps_name'] = date('ymd',time()).' '.$arr[1].' '.$worker_name;
				$info['plan_id'] = $plan_id;
				$info['worker_id'] = $v[0];
				$info['p_grow_area_2'] = round($v[1],2);
				$info['p_amount'] = $v[2];
			$res = Db::name('pro_plan_son_worker')->insert($info);
		}
		if($res){
			return true;
		}else{
			return false;
		}
		
	}
	/**
 * 20 [get_ps_name 获取生产计划名称（pc）]
 * @return [type] [description]
 */
private function get_ps_name(){
	//获取变量
	
	$name = "生产任务";
	
	$number = Db::name('pro_plan_son_worker')->count();
	$number++;
	//填充0；str_pad()填充字符串；STR_PAD_LEFT:填充到字符串的左侧
	
	
	$ps_name = $name.$number;
	return $ps_name;
}
	
	
	/**
     * [del_product_plan 删除生产计划接口]
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
		$list = array();
		$list = Db::name('pro_grow_task')->where('plan_id',$plan_id)->column('status');
		foreach($list as $k=>$v){
			if($v > 0){
				$result['status'] = 0;
				$result['msg'] = "该生产计划已进行，无法删除";
				ajaxReturnJson($result);
			}
		}

		//程序主体
		$con['plan_id'] = $plan_id;
		$con1['status'] = -1; 
		$re = Db::name('product_plan')->where($con)->update($con1);
		if($re!==false){
			$res = Db::name('pro_grow_task')->where('plan_id',$plan_id)->update($con1);
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
     * [add_pp_process 添加生产计划审批流接口]
     * @return [type] [description]
     */
	public function add_pp_process(){
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
     * [pp_process_list 生产计划审批流列表接口]
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
     * [pp_process_detail 生产计划审批流详情接口]
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
			$result['msg'] = "获取失败";
			$result['data'] = '';
			ajaxReturnJson($result);
		}
		
	}
	/**
     * [add_grow_process 添加种植任务审批流接口]
     * @return [type] [description]
     */
	
	public function add_grow_process(){
		//获取变量
		$t_id = $this->request->param('t_id');
		$check_time = date('Y-m-d H:i:s');
		$reason = $this->request->param('reason');
		$status = $this->request->param('status');
		//验证变量
		if(!$t_id){
			$result['status'] = 0;
			$result['msg'] = "种植任务id为空";
			ajaxReturnJson($result);
		}
		if(!$reason){
			$result['status'] = 0;
			$result['msg'] = "请输入审批原因";
			ajaxReturnJson($result);
		}
		if(!$status){
			$result['status'] = 0;
			$result['msg'] = "请选择通过与否";
			ajaxReturnJson($result);
		}
		//程序主体
		$con['t_id'] = $t_id;
		$fbr = Db::name('pro_grow_task')->where($con)->value('add_worker_id');
		$con1['worker_id'] = $fbr;
		$check_worker_id = Db::name('worker')->where($con1)->value('pid');
		if($check_worker_id==0){
			$check_worker_id = 1;
		}
		//程序主体
		$data['t_id'] = $t_id;
		$data['check_time'] = $check_time;
		$data['check_worker_id'] = $check_worker_id;
		$data['reason'] = $reason;
		$data['status'] = $status;
		
		$re = Db::name('pro_grow_process')->insert($data);
		
		if($re){
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
     * [t_process_list 种植任务审批流的列表接口]
     * @return [type] [description]
     */
	public function t_process_list(){
		//分页
		$row=10;
		$page = $this->request->param('page');
		$count = Db::name('pro_grow_process')->count();
		//程序主体
		if($page==1||!$page){
			$page=0;
		}else{
			$page = ($page-1)*$row;
		}
		$data = Db::name('pro_grow_process')->limit($page,$row)->select();
		$result['status'] = 1;
		$result['msg'] = "获取成功";
		$result['data'] = $data;
		$result['count'] = $count;
		ajaxReturnJson($result);
	}
	
	/**
     * [t_process_detail 种植任务审批流的详情接口]
     * @return [type] [description]
     */
	public function t_process_detail(){
		//获取变量
		$t_id = $this->request->param('t_id');
		//验证变量
		if(!$t_id){
			$result['status'] = 0;
			$result['msg'] = "种植任务的id为空";
			ajaxReturnJson($result);
		}
		//程序主体
		$con['t_id'] = $t_id;
		$info = Db::name('pro_grow_process')->where($con)->find();
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
     * [add_pg_task 添加种植任务接口]
     * @return [type] [description]
     */
	public function add_pg_task(){
		//添加环境 区域信息
		$array_info = json_decode($this->request->param('array_info'));		
		$data = [];
		if(!$array_info){
			$result['status'] = 0;
			$result['msg'] = "种植信息有误";
			ajaxReturnJson($result);
		}
/*		$data['grow_area_1'] = 0;
		$data['grow_area_2'] = 0;*/
		foreach($array_info as $k=>$info){
/*			$data['grow_area_1'] += $info[3];
			$data['grow_area_2'] += $info[4];*/	
			if(!$info[0]){
				$result['status'] = 0;
				$result['msg'] = "请选择种植环境";
				ajaxReturnJson($result);
			}
			if(!$info[1]){
				$result['status'] = 0;
				$result['msg'] = "请选择种植区域";
				ajaxReturnJson($result);
			}
			if(!$info[3]){
				$result['status'] = 0;
				$result['msg'] = "请输入定植数量";
				ajaxReturnJson($result);
			}						
		}
		//获取变量
		$t_id= $this->request->param('t_id');
		if(!$t_id){
			$result['status'] = 0;
			$result['msg'] = "种植任务id为空";
			ajaxReturnJson($result);
		}
		$add_worker_id = Db::name('pro_grow_task')->where('t_id',$t_id)->value('add_worker_id');
		$p = Db::name('worker')->where('worker_id',$add_worker_id)->value('phone');
		//$t_no = $this->get_t_sn();
		//以子计划id为条件查询总计划的id；
		$con['t_id'] = $t_id;
		//$plan_id = $this->request->param('plan_id');
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
		//$total_cost = $this->request->param('total_cost');
		//$worker_id = $this->request->param('worker_id');
		//$add_time = date('Y-m-d H:i:s');
		//$worker = $this->worker;
		//$add_worker_id = $worker['worker_id'];
		/* $data['grow_area_1'] = $this->request->param('grow_area_1');
		$data['grow_area_2'] = $this->request->param('grow_area_2'); */
		//$data['cost_worker'] = $this->request->param('cost_worker');//人工成本（元）
		//$data['cost_materiel'] = $this->request->param('cost_materiel');//物料成本（元）
		//$data['cost_amount']= $this->request->param('cost_amount');//总成本（元）
		
/*		if(!$data['cost_worker']){
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
		if(!$data['grow_area_1']){
			$result['status'] = 0;
			$result['msg'] = "种植面积（平米）为空";
		}
		if(!$data['grow_area_2']){
			$result['status'] = 0;
			$result['msg'] = "种植面积（亩）为空";
		}
		if(!$t_no){
			$result['status'] = 0;
			$result['msg'] = "任务编号为空";
			ajaxReturnJson($result);
		}*/
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
/*		if(!$total_cost){
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
		*/
		//程序主体
 
/*		$data['plan_id'] = $plan_id;
		$cat_id = Db::name('product_plan')->where('plan_id',$plan_id)->value('cat_id');
		$cat_no  =  Db::name('materiel_category')->where('cat_id',$cat_id)->value('cat_no');
		$worker_name = Db::name('worker')->where('worker_id',$worker_id)->value('worker_name');
		$t_name = date('ymd',time()).' '.$cat_no.' '.$worker_name;
		//$data['t_name'] = $this->get_task_name();
		$data['t_name'] = $t_name;*/
		/*$data['ps_id'] = $ps_id;
		$data['t_no'] = $t_no;*/
		$data['grow_mode_id'] = $grow_mode_id;
		$data['zhu_ju'] = $zhu_ju;
		$data['hang_ju'] = $hang_ju;
		$data['total_grow_num'] = $total_grow_num;
		$data['one_weight'] = $one_weight;
		$data['sm_weight'] = $sm_weight;
		$data['year_weight'] = $year_weight;
		$data['status'] = 1;
		$data['grow_date'] = $grow_date;
		$data['estimate_get_date_1'] = $estimate_get_date_1;
		$data['estimate_get_date_2'] = $estimate_get_date_2;
/*		$data['total_cost'] = $total_cost;
		$data['worker_id'] = $worker_id;
		$data['add_time'] = $add_time;
		$data['add_worker_id'] = $add_worker_id;*/
		$re = Db::name('pro_grow_task')->where($con)->update($data);	//添加种植任务
		$plan_id = Db::name('pro_grow_task')->where($con)->value('plan_id');
		if($re !== false){

			$title='种植任务消息提醒';
			$content='新的种植任务已完善';
			$phone = trim($p);
			pushMess($title,$content,$phone);

			$con1['t_id'] = $t_id;
			$t_sum_info = Db::name('task_sum')->where($con1)->find();
			if(!$t_sum_info){
				$data2['t_id'] = $t_id;
				$data2['plan_id'] = $plan_id;
				$t_sum_id = Db::name('task_sum')->insert($data2);
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
				$res = Db::name('pro_grow_task_area')->insert($data1);
				if(!$res){
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
     * [get_t_sn 获取种植任务编号接口]
     * @return [type] [description]
     */
	private function get_t_sn(){
		//获取变量
		$shijian = date('Ymd');//当天时间
		$con['grow_date'] = array('eq',$shijian);
		$number = Db::name('pro_grow_task')->count();
		$number++;
		//填充0；str_pad()填充字符串；STR_PAD_LEFT:填充到字符串的左侧
		
		$numbered = str_pad($number,3,"0",STR_PAD_LEFT);
		$head = Db::name('confing_prex')->where('prex_id=3')->value('prex_name');
		$t_no = $head.$shijian.$numbered;
		return $t_no;
	}
	/**
     * [t_harvest_detail 获取产量质检中种植任务详情接口]
     * @return [type] [description]
     */
	
	public function t_harvest_detail(){
		//获取变量
		$t_id = $this->request->param('t_id');
		//验证变量
		if(!$t_id){
			$result['status'] = 0;
			$result['msg'] = "种植任务id为空";
			ajaxReturnJson($result);
		}
		//程序主体
		$con['hd.t_id'] = $t_id;
		
		$field1[] = 'worker_id';
		$field[] = 'cat_id cat_id2';
		$field2[] = 'worker_name';
		$field3[] = 'ft_name c_name';
		$field4[] = 'ft_name ty_name';
		$field5[] = 'cat_name cat_name2';
		$field6[] = 'cat_name cat_name1';
		$field6[] = 'cat_id cat_id1';
		
		$data = Db::view('mf_pro_harvest_day hd',$field)
			  ->view('mf_pro_grow_task t',$field1,'t.t_id = hd.t_id')
			  ->view('mf_worker w',$field2,'t.worker_id = w.worker_id')
			  ->view('mf_fruits_color c',$field3,'c.cat_id = hd.cat_id')
			  ->view('mf_fruits_type ty',$field4,'ty.cat_id = hd.cat_id')
			  ->view('mf_materiel_category mc',$field5,'mc.cat_id = hd.cat_id')
			  ->view('mf_materiel_category mc2',$field6,'mc.pid = mc2.cat_id') 
			  ->where($con)
			  ->find();
			  
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
	$worker = $this->worker;
	$worker_id = $worker['worker_id'];

	$con['pp.plan_id'] = $plan_id;
	$field[] = 'pp.plan_id';
	$field[] = 'pp.plan_name';
	$field[] = 'pp.cat_id';
	$field[] = 'mc.pid';
	$field[] = 'mc.cat_name cat_p_name';
	$field[] = 'mc.fcolor fc_name';
	$field[] = 'mc.ftype ft_name';
	$field[] = 'mc1.cat_name';
	$field[] = 'mc.cat_desc';
	$field[] = 'pp.plan_no';
	$field[] = 'pp.grow_date';
	$field[] = 'pp.type';
	$field[] = 'pp.estimate_get_date_1';
	$field[] = 'pp.estimate_get_date_2';
	$field[] = 'pp.grow_area_1 as grow_area_2';
	$field[] = 'pp.estimate_amount';
	$field[] = 'pp.estimate_amount_one_date';
	$field[] = 'pp.cost_worker';
	$field[] = 'pp.cost_materiel';
	$field[] = 'pp.cost_amount';
	$field[] = 'pp.cost_total';
	$field[] = 'pp.add_worker_id';
	$field[] = 'w.worker_name';
	
	$info = Db::name('product_plan pp')
			->field(implode(',',$field))
			->join('mf_materiel_category mc','mc.cat_id = pp.cat_id','left')
			->join('mf_materiel_category mc1','mc1.cat_id = mc.pid','left')
			->join('mf_worker w','w.worker_id = pp.add_worker_id','left')
			->where($con)->where('pp.status','neq',-1)
			->find();
		
	/* foreach($data as $k=>$info){ */
		foreach($info as $k1=>$v1){
			$info['grow_area_2'] = round($info['grow_area_2'],2);
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

			if(!$info['cost_total']){
				$info['cost_total'] = 0.00;
			}
			//$total = $info['cost_worker']+$info['cost_materiel']+$info['cost_amount'];

			$info['total_cost'] = $info['cost_total'];
			
			//获取子类
			$con1['psw.plan_id'] = $plan_id;

			$field1[] = 'psw.t_id';
			$field1[] = 'w.worker_id';
			$field1[] = 'w.worker_name';
			$field1[] = 'psw.task_weight_1 as p_amount';
			$field1[] = 'psw.grow_area_1 as grow_area_2';
			$field1[] = 'psw.status';

			$son = Db::name('pro_grow_task psw')
			->field(implode(',',$field1))
			->join('mf_worker w','w.worker_id = psw.worker_id')
			->where($con1)
			->select(); 

			$total = 0;
			
			
			if($son){
				foreach($son as $k=>$v){
					$son[$k]['total_output'] = 0;
					$total_output = Db::name('task_sum')->where('t_id',$v['t_id'])->value('total_output');
					if(isset($total_output)){
						$son[$k]['total_output'] = $total_output;
					}

					$total += $total_output;

					$son[$k]['grow_area_2'] = round($son[$k]['grow_area_2'],2);
				}

				$info['total'] = $total;
				$info['son'] = $son;
			}else{
				$info['son'] = array();
			}
			
			
			
		}
		//$data[$k] = $info;	
	/* } */
	$result['status'] = 1;
	$result['msg'] = "获取成功";
	$result['data'] = $info;
	ajaxReturnJson($result);

}

	
	
	
	
	/**
     * [product_list_detail 获取总生产计划详情接口]
     * @return [type] [description]
     */
	public function product_list_detail_old(){
		
		
		$worker = $this->worker;
		$worker_id = $worker['worker_id'];
		
		$plan_id = $this->request->param('plan_id');
		
		if(!$plan_id){
			$result['status'] = 0;
			$result['msg'] = "生产计划id为空";
			ajaxReturnJson($result);
		}
		
		
		
		$con['pp.plan_id'] = $plan_id;
		
		
		
		$field[] = 'pp.plan_id';
		$field[] = 'pp.cat_id';
		$field[] = 'mc.pid';
		$field[] = 'mc.cat_name cat_p_name';
		$field[] = 'ft.ft_name';
		$field[] = 'fc.ft_name fc_name';
		$field[] = 'mc1.cat_name';
		$field[] = 'mc.cat_desc';
		$field[] = 'pp.plan_no';
		$field[] = 'pp.grow_date';
		$field[] = 'pp.estimate_get_date_1';
		$field[] = 'pp.estimate_get_date_2';
		$field[] = 'pp.grow_area_1 as grow_area_2';
		//$field[] = 'pp.grow_area_1';
		$field[] = 'pp.estimate_amount';
		$field[] = 'pp.estimate_amount_one_date';
		$field[] = 'pp.cost_worker';
		$field[] = 'pp.cost_materiel';
		$field[] = 'pp.cost_amount';
		//$field[] = 'pp.status';
		
		
		
		$data = Db::name('product_plan pp')
			->field(implode(',',$field))
			->join('mf_materiel_category mc','mc.cat_id = pp.cat_id','left')
			->join('mf_materiel_category mc1','mc1.pid = pp.cat_id','left')
			->join('mf_fruits_color fc','fc.cat_id = pp.cat_id','left')
			->join('mf_fruits_type ft','ft.cat_id = pp.cat_id','left')
			//->join('mf_pro_plan_son_worker ppsw','ppsw.plan_id = pp.plan_id')
			//->join('mf_pro_grow_task pgt','pgt.plan_id = pp.plan_id')
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
				$field1[] = 'psw.plan_id';
				$field1[] = 'psw.ps_id';
				$field1[] = 'w.worker_id';
				$field1[] = 'w.worker_name';
				$field1[] = 'psw.p_amount';
				$field1[] = 'psw.p_grow_area_1';
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
		
		foreach($data as $k=>$v){
			$result = Db::name('materiel_category')->where('cat_id',$v['pid'])->field('cat_name')->find();
			$data[$k]['cat_name'] = $result['cat_name'];
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
     * [product_list 获取生产计划列表接口]
     * @return [type] [description]
     */
	
	public function product_list(){
		
		$row = 3;
		$page = $this->request->param('page');
		$type = $this->request->param('type');
		$worker = $this->worker;
		$worker_id = $worker['worker_id'];
		$group_id = $worker['group_id'];
		
		$cat_name = $this->request->param('cat_name');
		$grow_area_2 = $this->request->param('grow_area_2');
		$s_time = $this->request->param('s_time');
		$e_time = $this->request->param('e_time');
		
		$condition['pp.grow_area_2'] = $grow_area_2 ? array('like',"%{$grow_area_2}%") : NULL;
		if($s_time){
			$con['pp.add_time'] = array('egt',date('Y-m-d 00:00:00',strtotime($s_time)));
		}
		if($e_time){
			$con['pp.add_time'] = array('elt',date('Y-m-d 24:00:00',strtotime($e_time)));
		}
		if($s_time && $e_time){
			$con['pp.add_time'] = array(array('egt',date('Y-m-d 00:00:00',strtotime($s_time))),array('elt',date('Y-m-d 24:00:00',strtotime($e_time))));
		}
		foreach($condition as $k => $v){
			if(!$v){
				unset($condition[$k]);
			}
		}
		if($cat_name){
			$string = "mc.cat_name like '%{$cat_name}%' or mc1.cat_name like '%{$cat_name}%'";
		}else{
			$string = '';
		}

		if($group_id != 1){
			$con['pp.add_worker_id'] = $worker_id;
		}
		$con['pp.type'] = $type;
		$con['pp.status'] = array('neq',-1);
		
		if($page==1||!$page){
			$page = 0;
		}else{
			$page = ($page-1)*$row;
		}
		$field[] = 'pp.plan_id';
		$field[] = 'pp.sell_product_id';
		$field[] = 'pp.plan_name';
		$field[] = 'pp.plan_no';
		$field[] = 'pp.cat_id';
		$field[] = 'mc.cat_name cat_p_name';
		$field[] = 'mc.fcolor as ft_name';
		$field[] = 'mc.ftype as fc_name';
		$field[] = 'mc1.cat_name';
		$field[] = 'w.worker_name';
		$field[] = 'pp.plan_no';
		$field[] = 'pp.grow_area_1 as grow_area_2';
		$field[] = 'pp.add_time';
		$field[] = 'pp.estimate_amount';
		$field[] = 'pp.type';
		$count = Db::name('product_plan pp')
			->field(implode(',',$field))
			->join('mf_materiel_category mc','mc.cat_id = pp.cat_id')
			->join('mf_materiel_category mc1','mc1.cat_id = mc.pid')
			->join('mf_pro_grow_task t','t.plan_id = pp.plan_id')
			->join('mf_worker w','w.worker_id = pp.add_worker_id')
			->where($con)->where($condition)
			->where($string)
			->group('pp.plan_id')
			->count();
			
		
		$data = Db::name('product_plan pp')
			->field(implode(',',$field))
			->join('materiel_category mc','mc.cat_id = pp.cat_id')
			->join('mf_materiel_category mc1','mc1.cat_id = mc.pid')
			->join('mf_pro_grow_task t','t.plan_id = pp.plan_id')
			->join('mf_worker w','w.worker_id = pp.add_worker_id')
			->where($con)->where($condition)
			->where($string)
			->order('pp.add_time desc')
			->group('pp.plan_id')
			->limit($page,$row)
			->select();
		foreach($data as $k=>$v){
			$data[$k]['add_time'] = date('Y-m-d',strtotime($v['add_time']));
			$data[$k]['grow_area_2'] = round($v['grow_area_2'],2);
		}	
		if($data){
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['count'] = $count;
			$result['data'] = $data;
			ajaxReturnJson($result);
		}else{
			$data = array();
			$result['status'] = 1;
			$result['msg'] = "当前没有生产计划";
			$result['count'] = $count;
			$result['data'] = $data;
			ajaxReturnJson($result);
		}
		
	}

	/**
	* [11 work_task_list 生产任务接口]
	* @return [type] [description]
	*/		
			
	public function work_task_list(){
		$worker = $this->worker;

		$worker_id = $worker['worker_id'];

		$con['ps.worker_id'] = $worker_id;
		$con['ps.status'] = array('neq',-1);

		$field[] = 'p.cat_id';
		$field[] = 'p.plan_id';
		$field[] = 'ps.ps_id';
		$field[] = 'ps.ps_name';
		$field[] = 'w.worker_id';
		$field[] = 'w.worker_name';
		$field[] = 'ps.p_amount';
		//$field1[] = 'psw.p_grow_area_1';
		$field[] = 'ps.p_grow_area_2';
		$field[] = 'p.add_time';

		$info = Db::name('pro_plan_son_worker ps')
			->field(implode(',',$field))
			->join('mf_worker w','w.worker_id = ps.worker_id')
			->join('mf_product_plan p','p.plan_id = ps.plan_id')
			->where($con)
			->order('ps.ps_id desc')
			->select();

		$arr = array();

		foreach($info as $k=>$v){
			$arr = Db::name('materiel_category')->where('cat_id',$v['cat_id'])->field('cat_name,pid,fcolor,ftype')->find();
			
			$info[$k]['cat_name'] = $arr['cat_name'];
			$info[$k]['fcolor'] = $arr['fcolor'];
			$info[$k]['ftype'] = $arr['ftype'];
			$info[$k]['cat_p_name'] = Db::name('materiel_category')->where('cat_id',$arr['pid'])->value('cat_name');
		}

		$data = array();
		$data = $info;

		$result['status'] = 1;
		$result['msg'] = "获取成功";
		$result['data'] = $data;
		ajaxReturnJson($result);
	
	}

	/**
    * [get_menu 获取用户菜单]
    * @return [type] [description]
    */
    public function get_menu(){
    	
    	$type = $this->request->param('type');
        
        $k=0;

        $menuArr =  array();
 		
 		$worker = $this->worker;

 		//$node_arr = explode(',', $worker['node_str']);

 		$node_arr = $worker['node_str'];

 		$con['node_id'] = array('in',$node_arr);

 		$title = Db::name('menu_node')->where($con)->field('node_id,title')->select();


 		foreach($title as $k=>$v){

 			if($v['node_id'] == 19){
 				$v['title'] = '物料管理2';
 			}
 			$menuArr[$k]['name'] = $v['title'];
            $menuArr[$k]['url'] = '';
 		}

        $data['status'] = 1;
        $data['msg'] = '获取成功';
        $data['menu'] = $menuArr;
        return json($data);
    }

   	/**
    * [confirm_plan 确认生产计划完成]
    * @return [type] [description]
    */
    public function confirm_plan(){

    	$plan_id = $this->request->param('plan_id');

    	$status = Db::name('pro_grow_task')->where('plan_id',$plan_id)->where('status','gt','-1')->column('status');
    	
    	foreach($status as $k=>$v){
    		if($v != 3){
    			$data['status'] = 0;
       			$data['msg'] = '种植任务全部完成才能确认';
       			return json($data);
    		}
    	}

    	$re = Db::name('product_plan')->where('plan_id',$plan_id)->setField('type',2);

    	if($re !== false){

    		$data['status'] = 1;
       		$data['msg'] = '确认完成';
       		return json($data);
    	}else{
    		$data['status'] = 0;
       		$data['msg'] = '确认失败';
       		return json($data);
    	}

    }
	public function pushMess(){  
		$title='222';
		$content='222';
		$phone='13851889623';
		pushMess($title,$content,$phone);
	} 
	/*
	消息推送接口 
	*/	
	public function message_return(){

		$worker = $this->worker;
		$worker_id = $worker['worker_id'];

		$con1['worker_id'] = $worker_id;
		$con1['status'] = 0;

		$con2['add_worker_id'] = $worker_id;
 		$con2['status'] = 1;

 		$con3['add_worker_id'] = $worker_id;
 		$con3['status'] = 3;

 		$con4['worker_id'] = $worker_id;
 		$con4['status'] = 0;

 		$con5['add_worker_id'] = $worker_id;
 		$con5['status'] = 3;

 		$con6['use_worker_id'] = $worker_id;
 		$con6['status'] = 1;
 		$con6['type'] = 1;

		$con7['add_worker_id'] = $worker_id;
 		$con7['status'] = 3;
 		$con7['type'] = 1;

		//发布生产计划，种植任务负责人接收种植任务消息提醒 
 		$data['info_1'] = Db::name('pro_grow_task')->where($con1)->count();
		
		//种植任务负责人完善种植任务信息，种植任务发布人接收消息提醒  
 		$data['info_2'] = Db::name('pro_grow_task')->where($con2)->count();
		
		//种植任务负责人完成种植任务，发布人接收消息提醒  
 		$data['info_3'] = Db::name('pro_grow_task')->where($con3)->count();
		
		//发布工单，工单负责人接收消息提醒  
 		$data['info_4'] = Db::name('pro_worker_job')->where($con4)->count();
		
		//工单完成，工单发布人接收消息提醒  
 		$data['info_5'] = Db::name('pro_worker_job')->where($con5)->count();
		
		//.发布领料，领料人接收消息提醒  
 		$data['info_6'] = Db::name('pro_take_back')->where($con6)->count();
		
		//确认领料后，领料单发布人接收消息提醒  
 		$data['info_7'] = Db::name('pro_take_back')->where($con7)->count();
		
		return json(['status'=>0,'msg'=>'查询成功','data'=>$data]);
		
	}
}

