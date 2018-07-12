<?php
/**
 * 种植区域管理
 */
namespace app\baseset\controller;
use app\base\controller\Base;
use think\Loader;

class GrowArea extends Base {
	
	private $growAreaModel;
	
	public function _initialize() {
		
		$this->growAreaModel = Loader::model('GrowArea');
	}
	
	/**
	 * 添加种植区域
	 */
	public function add() {
		
		$areaName	= trim(request()->param('area_name'));
		$areaNum	= trim(request()->param('area_num'));
		$gTypeId	= trim(request()->param('g_type_id'));
		
		if (!$areaNum || !$areaName || !is_numeric($gTypeId)) return json(['status' => 0, 'msg' => '参数错误']);
		
		if ($this->growAreaModel->get(['area_name' => $areaName, 'status' => 1])) {
			
			return json(['status' => 0, 'msg' => '该种植区域已存在']);
		}
		
		$this->growAreaModel->data(['area_name' => $areaName, 'area_num' => $areaNum, 'g_type_id' => $gTypeId]);
		$this->growAreaModel->save();
		
		return json(['status' => 1, 'msg' => '添加成功']);
	}
	
	/**
	 * 删除种植区域
	 */
	public function del() {
		
		$areaId	= trim(request()->param('area_id'));
		
		$result	= $this->growAreaModel->getGrowAreaById($areaId);
		
		if (empty($result)) return json(['status' => 0, 'msg' => '该种植区域不存在']);
		
		$this->growAreaModel->save(['status' => 0], ['area_id' => $areaId]);
		
		return json(['status' => 1, 'msg' => '删除成功']);
	}
	
	/**
	 * 编辑种植区域
	 */
	public function edit() {
		
		$areaId		= trim(request()->param('area_id'));
		$areaName	= trim(request()->param('area_name'));
		$areaNum	= trim(request()->param('area_num'));
		
		if (!is_numeric($areaId)) return json(['status' => 0, 'msg' => '参数错误']);
		
		$areaInfo	= $this->growAreaModel->getGrowAreaById($areaId);
		if (!$areaInfo) return json(['status' => 0, 'msg' => '该种植区域不存在']);
		
		if (!$areaName && !$areaNum) {
			
			return json(['status' => 1, 'data' => $areaInfo]);
		} else {
			
			$data	= [];
			
			if ($areaName && !$areaNum) {
				
				$data['area_name'] = $areaName;
			} elseif (!$areaName && $areaNum) {
				
				$data['area_num'] = $areaNum;
			} else {
				$data['area_name'] = $areaName;
				$data['area_num'] = $areaNum;
			}
			
			if (!empty($data)) {
				
				$this->growAreaModel->save($data, ['area_id' => $areaId]);
				
				return json(['status' => 1, 'msg' => '修改成功']);
			}
		}
	}
	
	/**
	 * 种植区域列表
	 */
	public function lists() {
		
		$growTypeModel	= Loader::model('GrowType');
		$growAreaModel	= Loader::model('GrowArea');
		
		$types	= $growTypeModel->getAllType();
		
		foreach ($types as $value) {
			
			$gTypeId	= $value['id'];
			
			if ($growAreaModel->get(['g_type_id' => $gTypeId])) {
				
				$growAreas	= $growAreaModel->getListsByGTypeId($gTypeId);
				
				$data['id']			= $gTypeId;
				$data['type_name']	= $value['type_name'];
				$data['child']		= [];
				
				foreach ($growAreas as $val) {
					
					$arr['area_id']		= $val['area_id'];
					$arr['area_name']	= $val['area_name'];
					$arr['area_num']	= $val['area_num'];
					
					$data['child'][]	= $arr;
				}
				
			} else {
				
				$data['id']			= $gTypeId;
				$data['type_name']	= $value['type_name'];
				$data['child']		= [];
			}
			
			$results[]	= $data;
		}
		
		if (!isset($results)) {
			
			return json(['status' => 1, 'total' => 0, 'data' => array()]);
		}
		
		return json(['status' => 1, 'total' => count($results), 'data' => $results]);
	}
}
