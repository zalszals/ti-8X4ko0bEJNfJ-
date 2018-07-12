<?php
namespace app\product\controller;
use app\base\controller\Base;
use think\Db;

class WorkerManageNew extends Base{
	/**
	 * [1 worker_manage_list 工人管理列表(此接口不需要分页)]
	 * @param post传参 
	 * @return [type] status 状态值 msg 返回信息 data 返回数据
	 */
	public function worker_manage_list(){
		//获取变量
		$mark = $this->request->param('mark');
		$sort = $this->request->param('sort');
		//$page = $this->request->param('page');
		$worker = $this->worker;
		$group_id = $worker['group_id'];
		$worker_id = $worker['worker_id'];
		$worker_code = $worker['worker_code'];
		$row = 3;
		//验证变量
		
		/* if($page==1||!$page){
			$page=0;
		}else{
			$page = ($page-1)*$row;
		} */
		
		if(!$sort){
			$sort=1;
		}
		
		
		$where_son = '';		
		switch($mark){
			case 1:
				$start_time = date('Y-m-01',time());
				$end_time = date('Y-m-d',strtotime("$start_time +1 month -1 day"));
				//$con['check_time'] = array(['egt',$start_time],['elt',$end_time],'and');
				$where_son .= "and (wj.work_date between '{$start_time}' and '{$end_time}') and wj.status = 3 ";
				break;
			case 2:
				$start_time = date('Y-m-d',strtotime(date('Y-m-d').'-1 week Monday'));
				$end_time = date('Y-m-d',strtotime($start_time.'+6 day'));
				//$con['check_time'] = array(['egt',$start_time],['elt',$end_time],'and');
				$where_son .= "and (wj.work_date between '{$start_time}' and '{$end_time}') and wj.status = 3 ";
				break;	
		}
		
		$sorce_sql = "select avg(score) from mf_pro_worker_job wj where wj.worker_id = w.worker_id {$where_son}";
		
		$sql  = "select w.worker_name,w.worker_id,w.sex,r.role_name,w1.worker_name as p_name,r1.role_name as p_role_name,({$sorce_sql}) as score from mf_worker w ";
		$sql .= "inner join mf_worker w1 on w1.worker_id = w.pid ";
		$sql .= "inner join mf_role r on r.role_id = w.role_id ";		
		$sql .= "inner join mf_role r1 on r1.role_id = w1.role_id ";
		
		$where = '';
		if($group_id != 1){
			$where = "find_in_set({$worker_code},w.worker_code) and w.group_id = {$group_id} and wj.status = 3 and w.status = 1 ";
		}else{
			$where = " where w.status = 1 ";
		}	
		
		switch($sort){
			case 1:
				$order = 'order by score desc';
				$sql .= $where.$order;
				$arrayInfo = Db::query($sql);
				//$name_array = array();
				foreach($arrayInfo as $k => $row){
					if($row['sex'] == 0){
						$arrayInfo[$k]['sex'] = '女';
					}else{
						$arrayInfo[$k]['sex'] = '男';
					}
					
					if(!$row['score']){
						unset($arrayInfo[$k]);	
					}
				}
				$arr2=array();    
				foreach($arrayInfo as $key=>$value){
					$arr2[] = $value;
				}
				break;
			case 2:
				$order = 'order by score';
				$sql .= $where.$order;
				$arrayInfo = Db::query($sql);
				//$name_array = array();
				foreach($arrayInfo as $k => $row){
					if($row['sex'] == 0){
						$arrayInfo[$k]['sex'] = '女';
					}else{
						$arrayInfo[$k]['sex'] = '男';
					}
					
					if(!$row['score']){
						unset($arrayInfo[$k]);	
					}
				}
				$arr2=array();    
				foreach($arrayInfo as $key=>$value){
					$arr2[] = $value;
				}
				break;
			case 3:
				$sql .= $where;
				$arrayInfo = Db::query($sql);
				$name_array = array();
				foreach($arrayInfo as $k => $row){
					if(!$row['score']){
						unset($arrayInfo[$k]);	
					}
					if($row['score']){
						$name = $row['worker_name'];
						$char = $this->getFirstCharter($name); 
						$name_array[$char][] = $row;
					} 
				}
				ksort($name_array);
				$arrayInfo = $name_array;
				$arr2=array();    
				foreach($arrayInfo as $key=>$value){
					foreach($value as $k2=>$v2){
						if($v2['sex'] == 0){
							$v2['sex'] = '女';
						}else{
							$v2['sex'] = '男';
						}
						$arr2[] = $v2;
					}
				}
				//dump($arr2);die;
		}
		
		$total = count($arrayInfo);
		$re['status'] = 1;
		$re['msg'] = '获取成功';
		$re['total'] = $total;
		$re['data'] = $arr2;
		
		ajaxReturnJson($re);	
	}
	
	/**
	 * [2 getFirstCharter 获取姓氏首字母]
	 * @param 参数 姓名字符串
	 * @return [type] return返回数据
	 */
	public function getFirstCharter($str){ 
		if(empty($str)){return '';} 
		$fchar=ord($str{0}); 
		if($fchar>=ord('A')&&$fchar<=ord('z')) return strtoupper($str{0}); 
		$s1=iconv('UTF-8','gb2312',$str); 
		$s2=iconv('gb2312','UTF-8',$s1); 
		$s=$s2==$str?$s1:$str; 
		$asc=ord($s{0})*256+ord($s{1})-65536; 
		if($asc>=-20319&&$asc<=-20284) return 'A'; 
		if($asc>=-20283&&$asc<=-19776) return 'B'; 
		if($asc>=-19775&&$asc<=-19219) return 'C'; 
		if($asc>=-19218&&$asc<=-18711) return 'D'; 
		if($asc>=-18710&&$asc<=-18527) return 'E'; 
		if($asc>=-18526&&$asc<=-18240) return 'F'; 
		if($asc>=-18239&&$asc<=-17923) return 'G'; 
		if($asc>=-17922&&$asc<=-17418) return 'H'; 
		if($asc>=-17417&&$asc<=-16475) return 'J'; 
		if($asc>=-16474&&$asc<=-16213) return 'K'; 
		if($asc>=-16212&&$asc<=-15641) return 'L'; 
		if($asc>=-15640&&$asc<=-15166) return 'M'; 
		if($asc>=-15165&&$asc<=-14923) return 'N'; 
		if($asc>=-14922&&$asc<=-14915) return 'O'; 
		if($asc>=-14914&&$asc<=-14631) return 'P'; 
		if($asc>=-14630&&$asc<=-14150) return 'Q'; 
		if($asc>=-14149&&$asc<=-14091) return 'R'; 
		if($asc>=-14090&&$asc<=-13319) return 'S'; 
		if($asc>=-13318&&$asc<=-12839) return 'T'; 
		if($asc>=-12838&&$asc<=-12557) return 'W'; 
		if($asc>=-12556&&$asc<=-11848) return 'X'; 
		if($asc>=-11847&&$asc<=-11056) return 'Y'; 
		if($asc>=-11055&&$asc<=-10247) return 'Z'; 
		return null; 
	}
	/**
	* [3 worker_old_list 工人历史工单列表]
	* @param post传参 worker_id 工人id
	* @return [type] status 状态值 msg 返回信息 data 返回数据
	*/
	public function worker_old_list(){
		//获取变量
		$worker_id = $this->request->param('worker_id');
		//验证变量
		if(!$worker_id){
			$result['status'] = 0;
			$result['msg'] = "工人编号为空";
			ajaxReturnJson($result);
		}
		//程序主体
		$con1['wj.worker_id'] = $worker_id;
		$con1['wj.status'] = 3;
		
		$field[] = 'wj.worker_id';
		$field[] = 'wj.gd_id';
		$field[] = 'wj.work_date';
		$field[] = 'wj.require_time_1';
		$field[] = 'wj.require_time_2';
		$field[] = 'wj.num';
		$field[] = 'wj.unit';
		$field[] = 'wj.real_num';
		$field[] = 'wj.status';
		$field[] = 'wj.check_time';
		$field[] = 'wj.s_time';
		$field[] = 'wj.e_time';
		$field[] = 'wj.score';
		$field[] = 'wj.photo';
		$field[] = 'ws.skill_name';
		$field[] = 'ga.area_name';
		$field[] = 'w1.worker_name as check_worker_name';
		$field[] = 'r.role_name';
		$field[] = 'w.worker_name as wname';
		
		
		$wj_list = Db::name('pro_worker_job wj')
				->field(implode(',',$field))
				->join('work_skill ws','ws.skill_id = wj.skill_id')
				->join('grow_area ga','ga.area_id = wj.area_id')
				->join('worker w','w.worker_id = wj.worker_id')
				->join('worker w1','w1.worker_id = wj.check_worker_id')
				->join('role r','r.role_id = w1.role_id')
				->where($con1)
				->select();
				
		if($wj_list){
			foreach($wj_list as $k=>$v){
				$photo = explode(',',$v['photo']);
				$wj_list[$k]['photo'] = $photo;
			}
			$data['worker_id'] = $v['worker_id'];
			$data['worker_name'] = $v['wname'];
			$data['info'] = $wj_list;
			$data1[] = $data;
			$result['status'] = 1;
			$result['msg'] = "获取成功";
			$result['data'] = $data1;
			ajaxReturnJson($result);
		}else{
			$data1 = array();
			$result['status'] = 1;
			$result['msg'] = "暂无数据";
			$result['data'] = array();
			ajaxReturnJson($result);
		}
	}
	









	
}