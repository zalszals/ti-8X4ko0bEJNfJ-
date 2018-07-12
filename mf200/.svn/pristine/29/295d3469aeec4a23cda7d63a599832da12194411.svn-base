<?php
namespace app\product\controller;
use app\base\controller\Base;
use think\Db;


class ProLosses extends Base{
	
	/**
     * [1 pro_area_list 物料管理——记录能耗（种植区域列表《下拉》）]
     * @return [type] [description]
     */
	public function pro_area_list(){
		$con['pgt.status'] = 0;      //0:未完成 1：已完成
		$area_list1 = Db::name('pro_grow_task pgt')
				  ->join('pro_grow_task_area pgta','pgta.t_id = pgt.t_id')
				  ->join('grow_area ga','ga.area_id = pgta.area_id')
				  ->field('pgta.area_id,ga.area_name')
				  ->where($con)
				  ->select(); 
				  
		if($area_list1){
			foreach($area_list1 as $k=>$v){
				$v = join(",",$v);
				$temp[$k] = $v;
			}
			$temp = array_unique($temp);
			foreach($temp as $k => $v){
				$arr = explode(",",$v);
				$area_list[$k]['area_id'] = $arr[0];
				$area_list[$k]['area_name'] = $arr[1];
			}
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $area_list;
			ajaxReturnJson($result);
		}else{
			$result['status'] = 0;
			$result['msg'] = "查询无数据";
			$result['data'] = '';
			ajaxReturnJson($result);
		}
		
	}
	
	/**
     * [2 pro_task_list 物料管理——记录能耗（种植任务列表《下拉》）]
     * @return [type] [description]
     */
	public function pro_task_list(){
		//获取变量
		$area_id = $this->request->param('area_id');
		//验证变量
		if(!$area_id){
			$result['status'] = 0;
			$result['msg'] = "种植区域id为空";
			ajaxReturnJson($result);
		}
		//程序主体
		$con['area_id'] = $area_id;
		$ptask_list = Db::name('pro_grow_task_area pgta')
					->field('pgt.t_id,pgt.t_name,p.plan_name')
					->join('pro_grow_task pgt','pgt.t_id = pgta.t_id')
					->join('product_plan p','p.plan_id = pgta.plan_id')
					->where($con)
					->select();
					
		foreach($ptask_list as $k=>$v){
			$k1=$k;
			$k1++;
			$task_name = $v['plan_name'].'-'.$v['t_name'];
			$t_id = $v['t_id'];
			$list[$k]['t_id'] = $t_id;
			$list[$k]['task_name'] = $task_name;
		}	
		if($list){
			$list_count = count($list);
			$result['status'] = 1;
			if($list_count==1){
				$result['msg'] = "获取成功";
			}else{
				$result['msg'] = "请选取一个种植任务";
			}
			$result['data'] = $list;
			ajaxReturnJson($result);
		}else{
			$result['status'] = 0;
			$result['msg'] = "查询无数据";
			$result['data'] = '';
			ajaxReturnJson($result);
		}	
	}
	/**
     * [3 m_task_list 物料管理——记录能耗（获取负责人等的信息）]
     * @return [type] [description]
     */
	public function m_task_list(){
		//获取变量
		$t_id = $this->request->param('t_id'); 
		//验证变量
		if(!$t_id){
			$result['status'] = 0;
			$result['msg'] = "种植任务id为空";
			ajaxReturnJson($result);
		}
		$nowtime = time();
		
		$field[] = 'gt.t_id';
		$field[] = 'w.worker_name';
		$field[] = 'mc.cat_name as cat_p_name'; //品种
		$field[] = 'mc.fcolor';
		$field[] = 'mc.ftype';
		$field[] = 'mc1.cat_name'; //作物
		$field[] = 'gt.grow_date';  //定植日期
		
		
		$con['gt.t_id'] = $t_id;
		$con['gt.status'] = 0;
		$info = Db::name('pro_grow_task gt')
			  ->field(implode(',',$field))
			  ->join('worker w','gt.worker_id = w.worker_id')
			  ->join('mf_product_plan p','p.plan_id = gt.plan_id')
			  ->join('mf_materiel_category mc','mc.cat_id = p.cat_id') //品种
			  ->join('mf_materiel_category mc1','mc1.cat_id = mc.pid') //作物
			  ->where($con)
			  ->find();
		if($info){
			$gd_num = 0;
			$grow_date = strtotime($info['grow_date']);
			if($grow_date>=$nowtime){
				$gd_num = 0;
				$info['gd_num'] = 0;
			}else{
				$gd_num = $nowtime - $grow_date;
				$info['gd_num'] = floor($gd_num/86400)."天";
			}
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
     * [4 add_prolos 物料管理——记录能耗(执行添加)]
     * @return [type] [description]
     */
	
	public function add_prolos(){
		//获取变量
		$t_id = $this->request->param('t_id'); 
		if(!$t_id){
			$result['status'] = 0;
			$result['msg'] = "种植任务id为空";
			ajaxReturnJson($result);
		}
		
		$con['t.t_id'] = $t_id;
		$info = Db::name('pro_grow_task t')
				 ->field('t.plan_id,p.plan_no,t.t_no,t.grow_date')
				 ->join('product_plan p','p.plan_id = t.plan_id')
				 ->where($con)
				 ->find();
		if($info){
			$plan_id = $info['plan_id'];
			$plan_no = $info['plan_no'];
			$t_no = $info['t_no'];
			$grow_date = $info['grow_date'];
		}
		$area_id = $this->request->param('area_id');
		$area_name = $this->request->param('area_name');
		$date_1 =  $this->request->param('date_1');
		$date_2 =  $this->request->param('date_2');
		
		//添加 天然气 二氧化碳 水 电

		$prolosses_array = json_decode($this->request->param('prolosses_array'),true);

		//$test="{{0:10,1:10},{0:20,1:20},{0:30,1:0},{0:40,1:40}}";
		//$test=[{10,10},{20,20},{30,30},{40,40}];
		//$prolosses_array = json_decode($test);
		//$prolosses_array=[[10,10],[20,20],[30,30],[40,40]];
		//var_dump($prolosses_array);die();

		if(!$prolosses_array){
			$result['status'] = 0;
			$result['msg'] = "各能源值为空";
			ajaxReturnJson($result);
		}
		foreach($prolosses_array as $k=>$v){
			switch($k){
				case 0:	
					$gas_num = $v[0];
					$gas_price = $v[1];
					break;
				case 1:
					$co2_num = $v[0];
					$co2_price = $v[1];
					break;
				case 2:
				    $water_num = $v[0];
					$water_price = $v[1];
					break;
				case 3:
					$electric_num = $v[0];
					$electric_price = $v[1];
					break;
			}
		}
		$data['plan_id'] = $plan_id;
		$data['plan_no'] = $plan_no;
		$data['t_id'] = $t_id;
		$data['t_no'] = $t_no;
		$data['area_id'] = $area_id;
		$data['area_name']  =$area_name;
		$data['gas'] = $gas_num;
		$data['gas_price'] = $gas_price;
		$data['co2'] = $co2_num;
		$data['co2_price'] = $co2_price;
		$data['water'] = $water_num;
		$data['water_price'] = $water_price;
		$data['electric'] = $electric_num;
		$data['electric_price'] = $electric_price;
		$data['add_time'] = date('Y-m-d H:i:s');//这里指此条记录添加的日期
		$data['add_worker_id'] = $this->worker['worker_id'];//记录人
		$data['date_1'] = $date_1;
		$data['date_2'] = $date_2;
		
		$re = Db::name('pro_losses')->insert($data);
		if($re){
			//种植任务汇总表
			$con1['t_id'] = $t_id;
			$gas = $gas_num*$gas_price;
			$co2 = $co2_num*$co2_price;
			$water = $water_num*$water_price;
			$electric = $electric_num*$electric_price;
			$los_z =  $gas+$co2+$water+$electric;
			db('task_sum')->where($con1)->setInc('gas',$gas);  
			db('task_sum')->where($con1)->setInc('co2',$co2);  
			db('task_sum')->where($con1)->setInc('water',$water);  
			db('task_sum')->where($con1)->setInc('electric',$electric);  
			db('task_sum')->where($con1)->setInc('los_z',$los_z);  //能耗用量
			//生产计划汇总表
			$con2['plan_id'] = $plan_id;
			db('pro_sum')->where($con2)->setInc('gas',$gas);  
			db('pro_sum')->where($con2)->setInc('co2',$co2);  //
			db('pro_sum')->where($con2)->setInc('water',$water);  //
			db('pro_sum')->where($con2)->setInc('electric',$electric);  //
			db('pro_sum')->where($con2)->setInc('los_z',$los_z);  //能耗用量
			//品种汇总表
			$cat_id = Db::name('pro_sum')->where($con2)->value('cat_id');
			$con4['cat_id'] = $cat_id;
			db('mc_sum')->where($con4)->setInc('gas',$gas);  //
			db('mc_sum')->where($con4)->setInc('co2',$co2);  //
			db('mc_sum')->where($con4)->setInc('water',$water);  //
			db('mc_sum')->where($con4)->setInc('electric',$electric);  //
			db('mc_sum')->where($con4)->setInc('los_z',$los_z);  //能耗用量
			$result['status'] = 1;
			$result['msg'] = "添加成功";
			$result['grow_date'] = $grow_date; 
			ajaxReturnJson($result);
		}else{
			$result['status'] = 0;
			$result['msg'] = "添加失败";
			ajaxReturnJson($result);
		}
		
		
	}
	
	
}