<?php
namespace app\pc\controller;

use app\base\controller\Base;
use think\Db;
use think\Request;

class Worker extends Base
{
    // 人员列表查询页面 使用中
    public function workerlist()
    {
        $group_id = request()->param('group_id');
        $page = request()->param('page');
        $worker_name = request()->param('worker_name');

        if(isset($worker_name)){
            $con['w.worker_name'] = array('like','%'.trim($worker_name).'%');
        }
        $group = $this->group_list();

        $row = 6;
        if($page == 1 || !$page){
           $page = 0;
        }else{
            $page = ($page-1)*$row;
        }

        $con['w.status'] = 1;
        if($group_id){
            $con['w.group_id'] = $group_id;
        }

        $str = '';
        $arr = array();
            
        $sql_list = Db::name('worker w')->field('worker_id,pid,phone,w.group_id,worker_name,group_name,sfz,sex,price,bank,bank_account,nation,address,birth_date,age,entry_date,worker_no,w.role_id,role_name')
                ->join('mf_group g','g.group_id = w.group_id')
                ->join('mf_role r','r.role_id = w.role_id')
                ->where($con)
                ->order('w.worker_id asc')
                ->limit($page,$row)
                ->paginate(6);
        $page = $sql_list->render();
        $list = $sql_list->items();        
        $jsonStr = json_encode($sql_list);
        $info = json_decode($jsonStr,true);
        $pages = $info['last_page']; 
        $page_list = array();
        $page_list['page'] = $page;
        $page_list['pages'] = $pages;
        
        if($info['data']){
            foreach($info['data'] as $k=>$v){
                $fathername = Db::table('mf_worker')->where('worker_id', $v['pid'])
                    ->value('worker_name');
                $fathergroupid = Db::table('mf_worker')->where('worker_id', $v['pid'])
                    ->value('role_id');  
                $fathername = Db::table('mf_worker')->where('worker_id', $v['pid'])
                    ->value('worker_name'); 
                $fathergroupname = Db::table('mf_role')->where('role_id', $fathergroupid)
                    ->value('role_name');

                $info['data'][$k]['fatherid'] = $v['pid'];
                $info['data'][$k]['fathername'] = $fathername;
                $info['data'][$k]['fathergroupname'] = $fathergroupname;
            }
            $str = str_replace(':null', ':""', json_encode($info['data']));
            $arr = json_decode($str,'true');
        }
        $count = count($arr);
        return json([
            'status' => 1,
            'msg' => "成功",
            'total'=>$page_list,
            'data' => $arr,
            'group' => $group,
        ]);

    }
    //人员详情
    public function detail(){
        $worker_id = request()->param('worker_id');
        if(!$worker_id){
            return json(['status' => 0,'msg' => "员工id有误"]);
        }
        $con['w.status'] = 1;
        $con['w.worker_id'] = $worker_id;
        $data = Db::name('worker w')->field('worker_id,pid,phone,w.group_id,worker_name,group_name,sfz,sex,price,bank,bank_account,nation,address,birth_date,age,entry_date,worker_no,w.role_id,role_name')
                ->join('mf_group g','g.group_id = w.group_id')
                ->join('mf_role r','r.role_id = w.role_id')
                ->where($con)
                ->find();
        $fathername = Db::table('mf_worker')->where('worker_id', $data['pid'])
                    ->value('worker_name');
        $fathergroupid = Db::table('mf_worker')->where('worker_id', $data['pid'])
                    ->value('role_id');  
        $fathername = Db::table('mf_worker')->where('worker_id', $data['pid'])
                    ->value('worker_name'); 
        $fathergroupname = Db::table('mf_role')->where('role_id', $fathergroupid)
                    ->value('role_name');

        $data['fatherid'] = $data['pid'];
        $data['fathername'] = $fathername;
        $data['fathergroupname'] = $fathergroupname;
        $str = str_replace(':null', ':""', json_encode($data));
        $arr = json_decode($str,'true');
        return json(['status' => 1,'msg' => "查询成功",'data'=>$arr]);
    }
    //部门列表
    public function group_list(){

        $group = array();

        $group = Db::name('group')->field('group_id,group_name')->where('is_buy',1)->select();
        return $group;

    }
    //权限上级列表
    public function rf(){
        $group_id = request()->param('group_id');
        if(!$group_id){
            return json(['status' => 0,'msg' => "请选择部门"]); 
        }
        $role = array();
        $father = array();
        $role = $this->roleselect($group_id);
        $father = $this->groupworker($group_id);
        if($group_id == 1){
            $father = array();
        }
        return json(['status' => 1,'msg' => "查询成功",'data'=>$role,'father'=>$father]);
    }

    // 部门下拉框 数据查询 使用
    public function groupselect()
    {
		

        $group_id = request()->param('group_id');
        if (! $group_id) {
            $group = Db::table('mf_group')->select();
            
            if ($group) {
                return json([
                    'status' => 1,
                    'msg' => "成功",
                    'data' => $group
                ]);
            } else {
                return json([
                    'status' => 1,
                    'msg' => "未获得请求数据！",
                    'data' => $group
                ]);
            }
        } else {
            
            $group = Db::table('mf_group')->where('group_id', $group_id)->select();
            
            // $group['group_id_now']=Db::table('mf_group')->where('group_id',$group_id)->value('group_id');
            
            if ($group) {
                return json([
                    'status' => 1,
                    'msg' => "成功",
                    'data' => $group
                ]);
            } else {
                return json([
                    'status' => 1,
                    'msg' => "未获得请求数据！",
                    'data' => $group
                ]);
            }
        }
    }

    // 职位下拉框 数据查询 使用
    public function roleselect($group_id)
    {
        if ($group_id == 1) {
            $rolesql = Db::table('mf_role')->field('role_id,role_name')->where('group_id', 1)->where('status',0)->select();
        } else {
            $rolesql = Db::table('mf_role')->field('role_id,role_name')->where('group_id', $group_id)->where('status',0)->select();
        }
        if(!$rolesql){
            $rolesql = array();
        }
        return $rolesql;
    }

    // 总搜索 使用
    public function workerselect()
    {
        $res = request()->param();
        $group_id = isset($res['group_id']) ? $res['group_id'] : '';
        $role_id = isset($res['role_id']) ? $res['role_id'] : '';
        $selectinput = isset($res['selectinput']) ? $res['selectinput'] : '';
        
        if ($group_id || $selectinput) {
            
            if (! empty($selectinput)) {
                
                /*
                 * if(is_numeric($selectinput)){
                 *
                 * $data['group_id']=$group_id;
                 * $data['role_id']=$role_id;
                 *
                 * $data['status']=1;
                 * //$dataa=array_filter($data);
                 * $dataa = array_diff($data, [NULL, '']);
                 *
                 * $sql = Db::view('mf_role','role_name,node_str')
                 * ->view('mf_worker','worker_id,pid,phone,token,group_id,worker_name,role_id','mf_role.role_id=mf_worker.role_id')
                 * ->where($dataa)
                 * ->where('phone','like',"%$selectinput%")
                 * ->paginate(10)->each(function($item, $key){
                 *
                 * $fathergroupid=Db::table('mf_worker')->where('worker_id',$item['pid'])->value('role_id');
                 * $fathername=Db::table('mf_worker')->where('worker_id',$item['pid'])->value('worker_name');
                 * $fathergroupname=Db::table('mf_role')->where('role_id',$fathergroupid)->value('role_name');
                 * $item['fatherid']=$item['pid'];
                 * $item['fathername']=$fathername;
                 * $item['fathergroupname']=$fathergroupname;
                 * array_walk_recursive($item, function (& $val, $keya )
                 * {if ($val === null) {$val = '';} });
                 * return $item;
                 * });
                 *
                 * }else{
                 */
                
                $data['group_id'] = $group_id;
                // $data['role_id']=$role_id;
                
                $data['status'] = 1;
                // $dataa=array_filter($data);
                $dataa = array_diff($data, [
                    NULL,
                    ''
                ]);
                $sql = Db::view('mf_role', 'role_name,node_str')->view('mf_worker', 'worker_id,pid,phone,token,group_id,worker_name,role_id,sfz', 'mf_role.role_id=mf_worker.role_id')
                    ->view('mf_group','group_name','mf_worker.group_id=mf_group.group_id')
                    ->where($dataa)
                    ->where('worker_name|role_name', 'like', "%$selectinput%")
                    ->paginate(10)
                    ->each(function ($item, $key) {
                    $fathergroupid = Db::table('mf_worker')->where('worker_id', $item['pid'])
                        ->value('role_id');
                    $fathername = Db::table('mf_worker')->where('worker_id', $item['pid'])
                        ->value('worker_name');
                    $fathergroupname = Db::table('mf_role')->where('role_id', $fathergroupid)
                        ->value('role_name');
                    $item['fatherid'] = $item['pid'];
                    $item['fathername'] = $fathername;
                    $item['fathergroupname'] = $fathergroupname;
                    array_walk_recursive($item, function (& $val, $keya) {
                        if ($val === null) {
                            $val = '';
                        }
                    });
                    return $item;
                });
                
                // }
            } else {
                $data['group_id'] = $group_id;
                // $data['role_id']=$role_id;
                $data['status'] = 1;
                // $dataa=array_filter($data);
                $dataa = array_diff($data, [
                    NULL,
                    ''
                ]);
                $sql = Db::view('mf_role', 'role_name,node_str')->view('mf_worker', 'worker_id,pid,phone,token,group_id,worker_name,role_id,sfz', 'mf_role.role_id=mf_worker.role_id')
                    ->view('mf_group','group_name','mf_worker.group_id=mf_group.group_id')
                    ->where($dataa)
                    ->paginate(10)
                    ->each(function ($item, $key) {
                    
                    $fathergroupid = Db::table('mf_worker')->where('worker_id', $item['pid'])
                        ->value('role_id');
                    $fathername = Db::table('mf_worker')->where('worker_id', $item['pid'])
                        ->value('worker_name');
                    $fathergroupname = Db::table('mf_role')->where('role_id', $fathergroupid)
                        ->value('role_name');
                    $item['fatherid'] = $item['pid'];
                    $item['fathername'] = $fathername;
                    $item['fathergroupname'] = $fathergroupname;
                    
                    array_walk_recursive($item, function (& $val, $key) {
                        if ($val === null) {
                            $val = '';
                        }
                    });
                    return $item;
                });
            }
            if ($sql) {
                return json([
                    'status' => 1,
                    'msg' => "成功",
                    'data' => $sql
                ]);
            } else {
                return json([
                    'status' => 1,
                    'msg' => "没有相关数据!",
                    'data' => $sql
                ]);
            }
        } else {
            return json([
                'status' => 0,
                'msg' => "查询条件有错误！"
            ]);
        }
    }

    // 判断人员添加页面 职务存不存在
    public function roletrue()
    {
        // 当职务为填写的时候调用判断
        $role_name = trim($_REQUEST['role_name']);
        if ($role_name) {
            $role_true = Db::table('mf_role')->where('role_name', $role_name)->select();
            
            if ($role_true) {
                return json([
                    'status' => 1,
                    'msg' => "职务已存在",
                    'data' => $role_true
                ]);
            } else {
                return json([
                    'status' => 0,
                    'msg' => "不存在该职务!跳转添加"
                ]);
            }
        } else {
            return json([
                'status' => 0,
                'msg' => "没有获得请求数据！"
            ]);
        }
    }

    /**
     * [groupworker description]
     * 
     * @return [type] [description]
     */
    public function groupworker($group_id)
    {
        
        if (! $group_id) {
            return json([
                'status' => 0,
                'msg' => "请选择部门",
                'data' => ''
            ]);
        }
        $condition['w.group_id'] = array(
            'in',
            array(
                1,
                $group_id
            )
        );
        $condition['w.status'] = array(
            'eq',
            1
        );
        // 查找部门中所有的人（含老板）
        $lists = Db::name('worker')->alias('w')
            ->field('w.worker_id,w.group_id,w.worker_name,w.pid,r.role_name')
            ->join('mf_role r', 'w.role_id = r.role_id')
            ->where($condition)
            ->select();
        // echo $lists;exit;
        // 当自己不是老板时，剔除自己
        foreach ($lists as $k => $row) {
            if ($this->worker['worker_id'] == $row['worker_id'] && $row['pid'] > 0) {
                unset($lists[$k]);
            }
        }
        $arr = array();
        foreach($lists as $k=>$v){
            $arr[$k]['worker_id'] = $v['worker_id'];
            $arr[$k]['worker_name'] = $v['worker_name'];
            $arr[$k]['role_name'] = $v['role_name'];
        }
        // print_r($lists);
        return $arr;
    }
    //人员添加界面
    public function add(){
        $group = $this->group_list();
        $role = $this->roleselect(1);
        if($group){
            return json(['status'=>1,'msg'=>'查询成功','data'=>$group,'role'=>$role]);
        }else{
            return json(['status'=>1,'msg'=>'查询失败','data'=>array(),'role'=>array()]);
        }
    }
    // 人员添加 使用
    public function workeradd()
    {
        $allow = $this->api_check_have_resource(1);
        if (! $allow['status']) {
            return json([
                'status' => 0,
                'msg' => $allow['msg']
            ]);
        }
        $tel = trim(input('tel'));
        $tel = htmlspecialchars($tel);
        if (! $tel) {
            return json([
                'status' => 0,
                'msg' => "请填写手机号!"
            ]);
        }
        
        $group_id = trim(input('group_id'));
        if (! $group_id) {
            return json([
                'status' => 0,
                'msg' => "请选择部门!"
            ]);
        }

        $role_id = trim(input('role_id'));
        if (! $role_id) {
            return json([
                'status' => 0,
                'msg' => "请选择职位!"
            ]);
        }
        
        $price = trim(input('price'));
        if (!$price) {
            return json([
                'status' => 0,
                'msg' => "请输入工资!"
            ]);
        }
        if(!is_numeric($price)){
            return json([
                'status' => 0,
                'msg' => "工资必须为数字!"
            ]);
        }
        $price = preg_replace('/^0+/','',$price);

        $worker_name = trim(input('worker_name'));
        $worker_name = htmlspecialchars($worker_name);
        if (! $worker_name) {
            return json([
                'status' => 0,
                'msg' => "请填写姓名!"
            ]);
        }
        
        $sex = trim(input('sex'));
        $sfz = trim(input('sfz'));
        $sfz = htmlspecialchars($sfz);

        if (!$sfz) {
            return json([
                'status' => 0,
                'msg' => "请填写身份证!"
            ]);
        }
        $bank = trim(input('bank'));
        $bank = htmlspecialchars($bank);

        $nation = trim(input('nation'));
        $nation = htmlspecialchars($nation);

        $bank_account = trim(input('bank_account'));
        $bank_account = htmlspecialchars($bank_account);

        $address = trim(input('address'));
        $address = htmlspecialchars($address);

        $birth_date = trim(input('birth_date'));
        $birth_date = htmlspecialchars($birth_date);

        $entry_date = trim(input('entry_date'));
        $entry_date = htmlspecialchars($entry_date);

        $age = null;
        
        if($birth_date){
            $birth_date = date('Y-m-d',strtotime($birth_date));
            $age = $this->get_age($birth_date);
        }

        if($entry_date){
            $entry_date = date('Y-m-d',strtotime($entry_date));
        }else{
            $entry_date = date('Y-m-d',time());
        }

        $worker_no = $this->get_worker_sn();

        if (! $worker_name) {
            return json([
                'status' => 0,
                'msg' => "请填写姓名!"
            ]);
        }
        if ($group_id == 1) {
            $pid = 0;
        } else {
            $pid = trim(input('pid'));
            $pid = htmlspecialchars($pid);
        }
        
        $token = trim(input('token'));
        $status = 1;
        
        // dump($worker_name);dump($tel);dump($group_id);dump($role_id);dump($sfz);dump(is_numeric($pid));exit;
        if ($worker_name && $tel && $group_id && $role_id && $price && $sfz && is_numeric($pid)) {
            
            if (preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $tel)) {

                    $dataa = [
                        'phone' => $tel,
                        'sfz' => $sfz,
                        'bank' => $bank,
                        'bank_account' => $bank_account,
                        'address' => $address,
                        'nation' => $nation,
                        'group_id' => $group_id,
                        'price' => $price,
                        'worker_name' => $worker_name,
                        'sex' => $sex,
                        'pid' => $pid,
                        'token' => $token,
                        'status' => 1,
                        'role_id'=> $role_id,
                        'birth_date'=> $birth_date,
                        'entry_date'=> $entry_date,
                        'age'=> $age,
                        'worker_no'=> $worker_no
                    ];       
  
                // $data=array_filter($dataa);
                $data = array_diff($dataa, [
                    NULL,
                    ''
                ]);
                
                $res_f = Db::table('mf_worker')->where('phone', $tel)
                    ->where('worker_name', $worker_name)
                    ->where('group_id', $group_id)
                    ->where('price', $price)
                    ->where('sfz', $sfz)
                    ->where('status', 2)
                    ->select();
                
                if (! $res_f) {
                    // 验证手机号
                    $res = $this->update_account($tel);
                    // dump($res);exit;
                    if (! $res['status']) {
                        return json([
                            'status' => 0,
                            'msg' => $res['msg']
                        ]);
                    }
                    $newworkerid = Db::table('mf_worker')->insertGetId($data);
                    
                    if ($newworkerid) {
                        /*
                         * $roleData['worker_id'] = $newworkerid;
                         * $roleData['node_str'] = $this->_getRole($role_id);
                         * M('worker_node')->insert($roleData);
                         */
                        if ($pid != 0) {
                            
                            $worker_code = Db::table('mf_worker')->where('worker_id', $pid)->value('worker_code');
                            
                            $code = $worker_code . ',' . $newworkerid;
                            
                            $update = Db::table('mf_worker')->where('worker_id', $newworkerid)->update([
                                'worker_code' => $code
                            ]);
                        } else {
                            $code = $newworkerid;
                            $update = Db::table('mf_worker')->where('worker_id', $newworkerid)->update([
                                'worker_code' => $code
                            ]);
                        }
                        
                        return json([
                            'status' => 1,
                            'msg' => "添加成功",
                            'data' => $code
                        ]);
                    } else {
                        return json([
                            'status' => 0,
                            'msg' => "添加失败"
                        ]);
                    }
                } else {
                    return json([
                        'status' => 0,
                        'msg' => "数据已存在"
                    ]);
                }
            } else {
                return json([
                    'status' => 0,
                    'msg' => "手机号不正确"
                ]);
            }
            
            // }else{
            // return json(['status'=>0,'msg'=>"姓名填写不正确"]);
            // }
        } else {
            return json([
                'status' => 0,
                'msg' => "数据填写不完整"
            ]);
        }
    }

    /**
     * [getRole description]
     * 
     * @param [type] $role_id
     *            [description]
     * @return [type] [description]
     */
    private function _getRole($role_id)
    {
        $node_str = M('role')->where([
            'role_id' => $role_id
        ])->value('node_str');
        if ($node_str) {
            return $node_str;
        } else {
            return NULL;
        }
    }

    /**
     * [workerdel 人员删除页面 使用]
     * 
     * @return [type] [description]
     */
    public function workerdel()
    {
        $worker_id = $this->request->param('worker_id');
        if (! $worker_id) {
            $result['status'] = 0;
            $result['msg'] = "人员id为空";
            ajaxReturnJson($result);
        }
        if ($worker_id == 1) {
            $result['status'] = 0;
            $result['msg'] = "老板不能删除";
            ajaxReturnJson($result);
        }
        
        $con['pid'] = $worker_id;
        $con['status'] = array('gt',0);
        $db = Db::name('worker');
        $delerr = $db->where($con)->select();
        if ($delerr) {
            $result['status'] = 0;
            $result['msg'] = "存在下级，不能删除";
            ajaxReturnJson($result);
        } else {
            $con1['worker_id'] = $worker_id;
            $con1['status'] = 1;
            $data['status'] = 0;
            $tel = $db->where($con1)->value('phone');
            $this->update_account($tel, 0); // 释放资源包
            $deltu = $db->where($con1)->update($data);
            if ($deltu !== false) {
                $result['status'] = 1;
                $result['msg'] = "删除成功";
                ajaxReturnJson($result);
            } else {
                $result['status'] = 0;
                $result['msg'] = "删除失败";
                ajaxReturnJson($result);
            }
        }
    }
    // 编辑页面 
    public function edit()
    {
        $worker_id = trim(request()->param('worker_id'));
        if (!$worker_id) {
            return json([
                'status' => 1,
                'msg' => "没有获得当前人员Id!"
            ]);
        }
        $group = $this->group_list();
        $data = Db::name('worker')->where('worker_id',$worker_id)->find();
        $arr = array();
        $role = array();
        $father = array();
        if($data){
            $role = $this->roleselect($data['group_id']);
            $father = $this->groupworker($data['group_id']);
            $str = str_replace(':null', ':""', json_encode($data));
            $arr = json_decode($str,'true');
            return json(['status'=>1,'msg'=>'查询成功','group'=>$group,'role'=>$role,'father'=>$father,'data'=>$arr]);
        }else{
             return json(['status'=>1,'msg'=>'查询成功','group'=>$group,'role'=>$role,'father'=>$father,'data'=>array()]);
        }

    }

    // 编辑执行页面 使用
    public function workeredit_do()
    {
        $worker_id = trim(request()->param('worker_id'));
        if (!$worker_id) {
            return json([
                'status' => 0,
                'msg' => "没有获得当前人员Id!"
            ]);
        }
        $worker_name = trim(request()->param('worker_name'));
        if (!$worker_name) {
            return json([
                'status' => 0,
                'msg' => "请填写姓名!"
            ]);
        }
        // $worker_name = htmlspecialchars($worker_name);
        $sex = trim(request()->param('sex'));
        $sfz = trim(request()->param('sfz'));
        $bank = trim(request()->param('bank'));
        $bank_account = trim(request()->param('bank_account'));
        $nation = trim(request()->param('nation'));
        $address = trim(request()->param('address'));
        $birth_date = trim(request()->param('birth_date'));
        $entry_date = trim(request()->param('entry_date'));

        $no = Db::name('worker')->where('worker_id',$worker_id)->value('worker_no');
        
        if($no){
            $worker_no = $no;
        }else{
            $worker_no = $this->get_worker_sn();
        }

        $age = null;
        if($birth_date){
            $birth_date = date('Y-m-d',strtotime($birth_date));
            $age = $this->get_age($birth_date);
        }

        if($entry_date){
            $entry_date = date('Y-m-d',strtotime($entry_date));
        } 

        if (!$sfz) {
            return json([
                'status' => 0,
                'msg' => "请填写身份证!"
            ]);
        }
        // $sfz = htmlspecialchars($sfz);
        // $tel=trim($_POST['tel']);
        // $tel = htmlspecialchars($tel);
        $price = trim(request()->param('price'));
        if (!$price) {
            return json([
                'status' => 0,
                'msg' => "请输入工资!"
            ]);
        }
        if(!is_numeric($price)){
            return json([
                'status' => 0,
                'msg' => "工资必须为数字!"
            ]);
        }

        $price = preg_replace('/^0+/','',$price);

        $role_id = trim(request()->param('role_id'));
        if (!$role_id) {
            return json([
                'status' => 0,
                'msg' => "请选择职务!"
            ]);
        }
        $group_id = trim(request()->param('group_id'));
        if (!$group_id) {
            return json([
                'status' => 0,
                'msg' => "请选择部门!"
            ]);
        }
        if ($group_id == 1) {
            $pid = 0;
        } else {
            $pid = trim(request()->param('pid'));
        }
        
        $token = trim(request()->param('token'));
        
        if ($worker_id && $worker_name && $group_id  && $role_id && $price && $sfz && is_numeric($pid)) {
            
            // if (preg_match('/^([\xe4-\xe9][\x80-\xbf]{2}){2,4}$/',$worker_name))
            // {
            
            // if(preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#',$tel))
            // {
            if ($pid != 0) {
                $worker_code = Db::table('mf_worker')->where('worker_id', $pid)->value('worker_code');
                $code = $worker_code . ',' . $worker_id;
            } else {
                //$code = "1" . ',' . $worker_id;
                $code = $worker_id;
            }
            
            $editdata = [
                'worker_name' => $worker_name,
                'sex' => $sex,
                'bank' => $bank,
                'bank_account' => $bank_account,
                'address' => $address,
                'nation' => $nation,
                'sfz' => $sfz,
                'price' => $price,
                'pid' => $pid,
                'group_id' => $group_id,
                'token' => $token,
                'worker_code' => $code,
                'role_id' => $role_id,
                'birth_date'=> $birth_date,
                'entry_date'=> $entry_date,
                'age'=> $age,
                'worker_no'=> $worker_no
                
            ];
            
            // $data=array_filter($editdata);
            
            $editdata = array_diff($editdata, [
                NULL,
                ''
            ]);
            
            $dosql = Db::table('mf_worker')->where('worker_id', $worker_id)->update($editdata);
            
            if ($dosql) {
                
                // Db::table('mf_worker_node')->where('worker_id',$worker_id)->update(['node_str'=>$worker_code]);
                // Db::table('mf_role')->where('role_id',$role_id)->update(['node_str'=>$worker_code]);
                
                return json([
                    'status' => 1,
                    'msg' => "更新数据成功！",
                    'data' => $code
                ]);
            } else {
                return json([
                    'status' => 1,
                    'msg' => "没有可更新的数据!",
                    'data' => $code
                ]);
            }
            
            // }else{ return json(['status'=>0,'msg'=>"手机号不正确"]);}
            
            // }else{
            // return json(['status'=>0,'msg'=>"姓名填写不正确"]);
            // }
        } else {
            return json([
                'status' => 0,
                'msg' => "数据填写不完整"]);
            }
    }

    //计算年龄
    public function get_age($birth_date){

        $age = 0;  

        if($birth_date){
            $year = date('Y',strtotime($birth_date));  
            $month = date('m',strtotime($birth_date));  
            $day = date('d',strtotime($birth_date));  
              
            $now_year = date('Y');  
            $now_month = date('m');  
            $now_day = date('d');  

            if ($now_year > $year){ 
                $age = $now_year - $year - 1; 
                if ($now_month > $month){  
                    $age++;  
                }else if($now_month == $month) {  
                    if ($now_day >= $day){  
                        $age++;  
                    }  
                }  
            }          
        } 

        return $age;
    }

    //获取工号
    private function get_worker_sn(){

        $arr = array();
        $arr =  Db::name('worker')->where('status',0)->order('worker_no asc')->column('worker_no');
        $arr = array_filter($arr);
        if($arr){
            foreach($arr as $k=>$v){
                $con1['worker_no'] = trim($v);
                $con1['status'] = 1;
                $info = Db::name('worker')->where($con1)->value('worker_no');
                if(!$info){
                    break;
                }
            }
        }else{
            $info = 1;
        }

        if(!$info){

            foreach($arr as $k=>$v){
                $con['worker_no'] = trim($v);
                $con['status'] = 1;
                $find = Db::name('worker')->where($con)->value('worker_no');
                if($find){
                    continue;
                }else{
                    $worker_no = $v;
                    break;
                }
             }
             return $worker_no;
        }else{


            $number = Db::name('worker')->where('worker_no','not null')->where('status',1)->count();
            $number++;

            //填充0；str_pad()填充字符串；STR_PAD_LEFT:填充到字符串的左侧
            $numbered = str_pad($number,4,"0",STR_PAD_LEFT);

            $worker_no = 'GN'.$numbered;

            return $worker_no;
        }
    }


}