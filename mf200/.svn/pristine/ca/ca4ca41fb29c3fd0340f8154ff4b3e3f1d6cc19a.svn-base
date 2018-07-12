<?php
namespace app\laychat\controller;
use think\Controller;
use think\Db;

class Laychat extends Controller
{
    /**
     * [get_mine 获取当前用户信息]
     * @return [type] [description]
     */
    public function get_mine()
    {
        $userid = $this->request->param('userid');
        $fields[] = 'worker_name as username';
        $fields[] = 'worker_id as id';
        $fields[] = 'img_url as avatar';
        $mine = db('worker')->where(['worker_id'=>$userid])->field(join(',',$fields))->find();
        if(!$mine['avatar']){
            $mine['avatar'] = 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1524166136153&di=8af37b2d62bafc06b0cd722caa258471&imgtype=0&src=http%3A%2F%2Fimg.zcool.cn%2Fcommunity%2F01460b57e4a6fa0000012e7ed75e83.png%401280w_1l_2o_100sh.png'; 
        }
        $re['status'] = 1;
        $re['data'] = $mine;
        ajaxReturnJson($re);
    }

    /**
     * [get_group_list description]
     * @return [type] [description]
     */
    public function get_group_list()
    {
        $fields[] = 'worker_name as username';
        $fields[] = 'worker_id as id';
        $fields[] = 'img_url as avatar';        
        $users = db('worker')->field(join(',',$fields))->order('worker_id asc')->select();
        foreach($users as $k => $row){
            if(!$row['avatar']){
                $users[$k]['avatar'] = 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1524166136153&di=8af37b2d62bafc06b0cd722caa258471&imgtype=0&src=http%3A%2F%2Fimg.zcool.cn%2Fcommunity%2F01460b57e4a6fa0000012e7ed75e83.png%401280w_1l_2o_100sh.png'; 
            }
            $users[$k]['sign'] = '';
            $users[$k]['status'] = 'online';
        }

        $re['status'] = 1;
        $re['data'] = $users;
        ajaxReturnJson($re);
    }

}