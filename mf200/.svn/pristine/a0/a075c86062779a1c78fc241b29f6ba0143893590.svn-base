<?php
namespace app\finance\controller;

use app\base\controller\Base;
use think\Db;
use think\Request;

class  Library extends Base{

	//盘库仓库列表
	public function ck_list(){

		$con['type'] = 1;
		$data = Db::name('ck_manage')->where($con)->field('ck_id,ck_name')->select();

		if($data){
			return json(['status'=>1,'msg'=>'查询成功','data'=>$data]);
		}else{
			return json(['status'=>1,'msg'=>'查询成功','data'=>array()]);
		}
	}

	//盘点物料列表
	public function wl_list(){

		$ck_id = request()->param('ck_id');
		if(!$ck_id){
			return json(['status'=>0,'msg'=>'仓库有误']);
		}
		$con1['ck_id'] = $ck_id;
		$con['status'] = 1;
		$data = Db::name('materiel')->where($con)->field('m_id,cat_id,m_name,m_desc,unit')->select();
		$arr = array();
		if($data){
			foreach($data as $k=>$v){
				$con1['cat_id'] = $v['cat_id'];
				$find = Db::name('materiel_category')->where($con1)->find();
				if($find){
					$arr[] = $v;
				}
			}
		}
		if($arr){
			return json(['status'=>1,'msg'=>'查询成功','data'=>$arr]);
		}else{
			return json(['status'=>1,'msg'=>'查询成功','data'=>array()]);
		}
	}
	/*物料列表 pc使用*/
	public function wlnew_list(){

		$ck_id = request()->param('ck_id');
		$keywords = request()->param('keywords');
		if(!$ck_id){
			return json(['status'=>0,'msg'=>'仓库有误']);
		}
		$con1['ck_id'] = $ck_id;
		if($keywords){
			$con = 'status = 1  and m_name like '."'%".$keywords."%'";
		}else{
			$con = 'status = 1 ';
		}
		
		
		
		$data = Db::name('materiel')->where($con)->field('m_id,cat_id,m_name,m_desc,unit')->select();
		$arr = array();
		if($data){
			foreach($data as $k=>$v){
				$con1['cat_id'] = $v['cat_id'];
				$find = Db::name('materiel_category')->where($con1)->find();
				if($find){
					$arr[] = $v;
				}
			}
		}
		if($arr){
			return json(['status'=>1,'msg'=>'查询成功','data'=>$arr]);
		}else{
			return json(['status'=>1,'msg'=>'查询成功','data'=>array()]);
		}
	}
	//盘点添加
	public function library_add(){
		$no = request()->param('no');	
		$ck_id = request()->param('ck_id');
		$m_id = request()->param('m_id');
		$num = request()->param('num');	

		if(!$no){
			return json(['status'=>0,'msg'=>'盘点编号有误']);
		}

		if(!$ck_id){
			return json(['status'=>0,'msg'=>'仓库有误']);
		}

		if(!$m_id){
			return json(['status'=>0,'msg'=>'物料有误']);
		}

		if(!$num){
			return json(['status'=>0,'msg'=>'请输入盘点数量']);
		}
		$ck_num = Db::name('materiel')->where('m_id',$m_id)->value('num');
		$con['inventory_no'] = $no;
		$con['ck_id'] = $ck_id;
		$con['status'] = 0;

		$find = Db::name('ck_inventory')->where($con)->find();
		if($find){
			$data['inventory_id'] = $find['inventory_id'];
		}else{
			$data1['inventory_no'] = $no;
			$data1['ck_id'] = $ck_id;
			$data1['add_worker_id'] = $this->worker['worker_id'];
			$data1['add_time'] = time();
			$data1['status'] = 0;
			$inventory_id = Db::name('ck_inventory')->insertGetId($data1);
			$data['inventory_id'] = $inventory_id;
		}
		$data['materiel_id'] = $m_id;
		$data['ck_num'] = round($ck_num,2);
		$data['inventory_num'] = round($num,2);
		$data['add_time'] = time();
		$re = Db::name('ck_materiel_inventory')->insert($data);
		if($re){			
			return json(['status'=>1,'msg'=>'添加成功']);
		}else{
			return json(['status'=>0,'msg'=>'添加失败']);
		}
	}
	//pc_保存本次盘点
	public function pc_library_keep(){
		$no = request()->param('no');	
		$ck_id = request()->param('ck_id');
		
		$con['inventory_no'] = $no;
		$con['ck_id'] = $ck_id;
		$con['status'] = 0;

		$find = Db::name('ck_inventory')->where($con)->find();
		if($find){
			$inventory_id = $find['inventory_id'];
		}
		$data = Db::name('ck_materiel_inventory')->where('inventory_id',$inventory_id)->select();
		if($data){
			foreach($data as $k=>$v){
				if($v['ck_num'] > $v['inventory_num']){

					$data[$k]['diff_num'] = ($v['ck_num'] - $v['inventory_num']);
				}else{

					$data[$k]['diff_num'] = ($v['inventory_num'] - $v['ck_num']);
				}
				$data[$k]['status'] = 0;
			}
		}else{
			return json(['status'=>0,'msg'=>'操作失败']);
		}
		
		foreach($data as $ke=>$va){
			$new_data['materiel_id'] = $va['materiel_id'];
			$new_data['ck_num'] = $va['ck_num'];
			$new_data['inventory_num'] = $va['inventory_num'];
			$new_data['change_num'] = $va['diff_num'];
			$new_data['status'] = $va['status'];
			$new_data['inventory_id'] = $inventory_id;
			$re = Db::name('ck_materiel_difference')->insert($new_data);	
		}
		if($re){
			Db::name('ck_inventory')->where('inventory_id',$inventory_id)->setField('status',1);			
			return json(['status'=>1,'msg'=>'保存成功']);
		}else{
			return json(['status'=>0,'msg'=>'保存失败']);
		}
		
		
	}
	//库存盘点列表
	public function library_list(){
		$ck_id = request()->param('ck_id');
		if(!$ck_id){
			return json(['status'=>0,'msg'=>'仓库有误']);
		}
		$con['ck_id'] = $ck_id;
		$con['status'] = 0;
		$find = Db::name('ck_inventory')->where($con)->find();
		if($find){
			$no = $find['inventory_no'];
			$data = Db::name('ck_materiel_inventory')->where('inventory_id',$find['inventory_id'])->select();
			if($data){
				foreach($data as $k=>$v){
					$cat =  Db::name('materiel')->where('m_id',$v['materiel_id'])->field('m_id,cat_id,m_name,unit,m_desc')->find();
					$cat_name = Db::name('materiel_category')->where('cat_id',$cat['cat_id'])->value('cat_name');
					$data[$k]['cat_name'] = $cat_name;
					$data[$k]['m_id'] = $cat['m_id'];
					$data[$k]['m_name'] = $cat['m_name'];
					$data[$k]['m_desc'] = $cat['m_desc'];
					$data[$k]['unit'] = $cat['unit'];
					if($v['ck_num'] > $v['inventory_num']){
						$data[$k]['diff'] = '-';
						$data[$k]['diff_num'] = ($v['ck_num'] - $v['inventory_num']);
					}else{
						$data[$k]['diff'] = '+';
						$data[$k]['diff_num'] = ($v['inventory_num'] - $v['ck_num']);
					}
					$data[$k]['add_time'] = date('Y-m-d',$v['add_time']);
				}
			}else{
				$data = array();
			}
		}else{
			$no =  $this->get_ck_sn();
			$data = array();
		}
		return json(['status'=>1,'msg'=>'查询成功','no'=>$no,'data'=>$data]);
	}
	//保存本次盘点
	public function library_keep(){
		$inventory_id = request()->param('inventory_id');
		$array_info = json_decode(request()->param('array_info'),true);

		if(!$inventory_id){

			return json(['status'=>0,'msg'=>'盘点id有误']);
		}
		if(!$array_info){
			return json(['status'=>0,'msg'=>'盘点信息有误']);
		}
		foreach($array_info as $k=>$v){
			if(!$v[0]){
				return json(['status'=>0,'msg'=>'物料id有误']);
			}
			if($v[1] != 0){
				if(!$v[1]){
					return json(['status'=>0,'msg'=>'原库存数量有误']);
				}
				if(!is_numeric($v[1])){

					return json(['status'=>0,'msg'=>'原库存数量必须是数字']);
				}
			}
			if($v[2] != 0){
				if(!$v[2]){
					return json(['status'=>0,'msg'=>'盘点数量有误']);
				}
				if(!is_numeric($v[2])){

					return json(['status'=>0,'msg'=>'盘点数量必须是数字']);
				}
			}
			if($v[3] != 0){
				if(!$v[3]){
					return json(['status'=>0,'msg'=>'差值有误']);
				}
				if(!is_numeric($v[3])){

					return json(['status'=>0,'msg'=>'差值必须是数字']);
				}
			}
		}
		$data['inventory_id'] = $inventory_id;
		foreach($array_info as $k=>$v){
			$v[1] += 0;
			$v[2] += 0;
			$v[3] += 0;
			if($v[3] != 0){
				$data['materiel_id'] = $v[0];
				$data['ck_num'] = $v[1];
				$data['inventory_num'] = $v[2];
				$data['change_num'] = $v[3];
				$data['status'] = 0;
				$re = Db::name('ck_materiel_difference')->insert($data);	
			}else{
				$re = 1;
			}
		}
		if($re){
			Db::name('ck_inventory')->where('inventory_id',$inventory_id)->setField('status',1);			
			return json(['status'=>1,'msg'=>'保存成功']);
		}else{
			return json(['status'=>0,'msg'=>'保存失败']);
		}
	}
	//盘点编号
	public function get_no(){
		$type = request()->param('type');
		if(!$type){
			return json(['status'=>0,'msg'=>'type值有误']);
		}
		if($type == 1){
			$con['type'] = 1;
		}else{
			$con['type'] = 2;
		}
		$con['status'] = 1;
		$data = Db::name('ck_inventory')->where($con)->field('inventory_id,inventory_no')->select();
		$arr = array();
		foreach($data as $k=>$v){
			$find = Db::name('ck_materiel_difference')->where('inventory_id',$v['inventory_id'])->find();
			if($find){
				$arr[] = $v;
			}
		}
		if($arr){
			return json(['status'=>1,'msg'=>'查询成功','data'=>$arr]);
		}else{
			return json(['status'=>1,'msg'=>'查询成功','data'=>array()]);
		}
	}

	//盘点差值列表
	public function diff_list(){

		$inventory_id = request()->param('inventory_id');
		$style = request()->param('style');

		if(!$inventory_id){
			return json(['status'=>0,'msg'=>'盘点id有误']);
		}
		$con['inventory_id'] = $inventory_id;
		$data = Db::name('ck_materiel_difference')->where($con)->order('id asc')->select();
		$arr = array();
		if($data){
			foreach($data as $k=>$v){
				$con1['inventory_id'] = $v['inventory_id'];
				$con1['materiel_id'] = $v['materiel_id'];
				$con1['ck_num'] = $v['ck_num'];
				$con1['inventory_num'] = $v['inventory_num'];
				$add_time = Db::name('ck_materiel_inventory')->where($con1)->value('add_time');
				$data[$k]['add_time'] = date('Y-m-d',$add_time);
				$cat =  Db::name('materiel')->where('m_id',$v['materiel_id'])->field('cat_id,m_name,unit,m_desc')->find();
				$cat_name = Db::name('materiel_category')->where('cat_id',$cat['cat_id'])->value('cat_name');
				$data[$k]['cat_name'] = $cat_name;
				$data[$k]['m_name'] = $cat['m_name'];
				$data[$k]['m_desc'] = $cat['m_desc'];
				$data[$k]['unit'] = $cat['unit'];
				if($v['ck_num'] > $v['inventory_num']){
					$data[$k]['diff'] = '-';
				}else{
					$data[$k]['diff'] = '+';
				}

				if($style){
					if($style == 1){
						if($data[$k]['ck_num'] < $data[$k]['inventory_num']){
							$arr[] = $data[$k];
						}
					}elseif($style ==2){
						if($data[$k]['ck_num'] > $data[$k]['inventory_num']){
							$arr[] = $data[$k];
						}
					}
				}else{
					$arr[]= $data[$k];
				}
			}
		}
		return json(['status'=>1,'msg'=>'查询成功','data'=>$arr]);
	}
	/*调整库存 pc使用*/
	public function pc_ck_adjust(){
		$id = request()->param('id');
		$inventory_id = request()->param('inventory_id');
		$where = " id in (".$id." )";
		
 
		$inventory_info = Db::name('ck_materiel_difference')->where($where)->select();
		
		foreach($inventory_info as $k=>$v){
			$re = Db::name('ck_materiel_difference')->where('id',$v['id'])->setField('status',1);
			$data = array();
			$data['materiel_id'] = $v['materiel_id'];
			$data['data_num'] = $v['ck_num'];
			$data['true_num'] = $v['inventory_num'];
			$data['change_num'] = $v['change_num'];
			$data['add_time'] = time();
			$cat = Db::name('materiel')->where('m_id',$v['materiel_id'])->field('cat_id,m_name,unit,m_desc')->find();
			$ck_id = Db::name('materiel_category')->where('cat_id',$cat['cat_id'])->value('ck_id');
			$data1 = array();
			if($v['ck_num'] > $v['inventory_num']){
				$data['act'] = 2;
				$data1['cat_id'] = $cat['cat_id'];
				$data1['materiel_id'] = $v['materiel_id'];
				$data1['cat_child_id'] = $v['materiel_id'];
				$data1['cat_child_name'] = $cat['m_name'];
				$data1['unit'] = $cat['unit'];
				$data1['materiel_desc'] = $cat['m_desc'];
				$data1['ck_id'] = $ck_id;
				$data1['num'] = $v['change_num'];
				$data1['type'] = 12;
				$data1['add_time'] = time();
				$data1['apply_worker'] = $this->worker['worker_id'];
				$data1['group_id'] = $this->worker['group_id'];
				$data1['lingliao_sn'] = $this->get_lingliao_sn();
				Db::name('ck_lingliao')->insert($data1);
			}else{
				$data['act'] = 1;
				$data1['cat_id'] = $cat['cat_id'];
				$data1['cat_child_id'] = $v['materiel_id'];
				$data1['cat_child_name'] = $cat['m_name'];
				$data1['unit'] = $cat['unit'];
				$data1['materiel_desc'] = $cat['m_desc'];
				$data1['ck_id'] = $ck_id;
				$data1['num'] = $v['change_num'];
				$data1['apply_worker'] = $this->worker['worker_id'];
				$data1['type'] = 17;
				$data1['add_time'] = time();
				$data1['insert_sn'] = $this->get_insert_sn();
				Db::name('ck_insert')->insert($data1);
			}
			$result = Db::name('ck_materiel_change')->insert($data);
			$re2 = Db::name('materiel')->where('m_id',$v['materiel_id'])->setField('num',$v['inventory_num']);
			
		}
		if($re !== false){
			$sta = Db::name('ck_materiel_difference')->where('inventory_id',$inventory_id)->column('status');
			$str = 1;
			foreach($sta as $k=>$v){
				if($v == 0){
					$str = 0;
				}
			}
			if($str){
				Db::name('ck_inventory')->where('inventory_id',$inventory_id)->setField('type',2);
			}
			return json(['status'=>1,'msg'=>'操作成功']);
		}else{
			return json(['status'=>0,'msg'=>'操作失败']);
		}
		
	}
	//调整库存
	public function ck_adjust(){

		$array_info = json_decode(request()->param('array_info'),true);

		if(!$array_info){
			return json(['status'=>0,'msg'=>'库存差值信息有误']);
		}
		$inventory_id = Db::name('ck_materiel_difference')->where('id',$array_info[0][0])->value('inventory_id');
		foreach($array_info as $k=>$v){
			if(!$v[0]){
				return json(['status'=>0,'msg'=>'盘点差值id有误']);
			}
			if(!$v[1]){
				return json(['status'=>0,'msg'=>'物料id有误']);
			}
			$v[2] += 0;
			$v[3] += 0;
			$v[4] += 0;
			if($v[2] != 0){
				if(!$v[2]){
					return json(['status'=>0,'msg'=>'原库存数量有误']);
				}
				if(!is_numeric($v[2])){

					return json(['status'=>0,'msg'=>'原库存数量必须是数字']);
				}
			}
			if($v[3] != 0){
				if(!$v[3]){
					return json(['status'=>0,'msg'=>'盘点数量有误']);
				}
				if(!is_numeric($v[3])){

					return json(['status'=>0,'msg'=>'盘点数量必须是数字']);
				}
			}
			if($v[4] != 0){
				if(!$v[4]){
					return json(['status'=>0,'msg'=>'差值有误']);
				}
				if(!is_numeric($v[4])){

					return json(['status'=>0,'msg'=>'差值必须是数字']);
				}
			}
			$re = Db::name('ck_materiel_difference')->where('id',$v[0])->setField('status',1);
			$data = array();
			$data['materiel_id'] = $v[1];
			$data['data_num'] = $v[2];
			$data['true_num'] = $v[3];
			$data['change_num'] = $v[4];
			$data['add_time'] = time();
			$cat = Db::name('materiel')->where('m_id',$v[1])->field('cat_id,m_name,unit,m_desc')->find();
			$ck_id = Db::name('materiel_category')->where('cat_id',$cat['cat_id'])->value('ck_id');
			$data1 = array();
			if($v[2] > $v[3]){
				$data['act'] = 2;
				$data1['cat_id'] = $cat['cat_id'];
				$data1['materiel_id'] = $v[1];
				$data1['cat_child_id'] = $v[1];
				$data1['cat_child_name'] = $cat['m_name'];
				$data1['unit'] = $cat['unit'];
				$data1['materiel_desc'] = $cat['m_desc'];
				$data1['ck_id'] = $ck_id;
				$data1['num'] = $v[4];
				$data1['type'] = 12;
				$data1['add_time'] = time();
				$data1['apply_worker'] = $this->worker['worker_id'];
				$data1['group_id'] = $this->worker['group_id'];
				$data1['lingliao_sn'] = $this->get_lingliao_sn();
				Db::name('ck_lingliao')->insert($data1);
			}else{
				$data['act'] = 1;
				$data1['cat_id'] = $cat['cat_id'];
				$data1['cat_child_id'] = $v[1];
				$data1['cat_child_name'] = $cat['m_name'];
				$data1['unit'] = $cat['unit'];
				$data1['materiel_desc'] = $cat['m_desc'];
				$data1['ck_id'] = $ck_id;
				$data1['num'] = $v[4];
				$data1['apply_worker'] = $this->worker['worker_id'];
				$data1['type'] = 17;
				$data1['add_time'] = time();
				$data1['insert_sn'] = $this->get_insert_sn();
				Db::name('ck_insert')->insert($data1);
			}
			$result = Db::name('ck_materiel_change')->insert($data);
			$re2 = Db::name('materiel')->where('m_id',$v[1])->setField('num',$v[3]);
		}
		if($re !== false){
			$sta = Db::name('ck_materiel_difference')->where('inventory_id',$inventory_id)->column('status');
			$str = 1;
			foreach($sta as $k=>$v){
				if($v == 0){
					$str = 0;
				}
			}
			if($str){
				Db::name('ck_inventory')->where('inventory_id',$inventory_id)->setField('type',2);
			}
			return json(['status'=>1,'msg'=>'操作成功']);
		}else{
			return json(['status'=>0,'msg'=>'操作失败']);
		}
	}
	//忽略库存
	public function ck_ignore(){
		$array_info = json_decode(request()->param('array_info'),true);
		if(!$array_info){
			return json(['status'=>0,'msg'=>'库存差值信息有误']);
		}
		$inventory_id = Db::name('ck_materiel_difference')->where('id',$array_info[0])->value('inventory_id');
		foreach($array_info as $k=>$v){
			if(!$v){
				return json(['status'=>0,'msg'=>'盘点差值id有误']);
			}
			$re = Db::name('ck_materiel_difference')->where('id',$v)->setField('status',2);
		}
		if($re !== false){
			$sta = Db::name('ck_materiel_difference')->where('inventory_id',$inventory_id)->column('status');
			$str = 1;
			foreach($sta as $k=>$v){
				if($v == 0){
					$str = 0;
				}
			}
			if($str){
				Db::name('ck_inventory')->where('inventory_id',$inventory_id)->setField('type',2);
			}
			return json(['status'=>1,'msg'=>'操作成功']);
		}else{
			return json(['status'=>0,'msg'=>'操作失败']);
		}
	}
	
	/*忽略库存 pc端*/
	public function pc_ck_ignore(){
		$id = request()->param('id');
		$inventory_id = request()->param('inventory_id');
		$where = " id in (".$id." )";
		$inventory_info = Db::name('ck_materiel_difference')->where($where)->select();
		
		foreach($inventory_info as $k=>$v){
			$re = Db::name('ck_materiel_difference')->where('id',$v['id'])->setField('status',2);
			
		}
		
		if($re !== false){
			$sta = Db::name('ck_materiel_difference')->where('inventory_id',$inventory_id)->column('status');
			$str = 1;
			foreach($sta as $k=>$v){
				if($v == 0){
					$str = 0;
				}
			}
			if($str){
				Db::name('ck_inventory')->where('inventory_id',$inventory_id)->setField('type',2);
			}
			return json(['status'=>1,'msg'=>'操作成功']);
		}else{
			return json(['status'=>0,'msg'=>'操作失败']);
		}
		
		
		
 
	}

	//生成盘点编号
	public function get_ck_sn(){

		$shijian = date('Ymd',time());//当天时间
		$start = date('Y-m-d 00:00:00',time());
		$end = date('Y-m-d 24:00:00',time());
		$con['add_time'] = array(['egt',$start],['elt',$end]);

		$ck_sn = Db::name('ck_inventory')->column('inventory_no');
		$number = Db::name('ck_inventory')->count();

		if($ck_sn){
			$arr = array();
	        foreach($ck_sn as $k=>$v){
	           $arr[] = (int)substr($v,10);  
	        }
       		 $max = max($arr);
       	}else{
       		$max = 0;
       	}
        if($number == $max){
            $number++;
        }else{
            $number = $max + 1;
        }

        //填充0；str_pad()填充字符串；STR_PAD_LEFT:填充到字符串的左侧
		$numbered = str_pad($number,3,"0",STR_PAD_LEFT);
		$inventory_no = 'PD'.$shijian.$numbered;

		return $inventory_no;
	}
 
	
	
	/*库存盘点--列表*/
	public function inventory_list(){
		$row = 3;
		$page = $this->request->param('page');
		$start = $this->request->param('start');
		$end = $this->request->param('end');
		$ck_name = $this->request->param('ck_name');
		$con['status'] = 1;

		if($start){

			$con['add_time'] = array('egt',date('Y-m-d 00:00:00',strtotime($start)));
		}

		if($end){

			$con['add_time'] = array('elt',date('Y-m-d 24:00:00',strtotime($end)));
		}

		if($start && $end){

			$con['add_time'] = array(['egt',date('Y-m-d 00:00:00',strtotime($start))],['elt',date('Y-m-d 24:00:00',strtotime($end))]);
		}
		if($ck_name){
			$con1['ck_name'] = array('like','%'.trim($ck_name).'%');
		}
		
		if($page==1||!$page){
			$page = 0;
		}else{
			$page = ($page-1)*$row;
		}
		
		$return_info = array();
		$return_info = Db::name("ck_inventory")->where($con)->order('add_time desc')->select();
		$arr = array();
		if($return_info){
			foreach($return_info as $k=>$v){
				$return_info[$k]['add_time'] = date('Y-m-d',$v['add_time']);
				/*获取仓库名字*/
				$con1['ck_id'] = $v['ck_id'];
				$manage_info =  Db::name("ck_manage")->where($con1)->value('ck_name');
				if($manage_info){
					$return_info[$k]['ck_name']  = $manage_info;
					$arr[] = $return_info[$k]; 
				}
			
			}
		}
		$count = count($arr);
		$arr1 = array();
		for($i = 0;$i < $row;$i++){
			if(isset($arr[$page+$i])){
				$arr1[$i] = $arr[$page+$i];
			}
		}

		return json([
			'status' =>1,
			'msg'    => "查询成功",
			'data'   => $arr1,
			'count'=>$count
			]);
		exit;
	}	
	/*库存盘点--详情*/
	public function inventory_detail(){
		$inventory_id = $this->request->param('inventory_id');
		$return_info = array();
		$return_info = Db::name("ck_materiel_inventory")->where('inventory_id = '.$inventory_id)->order('add_time desc')->select();
		if($return_info){
			foreach($return_info as $k=>$v){
				$return_info[$k]['add_time'] = date('Y-m-d',$v['add_time']);
				//获取类别 物料
				$materiel_info = Db::name("materiel")->where('m_id = '.$v['materiel_id'])->field('cat_id,m_name,m_desc,unit')->find();
				if($materiel_info){
					$category_info =  Db::name("materiel_category")->where('cat_id = '.$materiel_info['cat_id'])->field('cat_name')->find();
					if($category_info){
						$return_info[$k]['m_name'] = $materiel_info['m_name'];
						$return_info[$k]['m_desc'] = $materiel_info['m_desc'];
						$return_info[$k]['unit'] = $materiel_info['unit'];
						$return_info[$k]['cat_name'] = $category_info['cat_name'];
					}
				}
				//获取差值
				if($v['ck_num'] > $v['inventory_num']){
					$return_info[$k]['last_num'] = $v['ck_num']-$v['inventory_num'];
					$return_info[$k]['diff'] = '-';
				}else{
					$last_num = '';
					$last_num = $v['inventory_num'] - $v['ck_num'];
					$return_info[$k]['last_num'] = $last_num;
					$return_info[$k]['diff'] = '+';
				}
				//判断是够操作
				$diff_info = Db::name("ck_materiel_difference")->where('inventory_id = '.$inventory_id.' and materiel_id = '.$v['materiel_id'])->find();
				if($diff_info){
					if($diff_info['status']=='0'){
						$return_info[$k]['status'] ='未操作';
					}
					if($diff_info['status']=='1'){
						$return_info[$k]['status'] ='已处理';
					}
						if($diff_info['status']=='2'){
					$return_info[$k]['status'] ='忽略';
					}
				}else{
					$return_info[$k]['status'] ='--';
				}
			}
			return json([
			'status' =>1,
			'msg'    => "查询成功",
			'data'   => $return_info,
			]);
		exit;
			
		}else{
			return json([
			'status' =>0,
			'msg'    => "查询无数据",
			]);
			exit;
		}
	}
 
 	//入库编号
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
	
}