<?php
namespace app\purchase\controller;

use app\base\controller\Base;
use think\Db;
use think\Request;

class Supply extends Base{

	//添加供应商
	public function supply_add(){

		$province = request()->param('province');
		$supply_name = request()->param('supply_name');
		$contact = request()->param('contact');
		$contact_number = request()->param('contact_number');
		$address = request()->param('address');
		$bank = request()->param('bank');
		$account = request()->param('account');
		$beizhu = request()->param('beizhu');

		if(!$province){

			return json(['status'=>0,'msg'=>'请选择省份']);
		}
		if(!$supply_name){

			return json(['status'=>0,'msg'=>'请输入供应商名称']);
		}

		$find = Db::name('supply')->where('supply_name',$supply_name)->find();

		if($find){

			return json(['status'=>0,'msg'=>'供应商已存在']);
		}

		if($contact_number){

			if(!preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $contact_number)){

				return json(['status'=>0,'msg'=>'联系电话格式有误']);

			}
		}

		if($account){

			if(!is_numeric($account)){

				return json(['status'=>0,'msg'=>'银行账号为数字']);
			}
		}

		$data['province'] = $province;
		$data['supply_name'] = $supply_name;
		$data['contact'] = $contact;
		$data['contact_number'] = $contact_number;
		$data['address'] = $address;
		$data['bank'] = $bank;
		$data['account'] = $account;
		$data['beizhu'] = $beizhu;

		$re = Db::name('supply')->insert($data);
		
 		if($re){ 

            return json(['status'=>1,'msg'=>'添加成功']);

        }else{

            return json(['status'=>0,'msg'=>'添加失败']);
        }

	}

	//供应商列表
	public function supply_list(){

		$supply_name = request()->param('supply_name');
		$page = request()->param('page');

		$province = request()->param('province');
		if($supply_name || $province){

			if($supply_name){
				$con['supply_name'] = array('like','%'.trim($supply_name).'%');
			}

			if($province){	
				$con['province'] = array('like','%'.trim($province).'%');	
			}
		}else{
			$con = '';
		}

		$row = 3;
		if($page == 1 || !$page){
           $page = 0;
       	}else{
            $page = ($page-1)*$row;
        }

		$data = Db::name('supply')->where($con)->limit($page,$row)->select();
		$total = count($data);
		
		if($data){

			$str = '';
			$arr = array();	
			$str = str_replace(':null', ':""', json_encode($data));
			$arr = json_decode($str,'true');

			return json(['status'=>1,'msg'=>'查询成功','count'=>$total,'data'=>$arr]);
		}else{

			return json(['status'=>1,'msg'=>'查询成功','count'=>0,'data'=>array()]);
		}

	}

	//执行编辑
	public function supply_edit(){

		$supply_id = request()->param('supply_id');
		$province = request()->param('province');
		$supply_name = request()->param('supply_name');
		$contact = request()->param('contact');
		$contact_number = request()->param('contact_number');
		$address = request()->param('address');
		$bank = request()->param('bank');
		$account = request()->param('account');
		$beizhu = request()->param('beizhu');

		if(!$supply_id){

			return json(['status'=>0,'msg'=>'供应商id有误']);
		}

		if(!$province){

			return json(['status'=>0,'msg'=>'请选择省份']);
		}

		if(!$supply_name){

			return json(['status'=>0,'msg'=>'请输入供应商名称']);
		}

		$name = Db::name('supply')->where('supply_id',$supply_id)->value('supply_name');

		if($supply_name != $name){
			
			$find = Db::name('supply')->where('supply_name',$supply_name)->find();
			if($find){

				return json(['status'=>0,'msg'=>'供应商已存在']);
			}
		}

		if($contact_number){

			if(!preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $contact_number)){

				return json(['status'=>0,'msg'=>'联系电话格式有误']);

			}
		}

		if($account){

			if(!is_numeric($account)){

				return json(['status'=>0,'msg'=>'银行账号为数字']);
			}
		}

		$data['province'] = $province;
		$data['supply_name'] = $supply_name;
		$data['contact'] = $contact;
		$data['contact_number'] = $contact_number;
		$data['address'] = $address;
		$data['bank'] = $bank;
		$data['account'] = $account;
		$data['beizhu'] = $beizhu;

		$re = Db::name('supply')->where('supply_id',$supply_id)->update($data);
		
 		if($re !== false){ 

            return json(['status'=>1,'msg'=>'编辑成功']);

        }else{

            return json(['status'=>0,'msg'=>'编辑失败']);
        }

	}

	//删除供应商
	public function supply_del(){

		$supply_id = request()->param('supply_id');

		if(!$supply_id){

			return json(['status'=>0,'msg'=>'供应商id有误']);
		}

		//如果供应商被使用 不允许删除 

		$find = Db::name('pur_order')->where('supply_id',$supply_id)->value('supply_id');
		if($find){
			return json(['status'=>1,'msg'=>'供应商已使用不能删除']);
		}

		$re = Db::name('supply')->where('supply_id',$supply_id)->delete();

		if($re){ 

            return json(['status'=>1,'msg'=>'删除成功']);

        }else{

            return json(['status'=>0,'msg'=>'删除失败']);
        }

	}

}
