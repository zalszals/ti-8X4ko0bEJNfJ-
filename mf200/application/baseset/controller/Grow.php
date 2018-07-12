<?php
/**
 * 种植管理
 */
namespace app\baseset\controller;
use app\base\controller\Base;
use think\Loader;

class Grow extends Base {
	
	public function info() {
		
		$modeId	= trim(request()->param('mode_id'));
		
		if (!is_numeric($modeId)) return json(['status' => 0, 'msg' => '参数错误']);
		
		$growMode	= Loader::model('GrowMode');
		
		if (!$growMode->get(['mode_id' => $modeId])) return json(['status' => 0, 'msg' => '该种植模式不存在']);
		
		$result	= $growMode->getModeById($modeId);
		return ($result) ? json(['status' => 1, 'data' => $result]) : json(['status' => 0, 'msg' => '获取失败']);
	} 
	
	/**
	 * 种植列表
	 * @return json
	 */
	public function lists() {
		
		$growMode	= Loader::model('GrowMode');
		$results	= $growMode->getAllModes();
		
		return json(['status' => 1, 'data' => $results]);
	}
	
	/**
	 * 添加种植模式
	 */
	public function add() {
		
		$modeName	= trim(request()->param('mode_name'));
		
		if ($modeName) {
			
			$growMode	= Loader::model('GrowMode');
			$result		= $growMode->get(['mode_name' => $modeName, 'status' => 1]);
			
			if ($result) return json(['status' => 0, 'msg' => '该种植模式已存在']);
			
			$growMode->data(['mode_name' => $modeName]);
			$insertId	= $growMode->save();
			
			return ($insertId) ? json(['status' => 1, 'msg' => '添加成功']) : json(['status' => 0, 'msg' => '添加失败']);
		}
	}
	
	/**
	 * 删除种植模式
	 */
	public function del() {
		
		$modeId	= trim(request()->param('mode_id'));
		
		if (!is_numeric($modeId)) return json(['status' => 0, 'msg' => '参数错误']);
		
		$growMode	= Loader::model('GrowMode');
		$result		= $growMode->get(['mode_id' => $modeId, 'status' => 1]);
		
		if (empty($result)) return json(['status' => 0, 'msg' => '该种植模式不存在']);
		
		$growMode->save(['status' => 0], ['mode_id' => $modeId]);
		
		return json(['status' => 1, 'msg' => '删除成功']);
	}
	
	/*
	 * 编辑种植模式
	 */
	public function edit() {
		
		$modeId		= trim(request()->param('mode_id'));
		$modeName	= trim(request()->param('mode_name'));
		
		if (!is_numeric($modeId) || !$modeName) return json(['status' => 0, 'msg' => '参数错误']);
		
		$growMode	= Loader::model('GrowMode');
		
		if (!$growMode->get(['mode_id' => $modeId, 'status' => 1])) return json(['status' => 0, 'msg' => '该种植模式不存在']);
		if ($growMode->get(['mode_name' => $modeName])) return json(['status' => 0, 'msg' => '名称被占用，请换个名字']);
		
		$growMode->save(['mode_name' => $modeName], ['mode_id' => $modeId]);
		
		return json(['status' => 1, 'msg' => '修改成功']);
	}
}