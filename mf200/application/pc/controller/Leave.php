<?php
namespace app\pc\controller;

use app\base\controller\Base;
use think\Db;
use think\Request;

class Leave extends Base{

	//添加请假单
	public function leave_add(){

		$worker_id = request()->param('worker_id');
		$check_worker_1 = request()->param('check_worker_1');
		$check_worker_2 = request()->param('check_worker_2');
		$reason = request()->param('reason');
		$day = request()->param('day');
		$s_time = request()->param('s_time');
		$e_time = request()->param('e_time');
		$style = request()->param('style');
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

			return json(['status'=>0,'msg'=>'请输入请假原因']);
		}

		if(!$day){

			return json(['status'=>0,'msg'=>'请输入请假天数']);
		}

		if(!is_numeric($day)){

			return json(['status'=>0,'msg'=>'请假天数必须为数字']);
		}

		if(!$s_time){

			return json(['status'=>0,'msg'=>'请输入请假起始时间']);
		}

		if(!$e_time){

			return json(['status'=>0,'msg'=>'请输入请假结束时间']);
		}

		if(!isset($style)){

			return json(['status'=>0,'msg'=>'请选择请假类别']);
		}

		if($style === ''){

			return json(['status'=>0,'msg'=>'请选择请假类别']);
		}

		if(!$add_time){

			return json(['status'=>0,'msg'=>'请选择日期']);
		}

		$data['worker_id'] = $worker_id;
		$data['check_worker_1'] = $check_worker_1;
		//$data['check_worker_2'] = $check_worker_2;
		$data['reason'] = $reason;
		$data['day'] = round($day,2);
		$data['s_time'] = date('Y-m-d H:i:s',strtotime($s_time));
		$data['e_time'] = date('Y-m-d H:i:s',strtotime($e_time));
		$data['style'] = $style;
		$data['add_time'] = $add_time;
		$data['type'] = 0;
		$data['status'] = 0;

		$re = Db::name('bill')->insert($data);

 		if($re){ 

            return json(['status'=>1,'msg'=>'申请成功']);

        }else{

            return json(['status'=>0,'msg'=>'申请失败']);
        }
	}

	// 审批人列表
	public function leave_worker(){

		$worker = $this->worker;
		$group_id = $worker['group_id'];
		$worker_1 = array();
		$worker_2 = array();
		$workers['worker_id'] = $worker['worker_id'];
		$workers['worker_name'] = $worker['worker_name'];
		$workers['group_id'] = $worker['group_id'];
		$workers['group_name'] = $worker['group_name'];
		$workers['add_time'] = date('Y-m-d',time());
		//1级审批人列表
		$con1['group_id'] = $group_id;
		$con1['status'] = 1;
		$worker_1 = array();
		$i = 0;
		$workerlist = Db::name('worker')->where($con1)->field('worker_id,worker_name,role_id')->select();
		if($workerlist){
			foreach($workerlist as $k=>$v){
				$node_str = Db::name('role')->where('role_id',$v['role_id'])->value('node_str');
				if(strpos($node_str,',24') !== false){
					$worker_1[$i]['worker_id'] = $v['worker_id'];
					$worker_1[$i]['worker_name'] = $v['worker_name'];
					$i++;
				}
			}
		}else{
			$worker_1 = array();
		}
		//2级审批人列表

		$con2['status'] = array('gt',0);
		$worker_2 = Db::name('worker')->where($con2)->field('worker_id,worker_name')->select();
		if(!$worker_2){
			$worker_2 = array();
		}
		$data['worker_1'] = $worker_1;

		$data['worker_2'] = $worker_2;

		return json(['status'=>1,'msg'=>'查询成功','data'=>$data,'worker'=>$workers]);

	}

	//人事请假单列表

	public  function leave_list(){

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

		$con['type'] = 0;

		$info = Db::name('bill')->where($con)->field('b_id,worker_id,check_worker_1,check_worker_2,check_time_1,check_time_2,add_time,reason,day,style,status,type,s_time,e_time')->order('add_time desc')->select();

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
		foreach($arr as $k=>$v){
			switch($v['style']){
				case 0:
					$arr[$k]['style_name'] = '事假';
					break;
				case 1:
					$arr[$k]['style_name'] = '病假';
					break;
				case 2:
					$arr[$k]['style_name'] = '调休';
					break;
				case 3:
					$arr[$k]['style_name'] = '年假';
					break;
				case 4:
					$arr[$k]['style_name'] = '婚假';
					break;
				case 5:
					$arr[$k]['style_name'] = '产假';
					break;
				case 6:
					$arr[$k]['style_name'] = '丧假';
					break;
				case 7:
					$arr[$k]['style_name'] = '其他';
					break;
			}
		}
		return json(['status'=>1,'msg'=>'查询成功','data'=>$arr]);
	}

	//审核请假单
	public function leave_check(){

		//$group_id = request()->param('group_id');
		$b_id = request()->param('b_id');
		$type = request()->param('type');

	/*	if($group_id){
			$data['check_time_1'] = date('Y-m-d H:i:s',time());
			if($type == 1){
				$data['status'] = 1;
			}else{
				$data['status'] = 3;
			}
		}else{
			$data['check_time_2'] = date('Y-m-d H:i:s',time());
			if($type == 1){
				$data['status'] = 2;
			}else{
				$data['status'] = 4;
			}
		}*/
			$data['check_time_1'] = date('Y-m-d H:i:s',time());
			if($type == 1){
				$data['status'] = 1;
			}else{
				$data['status'] = 3;
			}

		$con['b_id'] = $b_id;

		$re = Db::name('bill')->where($con)->update($data);

		if($re !== false){ 

            return json(['status'=>1,'msg'=>'审核成功']);

        }else{

            return json(['status'=>0,'msg'=>'审核失败']);
        }
	}


	//我的单据列表（主要）

	public  function regroup(){

		$type = request()->param('type');
		$worker_name = request()->param('worker_name');
		$style = request()->param('style');
		$start = request()->param('start');
		$end = request()->param('end');
		$class = request()->param('class_type');

		$worker_id = $this->worker['worker_id'];
		if(!$class){

			return json(['status'=>0,'msg'=>'class值有误']);
		}

		if($type == 1){

			//$con['status'] = 1;
			$con['b.status'] = 0;

/*			if($worker_id){
				$con['status'] = array('lt',2);	
			}
			if($group_id){
				$con['status'] = 0;
			}*/
		}elseif($type == 2){

			$con['b.status'] = array('in','1,3');
/*			$con['status'] = 2;
			if($group_id){
				$con['status'] = array(['gt',0],['lt',3]);;
			}*/
		}
		if($style){
			
			switch($style){
				case 1:
					$con['type'] = 0;
					break;
				case 2:
					$con['type'] = 1;
					break;
				case 3:
					$con['type'] = 2;
					break;
				case 4:
					$con['type'] = 3;
					break;
			}
		}
		if($start){

			$con['b.add_time'] = array('egt',date('Y-m-d 00:00:00',strtotime($start)));
		}

		if($end){

			$con['b.add_time'] = array('elt',date('Y-m-d 24:00:00',strtotime($end)));
		}

		if($start && $end){

			$con['b.add_time'] = array(['egt',date('Y-m-d 00:00:00',strtotime($start))],['elt',date('Y-m-d 24:00:00',strtotime($end))]);
		}

		if($worker_name){

			$con['worker_name'] = array('like','%'.$worker_name.'%');
		}
		if($class == 2){

			$where = " b.worker_id = {$worker_id} or check_worker_1 = {$worker_id}";
			
		}else{

			$where = '';
		}
		$dan = Db::name('bill b')
			->field('b_id,b.add_time,type,w.worker_id,check_worker_1,worker_name')
			->join('worker w','w.worker_id = b.worker_id')
			->where($con)
			->where($where)
			->order('add_time desc,b_id desc')
			->paginate(6);
		$page = $dan->render();
        $list = $dan->items();        
        $jsonStr = json_encode($dan);
        $info = json_decode($jsonStr,true);
        $pages = $info['last_page']; 
        $page_list = array();
        $page_list['page'] = $page;
        $page_list['pages'] = $pages;

		$arr = array();
	
		foreach($info['data'] as $k=>$v){

			switch($v['type']){
				case 0:
					$info['data'][$k]['tyle_name'] = '请假单';
					break;
				case 1:
					$info['data'][$k]['tyle_name'] = '加班单';
					break;
				case 2:
					$info['data'][$k]['tyle_name'] = '调休单';
					break;
				case 3:
					$info['data'][$k]['tyle_name'] = '出差单';
					break;
			}

			$info['data'][$k]['add_time'] = date('Y-m-d',strtotime($v['add_time']));
			$arr[] = $info['data'][$k];
		}
		
		return json(['status'=>1,'msg'=>'查询成功','total'=>$page_list,'data'=>$arr]);
	}

	

	//单据详情列表

	public  function regroup_list(){

		$b_id = request()->param('b_id');
		$con['b_id'] = $b_id;

		$info = Db::name('bill')->where($con)->field('b_id,worker_id,check_worker_1,check_worker_2,check_time_1,check_time_2,add_time,reason,day,status,type,s_time,e_time,time_1,time_2,address,money,style')->order('add_time desc')->select();

		foreach($info as $k=>$v){

			$worker_name = Db::name('worker')->where('worker_id',$v['worker_id'])->value('worker_name');
			$group_id = Db::name('worker')->where('worker_id',$v['worker_id'])->value('group_id');
			$group_name = Db::name('group')->where('group_id',$group_id)->value('group_name');
			
			$info[$k]['worker_name'] = $worker_name;
			$info[$k]['group_name'] = $group_name;
			if(!$v['check_time_2']){
				$info[$k]['check_time_2'] = '';
			}

			if(!$v['check_worker_2']){
				$info[$k]['check_worker_2'] = '';
			}

			$info[$k]['check_name_1'] = Db::name('worker')->where('worker_id',$info[$k]['check_worker_1'])->value('worker_name');
			$info[$k]['check_name_2'] = Db::name('worker')->where('worker_id',$info[$k]['check_worker_2'])->value('worker_name');

			if(!$info[$k]['check_name_1']){
				$info[$k]['check_name_1'] = '';
			}

			if(!$info[$k]['check_name_2']){
				$info[$k]['check_name_2'] = '';
			}

			if(!$v['check_time_1']){
				$info[$k]['check_time_1'] = '';
			}

			if(!$v['time_1']){
				$info[$k]['time_1'] = '';
			}

			if(!$v['time_2']){
				$info[$k]['time_2'] = '';
			}

			if(!$v['address']){
				$info[$k]['address'] = '';
			}
			
			if(!$v['money']){
				$info[$k]['money'] = '';
			}
			if(is_numeric($v['style'])){
				switch($v['style']){
					case 0:
						$info[$k]['style_name'] = '事假';
						break;
					case 1:
						$info[$k]['style_name'] = '病假';
						break;
					case 2:
						$info[$k]['style_name'] = '调休';
						break;
					case 3:
						$info[$k]['style_name'] = '年假';
						break;
					case 4:
						$info[$k]['style_name'] = '婚假';
						break;
					case 5:
						$info[$k]['style_name'] = '产假';
						break;
					case 6:
						$info[$k]['style_name'] = '丧假';
						break;
					case 7:
						$info[$k]['style_name'] = '其他';
						break;
				}
			}else{
				$info[$k]['style'] = '';
				$info[$k]['style_name'] = '';
			}

			$info[$k]['add_time'] = date('Y-m-d',strtotime($v['add_time']));
		}
		
		$worker_id = $this->worker['worker_id'];
		return json(['status'=>1,'msg'=>'查询成功','data'=>$info[0],'worker'=>$worker_id]);
	}

	//添加加班单
	public function over_add(){

		$worker_id = request()->param('worker_id');
		$check_worker_1 = request()->param('check_worker_1');
		$check_worker_2 = request()->param('check_worker_2');
		$reason = request()->param('reason');
		$day = request()->param('day');
		$s_time = request()->param('s_time');
		$e_time = request()->param('e_time');
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

			return json(['status'=>0,'msg'=>'请输入加班原因']);
		}

		if(!$day){

			return json(['status'=>0,'msg'=>'请输入加班天数']);
		}
		if(!is_numeric($day)){

			return json(['status'=>0,'msg'=>'加班天数必须为数字']);
		}

		if(!$s_time){

			return json(['status'=>0,'msg'=>'请输入加班起始时间']);
		}

		if(!$e_time){

			return json(['status'=>0,'msg'=>'请输入加班结束时间']);
		}

		if(!$add_time){

			return json(['status'=>0,'msg'=>'请选择日期']);
		}

		$data['worker_id'] = $worker_id;
		$data['check_worker_1'] = $check_worker_1;
		//$data['check_worker_2'] = $check_worker_2;
		$data['reason'] = $reason;
		$data['day'] = round($day,2);
		$data['s_time'] = date('Y-m-d H:i:s',strtotime($s_time));
		$data['e_time'] = date('Y-m-d H:i:s',strtotime($e_time));
		$data['add_time'] = $add_time;
		$data['type'] = 1;
		$data['status'] = 0;

		$re = Db::name('bill')->insert($data);

		if($re){ 

            return json(['status'=>1,'msg'=>'申请成功']);

        }else{

            return json(['status'=>0,'msg'=>'申请失败']);
        }

	}

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

	//添加出差单
	public function travel_add(){

		$worker_id = request()->param('worker_id');
		$check_worker_1 = request()->param('check_worker_1');
		$check_worker_2 = request()->param('check_worker_2');
		$reason = request()->param('reason');
		$day = request()->param('day');
		$s_time = request()->param('s_time');
		$e_time = request()->param('e_time');
		$address = request()->param('address');
		$money = request()->param('money');
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

			return json(['status'=>0,'msg'=>'请输入出差原因']);
		}

		if(!$day){

			return json(['status'=>0,'msg'=>'请输入出差天数']);
		}

		if(!is_numeric($day)){

			return json(['status'=>0,'msg'=>'出差天数必须为数字']);
		}

		if(!$address){

			return json(['status'=>0,'msg'=>'请输入出差地点']);
		}

		if(!$money){

			return json(['status'=>0,'msg'=>'请输入费用预算']);
		}

		if(!$s_time){

			return json(['status'=>0,'msg'=>'请输入起始时间']);
		}

		if(!$e_time){

			return json(['status'=>0,'msg'=>'请输入结束时间']);
		}

		if(!$add_time){

			return json(['status'=>0,'msg'=>'请选择日期']);
		}

		$data['worker_id'] = $worker_id;
		$data['check_worker_1'] = $check_worker_1;
		//$data['check_worker_2'] = $check_worker_2;
		$data['reason'] = $reason;
		$data['day'] = round($day,2);
		$data['address'] = $address;
		$data['money'] = $money;
		$data['s_time'] = date('Y-m-d H:i:s',strtotime($s_time));
		$data['e_time'] = date('Y-m-d H:i:s',strtotime($e_time));
		$data['add_time'] = $add_time;
		$data['type'] = 3;
		$data['status'] = 0;

		$re = Db::name('bill')->insert($data);

		if($re){ 

            return json(['status'=>1,'msg'=>'申请成功']);

        }else{

            return json(['status'=>0,'msg'=>'申请失败']);
        }
	}

	
}