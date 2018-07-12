<?php

namespace app\money\controller;
use app\base\controller\Base;
use think\Db;
class Money extends Base{
		/**
     * [get_plan_sn 获取编号]
     * @return [type] [description]
     */
	private function get_plan_sn(){
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
    /**
     * 应收账单
     */
    public function should_get(){
		
		
		
		//获取条件变量
		$row = 3;
		$page = $this->request->param('page');
		$keywords = $this->request->param('keywords');
		$search_type = $this->request->param('search_type');
		$search_name = $this->request->param('search_name');
		$t1 = $this->request->param('t1');
		$t2 = $this->request->param('t2');
		if($page==1||!$page){
			$page = 0;
		}else{
			$page = ($page-1)*$row;
		}
		$orderlist = array();
		$condition = ' 1 = 1 ';
        $condition .= $search_type ? ' and o.total_money <= o.true_money' : ' and o.total_money > o.true_money';
           
		/*if($_GET['t1'] && $_GET['t2']){
			$t1 = strtotime($_GET['t1']);
			$t2 = strtotime($_GET['t2']);
			if($t1 > $t2){
				$this->error('时间段选择有误','',3);
			}
			$t2 += 86399;
			$condition['o.add_time'] = array('between',array($t1,$t2));
		}*/
		

		if($t1){
			$t1 = substr($t1,0,10);
			$condition .=' and o.add_time >'.$t1;
		}
		if($t2){
			$t2 = substr($t2,0,10);
			$condition .=' and o.add_time <'.$t2;
		}
		if($keywords){
			if($search_name=='1'){
				$condition .= ' and  o.order_no like '."'%".$keywords."%'";
			}
			if($search_name=='2'){
				$condition .= ' and  cu.company_name like '."'%".$keywords."%'";
			}
			if($search_name=='3'){
				$condition .= ' and  cu.contact_person  like '."'%".$keywords."%'";
			}
			if($search_name=='4'){
				$condition .= ' and  cu.contact_phone  like '."'%".$keywords."%'";
			}
			if($search_name=='5'){
				$condition .= ' and  w.worker_name  like '."'%".$keywords."%'";
			}
		
		}
	 
	 
        $count  =  Db::name('sell_order')->alias('o')
             
				->join('customer cu','cu.customer_id = o.customer_id','LEFT')  
				->join('worker w','w.worker_id = o.fzr_worker_id','LEFT')  
        
                ->where($condition)
                ->count();               
                                
 
        /* 订单列搜索 */
        
        $orderlist = Db::name('sell_order')->alias('o')                    
					->join('customer cu','cu.customer_id = o.customer_id','LEFT')  
					->join('worker w','w.worker_id = o.fzr_worker_id','LEFT')  
                    ->where($condition)
                    ->field('o.order_id,o.order_no,o.total_money,cu.customer_id,cu.contact_person,cu.contact_phone,cu.company_name,cu.address,w.worker_name,o.add_time,o.true_money,o.submit_status')
                    ->order('o.order_id desc')
                      ->limit($page,$row)
                    ->select();
		foreach($orderlist as $k=>$v){
			$orderlist[$k]['add_time'] = date('Y-m-d H:i:s',$v['add_time']);
		 
			$orderlist[$k]['money_li_old'] =  round($v['true_money']/$v['total_money'],2)*100;
		}

 		 return json([
			'status' => 1,
			'msg'    => "获取成功",
			'data'   => $orderlist,
			'count'=>$count
		]);
		exit;		
    }
	/*
	获取客户负责人  和 提交订单负责人
	*/
	public function get_userinfo(){
		$customer_info =  Db::name("customer")->where('is_deleted = 1')->field('customer_id,contact_person')->select();
		$worker_info =  Db::name("worker")->where('status = 1')->field('worker_id,worker_name')->select();
		
		$data['customer_info'] = $customer_info;
		$data['worker_info'] = $worker_info;
		return json([
			'status' => 1,
			'msg'    => "获取成功",
			'data'   => $data,
		 
		]);
		exit;		
	}
	/*根据姓名获取信息*/
		public function get_nameinfo(){
		$type = $this->request->param('type');	//1客户 2 订单负责人
		$name = $this->request->param('name');
 
		$name_info = array();
		if($type=='1'){
			$name_info =  Db::name("customer")->where('is_deleted = 1 and contact_person  like '."'%".$name."%'")->field('customer_id as id,contact_person as name')->select();
		}
		if($type=='2'){
			$name_info =  Db::name("worker")->where('status = 1 and worker_name  like '."'%".$name."%'")->field('worker_id as id,worker_name as name')->select();
		}
 
		return json([
			'status' => 1,
			'msg'    => "获取成功",
			'data'   => $name_info,
		 
		]);
		exit;		
	}
	/**
     * 添加收款单
     */
    public function add_get_money(){
    
        $order_id =  $this->request->param('order_id')?$this->request->param('order_id') : 0;  
		$order_info = array();
        if($order_id!=0){
            //根据订单id 查询订单编号和客户信息 显示在页面中
            $order_info =Db::name('sell_order')->alias('so')
                        ->where('so.order_id='.$order_id)
						->join('customer cu',' cu.customer_id = so.customer_id','LEFT')  
                        ->field('so.order_id,so.order_no,so.total_money,so.true_money,cu.contact_person,cu.contact_phone,cu.address,cu.company_name,cu.customer_id')
                        ->find();
        }
		return json([
			'status' => 1,
			'msg'    => "获取成功",
			'data'   => $order_info,
		 
		]);
		exit;	
		 
    }
	   /**
     * 保存添加收款单信息
     */
    public function save_add_get_money() {
		$data['order_id'] = $this->request->param('order_id'); //订单id
		$data['payway'] = $this->request->param('payway'); //订单id
		$data['money'] = $this->request->param('money'); //金额
		 
		$sell_info =  Db::name("sell_order")->where('order_id = '.$data['order_id'])->field('order_id,order_no,customer_id,add_time')->find();
		
	 
		if($sell_info && $sell_info['customer_id']){
	 
			$customer_info =  Db::name("customer")->where('customer_id = '.$sell_info['customer_id'])->field('company_name')->find();
		}
 
		if($customer_info){
			$m_info['cname'] = $customer_info['company_name'];
		}
		$m_info['order_id'] = $data['order_id'];
		$m_info['money'] = $data['money'];
		$m_info['order_no'] = $sell_info['order_no'];
		$m_info['customer_id'] = $sell_info['customer_id'];
		$m_info['payway'] = $data['payway'];
		
		$m_info['type'] = 1;
        $m_info['add_time'] =  time(); 
        $m_info['create_time'] = $sell_info['add_time'];
		
		$worker = $this->worker;
	    $m_info['add_worker_id'] = $worker['worker_id'];
 
		if($data['payway']!='4'){
			$payinfo = $this->get_payway($sell_info['customer_id'],$data['payway']);
			if($data['payway']=='1'){
				$m_info['pay_no'] = $payinfo['weixin'];
			}
			if($data['payway']=='2'){
				$m_info['pay_no'] = $payinfo['alipay'];
			}
			if($data['payway']=='3'){
				$m_info['pay_no'] = $payinfo['bank_no'];
				$m_info['bank_name'] = $payinfo['bank_name'];
			}
		}
 
		$re= Db::name("money_log")->insert($m_info); 
		if($re){
			$return_info =  Db::name("sell_order")->where("order_id = ".$data['order_id'])->setInc('true_money',$data["money"]);	
			return json([
				'status' => 1,
				'msg'    => "添加成功"
			 
			]);
			exit;				
	    }else{
			return json([
				'status' => 0,
				'msg'    => "添加失败"
			 
			]);
			exit;
		}
		
    }
	    /**
     * [get_money_detail 订单收款详情]
     * @return [type] [description]
     */
    public function get_money_detail(){
  
        $condition['order_id'] = $this->request->param('order_id'); //订单id
        $condition['type'] = $this->request->param('type'); 
        $condition['type'] = !$condition['type'] ? 0 : 1;
        
        $info =  Db::name('money_log')->where($condition)->order('add_time')->select();  
		foreach($info as $k=>$v){
			if($v['payway']=='1'){
				$info[$k]['payway']='微信';
			}
			if($v['payway']=='2'){
				$info[$k]['payway']='支付宝';
			}
			if($v['payway']=='3'){
				$info[$k]['payway']='银行';
			}
			if($v['payway']=='4'){
				$info[$k]['payway']='现金';
			}
		}
			return json([
				'status' => 1,
				'msg'    => "查询成功",
				'data' =>$info
			 
			]);
			exit;      
    }

	    /**
     * [get_payway 获取客户的支付信息]
     * @param  [type] $customer_id [description]
     * @param  [type] $payway      [description]
     * @return [type]              [description]
     */
    public function get_payway($customer_id,$payway){
        switch ($payway) {
            case '1':
                $field = 'weixin';
                break;
            case '2':
                $field = 'alipay';
                break; 
            case '3':
                $field = 'bank_no';
                break;
            default:
                $field = '';    
        }        
        return Db::name('customer')->where(array('customer_id'=>$customer_id))->field('bank_name,'.$field)->find();
    }
	/*添加应收账款单 insert*/
	public function insert_money(){
		 
		$data['customer_id'] = $this->request->param('customer_id'); //客户id
		$data['true_money'] = $this->request->param('true_money'); //实际付款金额
		$data['fzr_worker_id'] = $this->request->param('fzr_worker_id');//负责人id
		$data['total_money'] = $this->request->param('total_money');	//总价
		$data['order_type'] = $this->request->param('order_type');	//订单类型
		$data['m_status'] = $this->request->param('m_status');	//付款状态
		$data['status'] = $this->request->param('status');	//订单状态
		$data['submit_status'] = $this->request->param('submit_status');	//交货状态
		$data['add_time'] = time();
		$data['order_no'] =$this->get_plan_sn();
		
		  $re= Db::name("sell_order")->insert($data); 
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
	
	    /**
     * [money_log 收支明细]
     * @return [type] [description]
     */
    public function money_log(){
		
		//获取条件变量
		$row = 3;
		$page = $this->request->param('page');
		$keywords = $this->request->param('keywords');
		$search_type = $this->request->param('search_type');
		$search_name = $this->request->param('search_name');
		$t1 = $this->request->param('t1');
		$t2 = $this->request->param('t2');
		if($page==1||!$page){
			$page = 0;
		}else{
			$page = ($page-1)*$row;
		}
		$orderlist = array();
		$condition = ' 1 = 1 ';
		
		
		if($search_type=='1'){
			 $condition .=' and o.type = 0'; 
		}
		if($search_type=='2'){
			 $condition .=' and o.type = 1'; 
		}
        //$condition .= $search_type ? ' and o.total_money <= o.true_money' : ' and o.total_money > o.true_money';
		
		
		if($t1){
			$t1 = substr($t1,0,10);
			$condition .=' and o.add_time >'.$t1;
		}
		if($t2){
			$t2 = substr($t2,0,10);
			$condition .=' and o.add_time <'.$t2;
		}
 
 
		
		if($search_name=='1'){
			$condition .= ' and o.order_no  like '."'%".$keywords."%'";
		}
		if($search_name=='2'){
			$condition .= ' and  o.cname  like '."'%".$keywords."%'";
		}	
 
 
 
        $count  =  Db::name('money_log')->alias('o')
 
                ->where($condition)
                ->count();               
                                
		
        /* 订单列搜索 */
        $orderlist = array();
        $orderlist = Db::name('money_log')->alias('o')                    
 
                    ->where($condition)
                    ->field('o.order_id,o.order_no,o.type,o.cname,o.payway,o.bank_name,o.add_time,o.create_time,o.money')
                    ->order('o.order_id desc')
                    ->limit($page,$row)
                    ->select();
		foreach($orderlist as $k=>$v){
			$orderlist[$k]['add_time'] = date('Y-m-d H:i:s',$v['add_time']);
			$orderlist[$k]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
			if($v['type']=='0'){
				$orderlist[$k]['type'] = '付款';
				$orderlist[$k]['come_from'] = '采购';
			}
			if($v['type']=='1'){
				$orderlist[$k]['type'] = '收款';
				$orderlist[$k]['come_from'] = '销售';
			}
 
			if($v['payway']=='1'){
				$orderlist[$k]['payway'] = '微信';
			}
			if($v['payway']=='2'){
				$orderlist[$k]['payway'] = '支付宝';
			}
			if($v['payway']=='3'){
				$orderlist[$k]['payway'] = '银行卡';
			}
			if($v['payway']=='4'){
				$orderlist[$k]['payway'] = '现金';
			}
		}
		
		 return json([
			'status' => 1,
			'msg'    => "获取成功",
			'data'   => $orderlist,
			'count'=>$count
		]);
		exit;
    }
	
	
	


}