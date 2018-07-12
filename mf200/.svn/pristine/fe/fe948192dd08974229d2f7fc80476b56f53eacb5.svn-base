<?php
namespace app\baseset\controller;
use app\base\controller\Base;
use think\Db;
//use think\Controller;

class MaterielCategor extends Base{

	/**
	* [add 添加物料分类]
	* @param post传参 cat_name 物料分类名称
	* @return [type] status 状态值 msg 返回信息
	*/
	public function add(){
		if($_REQUEST && !empty($_REQUEST['cat_name'])){
			$con['cat_name'] = $_REQUEST['cat_name'];
			$con['status'] = 1;
			$find = Db::name('materiel_category')->where($con)->find();
			if($find){
				return(json(array('status'=>0,'msg'=>'存在相同的物料分类名称')));
			}
			$data['cat_name'] = $_REQUEST['cat_name'];
			$data['pid'] = 0;
			$data['status'] = 1;
			$data['type'] = 0;
			$re = Db::name('materiel_category')->insertGetId($data);
			if($re){
				$info = '('.$re.')';
				$result = Db::name('materiel_category')->where('cat_id',$re)->setField('cat_code',$info);
				if($result){
					return(json(array('status'=>1,'msg'=>'添加物料分类成功')));
				}else{
					return(json(array('status'=>0,'msg'=>'添加物料分类失败')));
				}
			}else{
				return(json(array('status'=>0,'msg'=>'添加物料分类失败')));
			}
		}else{
			return(json(array('status'=>0,'msg'=>'请输入物料分类名称')));
		}
	}

	/**
	* [edit 编辑物料分类]
	* @param post传参 cat_name 物料分类名称 cat_id 物料分类id do 是否执行编辑
	* @return [type] status 状态值 msg 返回信息 data 分类数据
	*/
	public function edit(){
		if($_REQUEST && !empty($_REQUEST['cat_id'])){
			if(!isset($_REQUEST['do'])){
				$condition['cat_id'] = $_REQUEST['cat_id'];
				$data = DB::name('materiel_category')->where($condition)->field('cat_id,cat_name')->find();
				return(json(array('status'=>1,'msg'=>'查询成功','data'=>$data)));
			}else{
				if(!empty($_REQUEST['cat_name'])){
					$cat_id = $_REQUEST['cat_id'];
					$cat_name = $_REQUEST['cat_name'];
					$con['cat_id'] = array('neq',$cat_id);
					$con['status'] = 1;
					$info = Db::name('materiel_category')->where($con)->column('cat_name');
					if(in_array($cat_name,$info)){
						return(json(array('status'=>0,'msg'=>'存在相同的物料分类名称')));
					}
					$re = Db::name('materiel_category')->where('cat_id',$cat_id)->setField('cat_name',$cat_name);
					if($re !== false){
						return(json(array('status'=>1,'msg'=>'编辑成功')));
					}else{
						return(json(array('status'=>0,'msg'=>'编辑失败')));
					}
				}else{
					return(json(array('status'=>0,'msg'=>'参数有误')));
				}
			}
		}else{
			return(json(array('status'=>0,'msg'=>'参数有误')));
		}
	}

	/**
	* [del 删除物料分类]
	* @param post传参 cat_id 物料分类id 
	* @return [type] status 状态值 msg 返回信息
	*/
	public function del(){
		if($_REQUEST && !empty($_REQUEST['cat_id'])){
			$cat_id = $_REQUEST['cat_id'];
			$con['pid'] = $cat_id;
			$con['status'] = 1;
			$son = Db::name('materiel_category')->where($con)->find();
			if($son){
				return(json(array('status'=>0,'msg'=>'该分类存在子类，不能删除')));
			}
			$condition['cat_id'] = $cat_id;
			$condition['status'] = 1;
			$materiel = Db::name('materiel')->where($condition)->find();
			if($materiel){
				return(json(array('status'=>0,'msg'=>'该分类存在物料，不能删除')));
			}
			$re = Db::name('materiel_category')->where('cat_id',$cat_id)->setField('status',0);
			if($re){
				return(json(array('status'=>1,'msg'=>'删除成功')));
			}else{
				return(json(array('status'=>0,'msg'=>'删除失败')));
			}
		}else{
			return(json(array('status'=>0,'msg'=>'参数有误')));
		}
	}

	/**
    * [get_worker 获取登录人信息]
    * @param worker_id 登录人id
    * @return [type] [返回值描述]
    */
	public function get_worker(){
		if($_REQUEST){
			$worker =  Db::name('worker')
					->alias('w')
					->join('role r','w.role_id = r.role_id')
					->join('group g','w.group_id = g.group_id')
					->where('phone ',$_REQUEST['phone'])
					->field('worker_id,worker_name,group_name,role_name,img_url')
					->find();
			if($worker){
				if(!$worker['img_url']){
					$worker['img_url'] = '';
				}
				if(!$worker['worker_name']){
					$worker['worker_name'] = '';
				}
				if(!$worker['group_name']){
					$worker['group_name'] = '';
				}
				if(!$worker['role_name']){
					$worker['role_name'] = '';
				}
				return(json(array('status'=>1,'msg'=>'操作成功','worker'=>$worker)));
			}else{
				return(json(array('status'=>0,'msg'=>'操作失败')));
			}
		}else{
			return(json(array('status'=>0,'msg'=>'参数错误')));
		}
	}
	/**
    * [upload 上传头像]
    * @param image 64进制图片信息
    * @return [type] [返回值描述]
    */
	public function upload(){
		if($_REQUEST['image']){
			$con['worker_id'] = $_REQUEST['worker_id'];
			$image = base64_decode(trim($_REQUEST['image']));
			if($image){
				$filename = date('YmdHis',time());
				$result = file_put_contents('./upload/'.$filename.'.jpg',$image);
				if($result){
					$data['img_url'] = 'http://27.221.53.90:880/upload/'.$filename.'.jpg';
				}
				$re = Db::name('worker')->where($con)->update($data);
				if($re){
					return(json(array('status'=>1,'msg'=>'上传成功')));
				}else{
					return(json(array('status'=>0,'msg'=>'上传失败')));
				}
			}
		}
	}		
}