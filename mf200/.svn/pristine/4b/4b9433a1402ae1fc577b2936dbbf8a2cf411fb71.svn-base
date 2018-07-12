<?php
namespace app\base\controller;
use think\Controller;
use think\Db;

class Base extends Controller{
    //定义主服务器地址
    public $face_url = 'http://150.138.142.115';
    
    /**
     * 构造方法
     */
	public function _initialize(){
		
        header("Content-type:text/html;charset=utf-8");        
        $this->check_login();
        $this->worker = $_SESSION['worker']; 
        //$this->check_privilege();
    }
    /**
	 * [index 登录]
	 * @return [type] [description]
	 */
    public function index(){    
        return '非法请求';
    }

    /**
     * [check_login description]
     * @return [type] [description]
     */
    public function check_login(){ 
	
        $token = $this->request->param('token');        
        
        $session_id = $this->request->param('token');

        $phone = $this->request->param('phone');
        
        //验证手机
        if(!$phone){
            $re['status'] = 0;
            $re['msg'] = '无效的传值01';
            $re['nologin'] = 1;
            ajaxReturnJson($re);
        }

        //验证token
        if(!$token){
            $re['status'] = 0;
            $re['msg'] = '无效的传值02';
            $re['nologin'] = 1;
            ajaxReturnJson($re);
        }

        //session_id($session_id);
        //session_start();

        if(!array_key_exists('worker', $_SESSION)){
            $re['status'] = 0;
            $re['msg'] = '登录超时';
            $re['nologin'] = 1;    
            ajaxReturnJson($re);
        }

        if(!array_key_exists('phone', $_SESSION['worker'])){
            $re['status'] = 0;
            $re['msg'] = '无效的token';
            $re['nologin'] = 1;    
            ajaxReturnJson($re);
        }

        if($_SESSION['worker']['phone']!=$phone){            
            $re['status'] = 0;
            $re['msg'] = '非法登录';
            $re['nologin'] = 1;    
            ajaxReturnJson($re);
        }
    }

    /**
     * [check_privilege 验证用户的操作权限]
     * @return [type] [description]
     */
    public function check_privilege(){
        $request= \think\Request::instance();
        //$request->module()
        $controllerName = $request->controller();        
        $actionName = $request->action();
        $condition['m1.name'] = $controllerName;
        $condition['m.name']  = $actionName; 
        $field[] = 'm.node_id';
        $field[] = 'm.status';
        $info = Db::name('menu_node m')
                ->join('__MENU_NODE__ m1','m1.node_id = m.pid')
                ->where($condition)
                ->field(join(',',$field))
                ->find();
        
        if(!$info){
			return;
		}
        $node_id = $info['node_id'];
        $status   = $info['status'];
		
        if($this->worker['node_str'] == 'all'){
            return;
        }
		
        switch ($status) {
            case 0:
                $re['status'] = -1;
                $re['msg'] = '您没有权限';
                $this->ajaxReturn($re);
                break;
            case 1:
                if(strpos($this->worker['node_str'],(string)$node_id)===false){
                    $re['status'] = -1;
                    $re['msg'] = '您没有权限1';
                    $this->ajaxReturn($re);
                }                
                break;
            case 2:
                if(strpos($this->worker['node_str'],(string)$node_id)===false){
                    $re['status'] = -1;
                    $re['msg'] = '您没有权限2';
                    $this->ajaxReturn($re);
                }                
                break;
            case 3:
                if(strpos($this->worker['node_str'],(string)$node_id)===false){
                    $re['status'] = -1;
                    $re['msg'] = '您没有权限3';
                    $this->ajaxReturn($re);
                }                
                break;         
            default:
                # code...
                break;
        }        
    }

    /**
     * [ajaxReturn description]
     * @param  [type] $arr [description]
     * @return [type]      [description]
     */
    public function ajaxReturn(array $arr){
        header('Content-Type:application/json; charset=utf-8');
        exit(json_encode($arr,JSON_UNESCAPED_UNICODE));
    }

    /**
     * [ajax_check_have_resource 请求账号包]
     * @return [type] [description]
     */
    public function api_check_have_resource($tag=0){
        $prex = $this->get_mf_prex();
        $prex = str_replace('/','',$prex);
        //echo $prex;exit;      
        $url=$this->face_url."/index.php/User/UserInfo/get_account?"."prex=".$prex.'&cs='.$prex;  
        //echo $url; exit;   
        $data=file_get_contents($url);
        $data_arr=json_decode($data,true); 
        
        if($data_arr["status"]){
            if($tag){
                return array("status"=>1,"worker_arr"=>$data_arr['worker_arr'],"num"=>count($data_arr['worker_arr']));
            }
            $this->ajaxReturn(array("status"=>1,"worker_arr"=>$data_arr['worker_arr'],"num"=>count($data_arr['worker_arr'])));
        }else{
            if($tag){
                return array("status"=>0,"msg"=>"您的账号包已经用完了！请购买账号！");
            }
            $this->ajaxReturn(array("status"=>0,"msg"=>"您的账号包已经用完了，请购买账号包！"));
        }
    }

    /**
     * [update_account 更新账号包的状态]
     * @return [type] [description]
     */
    public function update_account($tel = '',$is_used = 1){
        $prex = $this->get_mf_prex();        
        $url = $this->face_url.'/index.php/User/UserInfo/update_account.html';
        $post_data['prex'] = $prex;
        $post_data['is_used'] = $is_used;
        $post_data['tel']  = $tel;
        $data = $this->crul_post($url,$post_data);          
        $re = json_decode($data,true);
        //print_r($re);exit;
        return $re;
    }
    
    /**
     * [get_mf_prex 获取当前账号包的前缀]
     * @return [type] [description]
     */
    public function get_mf_prex(){
        return $_SESSION['worker']['prex'];
    }

    /**
     * [crul_post post转发函数]
     * @param  [type] $url       [description]
     * @param  [type] $post_data [description]
     * @return [type]            [description]
     */
    public function crul_post($url,$post_data=NULL){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // post数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // post的变量
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $output = curl_exec($ch);
        curl_close($ch);
        //打印获得的数据
        return $output;
    }

}