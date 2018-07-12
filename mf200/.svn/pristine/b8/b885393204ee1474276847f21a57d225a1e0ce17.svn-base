<?php
namespace app\pc\controller;

use app\base\controller\Base;
use think\Db;
use think\Request;

class  Order extends Base{

	//制定采购订单界面需求数据
	public function draw_info(){
		
		$pcs_id = request()->param('pcs_id');

		if(!$pcs_id){

			return json(['status'=>0,'msg'=>'采购申请单id有误']);
		}

		$data = array();

		$con['pcs_id'] = $pcs_id;  

		$info = Db::name('apply_pcs')->where($con)->field('pcs_id,worker_id')->find();

		$worker = Db::name('worker')->where('worker_id',$info['worker_id'])->field('worker_id,worker_name,group_id')->find();

		$group = Db::name('group')->where('group_id',$worker['group_id'])->field('group_id,group_name')->find();

		$grouplist = Db::name('group')->where('is_buy',1)->field('group_id,group_name')->select();
		$supplylist = Db::name('supply')->field('supply_id,supply_name')->select();

		$data['pcs_id'] = $pcs_id;
		$data['worker_id'] = $info['worker_id'];
		$data['worker_name'] = $worker['worker_name'];
		$data['group_id'] = $group['group_id'];
		$data['group_name'] = $group['group_name'];

		$pcs_info = Db::name('apply_pcs_detail')->where($con)->field('pad_id,m_id,num')->select();

		foreach($pcs_info as $k=>$v){

			$m = Db::name('materiel')->where('m_id',$v['m_id'])->field('m_name,cat_id,m_no,m_desc,unit')->find();

			$cat_name = Db::name('materiel_category')->where('cat_id',$m['cat_id'])->value('cat_name');

			$data['info'][$k]['pad_id'] = $v['pad_id']; 
			$data['info'][$k]['cat_id'] = $m['cat_id'];
			$data['info'][$k]['cat_name'] = $cat_name;
			$data['info'][$k]['m_id'] = $v['m_id'];
			$data['info'][$k]['m_name'] = $m['m_name'];
			$data['info'][$k]['m_no'] = $m['m_no'];
			$data['info'][$k]['m_desc'] = $m['m_desc'];
			$data['info'][$k]['unit'] = $m['unit'];
			$data['info'][$k]['num'] = $v['num'];
		}

		if($supplylist){
			$data['supply'] = $supplylist;
		}else{
			$data['supply'] = array();
		}

		$group = Db::name('group')->where('is_buy',1)->select();

		if($group){
			$data['group'] = $group;
		}else{
			$data['group'] = array();
		}

		$data['worker'] = Db::name('worker')->where(['status'=>1,'group_id'=>$data['group'][0]['group_id']])->field('worker_id,worker_name')->select();

		if(!$data['worker']){
			$data['worker'] = array();
		}

		return json(['status'=>1,'msg'=>'查询成功','data'=>$data]);
	}

	//部门下的人员下拉
	public function worker_info(){

		$group_id = request()->param('group_id');

		if(!$group_id){

			return json(['status'=>0,'msg'=>'部门id有误']);
		}

		$con['group_id'] = $group_id;
		$con['status'] = 1;
		$worker = Db::name('worker')->where($con)->field('worker_id,worker_name')->select();

		if($worker){

			return json(['status'=>1,'msg'=>'查询成功','data'=>$worker]);
		}else{
			return json(['status'=>1,'msg'=>'查询成功','data'=>array()]);
		}		
	}

	//供应商接口
	public function supply(){

		$supply = Db::name('supply')->field('supply_id,supply_name')->select();

		if(!$supply){
			$supply = array(); 
		}

		return $supply;
	}

	//采购申请单物料分类
	public function add_cate(){


		$cat_id = Db::name('materiel')->where('status',1)->group('cat_id')->field('cat_id')->select();
		$category = array();
		$i= 0;
		if($cat_id){
			foreach($cat_id as $k=>$v){
				$arr = Db::name('materiel_category')->where('cat_id',$v['cat_id'])->field('cat_id,cat_name,pid')->find();
				if($arr['pid'] != 0){
					$cat_name = Db::name('materiel_category')->where('cat_id',$arr['pid'])->value('cat_name');
					$arr['cat_name'] = $cat_name.' '.$arr['cat_name'];
				}
				if($arr['cat_id'] && $arr['cat_name']){
					$category[$i]['cat_id'] = $arr['cat_id'];
					$category[$i]['cat_name'] = $arr['cat_name'];
					$i++;
				}

			}
		}
		if(!$category){
			$category = array();		
		}
		return $category;
	}

	//添加界面
	public function add(){
		$worker =$this->worker;
		$data['worker_id'] = $worker['worker_id'];
		$data['group_id'] = $worker['group_id'];
		$data['worker_name'] = $worker['worker_name'];
		$data['group_name'] = $worker['group_name'];

		$group = Db::name('group')->where('is_buy',1)->select();

		if($group){
			$data['group'] = $group;
		}else{
			$data['group'] = array();
		}

		$data['supply'] = $this->supply();

		$data['worker'] = Db::name('worker')->where(['status'=>1,'group_id'=>$data['group'][0]['group_id']])->field('worker_id,worker_name')->select();

		if(!$data['worker']){
			$data['worker'] = array();
		}

		$data['cate'] = $this->add_cate();
		return json(['status'=>1,'msg'=>'查询成功','data'=>$data]);
	}	

	//制定采购订单
	public function order_draw(){

		$pcs_id = request()->param('pcs_id');
		$style = request()->param('style');
		$worker_id = request()->param('worker_id');
		$group_id = request()->param('group_id');
		$supply_id = request()->param('supply_id');
		$num = request()->param('num');
		$sum = request()->param('sum');
		$beizhu = request()->param('beizhu');
		$cause = request()->param('cause');
		$add_time = request()->param('add_time');
		
		$m_id = request()->param('m_id');
		$m_num = request()->param('m_num');
		$price = request()->param('price');
		$m_sum = request()->param('m_sum');
		$mid = explode(',',$m_id);
		$mnum = explode(',',$m_num);
		$mprice = explode(',',$price);
		$msum = explode(',',$m_sum);
		$m_info = array();
		foreach($mid as $k=>$v){
			$m_info[$k][0] = $mid[$k];
			$m_info[$k][1] = $mnum[$k];
			$m_info[$k][2] = $mprice[$k];
			$m_info[$k][3] = $msum[$k];
		}
		if(!$style){

			return json(['status'=>0,'msg'=>'style值有误']);
		}

		if(!$add_time){

			return json(['status'=>0,'msg'=>'请选择日期']);
		}

		if(!$supply_id){

			return json(['status'=>0,'msg'=>'请输入供应商']);
		}

		if(!$group_id){

			return json(['status'=>0,'msg'=>'请选择采购部门']);
		}

		if(!$worker_id){

			return json(['status'=>0,'msg'=>'请选择采购人']);
		}

		if(!$m_info){

			return json(['status'=>0,'msg'=>'请完善物料信息']);
		}

		foreach($m_info as $k=>$v){
			
			if(!$v[0]){

				return json(['status'=>0,'msg'=>'请选择物料']);
			}

			if(!$v[1]){

				return json(['status'=>0,'msg'=>'请输入采购数量']);
			}

			if(!is_numeric($v[1])){

				return json(['status'=>0,'msg'=>'采购数量必须是数字']);
			}

			if(!$v[2]){

				return json(['status'=>0,'msg'=>'请输入单价']);
			}

			if(!is_numeric($v[2])){
			
				return json(['status'=>0,'msg'=>'单价必须是数字']);
			}
		}
		if($style == 2){
			$data['type'] = 2;
			$o_id = request()->param('order_id');
			$mode = request()->param('mode');
			if(!$mode){

				return json(['status'=>0,'msg'=>'请选择退料类型']);
			}
			$data['pid'] = $o_id;
			$data['mode'] = $mode;
		}
		$data['pcs_id'] = $pcs_id;
		$data['worker_id'] = $worker_id;
		$data['group_id'] = $group_id;
		$data['supply_id'] = $supply_id;
		$num += 0;
		$sum += 0;
		$data['num'] = round($num,2);
		$data['sum'] = round($sum,2);
		$data['beizhu'] = $beizhu;
		$data['status'] = 1;
		$data['add_time'] = date('Y-m-d H:i:s',strtotime($add_time));
		$data['insert_time'] = date('Y-m-d H:i:s',time());
		if(!$data['sum']){
			$data['sum'] = 0;
		}
		$data['order_sn'] =	$this->get_order_sn($style);
		$data['cause'] = $cause;
		$order_id = Db::name('pur_order')->insertGetId($data);

		if($order_id){

			foreach($m_info as $k=>$v){
				$info['order_id'] = $order_id;
				$info['m_id'] = $v[0];
				$v[1] += 0;
				$info['num'] = $v[1];
				if($v[2]){
					$v[2] += 0;
					$info['price'] = round($v[2],2);
				}else{
				 	$info['price'] = 0;
				}

				if($v[3]){
					$v[3] += 0;
					$info['m_sum'] = round($v[3],2);
				}else{
				 	$info['m_sum'] = 0;
				}
				$re = Db::name('pur_detail')->insert($info);
			}
			if($pcs_id){

				Db::name('apply_pcs')->where('pcs_id',$pcs_id)->setField('status',4);
			}
			if($style == 2){

				Db::name('pur_order')->where('order_id',$o_id)->setField('next_s',2);
			}
			return json(['status'=>1,'msg'=>'添加成功']);
		}else{
			return json(['status'=>0,'msg'=>'添加失败']);
		}
	}

	//采购订单列表
	public function order_list(){

		$style = request()->param('style');
		$type = request()->param('type');
		$page = request()->param('page');
		$start = request()->param('start');
		$end = request()->param('end');
		$sn = request()->param('sn');
		$worker_name = request()->param('worker_name');
		$group_name = request()->param('group_name');
		$supply_name = request()->param('supply_name');


		$worker = $this->worker;

		$row = 3;
		if($page == 1 || !$page){
           $page = 0;
       	}else{
            $page = ($page-1)*$row;
        }

        if(!$style){
			return json(['status'=>0,'msg'=>'style值有误']);
		}

		if(!$type){
			return json(['status'=>0,'msg'=>'type值有误']);
		}

		if($worker_name){

			$con['w.worker_name'] = array('like','%'.trim($worker_name).'%');
		}

		if($group_name){

			$con['g.group_name'] = array('like','%'.trim($group_name).'%');
		}

		if($supply_name){

			$con['s.supply_name'] = array('like','%'.trim($supply_name).'%');
		}

		if($sn){

			$con['p.order_sn'] = array('like','%'.trim($sn).'%');
		}

		if($start){

			$con['p.add_time'] = array('egt',date('Y-m-d 00:00:00',strtotime($start)));
		}

		if($end){

			$con['p.add_time'] = array('elt',date('Y-m-d 24:00:00',strtotime($end)));
		}

		if($start && $end){

			$con['p.add_time'] = array(['egt',date('Y-m-d 00:00:00',strtotime($start))],['elt',date('Y-m-d 24:00:00',strtotime($end))]);
		}

		if($style == 1){
			$con['p.type'] = 1;
		}else{
			$con['p.type'] = 2;
		}
		if($type == 1){
			$con['p.status'] = 1;
		}elseif($type == 2){
			$con['p.status'] = 2;
		}elseif($type == 3){
			$con['p.status'] = 3;
		}
		if($type != 4){
			if($worker['group_id'] != 5 && $worker['group_id'] != 1){
				$con['p.group_id'] = $worker['group_id'];
			}
		}

		$data = Db::name('pur_order p')
		->join('worker w','w.worker_id = p.worker_id')
		->join('group g','g.group_id = p.group_id')
		->join('supply s','s.supply_id = p.supply_id')
		->field('p.*,w.worker_name,g.group_name,s.supply_name')
		->where($con)
		->order('order_sn desc')
		->paginate(8);
		$page = $data->render();
        $list = $data->items();        
        $jsonStr = json_encode($data);
        $info = json_decode($jsonStr,true);
        $pages = $info['last_page']; 
        $page_list = array();
        $page_list['page'] = $page;
        $page_list['pages'] = $pages;
        $arr = array();
        if($info['data']){
        	$str = '';
			$str = str_replace(':null', ':""', json_encode($info['data']));
			$arr = json_decode($str,'true');
			foreach($arr as $k=>$v){
				$arr[$k]['add_time'] = date('Y-m-d',strtotime($v['add_time']));
				if($v['check_worker_id']){
					$arr[$k]['check_worker_name'] = Db::name('worker')->where('worker_id',$v['check_worker_id'])->value('worker_name');
				}else{
					$arr[$k]['check_worker_name'] = '';
				}
				if($v['check_time']){
					$arr[$k]['check_time'] = date('Y-m-d H:i',strtotime($v['check_time']));
				}else{
					$arr[$k]['check_time'] = '';
				}
				$next_name = '';
				if($style == 1){
					if($v['next'] == 2){
						$next_name = '采购入库单';
					}
					if($v['next_t'] == 2){
						if($next_name){
							$next_name = $next_name.',应付单';
						}else{
							$next_name = '应付单';
						}
					}
					if($v['next_s'] == 2){
						if($next_name){
							$next_name = $next_name.',采购退料单';
						}else{
							$next_name = '采购退料单';
						}
					}
				}else{
					if($v['next_f'] == 2){
						$next_name = '应收单';
					}
				}
				$arr[$k]['next_name'] = $next_name;
			}

		}

		if($arr){
			return json(['status'=>1,'msg'=>'查询成功','total'=>$page_list,'data'=>$arr]);
		}else{
			return json(['status'=>1,'msg'=>'查询成功','total'=>$page_list,'data'=>array()]);
		}
	}
	//采购订单详情
	public function order_detail(){

		$order_id = request()->param('order_id');

		if(!$order_id){
			return json(['status'=>0,'msg'=>'采购订单id有误']);
		}

		$data = Db::name('pur_order p')
			->join('worker w','w.worker_id = p.worker_id')
			->join('group g','g.group_id = p.group_id')
			->join('supply s','s.supply_id = p.supply_id')
			->field('p.*,w.worker_name,g.group_name,s.supply_name')
			->where('order_id',$order_id)
			->order('order_sn desc')
			->find();
		$arr = array();	
		$str = '';
		$str = str_replace(':null', ':""', json_encode($data));
		$arr = json_decode($str,'true');
		if($arr){
			$arr['add_time'] = date('Y-m-d',strtotime($arr['add_time']));
			if($arr['check_worker_id']){
				$arr['check_worker_name'] = Db::name('worker')->where('worker_id',$arr['check_worker_id'])->value('worker_name');
			}else{
				$arr['check_worker_name'] = '';
			}
			if($arr['check_time']){
				$arr['check_time'] = date('Y-m-d H:i',strtotime($arr['check_time']));
			}else{
				$arr['check_time'] = '';
			}
			$next_name = '';
			if($arr['type'] == 1){
				if($arr['next'] == 2){
					$next_name = '采购入库单';
				}
				if($arr['next_t'] == 2){
					if($next_name){
						$next_name = $next_name.',应付单';
					}else{
						$next_name = '应付单';
					}
				}
				if($arr['next_s'] == 2){
					if($next_name){
						$next_name = $next_name.',采购退料单';
					}else{
						$next_name = '采购退料单';
					}
				}
			}else{
				if($arr['next_f'] == 2){
					$next_name = '应收单';
				}
			}
			$arr['next_name'] = $next_name;
		}

		$list = Db::name('pur_detail')->where('order_id',$order_id)->select();

		foreach($list as $k=>$v){
			$info = Db::name('materiel')->where('m_id',$v['m_id'])->field('m_name,unit,cat_id,m_desc,m_no')->find();
			if($info){
				$list[$k]['m_name'] = $info['m_name'];
				$list[$k]['unit'] = $info['unit'];
				$list[$k]['m_no'] = $info['m_no'];
				$list[$k]['m_desc'] = $info['m_desc'];
				$list[$k]['cat_id'] = $info['cat_id'];
				$cate = Db::name('materiel_category')->where('cat_id',$info['cat_id'])->field('pid,cat_name')->find();
				if($cate['pid'] != 0){
					$cat_name = Db::name('materiel_category')->where('cat_id',$cate['pid'])->value('cat_name');
					$list[$k]['cat_name'] = $cat_name.' '.$cate['cat_name'];
				}else{
					$list[$k]['cat_name'] = $cate['cat_name'];
				}
			}else{
				$list[$k]['m_name'] = '';
				$list[$k]['unit'] = '';
				$list[$k]['m_no'] = '';
				$list[$k]['m_desc'] = '';
				$list[$k]['cat_id'] = '';
				$list[$k]['cat_name'] = '';
			}
		}
		$con1['pid'] = $order_id;
		$con1['type'] = 2;
		$list1 = Db::name('pur_order')->where($con1)->field('order_id,add_time,num,status')->select();
		if($list1){
			foreach($list1 as $k=>$v){
				$list1[$k]['add_time'] = date('Y-m-d',strtotime($v['add_time']));
				if($v['status'] == 1){
					$list1[$k]['status'] = '未审核';
				}elseif($v['status'] == 2){
					$list1[$k]['status'] = '已审核';
				}else{
					$list1[$k]['status'] = '未通过';
				}
			}
		}else{
			$list1 = array();
		}

		$con2['tb_id'] = $order_id;
		$con2['type'] = 16;
		$con2['is_show'] = 1;
		$list2 = Db::name('ck_insert')->where($con2)->field('add_time,sum(num) as num,insert_time,status,is_checked')->group('insert_time')->select();
		if($list2){
			foreach($list2 as $k=>$v){
				$list2[$k]['add_time'] = date('Y-m-d',$v['add_time']);
				$list2[$k]['insert_time'] = date('Y-m-d H:i:s',$v['insert_time']);
				$list2[$k]['order_id'] = $order_id;
				if($v['status'] == 0){
					if($v['is_checked'] == 0){
						$list2[$k]['status'] = '未审核';
					}
				}else{
					if($v['is_checked'] == 0){
						$list2[$k]['status'] = '待入库';
					}else{
						$list2[$k]['status'] = '已完成';
					}
				}
			}
		}else{
			$list2 = array();
		}
		return json(['status'=>1,'msg'=>'查询成功','data'=>$list,'list'=>$list1,'info'=>$list2,'arr'=>$arr]);
	}

	//编辑界面
	public function edit(){
		$order_id = request()->param('order_id');
		if(!$order_id){
			return json(['status'=>0,'msg'=>'采购订单id有误']);
		}
		$data = Db::name('pur_order p')->join('worker w','p.worker_id = w.worker_id')->join('group g','p.group_id = g.group_id')->join('supply s','p.supply_id = s.supply_id')->where('p.order_id',$order_id)->field('p.add_time,w.worker_name,g.group_name,p.supply_id,p.worker_id,p.group_id,p.mode,p.beizhu,p.num,p.sum,p.cause,p.order_id,s.supply_name')->find();
		$arr = array();
		$str = '';
		$str = str_replace(':null', ':""', json_encode($data));
		$arr = json_decode($str,'true');
		$arr['add_time'] = date('Y-m-d',strtotime($arr['add_time']));
		$info = Db::name('pur_detail p')->join('materiel m','p.m_id = m.m_id')->join('materiel_category c','m.cat_id = c.cat_id')->where('p.order_id',$order_id)->field('p.*,m.m_name,c.cat_name,m_no,m_desc,unit')->select();
		if(!$info){
			$info = array();
		}
		$supply =  Db::name('supply')->field('supply_id,supply_name')->select();
		$group = Db::name('group')->field('group_id,group_name')->where('is_buy',1)->select();
		$worker = Db::name('worker')->field('worker_id,worker_name')->where('group_id',$arr['group_id'])->select();
		if(!$supply){
			$supply = array();
		}
		if(!$group){
			$group = array();
		}
		if(!$worker){
			$worker = array();
		}
		$array['worker_id'] = $this->worker['worker_id'];
		$array['worker_name'] = $this->worker['worker_name'];
		$array['group_id'] = $this->worker['group_id'];
		$array['group_name'] = $this->worker['group_name'];
		$cate = $this->add_cate();
		return json(['status'=>1,'msg'=>'查询成功','data'=>$arr,'info'=>$info,'supply'=>$supply,'group'=>$group,'worker'=>$worker,'workers'=>$array,'cate'=>$cate]);
	}

	//编辑采购订单
	public function order_edit(){

		$order_id = request()->param('order_id');
		$worker_id = request()->param('worker_id');
		$group_id = request()->param('group_id');
		$supply_id = request()->param('supply_id');
		$num = request()->param('num');
		$sum = request()->param('sum');
		$beizhu = request()->param('beizhu');
		$add_time = request()->param('add_time');
		$od_id = request()->param('od_id');
		$m_id = request()->param('m_id');
		$m_num = request()->param('m_num');
		$price = request()->param('price');
		$m_sum = request()->param('m_sum');
		$modid= explode(',',$od_id);
		$mid = explode(',',$m_id);
		$mnum = explode(',',$m_num);
		$mprice = explode(',',$price);
		$msum = explode(',',$m_sum);
		$m_info = array();
		foreach($mid as $k=>$v){
			$m_info[$k][0] = $modid[$k];
			$m_info[$k][1] = $mid[$k];
			$m_info[$k][2] = $mnum[$k];
			$m_info[$k][3] = $mprice[$k];
			$m_info[$k][4] = $msum[$k];
		}

		if(!$order_id){

			return json(['status'=>0,'msg'=>'采购订单id有误']);
		}
		if(!$add_time){

			return json(['status'=>0,'msg'=>'请选择日期']);
		}
		if(!$supply_id){

			return json(['status'=>0,'msg'=>'请输入供应商']);
		}

		if(!$group_id){

			return json(['status'=>0,'msg'=>'请选择采购部门']);
		}

		if(!$worker_id){

			return json(['status'=>0,'msg'=>'请选择采购人']);
		}

		if(!$m_info){

			return json(['status'=>0,'msg'=>'请完善物料信息']);
		}

		foreach($m_info as $k=>$v){
			
			if(!$v[1]){

				return json(['status'=>0,'msg'=>'请选择物料']);
			}

			if(!$v[2]){

				return json(['status'=>0,'msg'=>'请输入采购数量']);
			}

			if(!is_numeric($v[2])){

				return json(['status'=>0,'msg'=>'采购数量必须是数字']);
			}

			if(!$v[3]){

				return json(['status'=>0,'msg'=>'请输入单价']);
			}

			if(!is_numeric($v[3])){
			
				return json(['status'=>0,'msg'=>'单价必须是数字']);
			}
		}

		$data['order_id'] = $order_id;
		$data['worker_id'] = $worker_id;
		$data['group_id'] = $group_id;
		$data['supply_id'] = $supply_id;
		$num += 0;
		$sum += 0;
		$data['num'] = round($num,2);
		$data['sum'] = round($sum,2);
		$data['beizhu'] = $beizhu;
		$data['status'] = 1;
		$data['add_time'] = date('Y-m-d H:i:s',strtotime($add_time));
		if(!$data['sum']){
			$data['sum'] = 0;
		}

		$od_id = Db::name('pur_detail')->where('order_id',$order_id)->column('od_id');
		$re = Db::name('pur_order')->update($data);

		if($re !== false){

			$arr = array();
			$diff = array();

			foreach($m_info as $k=>$v){
				$info['order_id'] = $order_id;
				$info['m_id'] = $v[1];
				$v[2] += 0;
				$info['num'] = $v[2];
				if($v[3]){
					$v[3] += 0;
					$info['price'] = round($v[3],2);
				}else{
				 	$info['price'] = 0;
				}
				if($v[4]){
					$v[4] += 0;
					$info['m_sum'] = round($v[4],2);
				}else{
				 	$info['m_sum'] = 0;
				}
				if($v[0]){
					Db::name('pur_detail')->where('od_id',$v[0])->update($info);
					$arr[] = $v[0]; 
				}else{
					Db::name('pur_detail')->insert($info);
				}

			}
			$diff = array_diff($od_id,$arr);
			foreach($diff as $k=>$v){
				Db::name('pur_detail')->where('od_id',$v)->delete();
			}
			return json(['status'=>1,'msg'=>'编辑成功']);
		}else{
			return json(['status'=>0,'msg'=>'编辑失败']);
		}
	}
	//编辑采购退料单
	public function back_edit(){

		$order_id = request()->param('order_id');
		$cause = request()->param('cause');
		$mode = request()->param('mode');
		$supply_id = request()->param('supply_id');
		$num = request()->param('num');
		$sum = request()->param('sum');
		$beizhu = request()->param('beizhu');
		$add_time = request()->param('add_time');
		$od_id = request()->param('od_id');
		$m_id = request()->param('m_id');
		$m_num = request()->param('m_num');
		$price = request()->param('price');
		$m_sum = request()->param('m_sum');
		$modid= explode(',',$od_id);
		$mid = explode(',',$m_id);
		$mnum = explode(',',$m_num);
		$mprice = explode(',',$price);
		$msum = explode(',',$m_sum);
		$m_info = array();
		foreach($mid as $k=>$v){
			$m_info[$k][0] = $modid[$k];
			$m_info[$k][1] = $mid[$k];
			$m_info[$k][2] = $mnum[$k];
			$m_info[$k][3] = $mprice[$k];
			$m_info[$k][4] = $msum[$k];
		}

		if(!$order_id){

			return json(['status'=>0,'msg'=>'采购订单id有误']);
		}
		if(!$add_time){

			return json(['status'=>0,'msg'=>'请选择日期']);
		}
		if(!$supply_id){

			return json(['status'=>0,'msg'=>'请输入供应商']);
		}

		if(!$mode){

			return json(['status'=>0,'msg'=>'请选择退料方式']);
		}

		if(!$m_info){

			return json(['status'=>0,'msg'=>'请完善物料信息']);
		}

		foreach($m_info as $k=>$v){
			
			if(!$v[1]){

				return json(['status'=>0,'msg'=>'请选择物料']);
			}

			if(!$v[2]){

				return json(['status'=>0,'msg'=>'请输入采购数量']);
			}

			if(!is_numeric($v[2])){

				return json(['status'=>0,'msg'=>'采购数量必须是数字']);
			}

			if(!$v[3]){

				return json(['status'=>0,'msg'=>'请输入单价']);
			}

			if(!is_numeric($v[3])){
			
				return json(['status'=>0,'msg'=>'单价必须是数字']);
			}
		}

		$data['order_id'] = $order_id;
		$data['cause'] = $cause;
		$data['mode'] = $mode;
		$data['supply_id'] = $supply_id;
		$num += 0;
		$sum += 0;
		$data['num'] = round($num,2);
		$data['sum'] = round($sum,2);
		$data['beizhu'] = $beizhu;
		$data['status'] = 1;
		$data['add_time'] = date('Y-m-d H:i:s',strtotime($add_time));
		if(!$data['sum']){
			$data['sum'] = 0;
		}

		$od_id = Db::name('pur_detail')->where('order_id',$order_id)->column('od_id');
		$re = Db::name('pur_order')->update($data);

		if($re !== false){

			$arr = array();
			$diff = array();

			foreach($m_info as $k=>$v){
				$info['order_id'] = $order_id;
				$info['m_id'] = $v[1];
				$v[2] += 0;
				$info['num'] = $v[2];
				if($v[3]){
					$v[3] += 0;
					$info['price'] = round($v[3],2);
				}else{
				 	$info['price'] = 0;
				}
				if($v[4]){
					$v[4] += 0;
					$info['m_sum'] = round($v[4],2);
				}else{
				 	$info['m_sum'] = 0;
				}
				if($v[0]){
					Db::name('pur_detail')->where('od_id',$v[0])->update($info);
					$arr[] = $v[0]; 
				}else{
					Db::name('pur_detail')->insert($info);
				}

			}
			$diff = array_diff($od_id,$arr);
			foreach($diff as $k=>$v){
				Db::name('pur_detail')->where('od_id',$v)->delete();
			}
			return json(['status'=>1,'msg'=>'编辑成功']);
		}else{
			return json(['status'=>0,'msg'=>'编辑失败']);
		}
	}

	//采购订单删除
	public function order_del(){

		$style	= request()->param('style');
		$order_id = request()->param('order_id');
		if(!$style){
			return json(['status'=>0,'msg'=>'style值有误']);
		}
		if(!$order_id){
			return json(['status'=>0,'msg'=>'采购订单id有误']);
		}
		if($style == 1){
			$pcs_id = Db::name('pur_order')->where('order_id',$order_id)->value('pcs_id');
		}
		if($style == 2){
			$pid = Db::name('pur_order')->where('order_id',$order_id)->value('pid');
		}
		$re = Db::name('pur_order')->where('order_id',$order_id)->delete();
		if($re){
			Db::name('pur_detail')->where('order_id',$order_id)->delete();
			if($style == 2){
				$order = Db::name('pur_order')->where('pid',$pid)->where('type',2)->value('order_id');
				if(!$order){
					Db::name('pur_order')->where('order_id',$pid)->setField('next_s',1);
				}
			}
			if($style == 1){
				if($pcs_id){
					Db::name('apply_pcs')->where('pcs_id',$pcs_id)->setField('status',2);
				}
			}
			return json(['status'=>1,'msg'=>'删除成功']);	
		}else{
			return json(['status'=>0,'msg'=>'删除失败']);
		}

	}

	//审核采购订单
	public function order_check(){

		$type = request()->param('type');
		$order_id = request()->param('order_id');
		$reason = request()->param('reason');

		$worker = $this->worker;
		$worker_id = $worker['worker_id'];

		if(!$type){
			return json(['status'=>0,'msg'=>'type值有误']);
		}
		if(!$order_id){		
			return json(['status'=>0,'msg'=>'采购订单id有误']);
		}

		if($type == 1){
			$data['status'] = 2;
			$data['check_time'] = date('Y-m-d H:i:s',time());
			$data['check_worker_id'] = $worker_id;
		}else{
			$data['status'] = 3;
			$data['reason'] = $reason;
			$data['check_time'] = date('Y-m-d H:i:s',time());
			$data['check_worker_id'] = $worker_id;
		}

		$re = Db::name('pur_order')->where('order_id',$order_id)->update($data);

		if($re !== false){
			return json(['status'=>1,'msg'=>'审核成功']);
		}else{
			return json(['status'=>0,'msg'=>'审核失败']);
		}
	}

	//审核采购订单
	public function order_back(){

		$style = request()->param('style');
		$order_id = request()->param('order_id');
		if(!$style){		
			return json(['status'=>0,'msg'=>'style值有误']);
		}
		if(!$order_id){		
			return json(['status'=>0,'msg'=>'采购订单id有误']);
		}

		$status = Db::name('pur_order')->where('order_id',$order_id)->value('status');
		$next = Db::name('pur_order')->where('order_id',$order_id)->value('next');
		$next_t = Db::name('pur_order')->where('order_id',$order_id)->value('next_t');
		$next_s = Db::name('pur_order')->where('order_id',$order_id)->value('next_s');
		$next_f = Db::name('pur_order')->where('order_id',$order_id)->value('next_f');

		if($status == 1 || $status == 3){

			return json(['status'=>0,'msg'=>'采购订单状态不是已审核，不能退回']);
		}
		if($style == 1){
			if($next == 2){

				return json(['status'=>0,'msg'=>'采购订单已执行入库，不能退回']);
			}

			if($next_t == 2){

				return json(['status'=>0,'msg'=>'采购订单已制应付单，不能退回']);
			}

			if($next_s == 2){

				return json(['status'=>0,'msg'=>'采购订单已制退料单，不能退回']);
			}
		}else{

			if($next_f == 2){

				return json(['status'=>0,'msg'=>'采购退料单已制应收单，不能退回']);
			}
		}

		$data['status'] = 1;
		$data['check_worker_id'] = null;
		$data['check_time'] = null;

		$re = Db::name('pur_order')->where('order_id',$order_id)->update($data);

		if($re !== false){
			return json(['status'=>1,'msg'=>'退还成功']);
		}else{
			return json(['status'=>0,'msg'=>'退还失败']);
		}

	}

	//采购订单入库
	public function order_ruku(){
		$order_id = request()->param('order_id');
		$beizhu = request()->param('beizhu');
		$add_time = request()->param('add_time');
		$od_id = request()->param('od_id');
		$m_id = request()->param('m_id');
		$num = request()->param('num');
		$modid= explode(',',$od_id);
		$mid = explode(',',$m_id);
		$mnum = explode(',',$num);
		$m_info = array();
		foreach($mid as $k=>$v){
			$m_info[$k][0] = $modid[$k];
			$m_info[$k][1] = $mid[$k];
			$m_info[$k][2] = $mnum[$k];
		}
		$worker = $this->worker;
		$worker_id = $worker['worker_id'];
		if(!$order_id){
			return json(['status'=>0,'msg'=>'采购订单id有误']);
		}
		if(!$add_time){
			return json(['status'=>0,'msg'=>'请选择日期']);
		}
		if(!$m_info){
			return json(['status'=>0,'msg'=>'物料信息有误']);
		}
		$con2['tb_id'] = $order_id;
		$con2['type'] = 16;
		$con2['is_show'] = 1;
		$list2 = Db::name('ck_insert')->where($con2)->field('sum(num) as num,cat_child_id,cat_child_name')->group('cat_child_id')->select();
		foreach($m_info as $k=>$v){

			if(!$v[1]){

				return json(['status'=>0,'msg'=>'请选择物料']);
			}

			if(!$v[2]){

				return json(['status'=>0,'msg'=>'请输入实际数量']);
			}

			if(!is_numeric($v[2])){

				return json(['status'=>0,'msg'=>'实际数量必须是数字']);
			}

			foreach($list2 as $k1=>$v1){

				if($v1['cat_child_id'] == $v[1]){
					$order_num = Db::name('pur_detail')->where('m_id',$v[1])->where('order_id',$order_id)->field('sum(num) as order_num')->group('m_id')->select();
					if(($v1['num']+$v[2]) > ($order_num[0]['order_num']*1.1)){
						return json(['status'=>0,'msg'=>"{$v1['cat_child_name']}物料总入库数量超过采购数量"]);
					}
				}
			}
		}

		$data['tb_id'] = $order_id;
		$data['type'] = 16;
		$data['insert_time'] = time();
		$data['add_time'] = strtotime($add_time);
		$data['apply_worker'] = $worker_id;
		$data['remarks'] = $beizhu;

		foreach($m_info as $k=>$v){

			$m  = Db::name('materiel')->where('m_id',$v[1])->field('cat_id,m_name,m_desc,unit')->find();
			$ck_id	= Db::name('materiel_category')->where('cat_id',$m['cat_id'])->value('ck_id');
			$sn = $this->get_insert_sn();
			$data['insert_sn'] = $sn;
			$data['ck_id'] = $ck_id;	
			$data['cat_id'] = $m['cat_id'];	
			$data['cat_child_id'] = $v[1];
			$data['cat_child_name'] = $m['m_name'];	
			$data['materiel_desc'] = $m['m_desc'];
			$data['unit'] = $m['unit'];	
			$data['num'] = $v[2];
			$data['tbd_id']	= $v[0];

			$re = Db::name('ck_insert')->insert($data);
		}

		if($re){
			Db::name('pur_order')->where('order_id',$order_id)->setField('next',2);
			return json(['status'=>1,'msg'=>'入库成功']);
		}else{
			return json(['status'=>0,'msg'=>'入库失败']);
		}
	}

	//采购入库单
	public function ruku_list(){
		$page = request()->param('page');
		$type = request()->param('type');
		$start = request()->param('start');
		$end = request()->param('end');
		$sn = request()->param('sn');
		$worker_name = request()->param('worker_name');
		$group_name = request()->param('group_name');
		$supply_name = request()->param('supply_name');

		$row = 3;
		if($page == 1 || !$page){
           $page = 0;
       	}else{
            $page = ($page-1)*$row;
        }
        if(!$type){
        	return json(['status'=>0,'msg'=>'type值有误']);
        }
        if($worker_name){

			$con['w.worker_name'] = array('like','%'.trim($worker_name).'%');
		}

		if($group_name){

			$con['g.group_name'] = array('like','%'.trim($group_name).'%');
		}

		if($supply_name){

			$con['s.supply_name'] = array('like','%'.trim($supply_name).'%');
		}

		if($sn){

			$con['p.order_sn'] = array('like','%'.trim($sn).'%');
		}

		if($start){

			$con['c.add_time'] = array('egt',strtotime(date('Y-m-d 00:00:00',strtotime($start))));
		}

		if($end){

			$con['c.add_time'] = array('elt',strtotime(date('Y-m-d 24:00:00',strtotime($end))));
		}

		if($start && $end){

			$con['c.add_time'] = array(['egt',strtotime(date('Y-m-d 00:00:00',strtotime($start)))],['elt',strtotime(date('Y-m-d 24:00:00',strtotime($end)))]);
		}
		if($type == 1){
			$con['c.status'] = 0;
			$con['c.is_checked'] = 0;
		}elseif($type == 2){
			$con['c.status'] = 1;
			$con['c.is_checked'] = 0;
		}else{
			$con['c.status'] = 1;
			$con['c.is_checked'] = 1;
		}
		$con['c.is_show'] = 1;
		$con['c.type'] = 16;
		$data = Db::name('ck_insert c')
		->join('worker w','c.apply_worker = w.worker_id')
		->join('group g','w.group_id = g.group_id')
		->join('pur_order p','c.tb_id = p.order_id')
		->join('supply s','p.supply_id = s.supply_id')
		->where($con)
		->field('c.tb_id,c.apply_worker,c.add_time,sum(c.num) as sum,c.remarks,c.insert_time,c.status,c.is_checked,s.supply_name,p.order_sn,w.worker_name,g.group_id,g.group_name,p.order_id,p.supply_id')
		->group('c.insert_time,c.tb_id')
		->order('c.insert_time desc')
		->paginate(8);
		$page = $data->render();
        $list = $data->items();        
        $jsonStr = json_encode($data);
        $info = json_decode($jsonStr,true);
        $pages = $info['last_page']; 
        $page_list = array();
        $page_list['page'] = $page;
        $page_list['pages'] = $pages;
			
		$arr = array();
		if($info['data']){
			$str = '';
			$str = str_replace(':null', ':""', json_encode($info['data']));
			$arr = json_decode($str,'true');
			foreach($arr as $k=>$v){
				$id_str = Db::name('ck_insert')->where(['tb_id'=>$v['tb_id'],'insert_time'=>$v['insert_time']])->column('insert_id');
				$arr[$k]['add_time'] = date('Y-m-d',$v['add_time']);
				$arr[$k]['insert_time'] = date('Y-m-d H:i:s',$v['insert_time']);
				$arr[$k]['str'] = implode(',',$id_str);
				if($v['status'] == 0){
					if($v['is_checked'] == 0){
						$arr[$k]['status'] = '待审核';
					}
				}else{
					if($v['is_checked'] == 0){
						$arr[$k]['status'] = '待入库';
					}else{
						$arr[$k]['status'] = '已完成';
					}
				}
			}
		}
		return json(['status'=>1,'msg'=>'查询成功','total'=>$page_list,'data'=>$arr]);	
	}
	//采购入库单详情
	public function ruku_detail(){
		$order_id = request()->param('order_id');
		$add_time = request()->param('insert_time');
		if(!$order_id){
			return json(['status'=>0,'msg'=>'采购订单id有误']);
		}
		if(!$add_time){
			return json(['status'=>0,'msg'=>'申请时间有误']);
		}
		$data = Db::name('pur_order p')->join('supply s','p.supply_id = s.supply_id')->where('p.order_id',$order_id)->field('p.order_sn,s.supply_name')->find();
		$info = Db::name('ck_insert')->where('tb_id',$order_id)->where('insert_time',strtotime($add_time))->field('insert_id,insert_sn,cat_child_name as m_name,materiel_desc as m_desc,num,status,is_checked,unit,ck_id,apply_worker as worker_id,add_time,remarks')->select();
		if($info){
			$sum = 0;
			foreach($info as $k=>$v){
				$info[$k]['ck_name'] = Db::name('ck_manage')->where('ck_id',$v['ck_id'])->value('ck_name');
				if($v['status'] == 0){
					$info[$k]['status_name'] = '未审核';
				}
				if($v['status'] == 2){
					$info[$k]['status_name'] = '未通过';
				}
				if($v['status'] == 1){
					if($v['is_checked'] == 0){
						$info[$k]['status_name'] = '待入库';
					}else{
						$info[$k]['status_name'] = '已入库';
					}
				}
				$sum += $v['num'];
			}
			$data['add_time'] = date('Y-m-d',$info[0]['add_time']);
			$data['bz'] = $info[0]['remarks'] ? $info[0]['remarks'] : '';
			$worker = Db::name('worker w')->join('group g','w.group_id = g.group_id')->where('w.worker_id',$info[0]['worker_id'])->field('worker_name,group_name')->find();
			$data['worker_name'] = $worker['worker_name'];
			$data['group_name'] = $worker['group_name'];
			$data['sum'] = $sum;
		}else{
			$info = array();
		}
		return json(['status'=>1,'msg'=>'查询成功','data'=>$info,'info'=>$data]);

	}

	//采购生成应付应收单
	public function order_pay(){
		$style = request()->param('style');
		$order_id = request()->param('order_id');
		$supply_id = request()->param('supply_id');
		$beizhu = request()->param('beizhu');
		$num = request()->param('num');
		$sum = request()->param('sum');
		$add_time = request()->param('add_time');
		$m_id = request()->param('m_id');
		$m_num = request()->param('m_num');
		$price = request()->param('price');
		$m_sum = request()->param('m_sum');
		$mid= explode(',',$m_id);
		$mnum = explode(',',$m_num);
		$mprice = explode(',',$price);
		$msum = explode(',',$m_sum);
		$m_info = array();
		foreach($mid as $k=>$v){
			$m_info[$k][0] = $mid[$k];
			$m_info[$k][1] = $mnum[$k];
			$m_info[$k][2] = $mprice[$k];
			$m_info[$k][3] = $msum[$k];
		}
		$worker = $this->worker;
		$worker_id = $worker['worker_id'];
		$group_id = $worker['group_id'];

		if(!$style){
			return json(['status'=>0,'msg'=>'style值有误']);
		}

		if(!$add_time){
			return json(['status'=>0,'msg'=>'请选择日期']);
		}


		if(!$order_id){
			if($style == 1){
				return json(['status'=>0,'msg'=>'采购订单id有误']);
			}else{
				return json(['status'=>0,'msg'=>'采购退料单id有误']);
			}
		}

		if(!$supply_id){
			return json(['status'=>0,'msg'=>'供应商信息有误']);
		}

		foreach($m_info as $k=>$v){

			if(!$v[0]){

				return json(['status'=>0,'msg'=>'请选择物料']);
			}

			if(!$v[1]){

				return json(['status'=>0,'msg'=>'请输入计价数量']);
			}

			if(!is_numeric($v[1])){

				return json(['status'=>0,'msg'=>'计价数量必须是数字']);
			}

			if(!$v[2]){

				return json(['status'=>0,'msg'=>'请输入单价']);
			}

			if(!is_numeric($v[2])){
			
				return json(['status'=>0,'msg'=>'单价必须是数字']);
			}
		}

		$data['worker_id'] = $worker_id;
		$data['group_id'] = $group_id;
		$data['supply_id'] = $supply_id;
		$num += 0;
		$sum += 0;
		$data['num'] = round($num,2);
		$data['sum'] = round($sum,2);
		$data['beizhu'] = $beizhu;
		$data['pid'] = $order_id;
		$data['add_time'] =  date('Y-m-d H:i:s',strtotime($add_time));
		$data['insert_time'] =  date('Y-m-d H:i:s',time());
		$data['a_sn'] = $this->get_pay_sn($style);
		$data['origin'] = 1;
		if($style == 2){
			$data['type'] = 2;
		}

		$a_id = Db::name('arap')->insertGetId($data);

		if($a_id){
			foreach($m_info as $k=>$v){
				$info['a_id'] = $a_id;
				$info['m_id'] = $v[0];
				$v[1] += 0;
				$info['num'] = $v[1];
				if($v[2]){
					$v[2] += 0;
					$info['price'] = round($v[2],2);
				}else{
				 	$info['price'] = 0;
				}

				if($v[3]){
					$v[3] += 0;
					$info['sum'] = round($v[3],2);
				}else{
				 	$info['sum'] = 0;
				}
				$re = Db::name('arap_detail')->insert($info);
			}
			if($style == 1){
				Db::name('pur_order')->where('order_id',$order_id)->setField('next_t',2);
			}else{
				Db::name('pur_order')->where('order_id',$order_id)->setField('next_f',2);
			}
			return json(['status'=>1,'msg'=>'添加成功']);
		}else{
			return json(['status'=>0,'msg'=>'添加失败']);
		}
	}	

	//采购报表
	public function order_form(){

		$start = request()->param('start');
		$end = request()->param('end');
		$m_name= request()->param('m_name');
		$cate_name = request()->param('cat_name');
		$worker_name = request()->param('worker_name');
		$group_name = request()->param('group_name');
		$supply_name = request()->param('supply_name');

		if($m_name){

			$con['m.m_name'] = array('like','%'.trim($m_name).'%');
		}
		if($cate_name){

			$con['c.cat_name'] = array('like','%'.trim($cate_name).'%');
		}
		if($worker_name){

			$con['w.worker_name'] = array('like','%'.trim($worker_name).'%');
		}

		if($group_name){

			$con['g.group_name'] = array('like','%'.trim($group_name).'%');
		}

		if($supply_name){

			$con['s.supply_name'] = array('like','%'.trim($supply_name).'%');
		}

		if($start){

			$con['p.add_time'] = array('egt',date('Y-m-d 00:00:00',strtotime($start)));
		}

		if($end){

			$con['p.add_time'] = array('elt',date('Y-m-d 24:00:00',strtotime($end)));
		}

		if($start && $end){

			$con['p.add_time'] = array(['egt',date('Y-m-d 00:00:00',strtotime($start))],['elt',date('Y-m-d 24:00:00',strtotime($end))]);
		}
		$con['p.status'] = 2;
		$data = Db::name('pur_order p')
			->join('supply s','p.supply_id = s.supply_id')
			->join('group g','p.group_id = g.group_id')
			->join('worker w','p.worker_id = w.worker_id')
			->join('pur_detail d','p.order_id = d.order_id')
			->join('materiel m','d.m_id = m.m_id')
			->join('materiel_category c','m.cat_id = c.cat_id')
			->where($con)
			->group('p.supply_id,d.m_id')
			->order('p.supply_id asc')
			->order('p.add_time desc')
			->field('s.supply_name,g.group_name,w.worker_name,d.m_id,m.m_name,m.unit,m.m_desc,c.cat_name,c.pid,group_concat(p.order_id) as ids')
			->paginate(8);

		$page = $data->render();
        $list = $data->items();        
        $jsonStr = json_encode($data);
        $info = json_decode($jsonStr,true);
        $pages = $info['last_page']; 
        $page_list = array();
        $page_list['page'] = $page;
        $page_list['pages'] = $pages;
	    if($info['data']){
	    	foreach($info['data'] as $k=>$v){
	    		$arr = explode(',',$v['ids']);
	    		$arr1 = array_unique($arr);
	    		$str = implode(',',$arr1);
	    		$num1 = Db::name('pur_detail d')->join('pur_order p','d.order_id = p.order_id')->field('sum(d.num) as m_num,avg(price) as price,sum(m_sum) as m_sum')->where(['p.type'=>1,'d.m_id'=>$v['m_id']])->where('d.order_id','in',$str)->find();
	    		$num2 = Db::name('pur_detail d')->join('pur_order p','d.order_id = p.order_id')->field('sum(d.num) as m_num,sum(m_sum) as m_sum,avg(price) as price')->where(['p.type'=>2,'d.m_id'=>$v['m_id']])->where('d.order_id','in',$str)->find();
	
				$info['data'][$k]['num'] = $num1['m_num'] ? $num1['m_num'] : 0;
				$info['data'][$k]['sum'] = $num1['m_sum'] ? $num1['m_sum'] : 0;
				$info['data'][$k]['b_num'] = $num2['m_num'] ? $num2['m_num'] : 0;
				$info['data'][$k]['b_sum'] = $num2['m_sum'] ? $num2['m_sum'] : 0;
		
				$info['data'][$k]['r_num'] = 0;
				$info['data'][$k]['r_sum'] = 0;
				$p = 0;
				$i = 0; 
				foreach($arr1 as $k1=>$v1){
					$insert = Db::name('ck_insert')->where(['tb_id'=>$v1,'is_checked'=>1,'type'=>16,'cat_child_id '=>$v['m_id']])->field('cat_child_id as m_id,sum(num) as m_num,tbd_id')->select();
					$pri = Db::name('pur_detail')->where('order_id',$v1)->where('m_id',$v['m_id'])->field('avg(price) as price')->find();
					$pr = $pri['price'];
					$p += $pr;
					$i++;
					foreach($insert as $k2=>$v2){
						$info['data'][$k]['r_num'] += $v2['m_num'] * $pr;
						$info['data'][$k]['r_sum'] += $v2['m_num'];
					}
				}
				if($i){
					$avg = $p/$i;
				}else{
					$avg = 0;
				}
				$price = 0;
				$j = 0;
				if($num1['price']){
					$price += $num1['price'];
					$j++;
				}
				if($num2['price']){
					$price += $num2['price'];
					$j++;
				}
				if($avg){
					$price += $avg;
					$j++;
				}
				if($j == 1){
					$info['data'][$k]['price'] = $price/1;
				}elseif($j == 2){
					$info['data'][$k]['price'] = $price/2;
				}elseif($j == 3){
					$info['data'][$k]['price'] = $price/3;
				}

				if($v['pid'] != 0){
					$cat_name = Db::name('materiel_category')->where('cat_id',$v['pid'])->value('cat_name');
					$info['data'][$k]['cat_name'] = $cat_name.' '.$v['cat_name'];
				}else{
					$info['data'][$k]['cat_name'] = $v['cat_name'];
				}
	    	}
	    }else{
	    	$info['data'] = array();
	    }
	    $data1 = Db::name('pur_order p')
			->join('supply s','p.supply_id = s.supply_id')
			->join('group g','p.group_id = g.group_id')
			->join('worker w','p.worker_id = w.worker_id')
			->join('pur_detail d','p.order_id = d.order_id')
			->join('materiel m','d.m_id = m.m_id')
			->join('materiel_category c','m.cat_id = c.cat_id')
			->where($con)
			->group('p.supply_id,d.m_id')
			->order('p.supply_id asc')
			->order('p.insert_time desc')
			->field('s.supply_name,g.group_name,w.worker_name,d.m_id,m.m_name,m.unit,m.m_desc,c.cat_name,c.pid,group_concat(p.order_id) as ids')
			->select();
        $zs = array();
        $zs['snum'] = 0;
		$zs['ssum'] = 0; 
		$zs['sb_num'] = 0;
		$zs['sb_sum'] = 0;  
		$zs['sr_num'] = 0;
		$zs['sr_sum'] = 0; 
	    if($data1){
	    	foreach($data1 as $k=>$v){
	    		$arr = explode(',',$v['ids']);
	    		$arr1 = array_unique($arr);
	    		$str = implode(',',$arr1);
	    		$num1 = Db::name('pur_detail d')->join('pur_order p','d.order_id = p.order_id')->field('sum(d.num) as m_num,avg(price) as price,sum(m_sum) as m_sum')->where(['p.type'=>1,'d.m_id'=>$v['m_id']])->where('d.order_id','in',$str)->find();
	    		$num2 = Db::name('pur_detail d')->join('pur_order p','d.order_id = p.order_id')->field('sum(d.num) as m_num,sum(m_sum) as m_sum,avg(price) as price')->where(['p.type'=>2,'d.m_id'=>$v['m_id']])->where('d.order_id','in',$str)->find();

	    		$data1[$k]['num'] = $num1['m_num'] ? $num1['m_num'] : 0;
				$data1[$k]['sum'] = $num1['m_sum'] ? $num1['m_sum'] : 0;
				$data1[$k]['b_num'] = $num2['m_num'] ? $num2['m_num'] : 0;
				$data1[$k]['b_sum'] = $num2['m_sum'] ? $num2['m_sum'] : 0;	
				$data1[$k]['r_num'] = 0;
				$data1[$k]['r_sum'] = 0;
				$p = 0;
				$i = 0; 
				foreach($arr1 as $k1=>$v1){
					$insert = Db::name('ck_insert')->where(['tb_id'=>$v1,'is_checked'=>1,'type'=>16,'cat_child_id '=>$v['m_id']])->field('cat_child_id as m_id,sum(num) as m_num,tbd_id')->select();
					$pri = Db::name('pur_detail')->where('order_id',$v1)->where('m_id',$v['m_id'])->field('avg(price) as price')->find();
					$pr = $pri['price'];
					$p += $pr;
					$i++;
					foreach($insert as $k2=>$v2){
	    				$data1[$k]['r_num'] += $v2['m_num'] * $pr;					
	    				$data1[$k]['r_sum'] += $v2['m_num'];
					}
				}
				if($i){
					$avg = $p/$i;
				}else{
					$avg = 0;
				}
				$price = 0;
				$j = 0;
				if($num1['price']){
					$price += $num1['price'];
					$j++;
				}
				if($num2['price']){
					$price += $num2['price'];
					$j++;
				}
				if($avg){
					$price += $avg;
					$j++;
				}
				if($j == 1){
					$data1[$k]['price'] = $price/1;
				}elseif($j == 2){
					$data1[$k]['price'] = $price/2;
				}elseif($j == 3){
					$data1[$k]['price'] = $price/3;
				}
				$zs['snum'] += $data1[$k]['num'];
				$zs['ssum'] += $data1[$k]['sum']; 
				$zs['sb_num'] += $data1[$k]['b_num'];
				$zs['sb_sum'] += $data1[$k]['b_sum'];  
				$zs['sr_num'] += $data1[$k]['r_num'];
				$zs['sr_sum'] += $data1[$k]['r_sum']; 
	    	} 
	    }

		return json(['status'=>1,'msg'=>'查询成功','total'=>$page_list,'data'=>$info['data'],'zs'=>$zs]);
	}


	//采购入库审核
	public function ck_insert(){
		$str = $this->request->param('str');
		if(!$str){
			return json(['status'=>0,'msg'=>'采购入库id为空']);
		}
		$arr = array();
		$arr = explode(',',$str);
		foreach($arr as $k=>$v){
			$insert_info =  Db::name("ck_insert")->where('insert_id = '.$v)->field('cat_child_name,cat_child_id,insert_id,num')->find();
			if($insert_info){
				$re_info =  Db::name("ck_insert")->where("insert_id=".$v)->update(array('status'=>1));
			}
		}
		if($re_info){
			return json(['status' => 1,'msg' => "审核成功"]);
		}else{
			return json(['status' => 0,'msg' => "审核失败"]);
		}
	}
	//采购入库审核
	public function ck_insert_end(){
		$str = $this->request->param('str');
		if(!$str){
			return json(['status'=>0,'msg'=>'采购入库id为空']);
		}
		$arr = array();
		$arr = explode(',',$str);
		foreach($arr as $k=>$v){
			$insert_info =  Db::name("ck_insert")->where('insert_id = '.$v)->field('is_checked,cat_child_id,insert_id,num')->find();		
			if($insert_info){
				if($insert_info['is_checked']=='1'){
					return json(['status' => 0,'msg' => "数据已操作"]);
				}
				$return_info =  Db::name("materiel")->where("m_id = ".$insert_info['cat_child_id'])->setInc('num',$insert_info["num"]);	
				if($return_info ){
					$re_info =  Db::name("ck_insert")->where("insert_id=".$v)->update(array('is_checked'=>1));
					return json(['status' => 1,'msg' => "入库成功"]);
				}else{
					return json(['status' => 0,'msg' => "入库失败"]);
				}
				
			}else{
				return json(['status' => 0,'msg' => "查询数据失败"]);
			}
		}	
	}
	//获取采购订单编号
	private function get_order_sn($style){

		//$shijian = date('Ymd');//当天时间
		$shijian = date('Ymd');
		$start = date('Y-m-d 00:00:00',time());
		$end = date('Y-m-d 24:00:00',time());
		$con['insert_time'] = array(['egt',$start],['elt',$end]);

		if($style == 1){
			$con['type'] = 1;
		}else{
			$con['type'] = 2;
		}
		$order_sn = Db::name('pur_order')->where($con)->column('order_sn');
		$number = Db::name('pur_order')->where($con)->count();
		if($order_sn){
			$arr = array();
	        foreach($order_sn as $k=>$v){
	        	if($style == 1){
	           		$arr[] = (int)substr($v,10);  
	           	}else{
	           		$arr[] = (int)substr($v,12);
	           	}
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
		if($style == 1){
			$pcs_no = 'CG'.$shijian.$numbered;
		}else{
			$pcs_no = 'CGTL'.$shijian.$numbered;
		}
		return $pcs_no;
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

	//获取应付单编号
	private function get_pay_sn($style){

		$shijian = date('Ymd');//当天时间
		$start = date('Y-m-d 00:00:00',time());
		$end = date('Y-m-d 24:00:00',time());
		$con['insert_time'] = array(['egt',$start],['elt',$end]);

		if($style == 1){
			$con['type'] = 1;
		}else{
			$con['type'] = 2;
		}
		$a_sn = Db::name('arap')->where($con)->column('a_sn');

		$number = Db::name('arap')->where($con)->count();

		if($a_sn){
			$arr = array();
	        foreach($a_sn as $k=>$v){
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
		if($style == 1){
			$a_no = 'AP'.$shijian.$numbered;
		}else{
			$a_no = 'AR'.$shijian.$numbered;
		}

		return $a_no;
	}
}