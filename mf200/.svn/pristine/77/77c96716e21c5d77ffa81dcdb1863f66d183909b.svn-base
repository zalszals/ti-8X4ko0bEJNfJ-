<?php
namespace app\baseset\controller;
use app\base\controller\Base;
use think\Db;
class Crop extends Base{

	/**
	 * 获取作物预设信息 自动补全使用
	 *  蔺晓宇 2017/11/27
	 */
    public function crop_all(){    
		
 
		$info = Db::name('crop_category')->field(['crop_id','crop_name'])->select();// 查询所有作物分类
		
		//echo Db::name('materiel_category')->getlastsql();die;
		
		if(!empty($info)){
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $info;
		}else{
			$result['status'] = 0;
			$result['msg'] = "查询无数据";
			$result['data'] = array();
		}
		
		echo json_encode($result);
		die;      
		
    }
	
	/*添加作物分类*/
	public function add_crop_parent(){
		$cat_name = $this->request->param('cat_name');
		
		$where['cat_name'] = $cat_name;
		$where['type'] = 3;
		$info = Db::name('materiel_category')->field(['cat_id','cat_name'])->where($where)->find();// 查询所有作物分类
		if($info){
			$result['status'] = 0;
			$result['msg'] = "作物分类已存在！";
			$result['data'] = array();
		}else{
			$data['cat_name'] = $cat_name;
			$data['pid'] = 0;
			$data['status'] = 1;
			$data['type'] = 3;
			
			$re = Db::name('materiel_category')->insertGetId($data);
			if($re){
				$result['status'] = 1;
				$result['msg'] = "添加成功";
				$result['data'] = array();
			}else{
				$result['status'] = 0;
				$result['msg'] = "添加失败";
				$result['data'] = array();
			}
			
			
		}
		
	 
		echo json_encode($result);
		die;      
		
	}
	/*编辑作物分类*/
	
	public function edit_crop_parent(){
		$cat_name = $this->request->param('cat_name');
		$cat_id = $this->request->param('cat_id');
		
		$where['cat_name'] = $cat_name;
		$info = Db::name('materiel_category')->field(['cat_id','cat_name'])->where($where)->find();// 查询所有作物分类
		if($info){
			$result['status'] = 0;
			$result['msg'] = "作物分类已存在！";
			$result['data'] = array();
		}else{
			$data['cat_name'] = $cat_name;
			$re = Db::name('materiel_category')->where('cat_id',$cat_id)->setField('cat_name',$cat_name);
		 
			if($re){
				$result['status'] = 1;
				$result['msg'] = "修改成功";
				$result['data'] = array();
			}else{
				$result['status'] = 0;
				$result['msg'] = "修改失败";
				$result['data'] = array();
			}
			
			
		}
		
	 
		echo json_encode($result);
		die;      
		
	}
	
	/*删除作物分类*/
	
	public function del_crop_parent(){
 
		$cat_id = $this->request->param('cat_id');
		
		if(!$cat_id){
			$result['status'] = 0;
			$result['msg'] = "缺少参数";
			$result['data'] = array();
		}
	 
		$re = Db::name('materiel_category')->where('cat_id',$cat_id)->setField('status',0);
		if($re){
			$result['status'] = 1;
			$result['msg'] = "删除成功";
			$result['data'] = array();
		}else{
			$result['status'] = 1;
			$result['msg'] = "删除成功";
			$result['data'] = array();
		}
		
     	echo json_encode($result);
		die;      
		
	}
	
	//获取作物分类
    public function crop_list(){    
	
		$where['status'] = 1;
		$where['type'] = 3;
		$where['pid'] = 0;
		
		$info = Db::name('materiel_category')->field(['cat_id','cat_name'])->where($where)->select();// 查询所有物料分类
		
		if(!$info){
			$result['status'] = 0;
			$result['msg'] = "查询无数据";
			$result['data'] = array();
			echo json_encode($result);
			die;   
		}
		foreach($info as $k=>$v){
			$where_m['type'] = 1;
			$where_m['status'] = 1 ;
			$where_m['pid'] = $v['cat_id'] ;
			$info_m = Db::name('materiel_category')->field('cat_id,cat_name,cat_desc,cat_no,ftype,fcolor')->where($where_m)->select();// 查询所有物料分类
			
			
			
			
			if($info_m){
				$info[$k]['child'] = $info_m;
				 
			}else{
				$info[$k]['child']= array();
			}
			
			foreach($info_m as $km=>$vm){
				//获取当前catid 所有果型颜色
				//$info_cat_type_where['cat_id'] = $vm['cat_id'];
				//$info_cat_type = Db::name('fruits_type')->field(['ft_id','ft_name'])->where($info_cat_type_where)->find();
				//$info_cat_color = Db::name('fruits_color')->field(['ft_id','ft_name'])->where($info_cat_type_where)->find();				
				$info[$k]['child'][$km]['cat_type'] = $vm['ftype'];//$info_cat_type['ft_name'];
				$info[$k]['child'][$km]['cat_color'] = $vm['fcolor'];//$info_cat_color['ft_name'];
				
			}
			/*
			//根据catid 获取所有所属catid 获取果型国色
		
			$type_where['pid'] = $v['cat_id'];
			$type_where['type'] = 2;
			$type_where['status'] = 1;
			$type_info = Db::name('materiel_category')->field(['cat_id'])->where($type_where)->select();
			
			
			//echo Db::name('materiel_category')->getlastsql();die;
			$type_str = '';
			foreach($type_info as $ke=>$va){
				$type_str.=','.$va['cat_id'];
			}
			
			$info_cat_type_where['cat_id'] = array('in',$type_str);
			$info_cat_type = Db::name('fruits_type')->field(['ft_id','ft_name'])->where($info_cat_type_where)->group('ft_name')->select();
			$info_cat_color = Db::name('fruits_color')->field(['ft_id','ft_name'])->where($info_cat_type_where)->group('ft_name')->select();
			
			
		 
			if($info_cat_type){
				$info[$k]['info_cat_type'] = $info_cat_type;
			}else{
				$info[$k]['info_cat_type']= array();
			}
		 
			if($info_cat_color){
				$info[$k]['info_cat_color'] = $info_cat_color;
			}else{
				$info[$k]['info_cat_color']= array();
			}*/
	 
			
		}

	 
		//echo Db::name('materiel_category')->getlastsql();die;
		
		if(!empty($info)){
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $info;
		}else{
			$result['status'] = 0;
			$result['msg'] = "查询无数据";
			$result['data'] = array();
		}
	 
	 
		//var_dump($result);die;		
		echo json_encode($result);
		die;      
		
    }
	//获取作物子级分类
    public function crop_child_list(){    
		$cat_id = $this->request->param('cat_id');
		$where['status'] = 1;
		$where['type'] = 1;
		$where['pid'] = $cat_id;
		
		if(!$cat_id){
			$result['status'] = 0;
			$result['msg'] = "参数未传值";
			$result['data'] = array();
			echo json_encode($result);
			die;    
		}
		$info = Db::name('materiel_category')->field(['cat_id','cat_name'])->where($where)->select();// 查询所有物料分类
		
		//echo Db::name('materiel_category')->getlastsql();die;
		
		if(!empty($info)){
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $info;
		}else{
			$result['status'] = 0;
			$result['msg'] = "查询无数据";
			$result['data'] = array();
		}
		
 
		echo json_encode($result);
		die;      
		
    }
	//某一作物所有的果型列表
	public function type_list(){
 		 
		$where['ft_name'] = array('exp','is not null');
		$p_cat_id = $this->request->param('cat_id');
		if($p_cat_id){
			$where = [];
			$where['p_cat_id'] = $p_cat_id;
		}

		$info = Db::name('fruits_type')->field(['ft_name','ft_id'])->where($where)->group('ft_name')->select();// 查询所有果型
		
		if(!empty($info)){
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $info;
		}else{
			$result['status'] = 0;
			$result['msg'] = "查询无数据";
			$result['data'] = array();
		}
		
		echo json_encode($result);
			die;    
		
	}
	//某一作物所有的果色列表
	public function color_list(){
 
		$where['ft_name'] = array('exp','is not null');
		
		$p_cat_id = $this->request->param('cat_id');
		if($p_cat_id){
			$where = [];
			$where['p_cat_id'] = $p_cat_id;
		}

		$info = Db::name('fruits_color')->field(['ft_name','ft_id'])->where($where)->group('ft_name')->select();// 查询所有果型
		
		if(!empty($info)){
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $info;
		}else{
			$result['status'] = 0;
			$result['msg'] = "查询无数据";
			$result['data'] = array();
		}
		echo json_encode($result);
			die;    
	}
	
	//添加作物
	public function add(){
		//print_r($_POST);exit; 
		$cat_name = $this->request->param('cat_name');
		$cat_no = $this->request->param('cat_no');
		$cat_chid_name = $this->request->param('cat_chid_name');
		
		$ft_type = $this->request->param('ft_type');
		$ft_color = $this->request->param('ft_color');
		$cat_desc = $this->request->param('cat_desc');
		


		if(!$cat_no){
			$result['status'] = 0;
			$result['msg'] = "请输入品种编号";
			 
			echo json_encode($result);
			die;     
		}
		
		if(!preg_match('/^[A-Za-z]{1}[\s\S]*$/',$cat_no)){
			$result['status'] = 0;
			$result['msg'] = "品种编号必须以字母开头";
			 
			echo json_encode($result);
			die;     
		}
		//判断作物是否已经存在
		 
		$check_cat_name = Db::name('materiel_category')->field(['cat_id','cat_name','status'])->where('cat_name',$cat_name)->find();//判断作物是否存在

		// 作物已存在的情况
		if($check_cat_name){

			if($check_cat_name['status'] == 0){
				$up = Db::name('materiel_category')->where('cat_id', $check_cat_name['cat_id'])->setField('status',1);
			}

			//判断品种是否已经存在 并根据状态判断是否恢复
			
			$check_child_where['cat_name'] = $cat_chid_name;
			$check_child_where['cat_no'] = $cat_no;
			$check_child_where['type'] = 1;
			//$check_child_where['pid'] = $check_cat_name['cat_id'];
			$check_child_info = Db::name('materiel_category')->field(['cat_id','cat_name','status','cat_no','type'])->where($check_child_where)->find();
			
			
		 
			if($check_child_info){	//获取子级品种信息
		 		
				
				if($check_child_info['status']==0){		//品种存在 且状态隐藏 强制恢复
					$where1['cat_name'] = $cat_chid_name;
					$where1['cat_no'] = $cat_no;
					$new_cat_id = Db::name('materiel_category')->field('cat_id')->where($where1)->select();
					$newdata['status'] = 1;
					$newdata['ftype'] = $ft_type;
					$newdata['fcolor'] = $ft_color;
					$newdata['cat_desc'] = $cat_desc;
					foreach($new_cat_id as $k=>$v){
						$child_cat_update =  Db::name('materiel_category')->where('cat_id', $v['cat_id'])->update($newdata);
					}
					if($child_cat_update){

						$result['status'] = 1;
						$result['msg'] = "数据恢复成功";
						 
						echo json_encode($result);
						die;     
					}else{
						$result['status'] = 0;
						$result['msg'] = "数据恢复失败";
						 
						echo json_encode($result);
						die;     
					}
				}else{	
	 
					//品种不存在 判断是否存在重复数据（type、编号、作物 三者同时存在即为重复）
					
					$result['status'] = 0;
					$result['msg'] = "品种名、编号存在重复数据";
					 
					echo json_encode($result);
					die;     
			
				}
			}else{
			 	// 新品种添加
			 	
				$newadd_fir =Db::name('materiel_category')->insertGetId(['cat_name'=>$cat_chid_name,'cat_no'=>$cat_no,'cat_desc'=>$cat_desc,'ftype'=>$ft_type,'fcolor'=>$ft_color,'pid'=>$check_cat_name['cat_id'],'type'=>1]);
				// 判断果型果色,没有则添加
				$p_cat_id = $check_cat_name['cat_id'];
		 		$cond['p_cat_id'] = $p_cat_id;
		 		$cond['ft_name'] = $ft_type;
		 		$add_fir_type  = db('fruits_type')->where($cond)->value('ft_id');
		 		$add_fir_color = db('fruits_color')->where($cond)->value('ft_id');
		 		
		 		if(!$add_fir_type){
		 			$add_fir_type = db('fruits_type')->insertGetId(
		 				[
		 					'ft_name'=>$ft_type,
		 					'p_cat_id'=>$p_cat_id,
		 					'cat_id'=>$newadd_fir
		 				]);
		 		}

		 		if(!$add_fir_color){
		 			$add_fir_color = db('fruits_color')->insertGetId(
		 				[
		 					'ft_name'=>$ft_color,
		 					'p_cat_id'=>$p_cat_id,
		 					'cat_id'=>$newadd_fir
		 				]);
		 		}


				//插入果型果色信息
				/*
				$add_fir_type = Db::name('fruits_type')->insertGetId(['cat_id'=>$newadd_fir,'ft_name'=>$ft_type]);
				$add_fir_color = Db::name('fruits_color')->insertGetId(['cat_id'=>$newadd_fir,'ft_name'=>$ft_color]);
				*/
				$newadd_sec = Db::name('materiel_category')->insert(['cat_name'=>$cat_chid_name,'cat_no'=>$cat_no,'cat_desc'=>$cat_desc,'ftype'=>$ft_type,'fcolor'=>$ft_color,'pid'=> $check_cat_name['cat_id'],'type'=>2]);
				if($newadd_fir && $newadd_sec  && $add_fir_type && $add_fir_color){
					$result['status'] = 1;
					$result['msg'] = "数据添加成功";
					echo json_encode($result);
					die;     
				}else{
					$result['status'] = 0;
					$result['msg'] = "数据添加失败";
					 
					echo json_encode($result);
					die;
				}
				
			}
 
		}else{// 作物名不存在
			$check_child_where['cat_name'] = $cat_chid_name;
			$check_child_where['cat_no'] = $cat_no;
			//$check_child_where['pid'] = $check_cat_name['cat_id'];
			//$check_child_where['type'] = 1;
			$check_child_info = Db::name('materiel_category')->field(['cat_id','cat_name','cat_no'])->where($check_child_where)->find();
			if($check_child_info){	//获取子级品种信息
			
				if($check_child_info['cat_no'] == $cat_no  && $check_child_info['cat_name'] == $cat_chid_name){
					$result['status'] = 0;
					$result['msg'] = "存在重复数据";
					 
					echo json_encode($result);
					die;     
				}else{	//未发现重复数据  添加子分类两条数据
					$newadd_cat = Db::name('materiel_category')->insertGetId(['cat_name'=>$cat_name,'cat_no'=>$cat_no,'cat_desc'=>$cat_desc,'ftype'=>$ft_type,'fcolor'=>$ft_color,'pid'=>0,'type'=>3]);
					 
					$newadd_fir = Db::name('materiel_category')->insertGetId(['cat_name'=>$cat_chid_name,'cat_no'=>$cat_no,'cat_desc'=>$cat_desc,'ftype'=>$ft_type,'fcolor'=>$ft_color,'pid'=>$newadd_cat,'type'=>1]);
					//插入果型国色信息
					$add_fir_type = Db::name('fruits_type')->insertGetId(['cat_id'=>$newadd_fir,'ft_name'=>$ft_type]);
					$add_fir_color = Db::name('fruits_color')->insertGetId(['cat_id'=>$newadd_fir,'ft_name'=>$ft_color]);
					
					
					$newadd_sec = Db::name('materiel_category')->insert(['cat_name'=>$cat_chid_name,'cat_no'=>$cat_no,'cat_desc'=>$cat_desc,'ftype'=>$ft_type,'fcolor'=>$ft_color,'pid'=>$newadd_cat,'type'=>2]);
					if($newadd_fir && $newadd_sec && $newadd_cat && $add_fir_type && $add_fir_color){
						$result['status'] = 1;
						$result['msg'] = "数据添加成功";
						
						 
						echo json_encode($result);
						die;     
					}else{
						$result['status'] = 0;
						$result['msg'] = "数据添加失败";
						 
						echo json_encode($result);
						die;
					}
				}
			
			}else{
				$newadd_cat = Db::name('materiel_category')->insertGetId(['cat_name'=>$cat_name,'cat_no'=>$cat_no,'cat_desc'=>$cat_desc,'ftype'=>$ft_type,'fcolor'=>$ft_color,'pid'=>0,'type'=>3]); 
				
				
				$newadd_fir = Db::name('materiel_category')->insertGetId(['cat_name'=>$cat_chid_name,'cat_no'=>$cat_no,'cat_desc'=>$cat_desc,'ftype'=>$ft_type,'fcolor'=>$ft_color,'pid'=>$newadd_cat,'type'=>1]);
				
				// 判断果型果色,没有则添加
				$p_cat_id = $newadd_cat;
		 		$cond['p_cat_id'] = $p_cat_id;
		 		$cond['ft_name'] = $ft_type;
		 		$add_fir_type  = db('fruits_type')->where($cond)->value('ft_id');
		 		$add_fir_color = db('fruits_color')->where($cond)->value('ft_id');
		 		
		 		if(!$add_fir_type){
		 			$add_fir_type = db('fruits_type')->insertGetId(
		 				[
		 					'ft_name'=>$ft_type,
		 					'p_cat_id'=>$p_cat_id,
		 					'cat_id'=>$newadd_fir
		 				]);
		 		}

		 		if(!$add_fir_color){
		 			$add_fir_color = db('fruits_color')->insertGetId(
		 				[
		 					'ft_name'=>$ft_color,
		 					'p_cat_id'=>$p_cat_id,
		 					'cat_id'=>$newadd_fir
		 				]);
		 		}

				//插入果型国色信息
				/*
				$add_fir_type = Db::name('fruits_type')->insertGetId(['cat_id'=>$newadd_fir,'ft_name'=>$ft_type]);
				$add_fir_color = Db::name('fruits_color')->insertGetId(['cat_id'=>$newadd_fir,'ft_name'=>$ft_color]);
				*/
				//echo Db::name('fruits_color')->getlastsql();die;
					
				$newadd_sec = Db::name('materiel_category')->insert(['cat_name'=>$cat_chid_name,'cat_no'=>$cat_no,'cat_desc'=>$cat_desc,'ftype'=>$ft_type,'fcolor'=>$ft_color,'pid'=>$newadd_cat,'type'=>2]);
				if($newadd_fir && $newadd_sec && $newadd_cat && $add_fir_type && $add_fir_color){
					$result['status'] = 1;
					$result['msg'] = "数据添加成功";
					echo json_encode($result);
					die;     
				}else{
					$result['status'] = 0;
					$result['msg'] = "数据添加失败";
					 
					echo json_encode($result);
					die;
				}
			}
		}
		
	}
	
	//作物编辑
	public function edit(){
	 
		$cat_id = $this->request->param('cat_id');
		
		$cat_name = $this->request->param('cat_name');
		$cat_no = $this->request->param('cat_no');
		$cat_chid_name = $this->request->param('cat_chid_name');
		
		$ft_type = $this->request->param('ft_type');
		$ft_color = $this->request->param('ft_color');
		$cat_desc = $this->request->param('cat_desc');
		
		$do = $this->request->param('do');
		
		if(!$cat_id){
			$result['status'] = 0;
			$result['msg'] = "未传参数";
			 
			echo json_encode($result);
			die;
		}
		
	 
		$child_where['cat_id'] = $cat_id;
 
		 
		$child_info = Db::name('materiel_category')->field(['cat_id','cat_name','cat_no','cat_desc','pid'])->where($child_where)->find();	//获取作物信息
		//echo Db::name('materiel_category')->getlastsql();die;
		if(!$child_info){
			$result['status'] = 0;
			$result['msg'] = "无数据";
			 
			echo json_encode($result);
			die;
		} 
		if(isset($do)){
			//获取父级分类信息 判断是够更改
			$parent_info = Db::name('materiel_category')->field(['cat_id','cat_name'])->where('cat_name',$cat_name)->find();
			unset($child_info['cat_id']);
			$new = $child_info;
			$new['type'] = 2; 
			$cat[0] = Db::name('materiel_category')->where($new)->value('cat_id');
			$cat[1] = $cat_id;
			//var_dump($cat);die;
			if($parent_info){

				$check_child_where['cat_name']=$cat_chid_name;
				$check_child_where['cat_no']=$cat_no;
				$check_child_where['cat_id']=array('not in',$cat);
				//$check_child_where['type']=1;
				$check_child_info=Db::name('materiel_category')->field(['cat_id','cat_name'])->where($check_child_where)->find();
				
				if($check_child_info){
					$result['status'] = 0;
					$result['msg'] = "存在重复数据";
					 
					echo json_encode($result);
					die;          
				}else{
					$newadd_cat = Db::name('materiel_category')->where('cat_id', $cat_id)->update(['cat_no'=>$cat_no,'pid' => $parent_info['cat_id'],'cat_name'=>$cat_chid_name,'cat_desc'=>$cat_desc]);
					$newadd_catnew = Db::name('materiel_category')->where('cat_id',$cat[0])->update(['cat_no'=>$cat_no,'pid' => $parent_info['cat_id'],'cat_name'=>$cat_chid_name,'cat_desc'=>$cat_desc]);
					$newadd_color = Db::name('fruits_color')->where('cat_id', $cat_id)->update(['ft_name'=>$ft_color]);
					$newadd_type = Db::name('fruits_type')->where('cat_id', $cat_id)->update(['ft_name'=>$ft_type]);
					
					if($newadd_cat!==false && $newadd_catnew!==false && $newadd_color!==false && $newadd_type!==false){
						$result['status'] = 1;
						$result['msg'] = "修改成功";
						//$result['data'] = Db::name('materiel')->where('m_id',$m_id)->select();
						$result['data'] = array();
					 
						echo json_encode($result);
						die;
						 
					}else{
						$result['status'] = 0;
						$result['msg'] = "修改失败";
						$result['data'] = array();
					 
						echo json_encode($result);
						die;
					}
				}
 
			}else{
				$result['status'] = 0;
				$result['msg'] = "数据查询失败";
		 
				echo json_encode($result);
				die;
			}
			
		}else{
 
			$parent_info = Db::name('materiel_category')->field(['cat_id','cat_name'])->where('cat_id',$child_info['pid'])->find();
			$type_info  = Db::name('fruits_type')->field(['ft_name','ft_id'])->where('cat_id',$cat_id)->find();
			$color_info = Db::name('fruits_color')->field(['ft_name','ft_id'])->where('cat_id',$cat_id)->find();
			
	 
			if($parent_info && $type_info && $color_info){
				
	 
				$child_info['parent_name'] = $parent_info['cat_name'];
				$child_info['type_info'] = $type_info['ft_name'];
				$child_info['color_info'] = $color_info['ft_name'];
			}
			$result['status'] = 1;
			$result['msg'] = "返回成功";
			$result['data'] = $child_info;
			//var_dump($result);die;
			echo json_encode($result);
			die;	
			 
		}
		
	}
	
	//作物删除
	public function del(){
		if($_REQUEST && !empty($_REQUEST['cat_id'])){
			$cat_id = $_REQUEST['cat_id'];
			$find = Db::name('product_plan')->where('cat_id',$cat_id)->value('cat_id');
			if($find){
				return(json(array('status'=>0,'msg'=>'作物品种已使用，不允许删除！')));
			}
			$inf = Db::name('materiel_category')->field('cat_name,cat_no,cat_desc,status,pid,ck_id')->where('cat_id',$cat_id)->find();
			$inf['type'] = 2;
			//var_dump($inf);die;
			$miao_cat_id = Db::name('materiel_category')->where($inf)->value('cat_id');
			$pid = Db::name('materiel_category')->where('cat_id',$cat_id)->value('pid');
			$re = Db::name('materiel_category')->where('cat_id',$cat_id)->setField('status',0);
			$result = Db::name('materiel_category')->where('cat_id',$miao_cat_id)->setField('status',0);
			if($re){
				$con['pid'] = $pid;
				$con['status'] = 1; 
				$info = Db::name('materiel_category')->where($con)->find();
				if(!$info){
					$res = Db::name('materiel_category')->where('cat_id',$pid)->setField('status',0);
				}
				return(json(array('status'=>1,'msg'=>'删除成功')));
			}else{
				return(json(array('status'=>0,'msg'=>'删除失败')));
			}
		}else{
			return(json(array('status'=>0,'msg'=>'参数有误')));
		}
	}

	//Pc端果型接口( VUE )
	public function pc_type_list(){
 		$catid=request()->param('cat_id');
		//$where['ft_name'] = array('exp','is not null');
		$where['cat_id']=$catid;
		$info = Db::name('fruits_type')->field(['ft_name','ft_id','cat_id'])->where($where)->group('ft_name')->select();// 查询所有果型
		
		if(!empty($info)){
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $info;
		}else{
			$result['status'] = 0;
			$result['msg'] = "查询无数据";
			$result['data'] = array();
		}
		
		echo json_encode($result);
			die; 	
	}

	//Pc端果色接口(vue)
	public function pc_color_list(){
 		$catid=request()->param('cat_id');
 		$where['cat_id']=$catid;
		//$where['ft_name'] = array('exp','is not null');
		$info = Db::name('fruits_color')->field(['ft_name','ft_id','cat_id'])->where($where)->group('ft_name')->select();// 查询所有果型
		
		if(!empty($info)){
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $info;
		}else{
			$result['status'] = 0;
			$result['msg'] = "查询无数据";
			$result['data'] = array();
		}
		echo json_encode($result);
			die;    
	}

	/**
	 * [do_edit 作物编辑pc]
	 * @return [type] [description]
	 */
	public function do_edit()
	{
		$cat_id = $this->request->param('cat_id');		
		$cat_name = $this->request->param('cat_name');
		
		if(!$cat_id){
			$re['status'] = 0;
			$re['info'] = '缺少参数cat_id';
			ajaxReturnJson($re);
		}

		if(!$cat_name){
			$re['status'] = 0;
			$re['info'] = '作物名不能为空';
			ajaxReturnJson($re);
		}

		$condition['cat_id'] = array('neq',$cat_id);
		$condition['cat_name'] = array('eq',$cat_name);
		$find = db('materiel_category')->where($condition)->find();
		if($find){
			$re['status'] = 0;
			$re['info'] = '该作物已经存在';
			ajaxReturnJson($re);
		}

		$condition = [];
		$condition['cat_id'] = $cat_id;
		$res = db('materiel_category')->where($condition)->update(['cat_name'=>$cat_name]);
		
		if($res !== false){
			$re['status'] = 1;
			$re['info'] = '操作成功！';
			ajaxReturnJson($re);	
		}else{
			$re['status'] = 0;
			$re['info'] = '操作失败！';
			ajaxReturnJson($re);
		}
	}

	/**
	 * [gs_list 果色列表]
	 * @return [type] [description]
	 */
	public function gs_list()
	{
		$res = db('fruits_color')->select();
		$re['status'] = 1;
		$re['data'] = $res;
		ajaxReturnJson($re);
	}

	/**
	 * [gx_list 果性列表]
	 * @return [type] [description]
	 */
	public function gx_list()
	{
		$res = db('fruits_type')->select();
		$re['status'] = 1;
		$re['data'] = $res;
		ajaxReturnJson($re);
	}

	/**
	 * [del_gxs 果型果色的删除]
	 * @return [type] [description]
	 */
	public function del_gxs()
	{
		$tag = $this->request->param('tag');
		$ft_id = $this->request->param('ft_id');
		$condition['ft_id'] = $ft_id;
		switch ($tag) {
			case 1:
				$re = db('fruits_type')->where($condition)->delete();
				break;
			case 2:
				$re = db('fruits_color')->where($condition)->delete();				
				break;
			default:
				# code...
				break;			
		}

		if($re!==false){
			$res['status'] = 1;
			$res['info'] = '操作成功';		
		}else{
			$res['status'] = 0;
			$res['info'] = '操作失败';
		}
		ajaxReturnJson($res);
	}

	/**
	 * [get_gxs_info 获取果型果色的信息]
	 * @return [type] [description]
	 */
	public function get_gxs_info()
	{
		$tag = $this->request->param('tag');
		$ft_id = $this->request->param('ft_id');
		$condition['ft_id'] = $ft_id;
		switch ($tag) {
			case 1:
				$info = db('fruits_type')->alias('ft')
						->where($condition)
						->join('mf_materiel_category m','m.cat_id = ft.p_cat_id')
						->field('m.cat_name,ft.ft_name,ft.ft_id')
						->find();				
				break;
			case 2:
				$info = db('fruits_color')->alias('ft')
						->where($condition)
						->join('mf_materiel_category m','m.cat_id = ft.p_cat_id')
						->field('m.cat_name,ft.ft_name,ft.ft_id')
						->find();			
				break;
			default:
				# code...
				break;			
		}
		$res['status'] = 1;
		$res['data'] = $info;
		ajaxReturnJson($res);
	}

	
	public function save_gxs()
	{
		$tag = $this->request->param('tag');
		$ft_id = $this->request->param('ft_id');
		$ft_name = $this->request->param('ft_name');
		$condition['ft_id'] = $ft_id;
		$data['ft_name'] = $ft_name; 
		
		switch ($tag) {
			case 1:

				$oldInfo = db('fruits_type')->where($condition)->field('p_cat_id,ft_name')->find();
				$res = db('materiel_category')->where(['cat_id'=>$oldInfo['p_cat_id']])->update(['ftype'=>$ft_name]);

				$res = db('fruits_type')->alias('ft')
						->where($condition)
						->update($data);
				break;
			case 2:

				$oldInfo = db('fruits_color')->where($condition)->field('p_cat_id,ft_name')->find();
				$res = db('materiel_category')->where(['cat_id'=>$oldInfo['p_cat_id']])->update(['fcolor'=>$ft_name]);

				$res = db('fruits_color')->alias('ft')
						->where($condition)
						->update($data);
									
				break;
			default:
				# code...
				break;			
		}

		if($res!==false){
			$re['status'] = 1;
			$re['info'] = '操作成功';		
		}else{
			$re['status'] = 0;
			$re['info'] = '操作失败';
		}
		ajaxReturnJson($re);
	}

	/**
	 * [getcat2info 获取品种信息]
	 * @return [type] [description]
	 */
	public function getcat2info()
	{
		$cat_id = $this->request->param('cat_id');
		$condition['cat_id'] = $cat_id;
		$cat2info = db('materiel_category')				
					->where($condition)
					->field('cat_name,cat_id,fcolor,ftype,cat_desc,cat_no')
					->find();
		$re['status'] = 1;
		$re['data'] = $cat2info;
		ajaxReturnJson($re);
	}

	/**
	 * [savecat2 品种编辑pc]
	 * @return [type] [description]
	 */
	public function savecat2()
	{
		$cat_id = $this->request->param('cat_id');
		$data['cat_name'] = $this->request->param('cat_name');
		$data['cat_no'] = $this->request->param('cat_no');
		$data['cat_desc'] = $this->request->param('cat_desc');
		$data['fcolor'] = $this->request->param('fcolor');
		$data['ftype'] = $this->request->param('ftype');
		$condition['cat_id'] = $cat_id;
		$res = db('materiel_category')->where($condition)->update($data);
		if($res !== false){
			$re['status'] = 1;
			$re['info'] = '操作成功！';
		}else{
			$re['status'] = 1;
			$re['info'] = '操作失败！';
		}
		ajaxReturnJson($re);
	}
	  
}
