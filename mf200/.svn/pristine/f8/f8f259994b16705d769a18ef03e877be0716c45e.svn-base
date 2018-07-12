<?php
namespace app\product\controller;
use app\base\controller\Base;
use think\Db;


class ProductPlan extends Base{
	
	/**
     * [get_plan_sn 获取生产计划工单编号]
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
	* [crop 作物列表]
    * @return [type] [description]
	*/
	public function crop(){
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
			return(json(array('status'=>0,'msg'=>'查询无数据')));
		}
		return(json(array('status'=>1,'msg'=>'查询成功','data'=>$arr)));
	}
	
	/**
	* [crop_child 作物品种列表]
    * @return [type] [description]
	*/

	public function crop_child(){
		if($_REQUEST['cat_id']){
			$condition['type'] = 1;
			$condition['status'] = 1;
			$condition['pid'] = $_REQUEST['cat_id'];
			$data = Db::name('materiel_category')->field(['cat_id','cat_name','cat_desc','cat_no'])->where($condition)->select();
			
			foreach($data as $k => $v){
				//获取当前catid 所有果型颜色
				$info_cat_type_where['cat_id'] = $v['cat_id'];
				$info_cat_type = Db::name('fruits_type')->field(['ft_id','ft_name'])->where($info_cat_type_where)->find();
				$info_cat_color = Db::name('fruits_color')->field(['ft_id','ft_name'])->where($info_cat_type_where)->find();
				
				$data[$k]['cat_type'] = $info_cat_type['ft_name'];
				$data[$k]['cat_color'] = $info_cat_color['ft_name'];
				
			}
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
		$con['w.group_id'] = 2;
		$worker = Db::name('worker')
				->alias('w')
				->join('role r','w.role_id = r.role_id')
				->where($con)
				->field('worker_id,worker_name')
				->select();
		if(!$worker){
			return(json(array('status'=>0,'msg'=>'查询不到数据')));	
		}
		$data = $worker;
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
			$plan_name = $this->get_plan_name();
			$cat_id = $this->request->param('cat_id');
			$grow_date = $this->request->param('grow_date');
			$estimate_get_date_1 = $this->request->param('estimate_get_date_1');//预计采收期（开始）
			$estimate_get_date_2 = $this->request->param('estimate_get_date_2');//预计采收期（结束）
			//$grow_area_1 = $this->request->param('grow_area_1');//种植面积（平米）
			$grow_area_2 = $this->request->param('grow_area_2');//种植面积（亩）
			$estimate_amount = $this->request->param('estimate_amount');//预估总产量（kg）
			$estimate_amount_one_date = $this->request->param('estimate_amount_one_date');//预估日产量（kg）
			$cost_worker = $this->request->param('cost_worker');//人工成本（元）
			$cost_materiel = $this->request->param('cost_materiel');//物料成本（元）
			$cost_amount = $this->request->param('cost_amount');//总成本（元）
			$plan_date = $this->request->param('plan_date');
			$add_time = date('Y-m-d H:i:s');//新增数据的日期
			$worker = $this->worker;
			$add_worker_id = $worker['worker_id'];
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
			if(!$estimate_amount_one_date){
				$result['status'] = 0;
				$result['msg'] = "请输入预估日产量（kg）";
				return json($result);
			}
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
			$data['plan_no'] = $plan_no;
			$data['plan_name'] = $plan_name;
			$data['cat_id'] = $cat_id;
			$data['grow_date'] = $grow_date;
			$data['estimate_get_date_1'] = $estimate_get_date_1;
			$data['estimate_get_date_2'] = $estimate_get_date_2;
			//$data['grow_area_1'] = $grow_area_1;
			$data['grow_area_2'] = $grow_area_2;
			$data['estimate_amount'] = $estimate_amount;
			$data['estimate_amount_one_date'] = $estimate_amount_one_date;
			$data['cost_worker'] = $cost_worker;
			$data['cost_materiel'] = $cost_materiel;
			$data['cost_amount'] = $cost_amount;
			$data['plan_date'] = $plan_date;
			$data['add_time'] = $add_time;
			$data['add_worker_id'] = $add_worker_id;
			$data['status'] = $status;
			$data['type']  = 1;
			$plan_id = Db::name('product_plan')->insertGetId($data);//添加生产计划
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
			
			
/*		}else{
			return $this->fetch();
		}*/
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
	public function add_p_worker($plan_id,$fzr_worker){
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
		foreach ($fzr_worker as $k=>$v){
				$info['plan_id'] = $plan_id;
				$info['worker_id'] = $v[0];
				$info['p_grow_area_2'] = $v[1];
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
		$array_info = json_decode($this->request->param('array_info'),true);
		
		//var_dump($array_info);die;
		
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
		//$con1['plan_id'] = $plan_id;
		
		$t_id = Db::name('pro_grow_task')->insertGetId($data);	//添加种植任务
		
		/* $cost = Db::name('product_plan')->field('cost_worker,cost_materiel,cost_amount')->where($con1)->find();
		if($cost){
			$data3['cost_worker'] = $cost['cost_worker']+$data2['cost_worker'];
			$data3['cost_materiel'] = $cost['cost_materiel']+$data2['cost_materiel'];
			$data3['cost_amount'] = $cost['cost_amount']+$data2['cost_amount'];
			$up_cost = Db::name('product_plan')->where($con1)->update($data3);
			if($up_cost==false){
				$result['status'] = 0;
				$result['msg'] = "生产计划成本耗费修改失败";
				ajaxReturnJson($result);
			}
		} */
		
		
		
		
		if($t_id){
			
			
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
     * [get_t_sn 获取种植任务编号接口]
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
     * [product_list_detail 获取总生产计划详情接口]
     * @return [type] [description]
     */
	public function product_list_detail(){
		
		
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
		$field[] = 'mc.cat_name cat_p_name';
		$field[] = 'ft.ft_name';
		$field[] = 'fc.ft_name fc_name';
		$field[] = 'mc1.cat_name';
		$field[] = 'mc.cat_desc';
		$field[] = 'pp.plan_no';
		$field[] = 'pp.grow_date';
		$field[] = 'pp.estimate_get_date_1';
		$field[] = 'pp.estimate_get_date_2';
		$field[] = 'pp.grow_area_2';
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
		//tioajian
		$canshu = $this->request->param('canshu');
		
		$worker_fzr = $this->request->param('worker_name');
		$cat_name = $this->request->param('cat_name');
		$catp_name = $this->request->param('catp_name');
		$grow_area_2 = $this->request->param('grow_area_2');
		$add_time = $this->request->param('add_time');
		
		
		
		
		$condition['w.worker_name'] = $worker_fzr ? array('like',"%{$worker_fzr}%") : NULL;
		$condition['mc.cat_name'] = $cat_name ? array('like',"%{$cat_name}%") : NULL;
		$condition['mc1.cat_name'] = $catp_name ? array('like',"%{$catp_name}%") : NULL;//品种
		//$condition['pp.grow_area_2'] = $grow_area_2 ? array('like',"%{$grow_area_2}%") : NULL;
		$condition['pp.add_time'] = $cat_name ? array('like',"%{$add_time}%") : NULL;
		
		
		
		foreach($condition as $k => $v){
			if(!$v){
				unset($condition[$k]);
			}
		}
	
			
		if($type){
			if($worker_id==1){
				$con['pp.type'] = $type;
				$con['pp.status'] = array('neq',-1);
			}else{
				$con['pp.type'] = $type;
				$con['pp.status'] = array('neq',-1);
				$con['pp.add_worker_id'] = $worker_id;
				
			}
		}else{
			if($worker_id==1){
				$con['pp.status'] = array('neq',-1);
			}else{
				$con['pp.status'] = array('neq',-1);
				$con['pp.add_worker_id'] = $worker_id;
			}
			
		}
		
		
		
		
		
		
		
		
		if($page==1||!$page){
			$page = 0;
		}else{
			$page = ($page-1)*$row;
		}
		$field[] = 'pp.plan_id';
		$field[] = 'pp.cat_id';
		$field[] = 'mc.cat_name cat_p_name';
		$field[] = 'ft.ft_name';
		$field[] = 'fc.ft_name fc_name';
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
			->join('mf_fruits_color fc','fc.cat_id = pp.cat_id','LEFT')
			->join('mf_fruits_type ft','ft.cat_id = pp.cat_id','LEFT')
			//->join('mf_pro_grow_task pgt','pgt.plan_id = pp.plan_id')
			->join('mf_worker w','pp.add_worker_id = w.worker_id','LEFT')
			->where($con)->where($condition)
			->count();
			
		
		$data = Db::name('product_plan pp')
			->field(implode(',',$field))
			->join('mf_materiel_category mc','mc.cat_id = pp.cat_id','LEFT')
			->join('mf_materiel_category mc1','mc1.cat_id = mc.pid','LEFT')
			->join('mf_fruits_color fc','fc.cat_id = pp.cat_id','LEFT')
			->join('mf_fruits_type ft','ft.cat_id = pp.cat_id','LEFT')
			//->join('mf_pro_grow_task pgt','pgt.plan_id = pp.plan_id')
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
	
	
	
	
	
	
	
}

