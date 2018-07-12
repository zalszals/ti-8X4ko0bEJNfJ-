<?php
namespace app\product\controller;
use app\base\controller\Base;
use think\Db;

class ProductSum extends Base{
	
	/**
	 * [1 prosum_list 生产汇总列表]
	 * @param post传参 
	 * @return [type] status 状态值 msg 返回信息 data 返回数据
	 */
	public function prosum_list(){
		//状态条件：status：状态值 0 ：未审核， -1：删除 1 ：审核通过 2 :未通过
		
		//获取变量（筛选条件）
		$plan_name = $this->request->param('plan_name');
		$cat_name = $this->request->param('cat_name');
		if($plan_name){
			$con['p.plan_name'] = array('like','%'.$plan_name.'%');
		}
		if($cat_name){
			$con['mc1.cat_name'] = array('like','%'.$cat_name.'%');
		}
		
		
		
		$con['p.status'] = array('neq',-1);
		$field[] = 'p.plan_id';
		$field[] = 'p.plan_name';
		$field[] = 'p.add_time';
		$field[] = 'p.estimate_amount as yg_amount';//预估总产量
		$field[] = 'p.cost_worker'; //人工成本
		$field[] = 'p.cost_materiel';//物料成本
		$field[] = 'p.cost_amount';//能耗成本
		$field[] = 'p.cost_total as yg_cost';//能耗成本
		$field[] = 'mc1.cat_name';//能耗成本
		
		$data = Db::name('product_plan p')
				->join('materiel_category mc','mc.cat_id = p.cat_id')
				->join('materiel_category mc1','mc1.cat_id = mc.pid')
				->field(implode(',',$field))
				->where($con)
				->order('p.add_time desc')
				->select();		
		$newdata = array();
		if($data){
			foreach($data as $k=>$v){
				$newdata[$k]['plan_id'] = $v['plan_id'];
				$newdata[$k]['plan_name'] = $v['plan_name'];
				$newdata[$k]['add_time'] = date('Y/m/d',strtotime($v['add_time']));
				$newdata[$k]['yg_amount'] = $v['yg_amount'];
				$newdata[$k]['yg_cost'] = $v['yg_cost'];
				$newdata[$k]['worker'] = $v['cost_worker'];
				$newdata[$k]['materiel'] = $v['cost_materiel'];
				$newdata[$k]['amount'] = $v['cost_amount'];
				$newdata[$k]['cat_name'] = $v['cat_name'];
				
				$plan_id = $v['plan_id'];

				$newdata[$k]['estimate_amount'] = 0;

				$newdata[$k]['estimate_amount'] = Db::name('pro_worker_job')->where('plan_id',$plan_id)->sum('num');

				$con2['plan_id'] = $plan_id;
				$con2['status'] = 3;
				$info = Db::name('pro_worker_job')
							->field('require_time_1,require_time_2')
							->where($con2)
							->select();
				if($info){
					$worketime = 0;
					foreach($info as $k1 => $v1){
						$require_time_1 = strtotime($v1['require_time_1']);
						$require_time_2 = strtotime($v1['require_time_2']);
						$wt = $require_time_2-$require_time_1;
						$worketime += round(($wt/3600),2);
					}
					$newdata[$k]['worker_time'] = $worketime;
					
				}else{
					$newdata[$k]['worker_time'] = 0;
				}
				
				$newdata[$k]['cost_amount'] = 0;

				$cost_amount = Db::name('pro_losses')->where('plan_id',$plan_id)->field('gas,gas_price,water,water_price,co2,co2_price,electric,electric_price')->select();
				
				$gas = 0;
				$water = 0;
				$co2 = 0;
				$electric = 0;
				
				$gas_price = 0;
				$water_price = 0;
				$co2_price = 0;
				$electric_price = 0;


				if($cost_amount){

					foreach($cost_amount as $k1=>$v1){
						
						$gas += $v1['gas']; //所有天然气用量
						$co2 += $v1['co2']; //所有二氧化碳用量
						$water += $v1['water']; //所有水的用量
						$electric += $v1['electric']; //所有电的用量
						
						$gas_price += $v1['gas_price'];//所有天然气单价
						$co2_price += $v1['co2_price'];//所有二氧化碳单价
						$water_price += $v1['water_price'];//所有水的单价
						$electric_price += $v1['electric_price']; //所有电的单价
						
						$count = count($cost_amount);

						$gas_price_d = $gas_price/$count;
						$co2_price_d = $co2_price/$count;
						$water_price_d = $water_price/$count;
						$electric_price_d = $electric_price/$count;
						
						$gas_total = $gas*$gas_price_d; //所有天然气的总价
						$co2_total = $co2*$co2_price_d;
						$water_total = $water*$water_price_d;
						$electric_total = $electric*$electric_price_d;
					}
					$newdata[$k]['cost_amount'] = round($gas_total + $water_total + $co2_total + $electric_total,2);

				}

				$con3['b.plan_id'] = $plan_id;
				$con3['d.status'] = 3;

				$cost_materiel = Db::name('pro_take_back b')
						->join('pro_take_back_detail d','b.tb_id = d.tb_id')
						->join('materiel m','d.m_id = m.m_id')
						->field('b.type,d.num,d.m_id,m.price')
						->where($con3)
						->select();
				if($cost_materiel){

					$arr = array();		
					foreach($cost_materiel as $k1=>$v1){

						$arr[$v1['m_id']][] = $v1;
					}
					$total_price = 0;

					foreach($arr as $k1=>$v1){

						$cost = 0;

						foreach($v1 as $k2=>$v2){

							if($v2['type'] == 1){

								$cost += $v2['num'];
							}

							if($v2['type'] == 2){

								$cost -= $v2['num'];

							}
						}

						$total_price += $v1[0]['price'] * $cost;
					}

					$newdata[$k]['cost_materiel'] = $total_price;

				}else{

					$newdata[$k]['cost_materiel'] = 0;

				}
				$w = 0;
				$m = $newdata[$k]['cost_materiel'];
				$h = $newdata[$k]['cost_amount'];
				$total_cost = $w+$m+$h;//总成本
				$newdata[$k]['total_cost'] = $total_cost;
				
			}
			
		}
		$result['status'] = 1;
		$result['msg'] = '获取成功';
		$result['data'] = $newdata;
		ajaxReturnJson($result);
	}

	/**
	 * [2 prosum_list_detail 生产汇总详情]
	 * @param post传参 plan_id 生产计划id s_time 生产计划发布时间 e_time 结束时间
	 * @return [type] status 状态值 msg 返回信息 data 返回数据
	 */
	public function prosum_list_detail(){

		$plan_id = $this->request->param('plan_id'); 

		$s_time = $this->request->param('s_time');

		$e_time = $this->request->param('e_time');

		if(!$plan_id){

			$result['status'] = 0;

			$result['msg'] = "生产计划id为空";

			ajaxReturnJson($result);
		}

		if(!$s_time){

			$result['status'] = 0;

			$result['msg'] = "开始时间为空";

			ajaxReturnJson($result);
		}

		if(empty($e_time)){

			$e_time = date('Y-m-d H:i:s',time());
		}

		$s_time = date('Y-m-d 00:00:00',strtotime($s_time));

		$e_time = date('Y-m-d 24:00:00',strtotime($e_time));

		$data = array();

		$data['day'] = $this->harvest_day($plan_id,$s_time,$e_time);

		$data['materiel'] = $this->materiel_cost($plan_id,$s_time,$e_time);

		$data['worktime'] = $this->task_time($plan_id,$s_time,$e_time);

		$data['energy'] = $this->energy($plan_id,$s_time,$e_time);

		$result['status'] = 1;

		$result['msg'] = "获取成功";

		$result['data'] = $data;

		ajaxReturnJson($result);

	}

	/**
	 * [3 harvest_day 日产量详情]
	 * @param post传参 plan_id 生产计划id s_time 生产计划发布时间 e_time 结束时间
	 * @return [type] return
	 */
	public function harvest_day($plan_id,$s_time,$e_time){

		$con['plan_id'] = $plan_id;

		$con['add_time'] = array(array('gt',$s_time),array('lt',$e_time));

		$data = Db::name('pro_harvest_day')->field('num_1,num_2,one_weight,percentum_1')->where($con)->select();

		$arr = array(); 

		if($data){

			$count = count($data);

			$num1 = 0;

			$num2 = 0;

			$one_weight = 0;

			$percentum_1 = 0;

			foreach($data as $k=>$v){

				$num1 += $v['num_1'];

				$num2 += $v['num_2'];

				$one_weight += $v['one_weight'];

				$percentum_1 += $v['percentum_1'];

			}

			$arr['num1'] = $num1;

			$arr['num2'] = $num2;

			$arr['one_weight'] = round(($one_weight / $count),2);

			$arr['rate'] = round(($percentum_1 / $count),2);
		}else{

			$arr['num1'] = 0;

			$arr['num2'] = 0;

			$arr['one_weight'] = 0;

			$arr['rate'] = 0;

		}

		return $arr;
	}

	/**
	 * [4 materiel_cost 物料成本详情]
	 * @param post传参 plan_id 生产计划id s_time 生产计划发布时间 e_time 结束时间
	 * @return [type] return
	 */
	public function materiel_cost($plan_id,$s_time,$e_time){

		$con['b.plan_id'] = $plan_id;

		$con['d.status'] = 3;

		$con['b.add_time'] = array(array('gt',$s_time),array('lt',$e_time));

		$data = Db::name('pro_take_back b')

				->join('pro_take_back_detail d','b.tb_id = d.tb_id')

				->join('materiel m','d.m_id = m.m_id')

				->field('b.type,d.num,m.m_id,m.m_name,m.unit,m.price')

				->where($con)

				->select();

		$list  = array();		

		if($data){

			$arr = array();

			foreach($data as $k=>$v){

				$arr[$v['m_id']][] = $v;
			}

			foreach($arr as $k=>$v){

				$array = array();

				$num = 0;

				foreach($v as $k1=>$v1){

					if($v1['type'] == 1){

						$num += $v1['num'];
					}

					if($v1['type'] == 2){

						$num -= $v1['num'];

					}
				}

				$array['m_name'] = $v[0]['m_name'];

				$array['num'] = $num;

				$array['unit'] = $v[0]['unit'];

				$array['total_price'] = $v[0]['price'] * $num;

				$list[] = $array;
			}

			$sum = 0;

			foreach($list as $k=>$v){

				$sum += $v['total_price'];
			}
			
			$list[0]['sum'] = $sum;
		}

		return $list;

	}
	/**
	 * [5 energy 生产汇总详情-能耗]
	 * @param post传参 
	 * @return [type] status 状态值 msg 返回信息 data 返回数据
	 */
	public function energy($plan_id,$s_time,$e_time){
		$con['plan_id'] = $plan_id;
		$con['add_time'] = array(array('gt',$s_time),array('lt',$e_time));
		$field[] = 'gas'; //天然气
		$field[] = 'gas_price';
		$field[] = 'co2'; //二氧化碳
		$field[] = 'co2_price';
		$field[] = 'water'; //水
		$field[] = 'water_price';
		$field[] = 'electric'; //电
		$field[] = 'electric_price';
		$field[] = 'add_time';
		
		
		
		
		$data = Db::name('pro_losses')
				->field(implode(',',$field))
				->where($con)
				->select();
		$newdata = array();	
		$gas = 0;
		$co2 = 0;
		$water = 0;
		$electric = 0;
		$gas_total = 0;
		$co2_total = 0;
		$water_total = 0;
		$electric_total = 0;
		$total_all = 0;	
		if($data){//有:累加 无：为0
			
			$gas_price = 0;
			$co2_price = 0;
			$water_price = 0;
			$electric_price = 0;
			
			foreach($data as $k=>$v){
				
				$gas += $v['gas']; //所有天然气用量
				$co2 += $v['co2']; //所有二氧化碳用量
				$water += $v['water']; //所有水的用量
				$electric += $v['electric']; //所有电的用量
				
				$gas_price += $v['gas_price'];//所有天然气单价
				$co2_price += $v['co2_price'];//所有二氧化碳单价
				$water_price += $v['water_price'];//所有水的单价
				$electric_price += $v['electric_price']; //所有电的单价
				
			}
			$num = count($data);
			$gas_price_d = $gas_price/$num;
			$co2_price_d = $co2_price/$num;
			$water_price_d = $water_price/$num;
			$electric_price_d = $electric_price/$num;
			
			$gas_total = $gas*$gas_price_d; //所有天然气的总价
			$co2_total = $co2*$co2_price_d;
			$water_total = $water*$water_price_d;
			$electric_total = $electric*$electric_price_d;
		}else{
			$gas_price_d = 0;
			$co2_price_d = 0;
			$water_price_d = 0;
			$electric_price_d = 0;
		}
		$total_all = ($gas_total+$co2_total+$water_total+$electric_total);
		$newdata['gas'] = round($gas,2);
		$newdata['co2'] = round($co2,2);
		$newdata['water'] = round($water,2);
		$newdata['electric'] = round($electric,2);
		
		$newdata['gas_price_d'] = round($gas_price_d,2);
		$newdata['co2_price_d'] = round($co2_price_d,2);
		$newdata['water_price_d'] = round($water_price_d,2);
		$newdata['electric_price_d'] = round($electric_price_d,2);
		
		$newdata['gas_total'] =  round($gas_total,2);
		$newdata['co2_total'] =  round($co2_total,2);
		$newdata['water_total'] =  round($water_total,2);
		$newdata['electric_total'] =  round($electric_total,2);
		$newdata['total_all'] =  round($total_all,2);
		
		return $newdata;
		
	}
	/**
	 * [6 task_time($plan_id,$s_time,$e_time) 生产汇总详情-工时]
	 * @param post传参 
	 * @return [type] status 状态值 msg 返回信息 data 返回数据
	 */
	public function task_time($plan_id,$s_time,$e_time){
		$con['plan_id'] = $plan_id;
		$con['wj.status'] = 3;
		$con['add_time'] = array(array('gt',$s_time),array('lt',$e_time));
		
		$field[] = 'wj.skill_id';
		$field[] = 'ws.skill_name';
		$field[] = 'wj.require_time_1';
		$field[] = 'wj.require_time_2';
		
		
		
		$data = Db::name('pro_worker_job wj')
				->join('work_skill ws','ws.skill_id = wj.skill_id')
				->field(implode(',',$field))
				->where($con)
				->select();
		

		$newdata = array(); 
		$newdata1 = array();
		$newdata2 = array();		
		if($data){
			foreach($data as $row){
				$key = $row['skill_id'];
				if (array_key_exists($key, $newdata)) {
					$newdata[$key]['require_time_1'] +=  strtotime($row['require_time_1']);
					$newdata[$key]['require_time_2'] +=  strtotime($row['require_time_2']);
					$newdata[$key]['skill_name'] = $row['skill_name'];
				}else{
					$row['require_time_1'] = strtotime($row['require_time_1']);
					$row['require_time_2'] = strtotime($row['require_time_2']);
					$newdata[$key] = $row;	
				}
				
			}
			foreach($newdata as $key=>$v){
				$newdata1[] = $v;
				
			}
			$moneys = 0;
			$gs_z = 0;

			foreach($newdata1 as $k=>$val){

				$require_time_1 = $val['require_time_1'];
				$require_time_2 = $val['require_time_2'];
				$val['gs_time'] = round(($require_time_2-$require_time_1)/3600,2);
				$val['money'] = 0;//每道工序的总价
				$newdata2[] = $val;
				$moneys += $val['money'];
				$gs_z += $val['gs_time'];
			}
			$newdata2[0]['moneys'] = $moneys;
			$newdata2[0]['gs_z'] = $gs_z; 
			//$newdata2[] = $val1;
			
			
		}
		return $newdata2;
		
	}
	
	
}