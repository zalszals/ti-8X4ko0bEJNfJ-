<?php

namespace app\home\controller;
use app\home\controller\Base;
use think\Loader;
use think\Db;
class Code extends Base {

	//生产码信息
	public function code(){

		$h_id = request()->param('h_id');
		$batch_no = request()->param('batch_no');
		$detail_id = request()->param('detail_id');

		$data = Db::name('pro_harvest_day h')
			->join('product_plan p','h.plan_id = p.plan_id')
			->join('pro_grow_task t','h.t_id = t.t_id')
			->join('materiel_category g','h.cat_id = g.cat_id')
			->join('materiel_category go','g.pid = go.cat_id')
			->join('grow_mode mo','t.grow_mode_id = mo.mode_id')
			->join('grow_area a','h.area_id = a.area_id')
			->join('worker w','t.worker_id = w.worker_id')
			->field('p.plan_name,t.t_name,g.cat_name,w.worker_name,g.fcolor,g.ftype,go.cat_name as p_name,mo.mode_name,a.area_name,t.zhu_ju,t.hang_ju,t.grow_date,h.get_time,h.href')
			->where('h_id',$h_id)
			->find();
		$data['get_time'] = date('Y-m-d',strtotime($data['get_time']));

		$arr = array();
		if(isset($detail_id)){
			$info = Db::name('sell_batch_detail d')
					->join('sell_batch s','d.batch_id = s.batch_id')
					->join('sell_order o','d.order_id = o.order_id')
					->join('materiel m','d.m_id = m.m_id')
					->where('d.detail_id',$detail_id)
					->field('d.m_num,d.m_id,s.*,m.m_name,o.customer_name,o.customer_phone,o.customer_address,o.ask_info,o.other_ask,m.unit')
					->find();
			$info['submit_time'] = date('Y-m-d H:i:s',$info['submit_time']);
			$info['real_time'] = date('Y-m-d H:i:s',$info['real_time']);
			$info['batch_no'] = $batch_no;
			$str = '';
			$str = str_replace(':null', ':""', json_encode($info));
			$arr = json_decode($str,'true');
		}
		 $this->assign('data', $data);
		// $this->assign('info', $arr);
		return $this->fetch();
		 // return(json(array('status'=>1,'msg'=>'查询成功','data'=>$data,'info'=>$arr)));
	}

	//生产码列表
	public function code_list(){

		$page = request()->param('page');
		$row = 5;
		if($page == 1 || !$page){
           $page = 0;
       	}else{
            $page = ($page-1)*$row;
        }

        $count =  Db::name('pro_harvest_day p')->join('pro_grow_task t','p.t_id = t.t_id')->field('p.h_id,p.t_id,p.get_time,p.num,t.t_name')->order('p.get_time desc')->count();

        $data = Db::name('pro_harvest_day p')->join('pro_grow_task t','p.t_id = t.t_id')->field('p.h_id,p.t_id,p.get_time,p.num,t.t_name')->order('p.get_time desc')->limit($page,$row)->select();
		
		$arr = array();
		if($data){
			$str = '';
			$str = str_replace(':null', ':""', json_encode($data));
			$arr = json_decode($str,'true');
			foreach($arr as $k=>$v){
				$arr[$k]['get_time'] = date('Y-m-d',strtotime($v['get_time']));
			}
		}

		return(json(array('status'=>1,'msg'=>'查询成功','count'=>$count,'data'=>$arr)));
	}

	//生产码详情
	public function code_detail(){

		$h_id = request()->param('h_id');

		if(!$h_id){
			return json(['status'=>0,'msg'=>'产量分拣id有误']);
		}

		$data = Db::name('pro_harvest_day h')
			->join('product_plan p','h.plan_id = p.plan_id')
			->join('pro_grow_task t','h.t_id = t.t_id')
			->join('materiel_category g','h.cat_id = g.cat_id')
			->join('materiel_category go','g.pid = go.cat_id')
			->join('grow_mode mo','t.grow_mode_id = mo.mode_id')
			->join('grow_area a','h.area_id = a.area_id')
			->join('worker w','t.worker_id = w.worker_id')
			->field('p.plan_name,t.t_name,g.cat_name,w.worker_name,g.fcolor,g.ftype,go.cat_name as p_name,mo.mode_name,a.area_name,t.zhu_ju,t.hang_ju,t.grow_date,h.get_time,h.href,h.href_t,h.percentum_1,h.percentum_2')
			->where('h_id',$h_id)
			->find();
		$data['get_time'] = date('Y-m-d',strtotime($data['get_time']));
		if(!$data['href']){
			$data['href'] = '';
		}
		if(!$data['href_t']){
			$data['href_t'] = '';
		}

		return(json(array('status'=>1,'msg'=>'查询成功','data'=>$data)));
	}

	//果蔬出入库详情
	public function inout_detail(){

		$id = request()->param('id');
		$type = request()->param('type');
		if(!$type){
			return json(['status'=>0,'msg'=>'type值有误']);
		}else{
			if($type == 1){
				if(!$id){
					return json(['status'=>0,'msg'=>'入库id有误']);
				}
			}else{
				if(!$id){
					return json(['status'=>0,'msg'=>'出库id有误']);
				}
			}
		}

		$con['d.io_id'] = $id;
		$con['d.status'] = 4;
		if($type == 1){
			$con['d.l_type'] = 14;
			$data = Db::name('ck_insert_detail d')->join('ck_insert i','d.io_id = i.insert_id')->field('d.batch_no,d.num,d.href,d.ck_worker,i.check_time')->where($con)->find();
			$arr = explode('&&',$data['href']);
		    $arr1 = explode('=',$arr[0]);
		    $h_id = $arr1[1];
			$data1 = Db::name('pro_harvest_day h')
				->join('product_plan p','h.plan_id = p.plan_id')
				->join('pro_grow_task t','h.t_id = t.t_id')
				->join('materiel_category g','h.cat_id = g.cat_id')
				->join('materiel_category go','g.pid = go.cat_id')
				->join('grow_mode mo','t.grow_mode_id = mo.mode_id')
				->join('grow_area a','h.area_id = a.area_id')
				->join('worker w','t.worker_id = w.worker_id')
				->field('p.plan_name,t.t_name,g.cat_name,w.worker_name,g.fcolor,g.ftype,go.cat_name as p_name,mo.mode_name,a.area_name,t.zhu_ju,t.hang_ju,t.grow_date,h.get_time,h.percentum_1,h.percentum_2')
				->where('h_id',$h_id)
				->find();
		    $data1['batch_no'] = $data['batch_no'];
		    $data1['num'] = $data['num'];
		    if($data['ck_worker']){
		    	$data1['czy'] = Db::name('worker')->where('worker_id',$data['ck_worker'])->value('worker_name');
		    }else{
		    	$data1['czy'] = '';
		    }
		    $data1['get_time'] = date('Y-m-d',strtotime($data1['get_time']));
		    $data1['check_time'] = date('Y-m-d H:i:s',$data['check_time']);
		}else{
			$con['d.l_type'] = 100;
			$data = Db::name('ck_out_detail d')->field('d.batch_no,d.num,d.href,d.ck_worker,d.add_time')->where($con)->select();
			$data1 = array();
			foreach($data as $k=>$v){
				$arr = explode('&&',$v['href']);
			    $arr1 = explode('=',$arr[0]);
			    $arr2 = explode('=',$arr[3]);
			    $h_id = $arr1[1];
			    $detail_id = $arr2[1];
			    $data2 = Db::name('pro_harvest_day h')
					->join('product_plan p','h.plan_id = p.plan_id')
					->join('pro_grow_task t','h.t_id = t.t_id')
					->join('materiel_category g','h.cat_id = g.cat_id')
					->join('materiel_category go','g.pid = go.cat_id')
					->join('grow_mode mo','t.grow_mode_id = mo.mode_id')
					->join('grow_area a','h.area_id = a.area_id')
					->join('worker w','t.worker_id = w.worker_id')
					->field('p.plan_name,t.t_name,g.cat_name,w.worker_name,g.fcolor,g.ftype,go.cat_name as p_name,mo.mode_name,a.area_name,t.zhu_ju,t.hang_ju,t.grow_date,h.get_time,h.percentum_1,h.percentum_2')
					->where('h_id',$h_id)
					->find();
				$data2['batch_no'] = $v['batch_no'];
			    $data2['num'] = $v['num'];
			    if($v['ck_worker']){
			    	$data2['czy'] = Db::name('worker')->where('worker_id',$v['ck_worker'])->value('worker_name');
			    }else{
			    	$data2['czy'] = '';
			    }
			    	$data2['get_time'] = date('Y-m-d',strtotime($data2['get_time']));
			    	$data2['check_time'] = $v['add_time'];	
				}
				$info = Db::name('sell_batch_detail d')
					->join('sell_batch s','d.batch_id = s.batch_id')
					->join('sell_order o','d.order_id = o.order_id')
					->join('materiel m','d.m_id = m.m_id')
					->where('d.detail_id',$detail_id)
					->field('d.m_num,s.*,m.m_name,o.order_no,m.unit,o.add_worker_id,o.total_kg')
					->find();
				$str = '';
				$str = str_replace(':null', ':""', json_encode($info));
				$info = json_decode($str,'true');
				$data2['m_num'] = $info['m_num'];
				$data2['m_name'] = $info['m_name'];
				$data2['order_no'] =  $info['order_no'];
				$data2['unit'] =  $info['unit'];
				$data2['xsy'] = Db::name('worker')->where('worker_id',$info['add_worker_id'])->value('worker_name');
				$data2['total'] = $info['total_kg'];
				$data2['type'] = $info['type'];
				$data2['car_clxh'] = $info['car_clxh'];
				$data2['car_cp'] = $info['car_cp'];
				$data2['car_yslx'] = $info['car_yslx'];
				$data2['car_sjxm'] = $info['car_sjxm'];
				$data2['car_lxfs'] = $info['car_lxfs'];
				$data2['car_kdgs'] = $info['car_kdgs'];
				$data2['car_kddh'] = $info['car_kddh'];
				$data1[] = $data2;
		}
		return(json(array('status'=>1,'msg'=>'查询成功','data'=>$data1)));
	}

	//产品追朔列表
	public function trace(){
		$con['status'] = 4;
		$con['l_type'] = 14;
		$data = Db::name('ck_insert_detail')->where($con)->field('id,add_time,type,href')->select();
		if(!$data){
			$data = array();
		}
		foreach($data as $k=>$v){
			$arr = explode('&&',$v['href']);
		    $arr1 = explode('=',$arr[0]);
		    $h_id = $arr1[1];
		    $data[$k]['h_id'] = $h_id;
		}
		$con1['status'] = 4;
		$con1['l_type'] = 100;
		$data1 = Db::name('ck_out_detail')->where($con1)->field('id,add_time,type,href')->select();
		if(!$data1){
			$data1 = array();
		}else{
			foreach($data1 as $k=>$v){
				$arr = explode('&&',$v['href']);
			    $arr1 = explode('=',$arr[0]);
			    $arr2 = explode('=',$arr[3]);
			    $h_id = $arr1[1];
			    $detail_id = $arr2[1];
			    $data1[$k]['order_no'] = Db::name('sell_batch_detail d')->join('sell_order o','d.order_id = o.order_id')->where('detail_id',$arr2[1])->value('order_no');
				$data1[$k]['h_id'] = $h_id;
				$data1[$k]['detail_id'] = $detail_id;
			}
		}
		$info = array_merge($data,$data1);
		$arr = array();
		foreach($info as $k=>$v){
			$arr[] = $v['add_time'];
		}
		array_multisort($arr, SORT_DESC, $info);

		return(json(array('status'=>1,'msg'=>'查询成功','data'=>$info)));
	}

	//产品追溯详情
	public function trace_detail(){
		$id = request()->param('id');
		$type = request()->param('type');
		$h_id = request()->param('h_id');
		if(!$id){
			return json(['status'=>0,'msg'=>'详情id有误']);
		}
		if(!$type){
			return json(['status'=>0,'msg'=>'type值有误']);
		}
		if(!$h_id){
			return json(['status'=>0,'msg'=>'生产信息id有误']);
		}

		if($type == 1){
			$data = Db::name('pro_harvest_day h')
				->join('product_plan p','h.plan_id = p.plan_id')
				->join('pro_grow_task t','h.t_id = t.t_id')
				->join('materiel_category g','h.cat_id = g.cat_id')
				->join('materiel_category go','g.pid = go.cat_id')
				->join('grow_mode mo','t.grow_mode_id = mo.mode_id')
				->join('grow_area a','h.area_id = a.area_id')
				->join('worker w','t.worker_id = w.worker_id')
				->field('p.plan_name,t.t_name,g.cat_name,w.worker_name,g.fcolor,g.ftype,go.cat_name as p_name,mo.mode_name,a.area_name,t.zhu_ju,t.hang_ju,t.grow_date,h.get_time,h.percentum_1,h.percentum_2')
				->where('h_id',$h_id)
				->find();
		    $data['get_time'] = date('Y-m-d',strtotime($data['get_time']));
		    $info = Db::name('ck_insert_detail')->where('id',$id)->field('batch_no,add_time')->find();
		    $data['batch_no'] = $info['batch_no'];
		    $data['add_time'] = $info['add_time'];
		}else{
			$detail_id = request()->param('detail_id');
			if(!$detail_id){
				return json(['status'=>0,'msg'=>'销售信息id有误']);
			}
		 	$data = Db::name('pro_harvest_day h')
				->join('product_plan p','h.plan_id = p.plan_id')
				->join('pro_grow_task t','h.t_id = t.t_id')
				->join('materiel_category g','h.cat_id = g.cat_id')
				->join('materiel_category go','g.pid = go.cat_id')
				->join('grow_mode mo','t.grow_mode_id = mo.mode_id')
				->join('grow_area a','h.area_id = a.area_id')
				->join('worker w','t.worker_id = w.worker_id')
				->field('p.plan_name,t.t_name,g.cat_name,w.worker_name,g.fcolor,g.ftype,go.cat_name as p_name,mo.mode_name,a.area_name,t.zhu_ju,t.hang_ju,t.grow_date,h.get_time,h.percentum_1,h.percentum_2')
				->where('h_id',$h_id)
				->find();
			$data['get_time'] = date('Y-m-d',strtotime($data['get_time']));
			$info1 = Db::name('ck_out_detail')->where('id',$id)->field('batch_no,add_time,ck_worker,num')->find();
			if($info1['ck_worker']){
		    	$data['czy'] = Db::name('worker')->where('worker_id',$info1['ck_worker'])->value('worker_name');
		    }else{
		    	$data['czy'] = '';
		    }
		    $data['num'] = $info1['num'];
			$data['add_time'] = Db::name('ck_out_detail')->where('batch_no',$info1['batch_no'])->value('add_time');
			$data['batch_no'] = $info1['batch_no'];
			$data['check_time'] = $info1['add_time'];
			$info = Db::name('sell_batch_detail d')
				->join('sell_batch s','d.batch_id = s.batch_id')
				->join('sell_order o','d.order_id = o.order_id')
				->join('materiel m','d.m_id = m.m_id')
				->where('d.detail_id',$detail_id)
				->field('d.m_num,s.*,m.m_name,o.order_no,m.unit,o.add_worker_id,o.total_kg')
				->find();
			$str = '';
			$str = str_replace(':null', ':""', json_encode($info));
			$info = json_decode($str,'true');
			$data['m_num'] = $info['m_num'];
			$data['m_name'] = $info['m_name'];
			$data['order_no'] =  $info['order_no'];
			$data['unit'] =  $info['unit'];
			$data['xsy'] = Db::name('worker')->where('worker_id',$info['add_worker_id'])->value('worker_name');
			$data['total'] = $info['total_kg'];
			$data['type'] = $info['type'];
			$data['car_clxh'] = $info['car_clxh'];
			$data['car_cp'] = $info['car_cp'];
			$data['car_yslx'] = $info['car_yslx'];
			$data['car_sjxm'] = $info['car_sjxm'];
			$data['car_lxfs'] = $info['car_lxfs'];
			$data['car_kdgs'] = $info['car_kdgs'];
			$data['car_kddh'] = $info['car_kddh'];	

		}
		return(json(array('status'=>1,'msg'=>'查询成功','data'=>$data)));	
	}
}