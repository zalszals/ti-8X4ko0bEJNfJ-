<?php
namespace app\baseset\controller;

use app\base\controller\Base;
use think\Db;
use think\Request;

class Worker extends Base
{

    // 人员列表join查询 未启用 可使用
    public function workerlist_aa(){   
        $condition['b.group_id']=request()->param('group_id');
        $condition['b.status']=1;
        $conditiona = array_diff($condition, [NULL, '']);

        $sql=Db::table('mf_role')->alias("a")
        ->join('mf_worker b','a.role_id=b.role_id','LEFT')
        ->join('mf_group c','b.group_id=c.group_id','LEFT')
        ->join('mf_worker e','b.pid=e.worker_id','LEFT')
        ->join('mf_group d','d.group_id=e.group_id','LEFT')
        ->field('b.worker_name,b.sex,b.sfz,b.phone,a.role_name,a.role_id,b.worker_id,e.worker_name as fathername,d.group_name as fathergroupname')
        ->where($conditiona)
        ->select();

        if($sql){ 
            return json(['status'=>1,'msg'=>"查询成功",'data'=>$sql]);
        }else{
            return json(['status'=>0,'msg'=>"查询失败"]);
        }
    }

    // 人员列表查询页面 使用中
    public function workerlist()
    {
        $group_id = request()->param('group_id');
        $role_id = request()->param('role_id');

        if (is_numeric($group_id)) {
            
            $sql_list = Db::view('mf_role', 'role_name')->view('mf_worker', 'worker_id,pid,phone,group_id,worker_name,role_id,sfz,sex', 'mf_role.role_id=mf_worker.role_id')
                ->view('mf_group', 'group_name', 'mf_group.group_id=mf_worker.group_id')
                ->where([
                'group_id' => $group_id,
                'mf_worker.status' => 1
            ])
                ->order(['mf_worker.worker_id'=>'asc'])
                ->paginate()
                ->each(function ($item, $key) {
                
                // $fatherid=Db::table('mf_worker')->where('group_id',$item['worker_id'])->value('pid');
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
            
            return json([
                'status' => 1,
                'msg' => "成功",
                'data' => $sql_list
            ]);
        } else {
            
                
                $sql_list = Db::view('mf_role', 'role_name')->view('mf_worker', 'worker_id,pid,phone,group_id,worker_name,role_id,sfz,sex', 'mf_role.role_id=mf_worker.role_id')
                    ->view('mf_group', 'group_name', 'mf_group.group_id=mf_worker.group_id')
                    ->where([
                    
                    'mf_worker.status' => 1
                ])
                    ->order(['mf_worker.worker_id'=>'asc'])
                    ->paginate()
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
                
                return json([
                    'status' => 1,
                    'msg' => "成功",
                    'data' => $sql_list
                ]);
          
        }
    }

    // 部门下拉框 数据查询 使用
    public function groupselect()
    {
		

        $group_id = request()->param('group_id');
        if (! $group_id) {
            $group = Db::table('mf_group')->where('is_buy',1)->select();
            
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
    public function roleselect()
    {
        $group_id = trim(request()->param('group_id'));
        if ($group_id == 1) {
            $rolesql = Db::table('mf_role')->where('group_id', 1)->select();
            return json([
                'status' => 1,
                'msg' => "成功",
                'data' => $rolesql
            ]);
        } else {}
        if ($group_id > 1) {
            $rolesql = Db::table('mf_role')->where('group_id', $group_id)->select();
            if ($rolesql) {
                return json([
                    'status' => 1,
                    'msg' => "成功",
                    'data' => $rolesql
                ]);
            } else {
                return json([
                    'status' => 1,
                    'msg' => "未获得请求数据！",
                    'data' => $rolesql
                ]);
            }
        } else {
            return json([
                'status' => 0,
                'msg' => "请先选择部门！"
            ]);
        }
    }

    // 总搜索 使用
    public function workerselect()
    {
        /*$res = request()->param();
        $group_id = isset($res['group_id']) ? $res['group_id'] : '';
        $role_id = isset($res['role_id']) ? $res['role_id'] : '';
        $selectinput = isset($res['selectinput']) ? $res['selectinput'] : '';*/
        
        $group_id = request()->param('group_id');
        $role_id = request()->param('role_id');
        $selectinput = request()->param('worker_name');

        if($group_id){
            $newdata["mf_group.group_id"]=$group_id;

        }
        if($role_id){
            $newdata["mf_role.role_id"]=$role_id;
        }
        if($selectinput){
            $newdata["worker_name"]=array('like','%'.trim($selectinput).'%');
        }
        $newdata['mf_worker.status'] = 1;
        $sql = Db::view('mf_role', 'role_name,node_str')
                    ->view('mf_worker', 'worker_id,pid,phone,token,group_id,worker_name,role_id,sfz', 'mf_role.role_id=mf_worker.role_id')
                    ->view('mf_group','group_name','mf_worker.group_id=mf_group.group_id')
                    ->where($newdata)
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

        /*
        if ($group_id || $selectinput) {
            
            if (! empty($selectinput)) {
                
                
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
        }*/
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
    public function groupworker()
    {
        $group_id = trim(request()->param('group_id'));
        
        $worker_id = trim(request()->param('worker_id'));
        
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
            $arr[] = $v;
        }
        // print_r($lists);
        if ($lists) {
            return json([
                'status' => 1,
                'msg' => "成功",
                'data' => $arr
            ]);
        } else {
            return json([
                'status' => 0,
                'msg' => "失败",
                'data' => array()
            ]);
        }
    }

    // 人员添加页面 部门选择方法 使用
    /*
     * public function groupworker(){
     *
     * $group_id=trim(request()->param('group_id'));
     * $worker_id=trim(request()->param('worker_id'));
     *
     * if($worker_id){//存在worker_id
     *
     * if($worker_id==1){
     * if($group_id==1){return json(['status'=>1,'msg'=>"该部门没有上级"]);die();}else{}
     *
     * if($group_id>1){
     * $hj=Db::view('mf_role','role_name')
     * ->view('mf_worker','worker_id,group_id,worker_name,pid','mf_role.role_id=mf_worker.role_id')
     * ->where('group_id','eq',1)
     * ->where('status','eq',1)
     * //->where('worker_id','neq',$worker_id)
     * ->where('pid','eq',0)
     * ->select();
     *
     * $groupworkerlist = Db::view('mf_role','role_name')
     * ->view('mf_worker','worker_id,group_id,worker_name,pid','mf_role.role_id=mf_worker.role_id')
     * ->where('group_id',$group_id)
     * //->where('group_id','eq',1)
     * ->where('status','eq',1)
     * //->where('worker_id','neq',$worker_id)
     * ->select();
     *
     * foreach($hj as $row){
     * $groupworkerlist[]=$row;
     * }
     *
     *
     * array_walk_recursive($groupworkerlist, function (& $val, $key )
     * {if ($val === null) {$val = '';} });
     *
     * if($groupworkerlist){
     * return json(['status'=>1,'msg'=>"成功",'data'=>$groupworkerlist]);
     * }else{
     * return json(['status'=>1,'msg'=>"未获得数据！",'data'=>$groupworkerlist]);
     * }
     * }else{
     * return json(['status'=>0,'msg'=>"没有获得请求数据！"]);
     * }
     *
     *
     *
     *
     *
     *
     * }else{
     *
     * if($group_id==1){return json(['status'=>1,'msg'=>"该部门没有上级"]);die();}else{}
     *
     * if($group_id>1){
     * $hj=Db::view('mf_role','role_name')
     * ->view('mf_worker','worker_id,group_id,worker_name,pid','mf_role.role_id=mf_worker.role_id')
     * ->where('group_id','eq',1)
     * ->where('status','eq',1)
     * ->where('worker_id','neq',$worker_id)
     * ->where('pid','eq',0)
     * ->select();
     *
     * $groupworkerlist = Db::view('mf_role','role_name')
     * ->view('mf_worker','worker_id,group_id,worker_name,pid','mf_role.role_id=mf_worker.role_id')
     * ->where('group_id',$group_id)
     * //->where('group_id','eq',1)
     * ->where('status','eq',1)
     * ->where('worker_id','neq',$worker_id)
     * ->select();
     *
     * foreach($hj as $row){
     * $groupworkerlist[]=$row;
     * }
     *
     *
     *
     * array_walk_recursive($groupworkerlist, function (& $val, $key )
     * {if ($val === null) {$val = '';} });
     *
     * if($groupworkerlist){
     * return json(['status'=>1,'msg'=>"成功",'data'=>$groupworkerlist]);
     * }else{
     * return json(['status'=>1,'msg'=>"未获得数据！",'data'=>$groupworkerlist]);
     * }
     * }else{
     * return json(['status'=>0,'msg'=>"没有获得请求数据！"]);
     * }
     * }
     * }else{
     * //不存在worker_id
     *
     * if($group_id==1){return json(['status'=>1,'msg'=>"该部门没有上级"]);die();}else{}
     * if($group_id>1){
     * $hj=Db::view('mf_role','role_name')
     * ->view('mf_worker','worker_id,group_id,worker_name,pid','mf_role.role_id=mf_worker.role_id')
     * ->where('group_id','eq',1)
     * ->where('status','eq',1)
     * ->where('worker_id','neq',$worker_id)
     * ->where('pid','eq',0)
     * ->select();
     * //echo($hj);exit;
     *
     *
     * $groupworkerlist = Db::view('mf_role','role_name')
     * ->view('mf_worker','worker_id,group_id,worker_name,pid','mf_role.role_id=mf_worker.role_id')
     * ->where(['group_id'=>$group_id,'status'=>1])
     *
     * ->select();
     *
     * foreach($hj as $row){
     * $groupworkerlist[]=$row;
     * }
     *
     * array_walk_recursive($groupworkerlist, function (& $val, $key )
     * {if ($val === null) {$val = '';} });
     *
     * if($groupworkerlist){
     * return json(['status'=>1,'msg'=>"成功",'data'=>$groupworkerlist]);
     * }else{
     * return json(['status'=>1,'msg'=>"未获得数据！",'data'=>$groupworkerlist]);
     * }
     * }else{
     * return json(['status'=>0,'msg'=>"没有获得请求数据！"]);
     * }
     * }
     * }
     */
    
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
                'status' => 1,
                'msg' => "请填写手机号!"
            ]);
        }
        
        $group_id = trim(input('group_id'));
        if (! $group_id) {
            return json([
                'status' => 1,
                'msg' => "请选择部门!"
            ]);
        }
        
        $role_id = trim(input('role_id'));
        if (! $role_id) {
            return json([
                'status' => 1,
                'msg' => "请选择职务!"
            ]);
        }
        
        $worker_name = trim(input('worker_name'));
        $worker_name = htmlspecialchars($worker_name);
        if (! $worker_name) {
            return json([
                'status' => 1,
                'msg' => "请填写姓名!"
            ]);
        }
        
        $sex = trim(input('sex'));
        $sfz = trim(input('sfz'));
        $sfz = htmlspecialchars($sfz);
        
        if (! $worker_name) {
            return json([
                'status' => 1,
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
        if ($worker_name && $tel && $group_id && $role_id && $sfz && is_numeric($pid)) {
            
            if (preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $tel)) {
                $dataa = [
                    'phone' => $tel,
                    'sfz' => $sfz,
                    'group_id' => $group_id,
                    'role_id' => $role_id,
                    'worker_name' => $worker_name,
                    'sex' => $sex,
                    'pid' => $pid,
                    'token' => $token,
                    'status' => 1
                ];
                
                // $data=array_filter($dataa);
                $data = array_diff($dataa, [
                    NULL,
                    ''
                ]);
                
                $res_f = Db::table('mf_worker')->where('phone', $tel)
                    ->where('worker_name', $worker_name)
                    ->where('group_id', $group_id)
                    ->where('role_id', $role_id)
                    ->where('sfz', $sfz)
                    ->where('status', 1)
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
        $con['status'] = 1;
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

    // 人员编辑页面 使用
    public function workeredit_a()
    {
        $edit_id = trim(request()->param('worker_id'));
        if (is_numeric($edit_id)) {
            
            $group_id = Db::table('mf_worker')->where([
                'worker_id' => $edit_id,
                'status' => 1
            ])->value('group_id');
            $role_id = Db::table('mf_worker')->where([
                'worker_id' => $edit_id,
                'status' => 1
            ])->value('role_id');
            
            $pid_id = Db::table('mf_worker')->where([
                'worker_id' => $edit_id,
                'status' => 1
            ])->value('pid');
            
            $people_name = Db::table('mf_worker')->where([
                'worker_id' => $pid_id,
                'status' => 1
            ])->value('worker_name');
            
            $pid_role_id = Db::table('mf_worker')->where([
                'worker_id' => $pid_id,
                'status' => 1
            ])->value('role_id');
            $role_name_sel = Db::table('mf_role')->where('role_id', $pid_role_id)->value('role_name');
            
            $group_sel = Db::table('mf_group')->select();
            
            $role_sel = Db::table('mf_role')->select();
            
            $people_sel = Db::view('mf_worker', 'pid,group_id,worker_name')->view('mf_role', 'role_name', 'mf_role.role_id=mf_worker.role_id')
                ->where('group_id', $group_id)
                ->select();
            
            $group_sel['now_group_id'] = $group_id;
            $role_sel['now_group_id'] = $role_id;
            $people_sel['now_worker_id'] = $pid_id;
            
            $editsql = Db::view('mf_role', 'role_name')->view('mf_worker', 'phone,group_id,sex,worker_name,role_id,sfz', 'mf_role.role_id=mf_worker.role_id')
                ->where('worker_id', $edit_id)
                ->find();
            
            $edsq[] = [
                'grouplist' => $group_sel,
                'role_list' => $role_sel,
                'people_list' => $people_sel,
                'personal' => $editsql
            ];
            
            array_walk_recursive($edsq, function (& $val, $key) {
                if ($val === null) {
                    $val = '';
                }
            });
            
            if ($editsql) {
                return json([
                    'status' => 1,
                    'msg' => "编辑成功",
                    'data' => $edsq
                ]);
            } else {
                return json([
                    'status' => 0,
                    'msg' => "编辑失败"
                ]);
            }
        } else {
            return json([
                'status' => 0,
                'msg' => "人员id不能为空！"
            ]);
        }
    }

    // 编辑执行页面 使用
    public function workeredit_do()
    {
        $worker_id = trim($_POST['worker_id']);
        if (! $worker_id) {
            return json([
                'status' => 1,
                'msg' => "没有获得当前人员Id!"
            ]);
        }
        $worker_name = trim($_POST['worker_name']);
        if (! $worker_name) {
            return json([
                'status' => 1,
                'msg' => "请填写姓名!"
            ]);
        }
        // $worker_name = htmlspecialchars($worker_name);
        $sex = trim($_POST['sex']);
        $sfz = trim($_POST['sfz']);
        if (! $sfz) {
            return json([
                'status' => 1,
                'msg' => "请填写身份证!"
            ]);
        }
        // $sfz = htmlspecialchars($sfz);
        // $tel=trim($_POST['tel']);
        // $tel = htmlspecialchars($tel);
        $role_id = trim($_POST['role_id']);
        if (! $role_id) {
            return json([
                'status' => 1,
                'msg' => "请选择职务!"
            ]);
        }
        $group_id = trim($_POST['group_id']);
        if (! $role_id) {
            return json([
                'status' => 1,
                'msg' => "请选择部门!"
            ]);
        }
        if ($group_id == 1) {
            $pid = 0;
        } else {
            $pid = trim($_POST['pid']);
        }
        
        $token = trim($_POST['token']);
        
        if ($worker_id && $worker_name && $group_id && $role_id && $sfz && is_numeric($pid)) {
            
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
                'sfz' => $sfz,
                'role_id' => $role_id,
                'pid' => $pid,
                'group_id' => $group_id,
                'token' => $token,
                'worker_code' => $code
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


}