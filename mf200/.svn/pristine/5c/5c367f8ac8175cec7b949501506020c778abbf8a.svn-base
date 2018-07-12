<?php
namespace app\person\controller;
use app\base\controller\Base;
use think\Db;

class PerInfo extends Base{
	/**
    * [get_worker 获取登录人信息]
    * @param worker_id 登录人id
    * @return [type] [返回值描述]
    */
	public function get_worker(){
		if($_REQUEST){
			$worker =  Db::name('worker')
					->alias('w')
					->join('role r','r.role_id = w.role_id')
					->join('group g','g.group_id = w.group_id')
					->where('phone',$_REQUEST['phone'])
					->field('worker_id,worker_name,group_name,role_name,img_url,w.group_id')
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