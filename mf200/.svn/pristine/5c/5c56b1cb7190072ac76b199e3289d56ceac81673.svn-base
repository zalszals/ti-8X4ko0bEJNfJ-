<?php

namespace app\sell\controller;
use app\base\controller\Base;
use think\Db;
class Sell extends Base{
	
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
 
	 * @return [type] [description]
	 */
	 			/**
     * [get_plan_sn 获取订单编号]
     * @return [type] [description]
     */
	private function get_insert_sn(){
		//获取变量
		$shijian = date('Ymd');//当天时间
		$con['plan_date'] = array('eq',$shijian);
		$number = Db::name('sell_order')->count();
		$number++;
		//填充0；str_pad()填充字符串；STR_PAD_LEFT:填充到字符串的左侧
		
		$numbered = str_pad($number,3,"0",STR_PAD_LEFT);
		 
		$plan_no = $shijian.$numbered;
		return $plan_no;
	}	
	//获取应付单编号
	private function get_pay_sn($style,$add_time){


		$shijian = date('Ymd',strtotime($add_time));//当天时间
		$start = date('Y-m-d 00:00:00',strtotime($add_time));
		$end = date('Y-m-d 24:00:00',strtotime($add_time));
		$con['add_time'] = array(['egt',$start],['elt',$end]);

		if($style == 1){
			$con['type'] = 1;
		}else{
			$con['type'] = 2;
		}
		$a_sn = Db::name('arap')->where($con)->column('a_sn');
		$number = Db::name('arap')->where($con)->count();

		if($a_sn){
			$arr = array();
	        foreach($a_sn as $k=>$v){
	           $arr[] = (int)substr($v,10);  
	        }
       		 $max = max($arr);
       	}else{
       		$max = 0;
       	}
        if($number == $max){
            $number++;
        }else{
            $number = $max + 1;
        }

        //填充0；str_pad()填充字符串；STR_PAD_LEFT:填充到字符串的左侧
		$numbered = str_pad($number,3,"0",STR_PAD_LEFT);
		if($style == 1){
			$a_no = 'AP'.$shijian.$numbered;
		}else{
			$a_no = 'AR'.$shijian.$numbered;
		}
		return $a_no;

	}
		/*
	获取分类   入库
	*/
	public function other_cat(){

		$return_info = Db::name("materiel_category")->where('status = 1  and type = 1')->field('cat_name,cat_id,ck_id')->select();
	
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

		$return_info = Db::name("materiel")->where('status = 1 and type = 1 and cat_id = '.$cat_id)->field('m_id,m_name,num')->select();
 
		return json([
			'status' => 1,
			'msg'    => "获取成功",
			'data'   => $return_info,
		]);
		exit;
	}
	/*根据客户姓名查询信息*/
	public function get_people(){
		$keywords = $this->request->param('keywords');	//物料关键词
		$return_info = array();
		if($keywords){
			$return_info = Db::name("customer")->where(' is_deleted = 1 and contact_person '.' like '."'%".$keywords."%'")->field('customer_id,contact_person,contact_name,contact_phone,address')->select();
		} 
 
 
		return json([
			'status' => 1,
			'msg'    => "获取成功",
			'data'   => $return_info,
		]);
		exit;
	}
	/*获取种植模式*/
	public function get_grwo_mode(){
		$mode_info = array();
		$mode_info = Db::name("grow_mode")->where('status = 1')->field('mode_id,mode_name')->select();
		return json([
			'status' => 1,
			'msg'    => "获取成功",
			'data'   => $mode_info,
		]);
		exit;
	}
	
	/*根据品种物料信息*/
	public function get_materiel(){
		
		
		$plat_from = $this->request->param('plat_from');	//物料关键词
		$plat_type = $this->request->param('plat_type');	//判读定制化订单
		if($plat_from){
			
			$task_info = Db::name("sell_task")->distinct(true)->where('status = 1')->field('m_id')->select();
			if($task_info){
				foreach($task_info as $k=>$v){
					$return_info = Db::name("materiel")->where(" m_id = ".$v['m_id'])->field('m_id,cat_id,m_name')->find();
					if($return_info){
						$task_info[$k]['cat_id'] = $return_info['cat_id'];
						$task_info[$k]['m_name'] = $return_info['m_name'];
					}
				}
				return json([
					'status' => 1,
					'msg'    => "获取成功",
					'data'   => $task_info,
				]);
				exit;
				
			}else{
				return json([
					'status' => 1,
					'msg'    => "获取成功",
					'data'   => $task_info,
				]);
				exit;
			}
			
		}else{
			if($plat_type){
			$task_info = Db::name("sell_task")->where('status = 1')->field('id,m_id,pick_time,margin_num')->select();
			if($task_info){
					foreach($task_info as $k=>$v){
						$pick_time =  date('Y-m-d',$v['pick_time']);
						$return_info = Db::name("materiel")->where(" m_id = ".$v['m_id'])->field('m_id,cat_id,m_name,unit')->find();
					 
						if($return_info){
							$task_info[$k]['sell_task_id'] = $v['id'];
							$task_info[$k]['cat_id'] = $return_info['cat_id'];
							$task_info[$k]['m_id'] = $return_info['m_id'];
							$task_info[$k]['m_name'] = $pick_time.'_'.$return_info['m_name'].'_'.$v['margin_num'];
						}
					}
					return json([
						'status' => 1,
						'msg'    => "获取成功",
						'data'   => $task_info,
					]);
					exit;
					
				}else{
					return json([
						'status' => 1,
						'msg'    => "获取成功",
						'data'   => $task_info,
					]);
					exit;
				}
				
			}else{
				$keywords = $this->request->param('keywords');	//物料关键词
				$return_info = array();
				if($keywords){
					$return_info = Db::name("materiel")->where("status = 1 and type = 1 and m_name like '%".$keywords."%'")->field('m_id,cat_id,m_name')->select();
				}else{
					$return_info = Db::name("materiel")->where("status = 1 and type = 1 ")->field('m_id,cat_id,m_name')->select();
				} 
		 
		 
				return json([
					'status' => 1,
					'msg'    => "获取成功",
					'data'   => $return_info,
				]);
				exit;
				
				
			}

			
		}
		

	}
	
 
	
	/*添加订单信息*/
	public function add_order(){

		
		$data['total_money'] = $this->request->param('total_money');	//总额
		$data['total_kg'] = $this->request->param('total_kg');	//总额
		$data['is_have'] = $this->request->param('is_have');	//总额
		$submit_time = $this->request->param('submit_time');	//发货日期
		$data['submit_time'] = substr($submit_time,0,10);
		$data['company_name'] = $this->request->param('company_name');	//公司名称
		$data['customer_id'] = $this->request->param('customer_id');	//公司名称
		$data['customer_name'] = $this->request->param('customer_name');	//客户姓名
		$data['customer_phone'] = $this->request->param('customer_phone');	//客户电话
		$data['customer_address'] = $this->request->param('customer_address');	//客户地址
		$data['ask_info'] = $this->request->param('ask_info');	//包装要求
		$data['other_ask'] = $this->request->param('other_ask');	//物流其他要求
		$data['add_time'] = time();	//添加时间
		$data['order_type'] =$this->request->param('order_type')?$this->request->param('order_type'):'5';	//类型
		$info_str = json_decode($this->request->param('info_str'),true);//负责人数组;	 
		$worker = $this->worker;
		$add_worker_id = $worker['worker_id'];
		$data['add_worker_id'] = $add_worker_id;	//负责人id
		$data['order_no'] = $this->get_insert_sn();	//编号
		
		$start_time = $this->request->param('start_time')?$this->request->param('start_time'):time();	//发货日期
		$data['start_time'] = substr($start_time,0,10);
		
		$end_time = $this->request->param('end_time')?$this->request->param('end_time'):time();	//发货日期
		$data['end_time'] = substr($end_time,0,10);
		$return_info = array();
 
 
		$re = Db::name('sell_order')->insertGetId($data);
		
		
		//添加财务信息
		
		$m_data['worker_id'] = $worker['worker_id'];
		$m_data['group_id'] = $worker['group_id'];
		$m_data['supply_id'] = $data['customer_id'];

		$m_data['num'] = $data['total_kg'];
		$m_data['sum'] = $data['total_money'];
		$m_data['pid'] = $re;
		$style = 2;
		$add_time = time();
		$m_data['add_time'] =  date('Y-m-d H:i:s',$add_time);
		$m_data['insert_time'] =  date('Y-m-d H:i:s',time());
		$m_data['a_sn'] = $this->get_pay_sn($style,$m_data['add_time']);

		$m_data['origin'] = 2;
		$m_data['type'] = 2;
		$a_id = Db::name('arap')->insertGetId($m_data);
		
		
		if($re && $a_id){
			foreach($info_str as $k=>$info){

				if($info[5]){
					$task_info = Db::name('sell_task')->where(' id = '.$info[5])->field('m_id,use_num')->find();
					if($task_info && $task_info['m_id'] == $info[1]){
						Db::name("sell_task")->where("id = ".$info[5])->setDec('use_num',$info[2]);
						Db::name("sell_task")->where("id = ".$info[5])->setDec('margin_num',$info[2]);
					}
				}
				$info_data['sell_task_id'] = $info[5];	//销售任务id	
				$info_data['mode_id'] = $info[6];	//模式id
					
				$info_data['order_id'] = $re;
				$info_data['cat_id'] = $info[0];	//分类id
				$info_data['m_id'] = $info[1];	//作物id
				$info_data['order_num'] = $info[2];	//数量
				$info_data['order_price'] = $info[3];	//单价	
				$info_data['all_money'] = $info[4];	//金额	
	
				$info_data['add_time'] = time();	//单价	
				$re_info = Db::name('sell_orinfo')->insertGetId($info_data);
				
				$m_info['a_id'] = $a_id;
				$m_info['m_id'] =  $info[1];
				$m_info['num'] =  $info[2];
				$m_info['price'] =  $info[3];
				$m_info['sum'] =  $info[4];
				$m_id = Db::name('arap_detail')->insert($m_info);
			}
		}
		

		if($re && $a_id){
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

	/*获取下单列表*/
	public function order_listwait(){
		
		$pc_form = $this->request->param('pc_form');
		if($pc_form){
			
			$row = 3;
			$page = $this->request->param('page');
	 
			
			if($page==1||!$page){
				$page = 0;
			}else{
				$page = ($page-1)*$row;
			}
			
			$type = $this->request->param('type')?$this->request->param('type'):'1';	//类别 1 待审批 2 已审批
			$check_status = $this->request->param('check_status');	//类别 1通过 2 不通过
			$company_name = $this->request->param('company_name');	//公司名字
			$order_type = $this->request->param('order_type')?$this->request->param('order_type'):'5';	//类别 育苗等
			
			$where = ' and 1 = 1';
			if($check_status){
				$where .=" and  check_status = ".$check_status;
			}
			if($company_name){
				$where .=" and  company_name like '%".$company_name."%'";
			}
			$worker_info = array();
			if($type=='1'){
				$worker_info = Db::name("sell_order")->where('order_type ='.$order_type.' and check_status = 0 '.$where)->field('total_money,order_no,company_name,add_worker_id,total_kg,is_have,add_time,check_status,order_id,add_time,start_time,end_time,submit_time,check_remark')->order('add_time desc')->paginate(1);
			}else{
		
				$worker_info = Db::name("sell_order")->where('order_type = '.$order_type.' and check_status != 0 '.$where)->field('total_money,order_no,is_have,add_worker_id,total_kg,company_name,add_time,check_status,order_id,add_time,start_time,end_time,submit_time,check_remark')->order('add_time desc')->paginate(1);
			}
			
		 	$page = $worker_info->render();
			$list = $worker_info->items();
			$jsonStr = json_encode($worker_info);
			$info = json_decode($jsonStr,true);
			$pages = $info['last_page'];
			
			if($list){
				foreach($list as $k=>$v){
					$list[$k]['add_time'] = date('Y-m-d',$v['add_time']);
					$list[$k]['start_time'] = date('Y-m-d',$v['start_time']);
					$list[$k]['end_time'] = date('Y-m-d',$v['end_time']);
					$list[$k]['submit_time'] = date('Y-m-d',$v['submit_time']);
					
					$name_str = '';
					//获取分类以及作物名
					$order_info = Db::name("sell_orinfo")->where('order_id = '.$v['order_id'])->field('cat_id,m_id,order_num,order_price')->select();
					foreach($order_info as $ke=>$va){
						$cat_info = Db::name("materiel_category")->where('cat_id = '.$va['cat_id'])->field('cat_name')->find();
						$materiel_info = Db::name("materiel")->where('m_id = '.$va['m_id'])->field('m_name')->find();
						
						$order_info[$ke]['cat_name'] = $cat_info['cat_name'];
						$order_info[$ke]['m_name'] = $materiel_info['m_name'];
						
						$name_str .=' '.$materiel_info['m_name'];
					}
					$list[$k]['name_str'] = $name_str;
					
					$list[$k]['order_info'] = $order_info;	
					//根据workerid查询负责人
					if($v['add_worker_id']){
						$check_people = Db::name("worker")->where('worker_id = '.$v['add_worker_id'])->field('worker_id,worker_name')->find();
						if($check_people){
							$list[$k]['add_worker_id'] = $check_people['worker_name'];
						}
					}else{
						$list[$k]['add_worker_id']='';
					}
					//获取来源
					if($v['is_have']=='1'){
						$list[$k]['have_name'] ='现有库存销售';
					}else{
						$list[$k]['have_name'] ='订单生产化';
					}
					
					
				}
			}
			$page_list = array();
			$page_list['page'] = $page;
			$page_list['pages'] = $pages;
			$page_list['list'] = $list;
			
			$worker = $this->worker;
			$check = strstr($worker['node_str'],'36');
			$shen_worker = 1;
			if($check){
				$shen_worker = 2;
			}
			
			
			
			return json([
				'status' =>1,
				'msg'    => "查询成功",
				'data'   => $page_list,
				'shen_worker'=>$shen_worker
				]);
			exit;
		
			
		}else{
			$row = 3;
			$page = $this->request->param('page');
	 
			
			if($page==1||!$page){
				$page = 0;
			}else{
				$page = ($page-1)*$row;
			}
			
			$type = $this->request->param('type')?$this->request->param('type'):'1';	//类别 1 待审批 2 已审批
			$check_status = $this->request->param('check_status');	//类别 1通过 2 不通过
			$company_name = $this->request->param('company_name');	//公司名字
			$order_type = $this->request->param('order_type')?$this->request->param('order_type'):'5';	//类别 育苗等
			
			$where = ' and 1 = 1';
			if($check_status){
				$where .=" and  check_status = ".$check_status;
			}
			if($company_name){
				$where .=" and  company_name like '%".$company_name."%'";
			}
			$worker_info = array();
			if($type=='1'){
				$count = Db::name("sell_order")->where('order_type = '.$order_type.' and check_status = 0 '.$where)->count();
				$worker_info = Db::name("sell_order")->where('order_type ='.$order_type.' and check_status = 0 '.$where)->field('total_money,order_no,company_name,add_worker_id,is_have,add_time,check_status,order_id,add_time,start_time,end_time,submit_time,check_remark')->order('add_time desc')->limit($page,$row)->select();
			}else{
				$count = Db::name("sell_order")->where('order_type = '.$order_type.' and check_status != 0 '.$where)->count();
				$worker_info = Db::name("sell_order")->where('order_type = '.$order_type.' and check_status != 0 '.$where)->field('total_money,order_no,is_have,add_worker_id,company_name,add_time,check_status,order_id,add_time,start_time,end_time,submit_time,check_remark')->order('add_time desc')->limit($page,$row)->select();
			}

		 
			
			if($worker_info){
				foreach($worker_info as $k=>$v){
					$worker_info[$k]['add_time'] = date('Y-m-d',$v['add_time']);
					$worker_info[$k]['start_time'] = date('Y-m-d',$v['start_time']);
					$worker_info[$k]['end_time'] = date('Y-m-d',$v['end_time']);
					$worker_info[$k]['submit_time'] = date('Y-m-d',$v['submit_time']);
					//获取分类以及作物名
					$order_info = Db::name("sell_orinfo")->where('order_id = '.$v['order_id'])->field('cat_id,m_id,order_num,order_price')->select();
					foreach($order_info as $ke=>$va){
						$cat_info = Db::name("materiel_category")->where('cat_id = '.$va['cat_id'])->field('cat_name')->find();
						$materiel_info = Db::name("materiel")->where('m_id = '.$va['m_id'])->field('m_name')->find();
						
						$order_info[$ke]['cat_name'] = $cat_info['cat_name'];
						$order_info[$ke]['m_name'] = $materiel_info['m_name'];
					}
					
					$worker_info[$k]['order_info'] = $order_info;	
					//根据workerid查询负责人
					if($v['add_worker_id']){
						$check_people = Db::name("worker")->where('worker_id = '.$v['add_worker_id'])->field('worker_id,worker_name')->find();
						if($check_people){
							$worker_info[$k]['add_worker_id'] = $check_people['worker_name'];
						}
					}else{
						$worker_info[$k]['add_worker_id']='';
					}
					
				}
			}
			
			return json([
				'status' =>1,
				'msg'    => "查询成功",
				'data'   => $worker_info,
				'count'=>$count
				]);
			exit;
			
			
			
		}
		
		
	}
	/*获取下单列表 详情*/
	public function order_infowait(){
		$order_id = $this->request->param('order_id')?$this->request->param('order_id'):1; 
		
		$worker_info = array();
		$worker_info = Db::name("sell_order")->where('order_id = '.$order_id)->field(
		'total_money,
		order_no,
		fzr_worker_id,
		is_have,
		total_kg,
		add_time,
		check_status,
		order_id,
		start_time,
		check_time,
		end_time,
		submit_time,
		check_remark,
		check_money,
		ask_info,
		company_name,
		customer_name,
		customer_phone,
		customer_address,
		other_ask')->find();
		$order_info = array();
		if($worker_info){
			
			$worker_info['add_time'] = date('Y-m-d',$worker_info['add_time']);
			$worker_info['start_time'] = date('Y-m-d',$worker_info['start_time']);
			$worker_info['end_time'] = date('Y-m-d',$worker_info['end_time']);
			$worker_info['submit_time'] = date('Y-m-d',$worker_info['submit_time']);
			$worker_info['check_time'] = date('Y-m-d',$worker_info['check_time']);
			
			
			$order_info = Db::name("sell_orinfo")->where('order_id = '.$worker_info['order_id'])->field('cat_id,m_id,all_money,order_num,order_price')->select();
			//根据workerid查询负责人
			if($worker_info['fzr_worker_id']){
				$check_people = Db::name("worker")->where('worker_id = '.$worker_info['fzr_worker_id'])->field('worker_id,worker_name')->find();
				if($check_people){
					$worker_info['fzr_worker_id'] = $check_people['worker_name'];
				}
			}else{
				$worker_info['fzr_worker_id']='';
			}

		}
		
		if($order_info){
			foreach($order_info as $ke=>$va){
				$cat_info = Db::name("materiel_category")->where('cat_id = '.$va['cat_id'])->field('cat_name')->find();
				$materiel_info = Db::name("materiel")->where('m_id = '.$va['m_id'])->field('m_name')->find();
				
				$order_info[$ke]['cat_name'] = $cat_info['cat_name'];
				$order_info[$ke]['m_name'] = $materiel_info['m_name'];
			}
			$worker_info['orinfo'] = $order_info;
		}else{
			$worker_info['orinfo'] = array();
		}
		$worker = $this->worker;
		$check = strstr($worker['node_str'],'36');
		$check_worker = 1;
		if($check){
			$check_worker = 2;
		}
		return json([
			'status' =>1,
			'msg'    => "查询成功",
			'data'   => $worker_info,
			'check_worker'=>$check_worker,
			 

			]);
		exit;
	}
	/*审核销售信息*/
	public function check_order(){
		$order_id = $this->request->param('order_id');	//insert_id
		$type = $this->request->param('type');	// 1 通过 2 不通过
		$check_remark = $this->request->param('check_remark')?$this->request->param('check_remark'):'';	//insert_id
		$check_money = $this->request->param('check_money')?$this->request->param('check_money'):'0.00';	//insert_id
		//$sell_all_money = $this->request->param('check_money')?$this->request->param('sell_all_money'):'0.00';	//销售已收金额
		//$sell_add_time =$this->request->param('sell_add_time')?substr($this->request->param('sell_add_time'),0,10); :'0';	//insert_id
		$check_time = time();
		$worker = $this->worker;
	    $worker_id= $worker['worker_id'];
		if($type=='1'){
			$order_info =  Db::name("sell_order")->where('order_id = '.$order_id)->find();
			if($order_info){
				$re_info =  Db::name("sell_order")->where("order_id=".$order_id)->update(array(
				'check_status'=>1,
				'fzr_worker_id'=>$worker_id,
				'check_remark'=>$check_remark,
				'check_time'=>$check_time,
				'check_money'=>$check_money
				));
				if($re_info){
					
					if($order_info['is_have']=='2'){
						//获取订单详情id
						$get_mid_info =  Db::name("sell_orinfo")->where('order_id = '.$order_info['order_id'])->field('m_id,cat_id,add_time,order_num')->select();
						
						if($get_mid_info){
							foreach($get_mid_info as $k=>$v){
								//添加到生产任务表
								$new_data['order_id'] = $order_info['order_id'];
								$new_data['order_no'] = $order_info['order_no'];
								$new_data['add_worker_id'] = $order_info['add_worker_id'];
								$new_data['submit_time'] = $order_info['submit_time'];
								$new_data['cat_id'] = $v['cat_id'];
						 
								$new_data['order_num'] = $v['order_num'];
								$new_data['add_time'] = $v['add_time'];
								$new_data['status'] = 0;
								$new_data['m_id'] = $v['m_id'];
								$res = Db::name('sell_product_task')->insert($new_data);
							}
						}
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
			$re_info =  Db::name("sell_order")->where("order_id=".$order_id)->update(array(
			'check_status'=>2,
			'fzr_worker_id'=>$worker_id,
			'check_remark'=>$check_remark,
			'check_time'=>$check_time,
			'check_money'=>$check_money
			));
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
	/*销售订单 --进行中*/
	public function sell_orderpi(){	
		$row = 3;
		$page = $this->request->param('page');
		$order_type = $this->request->param('order_type')?$this->request->param('order_type'):5;
		
		if($page==1||!$page){
			$page = 0;
		}else{
			$page = ($page-1)*$row;
		}
		
		$status = $this->request->param('status')?$this->request->param('status'):0;	//类别 0 进行中 1 已完成
		$worker_info = array();
		
		$where = " and 1 = 1 ";
		$company_name = $this->request->param('company_name');
		$start_time = substr($this->request->param('start_time'),0,10);
		$end_time =substr($this->request->param('end_time'),0,10);
		if($company_name){
			$where .= ' and company_name '.' like '."'%".$company_name."%'";
		}
		if($start_time){
			$where .= ' and add_time >'.$start_time;
		}
		if($end_time){
			$where .= ' and add_time <'.$end_time;
		}
		
		$count = Db::name("sell_order")->where('order_type = '.$order_type.' and check_status = 1  and status = '.$status.$where)->count();
		$worker_info = Db::name("sell_order")->where('order_type = '.$order_type.' and check_status = 1  and status = '.$status.$where)->field('order_id,order_no,is_have,check_money,add_worker_id,add_time,company_name,total_kg,total_money')->order('add_time desc')->limit($page,$row)->select();
		//echo Db::name("sell_order")->getLastSql();die;

		if($worker_info){
			foreach($worker_info as $k=>$v){
				$worker_info[$k]['add_time'] = date('Y-m-d',$v['add_time']);
				//获取分类以及作物名
				$order_info = Db::name("sell_orinfo")->where('order_id = '.$v['order_id'])->field('cat_id,m_id,order_num,order_price,all_money')->select();
				$m_name = array();
				foreach($order_info as $ke=>$va){
		 
					$materiel_info = Db::name("materiel")->where('m_id = '.$va['m_id'])->field('m_name')->find();
					
					$order_info[$ke]['m_new_name'] = $materiel_info['m_name'];
					if(in_array($materiel_info['m_name'],$m_name)){
						
					}else{
						array_push($m_name,$materiel_info['m_name']);
					} 
				}
				
				$worker_info[$k]['order_info'] = $order_info;	
				$worker_info[$k]['m_name'] = implode(',',$m_name);
				

				$all_sum = 0;
				$dai_sum = 0;
				$yi_sum = 0;
				$check_num = 0;
				$bei_sum = 0;

 
				$all_sum = Db::name('sell_batch')->alias('sell')
				->join('sell_batch_detail de','sell.batch_id = de.batch_id','LEFT')      
				 ->where('sell.order_id = '.$v['order_id']." and pay_status = 3")
				 ->sum("m_num");
 
 					 
				$bei_sum = Db::name('sell_batch')->alias('sell')
				->join('sell_batch_detail de','sell.batch_id = de.batch_id','LEFT')      
				 ->where('sell.order_id = '.$v['order_id']." and pay_status < 3 ")
				 ->sum("m_num");	 

 
			
			
				/*
				$re_check = Db::name('group')->where('group_id',4)->find();
				if($re_check && $re_check['is_buy']=='1'){

					$check_num = Db::name('ck_lingliao')->alias('m')
					->join('ck_lingliao_detail de','m.id = de.ling_id','LEFT')      
					 ->where('sell_id = '.$v['order_id']." and status = 2")
					 ->sum("m_num");
					
					$dai_sum = Db::name('ck_lingliao')->alias('m')
					->join('ck_lingliao_detail de','m.id = de.ling_id','LEFT')      
					 ->where('sell_id = '.$v['order_id']." and status = 1")
					 ->sum("m_num");

				}else{				
		 
					$dai_info = Db::name("sell_batch")->where('order_id = '.$v['order_id']." and pay_status = 1")->field('batch_id')->find();
					if($dai_info){
						$dai_sum = Db::name("sell_batch_detail")->where('batch_id = '.$dai_info['batch_id'])->sum('m_num');
					}
					
				}
				*/
				
				

				$worker_info[$k]['bei_sum'] = $bei_sum;
				$worker_info[$k]['all_sum'] = $all_sum;
				//根据workerid查询负责人
				if($v['add_worker_id']){
					$check_people = Db::name("worker")->where('worker_id = '.$v['add_worker_id'])->field('worker_id,worker_name')->find();
					if($check_people){
						$worker_info[$k]['add_worker_id'] = $check_people['worker_name'];
					}
				}else{
					$worker_info[$k]['add_worker_id']='';
				}
				
				//获取已付金额
				$arap_info = Db::name("arap")->where('origin = 2 and pid = '.$v['order_id'])->field('a_id')->find();
				if($arap_info && $arap_info['a_id']){
					$cash_info = Db::name("arap_cash")->where('a_id = '.$arap_info['a_id'])->field('money')->find();
					if($cash_info && $cash_info['money']){
						$worker_info[$k]['cash_money'] =  $cash_info['money'];
					}else{
						$worker_info[$k]['cash_money'] = 0;
					}
				}
				
			}
		}
	
		return json([
			'status' =>1,
			'msg'    => "查询成功",
			'data'   => $worker_info,
			'count'=>$count
			]);
		exit;
	}
	/*销售订单--确认完成*/
	public function sell_success(){
		$order_id = $this->request->param('order_id');
		if(!$order_id){
			return json([
				'status' =>0,
				'msg'    => "参数错误",
				]);
			exit;
		}
		
		$worker = $this->worker;
		$add_worker_id = $worker['worker_id'];
 
		
		$re =  Db::name('sell_order')->where('order_id = '.$order_id)->update(array('status'=>1));
 
		return json([
		'status' =>1,
		'msg'    => "确认完成",
		]);
		exit;
 
		
		
		
	}
	
	/*销售订单--备货详情*/
	public function sell_choice(){
		$order_id = $this->request->param('order_id');
		if(!$order_id){
			return json([
				'status' =>0,
				'msg'    => "参数错误",
				]);
			exit;
		}
		$order_info = array();
		$order_info =  Db::name("sell_order")->where('order_id = '.$order_id)->field(
			'is_have,
			order_no,
			total_money,
			true_money,
			check_money,
			add_time,
			order_id,
			ask_info,
			company_name,
			customer_name,
			customer_phone,
			customer_address,
			other_ask'
		)->find();
		if($order_info){
			$order_info['add_time'] = date('Y-m-d',$order_info['add_time']);
			$orinfo_info = Db::name("sell_orinfo")->where('order_id = '.$order_info['order_id'])->field('cat_id,m_id,order_num')->select();
			if($orinfo_info){
				foreach($orinfo_info as $ke=>$va){
		
					$materiel_info = Db::name("materiel")->where('m_id = '.$va['m_id'])->field('m_name')->find();
	
					$orinfo_info[$ke]['m_name'] = $materiel_info['m_name'];
				
				}
				$order_info['order_detail'] = $orinfo_info;
				$order_info['count_info'] = count($orinfo_info);
				
				//获取实际付款比例
				$true_remark = $order_info['true_money']/$order_info['total_money']*100;
				
				$order_info['true_remark'] = sprintf("%.2f", $true_remark);
				
			}
			
		}
		
		
		//判断有没有购买仓库
		$re_check = Db::name('group')->where('group_id',4)->find();
		if($re_check && $re_check['is_buy']=='1'){
			$check_materiel = 1;
		}else{
			$check_materiel = 0;
		}
		return json([
			'status' =>1,
			'msg'    => "查询成功",
			'data'   => $order_info,
			'check_materiel'=>$check_materiel
 
			]);
		exit;
			
	}
	/*销售订单 添加批次*/
	public function add_order_pi(){
		
 
	
		$check_materiel = $this->request->param('check_materiel'); //判断是否购买仓库
		$company_name = $this->request->param('company_name'); //公司名
		if($check_materiel=='1'){
			$data['order_id'] = $this->request->param('order_id');
			$data['type'] = $this->request->param('type');
			
			$worker = $this->worker;
			$add_worker_id = $worker['worker_id'];
			$data['add_worker_id'] = $add_worker_id; //快递单号
			
			$data['add_time'] = time();
			$data['real_time'] = time();
			$data['pay_status'] =1;
			
			$info_str = json_decode($this->request->param('info_str'),true);//作物信息;
			$batch_id = Db::name('sell_batch')->insertGetId($data);//批次表
			
			
			/*添加到仓库 出库表*/
			$ling_info['type'] = 5;
			$ling_info['lingliao_sn'] = $this->get_lingliao_sn();
			$ling_info['apply_worker'] = $add_worker_id;
			$ling_info['add_time'] = time();
			$ling_info['sell_id'] = $data['order_id'];
			$ling_info['batch_id'] = $batch_id;
			$ling_info['company_name'] = $company_name;

			$lingliao_re= Db::name("ck_lingliao")->insertGetId($ling_info);
					
			if($batch_id){
				$info_data = array();
				foreach($info_str as $k=>$info){
					$info_data['batch_id'] = $batch_id;
					$info_data['order_id'] = $this->request->param('order_id');
					$info_data['cat_id'] = $info[0];	//分类id
					$info_data['m_id'] = $info[1];	//作物id
					$info_data['m_num'] = $info[2];	//数量
					$info_data['add_time'] =time();	//时间
					$re_info = Db::name('sell_batch_detail')->insertGetId($info_data);

					//添加到仓库 领料表
					//获取category表信息  ck_id等
					$cat_info_find = Db::name('materiel_category')->field('ck_id')->where('cat_id = '.$info[0])->find();
					//获取物料信息
					$m_find = Db::name('materiel')->field('price,cat_id,m_desc,unit,m_no,m_name')->where('m_id = '.$info[1])->find();
					
					/*销售临时加详情表*/
					
					$detail_info['ling_id'] = $lingliao_re;
					$detail_info['batch_id'] = $batch_id;
					$detail_info['order_id'] = $this->request->param('order_id');
					$detail_info['cat_id'] =  $info[0];
					$detail_info['m_id'] =  $info[1];
					$detail_info['m_num'] =  $info[2];
					$detail_info['add_time'] = time();
					
					$re_info = Db::name('ck_lingliao_detail')->insertGetId($detail_info);
					
				}
			}
			//$re =  Db::name('sell_order')->where('order_id = '.$data['order_id'])->update(array('status'=>1));
			return json([
				'status' =>1,
				'msg'    => "添加成功",
	 
	 
				]);
			exit;
			
		}else{
			$data['order_id'] = $this->request->param('order_id');
			$data['type'] = $this->request->param('type');
			$data['car_clxh'] = $this->request->param('car_clxh'); //车辆型号
			$data['car_cp'] = $this->request->param('car_cp'); //车牌号
			$data['car_yslx'] = $this->request->param('car_yslx'); //运输类型
			$data['car_sjxm'] = $this->request->param('car_sjxm'); //司机姓名
			$data['car_lxfs'] = $this->request->param('car_lxfs'); //联系方式
			$data['car_kdgs'] = $this->request->param('car_kdgs'); //快递公司
			$data['car_kddh'] = $this->request->param('car_kddh'); //快递单号
			$data['submit_time'] =  substr($this->request->param('submit_time'),0,10); //预计时间
			
			$worker = $this->worker;
			$add_worker_id = $worker['worker_id'];
			$data['add_worker_id'] = $add_worker_id; //快递单号
			
			$data['add_time'] = time();
			$data['real_time'] = time();
			$data['pay_status'] =2;
			
			$info_str = json_decode($this->request->param('info_str'),true);//作物信息;
			
			
			$batch_id = Db::name('sell_batch')->insertGetId($data);//批次表
			if($batch_id){
				foreach($info_str as $k=>$info){
					$info_data['batch_id'] = $batch_id;
					$info_data['order_id'] = $this->request->param('order_id');
					$info_data['cat_id'] = $info[0];	//分类id
					$info_data['m_id'] = $info[1];	//作物id
					$info_data['m_num'] = $info[2];	//数量
					$info_data['add_time'] =time();	//数量
					$re_info = Db::name('sell_batch_detail')->insertGetId($info_data);				
				}
			}
			//$re =  Db::name('sell_order')->where('order_id = '.$data['order_id'])->update(array('status'=>1));
			return json([
				'status' =>1,
				'msg'    => "添加成功",
	 
	 
				]);
			exit;
		}
		
		

	}
	/*销售订单 --订单详情*/
	public function add_order_info(){
		$order_id = $this->request->param('order_id');
		$worker_info = array();
		$worker_info = Db::name("sell_order")->where('order_id = '.$order_id)->field(
		'is_have,
		add_time,
		total_kg,
		total_money,
		check_time,
		check_status,
		order_id,
		start_time,
		end_time,
		submit_time,
		check_remark,
		check_money,
		ask_info,
		company_name,
		customer_name,
		customer_phone,
		customer_address,
		fzr_worker_id,
		other_ask')->find();
		if($worker_info){
			$check_people = Db::name("worker")->where('worker_id = '.$worker_info['fzr_worker_id'])->field('worker_id,worker_name')->find();
			if($check_people){
				$worker_info['check_people'] = $check_people['worker_name'];
			}
		}
		
		$check_pi = array();
		//获取所有批次
		$check_pi = Db::name("sell_batch")->where('order_id = '.$order_id)->field('batch_id,add_time,pay_status')->select();
		if($check_pi){
			foreach($check_pi as $k=>$v){
				$check_pi[$k]['num'] = Db::name("sell_batch_detail")->where('batch_id = '.$v['batch_id'])->sum('m_num');
				$check_pi[$k]['add_time'] = date('Y-m-d',$v['add_time']);
				
			}
		}
		$worker_info['pici_info'] = $check_pi;
		$worker_info['add_time'] =date('Y-m-d',$worker_info['add_time']);
		$worker_info['start_time'] =date('Y-m-d',$worker_info['start_time']);
		$worker_info['end_time'] =date('Y-m-d',$worker_info['end_time']);
		$worker_info['submit_time'] =date('Y-m-d',$worker_info['submit_time']);
		$worker_info['check_time'] =date('Y-m-d',$worker_info['check_time']);
		
		
		//获取分类以及作物名
		$name_str = '';
		$order_info = Db::name("sell_orinfo")->where('order_id = '.$order_id)->field('cat_id,m_id,order_num,order_price')->select();
		foreach($order_info as $ke=>$va){
			$materiel_info = Db::name("materiel")->where('m_id = '.$va['m_id'])->field('m_name')->find();
			$name_str .=' '.$materiel_info['m_name'];
		}
		$worker_info['name_str'] = $name_str;
					
		
		
		//判断有没有购买仓库
		$re_check = Db::name('group')->where('group_id',4)->find();
		if($re_check && $re_check['is_buy']=='1'){
			$worker_info['check_materiel'] = 1;
		}else{
			$worker_info['check_materiel'] = 0;
		}
		
			return json([
			'status' =>1,
			'msg'    => "查询成功",
			'data' =>$worker_info
 
 
			]);
		exit;
		
	}
	

	/*销售订单 --供货详情*/
	public function add_piorder_info(){
		$batch_id = $this->request->param('batch_id');
		$worker_info = array();
		$worker_info = Db::name("sell_batch")->where('batch_id = '.$batch_id)->field(
		'type,
		pay_status,
		add_worker_id,
		submit_time,
		real_time,
		car_clxh,
		car_cp,
		car_yslx,
		car_sjxm,
		car_lxfs,
		car_kdgs,
		car_kddh
		')->find();
		if($worker_info){
			$worker_info['submit_time'] = date('Y-m-d',$worker_info['submit_time']);
			$worker_info['real_time'] = date('Y-m-d',$worker_info['real_time']);
			
			$check_people = Db::name("worker")->where('worker_id = '.$worker_info['add_worker_id'])->field('worker_id,worker_name')->find();
			if($check_people){
				$worker_info['add_people'] = $check_people['worker_name'];
			}
		}
		
		$check_pi = array();
		//获取所有批次
		$check_pi = Db::name("sell_batch_detail")->where('batch_id = '.$batch_id)->field('m_id,m_num')->select();
		if($check_pi){
			foreach($check_pi as $k=>$v){
 
				 $materiel_info = Db::name("materiel")->where('m_id = '.$v['m_id'])->field('m_name')->find();
				 if($materiel_info){
					 $check_pi[$k]['m_name'] = $materiel_info['m_name'];
				 }
				
			}
		}
		$worker_info['pici_info'] = $check_pi;
		
			return json([
			'status' =>1,
			'msg'    => "查询成功",
			'data' =>$worker_info
 
 
			]);
		exit;
 
	}
	
	/*销售订单 --供应管理*/
	public function sell_fill(){	
		$row = 3;
		$page = $this->request->param('page');
		$pay_status = $this->request->param('pay_status')?$this->request->param('pay_status'):2; //2待收货 3 已收货 
		
		if($page==1||!$page){
			$page = 0;
		}else{
			$page = ($page-1)*$row;
		}
 
		$worker_info = array();
		
		$where = " ba.pay_status = ".$pay_status;
		$company_name = $this->request->param('company_name');
		//$m_name = $this->request->param('m_name');
		$start_time = substr($this->request->param('start_time'),0,10);
		$end_time =substr($this->request->param('end_time'),0,10);
		if($company_name){
			$where .= ' and ord.company_name '.' like '."'%".$company_name."%'";
		}
		if($start_time){
			$where .= ' and ba.add_time >'.$start_time;
		}
 		if($end_time){
			$where .= ' and ba.add_time <'.$end_time;
		}
 
 		$count = Db::name('sell_batch')->alias('ba')
		->join('sell_order ord','ba.order_id = ord.order_id','LEFT')
		//->join('sell_batch_detail de','de.batch_id = ba.batch_id','LEFT')                                       
		//->join('materiel ma','ma.m_id = de.m_id','LEFT')                                       
		 ->where($where)
		 ->count();
		
		$materiel_list = Db::name('sell_batch')->alias('ba')
		->field('ord.is_have,ba.add_time,ord.add_worker_id,ord.company_name,ord.order_no,ba.real_time,ba.batch_id,ord.order_id,ord.add_time as sell_time')
		->join('sell_order ord','ba.order_id = ord.order_id','LEFT')
		//->join('sell_batch_detail de','de.batch_id = ba.batch_id','LEFT')                                       
		//->join('materiel ma','ma.m_id = de.m_id','LEFT')                                       
		 ->where($where)
		 ->limit($page,$row)
		 ->select();
		// echo Db::name('sell_batch')->getLastSql();die;
		if($materiel_list){
			foreach($materiel_list as $k=>$v){
				$materiel_list[$k]['add_time'] = date('Y-m-d',$v['add_time']);
				$materiel_list[$k]['real_time'] = date('Y-m-d',$v['real_time']);
				$materiel_list[$k]['sell_time'] = date('Y-m-d',$v['sell_time']);
				
				//查询批次详情信息
				$check_pi = array();
				$check_pi = Db::name("sell_batch_detail")->where('batch_id = '.$v['batch_id'])->field('m_id,m_num')->select();
				if($check_pi){
					foreach($check_pi as $ke=>$va){
						 $materiel_info = Db::name("materiel")->where('m_id = '.$va['m_id'])->field('m_name')->find();
						 if($materiel_info){
							$check_pi[$ke]['m_name'] = $materiel_info['m_name'];
							//获取单价
							$new_order_id = $v['order_id'];
							$new_m_id = $va['m_id'];
							
							$check_orinfo = Db::name("sell_orinfo")->where('order_id = '.$new_order_id.' and m_id = '.$new_m_id)->field('order_price')->find();
							if($check_orinfo){
								$check_pi[$ke]['order_price'] = $check_orinfo['order_price'];
							}else{
								$check_pi[$ke]['order_price'] = 0;
							}
							
						 }else{
							$check_pi[$ke]['m_name'] = '';
							//获取单价
							$new_order_id = $v['order_id'];
							$new_m_id = $va['m_id'];
							
							$check_orinfo = Db::name("sell_orinfo")->where('order_id = '.$new_order_id.' and m_id = '.$new_m_id)->field('order_price')->find();
							if($check_orinfo){
								$check_pi[$ke]['order_price'] = $check_orinfo['order_price'];
							}else{
								$check_pi[$ke]['order_price'] = 0;
							}
						 }
					}
				}
				$materiel_list[$k]['orinfo'] = $check_pi;
				//根据workerid查询负责人
				if($v['add_worker_id']){
					$check_people = Db::name("worker")->where('worker_id = '.$v['add_worker_id'])->field('worker_id,worker_name')->find();
					if($check_people){
						$materiel_list[$k]['add_worker_id'] = $check_people['worker_name'];
					}
				}else{
					$materiel_list[$k]['add_worker_id']='';
				}
			}
		}
		return json([
			'status' =>1,
			'msg'    => "查询成功",
			'data'=>$materiel_list,
			'count'=>$count,
		 
			]);
		exit;
	}
	
	/*供应管理---详情*/
	public function sell_fill_detail(){
		$batch_id = $this->request->param('batch_id');
		$order_id = $this->request->param('order_id');
		
		//查询批次详情信息
		$check_pi = array();
		$check_pi = Db::name("sell_batch_detail")->where('batch_id = '.$batch_id)->field('m_id,m_num')->select();
		
		 
		if($check_pi){
			foreach($check_pi as $ke=>$va){
				 $materiel_info = Db::name("materiel")->where('m_id = '.$va['m_id'])->field('m_name')->find();
				 if($materiel_info){
					$check_pi[$ke]['m_name'] = $materiel_info['m_name'];
					//获取单价
					$new_order_id = $order_id;
					$new_m_id = $va['m_id'];
 
					$check_orinfo = Db::name("sell_orinfo")->where('order_id = '.$new_order_id.' and m_id = '.$new_m_id)->field('order_price')->find();
				 
					if($check_orinfo){
						$check_pi[$ke]['order_price'] = $check_orinfo['order_price'];
					}else{
						$check_pi[$ke]['order_price'] = 0;
					}
					
				 }
			}
		}
		//获取批次信息
		$worker_info = Db::name("sell_batch")->where('batch_id = '.$batch_id)->field(
		'type,
		batch_id,
		pay_status,
		add_worker_id,
		add_time,
		submit_time,
		real_time,
		car_clxh,
		car_cp,
		car_yslx,
		car_sjxm,
		car_lxfs,
		car_kdgs,
		car_kddh
		')->find();
		if($worker_info){
			$worker_info['add_time'] = date('Y-m-d',$worker_info['add_time']);
			$worker_info['submit_time'] = date('Y-m-d',$worker_info['submit_time']);
			$worker_info['real_time'] = date('Y-m-d',$worker_info['real_time']);
			
			$check_people = Db::name("worker")->where('worker_id = '.$worker_info['add_worker_id'])->field('worker_id,worker_name')->find();
			if($check_people){
				$worker_info['add_people'] = $check_people['worker_name'];
			}
			
			$worker_info['check_pi'] = $check_pi;
			//获取订单收货方
			$order_info = Db::name("sell_order")->where('order_id = '.$order_id)->field(
			'is_have,
			add_time as sell_time,
			check_remark,
			check_money,
			ask_info,
			company_name,
			customer_name,
			customer_phone,
			customer_address,
			other_ask')->find();
			if($order_info){
				$worker_info['sell_time'] =date('Y-m-d',$order_info['sell_time']);
				$worker_info['is_have'] = $order_info['is_have'];
				if($order_info['is_have']=='1'){
					$worker_info['is_have_new'] = '现有销售';
				}else{
					$worker_info['is_have_new'] = '订单销售';
				}
				$worker_info['check_remark'] = $order_info['check_remark'];
				$worker_info['check_money'] = $order_info['check_money'];
				$worker_info['ask_info'] = $order_info['ask_info'];
				$worker_info['company_name'] = $order_info['company_name'];
				$worker_info['customer_name'] = $order_info['customer_name'];
				$worker_info['customer_phone'] = $order_info['customer_phone'];
				$worker_info['customer_address'] = $order_info['customer_address'];
				$worker_info['other_ask'] = $order_info['other_ask'];
			}
			
			
		}
		return json([
			'status' =>1,
			'msg'    => "查询成功",
			'data'=>$worker_info,
	 
		 
			]);
		exit;
	}
	/*供应管理---确认收货*/
	public function check_batch(){
		$worker = $this->worker;
		$add_worker_id = $worker['worker_id'];
		$batch_id = $this->request->param('batch_id');
		
		$re =  Db::name('sell_batch')->where('batch_id = '.$batch_id)->update(array('pay_status'=>3,'pay_worker_id'=>$add_worker_id));
 
		return json([
		'status' =>1,
		'msg'    => "已经收货",
		]);
		exit;
 
	}
	/*客户管理--添加*/
	public function add_customer(){
		$data['company_name'] = $this->request->param('company_name');  //公司名称
		$data['bank_name'] = $this->request->param('bank_name'); //开户银行
		$data['bank_no'] = $this->request->param('bank_no'); //银行账号
		$data['register_no'] = $this->request->param('register_no'); //纳税人识别码
		$data['register_phone'] = $this->request->param('register_phone'); //注册电话
		$data['register_address'] = $this->request->param('register_address'); //注册地址
		
		
		$data['contact_person'] = $this->request->param('contact_person'); //客户联系人
		$data['contact_phone'] = $this->request->param('contact_phone');  //客户电话
		$data['address'] = $this->request->param('address');  //客户电话
		
		$data['add_time'] = time();  
		
		$re=Db::name('customer')->insert($data); 
		if($re){
			return json([
			'status' =>1,
			'msg'    => "添加成功",
			]);
			exit;
		}

		
	}
	
	/*客户管理--修改*/
	public function edit_customer(){
		$customer_id = $this->request->param('customer_id');  //id
		$data['company_name'] = $this->request->param('company_name');  //公司名称
		$data['bank_name'] = $this->request->param('bank_name'); //开户银行
		$data['bank_no'] = $this->request->param('bank_no'); //银行账号
		$data['register_no'] = $this->request->param('register_no'); //纳税人识别码
		$data['register_phone'] = $this->request->param('register_phone'); //注册电话
		$data['register_address'] = $this->request->param('register_address'); //注册地址
		
		
		$data['contact_person'] = $this->request->param('contact_person'); //客户联系人
		$data['contact_phone'] = $this->request->param('contact_phone');  //客户电话
		$data['address'] = $this->request->param('address');  //客户电话
		
		 $re =  Db::name('customer')->where('customer_id = '.$customer_id)->update($data);
		return json([
		'status' =>1,
		'msg'    => "修改成功",
		]);
		exit;
 
	}
	/*客户管理 ---列表*/
	public function list_customer(){
		
		$row = 3;
		$page = $this->request->param('page');
 
		
		if($page==1||!$page){
			$page = 0;
		}else{
			$page = ($page-1)*$row;
		}
		
		$contact_phone = $this->request->param('contact_phone');	//电话
		$contact_person = $this->request->param('contact_person');	 //联系人
		$company_name = $this->request->param('company_name');	//公司名字
	 
		
		$where = '  is_deleted = 1';
 
		if($company_name){
			$where .=" and  company_name like '%".$company_name."%'";
		}
		
		if($contact_person){
			$where .=" and  contact_person like '%".$contact_person."%'";
		}
		
		if($contact_phone){
			$where .=" and  contact_phone like '%".$contact_phone."%'";
		}
		$worker_info = array();
		 
		$count = Db::name("customer")->where($where)->count();
		$worker_info = Db::name("customer")->where($where)->select();
		//$worker_info = Db::name("sell_order")->where('order_type ='.$order_type.' and check_status = 0 '.$where)->field('total_money,company_name,is_have,add_time,check_status,order_id,add_time,start_time,end_time,submit_time,check_remark')->order('add_time desc')->limit($page,$row)->select();

		return json([
			'status' =>1,
			'msg'    => "查询成功",
			'data'   => $worker_info,
			'count'=>$count
			]);
		exit;
		
	}
		
	/*客户管理--删除*/
	public function delete_customer(){
		$customer_id = $this->request->param('customer_id');  //id

		 $re =  Db::name('customer')->where('customer_id = '.$customer_id)->update(array('is_deleted'=>2));
		return json([
		'status' =>1,
		'msg'    => "删除成功",
		]);
		exit;
	}
	/*销售报表--列表*/
	public function sell_excel(){
		
		$info = array();
		$info = Db::name("sell_orinfo")->field(
		' MIN( order_price ) AS min_price,
		m_id,
		MAX( order_price ) AS max_price, 
		cast(avg(order_price) as decimal(10,2)) as avg_price,
		 SUM( order_num ) as all_num, 
		 SUM( all_money )  as all_money
		'
		)->group('m_id')->select();
		
		foreach($info as $k=>$v){
			$materiel_info = Db::name("materiel")->where('m_id = '.$v['m_id'])->field('m_name')->find();
			if($materiel_info){
				$info[$k]['m_name'] = $materiel_info['m_name'];
			}
		}
		 return json([
			'status' =>1,
			'msg'    => "查询成功",
			'data' =>$info
		]);
		exit;
	}
 
 	/*销售发货--库管员添加信息  (库存修改、批次信息修改、出库修改)*/
	public function sell_deprot(){
		
		$batch_id = $this->request->param('batch_id');	//批次信息
		$id = $this->request->param('id');	//出库id
		$order_id = $this->request->param('order_id');	//出库id
		
		
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
				$re_info =  Db::name("ck_lingliao")->where("id=".$id)->update(array('is_checked'=>1)); //出库修改
				/*批量修改库存*/
				foreach($detail_info as $ke=>$va){
					
					$re =  Db::name("materiel")->where("m_id = ".$va['m_id'])->setDec('num',$va["m_num"]);	
					
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
	 /*pc端 临时添加虚拟表*/
	public function sell_Add(){
		
		$data['num'] = $this->request->param('num');	 
		$data['cat_id'] = $this->request->param('cat_id');	 
		$data['m_id'] = $this->request->param('m_id');	 
		$data['cat_name'] = $this->request->param('cat_name');	 
		$data['num'] = $this->request->param('num');	 
		$data['price'] = $this->request->param('price');	 
		$data['money'] = $this->request->param('money');	
		$worker = $this->worker;
		$add_worker_id = $worker['worker_id'];
		$data['add_worker_id'] = $add_worker_id;
		
		$re = Db::name('sell_add')->insert($data);
		
		$return_info =  Db::name("sell_add")->where('add_worker_id = '.$add_worker_id)->select();
		$count_sum =  Db::name("sell_add")->where('add_worker_id = '.$add_worker_id)->field('sum(num) as count_sum')->find();
		$count_money =  Db::name("sell_add")->where('add_worker_id = '.$add_worker_id)->field('sum(money) as count_money')->find();
		
		$return_data['return_info'] = $return_info;
		$return_data['count_sum'] = $count_sum['count_sum'];
		$return_data['count_money'] = $count_money['count_money'];
		return json([
			'status' => 1,
			'msg'    => "查询成功",
			'data'   =>$return_data

		]);
		exit;
 
	}
		/*pc端 临时虚拟表列表*/
	public function sell_Addlist(){
 	
		$worker = $this->worker;
		$add_worker_id = $worker['worker_id'];
 
		$return_info =  Db::name("sell_add")->where('add_worker_id = '.$add_worker_id)->select();
		$count_sum =  Db::name("sell_add")->where('add_worker_id = '.$add_worker_id)->field('sum(num) as count_sum')->find();
		$count_money =  Db::name("sell_add")->where('add_worker_id = '.$add_worker_id)->field('sum(money) as count_money')->find();
		
		$return_data['return_info'] = $return_info;
		$return_data['count_sum'] = $count_sum['count_sum'];
		$return_data['count_money'] = $count_money['count_money'];
		return json([
			'status' => 1,
			'msg'    => "查询成功",
			'data'   =>$return_data

		]);
		exit;
 
	}
	/*pc端 删除虚拟表*/
	public function delAdd(){
		$worker = $this->worker;
		$add_worker_id = $worker['worker_id'];
	 
		$data['id'] = $this->request->param('id');	 
 
		
		$re = Db::name('sell_add')->where($data)->delete();
		
		$return_info =  Db::name("sell_add")->where('add_worker_id = '.$add_worker_id)->select();
		$count_sum =  Db::name("sell_add")->where('add_worker_id = '.$add_worker_id)->field('sum(num) as count_sum')->find();
		$count_money =  Db::name("sell_add")->where('add_worker_id = '.$add_worker_id)->field('sum(money) as count_money')->find();
		
		$count_sum['count_sum'] = $count_sum['count_sum']>1?$count_sum['count_sum']:0;
		$count_money['count_money'] = $count_money['count_money']>1?$count_money['count_money']:0;
		
		$return_data['return_info'] = $return_info;
		$return_data['count_sum'] = $count_sum['count_sum'];
		$return_data['count_money'] = $count_money['count_money'];
		return json([
			'status' => 1,
			'msg'    => "删除成功",
			'data'   =>$return_data

		]);
		exit;
 
	}

	/**
	 * [pc_add_order pc 添加订单信息]
	 * @return [type] [description]
	 */
	public function pc_add_order()
	{		
		$data['total_money'] = $this->request->param('total_money');	//总额
		$data['total_kg'] = $this->request->param('total_kg');	//总额
		$data['is_have'] = $this->request->param('is_have');	//总额
		$submit_time = $this->request->param('submit_time');	//发货日期
		$data['submit_time'] = strtotime($submit_time);
		$data['company_name'] = $this->request->param('company_name');	//公司名称
		$data['customer_id'] = $this->request->param('customer_id');	//公司名称
		$data['customer_name'] = $this->request->param('customer_name');	//客户姓名
		$data['customer_phone'] = $this->request->param('customer_phone');	//客户电话
		$data['customer_address'] = $this->request->param('customer_address');	//客户地址
		$data['ask_info'] = $this->request->param('ask_info');	//包装要求
		$data['other_ask'] = $this->request->param('other_ask');	//物流其他要求
		$data['add_time'] = time();	//添加时间
		$data['order_type'] =$this->request->param('order_type')?$this->request->param('order_type'):'5';	//类型 
		$materiel_list = $_POST['materlists'];// 接受物料详情
		// print_r($materiel_list);exit;
		$worker = $this->worker;
		$add_worker_id = $worker['worker_id'];
		$data['add_worker_id'] = $add_worker_id;	//负责人id
		$data['order_no'] = $this->get_insert_sn();	//编号
		
		$start_time = $this->request->param('start_time')?$this->request->param('start_time'):time();	//发货日期
		$data['start_time'] = substr($start_time,0,10);
		
		$end_time = $this->request->param('end_time')?$this->request->param('end_time'):time();	//发货日期
		$data['end_time'] = substr($end_time,0,10);
		$return_info = array();
 
 
		$re = Db::name('sell_order')->insertGetId($data);
		
		
		//添加财务信息
		
		$m_data['worker_id'] = $worker['worker_id'];
		$m_data['group_id'] = $worker['group_id'];
		$m_data['supply_id'] = $data['customer_id'];

		$m_data['num'] = $data['total_kg'];
		$m_data['sum'] = $data['total_money'];
		$m_data['pid'] = $re;
		$style = 2;
		$add_time = time();
		$m_data['add_time'] =  date('Y-m-d H:i:s',$add_time);
		$m_data['insert_time'] =  date('Y-m-d H:i:s',time());
		$m_data['a_sn'] = $this->get_pay_sn($style,$m_data['add_time']);

		$m_data['origin'] = 2;
		$m_data['type'] = 2;
		$a_id = Db::name('arap')->insertGetId($m_data);
		
		// 添加订单详情
		if($re && $a_id){
				
			foreach($materiel_list as $k=>$v){
				$info_data['order_id']    = $re;
				$info_data['cat_id']      = $v['cat_id'];	//分类id
				$info_data['m_id']        = $v['m_id'];	//作物id
				$info_data['order_num']   = $v['num'];	//数量
				$info_data['order_price'] = $v['price'];	//单价	
				$info_data['all_money']   = $v['money'];	//金额	
				$info_data['add_time']    = time();	//单价	
				$re_info = Db::name('sell_orinfo')->insertGetId($info_data);
				
				$m_info['a_id']  = $a_id;
				$m_info['m_id']  = $v['m_id'];
				$m_info['num']   = $v['num'];
				$m_info['price'] = $v['price'];
				$m_info['sum']   = $v['money'];
				$m_id = Db::name('arap_detail')->insert($m_info);
			}			
	 
		}
		
		if($re && $a_id){
			$res['status'] = 1;
			$res['msg'] = "添加成功";			
		}else{
			$res['status'] = 0;
			$res['msg'] = "添加失败！";					
		}
		ajaxReturnJson($res);
	}

	/**
	 * [pc_sell_orderpi pc端销售订单 -- 进行中]
	 * @return [type] [description]
	 */
	public function pc_sell_orderpi(){	
		$row = 3;
		$page = $this->request->param('page');
		$order_type = $this->request->param('order_type')?$this->request->param('order_type'):5;
		$worker = $this->worker;
		if($page==1||!$page){
			$page = 0;
		}else{
			$page = ($page-1)*$row;
		}
		
		$status = $this->request->param('status')?$this->request->param('status'):0;	//类别 0 进行中 1 已完成
		$worker_info = array();
		
		$where = " and add_worker_id = ".$worker['worker_id'];
		$company_name = $this->request->param('company_name');
		$start_time = strtotime($this->request->param('start_time'));
		$end_time =strtotime($this->request->param('end_time'));
		if($company_name){
			$where .= ' and company_name '.' like '."'%".$company_name."%'";
		}
		if($start_time){
			$where .= ' and add_time >'.$start_time;
		}
		if($end_time){
			$where .= ' and add_time <'.$end_time;
		}
		
		 
		$worker_info = Db::name("sell_order")->where('order_type = '.$order_type.' and check_status = 1  and status = '.$status.$where)->field('order_id,is_have,add_worker_id,add_time,company_name,total_kg,total_money')->order('add_time desc')->paginate(1);
 
		$page = $worker_info->render();
		$list = $worker_info->items();
		$jsonStr = json_encode($worker_info);
		$info = json_decode($jsonStr,true);
		$pages = $info['last_page'];
		if($list){
			foreach($list as $k=>$v){
				$list[$k]['add_time'] = date('Y-m-d',$v['add_time']);
				//获取分类以及作物名
				$order_info = Db::name("sell_orinfo")->where('order_id = '.$v['order_id'])->field('cat_id,m_id,order_num,order_price,all_money')->select();
				$m_name = array();
				foreach($order_info as $ke=>$va){
		 
					$materiel_info = Db::name("materiel")->where('m_id = '.$va['m_id'])->field('m_name')->find();
					
					$order_info[$ke]['m_new_name'] = $materiel_info['m_name'];
					if(in_array($materiel_info['m_name'],$m_name)){
						
					}else{
						array_push($m_name,$materiel_info['m_name']);
					} 
				}
				
				$list[$k]['order_info'] = $order_info;	
				$list[$k]['m_name'] = implode(',',$m_name);
				

				$all_sum = 0;
				$dai_sum = 0;
				$yi_sum = 0;
				$check_num = 0;
				$bei_sum = 0;

 
				$all_sum = Db::name('sell_batch')->alias('sell')
				->join('sell_batch_detail de','sell.batch_id = de.batch_id','LEFT')      
				 ->where('sell.order_id = '.$v['order_id']." and pay_status = 3")
				 ->sum("m_num");
 
 					 
				$bei_sum = Db::name('sell_batch')->alias('sell')
				->join('sell_batch_detail de','sell.batch_id = de.batch_id','LEFT')      
				 ->where('sell.order_id = '.$v['order_id']." and pay_status < 3 ")
				 ->sum("m_num");	 

 
			
			
				/*
				$re_check = Db::name('group')->where('group_id',4)->find();
				if($re_check && $re_check['is_buy']=='1'){

					$check_num = Db::name('ck_lingliao')->alias('m')
					->join('ck_lingliao_detail de','m.id = de.ling_id','LEFT')      
					 ->where('sell_id = '.$v['order_id']." and status = 2")
					 ->sum("m_num");
					
					$dai_sum = Db::name('ck_lingliao')->alias('m')
					->join('ck_lingliao_detail de','m.id = de.ling_id','LEFT')      
					 ->where('sell_id = '.$v['order_id']." and status = 1")
					 ->sum("m_num");

				}else{				
		 
					$dai_info = Db::name("sell_batch")->where('order_id = '.$v['order_id']." and pay_status = 1")->field('batch_id')->find();
					if($dai_info){
						$dai_sum = Db::name("sell_batch_detail")->where('batch_id = '.$dai_info['batch_id'])->sum('m_num');
					}
					
				}
				*/
				
 
				$list[$k]['bei_sum'] = $bei_sum;
				$list[$k]['all_sum'] = $all_sum;
				//根据workerid查询负责人
				if($v['add_worker_id']){
					$check_people = Db::name("worker")->where('worker_id = '.$v['add_worker_id'])->field('worker_id,worker_name')->find();
					if($check_people){
						$list[$k]['add_worker_id'] = $check_people['worker_name'];
					}
				}else{
					$list[$k]['add_worker_id']='';
				}
				
			}
		}

		$page_list = array();
		$page_list['page'] = $page;
		$page_list['pages'] = $pages;
		$page_list['list'] = $list;
		
	
		$check = strstr($worker['node_str'],'35');
		$check_worker = 1;
		if($check){
			$check_worker = 2;
		}
		
		
		return json([
			'status' =>1,
			'msg'    => "查询成功",
			'data'   => $page_list,
			'check_worker'=>$check_worker,
			]);
		exit;
	}
	/*销售订单 --供应管理*/
	public function pc_sell_fill(){	
		$row = 3;
		$page = $this->request->param('page');
		$pay_status = $this->request->param('pay_status')?$this->request->param('pay_status'):2; //2待收货 3 已收货 
		
		if($page==1||!$page){
			$page = 0;
		}else{
			$page = ($page-1)*$row;
		}
 
		$worker_info = array();
		$worker = $this->worker;
		$where = " ba.pay_status = ".$pay_status." and ord.add_worker_id = ".$worker['worker_id'];
		$company_name = $this->request->param('company_name');
		//$m_name = $this->request->param('m_name');
		$start_time = strtotime($this->request->param('start_time'));
		$end_time =strtotime($this->request->param('end_time'));
		if($company_name){
			$where .= ' and ord.company_name '.' like '."'%".$company_name."%'";
		}
		if($start_time){
			$where .= ' and ba.add_time >'.$start_time;
		}
 		if($end_time){
			$where .= ' and ba.add_time <'.$end_time;
		}
 
 
		$materiel_list = Db::name('sell_batch')->alias('ba')
		->field('ord.is_have,ba.add_time,ba.pay_status,ord.add_worker_id,ord.company_name,ba.real_time,ba.batch_id,ord.order_id,ord.add_time as sell_time')
		->join('sell_order ord','ba.order_id = ord.order_id','LEFT')
                                     
		 ->where($where)
		->paginate(1);
		// echo Db::name('sell_batch')->getLastSql();die;
		$page = $materiel_list->render();
		$list = $materiel_list->items();
		$jsonStr = json_encode($materiel_list);
		$info = json_decode($jsonStr,true);
		$pages = $info['last_page'];
		
		
		if($list){
			foreach($list as $k=>$v){
				$list[$k]['add_time'] = date('Y-m-d',$v['add_time']);
				$list[$k]['real_time'] = date('Y-m-d',$v['real_time']);
				$list[$k]['sell_time'] = date('Y-m-d',$v['sell_time']);
				
				//查询批次详情信息
				$check_pi = array();
				$check_pi = Db::name("sell_batch_detail")->where('batch_id = '.$v['batch_id'])->field('m_id,m_num')->select();
				if($check_pi){
					foreach($check_pi as $ke=>$va){
						 $materiel_info = Db::name("materiel")->where('m_id = '.$va['m_id'])->field('m_name')->find();
						 if($materiel_info){
							$check_pi[$ke]['m_name'] = $materiel_info['m_name'];
							//获取单价
							$new_order_id = $v['order_id'];
							$new_m_id = $va['m_id'];
							
							$check_orinfo = Db::name("sell_orinfo")->where('order_id = '.$new_order_id.' and m_id = '.$new_m_id)->field('order_price')->find();
							if($check_orinfo){
								$check_pi[$ke]['order_price'] = $check_orinfo['order_price'];
							}else{
								$check_pi[$ke]['order_price'] = 0;
							}
							
						 }
					}
				}
				$count_num = 0;
				$count_money = 0;
				foreach($check_pi as $key=>$val){
					$count_num = $count_num + $val['m_num'];
					
					$count_money = $count_money + ($val['m_num']*$val['order_price']);
				}
				$list[$k]['count_num'] = $count_num;
				$list[$k]['count_money'] = $count_money;
				$list[$k]['orinfo'] = $check_pi;
				//根据workerid查询负责人
				if($v['add_worker_id']){
					$check_people = Db::name("worker")->where('worker_id = '.$v['add_worker_id'])->field('worker_id,worker_name')->find();
					if($check_people){
						$list[$k]['add_worker_id'] = $check_people['worker_name'];
					}
				}else{
					$list[$k]['add_worker_id']='';
				}
			}
		}
		$page_list = array();
		$page_list['page'] = $page;
		$page_list['pages'] = $pages;
		$page_list['list'] = $list;
		
		return json([
			'status' =>1,
			'msg'    => "查询成功",
			'data'   => $page_list,
			]);
		exit;
	}
	/*pc端客户管理 ---列表*/
	public function pc_list_customer(){
		
		$row = 3;
		$page = $this->request->param('page');
 
		
		if($page==1||!$page){
			$page = 0;
		}else{
			$page = ($page-1)*$row;
		}
		
		$contact_phone = $this->request->param('contact_phone');	//电话
		$contact_person = $this->request->param('contact_person');	 //联系人
		$company_name = $this->request->param('company_name');	//公司名字
	 
		
		$where = '  is_deleted = 1';
 
		if($company_name){
			$where .=" and  company_name like '%".$company_name."%'";
		}
		
		if($contact_person){
			$where .=" and  contact_person like '%".$contact_person."%'";
		}
		
		if($contact_phone){
			$where .=" and  contact_phone like '%".$contact_phone."%'";
		}
		$worker_info = array();
		 

		$worker_info = Db::name("customer")->where($where)->paginate(1);
		//$worker_info = Db::name("sell_order")->where('order_type ='.$order_type.' and check_status = 0 '.$where)->field('total_money,company_name,is_have,add_time,check_status,order_id,add_time,start_time,end_time,submit_time,check_remark')->order('add_time desc')->limit($page,$row)->select();

		$page = $worker_info->render();
		$list = $worker_info->items();
		$jsonStr = json_encode($worker_info);
		$info = json_decode($jsonStr,true);
		$pages = $info['last_page'];
		
		
		$page_list = array();
		$page_list['page'] = $page;
		$page_list['pages'] = $pages;
		$page_list['list'] = $list;
			
			
		return json([
			'status' =>1,
			'msg'    => "查询成功",
			'data'   => $page_list,
			]);
		exit;
		
	}
	/**
	 * [pc_add_order_pi 销售订单 添加批次]
	 * @return [type] [description]
	 */
	public function pc_add_order_pi(){
		
	
		$info_str = $_POST['info_str'];
 
		$mnum = $info_str['mnum'];
		$cat_id = $info_str['cat_id'];
		$m_id = $info_str['m_id'];
		

		$count_mnum = count($mnum);
		for($i=0;$i<$count_mnum;$i++){
			if($mnum[$i]=='' || $mnum[$i]==0){
				unset($mnum[$i]);
				unset($cat_id[$i]);
				unset($m_id[$i]);
			}
		}

	 
		$check_materiel = $this->request->param('check_materiel'); //判断是否购买仓库
		$company_name = $this->request->param('company_name'); //公司名
		if($check_materiel=='1'){
			$data['order_id'] = $this->request->param('order_id');
			$data['type'] = $this->request->param('type');
			
			$worker = $this->worker;
			$add_worker_id = $worker['worker_id'];
			$data['add_worker_id'] = $add_worker_id; //快递单号
			
			$data['add_time'] = time();
			$data['real_time'] = time();
			$data['pay_status'] =1;
			
 
			$batch_id = Db::name('sell_batch')->insertGetId($data);//批次表
			
			$new_count = count($mnum);
			$new_ling_num = 0;
			for($jnu=0;$jnu<$new_count;$jnu++){
				$new_ling_num = $new_ling_num + $mnum[$jnu];
			}
			/*添加到仓库 出库表*/
			$ling_info['type'] = 5;
			$ling_info['lingliao_sn'] = $this->get_lingliao_sn();
			$ling_info['apply_worker'] = $add_worker_id;
			$ling_info['add_time'] = time();
			$ling_info['sell_id'] = $data['order_id'];
			$ling_info['batch_id'] = $batch_id;
			$ling_info['company_name'] = $company_name;
			$ling_info['num'] = $new_ling_num;

			$lingliao_re= Db::name("ck_lingliao")->insertGetId($ling_info);
					
			if($batch_id){
				$info_data = array();

				
				for($j=0;$j<$new_count;$j++){
					$info_data['batch_id'] = $batch_id;
					$info_data['order_id'] = $this->request->param('order_id');
					$info_data['cat_id'] = $cat_id[$j];	//分类id
					$info_data['m_id'] = $m_id[$j];	//作物id
					$info_data['m_num'] = $mnum[$j];	//数量
					$info_data['add_time'] =time();	//时间
					$re_info = Db::name('sell_batch_detail')->insertGetId($info_data);

					//添加到仓库 领料表
					//获取category表信息  ck_id等
					$cat_info_find = Db::name('materiel_category')->field('ck_id')->where('cat_id = '.$cat_id[$j])->find();
					//获取物料信息
					$m_find = Db::name('materiel')->field('price,cat_id,m_desc,unit,m_no,m_name')->where('m_id = '.$m_id[$j])->find();
					
					/*销售临时加详情表*/
					
					$detail_info['ling_id'] = $lingliao_re;
					$detail_info['batch_id'] = $batch_id;
					$detail_info['order_id'] = $this->request->param('order_id');
					$detail_info['cat_id'] =   $cat_id[$j];
					$detail_info['m_id'] =  $m_id[$j];
					$detail_info['m_num'] =  $mnum[$j];
					$detail_info['add_time'] = time();
					
					$re_info = Db::name('ck_lingliao_detail')->insertGetId($detail_info);
				}
				
			}
			//$re =  Db::name('sell_order')->where('order_id = '.$data['order_id'])->update(array('status'=>1));
			return json([
				'status' =>1,
				'msg'    => "添加成功",
	 
	 
				]);
			exit;
			
		}else{
			$data['order_id'] = $this->request->param('order_id');
			$data['type'] = $this->request->param('type');
			$data['car_clxh'] = $this->request->param('car_clxh'); //车辆型号
			$data['car_cp'] = $this->request->param('car_cp'); //车牌号
			$data['car_yslx'] = $this->request->param('car_yslx'); //运输类型
			$data['car_sjxm'] = $this->request->param('car_sjxm'); //司机姓名
			$data['car_lxfs'] = $this->request->param('car_lxfs'); //联系方式
			$data['car_kdgs'] = $this->request->param('car_kdgs'); //快递公司
			$data['car_kddh'] = $this->request->param('car_kddh'); //快递单号
			$data['submit_time'] =  strtotime($this->request->param('submit_time')); //预计时间
			
			$worker = $this->worker;
			$add_worker_id = $worker['worker_id'];
			$data['add_worker_id'] = $add_worker_id; //快递单号
			
			$data['add_time'] = time();
			$data['real_time'] = time();
			$data['pay_status'] =2;
			
 
			
 
			$batch_id = Db::name('sell_batch')->insertGetId($data);//批次表
			if($batch_id){
				$new_count = count($mnum);
				for($j=0;$j<$new_count;$j++){
					$info_data['batch_id'] = $batch_id;
					$info_data['order_id'] = $this->request->param('order_id');
					$info_data['cat_id'] = $cat_id[$j];	//分类id
					$info_data['m_id'] = $m_id[$j];	//作物id
					$info_data['m_num'] = $mnum[$j];	//数量
					$info_data['add_time'] =time();	//数量
					$re_info = Db::name('sell_batch_detail')->insertGetId($info_data);				
					
				}
	
			}
			//$re =  Db::name('sell_order')->where('order_id = '.$data['order_id'])->update(array('status'=>1));
			return json([
				'status' =>1,
				'msg'    => "添加成功",
	 
	 
				]);
			exit;
		}
		
		

	}
	/*销售任务--定制化订单*/
	public function  sell_task_ding(){
		$task_info = array();
		$task_info = Db::name('sell_task task')
		->field(['ma.m_name',
		'ma.unit',
		'task.add_worker_id',
		'task.sell_product_id',
		'task.m_id',
		'task.num_expect',
		'task.num_actual'])
		->join('materiel ma','task.m_id = ma.m_id')
		->where('sell_product_id > 0')
		->select();
		if($task_info){
			foreach($task_info as $k=>$v){

				//获取销售编号等信息
				$sell_product_task = Db::name("sell_product_task")->where('sell_product_id = '.$v['sell_product_id'])
				->field('order_id,order_no,order_num')->find();
				if($sell_product_task){
					$task_info[$k]['order_no'] = $sell_product_task['order_no'];
					$task_info[$k]['order_num'] = $sell_product_task['order_num'];
					
					$sell_order = Db::name("sell_order")->where('order_id = '.$sell_product_task['order_id'])
					->field('add_worker_id')->find();
					if($sell_order){
						//获取发布人姓名
						$check_people = Db::name("worker")->where('worker_id = '.$sell_order['add_worker_id'])->field('worker_id,worker_name')->find();
						if($check_people){
							$task_info[$k]['add_worker_id'] = $check_people['worker_name'];
						}else{
							$task_info[$k]['add_worker_id'] = '';
						}
				
					}
					//获取发货 备货数量
					
					$all_sum = Db::name('sell_batch')->alias('sell')
					->join('sell_batch_detail de','sell.batch_id = de.batch_id','LEFT')      
					 ->where('sell.order_id = '.$sell_product_task['order_id']." and pay_status = 3")
					 ->sum("m_num");
 
 					 
					$bei_sum = Db::name('sell_batch')->alias('sell')
					->join('sell_batch_detail de','sell.batch_id = de.batch_id','LEFT')      
					 ->where('sell.order_id = '.$sell_product_task['order_id']." and pay_status < 3 ")
					 ->sum("m_num");	 

					$task_info[$k]['all_sum'] = $all_sum;
					$task_info[$k]['bei_sum'] = $bei_sum;
				 
				 
					
					
				}
				
			}
		}
		
		
		return json([
			'status' =>1,
			'msg'    => "查询成功",
			'data'   => $task_info,
	 
			]);
		exit;
	}
	/*预销售系统列表*/
	public function sell_task(){
		$row = 3;
		$page = $this->request->param('page');
 
		
		if($page==1||!$page){
			$page = 0;
		}else{
			$page = ($page-1)*$row;
		}
		
		$m_name = $this->request->param('m_name');	//物料名称
		$type = $this->request->param('type');	// 任务订单  1  定制化订单2 
		$start_time =  substr($this->request->param('start_time'),0,10); //开始时间
		$end_time =  substr($this->request->param('end_time'),0,10); //结束时间
		
		
		$where = '  task.status = 1';
		if($m_name){
			$where .=" and  task.m_name = ".$m_name;
		}
		if($start_time){
			$where .=" and task.pick_time >".$start_time;
		}
		if($end_time){
			$where .=" and task.pick_time <".$end_time;
		}
		
		
		$worker_info = array();
		
		$count = Db::name('sell_task task')
		->field(['ma.m_name','ma.unit','task.add_time','task.num_expect','task.num_actual'])
		->join('materiel ma','task.m_id = ma.m_id')
		->where($where)
		->count();
		
		$worker_info = Db::name('sell_task task')
		->field(['ma.m_name',
		'ma.unit',
		'sell_product_id',
		'task.pick_time',
		'task.book_per',
		'task.use_num',
		'task.id',
		'task.t_id',
		'task.sell_product_id',
		'task.area_id',
		'task.num_expect',
		'task.num_actual'])
		->join('materiel ma','task.m_id = ma.m_id')
		->where($where)
		->order('add_time desc')->select();
		


		if($worker_info){
			foreach($worker_info as $k=>$v){
				$worker_info[$k]['pick_time'] = date('Y-m-d',$v['pick_time']);
				$worker_info[$k]['num_expect'] =  $v['num_expect'];
				$worker_info[$k]['num_actual'] =  $v['num_actual'];
				$worker_info[$k]['last_num'] =  $v['num_actual'] - $v['use_num'];
				//获取定制化订单信息
				if($v['sell_product_id']>0){
					
					//获取质检总量
					$order_num =  Db::name('pro_harvest_day')->where('sell_product_id ='.$v['sell_product_id'])->field('num')->find();
					if($order_num && $order_num['num']){
						$worker_info[$k]['day_num'] = $order_num['num'];
					}else{
						$worker_info[$k]['day_num'] = 0;
					}
					//获取生产任务信息
					$sell_product_task =  Db::name('sell_product_task')->where('sell_product_id ='.$v['sell_product_id'])->field('order_num,m_id,add_worker_id,add_time,submit_time,order_no')->find();
					if($sell_product_task){
						$worker_info[$k]['order_no'] = $sell_product_task['order_no'];
						$worker_info[$k]['order_num'] = $sell_product_task['order_num'];
						
						$materiel_info = Db::name("materiel")->where('m_id = '.$sell_product_task['m_id'])->field('m_name')->find();
						$worker_info[$k]['m_name'] = $materiel_info['m_name'];
						$check_people = Db::name("worker")->where('worker_id = '.$sell_product_task['add_worker_id'])->field('worker_id,worker_name')->find();
						if($check_people){
							$worker_info[$k]['add_worker_id'] = $check_people['worker_name'];
						}else{
							$worker_info[$k]['add_worker_id'] = '';
						}
						$worker_info[$k]['task_name'] =  $materiel_info['m_name'].'_'.$sell_product_task['order_num'];
						
					}else{
						$worker_info[$k]['task_name'] = '';
					}
					//获取种植区域
					$area_info = Db::name("grow_area")->where('area_id = '.$v['area_id'])->field('area_name')->find();
					if($area_info){
						$worker_info[$k]['area_name'] = $area_info['area_name'];
					}else{
						$worker_info[$k]['area_name'] = '';
					}
					//获取种植任务
					$grow_info = Db::name("pro_grow_task")->where('t_id = '.$v['t_id'])->field('t_name')->find();
					if($grow_info){
						$worker_info[$k]['t_name'] = $grow_info['t_name'];
					}else{
						$worker_info[$k]['t_name'] = '';
					}
				}else{
	 
					//获取种植区域
					$area_info = Db::name("grow_area")->where('area_id = '.$v['area_id'])->field('area_name')->find();
					if($area_info){
						$worker_info[$k]['area_name'] = $area_info['area_name'];
					}else{
						$worker_info[$k]['area_name'] = '';
					}
					//获取种植任务
					$grow_info = Db::name("pro_grow_task")->where('t_id = '.$v['t_id'])->field('t_name')->find();
					if($grow_info){
						$worker_info[$k]['t_name'] = $grow_info['t_name'];
					}else{
						$worker_info[$k]['t_name'] = '';
					}
					
				}
			}
		}
		
		return json([
			'status' =>1,
			'msg'    => "查询成功",
			'data'   => $worker_info,
			'count'=>$count
			]);
		exit;
		
	}
	/*添加销售任务信息*/
	public function add_sell_task(){
		$data['m_id'] = $this->request->param('m_id');	//物料名称
		$data['t_id'] = $this->request->param('t_id');	//t_id 种植任务id
		$data['area_id'] = $this->request->param('area_id');	//area_id 模式id
		$data['sell_product_id'] = $this->request->param('sell_product_id');	//生产任务id
		$data['pick_time'] =  substr($this->request->param('pick_time'),0,10); 
		$data['num_expect'] = $this->request->param('num_expect');	//预计产量
		$data['num_actual'] = $this->request->param('num_actual');	//实际产量
		$data['margin_num'] = $this->request->param('num_actual');	//余量
		$data['use_num'] = $this->request->param('num_actual');	//可用余量
		$data['plan_id'] = $this->request->param('plan_id');	//可用余量
		
		$worker = $this->worker;
		$worker_id = $worker['worker_id'];
		$data['add_worker_id'] = $worker_id;
		
		$data['add_time'] = time();	//实际产量
		$sell_id = Db::name('sell_task')->insert($data);//添加生产计划		
		if($sell_id==false){
			$result['status'] = 0;
			$result['msg'] = "销售添加失败";
			return json($result);
		}else{
			$result['status'] = 1;
			$result['msg'] = "销售任务添加成功";
			return json($result);
		}
	}
	/*编辑销售任务信息*/
	public function edit_sell_task(){
		$id =  $this->request->param('id'); //ID
		$data['pick_time'] =  substr($this->request->param('pick_time'),0,10); 
		$data['num_expect'] = $this->request->param('num_expect');	//预计产量
		$data['num_actual'] = $this->request->param('num_actual');	//实际产量
		
		$re = Db::name('sell_task')->where('id = '.$id)->update($data);	
		if($re==false){
			$result['status'] = 0;
			$result['msg'] = "销售信息修改失败";
			ajaxReturnJson($result);
		}else{
			$result['status'] = 1;
			$result['msg'] = "销售信息修改成功";
			ajaxReturnJson($result);
		}
	}
	/*删除销售任务信息*/
	public function del_sell_task(){
		$id =  $this->request->param('id'); //ID
		$data['status'] = 0;
		$re = Db::name('sell_task')->where('id = '.$id)->update($data);	
		if($re==false){
			$result['status'] = 0;
			$result['msg'] = "销售信息删除失败";
			ajaxReturnJson($result);
		}else{
			$result['status'] = 1;
			$result['msg'] = "销售信息删除成功";
			ajaxReturnJson($result);
		}
		
	}
	
	/*销售任务列表*/
	public function sell_task_list(){
		$row = 3;
		$page = $this->request->param('page');
 
		
		if($page==1||!$page){
			$page = 0;
		}else{
			$page = ($page-1)*$row;
		}
		
		$where = '  status = 1';
 
		$worker_info = array();
		 
		$count = Db::name("sell_task")->where($where)->count();
		$worker_info = Db::name("sell_task")->where($where)->order('add_time desc')->limit($page,$row)->select();
		
		foreach($worker_info as $k=>$v){
			$m_find = Db::name('materiel')->field('m_name,unit')->where('m_id = '.$v['m_id'])->find();
			if($m_find){
				$worker_info[$k]['m_name'] = $m_find['m_name'];
			}
			
			//根据定单表获取总量 和 实际采收运算得出 比率
			$order_num = Db::name('sell_task task')
			->join('sell_orinfo order','task.id = order.sell_task_id')
			->sum('order_num');
			//获取实际付款比例
			if($v['num_actual']==0){
				$true_remark = 0;
			}else{
				$true_remark = $order_num/$v['num_actual']*100;
			}
			
			$worker_info[$k]['true_remark'] = $true_remark;
			$worker_info[$k]['pick_time'] = date('Y-m-d',$v['pick_time']);
			
			
			$worker_info[$k]['num_expect'] = $v['num_expect'].$m_find['unit'];
			$worker_info[$k]['num_actual'] = $v['num_actual'].$m_find['unit'];
			$worker_info[$k]['margin_num'] = $v['margin_num'].$m_find['unit'];
			$worker_info[$k]['use_num'] = $v['use_num'].$m_find['unit'];
			
			
		}
		return json([
			'status' =>1,
			'msg'    => "查询成功",
			'data'   => $worker_info,
			'count'=>$count
			]);
		exit;

	}
	
	/*销售任务详情*/
	public function sell_task_detail(){
		 
		$id = $this->request->param('id');

		$task_info =  Db::name('sell_task')->field('id,m_id')->where('id = '.$id)->find();
		if($task_info){
			$orinfo = Db::name('sell_orinfo')->field('id,m_id,order_id,order_price as price,all_money as money,order_num as num')->where('sell_task_id = '.$id.' and m_id = '.$task_info['m_id'])->select();
			
			//echo Db::name('sell_orinfo')->getLastSql();die;
			if($orinfo){
				foreach($orinfo as $k=>$v){
					$mate_info = Db::name('materiel')->field('m_name,unit')->where('m_id = '.$v['m_id'])->find();
					if($mate_info){
						$orinfo[$k]['m_name'] = $mate_info['m_name'];
					}
					$sell_info = Db::name('sell_order')->field('company_name')->where('order_id = '.$v['order_id'])->find();
					if($sell_info){
						$orinfo[$k]['company_name'] = $sell_info['company_name'];
					}
					
					$orinfo[$k]['num'] = $v['num'].$mate_info['unit'];
				}
			}
		}
		return json([
			'status' =>1,
			'msg'    => "查询成功",
			'data'   => $orinfo,
			]);
		exit;

	}
	
	/*预销售列表 发布生产任务 列表*/
	public function sell_product_list(){
 
		$m_name = $this->request->param('m_name');
		if($m_name){
			$task_info = Db::name('sell_product_task')->alias('task')
				->join('materiel ma','task.m_id = ma.m_id','LEFT')      
				 ->where("ma.m_name = '".$m_name."'")
				 ->select();
 
		}else{
			$task_info = Db::name('sell_product_task')->alias('task')
				->join('materiel ma','task.m_id = ma.m_id','LEFT')      
				 ->select();
		}
		
		if($task_info){
			foreach($task_info as $k=>$v){
				$task_info[$k]['add_time'] =  date('Y-m-d',$v['add_time']);
				$task_info[$k]['submit_time'] =  date('Y-m-d',$v['submit_time']);
				//获取发布人姓名
				$check_people = Db::name("worker")->where('worker_id = '.$v['add_worker_id'])->field('worker_id,worker_name')->find();
				if($check_people){
					$task_info[$k]['add_worker_id'] = $check_people['worker_name'];
				}
				
				//获取果型国色等信息
				$cate_info = Db::name("materiel_category")->where('cat_id = '.$v['cat_id'])->field('cat_name,cat_desc,fcolor,ftype')->find();
				if($cate_info){
						$task_info[$k]['cat_name'] = $cate_info['cat_name'];
						$task_info[$k]['cat_desc'] = $cate_info['cat_desc'];
						$task_info[$k]['fcolor'] = $cate_info['fcolor'];
						$task_info[$k]['ftype'] = $cate_info['ftype'];
				}
				
				//获取种植模式信息
				$get_mode_info =  Db::name("sell_orinfo")->where('order_id = '.$v['order_id'])->field('mode_id')->find(); 
	 
				if($get_mode_info){
					$mode_info =  Db::name("grow_mode")->where('mode_id = '.$get_mode_info['mode_id'])->field('mode_id,mode_name')->find(); 
					if($mode_info){
						$task_info[$k]['grow_mode_id'] =  $mode_info['mode_id'];
						$task_info[$k]['grow_mode_name'] =  $mode_info['mode_name'];
					}else{
						$task_info[$k]['grow_mode_id'] = '';
						$task_info[$k]['grow_mode_name'] = '';
					}
				}
				
			}
		}
		return json([
			'status' =>1,
			'msg'    => "查询成功",
			'data'   => $task_info,
			]);
		exit;
		
	}
	
	/*预销售列表 发布生产任务*/
	public function add_sell_productplan(){
		$m_id = $this->request->param('m_id');
		$info_str = $this->request->param('info_str');//1,2  sell_product_id字符串
		
		$return_info = array();
		$mate_info =  Db::name('materiel')->where('m_id = '.$m_id)->field('cat_id,m_name')->find();
		$cate_info = array();
		if($mate_info){
			$cate_info =  Db::name('materiel_category')->where('cat_id = '.$mate_info['cat_id'])->field('cat_desc,fcolor,ftype')->find();
			if($cate_info){
				$cate_info['m_name'] = $mate_info['m_name'];
				
				//获取总量
				$order_num =  Db::name('sell_product_task')->where('sell_product_id in ('.$info_str.')')->sum('order_num');
				
			
				
				if($order_num){
					$cate_info['order_num'] = $order_num;
				}else{
					$cate_info['order_num'] = 0;
				}
				
				
			}
		}
		return json([
			'status' =>1,
			'msg'    => "查询成功",
			'data'   => $cate_info,
			]);
		exit;
		
	}
	
	/*生产计划 列表  点击 定。。显示相关信息*/
	public function product_list_show(){
		
		$plan_id = $this->request->param('plan_id');//1,2  sell_product_id字符串
		
		$return_info = array();
		$plan_info =  Db::name('product_plan')->where('plan_id = '.$plan_id)->field('sell_product_id')->find();
		if($plan_info && $plan_info['sell_product_id']){
			$task_info =  Db::name('sell_product_task')->where('sell_product_id in ('.$plan_info['sell_product_id'].')')->select();
			if($task_info){
				foreach($task_info as $k=>$v){
					$task_info[$k]['submit_time'] =  date('Y-m-d',$v['submit_time']);
					
					$sell_info =  Db::name('sell_order')->where('order_id = '.$v['order_id'])->field('company_name,sell_all_money')->find();
					if($sell_info){
						$task_info[$k]['company_name'] = $sell_info['company_name'];
						$task_info[$k]['sell_all_money'] = $sell_info['sell_all_money'];
					}
					$check_people = Db::name("worker")->where('worker_id = '.$v['add_worker_id'])->field('worker_id,worker_name')->find();
					if($check_people){
						$task_info[$k]['add_worker_id'] = $check_people['worker_name'];
					}
				}
			}
			
		}
		return json([
			'status' =>1,
			'msg'    => "查询成功",
			'data'   => $task_info,
			]);
		exit;
	}
	/*产量质检 生产任务列表 下拉 */
	public function product_sell_task(){
		$plan_id = $this->request->param('plan_id');//1,2  sell_product_id字符串
		
		$return_info = array();
		$plan_info =  Db::name('product_plan')->where('plan_id = '.$plan_id)->field('sell_product_id')->find();
		if($plan_info && $plan_info['sell_product_id']){
			$task_info =  Db::name('sell_product_task')->where('sell_product_id in ('.$plan_info['sell_product_id'].')')->select();
			if($task_info){
				foreach($task_info as $k=>$v){
					$task_info[$k]['add_time'] =  date('Y-m-d',$v['add_time']);
					$task_info[$k]['submit_time'] =  date('Y-m-d',$v['submit_time']);
					//获取发布人姓名
					$check_people = Db::name("worker")->where('worker_id = '.$v['add_worker_id'])->field('worker_id,worker_name')->find();
					if($check_people){
						$task_info[$k]['add_worker_id'] = $check_people['worker_name'];
					}
					$task_info[$k]['new_name'] =  $check_people['worker_name'].'_'.$v['order_num'].'_'.date('Y-m-d',$v['submit_time']);
					
					//获取发货 备货数量
					
					$all_sum = Db::name('sell_batch')->alias('sell')
					->join('sell_batch_detail de','sell.batch_id = de.batch_id','LEFT')      
					 ->where('sell.order_id = '.$v['order_id']." and pay_status = 3")
					 ->sum("m_num");
 
 					 
					$bei_sum = Db::name('sell_batch')->alias('sell')
					->join('sell_batch_detail de','sell.batch_id = de.batch_id','LEFT')      
					 ->where('sell.order_id = '.$v['order_id']." and pay_status < 3 ")
					 ->sum("m_num");	 

					$task_info[$k]['all_sum'] = $all_sum;
					$task_info[$k]['bei_sum'] = $bei_sum;
				 
					
					
					
				}
			}else{
				 $task_info = array();
			}
			
		}else{
			$task_info = array();
		}
		return json([
			'status' =>1,
			'msg'    => "查询成功",
			'data'   => $task_info,
			]);
		exit;
	
	}
	
 
	
	
	
}