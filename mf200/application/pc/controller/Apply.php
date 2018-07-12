<?php
namespace app\pc\controller;

use app\base\controller\Base;
use think\Db;
use think\Request;

class Apply extends Base{

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

	//采购申请单物料信息
	public function add_msg(){

		$cat_id = request()->param('cat_id');

		if(!$cat_id){

			return json(['status'=>0,'msg'=>'请选择物料分类']);
		}


		$con['status'] = 1;

		$con['cat_id'] = $cat_id;	
		$materiel = Db::name('materiel')->where($con)->field('m_id,m_name,m_no,m_desc,unit')->select();


		if($materiel){

			return json(['status'=>1,'msg'=>'查询成功','data'=>$materiel]);	
		}else{

			return json(['status'=>1,'msg'=>'查询成功','data'=>array()]);
		}
				
	}
	//采购申请单物料信息
	public function add_msgt(){
		$m_id = request()->param('m_id');
		if(!$m_id){
			return json(['status'=>0,'msg'=>'请选择物料']);
		}
		$con['m_id'] = $m_id;
		$materiel = Db::name('materiel')->where($con)->field('m_id,m_name,m_no,m_desc,unit')->find();
		if($materiel){

			return json(['status'=>1,'msg'=>'查询成功','data'=>$materiel]);	
		}else{

			return json(['status'=>1,'msg'=>'查询成功','data'=>array()]);
		}
	}

	//采购申请单添加界面
	public function add(){
		$data['worker_id'] = $this->worker['worker_id'];
		$data['worker_name'] = $this->worker['worker_name'];
		$data['group_id'] = $this->worker['group_id'];
		$data['group_name'] = $this->worker['group_name'];
		$data['cate'] = $this->add_cate();
		return json(['status'=>1,'msg'=>'查询成功','data'=>$data]);
	}
	//添加采购申请单
	public function apply_add(){

		$m_id = request()->param('m_id');
		$num = request()->param('num');
		$beizhu = request()->param('beizhu');
		$add_time = request()->param('add_time');

		$mid = explode(',',$m_id);
		$mnum = explode(',',$num);
		$m_info = array();
		foreach($mid as $k=>$v){
			$m_info[$k][0] = $mid[$k];
			$m_info[$k][1] = $mnum[$k];
		}

		if(!$add_time){

			return json(['status'=>0,'msg'=>'请选择日期']);
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
		}

		$worker = $this->worker;

		$data['worker_id'] = $worker['worker_id'];
		$data['pcs_no'] = $this->get_pcs_sn();
		$data['add_time'] = date('Y-m-d H:i:s',strtotime($add_time));
		$data['insert_time'] = date('Y-m-d H:i:s',time());
		$data['status'] = 1;
		$data['beizhu'] = trim($beizhu);

		$pcs_id = Db::name('apply_pcs')->insertGetId($data);

		if($pcs_id){ 

			foreach($m_info as $k=>$v){

				$info['m_id'] = $v[0];
				$v[1] += 0;
				$info['num'] = $v[1];
				if(!$info['num']){
					$info['num'] = 0;
				}
				$info['pcs_id'] = $pcs_id;
				$re = Db::name('apply_pcs_detail')->insert($info);
				
				if(!$re){

					Db::name('apply_pcs')->where('pcs_id',$pcs_id)->delete();

					Db::name('apply_pcs_detail')->where('pcs_id',$pcs_id)->delete();

					return json(['status'=>0,'msg'=>'添加失败']);
				}
			}
            
           	return json(['status'=>1,'msg'=>'添加成功']);

        }else{

            return json(['status'=>0,'msg'=>'添加失败']);
        }
	}

	//采购申请单列表
	public function apply(){

		$type = request()->param('type');
		$worker_name = request()->param('worker_name');
		$start = request()->param('start');
		$end = request()->param('end');
		$sn = request()->param('sn');
		$page = request()->param('page');

		$worker = $this->worker;
		$worker_id = $worker['worker_id'];
		$group_id = $worker['group_id'];
		$node_str = $worker['node_str'];

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

		if($sn){

			$con['a.pcs_no'] = array('like','%'.trim($sn).'%');
		}

		if($start){

			$con['a.add_time'] = array('egt',date('Y-m-d 00:00:00',strtotime($start)));
		}

		if($end){

			$con['a.add_time'] = array('elt',date('Y-m-d 24:00:00',strtotime($end)));
		}

		if($start && $end){

			$con['a.add_time'] = array(['egt',date('Y-m-d 00:00:00',strtotime($start))],['elt',date('Y-m-d 24:00:00',strtotime($end))]);
		}

		if($type == 1){
			$con['a.status'] = 1;
		}elseif($type == 2){
			$con['a.status'] = array('in','2,4');
		}elseif($type == 3){
			$con['a.status'] = 3;
		}else{
			$con['a.status'] = 2;
		}

		//待完成 需求审核权限，有权限的使用group_id 筛选  没权限用worker_id 筛选
		if($group_id != 1){
			if($type == 4 && $group_id == 5){
			}else{
				if(strpos($node_str,',31') !== false){
					$con['w.group_id'] = $group_id;
				}else{
					$con['a.worker_id'] = $worker_id;
				}
			}
		}

		$data = Db::name('apply_pcs a')
			->join('worker w','a.worker_id = w.worker_id')
			->where($con)
			->order('a.pcs_no desc')
			->field('a.pcs_id,a.pcs_no,a.add_time,a.check_time,a.reason,a.status,w.worker_name')
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
				$arr[$k]['add_time'] = date('Y-m-d',strtotime($arr[$k]['add_time']));
				$arr[$k]['check_time'] = date('Y-m-d H:i',strtotime($arr[$k]['check_time']));
			}
        }	
		
		if($arr){
			return json(['status'=>1,'msg'=>'查询成功','total'=>$page_list,'data'=>$arr]);
		}else{
			return json(['status'=>1,'msg'=>'查询成功','total'=>$page_list,'data'=>array()]);
		}
	}

	//采购申请单详情
	public function apply_list(){

		$pcs_id = request()->param('pcs_id');

		if(!$pcs_id){

			return json(['status'=>0,'msg'=>'申请采购id有误']);
		}
		$list = Db::name('apply_pcs a')
			->join('worker w','a.worker_id = w.worker_id')
			->join('group p','p.group_id = w.group_id')
			->where('pcs_id',$pcs_id)
			->field('a.pcs_id,a.pcs_no,a.add_time,a.check_time,a.reason,a.status,w.worker_name,p.group_name,a.beizhu,a.check_worker_id')
			->find();
		$str = '';
		$str = str_replace(':null', ':""', json_encode($list));
		$arr = json_decode($str,'true');
		$arr['add_time'] = date('Y-m-d',strtotime($arr['add_time']));
		if($arr['check_time']){
			$arr['check_time'] = date('Y-m-d H:i',strtotime($arr['check_time']));
		}
		if($arr['check_worker_id']){
			$arr['check_name'] = Db::name('worker')->where('worker_id',$arr['check_worker_id'])->value('worker_name');
		}else{
			$arr['check_name'] = '';
		}
		$arr['cate'] = $this->add_cate();
		$data = Db::name('apply_pcs_detail')->where('pcs_id',$pcs_id)->select();

		if($data){

			foreach($data as $k=>$v){

				$m = Db::name('materiel')->where('m_id',$v['m_id'])->field('m_name,cat_id,m_no,m_desc,unit')->find();

				$cat_name = Db::name('materiel_category')->where('cat_id',$m['cat_id'])->value('cat_name');
				$pid = Db::name('materiel_category')->where('cat_id',$m['cat_id'])->value('pid');
				
				$data[$k]['m_name'] = $m['m_name'];
				$data[$k]['cat_id'] = $m['cat_id'];
				$data[$k]['m_no'] = $m['m_no'];
				$data[$k]['m_desc'] = $m['m_desc'];
				$data[$k]['unit'] = $m['unit'];
				if($pid != 0){
					$cate = Db::name('materiel_category')->where('cat_id',$pid)->value('cat_name');
					$data[$k]['cat_name'] = $cate.' '.$cat_name;
				}else{
					$data[$k]['cat_name'] = $cat_name;
				}				
			}

			return json(['status'=>1,'msg'=>'查询成功','list'=>$arr,'data'=>$data]);
		}else{

			return json(['status'=>1,'msg'=>'查询成功','data'=>array()]);
		}
	}

	//编辑采购申请单
	public function apply_edit(){

		$pcs_id = request()->param('pcs_id');
		$pad_id = request()->param('pad_id');
		$m_id = request()->param('m_id');
		$num = request()->param('num');
		$beizhu = request()->param('beizhu');
		$add_time = request()->param('add_time');
		$padid = explode(',',$pad_id);
		$mid = explode(',',$m_id);
		$mnum = explode(',',$num);
		$m_info = array();
		foreach($mid as $k=>$v){
			$m_info[$k][0] = $padid[$k];
			$m_info[$k][1] = $mid[$k];
			$m_info[$k][2] = $mnum[$k];
		}
		
		if(!$m_info){

			return json(['status'=>0,'msg'=>'请完善物料信息']);
		}

		if(!$add_time){

			return json(['status'=>0,'msg'=>'请选择日期']);
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
		}

		$pad_id = Db::name('apply_pcs_detail')->where('pcs_id',$pcs_id)->column('pad_id');
		$status = Db::name('apply_pcs')->where('pcs_id',$pcs_id)->value('status');

		if($status == 3){
			$data['check_worker_id'] = null;
			$data['check_time'] = null;
			$data['reason'] = null;
		}

		//$data['add_time'] = date('Y-m-d H:i:s',time());
		$data['status'] = 1;
		$data['beizhu'] = $beizhu;
		$data['add_time'] = date('Y-m-d H:i:s',strtotime($add_time));

		$re = Db::name('apply_pcs')->where('pcs_id',$pcs_id)->update($data);

		if($re !== false){

			$arr = array();
			$diff = array();

			foreach($m_info as $k=>$v){

				$info['m_id'] = $v[1];
				$v[2] += 0;
				$info['num'] = $v[2];
				if(!$info['num']){
					$info['num'] = 0;
				}
				if($v[0]){
					Db::name('apply_pcs_detail')->where('pad_id',$v[0])->update($info);
					$arr[] = $v[0];
				}else{
					$info['pcs_id'] = $pcs_id;
					Db::name('apply_pcs_detail')->insert($info);
				}
			}
			$diff = array_diff($pad_id,$arr);
			foreach($diff as $k=>$v){
				Db::name('apply_pcs_detail')->where('pad_id',$v)->delete();
			}
			return json(['status'=>1,'msg'=>'编辑成功']);
		}else{
			return json(['status'=>0,'msg'=>'编辑失败']);
		}
	
	}

	//删除采购申请单
	public function apply_del(){
		$pcs_id = request()->param('pcs_id');
		if(!$pcs_id){		
			return json(['status'=>0,'msg'=>'采购申请单id有误']);
		}

		$status = Db::name('apply_pcs')->where('pcs_id',$pcs_id)->value('status');

		if($status == 2 || $status == 4){

			return json(['status'=>0,'msg'=>'采购申请单已完成，不允许删除']);
		}

		$re = Db::name('apply_pcs')->where('pcs_id',$pcs_id)->delete();

		if($re){

			$result = Db::name('apply_pcs_detail')->where('pcs_id',$pcs_id)->delete();
			return json(['status'=>1,'msg'=>'删除成功']);
		}else{
			return json(['status'=>0,'msg'=>'删除失败']);
		}
	}

	//退回已审核的采购申请单
	public function apply_back(){
		$pcs_id = request()->param('pcs_id');
		if(!$pcs_id){		
			return json(['status'=>0,'msg'=>'采购申请单id有误']);
		}

		$status = Db::name('apply_pcs')->where('pcs_id',$pcs_id)->value('status');

		if($status == 1 || $status == 3){

			return json(['status'=>0,'msg'=>'采购申请单状态不是已审核，不能退回']);
		}

		if($status == 4){

			return json(['status'=>0,'msg'=>'已制成订单，不允许退回！']);
		}

		$data['status'] = 1;
		$data['check_worker_id'] = null;
		$data['check_time'] = null;
		
		$re = Db::name('apply_pcs')->where('pcs_id',$pcs_id)->update($data);

		if($re !== false){
			return json(['status'=>1,'msg'=>'退还成功']);
		}else{
			return json(['status'=>0,'msg'=>'退还失败']);
		}

	}

	//审核采购申请单
	public function apply_check(){
		$type = request()->param('type');
		$pcs_id = request()->param('pcs_id');
		$reason = request()->param('reason');

		$worker = $this->worker;
		$worker_id = $worker['worker_id'];

		if(!$type){
			return json(['status'=>0,'msg'=>'type值有误']);
		}
		if(!$pcs_id){		
			return json(['status'=>0,'msg'=>'采购申请单id有误']);
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
		$re = Db::name('apply_pcs')->where('pcs_id',$pcs_id)->update($data);

		if($re !== false){
			return json(['status'=>1,'msg'=>'审核成功']);
		}else{
			return json(['status'=>0,'msg'=>'审核失败']);
		}

	}

	//获取采购申请单编号
	private function get_pcs_sn(){

		$shijian = date('Ymd');//当天时间
		$start = date('Y-m-d 00:00:00',time());
		$end = date('Y-m-d 24:00:00',time());
		$con['insert_time'] = array(['egt',$start],['elt',$end]);
		$pcs_no = Db::name('apply_pcs')->where($con)->column('pcs_no');
		$number = Db::name('apply_pcs')->where($con)->count();
		if($pcs_no){
			$arr = array();
	        foreach($pcs_no as $k=>$v){
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

		$pcs_no = 'SG'.$shijian.$numbered;
		return $pcs_no;
	}
}