<?php
namespace app\pc\controller;
use app\base\controller\Base;
use think\Db;
use think\Request;

class Progrowtask extends Base
{   
    //种植任务编辑
    public function progrowtask_edit()
    {
		
		
		
        $t_id=trim(request()->param('t_id'));
        if(!$t_id){return json(['status'=>0,'txt'=>"主键id不存在"]);}
        $plan_id=trim(request()->param('plan_id'));
        if(!$plan_id){return json(['status'=>0,'txt'=>"生产计划id不存在"]);}
        $ps_id=trim(request()->param('ps_id'));
        if(!$ps_id){return json(['status'=>0,'txt'=>"子计划id不存在"]);}
        $t_no=trim(request()->param('t_no'));
        if(!$t_no){return json(['status'=>0,'txt'=>"任务编号id不存在"]);}
        $grow_mode_id=trim(request()->param('grow_mode_id'));
        if(!$grow_mode_id){return json(['status'=>0,'txt'=>"种植模式id不存在"]);}
        $zhu_ju=trim(request()->param('zhu_ju'));
        if(!$zhu_ju){return json(['status'=>0,'txt'=>"株距不能为空"]);}
        $hang_ju=trim(request()->param('hang_ju'));
        if(!$hang_ju){return json(['status'=>0,'txt'=>"行距不能为空"]);}
        $total_grow_num=trim(request()->param('total_grow_num'));
        if(!$total_grow_num){return json(['status'=>0,'txt'=>"总种植数量不能为空"]);}
        $one_weight=trim(request()->param('one_weight'));
        if(!$one_weight){return json(['status'=>0,'txt'=>"目标单果重量不能为空"]);}
        $sm_weight=trim(request()->param('sm_weight'));
        if(!$sm_weight){return json(['status'=>0,'txt'=>"目标每平米产量不能为空"]);}
        $year_weight=trim(request()->param('year_weight'));
        if(!$year_weight){return json(['status'=>0,'txt'=>"目标年产量不能为空"]);}
        $grow_date=trim(request()->param('grow_date'));
        if(!$grow_date){return json(['status'=>0,'txt'=>"定植时间不能为空"]);}
        $estimate_get_date_1=trim(request()->param('estimate_get_date_1'));
        if(!$estimate_get_date_1){return json(['status'=>0,'txt'=>"预计采收期（开始）不能为空"]);}
        $estimate_get_date_2=trim(request()->param('estimate_get_date_2'));
        if(!$estimate_get_date_2){return json(['status'=>0,'txt'=>"预计采收期（结束）不能为空"]);}
        $total_cost=trim(request()->param('total_cost'));
        if(!$total_cost){return json(['status'=>0,'txt'=>"估计费用成本不能为空"]);}
        $worker_id=trim(request()->param('worker_id'));
        if(!$worker_id){return json(['status'=>0,'txt'=>"任务负责人不能为空"]);}
        $add_time=Db::name('pro_grow_task')->where('t_id',$t_id)->value('add_time');
        $add_worker_id=Db::name('pro_grow_task')->where('t_id',$t_id)->value('add_worker_id');
		$cost_worker = $this->request->param('cost_worker');
		if(!$cost_worker){return json(['status'=>0,'txt'=>"请输入人工成本"]);}
		$cost_materiel = $this->request->param('cost_materiel');
		if(!$cost_materiel){return json(['status'=>0,'txt'=>"请输入物料成本"]);}
		$cost_amount = $this->request->param('cost_amount');
		if(!$cost_amount){return json(['status'=>0,'txt'=>"请输入能耗成本"]);}
       
            $data=[

                'plan_id'=>$plan_id,
                'ps_id'=>$ps_id,
                't_no'=>$t_no,
                'grow_mode_id'=>$grow_mode_id,
                'zhu_ju'=>$zhu_ju,
                'hang_ju'=>$hang_ju,
                'total_grow_num'=>$total_grow_num,
                'one_weight'=>$one_weight,
                'sm_weight'=>$sm_weight,
                'year_weight'=>$year_weight,
                'grow_date'=>$grow_date,
                'estimate_get_date_1'=>$estimate_get_date_1,
                'estimate_get_date_2'=>$estimate_get_date_2,
                'total_cost'=>$total_cost,
                'worker_id'=>$worker_id,
                'add_time'=>$add_time,
                'add_worker_id'=>$add_worker_id,
				'cost_worker'=>$cost_worker,
				'cost_materiel'=>$cost_materiel,
				'cost_amount'=>$cost_amount

            ];
            $data = array_diff($data, [NULL, '']);
			/* $con['plan_id'] = $plan_id; */
			/* $cost = Db::name('product_plan')->field('cost_worker,cost_materiel,cost_amount')->where($con)->find();
			if($cost){
				$data2['cost_worker'] = $cost['cost_worker']+$cost_worker;
				$data2['cost_materiel'] = $cost['cost_materiel']+$cost_materiel;
				$data2['cost_amount'] = $cost['cost_amount']+$cost_amount;
				
				$up_cost = Db::name('product_plan')->where($con)->update($data2);
				if($up_cost==false){
					$result['status'] = 0;
					$result['msg'] = "生产计划中的成本消耗信息修改失败";
					ajaxReturnJson($result);
				}
			} */
			
            $sql=Db::table('mf_pro_grow_task')->where('t_id',$t_id)->update($data);
			$tasql = $this->array_info($t_id,$plan_id);
			if($tasql==false){
				$result['status'] = 0;
				$result['msg'] = "种植区域和定制数量修改失败";
				ajaxReturnJson($result);
			}
            
            return json(['status'=>1,'msg'=>"编辑成功"]);
            
        
    }

	/**
     * [array_info 种植区域和定制数量的修改[种植任务编辑]（hl）]
     * @return [type] [description]
     */
	public function array_info($t_id,$plan_id){//文档未更新
		$array_info = json_decode($this->request->param('array_info'),true);
		foreach($array_info as $key=>$info){
		
			if(!array_key_exists('0',$info)){
			  echo '种植环境id为空';die;
			}
			if(!array_key_exists('1',$info)){
			  echo '种植区域id为空';die;
			}
			if(!array_key_exists('2',$info)){
			  echo '定植数量为空';die;
			}
			if(!array_key_exists('3',$info)){
			  echo '种植面积为空（平米）';die;
			}
			if(!array_key_exists('4',$info)){
			  echo '种植面积为空（亩）';die;
			}
		}
		
		$con['t_id'] = $t_id;
		$sjkinfo = Db::name('pro_grow_task_area')->where($con)->select();
		
		
		if($sjkinfo){
			foreach($sjkinfo as $k=>$row){
				$newinfo = array();
				if(empty($array_info[$k])){
					$res = Db::name('pro_grow_task_area')->where(array('t_a_id'=>$row['t_a_id']))->delete();
				}else if(count($array_info)==count($sjkinfo)){
					$newinfo['g_type_id'] = $array_info[$k][0];
					$newinfo['area_id'] = $array_info[$k][1];
					$newinfo['grow_num'] = $array_info[$k][2];
					$newinfo['t_grow_area_1'] = $array_info[$k][3];
					$newinfo['t_grow_area_2'] = $array_info[$k][4];
					$res = Db::name('pro_grow_task_area')->where(array('t_a_id'=>$row['t_a_id']))->update($newinfo);
				}
				
				
			}
			
			if(count($array_info)>count($sjkinfo)){
				
				$k++;
				$newinfo1 = array();
				$newinfo1['t_id'] = $t_id;
				$newinfo1['plan_id'] = $plan_id;
				$newinfo1['g_type_id'] = $array_info[$k][0];
				$newinfo1['area_id'] = $array_info[$k][1];
				$newinfo1['grow_num'] = $array_info[$k][2];
				$newinfo1['t_grow_area_1'] = $array_info[$k][3];
				$newinfo1['t_grow_area_2'] = $array_info[$k][4];
				$res = Db::name('pro_grow_task_area')->insert($newinfo1);
			}
			
			
		}else{
			
			$data['t_id'] = $t_id;
			$data['plan_id'] = $plan_id;
			$data['g_type_id'] = $array_info[$k][0];
			$data['area_id'] = $array_info[$k][1];
			$data['grow_num'] = $array_info[$k][2];
			$data['t_grow_area_1'] = $array_info[$k][3];
			$data['t_grow_area_2'] = $array_info[$k][4];
			$res = Db::name('pro_grow_task_area')->insert($data);
			
		}
		
		if($res!==false){
			return true;
		}else{
			return false;
		}
		
		
	}
	
	
	
	

    public function progrowtask_del()
    {
        $t_id=trim(request()->param('t_id'));
        if(!$t_id){return json(['status'=>0,'msg'=>"主键Id不存在"]);}
        
            $sql=Db::table('mf_pro_grow_task')->where('t_id',$t_id)->delete();
            if($sql){
                return json(['status'=>1,'msg'=>"删除成功"]);
            }else{
                return json(['status'=>0,'msg'=>"删除失败"]);
            }
       
    }
	
	
	
	 public function progrowtask_list_mytask()
   	 {
	 	
		$worker_id=request()->param('worker_id');
		if(!$worker_id){
            return json(['status'=>0,'msg'=>"负责人id为空"]);
        }

		//查询当前用户 拥有子计划
		$where['worker_id'] = $worker_id;
		$info = Db::name('pro_plan_son_worker')->field(['plan_id','ps_id'])->where($where)->select();
		
		if($info){
			foreach($info as $k=>$v){
				$plan_where['plan_id'] = $v['plan_id'];
				$plan_info = Db::name('product_plan')->field(['plan_name'])->where($plan_where)->find();
				$info[$k]['plan_name'] = $plan_info['plan_name'];
			}
		}
		
		if($info){return json(['status'=>1,'msg'=>"成功",'data'=>$info]);
        }else{
			return json(['status'=>0,'msg'=>"查询无种植任务"]);
		}
		
	 }
	
	
	

	
	/**
     * [7 task_detail 获取种植任务详情接口]
     * @return [type] [description]
     */
	
	public function task_detail(){
		//获取变量
		$plan_id = $this->request->param('plan_id');
		$ps_id = $this->request->param('ps_id');
		$t_id = $this->request->param('t_id');
		
		//验证变量
		if(!$plan_id){
			$result['status'] = 0;
			$result['msg'] = "生产计划id为空";
			ajaxReturnJson($result);
		}
		if(!$ps_id){
			$result['status'] = 0;
			$result['msg'] = "生产子计划的id为空";
			ajaxReturnJson($result);
		}
		if(!$t_id){
			$result['status'] = 0;
			$result['msg'] = "种植任务的id为空";
			ajaxReturnJson($result);
		}
		//程序主体
		/* $con['t.plan_id'] = $plan_id;
		$con['t.ps_id'] = $ps_id; */
		$con['t.t_id'] = $t_id;
		//查询当前种植任务详情
		$fields[] = 't.t_id';													//生计划id
		$fields[] = 'w.worker_name';											//子计划负责人
		$fields[] = 'mc.ftype as cat_type';										//果型
		$fields[] = 'mc.fcolor as cat_color';									//果色
		$fields[] = 'gm.mode_name';												//种植模式
		//$fields[] = 'ga.area_name';
		$fields[] = 't.estimate_get_date_1';											//预计采收期（开始）
		$fields[] = 't.estimate_get_date_2';											//预计采收期（结束）
		$fields[] = 't.grow_area_2 as grow_mianji_mu';	
		$fields[] = 't.zhu_ju';
		$fields[] = 't.hang_ju';
		$fields[] = 'p.grow_date';													//总计划定植日期
		$fields[] = 't.year_weight';
		$fields[] = 'mc.cat_name  as cat_p_name';
		$fields[] = 'mc1.cat_name';
		$fields[] = 't.total_cost';
		
		
		$info = Db::name('pro_grow_task t')
			//->join('mf_pro_plan_son_worker son','son.plan_id = t.plan_id')
			->join('mf_grow_mode gm','gm.mode_id = t.grow_mode_id')
			//->join('mf_pro_grow_task_area gta','gta.t_id = t.t_id')
			//->join('mf_grow_area ga','ga.area_id = gta.area_id')
			->join('mf_worker w','w.worker_id = t.worker_id')
			->join('mf_product_plan p','t.plan_id = p.plan_id')
			->join('mf_materiel_category mc','mc.cat_id = p.cat_id')//品种名称
			->join('mf_materiel_category mc1','mc1.cat_id = mc.pid')//作物名称
			->where($con)
			->field(join(',',$fields))
			->find();
		
		if($info){
			$t_id = $info['t_id'];
			$where['gt.t_id'] = $t_id;
			$area_names = Db::name('pro_grow_task gt')
						->join('pro_grow_task_area gta','gta.t_id = gt.t_id')
						->join('grow_area ga','ga.area_id = gta.area_id')
						->field('ga.area_id,ga.area_name')
						->where($where)
						->select();
			
			$info['area_name'] = $area_names;
			
		}

		
		if(!$info){
			['status'=>0,'msg'=>"此子计划下没有种植任务"];
		}	
		$result['status'] = 1;
		$result['msg'] = "获取成功";
		$result['data'] = $info;
		ajaxReturnJson($result);
	}
	
/**
 * [8 task_pcdetail 获取种植任务接口（pc）]
 * @return [type] [description]
 */

public function task_pcdetail(){
	//获取变量
	$plan_id = $this->request->param('plan_id');
	$ps_id = $this->request->param('ps_id');
	$t_id = $this->request->param('t_id');
	
	//验证变量
	if(!$plan_id){
		$result['status'] = 0;
		$result['msg'] = "生产计划id为空";
		ajaxReturnJson($result);
	}
	if(!$ps_id){
		$result['status'] = 0;
		$result['msg'] = "生产子计划的id为空";
		ajaxReturnJson($result);
	}
	if(!$t_id){
		$result['status'] = 0;
		$result['msg'] = "种植任务的id为空";
		ajaxReturnJson($result);
	}
	//程序主体
	$con['t.plan_id'] = $plan_id;
	$con['t.ps_id'] = $ps_id;
	$con['t.t_id'] = $t_id;
	//查询当前种植任务详情
	$fields[] = 't.t_id';													//生计划id
	$fields[] = 'w.worker_name';											//子计划负责人
	$fields[] = 'mc.ftype as cat_type';										//果型
	$fields[] = 'mc.fcolor as cat_color';									//果色
	$fields[] = 'gm.mode_name';												//种植模式
	$fields[] = 'ga.area_name';
	$fields[] = 't.estimate_get_date_1';											//预计采收期（开始）
	$fields[] = 't.estimate_get_date_2';											//预计采收期（结束）
	$fields[] = 't.grow_area_2 as grow_mianji_mu';	
	$fields[] = 't.zhu_ju';
	$fields[] = 't.hang_ju';
	$fields[] = 'p.grow_date';													//总计划定植日期
	$fields[] = 't.year_weight';
	$fields[] = 'mc.cat_name  as cat_p_name';
	$fields[] = 'mc1.cat_name';
	$fields[] = 'mc.cat_desc';
	$fields[] = 't.total_cost';
	$fields[] = 't.sm_weight';    //目标每平米的年产量
	$fields[] = 't.one_weight';   //目标单果重量不能为空
	$fields[] = 'gta.grow_num';   //定植数量
	
	$info = Db::name('pro_grow_task t')
		->join('mf_pro_plan_son_worker son','son.plan_id = t.plan_id')
		->join('mf_grow_mode gm','gm.mode_id = t.grow_mode_id')
		->join('mf_pro_grow_task_area gta','gta.t_id = t.t_id')
		->join('mf_grow_area ga','ga.area_id = gta.area_id')
		->join('mf_worker w','w.worker_id = t.worker_id')
		->join('mf_product_plan p','t.plan_id = p.plan_id')
		->join('mf_materiel_category mc','mc.cat_id = p.cat_id')//品种名称
		->join('mf_materiel_category mc1','mc1.cat_id = mc.pid')//作物名称
		->where($con)
		->field(join(',',$fields))
		->find();
		
	if(!$info){
		['status'=>0,'msg'=>"此子计划下没有种植任务"];
	}	
	$result['status'] = 1;
	$result['msg'] = "获取成功";
	$result['data'] = $info;
	ajaxReturnJson($result);
}	

	
	
	
	
	
	
	
	
	
	
	
	/**
	 * [1 p_son_detail 生产计划子计划详情（加此计划下所有的种植任务）]
	 * @return [type] [description]
	 */

	public function progrowtask_list(){
		//获取变量
		$plan_id = $this->request->param('plan_id');
		$ps_id = $this->request->param('ps_id');
		//验证变量
		if(!$plan_id){
			$result['status'] = 0;
			$result['msg'] = "生产计划id为空";
			ajaxReturnJson($result);
		}
		if(!$ps_id){
			$result['status'] = 0;
			$result['msg'] = "生产计划子计划id为空";
			ajaxReturnJson($result);
		}
		
		//程序主体
		$worker = $this->worker;
		$worker_id = $worker['worker_id'];
		$role_id = $worker['role_id'];
		$con['son.plan_id'] = $plan_id;
		$con['son.ps_id'] = $ps_id;
		
		$field[] = 'son.ps_id';
		$field[] = 'mc1.cat_name as parent_name';
		$field[] = 'mc.cat_name';
		$field[] = 'mc.ftype cat_type';
		$field[] = 'mc.fcolor cat_color';
		$field[] = 'mc.cat_desc';
		$field[] = 'p.grow_date';
		$field[] = 'p.estimate_get_date_1';											//预计采收期（开始）
		$field[] = 'p.estimate_get_date_2';											//预计采收期（结束）
		$field[] = 'son.p_amount';													//个人负责的产量
		$field[] = 'son.p_grow_area_2 as grow_area_2';							//种植面积
		
		$info = Db::name('pro_plan_son_worker son')
				->join('mf_product_plan p','son.plan_id = p.plan_id')
				->join('mf_worker w','w.worker_id = son.worker_id')
				->join('mf_materiel_category mc','mc.cat_id = p.cat_id')//品种名称
				->join('mf_materiel_category mc1','mc1.cat_id = mc.pid')//作物名称	
				->field(implode(',',$field))
				->where($con)
				->find();
		$data['all_info'] = $info;
		if(!$info){
			return json(['status'=>0,'msg'=>"此生产计划没有子计划"]);
		}
		$task_where['ps_id'] = $ps_id;
		$t_cost = Db::name('pro_grow_task')->where($task_where)->field('sum(year_weight) as year_weight,sum(total_cost) as total_cost')->select();//查询出来的是每一个种植任务的，相同的数据值要相加
		$add_plan_worker_id = Db::name('product_plan')->where('plan_id',$plan_id)->value('add_worker_id');
		$add_worker_id = Db::name('pro_grow_task')->where($task_where)->value('add_worker_id');
		$data['t_cost'] = $t_cost;
		//查询子计划的所有种植任务
		$fields[] = 't.t_id';
		$fields[] = 'gm.mode_name';
		//$fields[] = 'ga.area_name';
		$fields[] = 'w.worker_name';
		//$fields[] = 't.task_weight_1';
		$fields[] = 't.year_weight';
		$fields[] = 't.total_cost';
		$fields[] = 't.t_name';
		$t_list = array();
		
		$t_list = Db::name('pro_grow_task t')
					/* ->join('mf_pro_grow_task_area ta','ta.t_id = t.t_id')//此处种植区域拿掉
					->join('mf_grow_area ga','ga.area_id = ta.area_id') */
					->join('mf_worker w','w.worker_id = t.worker_id')
					->join('mf_grow_mode gm','gm.mode_id=t.grow_mode_id')
					->where($task_where)
					->field(implode(',',$fields))
					->select();

		$data['task_info'] = $t_list;
		if($info){
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $data;
			ajaxReturnJson($result);
		}else{
			$result['status'] = 0;
			$result['msg'] = "获取失败";
			$result['data'] = '';
			ajaxReturnJson($result);
		}
	}
	
	/**
	 * [grow_task_list 种植任务列表]
	 * @return [type] [description]
	 */

	public function grow_task_list(){
		
		//程序主体
		$worker = $this->worker;
		$worker_id = $worker['worker_id'];

		$con['t.worker_id'] = $worker_id;
		
		//查询子计划的所有种植任务
		$fields[] = 'p.cat_id';
		$fields[] = 't.t_id';
		$fields[] = 'gm.mode_name';
		$fields[] = 'w.worker_name';
		$fields[] = 't.year_weight';
		$fields[] = 't.total_cost';
		$fields[] = 't.t_name';
		$fields[] = 't.add_time';

		$t_list = array();
		
		$t_list = Db::name('pro_grow_task t')	
				->join('mf_worker w','w.worker_id = t.worker_id')
				->join('mf_grow_mode gm','gm.mode_id=t.grow_mode_id')
				->join('mf_product_plan p','p.plan_id = t.plan_id')
				->where($con)
				->field(implode(',',$fields))
				->select();
		
		$arr = array();

		foreach($t_list as $k=>$v){
			$arr = Db::name('materiel_category')->where('cat_id',$v['cat_id'])->field('cat_name,pid,fcolor,ftype')->find();
			
			$t_list[$k]['cat_name'] = $arr['cat_name'];
			$t_list[$k]['fcolor'] = $arr['fcolor'];
			$t_list[$k]['ftype'] = $arr['ftype'];
			$t_list[$k]['cat_p_name'] = Db::name('materiel_category')->where('cat_id',$arr['pid'])->value('cat_name');
		}

		$data = $t_list;

		$result['status'] = 1;
		$result['msg'] = "获取成功";
		$result['data'] = $data;
		ajaxReturnJson($result);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/**
	 * 生产"子"计划详情（两个页面调用一个接口）
	 */
    public function progrowtask_list1()
    {		
		$plan_id=request()->param('plan_id');
		if(!$plan_id){return json(['status'=>0,'msg'=>"计划id为空"]);}
		$ps_id=request()->param('ps_id');
		if(!$ps_id){return json(['status'=>0,'msg'=>"计划id为空"]);}
		
		$info = Db::name('product_plan')->find();
		
		$return_info['all_info'] = array();
		if($info){
			//获取果型  果色 负责人名字
			$cat_color = Db::name('fruits_color')->where('cat_id',$info['cat_id'])->find();
			$cat_type = Db::name('fruits_type')->where('cat_id',$info['cat_id'])->find();
			
			$info['cat_color'] = $cat_color['ft_name'];
			$info['cat_type'] = $cat_type['ft_name'];
			
			$where1['ps_id'] = $ps_id;
			$where1['plan_id'] = $plan_id;
			$worker_id = Db::name('pro_plan_son_worker')->where($where1)->find();
			
			$worker_info = Db::name('worker')->where('worker_id',$worker_id['worker_id'])->find();
			$info['worker_name'] = $worker_info['worker_name'];
			
			$cate_info = Db::name('materiel_category')->field(['cat_desc,cat_name,pid'])->where('cat_id',$info['cat_id'])->find();
			$info['cat_desc'] = $cate_info['cat_desc'];
			$info['cat_name'] = $cate_info['cat_name'];
			
			
			$parent_info = Db::name('materiel_category')->field(['cat_name'])->where('cat_id',$cate_info['pid'])->find();
			$info['parent_name'] = $parent_info['cat_name'];

			$con['plan_id'] = $plan_id;
			$con['ps_id'] = $ps_id;
			$p_grow_area_2 = Db::name('pro_plan_son_worker')->field('p_grow_area_2')->where($con)->find();
			$info['grow_area_2'] = $p_grow_area_2['p_grow_area_2'];
			$return_info['all_info'] = $info;

		}
		
		//查询子计划所有种植任务1
		$task_where['ps_id'] = $ps_id;
		
		$task_info = Db::name('pro_grow_task')->where($task_where)->select();
		if($task_info){
			foreach($task_info as $k=>$v){
				
				//获取负责人名字
				$worker_info = Db::name('worker')->where('worker_id',$v['worker_id'])->find();
				$task_info[$k]['worker_name'] = $worker_info['worker_name'];
				
				//获取种植面积
				$model_info = Db::name('pro_grow_task_area')->field(['area_id,t_grow_area_1,t_grow_area_2'])->where('t_id',$v['t_id'])->find();//同一个种植任务下边有多个种植区域
				$area_id = $model_info['area_id'];
				$area_name = Db::name('grow_area')->field(['area_name'])->where('area_id',$area_id)->find();
				
				$task_info[$k]['area_name'] = $area_name['area_name'];
				$task_info[$k]['t_grow_area_1'] = $model_info['t_grow_area_1'];
				$task_info[$k]['t_grow_area_2'] = $model_info['t_grow_area_2'];
				
				
				//获取种植模式
				$model_info = Db::name('grow_mode')->field(['mode_name'])->where('mode_id',$v['grow_mode_id'])->find();
				$task_info[$k]['mode_name'] = $model_info['mode_name'];
				
			}
			
			$return_info['task_info'] = $task_info;
		}else{
			$return_info['task_info'] =array();
		}
		
		if($return_info){return json(['status'=>1,'msg'=>"成功",'data'=>$return_info]);}else{
				return json(['status'=>0,'msg'=>"查询无数据"]);
		}
			
    }
	
	
	/**
	 * [3 progrowtask_add_plan_info 种植任务添加的 所有外显的数据]
	 * @return [type] [description]
	 */
	public function progrowtask_add_all(){
		//获取变量
		$t_id = $this->request->param('t_id');
		$cat_id = $this->request->param('cat_id');
		//验证变量
		if(!$t_id){
			$result['status'] = 0;
			$result['msg'] = "种植任务id为空";
			ajaxReturnJson($result);
		}
		if(!$cat_id){
			$result['status'] = 0;
			$result['msg'] = "品种id为空";
			ajaxReturnJson($result);
		}
		//程序主体
		$con['t_id'] = $t_id;

		$field[] = 'grow_area_1 as grow_area_2';
		$field[] = 'task_weight_1';
		$field[] = 'grow_date';
		$field[] = 'estimate_get_date_1';
		$field[] = 'estimate_get_date_2';

		//种植计划信息(头部)
		$t_title = Db::name('pro_grow_task')->field(implode(',',$field))->where($con)->find();

		$cat = 	Db::name('materiel_category mc')
				->field('mc.cat_name,m.cat_name as parent_name,mc.ftype cat_type,mc.ftype cat_type,mc.fcolor cat_color,mc.cat_desc')
				->join('mf_materiel_category m','m.cat_id = mc.pid')
				->where('mc.cat_id',$cat_id)
				->find();
		$t_title['grow_area_2'] = round($t_title['grow_area_2'],2);		
		$t_title['cat_name'] = $cat['cat_name'];
		$t_title['parent_name'] = $cat['parent_name'];
		$t_title['cat_type'] = $cat['cat_type'];
		$t_title['cat_color'] = $cat['cat_color'];
		$t_title['cat_desc'] = $cat['cat_desc'];

		//种植模式的下拉列表
		$con2['status'] = 1;
		$gm = Db::name('grow_mode')->where($con2)->field('mode_id,mode_name')->select();
		//种植环境的下拉列表
		$hjs = Db::name('grow_type')->where($con2)->field('id,type_name')->select();
		
		
		foreach($hjs as $k=>$hj){
			$id = $hj['id'];
			$where2['g_type_id'] = $id;
			$info = Db::name('grow_area')->where($where2)->find();
			if(!$info){
				/* $hjs[$k]['id'] = '';
				$hjs[$k]['type_name'] = ''; */
				unset($hjs[$k]);
			}
			
		}
		$arr = [];
		foreach($hjs as $row){
			$arr[] = $row;	
		}
		
		//未分配面积
		/*$p_grow_area = Db::name('pro_plan_son_worker')->where('ps_id',$ps_id)->value('p_grow_area_2');
		$t_grow_area = Db::name('pro_grow_task p')
					->join('pro_grow_task_area a','a.t_id = p.t_id')
					->where('p.ps_id',$ps_id)
					->field('sum(t_grow_area_2) as t_grow_area')
					->find();
		if(!$t_grow_area){
			$t_grow_area['t_grow_area'] = 0;
		}
		$diff_area = $p_grow_area - $t_grow_area['t_grow_area'];*/	
		$array = array();		
		$data['info'] = $t_title;
		$data['pep_info'] = $array;
		$data['ms_info'] = $gm;
		$data['hj_info'] = $arr;
		$data['diff_area'] = $t_title['grow_area_2'];
		if($data){
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $data;
			ajaxReturnJson($result);
		}else{
			$result['status'] = 0;
			$result['msg'] = "查询无数据";
			ajaxReturnJson($result);
		}
	}
	

    // 种植任务添加的人员列表  下拉框
	public function progrowtask_add_all1(){
		
		
		$plan_id=request()->param('plan_id');
		if(!$plan_id){return json(['status'=>0,'msg'=>"计划id为空"]);}
		$ps_id=request()->param('ps_id');
		if(!$ps_id){return json(['status'=>0,'msg'=>"计划id为空"]);}
		//查询当前总计划信息
		$where['plan_id'] = $plan_id;
		$info = Db::name('product_plan')->where($where)->find();
		
		$return_info['all_info'] = array();
		if($info){
			//获取果型  果色 负责人名字
			$cat_color = Db::name('fruits_color')->where('cat_id',$info['cat_id'])->find();
			$cat_type = Db::name('fruits_type')->where('cat_id',$info['cat_id'])->find();
			
			$info['cat_color'] = $cat_color['ft_name'];
			$info['cat_type'] = $cat_type['ft_name'];
			
			
			$worker_info = Db::name('worker')->where('worker_id',$info['add_worker_id'])->find();
			$info['worker_name'] = $worker_info['worker_name'];
			
			$cate_info = Db::name('materiel_category')->field(['cat_desc,cat_name,pid'])->where('cat_id',$info['cat_id'])->find();
			$info['cat_desc'] = $cate_info['cat_desc'];
			$info['cat_name'] = $cate_info['cat_name'];
			
			
			$parent_info = Db::name('materiel_category')->field(['cat_name'])->where('cat_id',$cate_info['pid'])->find();
			$info['parent_name'] = $parent_info['cat_name'];
			$return_info['all_info'] = $info;

		}
		
		//人员列表
		$pep_info=Db::table('mf_worker')->where('status',1)->field('worker_id,worker_name')->select();

		//种植模式列表
		$ms_info=Db::table('mf_grow_mode')->where('status',1)->field('mode_id,mode_name')->select();
		
		//种植环境
		$hj_info=Db::table('mf_grow_type')->where('status',1)->field('id,type_name')->select();
		
		$data['info'] = $info;
		$data['pep_info'] = $pep_info;
		$data['ms_info'] = $ms_info;
 
		$data['hj_info'] = $hj_info;
		
		if($data){return json(['status'=>1,'msg'=>"成功",'data'=>$data]);}else{
                return json(['status'=>0,'msg'=>"查询无数据"]);
        } 



    }
	
	/**
	 *[4 getprowtask_get_area 获取环境下的区域]
	 * @return [type] [description]
	 */
	public function getprowtask_get_area(){
		//获取变量
		$id = $this->request->param('id');
		//验证变量
		if(!$id){
			$result['status'] = 0;
			$result['msg'] = "请先选取您想要的种植模式";
			ajaxReturnJson($result);
		}
		//程序主体
		$con['status'] = 1;
		$con['g_type_id'] = $id;
		$qy_info=Db::name('grow_area')->where($con)->field('area_id,area_name,area_num')->select();
		if($qy_info){
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $qy_info;
			ajaxReturnJson($result);
		}else{
			$result['status'] = 0;
			$result['msg'] = "查询无数据";
			ajaxReturnJson($result);
		}
		
	}
	
	//获取环境下的区域
	
	public function getprowtask_get_area1(){
		$id=request()->param('id');
		//种植区域列表
		$qy_info=Db::table('mf_grow_area')->where('g_type_id',$id)->field('area_id,area_name,area_num')->select();
		if($qy_info){return json(['status'=>1,'msg'=>"成功",'data'=>$qy_info]);}else{
                return json(['status'=>0,'msg'=>"查询无数据",'data'=>array()]);
        } 
		
	}




    //种植任务添加的 种植计划信息
    
     public function progrowtask_add_plan_info(){
        
        $plan_id=request()->param('plan_id');
        if(!$plan_id){return json(['status'=>0,'msg'=>"计划id为空"]);}

        
       $sqlla=Db::View('mf_product_plan','plan_id,plan_name,cat_id,grow_date,estimate_get_date_1,estimate_get_date_2,grow_area_2,estimate_amount')
                ->view('mf_fruits_color','ft_name',"mf_fruits_color.cat_id=mf_product_plan.cat_id")
                ->view('mf_fruits_type','ft_name AS guoxing,cat_id',"mf_fruits_type.cat_id=mf_product_plan.cat_id")
                ->view('mf_materiel_category','cat_id,cat_name,cat_desc',"mf_materiel_category.cat_id=mf_product_plan.cat_id")
                ->where('plan_id',$plan_id)
                ->find();
                $cat_id=$sqlla['cat_id'];
                $abd=Db::TABLE('mf_materiel_category')->WHERE('PID',$cat_id)->FIELD('cat_id as scat_id,cat_name as scat_name')->select();
                $sqlla['sname']=$abd;

                if($sqlla){return json(['status'=>1,'msg'=>"成功",'data'=>$sqlla]);}else{
                return json(['status'=>0,'msg'=>"失败"]);
                } 
    }

	/**
	*[ person_prowtask 我的种植任务]
	* @return [type] [description]
	*/
	public function person_growtask(){
		//获取变量
		$type = $this->request->param('type');

		if(!isset($type)){

			$result['status'] = 0;
			$result['msg'] = "type值不存在";
			ajaxReturnJson($result);

		}
		//程序主体
		$worker = $this->worker;
		$worker_id = $worker['worker_id'];

		if($type == 1){
			$con['t.status'] = array(['egt',0],['elt',1]);
		}elseif($type == 2){
			$con['t.status'] = 2;
		}else{
			$con['t.status'] = 3;
		}
		$con['t.worker_id'] = $worker_id;
		//查询子计划的所有种植任务
		$fields[] = 'p.cat_id';
		$fields[] = 't.t_id';
		$fields[] = 'w.worker_name';
		$fields[] = 'k.worker_name as add_worker_name';
		$fields[] = 't.task_weight_1';
		$fields[] = 't.t_name';
		$fields[] = 't.add_time';
		$fields[] = 't.status';
		$fields[] = 't.grow_area_1 as grow_area_2';

		$t_list = array();
		
		$t_list = Db::name('pro_grow_task t')	
				->join('mf_worker w','w.worker_id = t.worker_id')
				->join('mf_worker k','k.worker_id = t.add_worker_id')
				->join('mf_product_plan p','p.plan_id = t.plan_id')
				->where($con)
				->field(implode(',',$fields))
				->order('t.add_time desc')
				->paginate(8);
		$page = $t_list->render();
        $list = $t_list->items();        
        $jsonStr = json_encode($t_list);
        $info = json_decode($jsonStr,true);
        $pages = $info['last_page']; 
        $page_list = array();
        $page_list['page'] = $page;
        $page_list['pages'] = $pages;

		$arr = array();

		foreach($info['data'] as $k=>$v){
			$arr = Db::name('materiel_category')->where('cat_id',$v['cat_id'])->field('cat_name,pid,fcolor,ftype')->find();
			$info['data'][$k]['grow_area_2'] = round($v['grow_area_2'],2);
			$info['data'][$k]['cat_name'] = $arr['cat_name'];
			$info['data'][$k]['fcolor'] = $arr['fcolor'];
			$info['data'][$k]['ftype'] = $arr['ftype'];
			$info['data'][$k]['cat_p_name'] = Db::name('materiel_category')->where('cat_id',$arr['pid'])->value('cat_name');
			$output = 0;
			$output = Db::name('task_sum')->where('t_id',$v['t_id'])->value('total_output');
			if(!$output){
				$output = 0;
			}
			$info['data'][$k]['total_output'] = $output;
		}
		if($info['data']){
			$data = $info['data'];
		}else{
			$data = array();
		}

		$result['status'] = 1;
		$result['msg'] = "获取成功";
		$result['total']=$page_list;
		$result['data'] = $data;
		ajaxReturnJson($result);
	}

	/**
	*[ person_prowtask 我的种植任务详情]
	* @return [type] [description]
	*/
	public function person_growtask_detail(){
		//获取变量
		$t_id = $this->request->param('t_id');

		if(!$t_id){
			$result['status'] = 0;
			$result['msg'] = "种植任务id为空";
			ajaxReturnJson($result);

		}

		$con['t.t_id'] = $t_id;

		$fields[] = 'p.cat_id';
		$fields[] = 'p.grow_date as date';
		$fields[] = 'p.estimate_get_date_1 as get_date_1';
		$fields[] = 'p.estimate_get_date_2 as get_date_2';
		$fields[] = 't.t_id';
		$fields[] = 'w.worker_name';
		$fields[] = 'k.worker_name as add_worker_name';
		$fields[] = 't.task_weight_1';
		$fields[] = 't.grow_mode_id';
		$fields[] = 't.grow_area_1 as grow_area_2';
		$fields[] = 't.zhu_ju';
		$fields[] = 't.hang_ju';
		$fields[] = 't.grow_date';
		$fields[] = 't.one_weight';
		$fields[] = 't.sm_weight';
		$fields[] = 't.year_weight';
		$fields[] = 't.total_grow_num';
		$fields[] = 't.estimate_get_date_1';
		$fields[] = 't.estimate_get_date_2';
		$fields[] = 't.t_name';
		$fields[] = 't.add_time';
		$fields[] = 't.status';

		$t_list = array();
		
		$t_list = Db::name('pro_grow_task t')	
				->join('mf_worker w','w.worker_id = t.worker_id')
				->join('mf_worker k','k.worker_id = t.add_worker_id')
				->join('mf_product_plan p','p.plan_id = t.plan_id')
				->where($con)
				->field(implode(',',$fields))
				->find();

		if($t_list['grow_mode_id']){
			$t_list['mode_name'] = Db::name('grow_mode')->where('mode_id',$t_list['grow_mode_id'])->value('mode_name');
		}

		$t_list['grow_area_2'] = round($t_list['grow_area_2'],2);

		$list = Db::name('pro_grow_task_area p')
			->join('mf_grow_area a','p.area_id = a.area_id')
			->join('mf_grow_type y','p.g_type_id = y.id')
			->where('t_id',$t_id)
			->field('a.area_name,p.t_grow_area_1 as t_grow_area_2,p.grow_num,p.g_type_id,p.area_id,y.type_name')
			->select();	
		if($list){
			foreach($list as $k=>$v){
				$t_list['area'][$k]['type_id'] = $v['g_type_id'];
				$t_list['area'][$k]['type_name'] = $v['type_name'];
				$t_list['area'][$k]['area_id'] = $v['area_id'];
				$t_list['area'][$k]['area_name'] = $v['area_name'];
				$t_list['area'][$k]['area_num'] = round($v['t_grow_area_2'],2);
				$t_list['area'][$k]['grow_num'] = $v['grow_num'];;
			}
		}else{
			$t_list['area'] = array();
		}
		$arr = array();

		$arr = Db::name('materiel_category')->where('cat_id',$t_list['cat_id'])->field('cat_name,pid,fcolor,ftype')->find();
		
		$t_list['cat_name'] = $arr['cat_name'];
		$t_list['fcolor'] = $arr['fcolor'];
		$t_list['ftype'] = $arr['ftype'];
		$t_list['cat_p_name'] = Db::name('materiel_category')->where('cat_id',$arr['pid'])->value('cat_name');

		$output = 0;
		$output = Db::name('task_sum')->where('t_id',$t_id)->value('total_output');
		if(!$output){
			$output = 0;
		}

		$t_list['total_output'] = $output;

		$data = $t_list;

		$result['status'] = 1;
		$result['msg'] = "获取成功";
		$result['data'] = $data;
		ajaxReturnJson($result);

	}

	/**
	*[confirm_task 确认任务完成]
	* @return [type] [description]
	*/
	public function confirm_task(){

		//获取变量
		$t_id = $this->request->param('t_id');

		if(!$t_id){
			$result['status'] = 0;
			$result['msg'] = "种植任务id为空";
			ajaxReturnJson($result);

		}

		$con['t_id'] = $t_id;

		$put = Db::name('pro_grow_task')->where('t_id',$t_id)->value('task_weight_1');
		
		$output = Db::name('task_sum')->where('t_id',$t_id)->value('total_output');

		$add_worker_id = Db::name('pro_grow_task')->where('t_id',$t_id)->value('add_worker_id');

		$p = Db::name('worker')->where('worker_id',$add_worker_id)->value('phone');

	/*	if($output < $put){

			$result['status'] = 0;
			$result['msg'] = "实际产量低于预计产量，请先产量质检";

			ajaxReturnJson($result);
		}*/

		$data['status'] = 3;

		$re = Db::name('pro_grow_task')->where('t_id',$t_id)->update($data);

		if($re !== false){

    		$res = Db::name('pro_grow_task')->where('t_id',$t_id)->setField('estimate_get_date_2',date('Y-m-d'));

			$title='种植任务消息提醒';
			$content='新的种植任务已完成';
			$phone = trim($p);
			pushMess($title,$content,$phone);

			$result['status'] = 1;
			$result['msg'] = "确认完成";

			return json($result);

		}else{

			$result['status'] = 0;
			$result['msg'] = "确认失败";

			return json($result);
		}

	}

	/**
	*[edit_pg_task 修改种植任务]
	* @return [type] [description]
	*/
	public function edit_pg_task(){

	//添加环境 区域信息
		$array_info = json_decode($this->request->param('array_info'),true);
		$data = [];
/*		$data['grow_area_1'] = 0;
		$data['grow_area_2'] = 0;*/
		foreach($array_info as $k=>$info){
/*			$data['grow_area_1'] += $info[3];
			$data['grow_area_2'] += $info[4];	*/
			if(!$info[0]){
				$result['status'] = 0;
				$result['msg'] = "请选择种植环境";
				ajaxReturnJson($result);
			}
			if(!$info[1]){
				$result['status'] = 0;
				$result['msg'] = "请选择种植区域";
				ajaxReturnJson($result);
			}
			if(!$info[3]){
				$result['status'] = 0;
				$result['msg'] = "请输入定植数量";
				ajaxReturnJson($result);
			}						
		}
		//获取变量
		$t_id= $this->request->param('t_id');
		$con['t_id'] = $t_id;
		if(!$t_id){
			$result['status'] = 0;
			$result['msg'] = "种植任务id为空";
			ajaxReturnJson($result);
		}

		$grow_mode_id = $this->request->param('grow_mode_id');
		$zhu_ju = $this->request->param('zhu_ju');
		$hang_ju = $this->request->param('hang_ju');
		$total_grow_num = $this->request->param('total_grow_num');
		$one_weight = $this->request->param('one_weight');
		$sm_weight = $this->request->param('sm_weight');
		$year_weight = $this->request->param('year_weight');
		$grow_date = $this->request->param('grow_date');
		$estimate_get_date_1 = $this->request->param('estimate_get_date_1');
		$estimate_get_date_2 = $this->request->param('estimate_get_date_2');

		if(!$grow_mode_id){
			$result['status'] = 0;
			$result['msg'] = "种植模式id为空";
			ajaxReturnJson($result);
		}
		if(!$zhu_ju){
			$result['status'] = 0;
			$result['msg'] = "请输入株距";
			ajaxReturnJson($result);
		}
		if(!$hang_ju){
			$result['status'] = 0;
			$result['msg'] = "请输入行距";
			ajaxReturnJson($result);
		}
		if(!$total_grow_num){
			$result['status'] = 0;
			$result['msg'] = "请输入总种植株数";
			ajaxReturnJson($result);
		}
		if(!$one_weight){
			$result['status'] = 0;
			$result['msg'] = "请输入目标单果重量（单位g）";
			ajaxReturnJson($result);
		}
		if(!$sm_weight){
			$result['status'] = 0;
			$result['msg'] = "请输入目标每平米产量";
			ajaxReturnJson($result);
		}
		if(!$year_weight){
			$result['status'] = 0;
			$result['msg'] = "请输入目标年产量";
			ajaxReturnJson($result);
		}
		if(!$grow_date){
			$result['status'] = 0;
			$result['msg'] = "请选择定植日期";
			ajaxReturnJson($result);
		}
		if(!$estimate_get_date_1){
			$result['status'] = 0;
			$result['msg'] = "请选择预计采收期（开始）";
			ajaxReturnJson($result);
		}
		if(!$estimate_get_date_2){
			$result['status'] = 0;
			$result['msg'] = "请选择预计采收期（结束）";
			ajaxReturnJson($result);
		}

		$data['grow_mode_id'] = $grow_mode_id;
		$data['zhu_ju'] = $zhu_ju;
		$data['hang_ju'] = $hang_ju;
		$data['total_grow_num'] = $total_grow_num;
		$data['one_weight'] = $one_weight;
		$data['sm_weight'] = $sm_weight;
		$data['year_weight'] = $year_weight;
		$data['grow_date'] = $grow_date;
		$data['estimate_get_date_1'] = $estimate_get_date_1;
		$data['estimate_get_date_2'] = $estimate_get_date_2;

		$re = Db::name('pro_grow_task')->where($con)->update($data);	//添加种植任务
		$plan_id = Db::name('pro_grow_task')->where($con)->value('plan_id');
		if($re !== false){
			$con1['t_id'] = $t_id;			
			$resu = Db::name('pro_grow_task_area')->where($con1)->delete();
			if(!$resu){
				$result['status'] = 0;
				$result['msg'] = "删除种植区域信息失败";
				ajaxReturnJson($result);
			}
			foreach($array_info as $k=>$info){
				$data1['t_id'] = $t_id;
				$data1['plan_id'] = $plan_id;
				$data1['g_type_id'] = $info[0]; 
				$data1['area_id'] = $info[1];
				$data1['grow_num'] = $info[2];
				$data1['t_grow_area_1'] = $info[3];
				$data1['t_grow_area_2'] = $info[4];
				$res = Db::name('pro_grow_task_area')->insert($data1);
				if(!$res){
					$result['status'] = 0;
					$result['msg'] = "种植区域和定植数量信息修改失败";
					ajaxReturnJson($result);
				}
			}
			$result['status'] = 1;
			$result['msg'] = "修改成功";
			ajaxReturnJson($result);
		}else{
			$result['status'] = 0;
			$result['msg'] = "修改失败";
			ajaxReturnJson($result);
		}

	}


}
?>