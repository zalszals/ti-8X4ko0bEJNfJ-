<?php

namespace app\pc\controller;
use app\base\controller\Base;
use think\Db;
class Deprot extends Base{

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
			$row = 10;
			$page = $this->request->param('page');
			$materiel_info = array();

			if($page==1||!$page){
				$page = 0;
			}else{
				$page = ($page-1)*$row;
			}
			

			$status = $this->request->param('status')?$this->request->param('status'):'1';	//入库类型 1待审核 2未通过 3已通过 4已出库
			$keywords = $this->request->param('keywords');	//物料关键词
			$start_time = strtotime($this->request->param('start_time'));	//开始时间
			$end_time = strtotime($this->request->param('end_time'));	//结束时间
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
					$materiel_info[$k]['cat_child_id'] = implode(',',$arr);
					$materiel_info[$k]['cat_id'] = implode(',',$arr1);
					$materiel_info[$k]['materiel_desc'] = implode(',',$desc);
					$materiel_info[$k]['unit'] = $unit[0];
					$materiel_info[$k]['num'] = $num;
				}
			}
			$pages = ceil($count/$row);
			return json([
					'status' => 1,
					'msg'    => "获取成功",
					'count'    => $count,
					'pages'    => $pages,
					'data'   => $materiel_info,
					 
				]);
			exit;
			
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
		$start_time = strtotime($this->request->param('start_time'));	//开始时间
		$end_time = strtotime($this->request->param('end_time'));	//结束时间
 
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
		$pages = ceil($count/$row);
		
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
			'count'=>$count,
			'pages'=>$pages
		]);
		exit;
		
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
}