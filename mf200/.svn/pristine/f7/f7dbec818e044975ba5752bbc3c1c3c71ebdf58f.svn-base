<?php
namespace app\workerwages\controller;
use think\Controller;
use think\Db;
use think\Request;

class workerwages extends Controller
{	
	/**
	 * [ workerwages_list 工人工资页面 列表数据]
	 * @param post传参 
	 * @return [type] status 状态值 msg 返回信息 data 返回数据
	 */
	public function workerwages_list(){
		//当天的时间
		$today_zero=strtotime('today');
		//$adb=strtotime('2018-05-02');
		
		$sqla=Db::query('select worker_id,count(worker_id) as count from mf_pro_worker_job where status=3 and unix_timestamp(check_time)<'.$today_zero.' group by worker_id');

		if($sqla){
			$vcoun =array();
			foreach($sqla as $k => $v){
				$vnum[] = $v['worker_id'];
				$vcoun[]= $v['count'];
			}
			
			$data['worker_id']=array('in',$vnum);

			/* 条件查询 开始 */
			$whereStr = '';

			if($this->request->param('worker_id')){
				$whereStr .= " and worker_id = {$this->request->param('worker_id')}";
			}

			if($this->request->param('skill_id')){
				$whereStr .= " and skill_id = {$this->request->param('skill_id')}";
			}

			if($this->request->param('b_time') && $this->request->param('o_time')){
				$t1 = $this->request->param('b_time');
				$t2 = $this->request->param('o_time');
				$whereStr .= " and (work_date between '{$t1}' and '{$t2}')";
			}else{
				$t = date('Y-m-d');
				$whereStr .= " and work_date = '{$t}'";
			}
			/* 条件查询 结束 */

			$sql = 'select worker_id,SUM(money) as cmoney from mf_pro_worker_job where status=3 '.$whereStr. ' group by worker_id';
			//echo $sql;exit;

			//工人工资查询
			$sqll=Db::table('mf_pro_worker_job')->query($sql);			

			if(!$sqll){
				return json(['status'=>1,'msg'=>"查询成功",'data'=>[] ]);
			}
			//工人工资查询结束

			$sql=Db::table('mf_worker')
				->where($data)
				->field('worker_name')
				->select();			
			
			foreach($sqla as $keyd=>$vo){  
		        $list[] = array_merge($vo,$sql[$keyd],$sqll[$keyd]);
		    }  
		
			return json(['status'=>1,'msg'=>"查询成功",'data'=>$list ]);
		}else{
			
			$re['status'] = 1;
			$re['msg'] = '查询成功';
			$re['data'] = [];
			ajaxReturnJson($re);
		}
		
	}

	/**
	 * [ workerwages_list_details 工人工资详情页面 列表数据]
	 * @param post传参 
	 * @return [type] status 状态值 msg 返回信息 data 返回数据
	 */
	public function workerwages_list_details(){
		
		$worker_id=request()->param('worker_id');
		if(!$worker_id){
			return json(['status'=>0,'msg'=>"没有获得参数" ]);
		}

		$sql=Db::table('mf_pro_worker_job')->alias('a')
		->join('mf_work_skill b','a.skill_id=b.skill_id')
		->join('mf_worker c','a.worker_id=c.worker_id')
		->join('mf_grow_area d','a.area_id=d.area_id')
		->join('mf_worker e','a.check_worker_id=e.worker_id')
		->field('c.worker_id,c.worker_name,b.skill_id,b.skill_name,b.money,d.area_id,d.area_name,e.worker_name as check_worker_name,a.real_num,a.work_date,a.require_time_1,a.require_time_2,a.s_time,a.e_time,a.check_time,a.score,a.beizhu,a.photo,a.money')
		->where('a.worker_id',$worker_id)
		->where('a.status',3)
		//->whereTime('check_time', 'between', ['2010-05-06', date("Y-m-d",strtotime("-1 day"))])
		->where('b.status',1)
		->select();

			if($sql){
				foreach($sql as $k1=>$v1){

					$sql[$k1]['require_time_1'] = date('H:i',strtotime($sql[$k1]['require_time_1']));
					$sql[$k1]['require_time_2'] = date('H:i',strtotime($sql[$k1]['require_time_2']));

					$sql[$k1]['s_time'] = date('Y-m-d H:i',strtotime($sql[$k1]['s_time']));
					$sql[$k1]['e_time'] = date('Y-m-d H:i',strtotime($sql[$k1]['e_time']));
					$sql[$k1]['check_time'] = date('Y-m-d H:i',strtotime($sql[$k1]['check_time']));

					//工资计算
					//$sql[$k1]['require_time_2'].getDay()-$sql[$k1]['require_time_1'].getDay()
					
				}
				return json(['status'=>1,'msg'=>"查询成功",'data'=>$sql ]);
			}else{
				return json(['status'=>0,'msg'=>"出现错误" ]);
			}
	}

	/**
	 * [ workerwages_set 工序工资设置页面数据 未设置]
	 * @param post传参 
	 * @return [type] status 状态值 msg 返回信息 data 返回数据
	 */
	public function workerwages_set(){

		$sql=Db::table('mf_skill_price')->alias('a')
		->join('mf_work_skill b','b.skill_id=a.skill_id' )
		->field('b.skill_id,b.skill_name,a.unit_str,a.p_id')
		->where('a.price',0)->where('b.status',1)->where('a.status',1)->select();
		
		if($sql){
			return json(['status'=>1,'msg'=>"查询成功",'data'=>$sql ]);
		}else{
			return json(['status'=>0,'msg'=>"出现错误" ]);
		}

	}

	/**
	 * [ workerwages_set 工序工资设置页面数据 已设置]
	 * @param post传参 
	 * @return [type] status 状态值 msg 返回信息 data 返回数据
	 */
	public function workerwages_setted(){

		$cond['a.price']=array('NEQ',0);
		$sql=Db::table('mf_skill_price')->alias('a')
		->join('mf_work_skill b','b.skill_id=a.skill_id' )
		->field('b.skill_id,b.skill_name,a.unit_str,a.price,a.unit_str,a.p_id')
		->where($cond)->where('b.status',1)->where('a.status',1)->select();
		
		if($sql){
			return json(['status'=>1,'msg'=>"查询成功",'data'=>$sql ]);
		}else{
			return json(['status'=>0,'msg'=>"出现错误"  ]);
		}

	}

	/**
	 * [ workerwages_set 工序工资设置页面数据 设置操作]
	 * @param post传参 
	 * @return [type] status 状态值 msg 返回信息 data 返回数据
	 */
	public function workerwages_setting(){

		$p_id=request()->param('p_id');
		if(!$p_id){
			return json(['status'=>0,'msg'=>"参数错误" ]);die();
		}

		$mon=request()->param('mon');
		if(!$mon){
			return json(['status'=>0,'msg'=>"参数错误" ]);die();
		}

		$skill_id=request()->param('skill_id');

		$cond['skill_id']=$skill_id;
		$cond['status']=1;
		$cond['unit_str']=$p_id;
		$conda['price']=$mon;

		$sqlwhy=Db::table('mf_skill_price')->where($cond)->select();
		print_r($sqlwhy);

		if($sqlwhy){
			$sql=Db::table('mf_skill_price')->where($cond)->update($conda);
		}else{

			$newcon['skill_id']=$skill_id;
			$newcon['status']=1;
			$newcon['unit_str']=$p_id;
			$newcon['price']=$mon;	
			$sql=Db::table('mf_skill_price')->insert($newcon);
		}
	
		if($sql){
			return json(['status'=>1,'msg'=>"保存成功"]);
		}else{
			return json(['status'=>1,'msg'=>"重复添加"]);
		}

	}


	public function workerwages_settinga(){

		$p_id=request()->param('p_id');
		if(!$p_id){
			return json(['status'=>0,'msg'=>"参数错误" ]);die();
		}

		$mon=request()->param('mon');
		if(!$mon){
			return json(['status'=>0,'msg'=>"参数错误" ]);die();
		}

		$cond['p_id']=$p_id;
		$conda['price']=$mon;

		$sql=Db::table('mf_skill_price')->where($cond)->update($conda);

		if($sql){
			return json(['status'=>1,'msg'=>"保存成功" ]);
		}else{
			return json(['status'=>0,'msg'=>"保存失败" ]);
		}


	}
	/**
	 * [ skill_choose 工序选择]
	 * @param post传参 
	 * @return [type] status 状态值 msg 返回信息 data 返回数据
	 */
	public function skill_choose(){

		$sql=Db::table('mf_work_skill')->where('status',1)->field('skill_id,skill_name')->select();
		
		if($sql){
			return json(['status'=>1,'msg'=>"查询成功",'data'=>$sql]);
		}else{
			return json(['status'=>0,'msg'=>"查询失败"]);
		}
	}


	/**
	 * [ skill_choose_more 工序选择 单位 ]
	 * @param post传参 
	 * @return [type] status 状态值 msg 返回信息 data 返回数据
	 */

	public function skill_choose_more(){

		$skill_id=request()->param('skill_id');
		$con['skill_id']=$skill_id;
		$con['status']=1;
		$sql=Db::table('mf_work_skill')->where($con)->field('skill_id,unit_str')->find();
		$abd=explode(",",$sql['unit_str']);
		$res=[];
		$res['status']=1;
		$res['data']=$abd;
		ajaxReturnJson($res);
		
		// if($sql){

		// 	foreach ($sql as $key => $value) {
		// 		$abc=$value['unit_str'];
		// 		$abd=explode(",",$abc);
		// 	}

		// 	// for($index=0;$index<count($abd);$index++) 
		// 	//  { 
		// 	//  	$newsql[$index]=(object)$abd[$index]; 
		// 	//  } 
			
		// 	//$newsql = (object)$newsql; 
			
		// 	return json(['status'=>1,'msg'=>"查询成功",'data'=>$newsql]);
		// }else{
		// 	return json(['status'=>0,'msg'=>"查询失败"]);
		// }
	}

	/**
	 * [ skill_choose_mon 工序选择 价格 ]
	 * @param post传参 
	 * @return [type] status 状态值 msg 返回信息 data 返回数据
	 */

	public function skill_choose_mon(){
		$s_id=request()->param('skill_id');
		$p_id=request()->param('unit_str');
		$con['skill_id']=$s_id;
		$con['unit_str']=$p_id;
		$con['status']=1;
		$sql=Db::table('mf_skill_price')->where($con)->field('p_id,price')->select();
		
		if($sql){
			return json(['status'=>1,'msg'=>"查询成功",'data'=>$sql]);
		}else{
			return json(['status'=>0,'msg'=>"查询失败",'da'=>$con]);
		}
	}

	/**
	 * [ skill_choose_mon 工序选择 删除 ]
	 * @param post传参 
	 * @return [type] status 状态值 msg 返回信息 data 返回数据
	 */

	public function workerwages_set_del(){

		$p_id=request()->param('p_id');
		if(!$p_id){
			return json(['status'=>0,'msg'=>"参数错误" ]);die();
		}
		$con['p_id']=$p_id;
		$con['status']=0;
		$sql=Db::table('mf_skill_price')->update($con);
		
		if($sql){
			return json(['status'=>1,'msg'=>"删除成功"]);
		}else{
			return json(['status'=>0,'msg'=>"删除失败"]);
		}
	}



	/**
	 * [ workerwages_set_over 去完善 ]
	 * @param post传参 
	 * @return [type] status 状态值 msg 返回信息 data 返回数据
	 */

	public function workerwages_set_over(){ 

		$p_id=request()->param('p_id');
		if(!$p_id){
			return json(['status'=>0,'msg'=>"参数错误" ]);die();
		}

		$sql=Db::table('mf_skill_price')->alias('a')
		->join('mf_work_skill b','b.skill_id=a.skill_id')
		->field('b.skill_id,b.skill_name,a.price,a.unit_str')
		->where('a.p_id',$p_id)
		->where('b.status',1)
		->where('a.status',1)
		->select();

		if($sql){
			return json(['status'=>1,'msg'=>"成功",'data'=>$sql ]);
		}else{
			return json(['status'=>0,'msg'=>"失败"]);
		}
	}

	/**
	 * [ workerwages_add_skill 二次添加 工序 price表中添加]
	 * @param post传参 
	 * @return [type] status 状态值 msg 返回信息 data 返回数据
	 */

	public function workerwages_add_skill(){ 
		
		$skill_id=request()->param('skill_id');
		$cond['skill_id']=$skill_id;
		$sqla=Db::table('mf_work_skill')->where($cond)->find();//查询添加的单位
		$arr=explode(",",$sqla['unit_str']);
		
		$newcond['skill_id']=$skill_id;
		$newcond['unit_str']=array('in',$arr);

		$sqlb=Db::table('mf_skill_price')->where($newcond)->select();//skill_id和单位查询 加个表是否存在
		$num=count($arr);

		if(!$sqlb){
			for($i=0;$i<$num;$i++){
				$ncond['skill_id']=$skill_id;
				$ncond['unit_str']=$arr[$i];
				
				$sqlb=Db::table('mf_skill_price')->insert($ncond);
			}
			
		}else{
			return json(['status'=>0,'msg'=>"存在相同单位"]);
		}

	}

	/**
	 * [ workerwages_wages_count 工人工资计算]
	 * @param post传参 
	 * @return [type] status 状态值 msg 返回信息 data 返回数据
	 */
	public function workerwages_wages_count(){ 

		//2018-05-05 工人工资 计算规则 宗

					$gdid=$_REQUEST['gd_id'];
					$skillid=db('pro_worker_job')->where('gd_id',$gdid)->field('skill_id,unit')->find();
					$cond['skill_id']=$skillid['skill_id'];
					$cond['unit_str']=$skillid['unit'];

					$price_main=db('skill_price')->where($cond)->field('price')->find();
					
					// foreach ($price_main as $key => $value) {
					// 	if($value['price']==0){
					// 		unset($price_main[$key]);
					// 	}else{
					// 		$price_arr=$value['price'];
					// 	}

					// }
					$price_arr=$price_main['price'];
					//print_r($price_arr);die();

					$man_money=$_REQUEST['real_num']*($_REQUEST['score']/100)*$price_arr;
					$price_data['money']=$man_money;
					
					$price_money=db('pro_worker_job')->where('gd_id',$gdid)->update($price_data);

			
		//2018-05-05 工人工资 计算规则 宗
				
	}


	/**
	 * [ workerwages_select 筛选]
	 * @param post传参 
	 * @return [type] status 状态值 msg 返回信息 data 返回数据
	 */
	public function workerwages_select(){ 
		
		
		$sql=Db::table('mf_worker')->field('worker_id,worker_name')->select();

		if($sql){
			return json(['status'=>1,'msg'=>"查询成功",'data'=>$sql]);
		}else{
			return json(['status'=>0,'msg'=>"查询失败"]);
		}

	}

	/**
	 * [ workerwages_select_gongxu 筛选 工序] 
	 * @param post传参 
	 * @return [type] status 状态值 msg 返回信息 data 返回数据
	 */
	public function workerwages_select_gongxu(){ 
		
		
		$sql=Db::table('mf_work_skill')->field('skill_id,skill_name')->select();

		if($sql){
			return json(['status'=>1,'msg'=>"查询成功",'data'=>$sql]);
		}else{
			return json(['status'=>0,'msg'=>"查询失败"]);
		}

	}


	/**
	 * [ workerwages_select_do 执行筛选]
	 * @param post传参 
	 * @return [type] status 状态值 msg 返回信息 data 返回数据
	 */
	public function workerwages_select_do(){ 
		$worker_id=request()->param('worker_id');
		if($worker_id){
			$cond['worker_id']=$worker_id;
		}

		$skill_id=request()->param('skill_id');
		if($skill_id){
			$cond['skill_id']=$skill_id;
		}

		$b_time=request()->param('b_time');
		if($b_time){
			$cond['s_time']=array('gt',$b_time);
			//print_r($b_time);echo "<br/>";
		}

		$o_time=request()->param('o_time');
		if($o_time){
			$cond['e_time']=array('lt',$o_time);
			//print_r($o_time);
		}

		$cond['status']=3;

		if(!$cond){
			return json(['status'=>0,'msg'=>"请输入查询条件"]);	
		}else{

			// $worker_name_sql=Db::table('mf_pro_worker_job')->alias('a')
			// ->join('mf_worker b','b.worker_id=a.worker_id')
			// ->where($cond)->value('b.worker_name');


			// $count_sql=Db::table('mf_pro_worker_job')->where($cond)->count();
			
			// $money_sql=Db::table('mf_pro_worker_job')->where($cond)->SUM('money');
			
			$worker_name_sql=Db::table('mf_pro_worker_job')->where($cond)->field('worker_id')->find();
			$newworkerid=$worker_name_sql['worker_id'];

			$workname=Db::table('mf_worker')->where('worker_id',$newworkerid)->value('worker_name');

			//print_r($workname);

			$sqll=Db::table('mf_pro_worker_job')
			->query('select worker_id,count(worker_id) as count,SUM(money) as cmoney from mf_pro_worker_job where status=3  and worker_id='.$newworkerid.' group by worker_id');// 缺少今天完成订单

			foreach ($sqll as $key => $value) {
				$sqll[$key]['worker_name']=$workname;
			}
			
			//print_r($sqll);
			/*
			$alldata['worker_name']=$worker_name_sql;
			$alldata['count']=$count_sql;
			$alldata['all_money']=$money_sql;
			*/
			
			if($sqll){
				return json(['status'=>1,'msg'=>"查询成功",'data'=>$sqll]);
			}else{
				return json(['status'=>0,'msg'=>"查询失败"]);
			}	
		}



		

	}





   

}