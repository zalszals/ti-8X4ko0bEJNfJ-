<?php
namespace app\interim\controller;

use app\base\controller\Base;
use think\Db;
use think\Request;

class Interim extends Base{

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
 
 

}
