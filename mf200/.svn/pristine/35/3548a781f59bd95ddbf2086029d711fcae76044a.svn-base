<?php
namespace app\finance\controller;

use app\base\controller\Base;
use think\Db;
use think\Request;

class  Account extends Base{

	//应收应付单
	public function account(){

		$type = request()->param('type');
		$style = request()->param('style');
		$page = request()->param('page');
		$start = request()->param('start');
		$end = request()->param('end');
		$company = request()->param('company');

		$row = 3;
		if($page == 1 || !$page){
           $page = 0;
       	}else{
            $page = ($page-1)*$row;
        }

		if(!$type){
			return json(['status'=>0,'msg'=>'type值有误']);
		}
		if(!$style){
			return json(['status'=>0,'msg'=>'style值有误']);
		}

		if($type == 1){
			$con['status'] = 1;
		}else{
			$con['status'] = 2;
		}

		if($style == 1){
			$con['type'] = 1;
		}else{
			$con['type'] = 2;
		}

		if($start){

			$con['add_time'] = array('egt',date('Y-m-d 00:00:00',strtotime($start)));
		}

		if($end){

			$con['add_time'] = array('elt',date('Y-m-d 24:00:00',strtotime($end)));
		}

		if($start && $end){

			$con['add_time'] = array(['egt',date('Y-m-d 00:00:00',strtotime($start))],['elt',date('Y-m-d 24:00:00',strtotime($end))]);
		}

		$info = Db::name('arap')->where($con)->field('a_id,a_sn,pid,origin,worker_id,group_id,add_time,supply_id,num,sum,check_worker_id,check_time,status,type')->order('insert_time desc')->select();
		$str = '';
		$arr = array();
		$str = str_replace(':null', ':""', json_encode($info));
		$arr = json_decode($str,'true');
		$array = array();
		foreach($arr as $k=>$v){
			$con1 = array();
			$arr[$k]['worker_name'] = Db::name('worker')->where('worker_id',$v['worker_id'])->value('worker_name');
			$arr[$k]['group_name'] = Db::name('group')->where('group_id',$v['group_id'])->value('group_name');
			if($v['origin'] == 1){
				$con1['supply_id'] = $v['supply_id'];
				if($company){
					$con1['supply_name'] = array('like','%'.trim($company).'%');
					$arr[$k]['company'] = Db::name('supply')->where($con1)->value('supply_name');
				}else{
					$arr[$k]['company'] = Db::name('supply')->where('supply_id = '.$v['supply_id'])->value('supply_name');
				}
				
			}elseif($v['origin'] == 2){
				$con1['order_id'] = $v['pid'];
				if($company){
					$con1['company_name'] = array('like','%'.trim($company).'%');
					$arr[$k]['company'] = Db::name('sell_order')->where($con1)->value('company_name'); 
				}else{
					$arr[$k]['company'] = Db::name('sell_order')->where('order_id = '.$v['pid'])->value('company_name'); 
				}
				
			}
			if(!$company){
				if(!$arr[$k]['company']){
					$arr[$k]['company'] = '';
				}
			}
			$arr[$k]['add_time'] = date('Y-m-d',strtotime($v['add_time']));
			$arr[$k]['num'] = round($v['num'],2);
			$arr[$k]['sum'] = round($v['sum'],2);
			if($v['check_worker_id']){
				$arr[$k]['check_worker_name'] = Db::name('worker')->where('worker_id',$v['check_worker_id'])->value('worker_name');
			}else{
				$arr[$k]['check_worker_name'] = '';
			}
			if($v['check_time']){
				$arr[$k]['check_time'] = date('Y/m/d H:i:s',strtotime($v['check_time']));
			}else{
				$arr[$k]['check_time'] = '';
			}
			$pay_sum = Db::name('arap_cash')->where('a_id',$v['a_id'])->field('sum(money) as m')->select();
			if($pay_sum[0]['m']){
				$arr[$k]['pay_sum'] = round($pay_sum[0]['m'],2);
			}else{
				$arr[$k]['pay_sum'] = 0;
			}
			$arr[$k]['diff_sum'] = $arr[$k]['sum']-$arr[$k]['pay_sum'];
			if($v['origin'] == 1){
				$arr[$k]['origin_name'] = '采购开单';
			}elseif($v['origin'] == 2){
				$arr[$k]['origin_name'] = '销售开单';
			}
			if($company){
				if($arr[$k]['company']){
					$array[] = $arr[$k];
				}
			}else{
				$array[] = $arr[$k];
			}
		}
		$total = count($array);
		$arr1 = array();
		for($i = 0;$i < $row;$i++){
			if(isset($array[$page+$i])){
				$arr1[$i] = $array[$page+$i];
			}
		}
		if($arr1){
			return json(['status'=>1,'msg'=>'查询成功','count'=>$total,'data'=>$arr1]);
		}else{
			return json(['status'=>1,'msg'=>'查询成功','count'=>0,'data'=>array()]);
		}
	}

	//应收应付单详情
	public function account_detail(){

		$a_id = request()->param('a_id');

		if(!$a_id){
			return json(['status'=>0,'msg'=>'单据id有误']);
		}

		$con['a_id'] = $a_id;

		$data = Db::name('arap_detail')->where($con)->select();

		foreach($data as $k=>$v){
			$info = Db::name('materiel')->where('m_id',$v['m_id'])->field('m_name,unit')->find();
			$data[$k]['m_name'] = $info['m_name'];
			$data[$k]['unit'] = $info['unit'];
			if(!$v['sum']){
				$data[$k]['sum'] = '';
			}
		}

		$data1 = Db::name('arap_cash')->where($con)->select();

		foreach($data1 as $k=>$v){
			$data1[$k]['add_time'] = date('Y-m-d',strtotime($v['add_time']));
		}

		if(!$data){
			$data = array();
		}

		if(!$data1){
			$data1 = array();
		}
		$company='';
		$info_arap = Db::name('arap')->where('a_id = '.$a_id)->field('a_id,a_sn,pid,origin,worker_id,group_id,add_time,supply_id,num,sum,check_worker_id,check_time,status,type')->find();
		
		
		

			$info_arap['worker_name'] = Db::name('worker')->where('worker_id',$info_arap['worker_id'])->value('worker_name');
			$info_arap['group_name'] = Db::name('group')->where('group_id',$info_arap['group_id'])->value('group_name');
			if($info_arap['origin'] == 1){
				$con1['supply_id'] = $info_arap['supply_id'];
				if($company){
					$con1['supply_name'] = array('like','%'.trim($company).'%');
				}
				$info_arap['company'] = Db::name('supply')->where($con1)->value('supply_name');
			}elseif($info_arap['origin'] == 2){
				$con1['order_id'] = $info_arap['pid'];
				if($company){
					$con1['company_name'] = array('like','%'.trim($company).'%');
				}
				$info_arap['company'] = Db::name('sell_order')->where($con1)->value('company_name'); 
			}
			if(!$company){
				if(!$info_arap['company']){
					$info_arap['company'] = '';
				}
			}
			$info_arap['add_time'] = date('Y-m-d',strtotime($info_arap['add_time']));
			$info_arap['num'] = round($info_arap['num'],2);
			$info_arap['sum'] = round($info_arap['sum'],2);
			if($info_arap['check_worker_id']){
				$info_arap['check_worker_name'] = Db::name('worker')->where('worker_id',$info_arap['check_worker_id'])->value('worker_name');
			}else{
				$info_arap['check_worker_name'] = '';
			}
			if($info_arap['check_time']){
				$info_arap['check_time'] = date('Y/m/d H:i:s',strtotime($info_arap['check_time']));
			}else{
				$info_arap['check_time'] = '';
			}
			$pay_sum = Db::name('arap_cash')->where('a_id',$info_arap['a_id'])->field('sum(money) as m')->select();
			if($pay_sum[0]['m']){
				$info_arap['pay_sum'] = round($pay_sum[0]['m'],2);
			}else{
				$info_arap['pay_sum'] = 0;
			}
			$info_arap['diff_sum'] = $info_arap['sum']-$info_arap['pay_sum'];
			if($info_arap['origin'] == 1){
				$info_arap['origin_name'] = '采购开单';
			}elseif($info_arap['origin'] == 2){
				$info_arap['origin_name'] = '销售开单';
			}


		
		return json(['status'=>1,'msg'=>'查询成功','data'=>$data,'info_arap'=>$info_arap,'info'=>$data1]);
	}

	//添加收付款信息
	public function account_add(){

		$a_id = request()->param('a_id');
		$money = request()->param('money');
		$way = request()->param('way');
		$add_time = request()->param('add_time');

		if(!$a_id){
			return json(['status'=>0,'msg'=>'单据id有误']);
		}

		if(!$money){
			return json(['status'=>0,'msg'=>'请输入金额']);
		}

		if(!$way){
			return json(['status'=>0,'msg'=>'请输入方式']);
		}

		if(!$add_time){
			return json(['status'=>0,'msg'=>'请选择时间']);
		}
		$data['a_id'] = $a_id;
		$data['money'] = $money;
		$data['way'] = $way;
		$data['add_time'] = date('Y-m-d',strtotime($add_time));

		$re = Db::name('arap_cash')->insert($data);
		$data1 = Db::name('arap_cash')->where('a_id = '.$a_id)->select();

		foreach($data1 as $k=>$v){
			$data1[$k]['add_time'] = date('Y-m-d',strtotime($v['add_time']));
		}

		if($re){
			$ar = Db::name('arap')->where('a_id',$a_id)->field('origin,type,pid')->find();
			if($ar['origin'] == 2 && $ar['type'] == 2){
				$num = 0;
				foreach($data1 as $k=>$v){
					$num += $v['money'];
				}
				Db::name('sell_order')->where('order_id',$ar['pid'])->setField('true_money',$num);
			}
			return json(['status'=>1,'msg'=>'添加成功','info'=>$data1]);
		}else{
			return json(['status'=>0,'msg'=>'添加失败','info'=>$data1]);
		}
	}
	
	//获取编辑信息 pc 使用
	public function account_edit_get(){
		$cash_id = request()->param('cash_id');
		$data1 = Db::name('arap_cash')->where('cash_id = '.$cash_id)->find();
		return json(['status'=>1,'msg'=>'查询成功','info'=>$data1]);
	}

	//编辑收付款信息
	public function account_edit(){

		$cash_id = request()->param('cash_id');
		$money = request()->param('money');
		$way = request()->param('way');
		$add_time = request()->param('add_time');

		if(!$cash_id){
			return json(['status'=>0,'msg'=>'单据id有误']);
		}

		if(!$money){
			return json(['status'=>0,'msg'=>'请输入金额']);
		}

		if(!$way){
			return json(['status'=>0,'msg'=>'请输入方式']);
		}

		if(!$add_time){
			return json(['status'=>0,'msg'=>'请选择时间']);
		}
		$data['cash_id'] = $cash_id;
		$data['money'] = $money;
		$data['way'] = $way;
		$data['add_time'] = date('Y-m-d',strtotime($add_time));

		$re = Db::name('arap_cash')->where('cash_id',$cash_id)->update($data);

		if($re !== false){
			return json(['status'=>1,'msg'=>'编辑成功']);
		}else{
			return json(['status'=>0,'msg'=>'编辑失败']);
		}
	}

	//删除收付款信息
	public function account_del(){
		$cash_id = request()->param('cash_id');
		$a_id = request()->param('a_id');
		if(!$cash_id){
			return json(['status'=>0,'msg'=>'单据id有误']);
		}

		$re = Db::name('arap_cash')->where('cash_id',$cash_id)->delete();
		$data1 = Db::name('arap_cash')->where('a_id = '.$a_id)->select();

		foreach($data1 as $k=>$v){
			$data1[$k]['add_time'] = date('Y-m-d',strtotime($v['add_time']));
		}

		if($re){
			return json(['status'=>1,'info'=>$data1,'msg'=>'删除成功']);
		}else{
			return json(['status'=>0,'info'=>$data1,'msg'=>'删除失败']);
		}
	}

	//审核应收付单
	public function account_check(){

		$a_id = request()->param('a_id');

		if(!$a_id){
			return json(['status'=>0,'msg'=>'单据id有误']);
		}

		$worker_id = $this->worker['worker_id'];

		$data['status'] = 2;
		$data['check_worker_id'] = $worker_id;
		$data['check_time'] = date('Y-m-d H:i:s',time());

		$re = Db::name('arap')->where('a_id',$a_id)->update($data);

		if($re !== false){
			return json(['status'=>1,'msg'=>'审核成功']);
		}else{
			return json(['status'=>0,'msg'=>'审核失败']);
		}
	}

	//收支明细
	public function account_balance(){

		$start = request()->param('start');
		$end = request()->param('end');
		$type = request()->param('type');

		$s_time = date('Y-m-01 00:00:00',time());
		$e_time = date('Y-m-d 24:00:00',strtotime("$s_time +1 month -1 day"));
		$con['add_time'] = array(['egt',$s_time],['elt',$e_time]);
		if($start){

			$con['add_time'] = array('egt',date('Y-m-d 00:00:00',strtotime($start)));
		}

		if($end){

			$con['add_time'] = array('elt',date('Y-m-d 24:00:00',strtotime($end)));
		}

		if($start && $end){

			$con['add_time'] = array(['egt',date('Y-m-d 00:00:00',strtotime($start))],['elt',date('Y-m-d 24:00:00',strtotime($end))]);
		}

		$info = Db::name('arap_cash')->where($con)->select();

		$data = array();
		if($info){
			foreach($info as $k=>$v){
				$info[$k]['money'] = round($v['money'],2);
				$info[$k]['add_time'] = date('Y-m-d',strtotime($v['add_time']));
				if($type){
					if($type == 1){
						$con1['type'] = 2;
					}else{
						$con1['type'] = 1;
					}
				}
				$con1['a_id'] = $v['a_id']; 
				$list = Db::name('arap')->where($con1)->field('origin,pid,supply_id,type')->find();
				if($list){
					if($list['type'] == 1){
						$info[$k]['type'] = '付款';
					}else{
						$info[$k]['type'] = '收款';
					}
					if($list['origin'] == 1){
						if($list['type'] == 1){
							$info[$k]['origin'] = '采购开单';
						}else{
							$info[$k]['origin'] = '采购退货';
						}
						
						$info[$k]['company'] = Db::name('supply')->where('supply_id',$list['supply_id'])->value('supply_name');
					}else{
						$info[$k]['origin'] = '销售开单';
						$info[$k]['company'] = Db::name('sell_order')->where('order_id',$list['pid'])->value('company_name'); 
					}
					if(!$info[$k]['company']){
						$info[$k]['company'] = '';
					}
					$data[] = $info[$k];
				}
			}
		}
		return json(['status'=>1,'msg'=>'查询成功','data'=>$data]);
	}
	//pc端应收应付单
	public function pc_account(){

		$type = request()->param('type');
		$style = request()->param('style');
		$page = request()->param('page');
		$start = request()->param('start');
		$end = request()->param('end');
		$company = request()->param('company');

		$row = 3;
		if($page == 1 || !$page){
           $page = 0;
       	}else{
            $page = ($page-1)*$row;
        }

		if(!$type){
			return json(['status'=>0,'msg'=>'type值有误']);
		}
		if(!$style){
			return json(['status'=>0,'msg'=>'style值有误']);
		}

		if($type == 1){
			$con['status'] = 1;
		}else{
			$con['status'] = 2;
		}

		if($style == 1){
			$con['type'] = 1;
		}else{
			$con['type'] = 2;
		}

		if($start){

			$con['add_time'] = array('egt',date('Y-m-d 00:00:00',strtotime($start)));
		}

		if($end){

			$con['add_time'] = array('elt',date('Y-m-d 24:00:00',strtotime($end)));
		}

		if($start && $end){

			$con['add_time'] = array(['egt',date('Y-m-d 00:00:00',strtotime($start))],['elt',date('Y-m-d 24:00:00',strtotime($end))]);
		}

		$info = Db::name('arap')->where($con)->field('a_id,a_sn,pid,origin,worker_id,group_id,add_time,supply_id,num,sum,check_worker_id,check_time,status,type')->paginate(1);
		
		$page = $info->render();
		$list = $info->items();
		$jsonStr = json_encode($info);
		$info = json_decode($jsonStr,true);
		$pages = $info['last_page'];
			
		
		
		$str = '';
		$arr = array();
		$str = str_replace(':null', ':""', json_encode($list));
		$arr = json_decode($str,'true');
		$array = array();
		
		
		foreach($arr as $k=>$v){
			$arr[$k]['worker_name'] = Db::name('worker')->where('worker_id',$v['worker_id'])->value('worker_name');
			$arr[$k]['group_name'] = Db::name('group')->where('group_id',$v['group_id'])->value('group_name');
			if($v['origin'] == 1){
				$con1['supply_id'] = $v['supply_id'];
				if($company){
					$con1['supply_name'] = array('like','%'.trim($company).'%');
				}
				$arr[$k]['company'] = Db::name('supply')->where($con1)->value('supply_name');
			}elseif($v['origin'] == 2){
				$con1['order_id'] = $v['pid'];
				if($company){
					$con1['company_name'] = array('like','%'.trim($company).'%');
				}
				$arr[$k]['company'] = Db::name('sell_order')->where($con1)->value('company_name'); 
			}
			if(!$company){
				if(!$arr[$k]['company']){
					$arr[$k]['company'] = '';
				}
			}
			$arr[$k]['add_time'] = date('Y-m-d',strtotime($v['add_time']));
			$arr[$k]['num'] = round($v['num'],2);
			$arr[$k]['sum'] = round($v['sum'],2);
			if($v['check_worker_id']){
				$arr[$k]['check_worker_name'] = Db::name('worker')->where('worker_id',$v['check_worker_id'])->value('worker_name');
			}else{
				$arr[$k]['check_worker_name'] = '';
			}
			if($v['check_time']){
				$arr[$k]['check_time'] = date('Y/m/d H:i:s',strtotime($v['check_time']));
			}else{
				$arr[$k]['check_time'] = '';
			}
			$pay_sum = Db::name('arap_cash')->where('a_id',$v['a_id'])->field('sum(money) as m')->select();
			if($pay_sum[0]['m']){
				$arr[$k]['pay_sum'] = round($pay_sum[0]['m'],2);
			}else{
				$arr[$k]['pay_sum'] = 0;
			}
			$arr[$k]['diff_sum'] = $arr[$k]['sum']-$arr[$k]['pay_sum'];
			if($v['origin'] == 1){
				$arr[$k]['origin_name'] = '采购开单';
			}elseif($v['origin'] == 2){
				$arr[$k]['origin_name'] = '销售开单';
			}
			if($company){
				if($arr[$k]['company']){
					$array[] = $arr[$k];
				}
			}else{
				$array[] = $arr[$k];
			}
		}

		$page_list = array();
		$page_list['page'] = $page;
		$page_list['pages'] = $pages;
		$page_list['list'] = $arr;
		
		return json([
			'status' =>1,
			'msg'    => "查询成功",
			'data'   => $page_list,
			]);
		exit;
	}
	
	//pc端 收支明细
	public function pc_account_balance(){

		$start = request()->param('start');
		$end = request()->param('end');
		$type = request()->param('type');

		$s_time = date('Y-m-01 00:00:00',time());
		$e_time = date('Y-m-d 24:00:00',strtotime("$s_time +1 month -1 day"));
		$con['add_time'] = array(['egt',$s_time],['elt',$e_time]);
		if($start){

			$con['add_time'] = array('egt',date('Y-m-d 00:00:00',strtotime($start)));
		}

		if($end){

			$con['add_time'] = array('elt',date('Y-m-d 24:00:00',strtotime($end)));
		}

		if($start && $end){

			$con['add_time'] = array(['egt',date('Y-m-d 00:00:00',strtotime($start))],['elt',date('Y-m-d 24:00:00',strtotime($end))]);
		}

		$info = Db::name('arap_cash')->where($con)->select();

		$data = array();
		if($info){
			foreach($info as $k=>$v){
				$info[$k]['money'] = round($v['money'],2);
				$info[$k]['add_time'] = date('Y-m-d',strtotime($v['add_time']));
				if($type){
					if($type == 1){
						$con1['type'] = 2;
					}else{
						$con1['type'] = 1;
					}
				}
				$con1['a_id'] = $v['a_id']; 
				$list = Db::name('arap')->where($con1)->field('origin,pid,supply_id,type')->find();
				if($list){
					if($list['type'] == 1){
						$info[$k]['type'] = '付款';
					}else{
						$info[$k]['type'] = '收款';
					}
					if($list['origin'] == 1){
						if($list['type'] == 1){
							$info[$k]['origin'] = '采购开单';
						}else{
							$info[$k]['origin'] = '采购退货';
						}
						
						$info[$k]['company'] = Db::name('supply')->where('supply_id',$list['supply_id'])->value('supply_name');
					}else{
						$info[$k]['origin'] = '销售开单';
						$info[$k]['company'] = Db::name('sell_order')->where('order_id',$list['pid'])->value('company_name'); 
					}
					if(!$info[$k]['company']){
						$info[$k]['company'] = '';
					}
					$data[] = $info[$k];
				}
			}
		}
		return json(['status'=>1,'msg'=>'查询成功','data'=>$data]);
	}

	
}