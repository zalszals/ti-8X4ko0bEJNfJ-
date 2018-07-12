<?php
/**
 * 种植类型
 */
namespace app\baseset\controller;
use app\base\controller\Base;
use think\Loader;

class GrowType extends Base {
	
	private $growTypeModel;
	
	public function _initialize() {
		
		$this->growTypeModel	= Loader::model('GrowType');
	}
	
	/**
	 * 添加
	 */
	public function add() {
		
		$typeName	= trim(request()->param('type_name'));
		
		if (!$typeName) return json(['status' => 0, 'msg' => '参数错误']);
		
		if ($this->growTypeModel->getType(['type_name' => $typeName])) {
			
			return json(['status' => 0, 'msg' => '该种植类型已经存在，请换个名字']);
		}
		
		$this->growTypeModel->data(['type_name' => $typeName]);
		$this->growTypeModel->save();
		
		return json(['status' => 1, 'msg' => '添加成功']);
	}
	
	/**
	 * 列表
	 */
	public function lists() {
		
		$results	= $this->growTypeModel->getAllType();
		
		return json(['status' => 1, 'data' => $results]);
	}
	
	/**
	 * 编辑
	 */
	public function edit() {
		
		$typeId		= trim(request()->param('type_id'));
		$typeName	= trim(request()->param('type_name'));
		
		if (!is_numeric($typeId) || !$typeName) return json(['status' => 0, 'msg' => '参数错误']);
		
		if (in_array($typeId, array(1, 2, 3, 4, 5, 6))) {
			
			return json(['status' => 0, 'msg' => '预设种植类型不允许修改']);
		}
		
		if (!$this->growTypeModel->get(['id' => $typeId])) {
			
			return json(['status' => 0, 'msg' => '该种植类型不存在']);
		}
		
		if ($this->growTypeModel->get(['type_name' => $typeName])) {
			
			return json(['status' => 0, 'msg' => '名称已存在，请换一个']);
		}
		
		$this->growTypeModel->save(['type_name' => $typeName], ['id' => $typeId]);
		return json(['status' => 1, 'msg' => '修改成功']);
	}
	
	/**
	 * 删除
	 */
	public function del() {
		
		$typeId	= trim(request()->param('type_id'));
		
		if (!is_numeric($typeId)) return json(['status' => 0, 'msg' => '种植类型ID错误']);
		
		if (in_array($typeId, array(1, 2, 3, 4, 5, 6))) {
				
			return json(['status' => 0, 'msg' => '预设种植类型不允许修改']);
		}
		
		if (!$this->growTypeModel->get(['id' => $typeId])) {
				
			return json(['status' => 0, 'msg' => '该种植类型不存在']);
		}
		
		$this->growTypeModel->save(['status' => 0], ['id' => $typeId]);
		return json(['status' => 1, 'msg' => '删除成功']);
	}
}
