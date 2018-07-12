<?php

namespace app\depot\controller;
use app\base\controller\Base;
use think\Db;
class Deprot extends Base{
	
	/**
	 * [stock_num 库存列表]
	 * @return [type] [description]
	 */
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
	
	/*
	判断所属仓库
	*/
	public function get_mat_check($add_worker_id){
		
		$people_info =  Db::name('ck_manage')->field('charge_people,ck_id')->select();
		
		
	 
		$ck_array = array();
		foreach($people_info as $k=>$v){
			$new_array = array();
			$new_str = '';
			if($v['charge_people']){
				$new_array = explode(',',$v['charge_people']);
				if($new_array){
					if(in_array($add_worker_id,$new_array)){
						array_push($ck_array,$v['ck_id']);
					}
				}
			}
		}
		if($ck_array){
			$info = implode(',',$ck_array);
		}else{
			$info = '';
		}
		
		return $info;
		
		
	}
	
 
	
	
    public function stock_num(){

		//获取条件变量
		$row = 3;
		$page = $this->request->param('page');
		$keywords = $this->request->param('keywords');
		$search_type = $this->request->param('search_type');
		$cat_id = $this->request->param('cat_id');
		$type = $this->request->param('type');
	
		$worker = $this->worker;
		$add_worker_id = $worker['worker_id'];
 

	 
		if($page==1||!$page){
			$page = 0;
		}else{
			$page = ($page-1)*$row;
		}
		$condition = 'crop.status = 1 ';
		
		
		$str = $this->get_mat_check($add_worker_id);
		
		/************************************************************************************************/
		/*
		if($str){
			$condition .= "  and ckm.ck_id  in (".$str.")";
		}
		*/
		
    	if($cat_id){
			$condition .= ' and m.cat_id = '.$cat_id;
    	}

    	if($keywords){

			$condition .= ' and '.$search_type.' like '."'%".$keywords."%'";
		}
		if($type=='2'){
			$condition .= ' and  m.warning_num >= m.num ';
		}
		
		
	 
		$count = Db::name('materiel')->alias('m')
		->field('m.m_id as materiel_id,m.m_name as materiel_name,m.m_no as materiel_no,m.m_desc as size_name,m.m_desc as materiel_desc,m.num,m.unit,m.warning_num,crop.cat_id,crop.cat_name as cat_name')
		->join('materiel_category crop','crop.cat_id = m.cat_id','LEFT')
		//->join('materiel c','c.cat_id = crop.cat_id','LEFT')
		//->join('ck_size size','size.size_id = m.size_id','LEFT')
		//->join('ck_caigou cg','cg.materiel_id = m.materiel_id','LEFT')
		->join('ck_manage ckm','ckm.ck_id = crop.ck_id','LEFT')                                       
		 ->where($condition)
		 ->count();
		 
		 
		 //echo Db::name('materiel')->getLastSql();die;
		$materiel_list = Db::name('materiel')->alias('m')
		->field('m.m_id as materiel_id,m.m_name as materiel_name,m.m_no as materiel_no,m.m_desc as size_name,m.m_desc as materiel_desc,m.num,m.unit,m.warning_num,crop.cat_id,crop.cat_name as cat_name')
		->join('materiel_category crop','crop.cat_id = m.cat_id','LEFT')
		//->join('materiel c','c.cat_id = crop.cat_id','LEFT')
		//->join('ck_size size','size.size_id = m.size_id','LEFT')
		//->join('ck_caigou cg','cg.materiel_id = m.materiel_id','LEFT')
		->join('ck_manage ckm','ckm.ck_id = crop.ck_id','LEFT')                                       
		 ->where($condition)
		 ->limit($page,$row)
		 ->select();
		
		//echo  Db::name('materiel')->getLastSql();die;
	 
		if($materiel_list && !empty($materiel_list)){
			//获取采购中，待采购的数据
			foreach($materiel_list as $k => $row){
				$con_1['is_stored'] = 0;
				$con_1['is_checked_1'] = 1;
				$con_1['is_checked_2'] = 1;
				$con_1['is_checked_3'] = 1;
				$con_1['is_checked_4'] = 1;
				
				$con_1['bpd.materiel_id'] = $row['materiel_id'];
				$fields_start[] = 'buy_num';
		
				$num_start = Db::name('buy_plan_detail')->alias('bpd')
				->join('buy_plan bp','bp.plan_id = bpd.plan_id','LEFT')
				->where($con_1)
				->field(join(',',$fields_start))
				->find();
				
				if($num_start && !empty($num_start)){
					$materiel_list[$k]['buy_num_start'] = $num_start['buy_num'];
				}else{
					$materiel_list[$k]['buy_num_start'] =0;
				}
			
				$con_2['is_checked_1'] = array('eq',0);
				$con_2['is_checked_2'] = array('eq',0);
				$con_2['is_checked_3'] = array('eq',0);
				$con_2['is_checked_4'] = array('eq',0);
	
				$con_2['is_stored'] = 0;
				$con_2['bpd.materiel_id'] = $row['materiel_id'];
			 
			 
				//$where['is_stored'] = array('eq',0);
				
				$num_end = Db::name('buy_plan_detail')->alias('bpd')
				->join('buy_plan bp','bp.plan_id = bpd.plan_id','LEFT')
				->where($con_2)
				->field(join(',',$fields_start))
				->find();
				if($num_end && !empty($num_end)){
					$materiel_list[$k]['buy_num_end'] = $num_end['buy_num'];
				}else{
					$materiel_list[$k]['buy_num_end'] =0;
				}	 
				//echo $materiel_list[$k]['buy_num_2'];exit;
				if(!$row['size_name']){
					$materiel_list[$k]['size_name'] = $row['materiel_desc'] ? $row['materiel_desc']:'';
				}
				//修改采购数量
				$cai_where['materiel_id'] = $row['materiel_id'];
				$cai_info = Db::name('ck_caigou')
				->where($cai_where)
				->sum('request_num');
				if($cai_info){
					$materiel_list[$k]['request_num'] = $cai_info;
				}else{
					$materiel_list[$k]['request_num'] = 0;
				}

				
			}
		} 
		$field_end[] = 'cat_id';
		$field_end[] = 'cat_name';
 
		$get_materiel_cat = Db::name('materiel_category')->where(' status = 1 ')->field(implode(',',$field_end))->select();
		$info['get_materiel_cat'] = $get_materiel_cat;
		$info['materiel_list'] = $materiel_list;
		return json([
			'status' => 1,
			'msg'    => "获取成功",
			'data'   => $info,
			'count'=>$count
		]);
		exit;
  
    }
	
 
 
	/**
	 * [get_materiel_cat 获取仓库物料分类]
	 * @return [type] [description]
	 */
	function get_materiel_cat(){
		return Db::name('materiel_category')->select();
	}
	
    /**
     * [save_stock_num 修改预警数量]
     * @return [type] [description]
     */
    public function save_stock_num(){
 
		
		$condition['m_id'] = $this->request->param('id');
		$num = $this->request->param('num');
		if(!$condition['m_id']){
			return json([
				'status' => 0,
				'msg'    => "参数错误",
 
			]);
			exit;
		}
		if(!$num){
			return json([
				'status' => 0,
				'msg'    => "参数错误",
 
			]);
			exit;
		}
		
    	$re =  Db::name('materiel')->where($condition)->update(array('warning_num'=>$num));
    	if($re !== false){
    		return json([
				'status' => 1,
				'msg'    => "修改成功",
 
			]);
			exit;
    	}else{
    	 
    		return json([
				'status' => 0,
				'msg'    => "修改失败",
 
			]);
			exit;
    	}
    }
    /**
     *将物料加入采购申请表  以及预申请列表修改
     */
    public function add_caigou(){
		$worker = $this->worker;
		$add_worker_id = $worker['worker_id'];
        $ma_id = $this->request->param('materiel_id');
        $request_num = $this->request->param('request_num');
        $cai= Db::name("ck_caigou");
        $find=$cai->where("materiel_id=".$ma_id)->find();
		
		
		
       /* if($find){
			$re =  $cai->where("materiel_id=".$ma_id)->update(array('request_num'=>$_POST['request_num']));
            //$re=$cai->where("materiel_id=".$ma_id)->setInc('request_num',$_POST['request_num']);
			if($re){
				$this->ajaxReturn(array('status'=>1,'info'=>'已经加入到采购购物车'));
			}else{
				$this->ajaxReturn(array('status'=>0,'info'=>'加入到采购购物车失败'));
		}*/
        //}else{
			$insert_info['materiel_id'] = $ma_id;
			$insert_info['worker_id'] = $add_worker_id;
			$insert_info['request_num'] = $request_num;
			$insert_info['add_time'] = time();
            $re=$cai->insert($insert_info); 
			if($re){
				return json([
				'status' => 1,
				'msg'    => "添加成功",

			]);
			exit;
			}else{
				return json([
				'status' => 0,
				'msg'    => "加入失败",
 
			]);
			exit;
			}
       // }
        
       
    }
	/**
     *预申请列表修改
     */
    public function save_caigou(){
		 
        $cg_id = $this->request->param('cg_id');
        $num = $this->request->param('num');
        $cai= Db::name("ck_caigou");
        $find=$cai->where("cg_id=".$cg_id)->find();
		if($find){
			$re = $cai->where('cg_id = '.$cg_id)->update(array('request_num'=>$num));
			if($re){
			return json([
				'status' => 1,
				'msg'    => "修改成功",

			]);
			exit;
			}else{
			return json([
				'status' => 0,
				'msg'    => "修改成功",

			]);
			exit;
			}
		}else{
		 
					return json([
				'status' => 0,
				'msg'    => "修改成功",

			]);
			exit;
	 
		}
		
		
		
       /* if($find){
			$re =  $cai->where("materiel_id=".$ma_id)->update(array('request_num'=>$_POST['request_num']));
            //$re=$cai->where("materiel_id=".$ma_id)->setInc('request_num',$_POST['request_num']);
			if($re){
				$this->ajaxReturn(array('status'=>1,'info'=>'已经加入到采购购物车'));
			}else{
				$this->ajaxReturn(array('status'=>0,'info'=>'加入到采购购物车失败'));
		}*/
        //}else{
			$insert_info['materiel_id'] = $ma_id;
			$insert_info['worker_id'] = $add_worker_id;
			$insert_info['request_num'] = $_POST['request_num'];
			$insert_info['add_time'] = time();
            $re=$cai->insert($insert_info); 
			if($re){
			return json([
				'status' => 1,
				'msg'    => "已加入数据",
				'data'   => $data,
				'count'=>$count
			]);
			exit;
		
			}else{
				return json([
				'status' => 0,
				'msg'    => "添加失败",
				'data'   => $data,
				'count'=>$count
			]);
			exit;
			}
       // }
        
       
    }
    /**
     * [kc_applycg 申请列表]
     * @return [type] [description]
     */

    public function kc_applycg(){
		$pc_from = $this->request->param('pc_from');
		if($pc_from){
			
			//获取条件变量
			$row = 3;
			$page = $this->request->param('page');

			$data = array();
		 
			if($page==1||!$page){
				$page = 0;
			}else{
				$page = ($page-1)*$row;
			}
			
			$keywords = $this->request->param('keywords');
			$cat_id = $this->request->param('cat_id');
			$start_time = $this->request->param('start_time');
			$end_time = $this->request->param('end_time');
			
			$start_time =  strtotime($start_time);
			$end_time =  strtotime($end_time);
			
			$condition = ' materiel_category.status = 1 and cg.status = 1 ';
			if(is_numeric($cat_id)){
				$condition .= ' and materiel.cat_id = '.$cat_id;
			}
			if($cat_id=='果蔬'){
				$condition .= ' and materiel.type = 1';
			}
			if($start_time){
				$condition .= ' and cg.add_time >'.$start_time;
			}
			if($end_time){
				$condition .= ' and cg.add_time <'.$end_time;
			}
			if($keywords){

				$condition .= ' and materiel.m_name like '."'%".$keywords."%'";
			}
			$cg= Db::name("ck_caigou");
 
			$data=$cg->alias('cg')
				->join('materiel ','cg.materiel_id = materiel.m_id','LEFT')
				//->join('ck_size ','ck_materiel.size_id= ck_size.size_id','LEFT')
				->join('materiel_category','materiel_category.cat_id= materiel.cat_id','LEFT')
				
				->join('ck_manage ','ck_manage.ck_id = materiel_category.ck_id','LEFT')
				//cg_id 采购id  request_num 采购数量 type 类型 materiel_name 物料名  num 数量  unit 单位 warning_num 预警 materiel_id  物料id  size_name规格
				->field("cg.cg_id,
					cg.request_num,
					cg.add_time,
					materiel.m_desc as materiel_desc,
					materiel.m_no as materiel_no,
					materiel.cat_id,
					materiel.type,
					materiel.m_name as materiel_name,
					materiel.num,
					materiel.unit,
					materiel.warning_num,
					materiel.m_id as materiel_id,
					materiel_category.cat_name
				,cg.come")
				->where($condition)
				->order('cg.add_time desc')
				->paginate(20);
					
			/*
			$data = $data->toArray();
			
			foreach($data['data'] as $k=>$v){
				$data['data'][$k]['size'] = $v['materiel_desc'];
				$data['data'][$k]['add_time'] =date('Y-m-d',$v['add_time']);
	 
				if($v['type']=='0'){
					$data['data'][$k]['cat_child_name'] = $v['materiel_name'];
				}else{
					 
					$data['data'][$k]['cat_child_name'] = $v['cat_name'];
					
				}
				
			}*/
	 
			$page = $data->render();
			$list = $data->items();
			$jsonStr = json_encode($data);
			$info = json_decode($jsonStr,true);
			$pages = $info['last_page'];
			
			foreach($list as $k=>$v){
				$list[$k]['new_time'] =date('Y-m-d',$v['add_time']);
			}
			
			
			$page_list = array();
			$page_list['page'] = $page;
			$page_list['pages'] = $pages;
			$page_list['list'] = $list;
			
			
			$field_end[] = 'cat_id';
			$field_end[] = 'cat_name';
			$con['type'] = 0;
			$con['status'] = 1;
			$get_materiel_cat = Db::name('materiel_category')->where($con)->field(implode(',',$field_end))->select();
			$info['get_materiel_cat'] = $get_materiel_cat;
			$info['data'] = $data;
			$info['page_list'] = $page_list;
			return json([
				'status' => 1,
				'msg'    => "获取成功",
				'data'   => $info,
			]);
			exit;
			
			
			
		}else{
			
			//获取条件变量
			$row = 3;
			$page = $this->request->param('page');

			$data = array();
		 
			if($page==1||!$page){
				$page = 0;
			}else{
				$page = ($page-1)*$row;
			}
			
			$keywords = $this->request->param('keywords');
			$cat_id = $this->request->param('cat_id');
			$start_time = $this->request->param('start_time');
			$end_time = $this->request->param('end_time');
			
			$start_time =  strtotime($start_time);
			$end_time =  strtotime($end_time);
			
			$condition = ' materiel_category.status = 1 and cg.status = 1 ';
			if($cat_id){
				$condition .= ' and materiel.cat_id = '.$cat_id;
			}
			if($start_time){
				$condition .= ' and cg.add_time >'.$start_time;
			}
			if($end_time){
				$condition .= ' and cg.add_time <'.$end_time;
			}
			if($keywords){

				$condition .= ' and materiel.m_name like '."'%".$keywords."%'";
			}
			
			/*
			if($_GET['keywords']){
				$condition['ck.materiel_name'] = array('like',"%{$_GET['keywords']}%");
			}
			if($_GET['cat_id']){
				$condition['ck.cat_id'] = array('eq',$_GET['cat_id']);
			}  */
		 
			$cg= Db::name("ck_caigou");
			$count = $cg->alias('cg')
				->join('materiel ','cg.materiel_id = materiel.m_id','LEFT')
				//->join('ck_size ','ck_materiel.size_id= ck_size.size_id','LEFT')
				->join('materiel_category','materiel_category.cat_id= materiel.cat_id','LEFT')
				
				->join('ck_manage ','ck_manage.ck_id = materiel_category.ck_id','LEFT')
				//cg_id 采购id  request_num 采购数量 type 类型 materiel_name 物料名  num 数量  unit 单位 warning_num 预警 materiel_id  物料id  size_name规格
				->field("cg.cg_id,
					cg.request_num,
					materiel.m_desc as materiel_desc,
					materiel.m_no as materiel_no,
					materiel.cat_id,
					materiel.type,
					materiel.m_name as materiel_name,
					materiel.num,
					materiel.unit,
					materiel.warning_num,
					materiel.m_id as materiel_id,
					materiel_category.cat_name
				,cg.come")
				->where($condition)
			 
				->count();
			//echo Db::name("ck_caigou")->getLastSql();die;
			$data=$cg->alias('cg')
				->join('materiel ','cg.materiel_id = materiel.m_id','LEFT')
				//->join('ck_size ','ck_materiel.size_id= ck_size.size_id','LEFT')
				->join('materiel_category','materiel_category.cat_id= materiel.cat_id','LEFT')
				
				->join('ck_manage ','ck_manage.ck_id = materiel_category.ck_id','LEFT')
				//cg_id 采购id  request_num 采购数量 type 类型 materiel_name 物料名  num 数量  unit 单位 warning_num 预警 materiel_id  物料id  size_name规格
				->field("cg.cg_id,
					cg.request_num,
					cg.add_time,
					materiel.m_desc as materiel_desc,
					materiel.m_no as materiel_no,
					materiel.cat_id,
					materiel.type,
					materiel.m_name as materiel_name,
					materiel.num,
					materiel.unit,
					materiel.warning_num,
					materiel.m_id as materiel_id,
					materiel_category.cat_name
				,cg.come")
				->where($condition)
				->order('cg.add_time desc')
				->limit($page,$row)
				->select();
	 
			//获取分类信息 根据类型查询下面所属
			foreach($data as $k=>$v){
				$data[$k]['size'] = $v['materiel_desc'];
				$data[$k]['add_time'] =date('Y-m-d',$v['add_time']);
	 
				if($v['type']=='0'){
					$data[$k]['cat_child_name'] = $v['materiel_name'];
				}else{
					 
					$data[$k]['cat_child_name'] = $v['cat_name'];
					
				}
				
			}
			$field_end[] = 'cat_id';
			$field_end[] = 'cat_name';
			$get_materiel_cat = Db::name('materiel_category')->where(' status = 1 ')->field(implode(',',$field_end))->select();
			$info['get_materiel_cat'] = $get_materiel_cat;
			$info['data'] = $data;
			return json([
				'status' => 1,
				'msg'    => "获取成功",
				'data'   => $info,
				'count'=>$count
			]);
			exit;

		}

    }
	/*审批入库*/
	public function check_materiel(){
		$worker = $this->worker;
		$add_worker_id = $worker['worker_id'];
		$info_str = $this->request->param('info_str');
		$info_str = explode(',',$info_str);
		$cg= Db::name("ck_caigou");
		
		//setInc('字段名','数值','字段名','数值');
		foreach($info_str as $val){
 
					$re = $cg->where('cg_id = '.$val)->update(array('status'=>2));
					
					$cai_info = $cg->where('cg_id = '.$val)->field('materiel_id,request_num')->find();
			 
					if($cai_info){
						$materiel_info = Db::name("materiel")->where('m_id = '.$cai_info['materiel_id'])->find();
						 
					 
						if($materiel_info){
							$ck_info =  Db::name("materiel_category")->where('cat_id = '.$materiel_info['cat_id'])->find();
							if($ck_info){
								$info['ck_id'] = $ck_info['ck_id'];
							}
							 
							$info['type'] = 16;
							$info['num'] = $cai_info['request_num'];
							$info['cat_id'] = $materiel_info['cat_id'];
							$info['cat_child_id'] = $materiel_info['m_id'];
							
							$info['plan_id'] = $materiel_info['m_no'];
							$info['materiel_desc'] = $materiel_info['m_desc'];
							$info['cat_child_name'] = $materiel_info['m_name'];
							$info['apply_worker'] = $add_worker_id;
							$info['add_time'] =  time();
							$re_info= Db::name("ck_insert")->insert($info); 
					 
						}

						 
					}
					
	 
		}
		return json([
			'status' => 1,
			'msg'    => "提交成功",
 
		]);
		exit;
		
		
	}
	/*
	获取物料   出库
	*/
	public function other_cat_lingliao(){
		
		$return_info = array();
		$return_info = Db::name("materiel")->where('status = 1 ')->field('m_name as cat_child_name,m_id as cat_child_id,m_no as materiel_no,m_desc as materiel_desc,num,unit,cat_id')->select();
		foreach($return_info as $k=>$v){
			$cate_info = Db::name("materiel_category")->where('cat_id = '.$v['cat_id'])->field('ck_id')->find();
			if($cate_info){
				$return_info[$k]['ck_id'] = $cate_info['ck_id'];
			}
		}
		
		return json([
			'status' => 1,
			'msg'    => "获取成功",
			'data'   => $return_info,
		]);
		exit;
	}
	/*
	获取物料   入库
	*/
	public function pcother_cat_lingliao(){
		
		$cat_id = $this->request->param('cat_id');
		if($cat_id){
			$return_info = array();
			$return_info = Db::name("materiel")->where('status = 1  and cat_id = '.$cat_id)->field('m_name as cat_child_name,m_id as cat_child_id,m_no as materiel_no,m_desc as materiel_desc,num,unit,cat_id')->select();

		}else{
			$return_info = array();
			$return_info = Db::name("materiel")->where('status = 1 ')->field('m_name as cat_child_name,m_id as cat_child_id,m_no as materiel_no,m_desc as materiel_desc,num,unit,cat_id')->select();

		}
		foreach($return_info as $k=>$v){
			$cate_info = Db::name("materiel_category")->where('cat_id = '.$v['cat_id'])->field('ck_id')->find();
			if($cate_info){
				$return_info[$k]['ck_id'] = $cate_info['ck_id'];
			}
		}
		return json([
			'status' => 1,
			'msg'    => "获取成功",
			'data'   => $return_info,
		]);
		exit;
	}
	/*
	获取分类   入库
	*/
	public function other_cat(){

		$return_info = Db::name("materiel_category")->where('status = 1 and pid = 0 ')->field('cat_name,cat_id,ck_id')->select();
	
		return json([
			'status' => 1,
			'msg'    => "获取成功",
			'data'   => $return_info,
		]);
		exit;
	}
	/*获取分类详情*/
		public function other_cat_detail(){
		$cat_id = $this->request->param('cat_id');
		if(!$cat_id){
			echo "参数错误！";die;
		}
		$info = array();

		$return_info = Db::name("materiel_category")->where('status = 1  and pid = '.$cat_id)->field('type,cat_name,ck_id,cat_id,cat_no,cat_desc')->select();
		foreach($return_info as $k=>$v){
			if($v['type']=='1'){
				$info[$k]['unit'] = 'KG';
			}
			if($v['type']=='2'){
				$info[$k]['unit'] = '株';
			}
			if($v['type']=='3'){
				$info[$k]['unit'] = 'KG';
			}
			if($v['type']=='3'){
				$info[$k]['unit'] = '粒';
			}
			$info[$k]['cat_child_name'] = $v['cat_name'];
			$info[$k]['cat_child_id'] = $v['cat_id'];
			$info[$k]['materiel_no'] = $v['cat_no'];
			$info[$k]['materiel_desc'] = $v['cat_desc'];
		}
	
		return json([
			'status' => 1,
			'msg'    => "获取成功",
			'data'   => $info,
		]);
		exit;
	}
	/*其他入虚库 进入到insert待审核*/
	public function other_insert(){
	  $data['type'] = $this->request->param('type');	//入库类型
 
	  $data['back_num'] = $this->request->param('back_num')?$this->request->param('back_num'):0;	//退还数量
	  $data['reject_num'] = $this->request->param('reject_num')?$this->request->param('reject_num'):0;	//报废数量
	  $data['num'] = $this->request->param('num');	//入库数量
	  $data['cat_id'] = $this->request->param('cat_id'); //类别id
	  $data['cat_child_id'] = $this->request->param('cat_child_id'); //作物id
	  $data['ck_id'] = $this->request->param('ck_id');	//仓库id
	  $data['plan_id'] = $this->request->param('materiel_no');	//编号
	  $data['materiel_desc'] = $this->request->param('materiel_desc');//规格
	  $data['unit'] = $this->request->param('unit');//单位
	  $data['cat_child_name'] = $this->request->param('cat_child_name'); //作物名（物料名）
	  $worker = $this->worker;
	  $data['apply_worker'] = $worker['worker_id'];
	  $data['add_time'] = time();
	  
	  $come_from  = $this->request->param('come_from')?$this->request->param('come_from'):'1';//入库类型
 
	   if($come_from =='1'){
		   
		  $re= Db::name("ck_insert")->insert($data); 
		  if($re){
			  return json([
				'status' => 1,
				'msg'    => "添加成功",
				]);
			exit;  
		  }else{
		 
		  return json([
				'status' => 0,
				'msg'    => "添加失败",
				]);
			exit;   
		  }
	   }else{
		   
		   //来源为2的是作物分类
		   	$cate_info =   Db::name("materiel_category")->where(' cat_id = '.$data['cat_child_id'])->field('type,ck_id,cat_no,cat_name,cat_desc,type')->find();
			if($cate_info){
				//根据规则 名字+规格 查找库存表是否有此物料
				$name = $cate_info['cat_name'].$cate_info['cat_no'];
				$re =  Db::name("materiel")->where("m_name = '".$name."'")->find();
				if($re){
				 
					$ling_two_new['type'] = $data['type'];
					$ling_two_new['insert_sn'] = $this->get_insert_sn();
					$ling_two_new['cat_id'] = $re['cat_id'];
					$ling_two_new['cat_child_id'] = $re['m_id'];
					$ling_two_new['ck_id'] = $cate_info['ck_id'];
					$ling_two_new['materiel_desc'] = $re['m_desc'];
					$ling_two_new['cat_child_name'] = $re['m_name'];
					$ling_two_new['num'] = $data['num'];
					$ling_two_new['unit'] = $re['unit'];
					$ling_two_new['apply_worker'] = $worker['worker_id'];
					$insert_re= Db::name("ck_insert")->insert($ling_two_new); 
					if($insert_re){
						return json([
							'status' => 1,
							'msg'    => "添加成功",
						]);
						exit;  
					}
				}else{
		 
					$ling_two['m_no'] = $cate_info['cat_no'].'_1';
					$ling_two['cat_id'] = $data['cat_child_id'];
					$ling_two['m_name'] = $cate_info['cat_name'].$cate_info['cat_desc'];
					$ling_two['m_desc'] =$cate_info['cat_desc'];
					$ling_two['num'] = $data['num'];
					$ling_two['unit'] = $data['unit'];
					$ling_two['warning_num'] = 0;
					$ling_two['status'] = 1;
					$ling_two['type'] = $cate_info['type'];
					
					$materiel_id = Db::name('materiel')->insertGetId($ling_two);//添加物料表
					$ling_two_new['type'] =  $data['type'];
					$ling_two_new['insert_sn'] =$this->get_insert_sn();
					$ling_two_new['cat_id'] = $data['cat_child_id'];
					$ling_two_new['cat_child_id'] = $materiel_id;
					$ling_two_new['ck_id'] = $cate_info['ck_id'];
					$ling_two_new['materiel_desc'] = $cate_info['cat_desc'];
					$ling_two_new['cat_child_name'] = $cate_info['cat_name'].$cate_info['cat_desc'];
					$ling_two_new['num'] = $data['num'];
					$ling_two_new['unit'] =  $data['unit'];
					$ling_two_new['apply_worker'] = $worker['worker_id'];
		 
					
					$insert_re= Db::name("ck_insert")->insert($ling_two_new); 
					if($materiel_id && $insert_re){
						return json([
						'status' => 1,
						'msg'    => "添加成功",
						]);
						exit;  
					}
					
	
					
				}
				
			}
			
				
 

	   }
 
 
	}
	
	/*库管 入库列表*/
	public function ck_insertlist(){
		
 
		$row = 10;
		$page = $this->request->param('page');
		$materiel_info = array();

		if($page==1||!$page){
			$page = 0;
		}else{
			$page = ($page-1)*$row;
		}
		
		$type = $this->request->param('type');	//入库类型
		$status = $this->request->param('status')?$this->request->param('status'):'1';	//入库类型
		$keywords = $this->request->param('keywords');	//物料关键词
		$start_time = substr($this->request->param('start_time'),0,10);	//开始时间
		$end_time =  substr($this->request->param('end_time'),0,10);	//结束时间
		if($type){
			$condition = ' type = '.$type.' and is_show = 1 ';
		}else{
			$condition = ' is_show = 1 ';
		}
		
		//status 0 待审核 1 通过 2 不通过  is_checked 0 待审核  1审核
		if($status=='1'){
			$condition.=' and status = 0 and is_checked = 0 ';
		}
		if($status=='2'){
			$condition.=' and status = 2 and is_checked = 0 ';
		}
		if($status=='3'){
			$condition.=' and status = 1 and is_checked = 0 ';
		}
		if($status=='4'){
			$condition.=' and status = 1 and is_checked = 1 ';
		}
 
 
 
		
		if($keywords){
			$condition .= ' and cat_child_name '.' like '."'%".$keywords."%'";
		}
		if($start_time){
			$condition .= ' and add_time > '.$start_time;
		}
		if($end_time){
			$condition .= ' and add_time < '.$end_time;
		}
		
		$worker = $this->worker;
		$add_worker_id = $worker['worker_id'];
		$str = $this->get_mat_check($add_worker_id);
		
		/****************************************************************************************************/
		
		/*if($str){
			$condition .= "  and ck_id  in (".$str.")";
		}*/
		
		$count = Db::name("ck_insert")->where($condition)->count();
		
		$materiel_info = Db::name("ck_insert")->where($condition)->field('insert_id,reply,status,type,insert_id,add_time,apply_worker,cat_id,cat_child_name as cat_child_id,materiel_desc,plan_id,unit,num')->order('add_time desc')->limit($page,$row)->select();
		
		//echo  Db::name("ck_insert")->getLastSql();die;
		
		foreach($materiel_info as $k=>$v){
			$materiel_info[$k]['add_time'] = date('Y-m-d H:i:s',$v['add_time']);
					
			//获取提交人信息
			$worker_info = Db::name("worker")->where('worker_id = '.$v['apply_worker'])->field('worker_name')->find();
			$materiel_info[$k]['apply_worker'] = $worker_info['worker_name']?$worker_info['worker_name']:'';
			$worker_cat_info = Db::name("materiel_category")->where('cat_id = '.$v['cat_id'])->field('cat_name,ck_id,type,pid')->find();
 		
			if($worker_cat_info['pid']){
				$cat_name = Db::name("materiel_category")->where('cat_id = '.$worker_cat_info['pid'])->value('cat_name'); 
				$materiel_info[$k]['cat_id'] = $cat_name.$worker_cat_info['cat_name'];
			}else{
				$materiel_info[$k]['cat_id'] = $worker_cat_info['cat_name'];
			}
 		
			if($v['type'] == 19){
				$materiel_info[$k]['batch_no'] = Db::name("ck_insert_detail")->where('io_id',$v['insert_id'])->value('batch_no');
			}
			//根据cat_id判断是物料还是其他
			/*
			$worker_cat_info = Db::name("materiel_category")->where('cat_id = '.$v['cat_id'])->field('cat_name,ck_id,type')->find();
			if($worker_cat_info){
				if($worker_cat_info['type']=='0'){
					$worker_mate_info = Db::name("materiel")->where('m_id = '.$v['cat_child_id'])->field('m_name,m_no')->find();
					$materiel_info[$k]['cat_child_id'] = $worker_mate_info['m_name']?$worker_mate_info['m_name']:'';
					$materiel_info[$k]['m_no'] = $worker_mate_info['m_no']?$worker_mate_info['m_no']:'';
				}else{
					$worker_mate_info = Db::name("materiel_category")->where('cat_id = '.$v['cat_id'])->field('cat_name,cat_no')->find();
					$materiel_info[$k]['cat_child_id'] = $worker_mate_info['cat_name']?$worker_mate_info['cat_name']:'';
					$materiel_info[$k]['m_no'] = $worker_mate_info['cat_no']?$worker_mate_info['cat_no']:'';
				}
				$materiel_info[$k]['cat_name'] = $worker_cat_info['cat_name'];
				
			}*/
	
			
		}
	 
		
		return json([
			'status' => 1,
			'msg'    => "获取成功",
			'data'   => $materiel_info,
			'count'=>$count
		]);
		exit;
		
	}
	/*主管审核 入库*/
	public function ck_insert(){
		$insert_id = $this->request->param('insert_id');	//insert_id
		$type = $this->request->param('type');	
		$reply = $this->request->param('reply')?$this->request->param('reply'):'';	//insert_id
		
		if($type=='1'){
			$insert_info =  Db::name("ck_insert")->where('insert_id = '.$insert_id)->field('cat_child_name,cat_child_id,insert_id,num,type')->find();
			if($insert_info){
				$re_info =  Db::name("ck_insert")->where("insert_id=".$insert_id)->update(array('status'=>1));
				if($re_info){
					if($insert_info['type'] == 19){
						Db::name("ck_insert_detail")->where('io_id',$insert_id)->setField('status',2);	
					}
					return json([
						'status' => 1,
						'msg'    => "审核成功",

					]);
					exit;
				}else{
					return json([
						'status' => 0,
						'msg'    => "审核失败",

					]);
					exit;
				}
			}else{
				return json([
						'status' => 0,
						'msg'    => "查询数据失败",
					]);
				exit;
			}
		}else{
			$re_info =  Db::name("ck_insert")->where("insert_id=".$insert_id)->update(array('status'=>2,'reply'=>$reply));
			if($re_info){
				return json([
					'status' => 1,
					'msg'    => "审核未通过,已提交",

				]);
				exit;
			}else{
				return json([
					'status' => 0,
					'msg'    => "审核未通过,提交失败",
				]);
				exit;
			}
		}

	}
	/*入库 真正添加到库管ck_materiel表*/
	public function ck_insert_end(){
		$insert_id = $this->request->param('insert_id');	//insert_id

			$insert_info =  Db::name("ck_insert")->where('insert_id = '.$insert_id)->field('type,is_checked,cat_child_name,cat_child_id,insert_id,num,tb_id,apply_worker,admin_worker,remarks,cat_child_id,num,group_id,tb_id')->find();
			if($insert_info){
				if($insert_info['is_checked']=='1'){
						return json([
							'status' => 0,
							'msg'    => "数据已操作",

						]);
						exit;
				}
				$return_info =  Db::name("materiel")->where("m_id = ".$insert_info['cat_child_id'])->setInc('num',$insert_info["num"]);				
				
				if($insert_info['type']=='14'){
					$res =  Db::name('pro_take_back_detail')				
					->where('tb_id = '.$insert_info['tb_id'])				
					->setInc('b_num',$insert_info['num']);	
					if($return_info && $res){
						$re_info =  Db::name("ck_insert")->where("insert_id=".$insert_id)->update(array('is_checked'=>1,'admin_worker'=>$this->worker['worker_id'],'check_time'=>time()));
						return json([
							'status' => 1,
							'msg'    => "退料成功",

						]);
						exit;
					}else{
						//$re_info =  Db::name("ck_insert")->where("insert_id=".$insert_id)->update(array('status'=>0));
						return json([
							'status' => 0,
							'msg'    => "退料失败",
						]);
						exit;
					}
				}else{

					if($return_info ){
						$re_info =  Db::name("ck_insert")->where("insert_id=".$insert_id)->update(array('is_checked'=>1,'admin_worker'=>$this->worker['worker_id'],'check_time'=>time()));
						if($insert_info['type'] == 19){
							Db::name("ck_insert_detail")->where('io_id',$insert_id)->update(array('status'=>4,'ck_worker'=>$this->worker['worker_id']));
							$data = Db::name("ck_insert_detail")->where('io_id',$insert_id)->field('batch_no,materiel_id,num')->find();
							$data1['batch_no'] = $data['batch_no'];
							$data1['materiel_id'] = $data['materiel_id'];
							$data1['leftover_num'] = $data['num'];
							$data1['usable_num'] = $data['num'];
							$le = Db::name("ck_leftover")->insertGetId($data1);
							$info = Db::name("ck_leftover")->where('materiel_id',$data1['materiel_id'])->where('id','<',$le)->order('id desc')->limit(1)->find();
							if($info && !$info['next_batch']){
								Db::name("ck_leftover")->where('id',$info['id'])->setField('next_batch',$data1['batch_no']);
							}	
						}
						return json([
							'status' => 1,
							'msg'    => "入库成功",

						]);
						exit;
					}else{
						//$re_info =  Db::name("ck_insert")->where("insert_id=".$insert_id)->update(array('status'=>0));
						return json([
							'status' => 0,
							'msg'    => "入库失败",
						]);
						exit;
					}
				}
				
			}else{
				return json([
						'status' => 0,
						'msg'    => "查询数据失败",
					]);
				exit;
			}


	}
	/*出库 其他出库添加 进入虚拟库*/
	public function ck_lingliao(){
	  $data['type'] = $this->request->param('type');	//入库类型
	  $data['num'] = $this->request->param('num');	//入库数量
 
	  $data['cat_id'] = $this->request->param('cat_id'); //类别id
	  $data['cat_child_id'] = $this->request->param('cat_child_id'); //作物id
	  $data['ck_id'] = $this->request->param('ck_id');	//仓库id
	  $data['plan_id'] = $this->request->param('materiel_no');	//编号
	  $data['materiel_desc'] = $this->request->param('materiel_desc');//规格
	  $data['unit'] = $this->request->param('unit');//单位
	  $data['cat_child_name'] = $this->request->param('cat_child_name'); //作物名（物料名）
	  $data['lingliao_sn'] = $this->get_lingliao_sn(); //作物名（物料名）
	  $worker = $this->worker;
	  $data['apply_worker'] = $worker['worker_id'];
	  $data['add_time'] = time();
	  
	  $re= Db::name("ck_lingliao")->insert($data); 
	  if($re){
		return json([
			'status' => 1,
			'msg'    => "添加成功",
		]);
		exit;  
	  }else{
		  return json([
			'status' => 0,
			'msg'    => "添加失败",
		 
		]);
		exit;
	  }
	}
	
	/*库管 出库列表*/
	public function ck_lingliaolist(){
		
 		$type = $this->request->param('type');	//入库类型
		if($type=='5'){
			$row = 3;
			$page = $this->request->param('page');
			$materiel_info = array();

			if($page==1||!$page){
				$page = 0;
			}else{
				$page = ($page-1)*$row;
			}
			

			$status = $this->request->param('status')?$this->request->param('status'):'1';	//入库类型 1待审核 2未通过 3已通过 4已出库
			$keywords = $this->request->param('keywords');	//物料关键词
			$start_time = substr($this->request->param('start_time'),0,10);	//开始时间
			$end_time = substr($this->request->param('end_time'),0,10);	//结束时间
			if($type){
				$condition = ' type = '.$type.' and is_show = 1 ';
			}else{
				$condition = ' is_show = 1 ';
			}
			
			//status 0 待审核 1 通过 2 不通过  is_checked 0 待审核  1审核
			if($status=='1'){
				$condition.=' and status = 0 and is_checked = 0 ';
			}
			if($status=='2'){
				$condition.=' and status = 2 and is_checked = 0 ';
			}
			if($status=='3'){
				$condition.=' and status = 1 and is_checked = 0 ';
			}
			if($status=='4'){
				$condition.=' and status = 1 and is_checked = 1 ';
			}
	 

			if($keywords){
				$condition .= ' and company_name '.' like '."'%".$keywords."%'";
			}
			if($start_time){
				$condition .= ' and add_time > '.$start_time;
			}
			if($end_time){
				$condition .= ' and add_time < '.$end_time;
			}
			
			$worker = $this->worker; 
			$add_worker_id = $worker['worker_id'];
			
			/*************************************************************************************************************************************************************************临时关闭 线上打开*/
			
			/*
			$str = $this->get_mat_check($add_worker_id);
			
	 
			if($str){
				$condition .= "  and ck_id  in (".$str.")";
			}
			*/
			$materiel_info = array();
			$count = Db::name("ck_lingliao")->where($condition)->count();
			//echo Db::name("ck_lingliao")->getLastSql();die;
			$materiel_info = Db::name("ck_lingliao")->where($condition)->field('sell_id,company_name,batch_id,return_remarks,ready_status,status,is_checked,id,add_time,type,apply_worker,cat_id,cat_child_id,materiel_desc,plan_id,unit,num')->order('add_time desc')->limit($page,$row)->select();
		 
	
			foreach($materiel_info as $k=>$v){
				$materiel_info[$k]['add_time'] = date('Y-m-d ',$v['add_time']);
				//$materiel_info[$k]['submit_time'] = date('Y-m-d H:i:s',$v['submit_time']);
				//获取提交人信息
				$worker_info = Db::name("worker")->where('worker_id = '.$v['apply_worker'])->field('worker_name')->find();
				$materiel_info[$k]['apply_worker'] = $worker_info['worker_name']?$worker_info['worker_name']:'';
				
				
				$ling_detail = array();
				$ling_detail = Db::name("ck_lingliao_detail")->where('ling_id = '.$v['id'])->field('cat_id,m_id,m_num')->order('detail_id asc')->select();
				$detail_id = Db::name("sell_batch_detail")->where('batch_id = '.$v['batch_id'])->order('detail_id asc')->column('detail_id');
				$materiel_info[$k]['detail_id'] = implode(',',$detail_id);
				$arr = array();
				if($ling_detail){
					foreach($ling_detail as $ke=>$va){
						$worker_mate_info = Db::name("materiel")->where('m_id = '.$va['m_id'])->field('m_name,m_no,m_desc')->find();
						$ling_detail[$ke]['cat_child_id'] = Db::name("materiel_category")->where('cat_id = '.$va['cat_id'])->value('cat_name');
						if($worker_mate_info){
							$ling_detail[$ke]['cat_id'] = $worker_mate_info['m_name'];
							//$ling_detail[$k]['m_no'] = $worker_mate_info['m_no'];
							$ling_detail[$ke]['m_desc'] = $worker_mate_info['m_desc'];
						}
						if($status > 2){
							$bat =  Db::name("sell_batch_detail_log")->where('sell_bd_id',$detail_id[$ke])->column('batch_no');
							$ling_detail[$ke]['batch_no'] = implode(',',$bat);
							$arr[$ke] = implode(',',$bat);
						}elseif($status = 1){
							$ling_detail[$ke]['detail_id'] = $detail_id[$ke];
							$array1 = array();
							$array2 = array();
							$data = Db::name('ck_leftover')->where('materiel_id',$va['m_id'])->where('usable_num','>',0)->order('id asc')->limit(1)->find();
							if($data){
								if($data['usable_num'] < $va['m_num']){
									$array1[] = $data;
									if($data['next_batch']){	
										$array2 = $this->get_batch($data['next_batch'],$va['m_num']-$data['usable_num']);
									}
									$ling_detail[$ke]['info'] = array_merge($array1,$array2);
								}else{
									$ling_detail[$ke]['info'][] = $data;
								}
							}else{
								$ling_detail[$ke]['info'] = array();
							}
							$str = '';
							$str = str_replace(':null', ':""', json_encode($ling_detail[$ke]['info']));
							$ling_detail[$ke]['info'] = json_decode($str,'true');
						}
					}
				}

				$materiel_info[$k]['ling_detail'] = $ling_detail;
				$materiel_info[$k]['bat_str'] = implode(',',$arr);
				//获取预计到达时间  实际送货时间
				$batch_info = Db::name("sell_batch")->where('batch_id = '.$v['batch_id'])->field('submit_time,real_time')->find();
				if($batch_info){
					$materiel_info[$k]['submit_time'] = date('Y-m-d',$batch_info['submit_time']);
					$materiel_info[$k]['real_time'] = date('Y-m-d',$batch_info['real_time']);
				}
				
				//获取客户要求发货时间
				$order_info = Db::name("sell_order")->where('order_id = '.$v['sell_id'])->field('submit_time')->find();
				if($order_info){
					$materiel_info[$k]['order_time'] = date('Y-m-d',$order_info['submit_time']);
		 
				}
				
			}
			return json([
					'status' => 1,
					'msg'    => "获取成功",
					'count'    => $count,
					'data'   => $materiel_info,
					 
				]);
			exit;
		}else{
			$row = 3;
			$page = $this->request->param('page');
			$materiel_info = array();

			if($page==1||!$page){
				$page = 0;
			}else{
				$page = ($page-1)*$row;
			}
			

			$status = $this->request->param('status')?$this->request->param('status'):'1';	//入库类型 1待审核 2未通过 3已通过 4已出库
			$keywords = $this->request->param('keywords');	//物料关键词
			$start_time = substr($this->request->param('start_time'),0,10);	//开始时间
			$end_time = substr($this->request->param('end_time'),0,10);	//结束时间
			if($type){
				$condition = ' type = '.$type.' and is_show = 1 ';
			}else{
				$condition = ' is_show = 1 ';
			}
			
			//status 0 待审核 1 通过 2 不通过  is_checked 0 待审核  1审核
			if($status=='1'){
				$condition.=' and status = 0 and is_checked = 0 ';
			}
			if($status=='2'){
				$condition.=' and status = 2 and is_checked = 0 ';
			}
			if($status=='3'){
				$condition.=' and status = 1 and is_checked = 0 ';
			}
			if($status=='4'){
				$condition.=' and status = 1 and is_checked = 1 ';
			}
	 
			
			
			
			if($keywords){
				$condition .= ' and cat_child_name '.' like '."'%".$keywords."%'";
			}
			if($start_time){
				$condition .= ' and add_time > '.$start_time;
			}
			if($end_time){
				$condition .= ' and add_time < '.$end_time;
			}
			
			$worker = $this->worker; 
			$add_worker_id = $worker['worker_id'];
			
			/*************************************************************************************************************************************************************************临时关闭 线上打开*/
			
			/*
			$str = $this->get_mat_check($add_worker_id);
			
	 
			if($str){
				$condition .= "  and ck_id  in (".$str.")";
			}
			*/
			$materiel_info = array();
			$count = Db::name("ck_lingliao")->where($condition)->count();
			//echo Db::name("ck_lingliao")->getLastSql();die;
			$materiel_info = Db::name("ck_lingliao")->where($condition)->field('sell_id,batch_id,return_remarks,ready_status,status,is_checked,id,add_time,type,apply_worker,cat_id,cat_child_id,materiel_desc,plan_id,unit,num')->order('add_time desc')->limit($page,$row)->select();
			//echo Db::name("ck_lingliao")->getLastSql();die;
		 
		 	
			foreach($materiel_info as $k=>$v){
				$materiel_info[$k]['add_time'] = date('Y-m-d H:i:s',$v['add_time']);
						
				//获取提交人信息
				$worker_info = Db::name("worker")->where('worker_id = '.$v['apply_worker'])->field('worker_name')->find();
				$materiel_info[$k]['apply_worker'] = $worker_info['worker_name']?$worker_info['worker_name']:'';
				
				//根据cat_id判断是物料还是其他
				if($v['type'] != 5){
					$worker_cat_info = Db::name("materiel_category")->where('cat_id = '.$v['cat_id'])->field('cat_name,ck_id,type')->find();
					if($worker_cat_info){
						if($worker_cat_info['type']=='0'){
							$worker_mate_info = Db::name("materiel")->where('m_id = '.$v['cat_child_id'])->field('m_name,m_no')->find();
							$materiel_info[$k]['cat_child_id'] = $worker_mate_info['m_name']?$worker_mate_info['m_name']:'';
							$materiel_info[$k]['m_no'] = $worker_mate_info['m_no']?$worker_mate_info['m_no']:'';
						}else{
							$worker_mate_info = Db::name("materiel_category")->where('cat_id = '.$v['cat_child_id'])->field('cat_name,cat_no')->find();
							$materiel_info[$k]['cat_child_id'] = $worker_mate_info['cat_name']?$worker_mate_info['cat_name']:'';
							$materiel_info[$k]['m_no'] = $worker_mate_info['cat_no']?$worker_mate_info['cat_no']:'';
						}
						$materiel_info[$k]['cat_id'] = $worker_cat_info['cat_name'];	
					}
				}else{
					$m = Db::name("sell_batch_detail")->where('batch_id',$v['batch_id'])->field('m_id,cat_id,m_num')->select();
					$arr = array();
					$arr1 = array();
					$unit = array();
					$desc = array();
					$num = 0;
					foreach($m as $k1=>$v1){
						$a = Db::name("materiel")->where('m_id',$v1['m_id'])->field('m_name,m_desc,unit')->find();
						$arr[] = $a['m_name'];
						$unit[] = $a['unit']?$a['unit']:'';
						$desc[] = $a['m_desc']?$a['m_desc']:'';
						$c = Db::name("materiel_category")->where('cat_id',$v1['cat_id'])->field('pid,cat_name')->find();
						if($c['pid']){
							$cat_name = Db::name("materiel_category")->where('cat_id',$c['pid'])->value('cat_name');
							$arr1[] = $cat_name.$c['cat_name'];
						}else{
							$arr1[] = $c['cat_name'];
						}
						$num += $v1['m_num'];
					}
					$materiel_info[$k]['cat_id'] = implode(',',$arr);
					$materiel_info[$k]['cat_child_id'] = implode(',',$arr1);
					$materiel_info[$k]['materiel_desc'] = implode(',',$desc);
					$materiel_info[$k]['unit'] = $unit[0];
					$materiel_info[$k]['num'] = $num;

				}
			}
			return json([
					'status' => 1,
					'msg'    => "获取成功",
					'count'    => $count,
					'data'   => $materiel_info,
					 
				]);
			exit;
			
		}

	}
	/*根据作物id 获取库存数量*/

	public function  get_matnum(){
 
		$cat_child_id = $this->request->param('cat_child_id');
		$insert_info =  Db::name("materiel")->where("m_id = '".$cat_child_id."'")->field('num')->find();
 
		if($insert_info){
			return json([
				'status' => 1,
				'msg'    => "获取成功",
				'count_num'   => $insert_info['num'],
				 
			]);
			exit;
		}else{
			return json([
				'status' => 0,
				'msg'    => "获取失败",
				
			]);
			exit;
		}
	}
	
		
	/**
	 * [ck_lingliaoinsert 领料出库审核]
	 * @return [type] [description]
	 */
	public function ck_lingliaoinsert(){
		
		$palt_from = $this->request->param('palt_from');	//insert_id
		
		$id = $this->request->param('id');	//insert_id
		$type = $this->request->param('type');	//通过 1
		$reply = $this->request->param('reply')?$this->request->param('reply'):'';	//insert_id
		
		if($type=='1'){
			if($palt_from!='5'){  //销售出库(原来是==)
				//$batch = $this->request->param('batch')?$this->request->param('batch'):'';
				$insert_info =  Db::name("ck_lingliao_detail")->where('ling_id = '.$id)->field('m_id,m_num')->select();
				if($insert_info){
					$i = 0;
					$str = '';
					foreach($insert_info as $k=>$v){
						$check_info =  Db::name("materiel")->where(" m_id = ".$v['m_id'])->field('num,m_name')->find();
						if($check_info && $check_info['num']>$v['m_num']){
							$i++;
						}else{
					 
							$str .= $check_info['m_name'].",";
						}
					}
					if($i == count($insert_info)){
						$re_info =  Db::name("ck_lingliao")->where("id=".$id)->update(array('status'=>1));
							return json([
								'status' => 1,
								'msg'    => "审核通过",

							]);
							exit;
					}else{
						return json([
							'status' => 0,
							'msg'    => $str."库存不足",

						]);
						exit;
					}	
				}else{
					return json([
							'status' => 0,
							'msg'    => "查询无数据",

						]);
					exit;
				}
			}else{
				$insert_info = Db::name("ck_lingliao")->where('id = '.$id)->field('cat_child_name,cat_child_id,id,num,type')->find();
				if($insert_info){
					
					$check_info =  Db::name("materiel")->where(" m_id = ".$insert_info['cat_child_id'])->field('num')->find();				
					if($check_info && $check_info['num']>$insert_info['num']){
						$re_info =  Db::name("ck_lingliao")->where("id=".$id)->update(array('status'=>1));
						if($re_info){
							return json([
								'status' => 1,
								'msg'    => "审核通过",
							]);
							exit;
						}else{
							return json([
								'status' => 0,
								'msg'    => "审核通过失败"
							]);
							exit;
						}
					}else{
						return json([
							'status' => 0,
							'msg'    => "库存不足",
						]);
						exit;
					}
				}else{
					return json([
						'status' => 0,
						'msg'    => "查询无数据",
					]);
					exit;
				}
				
			}
			

		}else{
			$re_info =  Db::name("ck_lingliao")->where("id=".$id)->update(array('status'=>2,'return_remarks'=>$reply));
			if($re_info){
				return json([
					'status' => 1,
					'msg'    => "审核未通过,已提交",

				]);
				exit;
			}else{
				return json([
					'status' => 0,
					'msg'    => "审核未通过,提交失败",
				]);
				exit;
			}
		}
	}

	
	
	/*保管员确认  修改库存表*/
	public function ck_lingliaoinsert_end(){
		$id = $this->request->param('id');	//insert_id
 
			$insert_info =  Db::name("ck_lingliao")->where('id = '.$id)->field('type,sell_id,is_checked,cat_child_name,cat_child_id,id,num')->find();
			if($insert_info){
				
				if($insert_info['is_checked']=='1'){
					return json([
								'status' => 0,
								'msg'    => "数据已操作",

							]);
					exit;
				}
				
				$check_info =  Db::name("materiel")->where(" m_id = ".$insert_info['cat_child_id'])->field('num')->find();				
				if($check_info && $check_info['num']>$insert_info['num']){
					$re =  Db::name("materiel")->where("m_id = ".$insert_info['cat_child_id'])->setDec('num',$insert_info["num"]);				
				
					if($re){
						$re_info =  Db::name("ck_lingliao")->where("id=".$id)->update(array('is_checked'=>1,'admin_worker'=>$this->worker['worker_id']));
						
						if($insert_info['type']=='5'){
							//判断是够销售下单
							$order_info = Db::name("sell_orinfo")->where(" order_id = ".$insert_info['sell_id'].' and m_id = '.$insert_info['cat_child_id'])->field('sell_task_id')->find();	
							if($order_info){
								$task_info = Db::name('sell_task')->where(' id = '.$order_info['sell_task_id'])->field('m_id,margin_num')->find();	
									
									if($task_info['margin_num'] > $insert_info['num']){
										$task_return =  Db::name("sell_task")->where(' id = '.$order_info['sell_task_id'])->setDec('margin_num',$insert_info['num']);
									}else{
										return json([
										'status' =>0,
										'msg'    => "销售任务可用余量不足",

										]);
										exit;
									}
									
							}
						
						}
						
						return json([
							'status' => 1,
							'msg'    => "出库成功",

						]);
						exit;
					}else{
							return json([
								'status' => 0,
								'msg'    => "出库失败",
							]);
							exit;
					}				
				}else{
					return json([
							'status' => 0,
							'msg'    => "库存不足",
						]);
					exit;
				}

			}else{
				return json([
						'status' => 0,
						'msg'    => "数据查询失败",
					]);
				exit;
			}
 
	}
	/*修改出入库显示隐藏*/
	
	public function update_show(){
		$type = $this->request->param('type');	// 1 入库 2 出库
		$id = $this->request->param('id');	//入库类型
		$re_info =array();
		if($type=='1'){
			$re_info =  Db::name("ck_insert")->where("insert_id=".$id)->update(array('is_show'=>2));
		}
		if($type=='2'){
			$re_info =  Db::name("ck_lingliao")->where("id=".$id)->update(array('is_show'=>2));
		}
		if($re_info && !empty($re_info)){
			return json([
					'status' => 1,
					'msg'    => "数据已删除",

				]);
			exit;
		}else{
			return json([
					'status' => 0,
					'msg'    => "数据删除失败",

				]);
			exit;
		}
		
	}
	  /**
     * [ck_manage 仓库管理]
     * @return [type] [返回值描述]
    
     */
	public function ck_manage(){
		$ck=Db::name("ck_manage");
		$ck_ma=Db::name("materiel_category");
		
		$check_info =  Db::name('ck_manage')->where('type = 1 ')->select();
		if(!$check_info){
			$check_info = array();
		}
		foreach($check_info as $k=>$v){
			if($v['charge_people']){
				$people_info =  Db::name('worker')->where(" worker_id  in  (".$v['charge_people'].")")->field('worker_id,worker_name')->select();
				if($people_info){
					$check_info[$k]['people'] = $people_info;
				}else{
						$check_info[$k]['people'] = array();
				}
			}
 	
		}
		return json([
					'status' => 1,
					'msg'    => "数据查询成功",
					'data'    => $check_info

				]);
		exit;
    }
		  /**
     * [ck_manage 修改仓库管理]
     * @return [type] [返回值描述]
    
     */
	public function edit_manage(){
		$ck_id = $this->request->param('ck_id'); 
		$type = $this->request->param('type');  //1展示  2 修改
		$check_info = array();
		if($type=='1'){
			$check_info =  Db::name('ck_manage')->where('type = 1 and ck_id =  '.$ck_id)->find();
			
		 
			if($check_info && $check_info['charge_people']){
				$people_info =  Db::name('worker')->where(" worker_id  in  (".$check_info['charge_people'].")")->field('worker_id,worker_name')->select();
				if($people_info){
					$check_info['people'] = $people_info;
				}else{
					$check_info['people'] = array();
				}
			}else{
					$check_info['people'] = array();
			}
			return json([
					'status' => 1,
					'msg'    => "数据查询成功",
					'data'    => $check_info

				]);
			exit;
		}
		if($type=='2'){
			$data['ck_name']= $this->request->param('ck_name');
			
			
			$check_info =  Db::name('ck_manage')->where("ck_name = '".$data['ck_name']."'")->find();
			if($check_info){
				if($check_info['ck_id']!= $ck_id){
					return json([
						'status' => 0,
						'msg'    => "仓库名已存在",

					]);
					exit;
				}
			}
			
			
			$charge_people= json_decode($this->request->param('charge_people'),true);
			$data['charge_people'] = implode(',',$charge_people);			
			$data['add_time'] = time();			
			$re_up = Db::name('ck_manage')->where('ck_id = '.$ck_id)->update($data);
			if($re_up){
				return json([
					'status' => 1,
					'msg'    => "修改成功",

				]);
				exit;
			}else{
				return json([
					'status' => 0,
					'msg'    => "修改失败",

				]);
				exit;
			}
			
		}
		
		
 
    }
		/**
     * [ck_delete 删除仓库]
     * @return [type] [返回值描述]
     */
	public function ck_delete(){
		$ck_ma= Db::name("materiel_category");
		$ck_id = $this->request->param('ck_id');	// 1 入库 2 出库
		if(!is_numeric($ck_id)){
			$this->ajaxReturn(array("status"=>0,"info"=>"仓库id有误!"));
		}
		$data=$ck_ma->field("cat_name")->where("ck_id=".$ck_id)->select();
		$str="";
		if(!empty($data)){
			return json([
					'status' => 0,
					'msg'    => "该仓库还有分类请先转移",
					
				]);
			exit; 
		}
 
		$re_info =  Db::name("ck_manage")->where("ck_id=".$ck_id)->update(array('type'=>2));
		if($re_info){
			return json([
					'status' => 1,
					'msg'    => "删除成功",
					
				]);
			exit; 
		}else{
			return json([
					'status' => 0,
					'msg'    => "删除失败",
					
				]);
			exit; 
		}
    }
	
	/*获取仓库所有人列表*/
	public function materiel_peoplelist(){
		$check_info =  Db::name('worker')->where('group_id = 4 and status = 1 ')->field('worker_id,worker_name')->select();
		return json([
					'status' => 1,
					'msg'    => "查询成功",
					'data' =>$check_info
					
				]);
			exit; 
	}
	
	
	
 	/**
     * [add_ck 添加仓库]
     * @return [type] [返回值描述]
 
     */
	public function add_ck(){

		$data['ck_name']= $this->request->param('ck_name');
		$data['charge_people']= json_decode($this->request->param('charge_people'),true);	
		 
		 $people='';
		if($data['charge_people']){
			$people = implode(',',$data['charge_people']);
		} 
		
 
		$ck=Db::name("ck_manage");
		if($data['ck_name']){
			$check_info =  Db::name('ck_manage')->where("ck_name ='" .$data['ck_name']."'")->find();
			
			if($check_info){
				return json([
					'status' => 0,
					'msg'    => "仓库名已存在",

				]);
				exit;
			}else{
				$data['add_worker']=$this->worker["worker_id"];
				$data['add_time']=time();
				$data['charge_people'] = $people;
				$re = Db::name('ck_manage')->insert($data);
				
				if($re){
					return json([
					'status' =>1,
					'msg'    => "添加成功",

					]);
					exit;
				}else{
					return json([
					'status' =>0,
					'msg'    => "添加失败",

					]);
					exit;
				}
				
			}	
			

		}else{
			return json([
					'status' => 0,
					'msg'    => "参数错误",

				]);
			exit;
		}
    }
	   	/**
     * [ck_relation 关联仓库]
     * @return [type] [返回值描述]
     */
	public function ck_relation(){
		$ck_id= $this->request->param('ck_id');
		$cat_id= $this->request->param('cat_id');
		if(!is_numeric($ck_id)){
			$ck_id=0;
			//$this->ajaxReturn(array("status"=>0,"info"=>"仓库id有误!"));
		}
	 
		if(!is_numeric($cat_id)){
			return json([
					'status' => 0,
					'msg'    => "参数错误",

				]);
			exit;
		}
		$ck_ma= Db::name("materiel_category");
		$re=$ck_ma->where("cat_id=".$cat_id)->update(array('ck_id'=>$ck_id));
		
		
		$return_new = Db::name('ck_lingliao')->where("cat_id=".$cat_id)->update(array('ck_id'=>$ck_id));
		$re_two = Db::name('ck_insert')->where("cat_id=".$cat_id)->update(array('ck_id'=>$ck_id));
		
		if($re!==false && $return_new !== false && $re_two!==false){
			return json([
					'status' => 1,
					'msg'    => "关联成功",

				]);
			exit;
		}else{
			return json([
					'status' => 0,
					'msg'    => "关联失败",

				]);
			exit;
		}		
    }
	
	/*pc端接口 获取仓库 和分类*/
	public function pc_manage_list(){
		

		$mange_info = array();
		$mange_info =  Db::name('ck_manage')->where('type = 1 ')->select();
		
		foreach($mange_info as $k=>$v){
			$cate_info = Db::name("materiel_category")->where('status = 1 and pid = 0 and ck_id = '.$v['ck_id'])->field('cat_name,cat_id,ck_id')->select();
			if($cate_info){
				$mange_info[$k]['cate_info'] = $cate_info;
			}
		}
		return json([
					'status' => 1,
					'msg'    => "查询成功",
					'data' =>$mange_info
					
				]);
		exit; 
	}
	/*pc 端借口 修改分类 仓库对应*/
	public function pc_change_catemange(){
		$cat_id = $this->request->param('cat_id');	
		$ck_id = $this->request->param('ck_id');	
		
		$re =  Db::name('materiel_category')->where('cat_id = '.$cat_id)->update(array('ck_id'=>0));
		return json([
			'status' => 1,
			'msg'    => "修改成功",
			
		]);
		exit; 	
	}
	
	/*pc 端 获取物料分类 未有所属仓库*/
	public function pc_last_cateinfo(){
		$return_info = array();
		$return_info = Db::name("materiel_category")->where('status = 1 and pid = 0  and ck_id < 1')->field('cat_name,cat_id,ck_id')->select();
		return json([
			'status' => 1,
			'msg'    => "查询成功",
			'data' =>$return_info
			
		]);
		exit;
	}
	/*pc端 添加仓库 所属物料分类*/
	
	/* pc端 出库列表*/
	public function pc_ck_lingliaolist(){
 		$type = $this->request->param('type');	//入库类型
		if($type=='5'){
			$row = 3;
			$page = $this->request->param('page');
			$materiel_info = array();

			if($page==1||!$page){
				$page = 0;
			}else{
				$page = ($page-1)*$row;
			}
			$status = $this->request->param('status')?$this->request->param('status'):'1';	//入库类型 1待审核 2未通过 3已通过 4已出库
			$keywords = $this->request->param('keywords');	//物料关键词
			$start_time = $this->request->param('start_time');	//开始时间
			$end_time = $this->request->param('end_time');	//结束时间
			if($type){
				$condition = ' type = '.$type.' and is_show = 1 ';
			}else{
				$condition = ' is_show = 1 ';
			}
			//status 0 待审核 1 通过 2 不通过  is_checked 0 待审核  1审核
			if($status=='1'){
				$condition.=' and status = 0 and is_checked = 0 ';
			}
			if($status=='2'){
				$condition.=' and status = 2 and is_checked = 0 ';
			}
			if($status=='3'){
				$condition.=' and status = 1 and is_checked = 0 ';
			}
			if($status=='4'){
				$condition.=' and status = 1 and is_checked = 1 ';
			}
			if($keywords){
				$condition .= ' and company_name '.' like '."'%".$keywords."%'";
			}
			if($start_time){
				$condition .= ' and add_time > '.$start_time;
			}
			if($end_time){
				$condition .= ' and add_time < '.$end_time;
			}
			$worker = $this->worker; 
			$add_worker_id = $worker['worker_id'];
			
			/*************************************************************************************************************************************************************************临时关闭 线上打开*/
			
			/*
			$str = $this->get_mat_check($add_worker_id);
			if($str){
				$condition .= "  and ck_id  in (".$str.")";
			}
			*/
			$materiel_info = array();
			$materiel_info = Db::name("ck_lingliao")->where($condition)->field('id,sell_id,company_name,batch_id,return_remarks,ready_status,status,is_checked,id,add_time,type,apply_worker,cat_id,cat_child_id,materiel_desc,plan_id,unit,num')->order('add_time desc')->paginate(20);
			//echo Db::name("ck_lingliao")->getLastSql();die;
			
			
			
			$page = $materiel_info->render();
			$list = $materiel_info->items();
			$jsonStr = json_encode($materiel_info);
			$info = json_decode($jsonStr,true);
			$pages = $info['last_page'];
			
			
			
			foreach($list as $k=>$v){
				$list[$k]['add_time'] = date('Y-m-d ',$v['add_time']);
				//$materiel_info[$k]['submit_time'] = date('Y-m-d H:i:s',$v['submit_time']);
				//获取提交人信息
				$worker_info = Db::name("worker")->where('worker_id = '.$v['apply_worker'])->field('worker_name')->find();
				$list[$k]['apply_worker'] = $worker_info['worker_name']?$worker_info['worker_name']:'';
				
				
				$ling_detail = array();
				$ling_detail = Db::name("ck_lingliao_detail")->where('ling_id = '.$v['id'])->field('m_id,m_num')->select();
				$detail_name ='';
				if($ling_detail){
					foreach($ling_detail as $ke=>$va){
						$worker_mate_info = Db::name("materiel")->where('m_id = '.$va['m_id'])->field('m_name,m_no,m_desc')->find();
						if($worker_mate_info){
							$ling_detail[$ke]['cat_id'] = $worker_mate_info['m_name'];
							//$ling_detail[$k]['m_no'] = $worker_mate_info['m_no'];
							//$ling_detail[$k]['m_desc'] = $worker_mate_info['m_desc'];
						}else{
							$ling_detail[$ke]['cat_id'] = '';
						}
						$detail_name .= $worker_mate_info['m_name'].' ';
					}
				}
				$list[$k]['ling_detail'] = $ling_detail;
				$list[$k]['detail_name'] = $detail_name;
				//获取预计到达时间  实际送货时间
				$batch_info = Db::name("sell_batch")->where('batch_id = '.$v['batch_id'])->field('submit_time,real_time')->find();
				if($batch_info){
					$list[$k]['submit_time'] = date('Y-m-d',$batch_info['submit_time']);
					$list[$k]['real_time'] = date('Y-m-d',$batch_info['real_time']);
				}
				//获取客户要求发货时间
				$order_info = Db::name("sell_order")->where('order_id = '.$v['sell_id'])->field('submit_time')->find();
				if($order_info){
					$list[$k]['order_time'] = date('Y-m-d',$order_info['submit_time']);
				}
				if($v['status']=='0'){
					$list[$k]['status_name'] = '待审核';
				}
				if($v['status']=='1'){
					$list[$k]['status_name'] = '通过';
				}
				if($v['status']=='2'){
					$list[$k]['status_name'] = '不通过';
				}
			}
			$page_list = array();
			$page_list['page'] = $page;
			$page_list['pages'] = $pages;
			$page_list['list'] = $list;
			
			$worker = $this->worker;
			$check = strstr($worker['node_str'],'29');
			$shen_worker = 1;
			if($check){
				$shen_worker = 2;
			}
			$check_new = strstr($worker['node_str'],'30');
			$bao_worker = 1;
			if($check_new){
				$bao_worker = 2;
			}
			
			return json([
					'status' => 1,
					'msg'    => "获取成功",
					'data'   => $page_list,
					'shen_worker'=>$shen_worker,
					'bao_worker'=>$bao_worker
					 
				]);
			exit;
		}else{
			$row = 3;
			$page = $this->request->param('page');
			$materiel_info = array();

			if($page==1||!$page){
				$page = 0;
			}else{
				$page = ($page-1)*$row;
			}
			
			$status = $this->request->param('status')?$this->request->param('status'):'1';	//入库类型 1待审核 2未通过 3已通过 4已出库
			$keywords = $this->request->param('keywords');	//物料关键词
			$start_time = $this->request->param('start_time');	//开始时间
			$end_time = $this->request->param('end_time');	//结束时间
			if($type){
				$condition = ' type = '.$type.' and is_show = 1 ';
			}else{
				$condition = ' is_show = 1 ';
			}
			//status 0 待审核 1 通过 2 不通过  is_checked 0 待审核  1审核
			if($status=='1'){
				$condition.=' and status = 0 and is_checked = 0 ';
			}
			if($status=='2'){
				$condition.=' and status = 2 and is_checked = 0 ';
			}
			if($status=='3'){
				$condition.=' and status = 1 and is_checked = 0 ';
			}
			if($status=='4'){
				$condition.=' and status = 1 and is_checked = 1 ';
			}

			if($keywords){
				$condition .= ' and cat_child_name '.' like '."'%".$keywords."%'";
			}
			if($start_time){
				$condition .= ' and add_time > '.$start_time;
			}
			if($end_time){
				$condition .= ' and add_time < '.$end_time;
			}
			
			$worker = $this->worker; 
			$add_worker_id = $worker['worker_id'];
			
			/*************************************************************************************************************************************************************************临时关闭 线上打开*/
			
			/*
			$str = $this->get_mat_check($add_worker_id);
			
	 
			if($str){
				$condition .= "  and ck_id  in (".$str.")";
			}
			*/
			$materiel_info = array();
			$count = Db::name("ck_lingliao")->where($condition)->count();
			//echo Db::name("ck_lingliao")->getLastSql();die;
			$materiel_info = Db::name("ck_lingliao")->where($condition)->field('id,sell_id,batch_id,return_remarks,ready_status,status,is_checked,id,add_time,type,apply_worker,cat_id,cat_child_id,materiel_desc,plan_id,unit,num')->order('add_time desc')->paginate(20);
			//echo Db::name("ck_lingliao")->getLastSql();die;
		 
			$page = $materiel_info->render();
			$list = $materiel_info->items();
			$jsonStr = json_encode($materiel_info);
			$info = json_decode($jsonStr,true);
			$pages = $info['last_page'];
			
 
			foreach($list as $k=>$v){
				$list[$k]['add_time'] = date('Y-m-d H:i:s',$v['add_time']);
						
				//获取提交人信息
				$worker_info = Db::name("worker")->where('worker_id = '.$v['apply_worker'])->field('worker_name')->find();
				$list[$k]['apply_worker'] = $worker_info['worker_name']?$worker_info['worker_name']:'';
				
				//根据cat_id判断是物料还是其他
				$worker_cat_info = Db::name("materiel_category")->where('cat_id = '.$v['cat_id'])->field('cat_name,ck_id,type')->find();
				if($worker_cat_info){
					if($worker_cat_info['type']=='0'){
						$worker_mate_info = Db::name("materiel")->where('m_id = '.$v['cat_child_id'])->field('m_name,m_no')->find();
						$list[$k]['cat_child_id'] = $worker_mate_info['m_name']?$worker_mate_info['m_name']:'';
						$list[$k]['m_no'] = $worker_mate_info['m_no']?$worker_mate_info['m_no']:'';
					}else{
						$worker_mate_info = Db::name("materiel_category")->where('cat_id = '.$v['cat_child_id'])->field('cat_name,cat_no')->find();
						$list[$k]['cat_child_id'] = $worker_mate_info['cat_name']?$worker_mate_info['cat_name']:'';
						$list[$k]['m_no'] = $worker_mate_info['cat_no']?$worker_mate_info['cat_no']:'';
					}
					$list[$k]['cat_id'] = $worker_cat_info['cat_name'];
					
				}
			}
			
			
			
			$page_list = array();
			$page_list['page'] = $page;
			$page_list['pages'] = $pages;
			$page_list['list'] = $list;
			
		 
		 	$worker = $this->worker;
			$check = strstr($worker['node_str'],'29');
			$shen_worker = 1;
			if($check){
				$shen_worker = 2;
			}
			$check_new = strstr($worker['node_str'],'30');
			$bao_worker = 1;
			if($check_new){
				$bao_worker = 2;
			}
		 

			return json([
					'status' => 1,
					'msg'    => "获取成功",
					'count'    => $count,
					'data'   => $page_list,
					'bao_worker'=>$bao_worker,
					'shen_worker'=>$shen_worker
					 
				]);
			exit;
			
		}

	}
 
		/**
		 * [pc_stock_num pc端 全部物料列表 / 预警列表]
		 * @return [type] [description]
		 */
	    public function pc_stock_num(){

		//获取条件变量
		$row = 3;
		$page = $this->request->param('page');
		$keywords = $this->request->param('keywords');
		$search_type = $this->request->param('search_type');
		$cat_id = $this->request->param('cat_id');
		$type = $this->request->param('type');
	
		$worker = $this->worker;
		$add_worker_id = $worker['worker_id'];
	 
		if($page==1||!$page){
			$page = 0;
		}else{
			$page = ($page-1)*$row;
		}
		$condition = 'crop.status = 1 ';
		
		
		$str = $this->get_mat_check($add_worker_id);
		
		/************************************************************************************************/
		/*
		if($str){
			$condition .= "  and ckm.ck_id  in (".$str.")";
		}
		*/
		
    	if(is_numeric($cat_id)){
			$condition .= ' and m.cat_id = '.$cat_id;
    	}
    	if($cat_id == '果蔬'){
    		$condition .= ' and m.type = 1';	
    	}
    	if($cat_id == '种子'){
    		$condition .= ' and m.type = 4';
    	}
    	if($keywords){

			$condition .= ' and '.$search_type.' like '."'%".$keywords."%'";
		}
		if($type=='2'){
			$condition .= ' and  m.warning_num >= m.num ';
		}
 
 
		$fields[] = 'm.m_id as materiel_id';
		$fields[] = 'm.m_name as materiel_name';
		$fields[] = 'm.m_no as materiel_no';
		$fields[] = 'm.m_desc as size_name';
		$fields[] = 'm.m_desc as materiel_desc';
		$fields[] = 'm.num';
		$fields[] = 'm.unit';
		$fields[] = 'm.warning_num';
		$fields[] = 'crop.cat_id';
		$fields[] = 'crop.cat_name as cat_name';
		//$fields[] = '';
		//$fields[] = '';
		$materiel_list = Db::name('materiel')->alias('m')
			->field(join(',',$fields))
			->join('materiel_category crop','crop.cat_id = m.cat_id','LEFT')
			->join('ck_manage ckm','ckm.ck_id = crop.ck_id','LEFT')
			->where($condition)                                      
			->paginate(20);

		
		//echo Db::name('materiel')->getLastSql();die;
		$page = $materiel_list->render();
		$list = $materiel_list->items();
		$jsonStr = json_encode($materiel_list);
		$info = json_decode($jsonStr,true);
		$pages = $info['last_page'];
			
			
		
		
		//echo  Db::name('materiel')->getLastSql();die;
	 
		if($list && !empty($list)){
			//获取采购中，待采购的数据
			foreach($list as $k => $row){
				$con_1['is_stored'] = 0;
				$con_1['is_checked_1'] = 1;
				$con_1['is_checked_2'] = 1;
				$con_1['is_checked_3'] = 1;
				$con_1['is_checked_4'] = 1;
				
				$con_1['bpd.materiel_id'] = $row['materiel_id'];
				$fields_start[] = 'buy_num';
		
				$num_start = Db::name('buy_plan_detail')->alias('bpd')
					->join('buy_plan bp','bp.plan_id = bpd.plan_id','LEFT')
					->where($con_1)
					->field(join(',',$fields_start))
					->find();
				
				if($num_start && !empty($num_start)){
					$list[$k]['buy_num_start'] = $num_start['buy_num'];
				}else{
					$list[$k]['buy_num_start'] =0;
				}
			
				$con_2['is_checked_1'] = array('eq',0);
				$con_2['is_checked_2'] = array('eq',0);
				$con_2['is_checked_3'] = array('eq',0);
				$con_2['is_checked_4'] = array('eq',0);
	
				$con_2['is_stored'] = 0;
				$con_2['bpd.materiel_id'] = $row['materiel_id'];
			 
			 
				//$where['is_stored'] = array('eq',0);
				
				$num_end = Db::name('buy_plan_detail')->alias('bpd')
					->join('buy_plan bp','bp.plan_id = bpd.plan_id','LEFT')
					->where($con_2)
					->field(join(',',$fields_start))
					->find();
				if($num_end && !empty($num_end)){
					$list[$k]['buy_num_end'] = $num_end['buy_num'];
				}else{
					$list[$k]['buy_num_end'] =0;
				}	 
 
				if(!$row['size_name']){
					$list[$k]['size_name'] = $row['materiel_desc'] ? $row['materiel_desc']:'';
				}
				//修改采购数量
				$cai_where['materiel_id'] = $row['materiel_id'];
				$cai_info = Db::name('ck_caigou')->where($cai_where)->sum('request_num');
				
				if($cai_info){
					$list[$k]['request_num'] = $cai_info;
				}else{
					$list[$k]['request_num'] = 0;
				}

				
			}
		} 
		
		
		
		$field_end[] = 'cat_id';
		$field_end[] = 'cat_name';
 		$con['type'] = 0;
 		$con['status'] = 1;
		$get_materiel_cat = Db::name('materiel_category')->where($con)->field(implode(',',$field_end))->select();

		$page_list['get_materiel_cat'] = $get_materiel_cat;
 
		

		// $page_list['page'] = $page;
		$page_list['pages'] = $pages;
		$page_list['list'] = $list;
 
		return json([
			'status' => 1,
			'msg'    => "获取成功",
			'data'   => $page_list
		]);
		exit;
  
    }
	/*pc端库管 入库列表*/
	public function pc_ck_insertlist(){
		
 
		$row = 10;
		$page = $this->request->param('page');
		$materiel_info = array();

		if($page==1||!$page){
			$page = 0;
		}else{
			$page = ($page-1)*$row;
		}
		
		$type = $this->request->param('type');	//入库类型
		$status = $this->request->param('status')?$this->request->param('status'):'1';	//入库类型
		$keywords = $this->request->param('keywords');	//物料关键词
		$start_time = $this->request->param('start_time');	//开始时间
		$end_time = $this->request->param('end_time');	//结束时间
 
		if($type){
			$condition = ' type = '.$type.' and is_show = 1 ';
		}else{
			$condition = ' is_show = 1 ';
		}
		
		//status 0 待审核 1 通过 2 不通过  is_checked 0 待审核  1审核
		if($status=='1'){
			$condition.=' and status = 0 and is_checked = 0 ';
		}
		if($status=='2'){
			$condition.=' and status = 2 and is_checked = 0 ';
		}
		if($status=='3'){
			$condition.=' and status = 1 and is_checked = 0 ';
		}
		if($status=='4'){
			$condition.=' and status = 1 and is_checked = 1 ';
		}
 
 
 
		
		if($keywords){
			$condition .= ' and cat_child_name '.' like '."'%".$keywords."%'";
		}
		if($start_time){
			$condition .= ' and add_time > '.$start_time;
		}
		if($end_time){
			$condition .= ' and add_time < '.$end_time;
		}
		
		$worker = $this->worker;
		$add_worker_id = $worker['worker_id'];
		$str = $this->get_mat_check($add_worker_id);
		
		/****************************************************************************************************/
		
		/*if($str){
			$condition .= "  and ck_id  in (".$str.")";
		}*/
		
		$count = Db::name("ck_insert")->where($condition)->count();
		
		$materiel_info = Db::name("ck_insert")->where($condition)->field('is_checked,reply,status,type,insert_id,add_time,apply_worker,cat_id,cat_child_name as cat_child_id,materiel_desc,plan_id,unit,num')->order('add_time desc')->paginate(1);
		
		//echo  Db::name("ck_insert")->getLastSql();die;
		
		$page = $materiel_info->render();
		$list = $materiel_info->items();
		$jsonStr = json_encode($materiel_info);
		$info = json_decode($jsonStr,true);
		$pages = $info['last_page'];
		
		foreach($list as $k=>$v){
			$list[$k]['add_time'] = date('Y-m-d H:i:s',$v['add_time']);
					
			//获取提交人信息
			$worker_info = Db::name("worker")->where('worker_id = '.$v['apply_worker'])->field('worker_name')->find();
			$list[$k]['apply_worker'] = $worker_info['worker_name']?$worker_info['worker_name']:'';
			$worker_cat_info = Db::name("materiel_category")->where('cat_id = '.$v['cat_id'])->field('cat_name,ck_id,type')->find();
 
			
			//根据cat_id判断是物料还是其他
			/*
			$worker_cat_info = Db::name("materiel_category")->where('cat_id = '.$v['cat_id'])->field('cat_name,ck_id,type')->find();
			if($worker_cat_info){
				if($worker_cat_info['type']=='0'){
					$worker_mate_info = Db::name("materiel")->where('m_id = '.$v['cat_child_id'])->field('m_name,m_no')->find();
					$materiel_info[$k]['cat_child_id'] = $worker_mate_info['m_name']?$worker_mate_info['m_name']:'';
					$materiel_info[$k]['m_no'] = $worker_mate_info['m_no']?$worker_mate_info['m_no']:'';
				}else{
					$worker_mate_info = Db::name("materiel_category")->where('cat_id = '.$v['cat_id'])->field('cat_name,cat_no')->find();
					$materiel_info[$k]['cat_child_id'] = $worker_mate_info['cat_name']?$worker_mate_info['cat_name']:'';
					$materiel_info[$k]['m_no'] = $worker_mate_info['cat_no']?$worker_mate_info['cat_no']:'';
				}
				$materiel_info[$k]['cat_name'] = $worker_cat_info['cat_name'];
				
			}*/
	
			
		}
		$page_list = array();
		$page_list['page'] = $page;
		$page_list['pages'] = $pages;
		$page_list['list'] = $list;
		
		$worker = $this->worker;
		$check = strstr($worker['node_str'],'29');
		$shen_worker = 1;
		if($check){
			$shen_worker = 2;
		}
		$check_new = strstr($worker['node_str'],'30');
		$bao_worker = 1;
		if($check_new){
			$bao_worker = 2;
		}
			
		
		return json([
			'status' => 1,
			'msg'    => "获取成功",
			'data'   => $page_list,
			'bao_worker'=>$bao_worker,
			'shen_worker'=>$shen_worker,
			 
		]);
		exit;
		
	}

	//批次列表
	public function leftover_batch(){

		$detail_id = request()->param('detail_id');
		$num = request()->param('num');

		if(!$detail_id){
			return json(['status'=>0,'msg'=>'备货详情id有误']);
		}
		if(!$num){
			return json(['status'=>0,'msg'=>'数量有误']);
		}
		$detail = explode(',',$detail_id);
		$arr1 = explode(',',$num);
		$arr = array();
		foreach($detail as $k=>$v){
			$m_id = Db::name('sell_batch_detail')->where('detail_id',$v)->value('m_id');
			$arr[$k] = $m_id; 
		}
		$array = array();
		foreach($arr as $k=>$v){
			$array[$k]['detail_id'] = $detail[$k];
			$array[$k]['m_id'] = $v;
			$array[$k]['m_name'] = Db::name('materiel')->where('m_id',$v)->value('m_name');
			$array1 = array();
			$array2 = array();
			$data = Db::name('ck_leftover')->where('materiel_id',$v)->where('usable_num','>',0)->order('id asc')->limit(1)->find();
			if($data){
				if($data['usable_num'] < $arr1[$k]){
					$array1[] = $data;
					if($data['next_batch']){	
						$array2 = $this->get_batch($data['next_batch'],$arr1[$k]-$data['usable_num']);
					}
					$array[$k]['info'][] = array_merge($array1,$array2);
				}else{
					$array[$k]['info'][] = $data;
				}
			}else{
				$array[$k]['info'] = array();
			}
		}
		$str = '';
		$arr2 = array();
		$str = str_replace(':null', ':""', json_encode($array));
		$arr2 = json_decode($str,'true');

		return(json(array('status'=>1,'msg'=>'查询成功','data'=>$arr2)));
	}

	//查询所需批次列表
	public function get_batch($next,$num){
		$next_batch = Db::name('ck_leftover')->where('batch_no',$next)->find();
		$array[] = $next_batch;
		while($next_batch['usable_num'] < $num){
			if($next_batch['next_batch']){
				$this->get_batch($next_batch['next_batch'],$num-$next_batch['usable_num']);
			}else{
				break;
			}
		}
		return $array;
	}

	//销售出库审核
	public function sale_check(){

		
		$id = $this->request->param('id');	//insert_id
		$type = $this->request->param('type');	//通过 1
		$reply = $this->request->param('reply')?$this->request->param('reply'):'';	//insert_id
		$batch = json_decode($this->request->param('batch'),true);
		$detail_id = $this->request->param('detail_id');
		if($type=='1'){
				
			$insert_info =  Db::name("ck_lingliao_detail")->where('ling_id = '.$id)->field('m_id,m_num')->select();
			if($insert_info){
				$i = 0;
				$str = '';
				foreach($insert_info as $k=>$v){
					$check_info =  Db::name("materiel")->where(" m_id = ".$v['m_id'])->field('num,m_name')->find();
					if($check_info && $check_info['num']>$v['m_num']){
						$i++;
					}else{
				 
						$str .= $check_info['m_name'].",";
					}
				}
				if($i == count($insert_info)){
					$re_info =  Db::name("ck_lingliao")->where("id=".$id)->update(array('status'=>1));
					$de_id = explode(',',$detail_id);
					foreach($de_id as $k=>$v){

						$info = Db::name("sell_batch_detail")->where('detail_id',$v)->field('order_id,m_id,m_num')->find();
						$data['order_id'] = $info['order_id'];
						$data['sell_bd_id'] = $v;
						$data['m_id'] = $info['m_id'];
						foreach($batch[$k] as $k1=>$v1){
							$num = Db::name('ck_leftover')->where('batch_no',$v1)->value('usable_num');
							$data['batch_no'] = $v1;
							if($num <= $info['m_num']){
								$data['num'] = $num;
								$info['m_num'] = $info['m_num'] - $num;
							}else{
								$data['num'] = $info['m_num'];
							}
							Db::name("sell_batch_detail_log")->insert($data);
							Db::name("ck_leftover")->where('batch_no',$v1)->setField('usable_num',$num-$data['num']);
						}
					}
					return json([
						'status' => 1,
						'msg'    => "审核通过",

					]);
					exit;
				}else{
					return json([
						'status' => 0,
						'msg'    => $str."库存不足",

					]);
					exit;
				}	
			}else{
				return json([
						'status' => 0,
						'msg'    => "查询无数据",

					]);
				exit;
			}
		}else{
			$re_info =  Db::name("ck_lingliao")->where("id=".$id)->update(array('status'=>2,'return_remarks'=>$reply));
			if($re_info){
				return json([
					'status' => 1,
					'msg'    => "审核未通过,已提交",

				]);
				exit;
			}else{
				return json([
					'status' => 0,
					'msg'    => "审核未通过,提交失败",
				]);
				exit;
			}
		}
	}

	/*销售发货--库管员添加信息  (库存修改、批次信息修改、出库修改)*/
	public function sell_deprot(){
		
		$batch_id = $this->request->param('batch_id');	//批次信息
		$id = $this->request->param('id');	//出库id
		$order_id = $this->request->param('order_id');	//出库id
		$detail_id = $this->request->param('detail_id');	//批次详情id
		
		$data['order_id'] = $this->request->param('order_id');	
		$data['type'] = $this->request->param('type');
		$data['car_clxh'] = $this->request->param('car_clxh'); //车辆型号
		$data['car_cp'] = $this->request->param('car_cp'); //车牌号
		$data['car_yslx'] = $this->request->param('car_yslx'); //运输类型
		$data['car_sjxm'] = $this->request->param('car_sjxm'); //司机姓名
		$data['car_lxfs'] = $this->request->param('car_lxfs'); //联系方式
		$data['car_kdgs'] = $this->request->param('car_kdgs'); //快递公司
		$data['car_kddh'] = $this->request->param('car_kddh'); //快递单号
		$data['pay_status'] = 2;
		$data['add_time'] = time();
		$data['real_time'] = time();
		$worker = $this->worker;
		$add_worker_id = $worker['worker_id'];
		$data['add_worker_id'] = $add_worker_id; //快递单号
		$data['submit_time'] =  substr($this->request->param('submit_time'),0,10); //预计时间
		
		//修改批次
		$batch_info =  Db::name("sell_batch")->where("batch_id=".$batch_id)->update($data);
		
		//修改领料
		$insert_info =  Db::name("ck_lingliao")->where('id = '.$id)->field('is_checked')->find();
		if($insert_info){
			
			if($insert_info['is_checked']=='1'){
				return json([
							'status' => 0,
							'msg'    => "数据已操作",

						]);
				exit;
			}
		}	
		$detail_info =  Db::name("ck_lingliao_detail")->where('ling_id = '.$id)->field('m_id,m_num')->select();
		if($detail_info){
			$i = 0;
			$str = '';
			foreach($detail_info as $k=>$v){
				$check_info =  Db::name("materiel")->where(" m_id = ".$v['m_id'])->field('num,m_name')->find();
				if($check_info && $check_info['num']>$v['m_num']){
					$i++;
				}else{
					$str .= $check_info['m_name'].",";
				}
			}
			if($i == count($detail_info)){
				$re_info =  Db::name("ck_lingliao")->where("id=".$id)->update(array('is_checked'=>1,'admin_worker'=>$this->worker['worker_id'])); //出库修改
				/*批量修改库存*/
				foreach($detail_info as $ke=>$va){
					
					$re =  Db::name("materiel")->where("m_id = ".$va['m_id'])->setDec('num',$va["m_num"]);	
					
				}
				$data1['io_id'] = $id;
				$data1['add_time'] = date('Y-m-d H:i:s',time());
				$ll = Db::name("ck_lingliao")->where("id=".$id)->field('apply_worker,remarks')->find();
				$data1['apply_worker'] = $ll['apply_worker'];
				$data1['ck_worker'] = $worker['worker_id'];
				$data1['remarks'] = $ll['remarks'];
				$data1['status'] = 4;
				$detail = explode(',',$detail_id);
				foreach($detail as $k=>$v){
					$sell = Db::name("sell_batch_detail_log")->where('sell_bd_id',$v)->field('batch_no,m_id,num')->select();
					foreach($sell as $k1=>$v1){
						$data1['batch_no'] = $v1['batch_no'];
						$data1['materiel_id'] = $v1['m_id'];
						$data1['num'] = $v1['num'];
						$href = Db::name("ck_insert_detail")->where('batch_no',$v1['batch_no'])->value('href');
						$data1['href'] = $href.'&&detail_id='.$v;
						Db::name("ck_out_detail")->insert($data1);
						$num = Db::name('ck_leftover')->where('batch_no',$v1['batch_no'])->value('leftover_num');
						Db::name("ck_leftover")->where('batch_no',$v1['batch_no'])->setField('leftover_num',$num - $v1['num']);
					}	
				}
				return json([
					'status' => 1,
					'msg'    => "发货成功",

				]);
				exit;
			}else{
				return json([
					'status' => 0,
					'msg'    => "发货失败",

				]);
				exit;
			}	
		}else{
			return json([
					'status' => 0,
					'msg'    => "查询无数据",

				]);
			exit;
		}

		
		
		
	}
}