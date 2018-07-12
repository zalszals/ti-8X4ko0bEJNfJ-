<?php
namespace app\pc\controller;

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
	//省份信息
	public function province(){

		$arr = ['北京市','天津市','河北省','山西省','内蒙古自治区','辽宁省','吉林省','黑龙江省','上海市','江苏省','浙江省','安徽省','福建省','江西省','山东省','河南省','湖北省','湖南省','广东省','广西壮族自治区','海南省','重庆市','四川省','贵州省','云南省','西藏自治区','陕西省','甘肃省','青海省','宁夏回族自治区','新疆维吾尔自治区','台湾省','香港特别行政区','澳门特别行政区','国外'];
		return $arr;
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

		$data = Db::name('supply')->where($con)->paginate(8);

		$page = $data->render();
        $list = $data->items();        
        $jsonStr = json_encode($data);
        $info = json_decode($jsonStr,true);
        $pages = $info['last_page']; 
        $page_list = array();
        $page_list['page'] = $page;
        $page_list['pages'] = $pages;
		
		$array = $this->province();
		if($info['data']){

			$str = '';
			$arr = array();	
			$str = str_replace(':null', ':""', json_encode($info['data']));
			$arr = json_decode($str,'true');
			foreach($arr as $k=>$v){
				$arr[$k]['pro'] = $v['province'];
			}

			return json(['status'=>1,'msg'=>'查询成功','total'=>$page_list,'data'=>$arr,'pro'=>$array]);
		}else{

			return json(['status'=>1,'msg'=>'查询成功','total'=>$page_list,'data'=>array(),'pro'=>$array]);
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

	//供应商添加界面
	public function add(){

		$pro = $this->province();

		return json(['status'=>1,'msg'=>'查询成功','data'=>$pro]);
	}


	//供应商编辑界面
	public function edit(){

		$supply_id = request()->param('supply_id');

		if(!$supply_id){

			return json(['status'=>0,'msg'=>'供应商id有误']);
		}
		$data = Db::name('supply')->where('supply_id',$supply_id)->find();
		$str = '';
		$arr = array();	
		$str = str_replace(':null', ':""', json_encode($data));
		$arr = json_decode($str,'true');
		
		$pro = $this->province();

		return json(['status'=>1,'msg'=>'查询成功','data'=>$arr,'pro'=>$pro]);
	}

}
