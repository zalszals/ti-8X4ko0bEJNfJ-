<?php
namespace app\schedule\controller;
use app\base\controller\Base;
use think\Db;

class Schedule extends Base{
	/**
	* [add 添加日程]
	* @param post传参 event事件名称 date 日期 s_time开始时间 e_time结束时间 worker_id 员工schedule_id	* @return [type] status 状态值 msg 返回信息
	*/
	public function add(){
		if($_REQUEST){
			if(!$_REQUEST['event']){
				return(json(array('status'=>0,'msg'=>'请输入事件名称')));
			}
			if(!$_REQUEST['date']){
				return(json(array('status'=>0,'msg'=>'请输入日期')));
			}
			if(!$_REQUEST['s_time']){
				return(json(array('status'=>0,'msg'=>'请输入起始时间')));
			}
			if(!$_REQUEST['e_time']){
				return(json(array('status'=>0,'msg'=>'请输入结束时间')));
			}
			if(!$_REQUEST['worker_id']){
				return(json(array('status'=>0,'msg'=>'员工id有误')));
			}
			$data['event'] = $_REQUEST['event'];
			$data['date'] = date('Y-m-d',strtotime($_REQUEST['date']));
			$data['s_time'] = date('H:i',strtotime($_REQUEST['s_time']));
			$data['e_time'] = date('H:i',strtotime($_REQUEST['e_time']));
			$data['worker_id'] = $_REQUEST['worker_id'];
			$re = Db::name('schedule')->insert($data);
			if($re){
				return(json(array('status'=>1,'msg'=>'添加成功')));
			}else{
				return(json(array('status'=>0,'msg'=>'添加失败')));
			}
		}else{
			return(json(array('status'=>0,'msg'=>'请输入日程信息')));
		}
	}

	/**
	* [schedule_list 日程列表]
	* @param post传参 worker_id 员工id date日期
	* @return [type] status 状态值 msg 返回信息
	*/
	public function schedule_list(){
		if($_REQUEST){
			$con['date'] = date('Y-m-d',time());
			if(isset($_REQUEST['date'])&&!empty($_REQUEST['date'])){
				$con['date'] = date('Y-m-d',strtotime($_REQUEST['date']));
			}
			if(!$_REQUEST['worker_id']){
				return(json(array('status'=>0,'msg'=>'员工id有误')));
			}
			$con['worker_id'] = $_REQUEST['worker_id'];
			$list = Db::name('schedule')->where($con)->select();
			foreach($list as $k=>$v){
				$list[$k]['s_time'] = date('H:i',strtotime($v['s_time']));
				$list[$k]['e_time'] = date('H:i',strtotime($v['e_time']));
			}
			$data = Db::name('schedule')->where('worker_id',$_REQUEST['worker_id'])->group('date')->column('date');
			if(!$data){
				$data = array();
			}
			if(!$list){
				$list = array();
			}
			return(json(array('status'=>1,'msg'=>'查询成功','data'=>$data,'list'=>$list)));
		}else{
			return(json(array('status'=>0,'msg'=>'参数有误')));
		}
	}

	/**
	* [edit 日程编辑列表]
	* @param post传参 schedule_id 日程id do 是否是执行编辑
	* @return [type] status 状态值 msg 返回信息
	*/
	public function edit(){
		if($_REQUEST){
			if(!isset($_REQUEST['do'])){
				if(!$_REQUEST['schedule_id']){
					return(json(array('status'=>0,'msg'=>'日程id有误')));
				}
				$con['schedule_id'] = $_REQUEST['schedule_id'];
				$data = Db::name('schedule')->where($con)->find();
				$data['s_time'] = date('H:i',strtotime($data['s_time']));
				$data['e_time'] = date('H:i',strtotime($data['e_time']));
				if(!$data){
					$data = array();
				}
				return(json(array('status'=>1,'msg'=>'查询成功','data'=>$data)));
			}else{
				if(!$_REQUEST['event']){
					return(json(array('status'=>0,'msg'=>'请输入事件名称')));
				}
				if(!$_REQUEST['date']){
					return(json(array('status'=>0,'msg'=>'请输入日期')));
				}
				if(!$_REQUEST['s_time']){
					return(json(array('status'=>0,'msg'=>'请输入起始时间')));
				}
				if(!$_REQUEST['e_time']){
					return(json(array('status'=>0,'msg'=>'请输入结束时间')));
				}
				if(!$_REQUEST['worker_id']){
					return(json(array('status'=>0,'msg'=>'员工id有误')));
				}
				if(!$_REQUEST['schedule_id']){
					return(json(array('status'=>0,'msg'=>'日程id有误')));
				}
				$condition['event'] = $_REQUEST['event'];
				$condition['date'] = date('Y-m-d',strtotime($_REQUEST['date']));
				$condition['worker_id'] = $_REQUEST['worker_id'];
				$condition['s_time'] = date('H:i',strtotime($_REQUEST['s_time']));
				$condition['e_time'] = date('H:i',strtotime($_REQUEST['e_time']));
				$condition['schedule_id'] = array('neq',$_REQUEST['schedule_id']);
				$info = Db::name('schedule')->where($condition)->find();
				if($info){
					return(json(array('status'=>0,'msg'=>'存在相同的日程安排')));
				}
				$data['event'] = $_REQUEST['event'];
				$data['date'] = date('Y-m-d',strtotime($_REQUEST['date']));
				$data['worker_id'] = $_REQUEST['worker_id'];
				$data['s_time'] = date('H:i',strtotime($_REQUEST['s_time']));
				$data['e_time'] = date('H:i',strtotime($_REQUEST['e_time']));
				$data['schedule_id'] = $_REQUEST['schedule_id'];
				$re = Db::name('schedule')->update($data);
				if($re !== false){
					return(json(array('status'=>1,'msg'=>'编辑成功')));
				}else{
					return(json(array('status'=>0,'msg'=>'编辑失败')));
				}
			}
		}else{
			return(json(array('status'=>0,'msg'=>'参数有误')));
		}	
	}
}