<?php

namespace app\home\controller;
use app\base\controller\Base;
use think\Loader;
use think\Db;

class Upload extends Base {

	public function lists() {

		$worker = $this->worker;

		$phone = trim($worker['phone']);
		$token = trim($worker['token']);

		$this->assign('phone', $phone);
		$this->assign('token', $token);

		return $this->fetch();

	}

	public function upload(){

		$file = request()->file('file');

		$filename = date('YmdHis',time());

		$info = file_put_contents('./upload/'.$filename.'.jpg',$file);

	    if($info){

			return json(array('state'=>1,'msg'=>'上传成功'));

		}else{
		       
			return json(array('state'=>0,'msg'=>'上传失败'));
		 }


	}
}