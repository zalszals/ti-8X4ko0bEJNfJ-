<?php
namespace app\baseset\controller;
use app\base\controller\Base;
use think\Db;
class Materiel extends Base{

	/**
	 * 物料分类列表
	 *  蔺晓宇 2017/11/27
	 */
    public function materiel_list(){    
	
		$where['status'] = 1;
 
		$where['pid'] = array('eq',0);
		$where['type'] = array('eq',0);
		
		$info = Db::name('materiel_category')->field(['cat_id','cat_name'])->where($where)->select();// 查询所有物料分类
		
		foreach($info as $k=>$v){
			
			$where_m['cat_id'] = $v['cat_id'] ;
			$where_m['status'] = 1 ;
			 
			$info_m = Db::name('materiel')->field(['m_id','m_no','m_name','price','unit','m_desc'])->where($where_m)->select();// 查询所有物料
		 
		 	foreach($info_m as $k1=>$v1){
		 		
		 		$info_m[$k1]['price'] = floatval($v1['price']);
		 	}

			if($info_m){
				$info[$k]['child']  = $info_m;
				 
			}else{
				$info[$k]['child'] =array();
			}
			
		}
		
 
		//echo db('materiel_category')->getlastsql();die;
		
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
	//根据分类ID 获取物料信息
	public function meteriel_all(){
		$cat_id = $this->request->param('cat_id');
		$page = $this->request->param('p');
		
		$Page_size = 1;
		if(empty($page)||$page<0){ 
			$page=1;
		}else { 
			$page=$page; 
		} 
		if(!$cat_id){
			$result['status'] = 0;
			$result['msg'] = "参数未传值";
			$result['data'] = array();
			echo json_encode($result);
			die;    
		}
		$offset=$Page_size*($page-1); 
		$where['cat_id'] = $cat_id ;
		$where['status'] = 1 ;
		$where['type'] = array('eq',0);
		if($cat_id){
			//$info = Db::name('materiel')->field(['m_id','m_no','m_name'])->where($where)->limit($offset,$Page_size)->select();// 查询所有物料
			$info = Db::name('materiel')->field(['m_id','m_no','m_name'])->where($where)->select();// 查询所有物料
 
			if(!empty($info)){
				$result['status'] = 1;
				$result['msg'] = "查询成功";
				$result['data'] = $info;
			}else{
				$result['status'] = 0;
				$result['msg'] = "查询无数据";
				$result['data'] = array();
			}
			
		}else{
			$result['status'] = 0;
			$result['msg'] = "查询无数据";
			$result['data'] = array();
		}
		
		echo json_encode($result);
		die;   
		
	}
	
	//添加物料
	public function add(){
		$m_name = $this->request->param('m_name');
		$cat_id = $this->request->param('cat_id');
		$m_no = $this->request->param('m_no');
		$unit = $this->request->param('unit');
		$m_desc = $this->request->param('m_desc');
		$price = $this->request->param('price');
 
		
		$where['m_no'] = $m_no;
		$where['status'] = 1;
		$where['type'] = array('eq',0);
		$info = Db::name('materiel')->field(['m_id'])->where($where)->limit(1)->select();// 查询所有物料
		
		$data = ['m_name'=>$m_name,'cat_id'=>$cat_id,'m_no'=>$m_no,'unit'=>$unit,'m_desc'=>$m_desc,'price'=>$price];
		if(empty($info)){
			$newadd = Db('materiel')->insert($data);
			if($newadd){
				$result['status'] = 1;
				$result['msg'] = "添加成功";
				//$result['data'] = Db::name('materiel')->where('m_id',$newadd)->select();
				$result['data'] = array();
				echo json_encode($result);die;
				
				
			}else{
				$result['status'] = 0;
				$result['msg'] = "添加失败";
				echo json_encode($result);die;
			}
		}else{
			$result['status'] = 0;
			$result['msg'] = "物料编号已存在";
			$result['data'] = array();
			
		}
		   	
		echo json_encode($result);
		die;  
	}
	
	/**
	 * [edit description]
	 * @return [type] [description]
	 */
	public function edit(){
		$m_id = $this->request->param('m_id');
		$m_name = $this->request->param('m_name');
		$cat_id = $this->request->param('cat_id');
		$m_no = $this->request->param('m_no');
		$unit = $this->request->param('unit');
		$m_desc = $this->request->param('m_desc');
		$price = $this->request->param('price');
		$do = $this->request->param('do');
		
		$where['m_id'] = $m_id ;
		if(isset($do)){
			
			
			$whereNew['m_no'] = $m_no;
			$whereNew['status'] = 1;
			$where['type'] = array('eq',0);
			$info = Db::name('materiel')->field(['m_id'])->where($whereNew)->find();// 查询所有物料
			
			if(empty($info)){
				$newadd = Db('materiel')->where('m_id', $m_id)->update(['m_name' => $m_name,'cat_id'=>$cat_id,'m_no'=>$m_no,'unit'=>$unit,'price'=>$price,'m_desc'=>$m_desc]);
				if($newadd){
					$result['status'] = 1;
					$result['msg'] = "修改成功";
					//$result['data'] = Db::name('materiel')->where('m_id',$m_id)->select();
					$result['data'] = array();
					 
				}else{
					$result['status'] = 0;
					$result['msg'] = "修改失败";
					$result['data'] = array();
				}
			}else{
				if($m_id == $info['m_id']){
					$newadd = Db('materiel')->where('m_id', $m_id)->update(['m_name' => $m_name,'cat_id'=>$cat_id,'m_no'=>$m_no,'unit'=>$unit,'price'=>$price,'m_desc'=>$m_desc]);
					if($newadd !== false){
						$result['status'] = 1;
						$result['msg'] = "修改成功";
						//$result['data'] = Db::name('materiel')->where('m_id',$m_id)->select();
						$result['data'] = array(); 
					}
				}else{
					
					$result['status'] = 0;
					$result['msg'] = "物料编号已存在";
					$result['data'] = array();
				}

			}
			
		}else{			
			
			$info = Db::name('materiel')->field(['m_id','cat_id','m_name','m_no','m_desc','price','unit'])->where($where)->limit(1)->select();// 查询所有物料
			$info[0]['price'] = floatval($info[0]['price']);
			$get_all['status'] = 1;
			$get_all['type'] = array('eq',0);
			$meteriel_info = Db::name('materiel_category')->field(['cat_id','cat_name'])->where($get_all)->select();// 查询所有物料分类
			
			//$cat_info = Db::name('materiel_category')->field(['cat_id','cat_name'])->where('cat_id',1)->find();// 查询所有物料分类
			
			$result['status'] = 1;
			$result['msg'] = "查询成功";
			$result['data'] = $info;
			//$result['cat_name'] = $cat_info['cat_name'];
			$result['meteriel_info'] = $meteriel_info;
			

 
				
		}
		echo json_encode($result);
		die;   	
		
	}
	//删除物料
	public function del(){
		$m_id = $this->request->param('m_id');
		
		$newadd = Db('materiel')->where('m_id', $m_id)->update(['status' =>0]);
		
		if($newadd){
			$result['status'] = 1;
			$result['msg'] = "删除成功";
			$result['data'] = array();
						 
		}else{
			$result['status'] = 0;
			$result['msg'] = "删除失败";
			$result['data'] = array();
		}
		echo json_encode($result);
		die;  
	}


	// Pc端 页面搜索功能 （vue）
	public function pc_search(){
		$cat_id=request()->param('cat_id');
		$m_name=request()->param('m_name');
		if($cat_id){
			$search['cat_id']=$cat_id;
		}
		if($m_name){
			$where_m['m_name']=array('like','%'.trim($m_name).'%');
		}
		$search['status']=1;
 
		$search['pid'] = array('eq',0);
		$search['type'] = array('eq',0);
		
		$info = Db::name('materiel_category')->field(['cat_id','cat_name'])->where($search)->select();// 查询所有物料分类
		
		foreach($info as $k=>$v){
			
			$where_m['cat_id'] = $v['cat_id'] ;
			$where_m['status'] = 1 ;
			 
			$info_m = Db::name('materiel')->field(['m_id','m_no','m_name','price','unit','m_desc'])->where($where_m)->select();// 查询所有物料
		 
		 	foreach($info_m as $k1=>$v1){
		 		
		 		$info_m[$k1]['price'] = floatval($v1['price']);
		 	}

			if($info_m){
				$info[$k]['child']  = $info_m;
				 
			}else{
				unset($info[$k]);
				//$info[$k]['child'] =array();
			}
			
		}

		if($info){
			return json(['status'=>1,'msg'=>"完成搜索",'data'=>$info]);
		}else{
			return json(['status'=>0,'msg'=>"没有相关数据"]);
		}

	}


	  
}
