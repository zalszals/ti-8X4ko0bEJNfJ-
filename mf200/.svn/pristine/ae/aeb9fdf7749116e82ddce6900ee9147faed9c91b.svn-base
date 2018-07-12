<?php
namespace app\product\controller;
use app\base\controller\Base;
use think\Db;
use think\Request;
class Harvestday extends Base
{
	/**
	* [1 harvestadd 日产量的添加]
	* @param post传参 
	* @return [type] status 状态值 msg 返回信息 data 返回数据
	*/	
			/**
     * [get_plan_sn 获取insert编号]
     * @return [type] [description]
     */
	private function get_insert_sn(){
		//获取变量
		$shijian = date('Ymd');//当天时间
		$con['plan_date'] = array('eq',$shijian);
		$number = Db::name('ck_insert')->count();
		$number++;
		//填充0；str_pad()填充字符串；STR_PAD_LEFT:填充到字符串的左侧
		
		$numbered = str_pad($number,3,"0",STR_PAD_LEFT);
		 
		$plan_no = $shijian.$numbered;
		return $plan_no;
	}	
		/**
     * [get_plan_sn 获取lingliao编号]
     * @return [type] [description]
     */
	private function get_lingliao_sn(){
		//获取变量
		$shijian = date('Ymd');//当天时间
		$con['plan_date'] = array('eq',$shijian);
		$number = Db::name('ck_lingliao')->count();
		$number++;
		//填充0；str_pad()填充字符串；STR_PAD_LEFT:填充到字符串的左侧
		
		$numbered = str_pad($number,3,"0",STR_PAD_LEFT);
		 
		$plan_no = $shijian.$numbered;
		return $plan_no;
	}	
	public function harvestadd(){
		//获取变量
		$t_id = $this->request->param('t_id');                                             //种植任务id
		if(!$t_id){
			$result['status'] = 0;
			$result['msg'] = "种植任务id为空";
			ajaxReturnJson($result);
		}
		$con['t_id'] = $t_id;
		$info = Db::name('pro_grow_task')->field('plan_id,ps_id')->where($con)->find();
		if($info){
			$plan_id = $info['plan_id'];                                                   //生产计划id
			$ps_id = $info['ps_id'];                                                     //生产子计划id
			$con1['plan_id'] = $plan_id;
			
			$field[] = 'p.cat_id';
			//$field[] = 'm.m_id';
			$info1 = Db::name('product_plan p')
				   ->field(implode(',',$field))
				   //->join('mf_materiel m','m.cat_id = p.cat_id')
				   ->where($con1)
				   ->find();
			if($info1){
				$cat_id = $info1['cat_id'];                                                //作物品种id
				//$m_id = $info1['m_id'];                                                    //物料id
				$data['cat_id'] = $cat_id;
				//$data['m_id'] = $m_id;
			}
		}
		$area_id = $this->request->param('area_id');                                       //种植区域id
		$data['sell_product_id'] = $this->request->param('sell_product_id');               //种植任务id
		$num = $this->request->param('num');                                               //日产量
		$one_weight = $this->request->param('one_weight');                                 //平均单果重量
		$num_1 = $this->request->param('num_1');                                           //一级果（kg）
		$num_2 = $this->request->param('num_2');                                           //二级果（kg）
		$add_time = date('Y-m-d H:i:s');                                                   //创建时间
		$get_time = $this->request->param('get_time');                                     //采摘日期
		$add_worker_id = $this->worker['worker_id'];                                         //添加人id(这里设为当前登录者)
		if($num_1&&$num_2){
			$num_3 = $num_1+$num_2;
			$percentum_1 = round($num_1/$num_3*100,2);                                     //一级果率
			$percentum_2 = round($num_2/$num_3*100,2);                                     //二级果率
			
		}
		//验证变量
		if(!$area_id){
			$result['status'] = 0;
			$result['msg'] = "种植区域id为空";
			ajaxReturnJson($result);
		}
		if(!$num){
			$result['status'] = 0;
			$result['msg'] = "请输入已选区域日产量";
			ajaxReturnJson($result);
		}
		if(!$one_weight){
			$result['status'] = 0;
			$result['msg'] = "请输入平均单果重";
			ajaxReturnJson($result);
		}
		if(!$num_1){
			$result['status'] = 0;
			$result['msg'] = "请输入一级果产量";
			ajaxReturnJson($result);
		}
		if(!$num_2){
			$result['status'] = 0;
			$result['msg'] = "请输入二级果产量";
			ajaxReturnJson($result);
		}
		if(!$get_time){
			$result['status'] = 0;
			$result['msg'] = "请选择采摘日期";
			ajaxReturnJson($result);
		}
		if(!$add_worker_id){
			$result['status'] = 0;
			$result['msg'] = "添加人id为空";
			ajaxReturnJson($result);
		}
		//程序主题
		$data['t_id'] = $t_id;
		$data['plan_id'] = $plan_id;
		$data['ps_id'] = $ps_id;
		$data['area_id'] = $area_id;
		
		$data['num'] = $num;
		$data['num_1'] = $num_1;
		$data['num_2'] = $num_2;
		$data['one_weight'] = $one_weight;
		$data['percentum_1'] = $percentum_1;
		$data['percentum_2'] = $percentum_2;
		$data['add_time'] = $add_time;
		$data['get_time'] = $get_time;
		$data['add_worker_id'] = $add_worker_id; 
		$find =  Db::name('pro_harvest_day')->where('t_id',$t_id)->find();
		$hd_id = Db::name('pro_harvest_day')->insertGetId($data);
		if($hd_id){
			
			if($data['sell_product_id']){
				//修改销售任务表信息
				$sell_task_info =  Db::name('sell_task')->where('sell_product_id = '.$data['sell_product_id'])->field('id')->find();
				if($sell_task_info){
					Db::name("sell_task")->where("id = ".$sell_task_info['id'])->setDec('num_expect',$num);
					Db::name("sell_task")->where("id = ".$sell_task_info['id'])->setDec('margin_num',$num);
					Db::name("sell_task")->where("id = ".$sell_task_info['id'])->setDec('use_num',$num);
				}
			}

			
			//$re =  Db::name("materiel")->where("m_id = ".$va['m_id'])->setDec('num',$va["m_num"]);	
			
			//种植任务汇总表数据更新
			db('task_sum')->where($con)->setInc('n1_output',$num_1);  //一级果产量
			db('task_sum')->where($con)->setInc('n2_output',$num_2);  //二级果产量
			db('task_sum')->where($con)->setInc('total_output',$num_1+$num_2);  //总产量
			//生产计划汇总表数据更新
			db('pro_sum')->where($con1)->setInc('n1_output',$num_1);    //一级果产量
			db('pro_sum')->where($con1)->setInc('n2_output',$num_2);    //一级果产量
			db('pro_sum')->where($con1)->setInc('total_output',$num_1+$num_2);  //总产量
			//品种汇总表数据更新
			$con2['cat_id'] = $cat_id;
			db('mc_sum')->where($con2)->setInc('total_output',$num_1+$num_2);  //总产量
			db('mc_sum')->where($con2)->setInc('n1_output',$num_1);    //一级果产量
			db('mc_sum')->where($con2)->setInc('n2_output',$num_2);    //一级果产量
			/* dump($con);echo'----------';dump($con1);echo'----------';dump($con2);
			die; */
 
			//插入insert虚拟库 并且添加实库 $cat_id
			//if(1>2){
				
			//}
			
			$re_check = Db::name('group')->where('group_id',4)->find();
			if($re_check && $re_check['is_buy']=='1'){
				$this->insert_check_materiel($cat_id,$plan_id,$add_worker_id,$num_1,$num_2,$get_time,$hd_id);
			}
			
 
			if(!$find){
				$re = Db::name('pro_grow_task')->where('t_id',$t_id)->setField('estimate_get_date_1',$get_time);
			}
 
			$result['status'] = 1;
			$result['msg'] = "添加成功";
			ajaxReturnJson($result);
		}else{
			$result['status'] = 0;
			$result['msg'] = "添加失败";
			ajaxReturnJson($result);
		}
		
	}	
	//质检入库 insert_check_materiel
	public function insert_check_materiel($cat_id,$plan_id,$add_worker_id,$num_1,$num_2,$get_time,$hd_id){
		//查询物料是否存在
		$re_num1 =  Db::name("materiel")->where("cat_id = ".$cat_id." and type = 1 and m_desc = '一级果'")->find();	
		
		if($num_1 > 0){

			if($re_num1){
	 
				$category_info =   Db::name("materiel_category")->where('cat_id = '.$cat_id)->field('ck_id,cat_name')->find();
				$ling_info_one['type'] = 19;
				$ling_info_one['insert_sn'] = $this->get_insert_sn();
				$ling_info_one['cat_id'] = $cat_id;
				$ling_info_one['cat_child_id'] = $re_num1['m_id'];
				$ling_info_one['ck_id'] = $category_info['ck_id'];
				$ling_info_one['materiel_desc'] = '一级果';
				$ling_info_one['cat_child_name'] = $category_info['cat_name'].'一级果';
				$ling_info_one['num'] = $num_1;
				$ling_info_one['unit'] = 'KG';
				$ling_info_one['apply_worker'] = $add_worker_id;
	 			$ling_info_one['add_time'] = strtotime($get_time);
	 			$ling_info_one['tb_id'] = $hd_id;
				 
				$insert_re1= Db::name("ck_insert")->insertGetId($ling_info_one); 
				//$re =  Db::name("materiel")->where("m_id = ".$re_num1['m_id'])->setDec('num',$num_1);	
			}else{
				$cate_info =   Db::name("materiel_category")->where(' cat_id = '.$cat_id)->field('ck_id,cat_no,cat_name')->find();
				
				$ling_one['m_no'] = $cate_info['cat_no'].'_1';
				$ling_one['cat_id'] = $cat_id;
				$ling_one['m_name'] = $cate_info['cat_name'].'一级果';
				$ling_one['m_desc'] = '一级果';
				$ling_one['num'] = $num_1;
				$ling_one['unit'] = 'KG';
				$ling_one['warning_num'] = 0;
				$ling_one['status'] = 1;
				$ling_one['type'] = 1;
				
				$materiel_id = Db::name('materiel')->insertGetId($ling_one);//添加物料表
				
	 
				$ling_one_new['type'] = 19;
				$ling_one_new['insert_sn'] = $this->get_insert_sn();
				$ling_one_new['cat_id'] = $cat_id;
				$ling_one_new['cat_child_id'] = $materiel_id;
				$ling_one_new['ck_id'] = $cate_info['ck_id'];
				$ling_one_new['materiel_desc'] = '一级果';
				$ling_one_new['cat_child_name'] = $cate_info['cat_name'].'一级果';
				$ling_one_new['num'] = $num_1;
				$ling_one_new['unit'] = 'KG';
				$ling_one_new['apply_worker'] = $add_worker_id;
				$ling_one_new['add_time'] = strtotime($get_time);
				$ling_one_new['tb_id'] = $hd_id;
	 
				
				$insert_re1= Db::name("ck_insert")->insertGetId($ling_one_new); 
				
				
			}
		}
		
		
		//查询物料是否存在
		$re_num2 =  Db::name("materiel")->where("cat_id = ".$cat_id." and type = 1 and m_desc = '二级果'")->find();	
		
		if($num_2 > 0){
			if($re_num2){
	 
				$category_info =   Db::name("materiel_category")->where('cat_id = '.$cat_id)->field('ck_id,cat_name')->find();
				$ling_info_two['type'] = 19;
				$ling_info_two['insert_sn'] = $this->get_insert_sn();
				$ling_info_two['cat_id'] = $cat_id;
				$ling_info_two['cat_child_id'] = $re_num2['m_id'];
				$ling_info_two['ck_id'] = $category_info['ck_id'];
				$ling_info_two['materiel_desc'] = '二级果';
				$ling_info_two['cat_child_name'] = $category_info['cat_name'].'二级果';
				$ling_info_two['num'] = $num_2;
				$ling_info_two['unit'] = 'KG';
				$ling_info_two['apply_worker'] = $add_worker_id;
				$ling_info_two['add_time'] = strtotime($get_time);
	 			$ling_info_two['tb_id'] = $hd_id;
				 
				$insert_re2 = Db::name("ck_insert")->insertGetId($ling_info_two); 
				//$re =  Db::name("materiel")->where("m_id = ".$re_num2['m_id'])->setDec('num',$num_2);	
			}else{
				$cate_info =   Db::name("materiel_category")->where(' cat_id = '.$cat_id)->field('ck_id,cat_no,cat_name')->find();
				
				$ling_two['m_no'] = $cate_info['cat_no'].'_1';
				$ling_two['cat_id'] = $cat_id;
				$ling_two['m_name'] = $cate_info['cat_name'].'二级果';
				$ling_two['m_desc'] = '二级果';
				$ling_two['num'] = $num_2;
				$ling_two['unit'] = 'KG';
				$ling_two['warning_num'] = 0;
				$ling_two['status'] = 1;
				$ling_two['type'] = 1;
				
				$materiel_id = Db::name('materiel')->insertGetId($ling_two);//添加物料表
	 
				$ling_two_new['type'] = 19;
				$ling_two_new['insert_sn'] =$this->get_insert_sn();
				$ling_two_new['cat_id'] = $cat_id;
				$ling_two_new['cat_child_id'] = $materiel_id;
				$ling_two_new['ck_id'] = $cate_info['ck_id'];
				$ling_two_new['materiel_desc'] = '二级果';
				$ling_two_new['cat_child_name'] = $cate_info['cat_name'].'二级果';
				$ling_two_new['num'] = $num_2;
				$ling_two_new['unit'] = 'KG';
				$ling_two_new['apply_worker'] = $add_worker_id;
				$ling_two_new['add_time'] = strtotime($get_time);
	 			$ling_two_new['tb_id'] = $hd_id;
				
				$insert_re2 = Db::name("ck_insert")->insertGetId($ling_two_new); 
			}
		}
		if($num_1 > 0 ){
			if($insert_re1){
				$data['io_id'] = $insert_re1;
				$insert_info = Db::name("ck_insert")->where('insert_id',$insert_re1)->field('apply_worker,admin_worker,remarks,cat_child_id,num,group_id,tb_id')->find();
				$data['batch_no'] = $this->get_batch_sn();
				$data['add_time'] = date('Y-m-d H:i:s',time());
				$data['apply_worker'] = $insert_info['apply_worker'];
				$data['ck_worker'] = $insert_info['admin_worker'];
				$data['remarks'] = $insert_info['remarks'];
				$data['status'] = 1;
				$data['materiel_id'] = $insert_info['cat_child_id'];
				$data['num'] = $insert_info['num'];
				$data['group_id'] = $insert_info['group_id'];
				$key = 'www.mframers.com';
				$dd = authcode($_SESSION['db_name'],'ENCODE',$key);
				$data['href'] = 'http://'. $_SERVER["HTTP_HOST"].'/code/code.php?h_id='.$hd_id.'&&batch_no='.$data['batch_no'].'&&dd='.$dd;
				$de = Db::name("ck_insert_detail")->insert($data);
				Db::name('pro_harvest_day')->where('h_id',$hd_id)->setField('href',$data['href']);
			}
		}
		if($num_2 > 0){
			if($insert_re2){
				$data['io_id'] = $insert_re2;
				$insert_info = Db::name("ck_insert")->where('insert_id',$insert_re2)->field('apply_worker,admin_worker,remarks,cat_child_id,num,group_id,tb_id')->find();
				$data['batch_no'] = $this->get_batch_sn();
				$data['add_time'] = date('Y-m-d H:i:s',time());
				$data['apply_worker'] = $insert_info['apply_worker'];
				$data['ck_worker'] = $insert_info['admin_worker'];
				$data['remarks'] = $insert_info['remarks'];
				$data['status'] = 1;
				$data['materiel_id'] = $insert_info['cat_child_id'];
				$data['num'] = $insert_info['num'];
				$data['group_id'] = $insert_info['group_id'];
				$key = 'www.mframers.com';
				$dd = authcode($_SESSION['db_name'],'ENCODE',$key);
				$data['href'] = 'http://'. $_SERVER["HTTP_HOST"].'/code/code.php?h_id='.$hd_id.'&&batch_no='.$data['batch_no'].'&&dd='.$dd;
				$de = Db::name("ck_insert_detail")->insert($data);
				Db::name('pro_harvest_day')->where('h_id',$hd_id)->setField('href_t',$data['href']);
			}
		}
		return true;
	}
	 
	
	//批次规则
	private function get_batch_sn(){
		$shijian = date('Ymd');//当天时间
		$start = date('Y-m-d 00:00:00',time());
		$end = date('Y-m-d 24:00:00',time());
		$con['add_time'] = array(['egt',$start],['elt',$end]);
		$number = Db::name('ck_insert_detail')->where($con)->count();
		$number++;
		//填充0；str_pad()填充字符串；STR_PAD_LEFT:填充到字符串的左侧
		$numbered = str_pad($number,3,"0",STR_PAD_LEFT);
		 
		$batch_no = $shijian.$numbered;
		return $batch_no;
	}  
	 

    /*
     *日产量的列表
     */
	public function harvestlist(){

	        $sql=Db::table('mf_pro_harvest_day')->paginate(10);
            if($sql){
                return json(['status'=>1,'txt'=>"成功",'data'=>$sql]);
            }else{
                return json(['status'=>0,'txt'=>"错误"]);
            }
    }

    /*
     *日产量的删除
     */
    public function harvestdel(){
        
        $h_id=request()->param('h_id');
        if($h_id){
            $sql=Db::table('mf_pro_harvest_day')->where('h_id',$h_id)->delete();
            if($sql){
                return json(['status'=>1,'txt'=>"删除成功"]);
            }else{
                return json(['status'=>0,'txt'=>"删除失败"]);
            }
        }else{
            return json(['status'=>0,'txt'=>"未知错误"]);
        }
    }

    /*
     *日产量的编辑
     */
    public function harvestedit(){
       
        $h_id=trim(request()->param('h_id'));
        if(!$h_id){return json(['status'=>0,'msg'=>"日产量Id为空"]);}
        $plan_id=trim(request()->param('plan_id'));
        if(!$plan_id){return json(['status'=>0,'msg'=>"生产计划Id为空"]);}
        $t_id=trim(request()->param('t_id'));
        if(!$t_id){return json(['status'=>0,'msg'=>"种植任务Id为空"]);}
        $area_id=trim(request()->param('area_id'));
        if(!$area_id){return json(['status'=>0,'msg'=>"种植区域Id为空"]);}
        $cat_id=trim(request()->param('cat_id'));
        if(!$cat_id){return json(['status'=>0,'msg'=>"作物品种Id为空"]);}
        $m_id=trim(request()->param('m_id'));
        if(!$m_id){return json(['status'=>0,'msg'=>"物料Id为空"]);}
        $num_1=trim(request()->param('num_1'));
        if(!$num_1){return json(['status'=>0,'msg'=>"请输入一级果的重量"]);}
        $num_2=trim(request()->param('num_2'));
        if(!$num_2){return json(['status'=>0,'msg'=>"请输入二级果的重量"]);}
        $one_weight=trim(request()->param('one_weight'));
        if(!$one_weight){return json(['status'=>0,'msg'=>"请输入平均单果重量"]);}

        $add_time=trim(request()->param('add_time'));
        if(!$add_time){return json(['status'=>0,'msg'=>"添加时间不能为空"]);}
         $get_time=trim(request()->param('get_time'));
        if(!$get_time){return json(['status'=>0,'msg'=>"采摘时间不能为空"]);}
         $num=trim(request()->param('num'));
        if(!$num){return json(['status'=>0,'msg'=>"日产量不能为空"]);}
        $add_worker_id=trim(request()->param('add_worker_id'));
        if(!$add_worker_id){return json(['status'=>0,'msg'=>"添加人的Id不能为空"]);}



        if(is_numeric($h_id)&&is_numeric($plan_id)&&is_numeric($t_id)&&is_numeric($area_id)&&is_numeric($cat_id)&&is_numeric($m_id)&&$num_1&&$num_2&&is_numeric($one_weight)){
            $data['plan_id']=$plan_id;
            $data['t_id']=$t_id;
            $data['area_id']=$area_id;
            $data['cat_id']=$cat_id;
            $data['m_id']=$m_id;
            $data['num_1']=round($num_1,2);
            $data['num_2']=round($num_2,2);
            $data['one_weight']=$one_weight;

            $data['add_time']=$add_time;
            $data['get_time']=$get_time;
 			$data['num']=$num;
 			$data['add_worker_id']=$add_worker_id;


            $num_3=$num_1+$num_2;
            $percentum_1=($num_1/$num_3)*100;
            $percentum_2=($num_2/$num_3)*100;
            $percentum_1=round($percentum_1,2);
            $percentum_2=round($percentum_2,2);

            $data['percentum_1']=$percentum_1;
            $data['percentum_2']=$percentum_2;

            $data = array_diff($data, [NULL, '']);
            $sql=Db::table('mf_pro_harvest_day')->where('h_id',$h_id)->update($data);
            if($sql){
                return json(['status'=>1,'txt'=>"更新数据成功"]);
            }else{
                return json(['status'=>0,'txt'=>"更新数据失败"]);
            }
        }else{
            return json(['status'=>0,'txt'=>"未知错误"]);
        }
    }

    /*
     *种植区域查询
     */
    public function harvest_grow_area(){
    	//$sql=Db::table('mf_grow_area')->field('area_id,area_name')->where('status',1)->select();

		$sql=Db::view('mf_grow_area','area_id,area_name')
		->view('mf_grow_type','type_name','mf_grow_type.id=mf_grow_area.g_type_id')
		->select();
    	if($sql){
    		return json(['status'=>1,'msg'=>"成功",'data'=>$sql]);
    	}else{
    		return json(['status'=>0,'msg'=>"失败"]);
    	}

    }

	/*	
     *种植任务下拉查询
     */
	public function harvest_grow_task(){
		
		$do=request()->param('do');
		$area_id=request()->param('area_id');
		if(!$area_id){return json(['status'=>0,'msg'=>"种植区域id为空"]);}
		$sqll=Db::view('mf_pro_grow_task_area','plan_id,t_id')
		->view('mf_pro_grow_task','t_no,t_name AS mingcheng','mf_pro_grow_task.t_id=mf_pro_grow_task_area.t_id')
		->view('mf_product_plan','type,cat_id','mf_product_plan.plan_id=mf_pro_grow_task_area.plan_id')
		->where('type',1)
		->where('area_id',$area_id)
		->select();

		/*foreach($sqll as $k=>$v){

			$v['mingcheng']=$v['t_no']."-种植任务".($k+1);

			$sqll[$k]['mingcheng']=$v['mingcheng'];
		}*/

		
		$sqlla=Db::view('mf_pro_grow_task_area','plan_id,t_id')
		->view('mf_pro_grow_task','t_no,t_name AS mingcheng','mf_pro_grow_task.t_id=mf_pro_grow_task_area.t_id')
		->view('mf_product_plan','type,cat_id','mf_product_plan.plan_id=mf_pro_grow_task_area.plan_id')

		->view('mf_pro_plan_son_worker','worker_id','mf_pro_plan_son_worker.plan_id=mf_product_plan.plan_id')
		->view('mf_worker','worker_name','mf_worker.worker_id=mf_pro_plan_son_worker.worker_id')
		->view('mf_fruits_color','ft_name','mf_fruits_color.cat_id=mf_product_plan.cat_id')
		->view('mf_fruits_type','ft_name AS guoxing,cat_id','mf_fruits_type.cat_id=mf_product_plan.cat_id')

		
		->view('mf_materiel_category a','cat_name pingzhong','a.cat_id=mf_product_plan.cat_id')

		->view('mf_materiel_category b','cat_name zuowu','b.cat_id=a.pid')

		->view('mf_materiel','m_id','mf_materiel.cat_id=a.cat_id')

		->where('type',1)
		->where('area_id',$area_id)
		->select();
		/*foreach($sqlla as $k=>$v){

			$v['mingcheng']=$v['t_no']."-种植任务".($k+1);

			$sqlla[$k]['mingcheng']=$v['mingcheng'];
		}*/

		if($do=="list"){
			return json(['status'=>1,'msg'=>"成功",'data'=>$sqlla]);
		}else{
			return json(['status'=>1,'msg'=>"成功",'data'=>$sqll]);
		}

	}
}

?>