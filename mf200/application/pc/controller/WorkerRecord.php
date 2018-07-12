<?php
namespace app\pc\controller;

use app\base\controller\Base;
use think\Db;
use think\Request;

class WorkerRecord extends Base{

	//添加考勤时间
	public function add_time(){

		$group_id = request()->param('group_id');

		$start = request()->param('start');

		$end = request()->param('end');

		if(!$group_id){

			return json(['status'=>0,'msg'=>'部门id有误']);

		}

		if(!$start){

			return json(['status'=>0,'msg'=>'请选择签到时间']);

		}

		if(!$end){

			return json(['status'=>0,'msg'=>'请选择签退时间']);

		}

		$con['group_id'] = $group_id;

		$find = Db::name('ad_time')->where($con)->find();

		$data['group_id'] = $group_id;
		$data['start'] = date('H:i',strtotime($start));
		$data['end'] = date('H:i',strtotime($end));

		if($find){

			$re = Db::name('ad_time')->where($con)->update($data);

		}else{

			$re = Db::name('ad_time')->where($con)->insert($data);
		}
 		if($re !== false){ 

            return json(['status'=>1,'msg'=>'设置成功']);

        }else{

            return json(['status'=>0,'msg'=>'设置失败']);
        }

	}

	//考勤时间列表
	public function time_list(){

		$grouplist = Db::name('group')->field('group_id,group_name')->where('is_buy',1)->where('group_id','neq',1)->select();
		$group_id = request()->param('group_id');
		if($group_id){
			$con['group_id'] = $group_id;
		}else{
			$con['group_id'] = $grouplist[0]['group_id'];
		}
		$find = array();

		$find = Db::name('ad_time')->where($con)->find();

		if($find){

			return json(['status'=>1,'msg'=>'查询成功','data'=>$find,'group'=>$grouplist]);

		}else{

			$array = array();
			$array['time_id'] = '';
			$array['start'] = '';
			$array['end'] = '';
			$array['group_id'] = '';

			return json(['status'=>1,'msg'=>'查询成功','data'=>$array,'group'=>$grouplist]);
		}

	}

	//签到
	public function record_start(){

		$addr = request()->param('addr');

		$worker = $this->worker;
		$worker_id = $worker['worker_id'];
		$group_id = $worker['group_id'];

		$find = Db::name('ad_time')->where('group_id',$group_id)->find();
		
		$data1['s_time'] = '';
		$data1['e_time'] = '';
		$data1['rid'] = '';
		if(!$find){
			return json(['status'=>0,'msg'=>'请先设置部门签到签退时间','data'=>$data1]);
		}

		$time = time();
		$con['worker_id'] = $worker_id;
		$con['date'] = date('Y-m-d',$time);
		$info = Db::name('ad_record')->where($con)->find();

		if($info){
			return json(['status'=>0,'msg'=>'已签到','data'=>$data1]);
		}
		$data['start_time'] = $find['start'];
		$data['end_time'] = $find['end'];
		$data['worker_id'] = $worker_id;
		$data['s_time'] = date('H:i',$time);
		$data['s_addr'] = $addr;
		$data['date'] = date('Y-m-d',$time);
		$data['status'] = 0;

		$rid = Db::name('ad_record')->insertGetId($data);

		$data = array();

		if($rid){
			$data['s_time'] = date('Y-m-d H:i:s',$time);
			$data['e_time'] = '';
			$data['rid'] = $rid;
			return json(['status'=>1,'msg'=>'签到成功','data'=>$data]);
		}else{
			return json(['status'=>0,'msg'=>'签到失败','data'=>$data1]);
		}
	}


	//签退
	public function record_end(){

		$rid = request()->param('rid');
		$addr = request()->param('addr');

		if(!$rid){
			return json(['status'=>0,'msg'=>'考勤id有误']);
		}
		$find = Db::name('ad_record')->where('r_id',$rid)->find();
		
		$data1['s_time'] = date('Y-m-d',strtotime($find['date'])).' '.date('H:i:s',strtotime($find['s_time']));
		$data1['e_time'] = '';
		$data1['rid'] = $rid;

		$time = time();
		$date = Db::name('ad_record')->where('r_id',$rid)->value('date');
		$date1 = date('Y-m-d',$time);

		if(trim($date) != trim($date1)){

			return json(['status'=>0,'msg'=>'签退已过期，无法签退！','data'=>$data1]);
		}

		$data['e_time'] = date('H:i',$time);
		$data['e_addr'] = $addr;
		$data['status'] = 1;

		$re = Db::name('ad_record')->where('r_id',$rid)->update($data);

		$info = array();
		if($re !== false){
			$info['s_time'] = date('Y-m-d',strtotime($find['date'])).' '.date('H:i:s',strtotime($find['s_time']));
			$info['e_time'] = date('Y-m-d H:i:s',$time);
			$info['rid'] = $rid;
			return json(['status'=>1,'msg'=>'签退成功','data'=>$info]);
		}else{
			return json(['status'=>0,'msg'=>'签退失败','data'=>$data1]);
		}

	}

	//签到状态
	public function record(){
		$date = date('Y-m-d',time());
		$worker = $this->worker;
		$worker_id = $worker['worker_id'];

		$con['date'] = $date;
		$con['worker_id'] = $worker_id;
		$find = Db::name('ad_record')->where($con)->find();
		if($find){
			if($find['status'] == 0){
				$data['s_time'] = date('Y-m-d',strtotime($find['date'])).' '.date('H:i:s',strtotime($find['s_time']));
				$data['e_time'] = '';
				$data['rid'] = $find['r_id'];
			}else{
				$data['s_time'] = date('Y-m-d',strtotime($find['date'])).' '.date('H:i:s',strtotime($find['s_time']));
				$data['e_time'] = date('Y-m-d',strtotime($find['date'])).' '.date('H:i:s',strtotime($find['e_time']));
				$data['rid'] = $find['r_id'];
			}
		}else{
			$data['s_time'] = '';
			$data['e_time'] = '';
			$data['rid'] = '';
		}
		return json(['status'=>1,'msg'=>'查询成功','data'=>$data]);
	}

	//员工考勤列表
	public function record_list(){

		$worker_name = request()->param('worker_name');
		$group_name = request()->param('group_name');
		$role_name = request()->param('role_name');
		$start_time = request()->param('start_time');
		$end_time = request()->param('end_time');
		$type = request()->param('type');
		$class = request()->param('class_type');

		if(!$class){

			return json(['status'=>0,'msg'=>'class值有误']);
		}

		$w  =  $this->worker;
		$g_id = $w['group_id'];
		$w_id = $w['worker_id'];

		if($class == 2){

			$where = " FIND_IN_SET($w_id ,w.worker_code)";
		}else{
			$where = '';
		}


		if(isset($worker_name) && $worker_name){

			$con['w.worker_name'] = array('like','%'.trim($worker_name).'%');
		}
		if(isset($role_name) && $role_name){

			$con['r.role_name'] = array('like','%'.trim($role_name).'%');
		}
		if(isset($group_name) && $group_name){

			$con['g.group_name'] = array('like','%'.trim($group_name).'%');
		}

		$con['w.status'] = 1;

		$info = Db::name('worker w')
			->field('worker_id,worker_name,pid,w.role_id,w.group_id,r.role_name,g.group_name')
			->join('mf_group g','g.group_id = w.group_id')
			->join('mf_role r','r.role_id = w.role_id')
			->where($con)->where($where)->order('w.worker_id')
			->paginate(6);

		$page = $info->render();
        $list = $info->items();        
        $jsonStr = json_encode($info);
        $info = json_decode($jsonStr,true);
        $pages = $info['last_page']; 
        $page_list = array();
        $page_list['page'] = $page;
        $page_list['pages'] = $pages;

		$arr = array();
		$arr = $info['data'];
		
		if($arr){
			foreach($arr as $k=>$v){

				if($type == 2){

					$begin = date('Y-m-d', strtotime(date('Y-m-01') . ' -1 month'));
					$finish = date('Y-m-d', strtotime(date('Y-m-01') . ' -1 day'));
					$days = round((strtotime($finish)-strtotime($begin))/3600/24)+1;

				}else{

					$begin = date('Y-m-01', strtotime(date('Y-m-d')));
					$finish	= date('Y-m-d', strtotime("{$begin} +1 month -1 day"));
					$days = round((strtotime(date('Y-m-d'))-strtotime($begin))/3600/24)+1;
				}

				$con3['date'] = array(['egt',$begin],['elt',$finish]);
				$con4['add_time'] = array(['egt',$begin],['elt',$finish]);
				$con5['add_time'] = array(['egt',$begin],['elt',$finish]);
				$con6['add_time'] = array(['egt',$begin],['elt',$finish]);
				$con7['add_time'] = array(['egt',$begin],['elt',$finish]);

				if(isset($start_time) || isset($end_time)){
					if($start_time && !$end_time){
						return json(['status'=>0,'msg'=>'请选择结束时间']);
					}
					if(!$start_time && $end_time){
						return json(['status'=>0,'msg'=>'请选择开始时间']);
					}
					
					if($start_time && $end_time){


						$con3['date'] = array(['egt',$start_time],['elt',$end_time]);
						$days = round((strtotime($end_time)-strtotime($start_time))/3600/24)+1;
						$con4['add_time'] = array(['egt',$start_time],['elt',$end_time]);
						$con5['add_time'] = array(['egt',$begin],['elt',$finish]);
						$con6['add_time'] = array(['egt',$begin],['elt',$finish]);
						$con7['add_time'] = array(['egt',$begin],['elt',$finish]);
					}

				}

				$con3['worker_id'] = $v['worker_id'];

				$info = Db::name('ad_record')->where($con3)->field('start_time,end_time,s_time,e_time')->select();

				$count = count($info);

				$arr[$k]['wqd_num'] = $days - $count;

				$date = Db::name('ad_record')->where($con3)->where('status',0)->select();

				$array = array();

				foreach($date as $k1=>$v1){

					if(strtotime($v1['date']) != strtotime(date('Y-m-d'))){

						$array[] = $v1; 
					}
				}
				$arr[$k]['wqt_num'] = count($array);

				$i = 0;
				$j = 0;

				foreach($info as $k1=>$v1){

					if($v1['s_time'] > $v1['start_time']){

						$i++;
					}

					if($v1['e_time'] != null && $v1['e_time'] < $v1['end_time']){

						$j++;
					}
				}

				$arr[$k]['cd_num'] = $i;
				$arr[$k]['zt_num'] = $j;

				//$con4['status'] = 2;
				$con4['status'] = 1;
				$con4['type'] = 0;
				$con4['worker_id'] = $v['worker_id'];
				$bill_day = Db::name('bill')->where($con4)->column('day');
				$m = 0;
				foreach($bill_day as $k1=>$v1){
					$m += $v1;
				}
				//$con5['status'] = 2;
				$con5['status'] = 1;
				$con5['type'] = 3;
				$con5['worker_id'] = $v['worker_id'];
				$bill_day2 = Db::name('bill')->where($con5)->column('day');
				$n = 0;
				foreach($bill_day2 as $k1=>$v1){
					$n += $v1;
				}

				$con6['status'] = 1;
				$con6['type'] = 1;
				$con6['worker_id'] = $v['worker_id'];
				$bill_day3 = Db::name('bill')->where($con6)->column('day');
				$x = 0;
				foreach($bill_day3 as $k1=>$v1){
					$x += $v1;
				}


				$con7['status'] = 1;
				$con7['type'] = 2;
				$con7['worker_id'] = $v['worker_id'];
				$bill_day4 = Db::name('bill')->where($con7)->column('day');
				$y = 0;
				foreach($bill_day4 as $k1=>$v1){
					$y += $v1;
				}

				$arr[$k]['qj_num'] = $m; 
				$arr[$k]['wq_num'] = $n; 
				$arr[$k]['jb_num'] = $x; 
				$arr[$k]['tx_num'] = $y;
			}

		}else{
			$arr = array();
		}
		return json(['status'=>1,'msg'=>'查询成功','total'=>$page_list,'data'=>$arr]);
	}

	//员工考勤列表详情
	public function record_list_detail(){

		$worker_id = request()->param('worker_id');
		$type = request()->param('type');
		$start_time = request()->param('start_time');
		$end_time = request()->param('end_time');

		$date = array();

		if($type == 2){

			$begin = date('Y-m-d', strtotime(date('Y-m-01') . ' -1 month'));
			$finish = date('Y-m-d', strtotime(date('Y-m-01') . ' -1 day'));
			$days = round((strtotime($finish)-strtotime($begin))/3600/24)+1;

		}else{

			$begin = date('Y-m-01', strtotime(date('Y-m-d')));
			$finish	= date('Y-m-d', strtotime("{$begin} +1 month -1 day"));
			$days = round((strtotime(date('Y-m-d'))-strtotime($begin))/3600/24)+1;
		}

		$con['date'] = array(['egt',$begin],['elt',$finish]);
		$con1['add_time'] = array(['egt',$begin],['elt',$finish]);
		$con2['add_time'] = array(['egt',$begin],['elt',$finish]);
		$con3['add_time'] = array(['egt',$begin],['elt',$finish]);
		$con4['add_time'] = array(['egt',$begin],['elt',$finish]);


		if(isset($start_time) || isset($end_time)){


			if($start_time && $end_time){

				$con['date'] = array(['egt',$start_time],['elt',$end_time]);
				$days = round((strtotime($end_time)-strtotime($start_time))/3600/24)+1;
				$begin = $start_time;

				$con1['add_time'] = array(['egt',$start_time],['elt',$end_time]);
				$con2['add_time'] = array(['egt',$begin],['elt',$finish]);
				$con3['add_time'] = array(['egt',$begin],['elt',$finish]);
				$con4['add_time'] = array(['egt',$begin],['elt',$finish]);
			}

		}

		$str = strtotime($begin);

		for($i = 0; $i < $days; $i++){

	        $date[] = date('Y-m-d', $str+(86400*$i));
	    }

		$con['worker_id'] = $worker_id;

		$info = Db::name('ad_record')->where($con)->field('start_time,end_time,s_time,e_time,date')->select();
		$info1 = Db::name('ad_record')->where($con)->column('date');
		$arr = array();

		if($info1){
			foreach($date as $k=>$v){
				if(!in_array($v,$info1)){
					$arr[] = $v;
				}
			}
		}else{
			$arr = $date;
		}

		$data['wqd'] = $arr;

		$find = Db::name('ad_record')->where($con)->where('status',0)->column('date');

		$array = array();
		
		foreach($find as $k=>$v){

			if(strtotime($v) != strtotime(date('Y-m-d'))){

				$array[] = $v; 
			}
		}

		$data['wqt'] = $array;

		$arr1 = array();
		$arr2 = array();

		foreach($info as $k=>$v){

			if($v['s_time'] > $v['start_time']){
				
				$arr1[] = $v['date'];
			}

			if($v['e_time'] != null && $v['e_time'] < $v['end_time']){

				$arr2[] = $v['date'];
			}
		}

		$data['cd'] = $arr1;
		$data['zt'] = $arr2;

		//$con1['status'] = 2;
		$con1['status'] = 1;
		$con1['type'] = 0;
		$con1['worker_id'] = $worker_id;
		$bill_day = Db::name('bill')->where($con1)->field('s_time,e_time')->select();
		//$con2['status'] = 2;
		$con2['status'] = 1;
		$con2['type'] = 3;
		$con2['worker_id'] = $worker_id;
		$bill_day2 = Db::name('bill')->where($con2)->field('s_time,e_time')->select();

		$con3['status'] = 1;
		$con3['type'] = 1;
		$con3['worker_id'] = $worker_id;
		$bill_day3 = Db::name('bill')->where($con3)->field('s_time,e_time')->select();

		$con4['status'] = 1;
		$con4['type'] = 2;
		$con4['worker_id'] = $worker_id;
		$bill_day4 = Db::name('bill')->where($con4)->field('s_time,e_time')->select();
		$data['qj'] = $bill_day;
		$data['wq'] = $bill_day2;
		$data['jb'] = $bill_day3;
		$data['tx'] = $bill_day4;

		$arr3 = array();
		$arr4 = array();
		$j = 0;
		foreach($data['wqd'] as $k=>$v){
			$arr3['name'][] = '未签到';
			$arr4['time'][] = $v; 
		}
		foreach($data['wqt'] as $k=>$v){
			$arr3['name'][] = '未签退';
			$arr4['time'][] = $v; 
		}
		foreach($data['cd'] as $k=>$v){
			$arr3['name'][] = '迟到';
			$arr4['time'][] = $v; 
		}
		foreach($data['zt'] as $k=>$v){
			$arr3['name'][] = '早退';
			$arr4['time'][] = $v; 
		}
		foreach($data['qj'] as $k=>$v){
			$arr3['name'][] = '请假';
			$arr4['time'][] = $v; 
		}
		foreach($data['wq'] as $k=>$v){
			$arr3['name'][] = '外勤';
			$arr4['time'][] = $v; 
		}
		foreach($data['jb'] as $k=>$v){
			$arr3['name'][] = '加班';
			$arr4['time'][] = $v; 
		}
		foreach($data['tx'] as $k=>$v){
			$arr3['name'][] = '调休';
			$arr4['time'][] = $v; 
		}

		return json(['status'=>1,'msg'=>'查询成功','data'=>$arr3['name'],'time'=>$arr4['time']]);

	}
}