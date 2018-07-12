<?php
namespace app\baseset\controller;
use app\base\controller\Base;
use think\Db;
class Skill extends Base{

	/**
	 * [index 工序列表]
	 * @return [type] [description]
	 */
    public function skill_list(){ 
		$group_id = $this->request->param('group_id');
		
		if(!$group_id){
			$result['status'] = 0;
			$result['msg'] = "请选择一个部门";
			//echo json_encode($result);
			return json($result);
			
		}
		if($group_id==1){
			$group_id = 2;
		}
		$con['group_id']  = array('eq',$group_id);
		$con['status'] = 1;
		$info = Db::name('work_skill')->where($con)->order('skill_id','desc')->select();//echo $info;die;
		if($info){
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $info;			
		}else{
			$result['status'] = 1;
			$result['msg'] = "查询无数据";
			$result['data'] = array();
		}
		/* echo json_encode($result);
		die;  */     
			return json($result);
    }
	
	/**
	 * [index 每个工序所对应的单位的接口]
	 * @return [type] [description]
	 */
	public function s_unit(){
		//获取变量
		$skill_id = $this->request->param('skill_id');
		//$group_id = $this->request->param('group_id');
		//验证变量
		if(!$skill_id){
			$result['status'] = 0;
			$result['msg'] = "工序id为空";
			ajaxReturnJson($result);
		}
		//程序主体
		$con['skill_id'] = $skill_id;
		$unit_str = Db::name('work_skill')->where($con)->value('unit_str');
		if($unit_str){
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['unit_str'] = $unit_str;
			ajaxReturnJson($result);
		}else{
			$result['status'] = 0;
			$result['msg'] = "无效的工序单位";
			$result['unit_str'] = '';
			ajaxReturnJson($result);
		}
	}
	
	//工序添加接口
	public function add(){
		//获取变量
		
		$skill_name = $this->request->param('skill_name');
		$group_id = $this->request->param('group_id');
		$unit_str = $this->request->param('unit_str');//单位拼接的字符串
		//$status = $this->request->param(1);//0:删除，1：启用
		$status =1;
		//验证变量
		if(!$skill_name){
			$result['status'] = 0;
			$result['msg'] = "请选择工序名称";
			/* echo json_encode($result);
			die; */
			return json($result);
		}
		if(!$group_id){
			$result['status'] = 0;
			$result['msg'] = "请选择一个部门";
			/* echo json_encode($result);die; */
			return json($result);
		}
		if(!$unit_str){
			$result['status'] = 0;
			$result['msg'] = "请输入单位";
			/* echo json_encode($result);die; */
			return json($result);
		}
		
		if(is_array($unit_str)){
			$unit_str1 = implode(',',$unit_str);
			$unit_str = str_replace("，",",",$unit_str1);
		}else{
			$unit_str1 = $this->request->param('unit_str');
			$unit_str = str_replace("，",",",$unit_str1);
		}
		//程序主体
		//条件:
		
		$con['skill_name'] = array('eq',$skill_name);
		$con['group_id'] = array('eq',$group_id);
		//$con['unit_str'] = array('eq',$unit_str);
		$data = ['skill_name'=>$skill_name,'group_id'=>$group_id,'unit_str'=>$unit_str,'status'=>1];
		$info = Db::name('work_skill')->where($con)->select();
		
		if(!$info){
			//$newadd = Db('work_skill')->insert($data);

				$newadd = Db('work_skill')->insertGetId($data);
			    $cond['skill_id']=$newadd;
			   
				$sqla=Db::table('mf_work_skill')->where($cond)->find();//查询添加的单位
				
				$arr=explode(",",$sqla['unit_str']);
				//$sqlb=Db::table('mf_skill_price')->where($cond)->field('unit_str')->select();//查询价格表中单位
				$newcond['skill_id']=$newadd;
				$newcond['unit_str']=array('in',$arr);

				$sqlb=Db::table('mf_skill_price')->where($newcond)->select();//skill_id和单位查询 加个表是否存在
				
				$num=count($arr);

				if(!$sqlb){
					for($i=0;$i<$num;$i++){
						$ncond['skill_id']=$newadd;
						$ncond['unit_str']=$arr[$i];
						$ncond['status']=1;
						
						$sqlc=Db::table('mf_skill_price')->insert($ncond);
					}	
				}

			//echo getLastsql();die();
			if($newadd){
				$result['status'] = 1;
				$result['msg'] = "添加成功";
				//$result['data'] = Db::name('work_skill')->where('skill_id',$newadd)->select();
				/* echo json_encode($result);die; */
				return json($result);
			}else{
				$result['status'] = 0;
				$result['msg'] = "添加失败";
				/* echo json_encode($result);die; */
				return json($result);
			}
		}else{
			$result['status'] = -1;
			$result['msg'] = "数据已经存在";
			/* echo json_encode($result);die; */
			return json($result);
		}
		//$this->fetch();
		
	}
	
	//工序删除
	public function del(){
		//获取变量
		$skill_id = $this->request->param('skill_id');
		//验证变量
		if(!$skill_id){
			$result['status'] = 0;
			$result['msg'] = "工序的id为空";
			/* echo json_encode($result);die; */
			return json($result);
		}
		//程序主体
		$con['skill_id'] = array('eq',$skill_id);
		$find = Db::name('work_skill')->where($con)->find();
		if($find){
			$re = Db::name('work_skill')->where($con)->update(['status'=>0]);
			if($re){
				$result['status'] = 1;
				$result['msg'] = "删除成功";
				/* echo json_encode($result);die; */
				return json($result);
			}else{
				$result['status'] = 0;
				$result['msg'] = "删除失败";
				/* echo json_encode($result);die; */
				return json($result);
			}
		}
	}
	
	/**
	 * [index 获取某道工序(编辑的显示页面)]
	 * @return [type] [description]
	 */
	public function edit_ndo(){
		//获取变量
		$skill_id = $this->request->param('skill_id'); 
		//验证变量
		if(!$skill_id){
			$result['status'] = 0;
			$result['msg'] = "工序的id为空";
			ajaxReturnJson($result);
		}
		//程序主体
		$con['skill_id'] = $skill_id;
		$info = Db::name('work_skill')->where($con)->select();
		if($info){
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $info;
			ajaxReturnJson($result);
		}else{
			$result['status'] = 0;
			$result['msg'] = "获取失败";
			
			ajaxReturnJson($result);
		}
	}
	/**
	 * [index 获取某道工序(执行编辑)]
	 * @return [type] [description]
	 */
	public function doedit(){
		//获取变量
		$skill_id = $this->request->param('skill_id');
		$skill_name = $this->request->param('skill_name');
		$unit_str = $this->request->param('unit_str');
		//验证变量
		if(!$skill_id){
			$result['status'] = 0;
			$result['msg'] = "工序id为空";
			ajaxReturnJson($result);
		}
		if(!$skill_name){
			$result['status'] = 0;
			$result['msg'] = "请输入工序名称";
			ajaxReturnJson($result);
		}
		if(!$unit_str){
			$result['status'] = 0;
			$result['msg'] = "请输入工序单位";
			ajaxReturnJson($result);
		}
		if(is_array($unit_str)){
			$unit_str1 = implode(',',$unit_str);
			$unit_str = str_replace("，",",",$unit_str1);
		}else{
			$unit_str1 = $this->request->param('unit_str');
			$unit_str = str_replace("，",",",$unit_str1);
		}
		//程序主体
		$con1['skill_id'] = array('eq',$skill_id);
		$con['skill_id'] = array('neq',$skill_id);
		$con['skill_name'] = $skill_name;
		$find = Db::name('work_skill')->where($con)->find();//编辑条
		if($find){
			$result['status'] = 0;
			$result['msg'] = "工序名称已经存在";
			ajaxReturnJson($result);
		}else{
			$data['skill_name'] = $skill_name;
			$data['unit_str'] = $unit_str;
			$re = Db::name('work_skill')->where($con1)->update($data);
			if($re!== false){
				$result['status']  = 1;
				$result['msg'] = "修改成功";
				/* echo json_encode($result);die; */
				return json($result);
			}else{
				$result['status']  = 0;
				$result['msg'] = "修改失败";
				/* echo json_encode($result);die; */
				return json($result);
			}
		}
		
	}
	
	//工序名称的执行编辑
	public function edit(){
		//获取变量
		$skill_id = $this->request->param('skill_id');
		$skill_name = $this->request->param('skill_name');
		//$group_id = $this->request->param('group_id');
		//$unit_str = $this->request->param('unit_str');//单位拼接的字符串
		
		//验证变量
		
		if(!$skill_id){
			$result['status'] = 0;
			$result['msg']  = "工序编号为空";
			/* echo json_encode($result);die; */
			return json($result);
		}
		if(!$skill_name){
			$result['status']  = 0;
			$result['msg']  = "请选择工序名称";
			/* echo json_encode($result);die; */
			return json($result);
		}
		
		/* if(is_array($unit_str)){
			$unit_str = implode(',',$unit_str);
		}else{
			$unit_str = $this->request->param('unit_str');
		} */
		//查出要编辑的这条数据
		$con['skill_id'] = array('eq',$skill_id);
		
		$find = Db::name('work_skill')->where($con)->find();
		//如果数据没有动的话数据未修改，否则数据修改
		
			//以工序名称为条件进行查询排斥要编辑的id
			$con1['skill_id'] = array('neq',$skill_id);
			$con1['skill_name'] = array('eq',$skill_name);
			$info = Db::name('work_skill')->where($con1)->select();
			if($info){
				$result['status'] = 0;
				$result['msg'] = "工序名称已经存在";
				/* echo json_encode($result);die; */
				return json($result);
			}else{
				$data['skill_id'] = $skill_id;
				$data['skill_name']  = $skill_name;
				//$data['group_id'] = $group_id;
				//$data['unit_str']  = $unit_str;
				//$data['status'] = 1;
				$re = Db::name('work_skill')->where($con)->update($data);
				if($re!== false){
					$result['status']  = 1;
					$result['msg'] = "修改成功";
					/* echo json_encode($result);die; */
					return json($result);
				}else{
					$result['status']  = 0;
					$result['msg'] = "修改失败";
					/* echo json_encode($result);die; */
					return json($result);
				}
			}
			
			
			
		
		
		
	}
	
	
	
	//工序单位编辑
	public function unit_edit(){
		//获取变量
		$skill_id = $this->request->param('skill_id');
		$unit_str = $this->request->param('unit_str');//单位拼接的字符串
		//验证变量
		
		if(!$skill_id){
			$result['status'] = 0;
			$result['msg']  = "工序编号为空";
			/* echo json_encode($result);die; */
			return json($result);
		}
		if(!$unit_str){
			$result['status'] = 0;
			$result['msg'] = "请输入单位";
			/* echo json_encode($result);die; */
			return json($result);
		}
		
		
		if(is_array($unit_str)){
			$unit_str1 = implode(',',$unit_str);
			$unit_str = str_replace("，",",",$unit_str1);
		}else{
			$unit_str1 = $this->request->param('unit_str');
			$unit_str = str_replace("，",",",$unit_str1);
		}
		//程序主体
		//查出要编辑的这条数据
		$con['skill_id'] = array('eq',$skill_id);
		$find = Db::name('work_skill')->where($con)->find();
		//如果数据没有动的话数据未修改，否则数据修改
		if($find['skill_id']==$skill_id&&$find['unit_str']==$unit_str&&$find['status']==1){
			$result['status'] = 1;
			$result['msg'] = "数据未修改";
			/* echo json_encode($result);die; */
			return json($result);
		}else{
			$data['skill_id'] = $skill_id;
			$data['unit_str']  = $unit_str;
			$re = Db::name('work_skill')->where($con)->update($data);
			if($re!== false){
				$result['status']  = 1;
				$result['msg'] = "修改成功";
				/* echo json_encode($result);die; */
				return json($result);
			}else{
				$result['status']  = 0;
				$result['msg'] = "修改失败";
				/* echo json_encode($result);die; */
				return json($result);
			}
		}
		
	}


	//工序添加接口 Pc端修改使用 true
 	public function pc_add(){
		//获取变量
		
		$skill_name = $this->request->param('skill_name');
		$group_id = $this->request->param('group_id');
		$unit_str = $this->request->param('unit_str');//单位拼接的字符串
		//$status = $this->request->param(1);//0:删除，1：启用
		$status =1;
		//验证变量
		if(!$skill_name){
			$result['status'] = 0;
			$result['msg'] = "请选择工序名称";
			/* echo json_encode($result);
			die; */
			return json($result);
		}
		if(!$group_id){
			$result['status'] = 0;
			$result['msg'] = "请选择一个部门";
			/* echo json_encode($result);die; */
			return json($result);
		}
		if(!$unit_str){
			$result['status'] = 0;
			$result['msg'] = "请输入单位";
			/* echo json_encode($result);die; */
			return json($result);
		}
		
		if(is_array($unit_str)){
			$unit_str1 = implode(',',$unit_str);
			$unit_str = str_replace("，",",",$unit_str1);
		}else{
			$unit_str1 = $this->request->param('unit_str');
			$unit_str = str_replace("，",",",$unit_str1);
		}
		//程序主体
		//条件:
		
		$con['skill_name'] = array('eq',$skill_name);
		$con['group_id'] = array('eq',$group_id);
		//$con['unit_str'] = array('eq',$unit_str);
		$data = ['skill_name'=>$skill_name,'group_id'=>$group_id,'unit_str'=>$unit_str,'status'=>1];
		$info = Db::name('work_skill')->where($con)->select();
		
		if(!$info){
			//$newadd = Db('work_skill')->insert($data);

				$newadd = Db('work_skill')->insertGetId($data);
			    $cond['skill_id']=$newadd;
			   
				$sqla=Db::table('mf_work_skill')->where($cond)->find();//查询添加的单位
				
				$arr=explode(",",$sqla['unit_str']);
				//$sqlb=Db::table('mf_skill_price')->where($cond)->field('unit_str')->select();//查询价格表中单位
				$newcond['skill_id']=$newadd;
				$newcond['unit_str']=array('in',$arr);

				$sqlb=Db::table('mf_skill_price')->where($newcond)->select();//skill_id和单位查询 加个表是否存在
				
				$num=count($arr);

				if(!$sqlb){
					for($i=0;$i<$num;$i++){
						$ncond['skill_id']=$newadd;
						$ncond['unit_str']=$arr[$i];
						$ncond['status']=1;
						
						$sqlc=Db::table('mf_skill_price')->insert($ncond);
					}	
				}

			//echo getLastsql();die();
			if($newadd){
				$result['status'] = 1;
				$result['msg'] = "添加成功";
				//$result['data'] = Db::name('work_skill')->where('skill_id',$newadd)->select();
				/* echo json_encode($result);die; */
				return json($result);
			}else{
				$result['status'] = 0;
				$result['msg'] = "添加失败";
				/* echo json_encode($result);die; */
				return json($result);
			}
		}else{
			$result['status'] = 2;
			$result['msg'] = "数据已经存在";
			/* echo json_encode($result);die; */
			return json($result);
		}
		//$this->fetch();
		
	}



 
	//工序名称的执行编辑  pc 端使用 true
	public function pc_edit(){
		//获取变量
		$skill_id = $this->request->param('skill_id');
		$skill_name = $this->request->param('skill_name');
		//$group_id = $this->request->param('group_id');
		//$unit_str = $this->request->param('unit_str');//单位拼接的字符串
		
		//验证变量
		
		if(!$skill_id){
			$result['status'] = 0;
			$result['msg']  = "工序编号为空";
			/* echo json_encode($result);die; */
			return json($result);
		}
		if(!$skill_name){
			$result['status']  = 0;
			$result['msg']  = "请选择工序名称";
			/* echo json_encode($result);die; */
			return json($result);
		}
		
		/* if(is_array($unit_str)){
			$unit_str = implode(',',$unit_str);
		}else{
			$unit_str = $this->request->param('unit_str');
		} */
		//查出要编辑的这条数据
		$con['skill_id'] = array('eq',$skill_id);
		
		$find = Db::name('work_skill')->where($con)->find();
		//如果数据没有动的话数据未修改，否则数据修改
		
			//以工序名称为条件进行查询排斥要编辑的id
			// $con1['skill_id'] = array('neq',$skill_id);
			// $con1['skill_name'] = array('eq',$skill_name);
			// $info = Db::name('work_skill')->where($con1)->select();

			//2018-06-01 修改
			$con1['skill_id'] = array('eq',$skill_id);
			$info = Db::name('work_skill')->where('skill_name','eq',$skill_name)->find();
			
			if($info){
				$result['status'] = 0;
				$result['msg'] = "工序名称已经存在";
				/* echo json_encode($result);die; */
				return json($result);
			}else{
				$data['skill_id'] = $skill_id;
				$data['skill_name']  = $skill_name;
				//$data['group_id'] = $group_id;
				//$data['unit_str']  = $unit_str;
				//$data['status'] = 1;
				$re = Db::name('work_skill')->where($con)->update($data);
				if($re!== false){
					$result['status']  = 1;
					$result['msg'] = "修改成功";
					/* echo json_encode($result);die; */
					return json($result);
				}else{
					$result['status']  = 0;
					$result['msg'] = "修改失败";
					/* echo json_encode($result);die; */
					return json($result);
				}
			}

	}

	//工序单位编辑 pc 端使用 true
	public function pc_unit_edit(){
		//获取变量
		$skill_id = $this->request->param('skill_id');
		$unit_str = $this->request->param('unit_str');//单位拼接的字符串
		//验证变量
		
		if(!$skill_id){
			$result['status'] = 0;
			$result['msg']  = "工序编号为空";
			/* echo json_encode($result);die; */
			return json($result);
		}
		if(!$unit_str){
			$result['status'] = 0;
			$result['msg'] = "请输入单位";
			/* echo json_encode($result);die; */
			return json($result);
		}
		
		
		if(is_array($unit_str)){
			$unit_str1 = implode(',',$unit_str);
			$unit_str = str_replace("，",",",$unit_str1);
		}else{
			$unit_str1 = $this->request->param('unit_str');
			$unit_str = str_replace("，",",",$unit_str1);
		}
		//程序主体
		//查出要编辑的这条数据
		$con['skill_id'] = array('eq',$skill_id);
		$find = Db::name('work_skill')->where($con)->find();
		
		//如果数据没有动的话数据未修改，否则数据修改
		if($find['skill_id']==$skill_id&&$find['unit_str']==$unit_str&&$find['status']==1){
			$result['status'] = 0;
			$result['msg'] = "数据未修改";
			/* echo json_encode($result);die; */
			return json($result);
		}else{
			$data['skill_id'] = $skill_id;
			$data['unit_str']  = $unit_str;
			$re = Db::name('work_skill')->where($con)->update($data);
			if($re!== false){
				$result['status']  = 1;
				$result['msg'] = "修改成功";
				/* echo json_encode($result);die; */
				return json($result);
			}else{
				$result['status']  = 0;
				$result['msg'] = "修改失败";
				/* echo json_encode($result);die; */
				return json($result);
			}
		}
		
	}


	
}
