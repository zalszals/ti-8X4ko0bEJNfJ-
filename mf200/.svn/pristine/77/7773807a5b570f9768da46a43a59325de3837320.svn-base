<?php
namespace app\worker\controller;

use app\base\controller\Base;
use think\Db;
use think\Request;

class Off extends Base{

	//添加调休单
	public function off_add(){

		$worker_id = request()->param('worker_id');
		$check_worker_1 = request()->param('check_worker_1');
		$check_worker_2 = request()->param('check_worker_2');
		$reason = request()->param('reason');
		$day = request()->param('day');
		$s_time = request()->param('s_time');
		$e_time = request()->param('e_time');
		$time_1 = request()->param('time_1');
		$time_2 = request()->param('time_2');
		$add_time = date('Y-m-d',strtotime(request()->param('add_time')));
		if(!$worker_id){

			return json(['status'=>0,'msg'=>'请选择申请人']);
		}

		if(!$check_worker_1){

			return json(['status'=>0,'msg'=>'请选择1级审批人']);
		}

/*		if(!$check_worker_2){

			return json(['status'=>0,'msg'=>'请选择2级审批人']);
		}*/

		if(!$reason){

			return json(['status'=>0,'msg'=>'请输入调休原因']);
		}

		if(!$day){

			return json(['status'=>0,'msg'=>'请输入调休天数']);
		}

		if(!is_numeric($day)){

			return json(['status'=>0,'msg'=>'调休天数必须为数字']);
		}

		if(!$time_1){

			return json(['status'=>0,'msg'=>'请输入加班起始时间']);
		}

		if(!$time_2){

			return json(['status'=>0,'msg'=>'请输入加班结束时间']);
		}

		if(!$s_time){

			return json(['status'=>0,'msg'=>'请输入调休起始时间']);
		}

		if(!$e_time){

			return json(['status'=>0,'msg'=>'请输入调休结束时间']);
		}

		if(!$add_time){

			return json(['status'=>0,'msg'=>'请选择日期']);
		}

		$data['worker_id'] = $worker_id;
		$data['check_worker_1'] = $check_worker_1;
		//$data['check_worker_2'] = $check_worker_2;
		$data['reason'] = $reason;
		$data['day'] = round($day,2);
		$data['time_1'] = date('Y-m-d H:i:s',strtotime($time_1));
		$data['time_2'] = date('Y-m-d H:i:s',strtotime($time_2));
		$data['s_time'] = date('Y-m-d H:i:s',strtotime($s_time));
		$data['e_time'] = date('Y-m-d H:i:s',strtotime($e_time));
		$data['add_time'] = $add_time;
		$data['type'] = 2;
		$data['status'] = 0;

		$re = Db::name('bill')->insert($data);

		if($re){ 

            return json(['status'=>1,'msg'=>'申请成功']);

        }else{

            return json(['status'=>0,'msg'=>'申请失败']);
        }
	}

	//调休单列表

	public  function off_list(){

		$type = request()->param('type');
		$start = request()->param('start');
		$end = request()->param('end');
		$worker = request()->param('worker');
		$group = request()->param('group');
		$worker_id = request()->param('worker_id');
		$group_id = request()->param('group_id');

		if($type == 1){

			//$con['status'] = 1;
			$con['status'] = 0;

			if($worker_id){
				$con['status'] = array('lt',2);	
			}
			if($group_id){
				$con['status'] = 0;
			}
		}elseif($type == 2){

			$con['status'] = 1;
			//$con['status'] = 2;
			if($group_id){
				$con['status'] = array(['gt',0],['lt',3]);;
			}
		}else{

			//$con['status'] = 4;
			$con['status'] = 3;

			if($group_id){
				$con['status'] = 3;
			}

			if($worker_id){
				$con['status'] = array('gt',2);
			}
		}

		if($worker_id){

			$con['worker_id'] = $worker_id;
		}

		if($group_id){

			$con1['group_id'] = $group_id;
		}

		if($start){

			$con['add_time'] = array('egt',date('Y-m-d',strtotime($start)));
		}

		if($end){

			$con['add_time'] = array('elt',date('Y-m-d',strtotime($end)));
		}

		if($start && $end){
			$con['add_time'] = array(array('egt',date('Y-m-d',strtotime($start))),array('elt',date('Y-m-d',strtotime($end))));
		}

		if($worker){
			$con2['worker_name'] =  array('like','%'.trim($worker).'%');
		}

		if($group){
			$con3['group_name'] =  array('like','%'.trim($group).'%');
		}

		$con['type'] = 2;

		$info = Db::name('bill')->where($con)->field('b_id,worker_id,check_worker_1,check_worker_2,check_time_1,check_time_2,add_time,reason,day,status,type,s_time,e_time,time_1,time_2')->order('add_time desc')->select();

		$arr = array();

		foreach($info as $k=>$v){

			$con2['worker_id'] = $v['worker_id'];

			$worker_name = Db::name('worker')->where($con2)->value('worker_name');

			$con1['worker_id'] = $v['worker_id'];

			$group_id1 = Db::name('worker')->where($con1)->value('group_id');

			$con3['group_id'] = $group_id1;

			$group_name = Db::name('group')->where($con3)->value('group_name');

			$check_name_1 = Db::name('worker')->where('worker_id',$v['check_worker_1'])->value('worker_name');

			$info[$k]['worker_name'] = $worker_name;
			$info[$k]['group_id'] = $group_id1;
			$info[$k]['group_name'] = $group_name;
			$info[$k]['check_name_1'] = $check_name_1;

			$check_name_2 = Db::name('worker')->where('worker_id',$v['check_worker_2'])->value('worker_name');

			if(!$info[$k]['check_worker_2']){
				$info[$k]['check_worker_2'] = '';
			}
			if(!$check_name_2){
				$check_name_2 = '';
			}
			if(!$info[$k]['check_time_1']){
				$info[$k]['check_time_1'] = '';
			}
			if(!$info[$k]['check_time_2']){
				$info[$k]['check_time_2'] = '';
			}

			$info[$k]['check_name_2'] = $check_name_2;

			if(isset($info[$k]['worker_name'])  && isset($info[$k]['group_name']) && isset($info[$k]['group_id'])){

				$arr[] =  $info[$k];
			}

		}
		
		return json(['status'=>1,'msg'=>'查询成功','data'=>$arr]);
	}

}