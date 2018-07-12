<?php
namespace app\product\controller;
use app\base\controller\Base;
use think\Db;


class TakeBack extends Base{
	
	/**
     * [1 tb_sn 获取生产物料领退料单的编号]
     * @return [type] [description]
     */
	public function tb_sn(){
		//获取变量
		$shijian = date('Ymd');
		$shijian1 = time($shijian);
		$sjs = $shijian1+86400;
		$sj = date('Y-m-d',$sjs);
		$con['add_time'] = array('between',array($shijian,$sj));
		$number = Db::name('pro_take_back')->count();
		
		$number++;
		//填充0，str_pad()填充字符串,str_pad_left:填充到字符串的左侧
		$numbered = str_pad($number,3,'0',STR_PAD_LEFT);
		$head = Db::name('confing_prex')->where('prex_id = 4')->value('prex_name');
		$tb_sn = $head.$shijian.$numbered;
		
		return $tb_sn;
	}
	
				/**
     * [get_plan_sn 获取insert编号]
     * @return [type] [description]
     */
	private function get_insert_sn(){
		//获取变量
		$shijian = date('Ymd');//当天时间
		$con['plan_date'] = array('eq',$shijian);
		$number = Db::name('ck_insert')->count();
		$number++;
		//填充0；str_pad()填充字符串；STR_PAD_LEFT:填充到字符串的左侧
		
		$numbered = str_pad($number,3,"0",STR_PAD_LEFT);
		 
		$plan_no = $shijian.$numbered;
		return $plan_no;
	}	
		/**
     * [get_plan_sn 获取lingliao编号]
     * @return [type] [description]
     */
	private function get_lingliao_sn(){
		//获取变量
		$shijian = date('Ymd');//当天时间
		$con['plan_date'] = array('eq',$shijian);
		$number = Db::name('ck_lingliao')->count();
		$number++;
		//填充0；str_pad()填充字符串；STR_PAD_LEFT:填充到字符串的左侧
		
		$numbered = str_pad($number,3,"0",STR_PAD_LEFT);
		 
		$plan_no = $shijian.$numbered;
		return $plan_no;
	}	
	
	
	/**
     * [2 tb_add 物料管理-领退料列表的添加]
     * @return [type] [description]
     */
	public function tb_add(){
		//获取变量
		
		$tb_no = $this->tb_sn();                                                   //领退料编号
		$t_id = $this->request->param('t_id');                                     //种植任务id
		
		$con['t_id'] = $t_id;
		$plan_id = Db::name('pro_grow_task')->where($con)->value('plan_id');       //生产计划id；
		$type = 1;                                                                 //用料类型：1.领料 2.退料
		$area_id = $this->request->param('area_id');                               //种植区域id
		
		$worker = $this->worker;
		$add_worker_id = $worker['worker_id'];                                     //申请领退料人id
		
		$use_worker_id = $this->request->param('use_worker_id');                   //用料人（页面的领料人）
		$add_time = date('Y-m-d H:i:s');                                           //领料日期
		
		$status = 1;                                                               //待审核
		
		$remarks = $this->request->param('remarks');                               //暂设为必填项
		
		//验证变量
		if(!$tb_no){
			$result['status'] = 0;
			$result['msg'] = "生产领退料的编号为空";
			ajaxReturnJson($result);
		}
		if(!$t_id){
			$result['status'] = 0;
			$result['msg'] = "种植任务id为空";
			ajaxReturnJson($result);
		}
		
		if(!$plan_id){
			$result['status'] = 0;
			$result['msg'] = "生产计划id为空";
			ajaxReturnJson($result);
		}
		
		if(!$area_id){
			$result['status'] = 0;
			$result['msg'] = "种植区域id为空";
			ajaxReturnJson($result);
		}
		if(!$add_worker_id){
			$result['status'] = 0;
			$result['msg'] = "申请领退料人id为空";
			ajaxReturnJson($result);
		}
		if(!$use_worker_id){
			$result['status'] = 0;
			$result['msg'] = "用料人id为空";
			ajaxReturnJson($result);
		}
		if(!$remarks){
			$result['status'] = 0;
			$result['msg'] = "请填写备注";
			ajaxReturnJson($result);
		}
		
		$data['tb_no'] = $tb_no;
		$data['plan_id'] = $plan_id;
		$data['type'] = $type;
		$data['t_id'] = $t_id;
		$data['area_id'] = $area_id;
		$data['add_worker_id'] = $add_worker_id;
		$data['use_worker_id'] = $use_worker_id;
		$data['add_time'] = $add_time;
		$data['status'] = $status;
		$data['remarks'] = $remarks;
		
		//程序主体
		$tb_id = Db::name('pro_take_back')->insertGetId($data);

		$p = Db::name('worker')->where('worker_id',$use_worker_id)->value('phone');
		
		if($tb_id){

			$title='物料消息提醒';
			$content='您有新的领料单';
			$phone = trim($p);
			pushMess($title,$content,$phone);

			//添加 物料名 数量 信息
			$materiel_array = json_decode($this->request->param('materiel_array'),true);
			$take_z = 0;
			foreach($materiel_array as $k=>$v){
				$data1['tb_id'] = $tb_id;
				$data1['m_id'] = $v[0];
				$data1['num'] = $v[1];
				$data1['status'] = 1;
				$re = Db::name('pro_take_back_detail')->insertGetId($data1);
				if(!$re){
					$result['status'] = 0;
					$result['msg'] = "领退料详情添加失败";
					ajaxReturnJson($result);
				}

				$con1['m_id'] = $v[0];
				$m_find = Db::name('materiel')->field('price,cat_id,m_desc,unit,m_no,m_name')->where($con1)->find();
				$m_num = $v[1];
				$m_price = $m_find['price'];
				$cat_id = $m_find['cat_id'];
				$take = $m_num*$m_price;
				$take_z += $take;
				
				//添加申请出库表
				//if(1>2){
					
				//}
				$re_check = Db::name('group')->where('group_id',4)->find();
				if($re_check && $re_check['is_buy']=='1'){
					$this->insert_materiel($cat_id,$v[0],$m_find,$m_num,$add_worker_id,$plan_id,$tb_no,$tb_id,$re);
				}
				
			}
			$con2['t_id'] = $t_id;
			$t_suminfo = Db::name('task_sum')->where($con2)->find();
			if($t_suminfo){
				$data2['mc_take'] = $t_suminfo['mc_take']+$take_z;
				$re_up = Db::name('task_sum')->where($con2)->update($data2);
			}else{
				$data2['mc_take'] = $take_z;
				$re_up = Db::name('task_sum')->insert($data2);
			}
			if($re_up !== false){
				$result['status'] = 1;
				$result['msg'] = "添加成功";
				ajaxReturnJson($result);
			}else{
				$result['status'] = 0;
				$result['msg'] = "种植任务汇总表领料成本更改失败";
				ajaxReturnJson($result);
			}
			
		}else{
			$result['status'] = 0;
			$result['msg'] = "添加失败";
			ajaxReturnJson($result);
		}
		
	}
	
	public function insert_materiel($cat_id,$cat_child_id,$m_find,$m_num,$add_worker_id,$plan_id,$tb_no,$tb_id,$tbd_detail_id){
				
		//获取category表信息  ck_id等
		$cat_info_find = Db::name('materiel_category')->field('ck_id')->where('cat_id = '.$cat_id)->find();
		if($cat_info_find){
			$ling_info['type'] = 1;
			$ling_info['lingliao_sn'] = $this->get_lingliao_sn();
			$ling_info['bianhao'] = $tb_no;
			$ling_info['cat_id'] = $cat_id;
			$ling_info['cat_child_id'] = $cat_child_id;
			$ling_info['ck_id'] = $cat_info_find['ck_id'];
			$ling_info['materiel_desc'] = $m_find['m_desc'];
			$ling_info['cat_child_name'] = $m_find['m_name'];
			$ling_info['num'] = $m_num;
			$ling_info['unit'] = $m_find['unit'];
			$ling_info['apply_worker'] = $add_worker_id;
			$ling_info['add_time'] = time();
			$ling_info['tb_id'] = $tb_id;
			$ling_info['tbd_detail_id'] = $tbd_detail_id;
			 
			$insert_re= Db::name("ck_lingliao")->insert($ling_info); 
			//$re =  Db::name("materiel")->where("m_id = ".$cat_child_id)->setDec('num',$m_num);	
		
		}
		
		return true;
				
				//结束
	}
	/**
     * [3 tb_list 物料管理——领料单（只显示登陆者为领料人的领料单）3/14]
     * @return [type] [description]
     */
	public function tb_list(){
			//获取变量
		/*$time = $this->request->param('time');
		$area_cat_name = $this->request->param('area_cat_name');*/
		$plan_id = $this->request->param('plan_id');
		$area_id = $this->request->param('area_id');
		$t_id = $this->request->param('t_id');
		$type = $this->request->param('type');
		
		if(!isset($type)){
			$result['status'] = 0;
			$result['msg'] = '无效的type值';
			ajaxReturnJson($result);
		}


		$worker = $this->worker;
		$worker_id = $worker['worker_id'];
		$role_id = $worker['role_id'];
		$worker_code = $worker['worker_code'];
		// if($time){
		// 	$s_time = $time.' 00:00:00';          //当天开始时间戳
		// 	$e_time= $time.' 23:59:59';           //当天结束时间戳  
		// 	$con['tb.add_time'] = array('between',array($s_time,$e_time));
		// }
		// $where['status'] = 1;
		// $where['worker_code'] = array('like','%'.$worker_code.'%');
		$where = "status = 1 and FIND_IN_SET($worker_id ,worker_code)";
		$info = Db::name('worker')->field('worker_id,worker_name')->where($where)->select();
		//$con['tb.use_worker_id'] = $worker_id;
		$con['tb.type'] = 1;                     //1:领料 2：退料
		if($type == 0){
			$con['tb.status'] = 1;                   //状态值:0：待审核，1：通过，2：不通过，3：完成
		}else{
			$con['tb.status'] = 3; 
		}

		if(isset($plan_id)){

			$con['tb.plan_id'] = $plan_id;
		} 
		if(isset($t_id)){

			$con['tb.t_id'] = $t_id; 
		}
		if(isset($area_id)){

			$con['tb.area_id'] = $area_id; 
		}		
		
		/*$row = 3;
		$page = $this->request->param('page');
		if($page==1||!$page){
			$page = 0;
		}else{
			$page = ($page-1)*$row;
		}*/
		$data = array();
		$i = 0; 
		foreach($info as $k=>$v){
			$con['tb.use_worker_id'] = $v['worker_id'];
			$field[] = 'tb.tb_id';                   //领料单id
			$field[] = 'tbd.tbd_id'; 				 //领料单详情id	
			$field[] = 'tb.tb_no';                   //领料单编号
			$field[] = 'ga.area_name';               //种植区域
			$field[] = 'tb.add_time';                //发布时间
			$field[] = 'tb.status'; 				 //状态值
			$field[] = 'tb.add_time';                //发布时间
			$field[] = 'tbd.num'; 
			$field[] = 'tbd.m_id'; 
			$field[] = 'm.m_no';				 
			$field[] = 'm.m_name';
			$field[] = 'm.m_desc';                 
			$field[] = 'm.unit'; 
			$field[] = 't.t_name';
			$field[] = 'w.worker_name as add_worker_name';  
			$field[] = 'tbd.take_time';			 
			/*if($area_cat_name){
				$con1['ga.area_name'] = array('like','%'.$area_cat_name.'%');
				$con2['m.m_name'] = array('like','%'.$area_cat_name.'%');
				$in = Db::name('pro_take_back tb')
					->field(implode(',',$field))
					->join('mf_grow_area ga','ga.area_id = tb.area_id')
					->join('mf_pro_take_back_detail tbd','tbd.tb_id = tb.tb_id')
					->join('mf_materiel m','m.m_id = tbd.m_id')
					->where($con)->where($con1)->whereOr($con2)
					->group('tb.tb_id')
					->order('tb.add_time desc')
					->select();
			}else{
				$in = Db::name('pro_take_back tb')
				->field(implode(',',$field))
				->join('mf_grow_area ga','ga.area_id = tb.area_id')
				->join('mf_pro_take_back_detail tbd','tbd.tb_id = tb.tb_id')
				->join('mf_materiel m','m.m_id = tbd.m_id')
				->where($con)
				->order('tb.add_time desc')
				->select();
			}*/
			/*foreach($in as $k1=>$v1){
				$array_info = Db::name('pro_take_back_detail tbd')
						->join('mf_materiel m','m.m_id = tbd.m_id')
						->field('tbd.tbd_id,tbd.num,m.m_name,m.m_desc,m.unit')
						->where('tbd.tb_id',$v1['tb_id'])
						->select();
				$in[$k1]['son'] = $array_info;
			}*/
			$in = Db::name('pro_take_back tb')
				->field(implode(',',$field))
				->join('mf_pro_grow_task t','t.t_id = tb.t_id')
				->join('mf_grow_area ga','ga.area_id = tb.area_id')
				->join('mf_pro_take_back_detail tbd','tbd.tb_id = tb.tb_id')
				->join('mf_materiel m','m.m_id = tbd.m_id')
				->join('mf_worker w','w.worker_id = tb.add_worker_id')
				->where($con)
				->order('tb.add_time desc')
				->select();
			if($in){
				
				foreach($in as $k1=>$v1){

					$in[$k1]['m_name'] = $v1['m_no'].$v1['m_name'];
				}

				$data[$i]['worker_id'] = $v['worker_id'];
				$data[$i]['worker_name'] = $v['worker_name'];
				$data[$i]['t_name'] = $in[0]['t_name'];

				$data[$i]['materiel'] = $in;
				$i++;
			}
		}
/*		$count = 0;
		foreach($data as $k=>$v){
			$count += 1;
		}
		$arr = array();
		for($j=0;$j<$row;$j++){
			if(isset($data[$page+$j])){
				$arr[] = $data[$page+$j];
			}
		}*/
		$result['status'] = 1;
		if($data){
			$result['msg'] = "获取成功";
		}else{
			$result['msg'] = "查询无数据";
		}
		//$result['count'] = $count;
		$result['data'] = $data;
		ajaxReturnJson($result);
	}
	
	
	
	
	
	/**
     * [4 tb_back_list 物料列表——生产退料（列表——只显示登陆者所有完成的领料信息）]
     * @return [type] [description]
     */
	public function tb_back_list(){
		//获取变量
		/*$time = $this->request->param('time');
		$area_cat_name = $this->request->param('area_cat_name');*/
		$plan_id = $this->request->param('plan_id');
		$area_id = $this->request->param('area_id');
		$t_id = $this->request->param('t_id');
		//$type = $this->request->param('type');
		
		$worker = $this->worker;
		$worker_id = $worker['worker_id'];
		$role_id = $worker['role_id'];
		$worker_code = $worker['worker_code'];
/*		if($time){
			$s_time = $time.' 00:00:00';          //当天开始时间戳
			$e_time= $time.' 23:59:59';           //当天结束时间戳  
			$con['tb.add_time'] = array('between',array($s_time,$e_time));
		}
		$where['status'] = 1;
		$where['worker_code'] = array('like','%'.$worker_code.'%');*/
		$where = "status = 1 and FIND_IN_SET($worker_id ,worker_code)";
		$info = Db::name('worker')->field('worker_id,worker_name')->where($where)->select();
		//$con['tb.use_worker_id'] = $worker_id;
		$con['tb.type'] = 1;                     //1:领料 2：退料
		$con['tb.status'] = 3; 

		if(isset($plan_id)){

			$con['tb.plan_id'] = $plan_id;
		} 
		if(isset($t_id)){

			$con['tb.t_id'] = $t_id; 
		}
		if(isset($area_id)){

			$con['tb.area_id'] = $area_id; 
		}
/*		$row = 3;
		$page = $this->request->param('page');
		if($page==1||!$page){
			$page = 0;
		}else{
			$page = ($page-1)*$row;
		}*/
		$data = array();
		$i = 0; 
		foreach($info as $k=>$v){
			$con['tb.use_worker_id'] = $v['worker_id'];
			$field[] = 'tb.tb_id';                   //领料单id
			$field[] = 'tb.tb_no';                   //领料单编号                 
			$field[] = 'ga.area_name';               //种植区域
			$field[] = 'tb.add_time';                //发布时间
			$field[] = 'tbd.num'; 				 //状态值
			$field[] = 'tbd.tbd_id'; 
			$field[] = 'tbd.b_id';  			
			$field[] = 'm.m_id';
			$field[] = 'm.m_no';
			$field[] = 'm.m_name';
			$field[] = 'm.m_desc';
			$field[] = 'm.unit';
			$field[] = 't.t_name';
			$field[] = 'w.worker_name as add_worker_name';
			/*if($area_cat_name){
				$con1['ga.area_name'] = array('like','%'.$area_cat_name.'%');
				$con2['m.m_name'] = array('like','%'.$area_cat_name.'%');
				$in = Db::name('pro_take_back tb')
					->field(implode(',',$field))
					->join('mf_grow_area ga','ga.area_id = tb.area_id')
					->join('mf_pro_take_back_detail tbd','tbd.tb_id = tb.tb_id')
					->join('mf_materiel m','m.m_id = tbd.m_id')
					->where($con)->where($con1)->whereOr($con2)
					//->group('tb.tb_id')
					->order('tb.add_time desc')
					->select();
			}else{
				$in = Db::name('pro_take_back tb')
				->field(implode(',',$field))
				->join('mf_grow_area ga','ga.area_id = tb.area_id')
				->join('mf_pro_take_back_detail tbd','tbd.tb_id = tb.tb_id')
				->join('mf_materiel m','m.m_id = tbd.m_id')
				->where($con)
				->order('tb.add_time desc')
				->select();
			}*/
			/*foreach($in as $k1=>$v1){
				$array_info = Db::name('pro_take_back_detail tbd')
						->join('mf_materiel m','m.m_id = tbd.m_id')
						->field('tbd.tbd_id,tbd.num,m.m_name,m.m_desc,m.unit')
						->where('tbd.tb_id',$v1['tb_id'])
						->select();
				$in[$k1]['son'] = $array_info;
			}*/
			$in = Db::name('pro_take_back tb')
				->field(implode(',',$field))
				->join('mf_pro_grow_task t','t.t_id = tb.t_id')
				->join('mf_grow_area ga','ga.area_id = tb.area_id')
				->join('mf_pro_take_back_detail tbd','tbd.tb_id = tb.tb_id')
				->join('mf_materiel m','m.m_id = tbd.m_id')
				->join('mf_worker w','w.worker_id = tb.add_worker_id')
				->where($con)
				->order('tb.add_time desc')
				->select();
			if($in){
				foreach($in as $k1=>$v1){
					$con1['tbd_id'] = array('in',$v1['b_id']);
					$num = Db::name('pro_take_back_detail')->where($con1)->sum('num');
					$in[$k1]['re_num'] = $num;
					$in[$k1]['m_name'] = $v1['m_no'].$v1['m_name'];
				}
				$data[$i]['worker_id'] = $v['worker_id'];
				$data[$i]['worker_name'] = $v['worker_name'];
				$data[$i]['t_name'] = $in[0]['t_name'];
				$data[$i]['materiel'] = $in;
				$i++;
			}
		}
		/*$count = 0;
		foreach($data as $k=>$v){
			$count += 1;
		}
		$arr = array();
		for($j=0;$j<$row;$j++){
			if(isset($data[$page+$j])){
				$arr[] = $data[$page+$j];
			}
		}*/
		$result['status'] = 1;
		if($data){
			$result['msg'] = "获取成功";
		}else{
			$result['msg'] = "查询无数据";
		}
		//$result['count'] = $count;
		$result['data'] = $data;
		ajaxReturnJson($result);
	}
	
	/**
     * [5 tb_back_addshow 物料列表——生产退料——退还物料（界面显示）]
     * @return [type] [description]
     */
	public function tb_back_addshow(){
		//获取变量
		$tbd_id = $this->request->param('tbd_id');
		$tb_id = $this->request->param('tb_id');
		$m_id = $this->request->param('m_id');
		
		//验证变量
		if(!$tbd_id){
			$result['status'] = 0;
			$result['msg'] = "领料详情单id为空";
			ajaxReturnJson($result);
		}
		if(!$tb_id){
			$result['status'] = 0;
			$result['msg'] = "领料单id为空";
			ajaxReturnJson($result);
		}
		if(!$m_id){
			$result['status'] = 0;
			$result['msg'] = "物料id为空";
			ajaxReturnJson($result);
		}
		
		//程序主体
		$con['tbd.tbd_id']  =$tbd_id;
		$con1['tb.tb_id'] = $tb_id;
		
		$info = Db::name('pro_take_back_detail tbd')
			  ->field('tbd.tbd_id,mc.cat_name,tbd.num,m.unit')
			  ->join('mf_materiel m','m.m_id = tbd.m_id')
			  ->join('mf_materiel_category mc','mc.cat_id = m.cat_id')
			  ->where($con)
			  ->find();
			  
		$b_id = Db::name('pro_take_back tb')->where($con1)->value('tb.b_id');
        	  
		if(empty($b_id)){
			$b_num = 0;
		}else{
			$con2['tb_id'] = $b_id;
			$con2['m_id'] = $m_id;
			$b_num = db('pro_take_back_detail')->where($con2)->sum('num');
			
		}	
			   
		$info['b_num'] = $b_num;
		if($info){
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $info;
			ajaxReturnJson($result);
		}else{
			$result['status'] = 0;
			$result['msg'] = "查询无数据";
			$result['data'] = '';
			ajaxReturnJson($result);
		}
		
	}
	
	/**
     * [6 b_add 物料管理-生产退料-退还物料（执行添加退还数量）]
     * @return [type] [description]
     */
	public function b_add(){
		//获取变量
		$tb_no = $this->tb_sn();                                                     //退料编号
		$type = 2;		                                                           //用料类型：1.领料 2.退料
		$tbd_id = $this->request->param('tbd_id');                                 //领料单详情id
		$status = 1;                                                               //状态值:0：待审核，1：通过，2：不通过，3：完成
		$tb_id = $this->request->param('tb_id');                                   //领退料id;
		$remarks = $this->request->param('remarks');
		$m_id = $this->request->param('m_id');
		$num = $this->request->param('num');
		
		//验证变量
		if(!$tbd_id){
			$result['status'] = 0;
			$result['msg'] = "领料单详情id为空";
			ajaxReturnJson($result);
		}
		if(!$tb_id){
			$result['status'] = 0;
			$result['msg'] = "领退料id为空";
			ajaxReturnJson($result);
		}
		if(!$m_id){
			$result['status'] = 0;
			$result['msg'] = "物料id为空";
			ajaxReturnJson($result);
		}
		if(!$num){
			$result['status'] = 0;
			$result['msg'] = "请输入退还数量";
			ajaxReturnJson($result);
		}
		//程序主体
		$con['tbd.tbd_id'] = $tbd_id;
		
		$field[] = 'tb.plan_id';            //生产计划id
		$field[] = 'tb.add_worker_id';      //申请领退料人id
		$field[] = 'tb.t_id';               //种植任务id为空
		$field[] = 'tb.area_id';            //种植区域id
		$field[] = 'tb.use_worker_id';     //使用者id
	 
		
		
		
		$info = Db::name('pro_take_back_detail tbd')
			  ->field(implode(',',$field))
			  ->join('mf_pro_take_back tb','tb.tb_id = tbd.tb_id')
			  ->where($con)
			  ->find();
			  
		if($info){//退料中不需要审批人和审批时间
			$data['tb_no'] = $tb_no;
			$data['plan_id'] = $info['plan_id'];
			$data['type'] = $type;
			$data['t_id'] = $info['t_id'];
			$data['area_id'] = $info['area_id'];
			$data['add_worker_id'] = $info['add_worker_id'];
			$data['use_worker_id'] = $info['use_worker_id'];
			$data['status'] = $status;
			$data['remarks'] = $remarks;
			$data['add_time'] = date('Y-m-d H:i:s',time());
			$new_tb_id = Db::name('pro_take_back')->insertGetId($data);
			if($new_tb_id){
				$bid = Db::name('pro_take_back')->where('tb_id',$tb_id)->value('b_id');
				if($bid != 0){
					$data1['b_id'] = $bid.','.$new_tb_id;
				}else{
					$data1['b_id'] = $new_tb_id;
				}
				$con3['tb_id'] = $tb_id;
				$re = Db::name('pro_take_back')->where($con3)->update($data1);
				if($re==false){
					$result['status'] = 0;
					$result['msg'] = "更改失败";
					ajaxReturnJson($result);
				}
				$data2['tb_id'] = $new_tb_id;
				$data2['m_id'] = $m_id;
				$data2['num'] = $num;
				$data2['status'] = 1;
				$re1 = Db::name('pro_take_back_detail')->insertGetId($data2);
				if($re1){

					//插入仓库表
					//if(1>2){
						//$this->insert_tui_materiel($m_id,$num,$info['add_worker_id'],$tb_no,$info['plan_id']);
					//}
					$bid1 =  Db::name('pro_take_back_detail')->where('tbd_id',$tbd_id)->value('b_id');
					if($bid1 != 0){
						$b_id1 = $bid1.','.$re1;
					}else{
						$b_id1 = $re1;
					}
					Db::name('pro_take_back_detail')->where('tbd_id',$tbd_id)->setField('b_id',$b_id1);
					//种植任务汇总表
					$con4['m_id'] = $m_id;
					$price = Db::name('materiel')->where($con4)->value('price');
					$back_z = $price*$num;
					
					$con2['tb_id'] = $tb_id;
					$t_id = Db::name('pro_take_back')->where($con2)->value('t_id');
					$con5['t_id'] = $t_id;
					db('task_sum')->where($con5)->setInc('mc_back',$back_z); 
					$m_take = Db::name('task_sum') ->where($con5)->value('mc_take');
					$m_z = $m_take-$back_z;
					db('task_sum')->where($con5)->setDec('m_z',$m_z);
				    //生产计划汇总表
					$plan_id = Db::name('pro_take_back')->where($con3)->value('plan_id');
					$con6['plan_id'] = $plan_id;
					db('pro_sum')->where($con6)->setDec('m_z',$m_z); 
					//品种汇总表
					$cat_id = Db::name('pro_sum')->where($con6)->value('cat_id');
					$con7['cat_id'] = $cat_id;
					db('mc_sum')->where($con7)->setDec('m_z',$m_z); 
					
		
					
					$result['status']  =1;
					$result['msg'] = "退料成功";
					ajaxReturnJson($result);
				}else{
					$result['status']  = 0;
					$result['msg'] = "退料失败";
					ajaxReturnJson($result);
				}
			}
		}
	}
 
	/**
     * [7 tb_ok_one 物料管理——领料单——确认领料（按钮）]
     * @return [type] [description]
     */
	public function tb_ok_one(){
		//获取变量
		$tb_id = $this->request->param('tb_id');
		$tbd_id = $this->request->param('tbd_id');
		//验证变量
		if(!$tb_id){
			$result['status'] = 0;
			$result['msg'] =  "领退料id为空";
			ajaxReturnJson($result);
		}
		if(!$tbd_id){
			$result['status'] = 0;
			$result['msg'] =  "领退料详情id为空";
			ajaxReturnJson($result);
		}
		//程序主题
		$con['tb_id'] = $tb_id; 
		$con['tbd_id'] = $tbd_id;
		$data['status'] = 3;
		$data['take_time'] = date('Y-m-d H:i:s',time());
		$up_tbd = Db::name('pro_take_back_detail')->where($con)->update($data);
		if($up_tbd){
			$info = Db::name('pro_take_back_detail')->where('tb_id',$tb_id)->column('status');
			$i = 0;
			foreach($info as $k=>$v){
				if($v == 3){
					$i = 1;
				}else{
					$i = 0;
					break;
				}
			}
			if($i == 1){
				$up_tb = Db::name('pro_take_back')->where('tb_id',$tb_id)->update($data);
			}
			$add_worker_id = Db::name('pro_take_back')->where('tb_id',$tb_id)->value('add_worker_id');
			$p = Db::name('worker')->where('worker_id',$add_worker_id)->value('phone');
			
	 
			// 判断是否买仓库			
			$re_check = Db::name('group')->where('group_id',4)->find();
			if($re_check && $re_check['is_buy']=='1'){
				$re_info =  Db::name("ck_lingliao")->where("tbd_detail_id =".$tbd_id)->update(array('ready_status'=>1));
			}
			
			$title='物料消息提醒';
			$content='有已完成的领料任务';
			$phone = trim($p);
			pushMess($title,$content,$phone);

			$result['status'] = 1;
			$result['msg'] = "领料成功";
			ajaxReturnJson($result); 
		}else{
			$result['status'] = 0;
			$result['msg'] = "领料失败";
			ajaxReturnJson($result); 
		}
/*		$up_tb = Db::name('pro_take_back')->where($con)->update($data); 
		if($up_tb){
			$up_tbd = Db::name('pro_take_back_detail')->where($con)->update($data);
			$infos = Db::name('pro_take_back_detail')->where($con)->select();
			$take_z = 0;
			foreach($infos as $k=>$v){
				$num = $infos[$k]['num'];
				$m_id = $infos[$k]['m_id'];
				$con2['m_id'] = $m_id;
				$price = Db::name('materiel')->where($con2)->value('price');
				$take_z += $num*$price;
			}
			$t_id = Db::name('pro_take_back')->where($con)->value('t_id');
			$con3['t_id'] = $t_id;
			//种植任务汇总表
			db('task_sum')->where($con3)->setInc('mc_take',$take_z);  //领料成本
			db('task_sum')->where($con3)->setInc('m_z',$take_z);  //物料总成本第一次变更
			//生产计划汇总表
			$plan_id = Db::name('pro_take_back')->where($con)->value('plan_id');//这个生产计划id在生产计划汇总表里没有（因为这个表是后建的，所以有些数据会没有）
			$con4['plan_id'] = $plan_id;
			db('pro_sum')->where($con4)->setInc('m_z',$take_z);  //物料总成本第一次变更
			
			//品种汇总表
			$cat_id = Db::name('pro_sum')->where($con4)->value('cat_id');
			$con5['cat_id'] = $cat_id;
			db('mc_sum')->where($con4)->setInc('m_z',$take_z);  //物料总成本第一次变更
			
			
			$result['status'] = 1;
			$result['msg'] = "领料成功";
			ajaxReturnJson($result); 
		}
			$result['status'] = 0;
			$result['msg'] = "领料失败";
			ajaxReturnJson($result); */
	}
	
	
	
	
	
	/**
     * [tb_edit 生管物料领退料表的修改]
     * @return [type] [description]
     */
	
	public function tb_edit(){
		$do = $this->request->param('do');
		if($do){
			$tb_id = $this->request->param('tb_id');
			if(!$tb_id){
				$result['status'] = 0;
				$result['msg'] = "领退料的id为空";
				ajaxReturnJson($result);
			}
			
			
			$data['plan_id'] = $this->request->param('plan_id');
			$data['type'] = $this->request->param('type');
			$data['t_id'] = $this->request->param('t_id');
			$data['area_id'] = $this->request->param('area_id');
			$data['use_worker_id'] = $this->request->param('use_worker_id');
			$data['status'] = 0;
			$data['remarks'] = $this->request->param('remarks');
			//验证变量
			if(!$data['plan_id']){
				$result['status'] = 0;
				$result['msg'] = "生产计划的id为空";
				ajaxReturnJson($result);
			}
			if(!$data['type']){
				$result['status'] = 0;
				$result['msg'] = "请选择用料类型";
				ajaxReturnJson($result);
			}
			if(!$data['t_id']){
				$result['status'] = 0;
				$result['msg'] = "种植任务id为空";
				ajaxReturnJson($result);
			}
			if(!$data['area_id']){
				$result['status'] = 0;
				$result['msg'] = "种植区域id为空";
				ajaxReturnJson($result);
			}
			if(!$data['use_worker_id']){
				$result['status'] = 0;
				$result['msg'] = "使用者id为空";
				ajaxReturnJson($result);
			}
			
			if(!$data['remarks']){
				$result['status'] = 0;
				$result['msg'] = "请输入原因";
				ajaxReturnJson($result);
			}
			
			
			
			
			$con['tb_id'] = $tb_id;
			
			$up = Db::name('pro_take_back')->where($con)->update($data);
			
			$upson = $this->tbd_edit($tb_id);
			
			if($upson){
				$result['status'] = 1;
				$result['msg'] = "修改成功";
				return json($result);
			}else{
				$result['status'] = 0;
				$result['msg'] = "修改失败";
				return json($result);
			}
				
				
		}else{//页面
			$this->tb_edit_ndo();
		}
			
		
	}
	
	/**
     * [tbd_edit 生管物料领退料详情的修改]
     * @return [type] [description]
     */
	public function tbd_edit($tb_id){
		$m_id = $this->request->param('m_id');
		$num = $this->request->param('num');
		$status = 0;
		if(!$m_id){
			$result['status'] = 0;
			$result['msg'] = "物料id为空";
			ajaxReturnJson($result);
		}
		if(!$num){
			$result['status'] = 0;
			$result['msg'] = "请填写要申请的数量";
			ajaxReturnJson($result);
		}
		if(!is_array($m_id)){
			$m_id = explode(',',$m_id);
		}
		if(!is_array($num)){
			$num = explode(',',$num);
		}
		
		$con['tb_id'] = $tb_id;
		$infos = Db::name('pro_take_back_detail')->where($con)->select();
		//dump($infos);die;
		if($infos){
			foreach($infos as $k=>$info){
				$newinfos = array();
				if(empty($m_id[$k])){
					$re = Db::name('pro_take_back_detail')->where(array('tbd_id'=>$info['tbd_id']))->delete();
				}else if(count($m_id)==count($infos)){
					$newinfos['num'] = $num[$k];
					$newinfos['m_id'] = $m_id[$k];
					
					$re = Db::name('pro_take_back_detail')->where(array('tbd_id'=>$info['tbd_id']))->update($newinfos);
				}
			}
			
			if(count($m_id)>count($infos)){
				$k++;
				$newinfo2 = array();
				$newinfo2['tb_id'] = $tb_id;
				$newinfo2['m_id'] = $m_id[$k];
				$newinfo2['num'] = $num[$k];
				$newinfo2['status'] = $status;
				$re = Db::name('pro_take_back_detail')->insert($newinfo2);
			}
		}else{
			//原有数据没有的情况，直接执行添加
			foreach ($m_id as $k=>$m_id){
				$data['m_id'] = $m_id[$k];
				$data['num'] = $num[$k];
				$data['status'] = 0;
				$data['tb_id'] = $tb_id;
				
				$re = Db::name('pro_take_back_detail')->insert($data);
			}
			
			
		}
		if($re!==false){
			return true;
		}else{
			return false;
		}
		
		
	}
	
	
	/**
     * [tb_edit_ndo 获取生管物料领退料修改页面]
     * @return [type] [description]
     */
	public function tb_edit_ndo(){
		//获取变量
		$tb_id = $this->request->param('tb_id');
		//验证变量
		if(!$tb_id){
			$result['status'] = 0;
			$result['msg'] = "领退料id为空";
			ajaxReturnJson($result);
		}
		//程序主体
		$con['tb_id'] = $tb_id;
		$find = Db::name('pro_take_back')->where($con)->find();
		
		if($find){
			foreach($find as $k=>$v){
				if(!$v){
					$find[$k] = '';
				}
				if($find['status']==0){
					$find['status'] = 0;
				}
			}
			
			$infos = $this->tbd_edit_ndo($tb_id,1);
			if($infos){
				$find['son'] = $infos;
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
     * [tbd_edit_ndo 获取生产领退料详情的修改页]
     * @return [type] [description]
     */
	public function tbd_edit_ndo($tb_id,$a=0){
		//获取变量
		$tbd_id = $this->request->param('tbd_id');
		
		$con['tb_id'] = $tb_id;
		if($tbd_id){
			$con['tbd_id'] = $tbd_id;
		}
		$aa = $tbd_id ?'find':'select';
		
		$field[] = 'tbd.tbd_id';
		$field[] = 'tbd.m_id';
		$field[] = 'm.m_name';
		$field[] = 'tbd.m_id';
		$field[] = 'tbd.tb_id';
		$field[] = 'tbd.num';
		$field[] = 'tbd.status';
		
		$infos = Db::name('pro_take_back_detail tbd')
			->field(implode(',',$field))
			->join('materiel m','m.m_id = tbd.m_id')
			->where($con)
			->$aa();
			
		
		if($a){
			return $infos;
		}
		
		if($infos){
			$result['status'] = 1;
			$result['msg'] = '获取成功';
			$result['data'] = $infos;
		}else{
			$result['status'] = 0;
			$result['msg'] = '获取失败';
			$result['data'] = '';
		}
		ajaxReturnJson($result);
	}
	
	/**
     * [tb_del 删除生产领退料]
     * @return [type] [description]
     */
	public function tb_del(){
		$tb_id = $this->request->param('tb_id');
		$tbd_id = $this->request->param('tbd_id');

		if(!$tb_id){
			$result['status'] = 0;
			$result['msg'] = "领退料编号为空";
			ajaxReturnJson($result);
		}
		if(!$tbd_id){
			$result['status'] = 0;
			$result['msg'] = "请勾选领料单";
			ajaxReturnJson($result);
		}
		$con['tb_id'] = $tb_id;

		$con['tbd_id'] = array('in',$tbd_id);

		$find = Db::name('pro_take_back_detail')->where($con)->column('status');

		foreach($find as $k=>$v){
			if($v == 3){
				$result['status'] = 0;
				$result['msg'] = "存在已领料单不能删除";
				ajaxReturnJson($result);
			}
		}



		$del = Db::name('pro_take_back_detail')->where($con)->delete();
		
		if($del){

			$detail = Db::name('pro_take_back_detail')->where('tb_id',$tb_id)->find();

			if(!$detail){

				$del = Db::name('pro_take_back')->where('tb_id',$tb_id)->delete();
			}

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
     * [tb_process 添加生产领退料的审批流]
     * @return [type] [description]
     */
	public function tb_process(){
		//获取变量
		$tb_id = $this->request->param('tb_id');
		$reason = $this->request->param('reason');
		$add_time = date('Y-m-d h:i:s');
		//yanzheng
		if(!$tb_id){
			$result['status'] = 0;
			$result['msg'] = "领退料的id为空";
			ajaxReturnJson($result);
		}
		if(!$reason){
			$result['status'] = 0;
			$result['msg'] = "请输入原因";
			ajaxReturnJson($result);
		}
		//zhuti
		$con['tb_id'] = $tb_id;
		$data['tb_id'] = $tb_id;
		$data['reason'] = $reason;
		$data['add_time'] = $add_time;
		$re = Db::name('pro_take_back_process')->insert($data);
		if($re){
			$fbr = Db::name('pro_take_back')->where($con)->value('add_worker_id');
			$con1['worker_id'] = $fbr;
			$check_worker_id = Db::name('worker')->where($con1)->value('pid');
			if($check_worker_id==0){
				$check_worker_id = 1;
			}
			$data1['check_worker_id'] = $check_worker_id;
			$data1['check_time'] = $add_time;
			$up = Db::name('pro_take_back')->where($con)->update($data1);
			if($up==false){
				$result['status'] = 0;
				$result['msg'] = "更改失败";
				ajaxReturnJson($result);
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
	
	public function takeback_option()
	{
		db('product_plan');
	}

	/**
	 * [tb_list description]
	 * @return [type] [description]
	 */
	public function takeback_list()
	{		
		switch($this->worker['group_id']){
			case 1:
				$this->takeback_list_boss();
				break;
			default:
				$this->takeback_list_user();
		}		
	}
	/**
	 * [takeback_list_boss 老板领料列表]
	 * @return [type] [description]
	 */
	public function takeback_list_boss()
	{
		$plan_id = $this->request->param('plan_id');		
		$t_id = $this->request->param('t_id');
		$area_id = $this->request->param('area_id');
		
		$condition = '';
		if($plan_id){
			$condition .= " and tb.plan_id = {$plan_id}";
		}

		if($t_id){			
			$condition .= " and tb.t_id = {$t_id}";
		}

		if($area_id){			
			$condition .= " and tb.area_id = {$area_id}";
		}

		$status = $this->request->param('status');
		$status = $status ? $status : 1;

		$fields[] = 't.t_name';
		$fields[] = 'a.area_name';
		$fields[] = 'tb.add_worker_id';
		$fields[] = 'w.worker_name as add_name';
		$fields[] = 'ww.worker_name as use_name';
		$fields[] = 'tb.add_time';
		$fields[] = 'tb.tb_id';
		$list = db('pro_take_back')->alias('tb')
				->join('mf_pro_grow_task t','t.t_id = tb.t_id')
				->join('mf_grow_area a','a.area_id = tb.area_id')
				->join('mf_worker w','w.worker_id = tb.add_worker_id','left')
				->join('mf_worker ww','ww.worker_id = tb.use_worker_id','left')
				->where("tb.status = {$status} {$condition}")
				->field(join(',',$fields))
				->order('tb.tb_id desc')
				->select();
				
		if($list){
			$re['status'] = 1;
			$re['data'] = $list;
		}else{
			$re['status'] = 1;
			$re['data'] = array();
		}

		ajaxReturnJson($re);
	}
	/**
	 * [takeback_list_user 一般用户领料列表]
	 * @return [type] [description]
	 */
	public function takeback_list_user()
	{
		$plan_id = $this->request->param('plan_id');		
		$t_id = $this->request->param('t_id');
		$area_id = $this->request->param('area_id');		
		$condition = '';
		if($plan_id){
			//$condition .= " and tb.plan_id = {$plan_id}";
		}

		if($t_id){			
			//$condition .= " and tb.t_id = {$t_id}";
		}

		if($area_id){			
			//$condition .= " and tb.area_id = {$area_id}";
		}

		$status = $this->request->param('status');
		$status = $status ? $status : 1;

		$fields[] = 't.t_name';
		$fields[] = 'a.area_name';
		$fields[] = 'tb.add_worker_id';
		$fields[] = 'w.worker_name as add_name';
		$fields[] = 'ww.worker_name as use_name';
		$fields[] = 'tb.add_time';
		$fields[] = 'tb.tb_id';
		$list = db('pro_take_back')->alias('tb')
				->join('mf_pro_grow_task t','t.t_id = tb.t_id')
				->join('mf_grow_area a','a.area_id = tb.area_id')
				->join('mf_worker w','w.worker_id = tb.add_worker_id','left')
				->join('mf_worker ww','ww.worker_id = tb.use_worker_id','left')				
				->where("tb.add_worker_id = {$this->worker['worker_id']} and tb.status = {$status} {$condition}")
				->whereor("tb.use_worker_id = {$this->worker['worker_id']} and tb.status = {$status} {$condition}")
				->field(join(',',$fields))
				->order('tb.tb_id desc')
				->select();
				
		if($list){
			$re['status'] = 1;
			$re['data'] = $list;
		}else{
			$re['status'] = 1;
			$re['data'] = array();
		}

		ajaxReturnJson($re);
	}
	/**
	 * [takeback_detail description]
	 * @return [type] [description]
	 */
	public function takeback_detail()
	{
		$tb_id = $this->request->param('tb_id');
		if(!$tb_id)
		{
			$re['status'] = 0;
			$re['data'] = '';
			$re['msg'] = '缺少参数tb_id';
			ajaxReturnJson($re);
		}

		/*$fields[] = 't.t_name';
		$fields[] = 'a.area_name';
		$fields[] = 'w.worker_name as add_name';
		$fields[] = 'ww.worker_name as use_name';
		$fields[] = 'tb.add_time';
		$fields[] = 'tb.tb_id';

		$add_worker_id = db('pro_take_back')->alias('tb')
				//->join('mf_pro_grow_task t','t.t_id = tb.t_id')
				//->join('mf_grow_area a','a.area_id = tb.area_id')
				//->join('mf_worker w','w.worker_id = tb.add_worker_id','left')
				//->join('mf_worker ww','ww.worker_id = tb.use_worker_id','left')
				->where(['tb.tb_id'=>$tb_id])
				//->field(join(',',$fields))
				->value('tb.add_worker_id');*/

		$fields = [];
		$fields[] = 'td.tbd_id';		
		$fields[] = 'mc.cat_name';
		$fields[] = 'm.m_name';
		$fields[] = 'm.m_no';
		$fields[] = 'm.m_desc';
		$fields[] = 'td.num';
		$fields[] = 'td.b_num';
		$fields[] = 'm.unit';
		$fields[] = 'td.take_time';			
		$fields[] = 'td.status';
		$fields[] = 'tb.add_worker_id';
		$fields[] = 'tb.use_worker_id';

		$list = db('pro_take_back_detail')->alias('td')
				->join('pro_take_back tb','tb.tb_id = td.tb_id')
				->join('materiel m','m.m_id = td.m_id')
				->join('materiel_category mc','mc.cat_id = m.cat_id')
				->where(['td.tb_id'=>$tb_id])
				->field(join(',',$fields))
				->order('td.tbd_id asc')
				->select();	

		if($list){
			
			// 判断是否买仓库			
			$re_check = Db::name('group')->where('group_id',4)->find();
			if($re_check && $re_check['is_buy']=='1'){
				$ling_status = '1';
			}else{
				$ling_status = '2';
			}
			foreach($list as $k => $row){
				if($row['take_time']=='0000-00-00 00:00:00'){
					$list[$k]['take_time'] = '';
				}
				$list[$k]['m_name'] = $row['m_no'].$row['m_name'];
				//判断仓库是否 出库
				if($ling_status=='1'){
					$check_matr =  Db::name("ck_lingliao")->where('tbd_detail_id = '.$row['tbd_id'])->field('status,is_checked')->find();
					
					//echo  Db::name("ck_lingliao")->getLastSql();die;
					$list[$k]['materiel_check'] = $check_matr['is_checked']?$check_matr['is_checked']:0;
					$list[$k]['materiel_status'] = $check_matr['status']?$check_matr['status']:0;
					$list[$k]['ling_status'] = $ling_status;
				}
				//$count = Db::name("ck_lingliao")->where('tb_id = '.$tb_id)->field('is_checked')->find();
				
			}			
			$re['status'] = 1;
			$re['data'] = $list;
			
		}else{
			$re['status'] = 1;
			$re['data'] = array();
		}

		ajaxReturnJson($re);			
	}
	/*
	根据退料id  去 insert表查询退料数组
	*/
	public function tb_insert_info(){
		$tbd_id = $this->request->param('tbd_id');
		$check_matr =  Db::name("ck_insert")->where('tbd_id = '.$tbd_id)->field('num,add_time,is_checked as materiel_check, status as materiel_status')->select();
		foreach($check_matr as $k=>$v){
			$check_matr[$k]['add_time'] = date('Y-m-d H:i:s',$v['add_time']);
		}
		if($check_matr){

			$re['status'] = 1;
			$re['data'] = $check_matr;
		}else{
			$re['status'] = 0;
			$re['data'] = array();
		}
		ajaxReturnJson($re);			
	}
	/**
	 * [do_back 退料接口]
	 * @return [type] [description]
	 */
	public function do_back()
	{
		$tb_id = $this->request->param('tb_id');
		$num = $this->request->param('num');
		$result= [];
		if(!$tb_id)
		{
			$result['status'] = 0;
			$result['data'] = '';
			$result['msg'] = '缺少参数tb_id';
			ajaxReturnJson($result);
		}

		if(!$num)
		{
			$result['status'] = 0;
			$result['data'] = '';
			$result['msg'] = '缺少参数num';
			ajaxReturnJson($result);
		}

		$info = db('pro_take_back_detail')				
				->where(['tb_id'=>$tb_id])				
				->field('num,b_num,m_id')
				->find();

		$b_num = $info['b_num'];
		$t_num = $info['num'];

		if($b_num + $num > $t_num){
			$result['status'] = 0;
			$result['data'] = '';
			$result['msg'] = '退还数量已超出领取数量';
			ajaxReturnJson($result);	
		}


		
		
			$con['tbd.tb_id'] = $tb_id;
			$field[] = 'tb.tb_id';                   //领料单id
			$field[] = 'tbd.tbd_id'; 				 //领料单详情id	
			$field[] = 'tb.tb_no';                   //领料单编号
 
			$field[] = 'tbd.num'; 
			$field[] = 'tbd.m_id'; 
			$field[] = 'm.m_no';				 
			$field[] = 'm.m_name';
			$field[] = 'm.m_desc';                 
			$field[] = 'm.unit'; 
			$field[] = 't.t_name';
			$field[] = 'cat.cat_id';
			$field[] = 'plan.plan_id';
 	 
 
			$in = Db::name('pro_take_back tb')
				->field(implode(',',$field))
				->join('mf_pro_grow_task t','t.t_id = tb.t_id')
				->join('mf_product_plan plan','plan.plan_id = tb.plan_id')
				->join('mf_pro_take_back_detail tbd','tbd.tb_id = tb.tb_id')
				->join('mf_materiel m','m.m_id = tbd.m_id')
				->join('mf_materiel_category cat','cat.cat_id = plan.cat_id')
				->where($con)
				->order('tb.add_time desc')
				->find();
		
		$m_find['m_desc'] = $in['m_desc'];
		$m_find['m_name'] = $in['m_name'];
		$m_find['unit'] = $in['unit'];
		$worker = $this->worker;
		$add_worker_id = $worker['worker_id'];   
		$re_check = Db::name('group')->where('group_id',4)->find();
		
		
		
		
		
		if($re_check && $re_check['is_buy']=='1'){
			$this->insert_tui_materiel($in['cat_id'],$in['m_id'],$m_find,$num,$add_worker_id,$in['plan_id'],$in['tb_no'],$tb_id,$in['tbd_id']);
			
			//退料列表 查询退料详情
			//$insert_re= Db::name("ck_insert")->where('tb_id = '.$tb_id)->find();
			
			
		}else{
			$res = db('pro_take_back_detail')				
				->where(['tb_id'=>$tb_id])				
				->setInc('b_num',$num);	
		}
		
		
		/*if($res === false){
			$result['status'] = 0;
			$result['data'] = '';
			$result['msg'] = '更新退还数量失败';
			ajaxReturnJson($result);	
		}*/

		$result['status'] = 1;
		$result['data'] = '';
		$result['msg'] = '退料成功';
		ajaxReturnJson($result);
		// 插入退料记录
	}
	public function insert_tui_materiel($cat_id,$cat_child_id,$m_find,$m_num,$add_worker_id,$plan_id,$tb_no,$tb_id,$tbd_id){
				
		//获取category表信息  ck_id等
		$cat_info_find = Db::name('materiel_category')->field('ck_id')->where('cat_id = '.$cat_id)->find();
		if($cat_info_find){
			$ling_info['type'] = 14;
			$ling_info['insert_sn'] = $plan_id;
			$ling_info['bianhao'] = $tb_no;
			$ling_info['cat_id'] = $cat_id;
			$ling_info['cat_child_id'] = $cat_child_id;
			$ling_info['ck_id'] = $cat_info_find['ck_id'];
			$ling_info['materiel_desc'] = $m_find['m_desc'];
			$ling_info['cat_child_name'] = $m_find['m_name'];
			$ling_info['num'] = $m_num;
			$ling_info['unit'] = $m_find['unit'];
			$ling_info['apply_worker'] = $add_worker_id;
			$ling_info['add_time'] = time();
			$ling_info['tb_id'] =$tb_id;
			$ling_info['tbd_id'] =$tbd_id;
			
			$insert_re= Db::name("ck_insert")->insert($ling_info); 
			
			
			//$re =  Db::name("materiel")->where("m_id = ".$cat_child_id)->setInc('num',$m_num);	
		
		}
		
		return true;
				
				//结束
	}
}