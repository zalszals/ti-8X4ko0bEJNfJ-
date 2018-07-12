<?php
namespace app\menu\controller;

use think\Controller;
use think\Request;
use think\Db;
use think\Model;
use app\menu\model\Menu as MenuSel;
use think\Paginator;

define('APP_NAME','');//MF1_0_7
header("Content-Type:text/html; charset=utf-8");
class Menu extends Controller
{
    public function index()
    {
       
        return $this-> fetch();
    }

    public function menu(){
        return $this-> fetch();
    }

    public function menu_add_select(){
        if(request()->isPost()) {
            $request = Request::instance();
            $newarr = $request->param();

             if ($_POST) {
                 $movieId=$_POST['movieId'];
                 if(!$movieId){
                     return json(array('selectok' => '0', 'txta' => '数据添加失败'));
                     exit;
                 }
                 //$sql_zid=Db::table('mf_menu_node')->where('pid',$movieId)->where('status',1)->select();
                 $sql_zid=Db::table('mf_menu_node')->where('pid',$movieId)->select();
                 if($sql_zid){
                     $re['selectok'] = 1;
                     $re['data'] = $sql_zid;
                 }else{
                     $re['selectok'] = 0;
                 }
                 return json($re);
             }else{
                 return json(array('selectok' => '0', 'txta' => '数据添加失败'));
             }
        }
        return $this-> fetch('menu_add');
    }
    public function menu_add(){

        $sql_pid=Db::table('mf_menu_node')->where('pid',0)->select();
        $this->assign('pid',$sql_pid);

        if(request()->isPost()) {
            $newarr=$_POST;
            if($newarr) {
                $quiz1 = $newarr['quiz1'];
                $quiz2 = isset($newarr['quiz2'])? $newarr['quiz2']:'';
                //$quiz2 = $newarr['quiz2'];
                $english = $newarr['english'];
                $chinaese =$newarr['chinaese'];
                $modules = $newarr['modules'];
                $sex = $newarr['sex'];
                //$jajax = $newarr['jajax'];
                $is_api = $newarr['is_api'];
                $author = $newarr['author'];
                $remark = $newarr['remark'];

                $creat_time = time();

                if($quiz2==''||$quiz2==0){
                    $res_f= Db::table('mf_menu_node')
                    ->where('name',$english)
                    ->where('title',$chinaese)
                    ->where('level',$modules)
                    ->where('pid',$quiz1)
                    ->where('status',$sex)
                    ->select();
                    if($quiz1==2){$group_id=1;}elseif($quiz1==1){$group_id=2;}else{$group_id=0;}

                    if (!$res_f) {

                        $urlname=Db::table('mf_menu_node')->where('node_id',$quiz1)->value('name');
                    
                        $recode="/".$urlname."/".$english;

                        $dataa = ['name' =>$english, 'title' =>$chinaese, 'status' => $sex, 'sort' => 1,'is_api'=>$is_api,
                             'level' => $modules, 'pid' => $quiz1,'group_id' => $group_id,'creat_author'=>$author, 
                             'remark'=>$remark,'creat_time'=>$creat_time,'record'=>$recode];
                        $new_res = Db::table('mf_menu_node')->insert($dataa);

                        if($new_res){
                            $res_nodeid= Db::table('mf_menu_node')
                                ->where('name',$english)
                                ->where('title',$chinaese)
                                ->where('level',$modules)
                                ->where('pid',$quiz1)
                                ->where('status',$sex)
                                ->value('node_id');
                            $urlcode=Db::table('mf_menu_node')->where('node_id',$quiz1)->value('code');
                            $code=$urlcode.",(".$res_nodeid.")";
                            Db::table('mf_menu_node')->where('node_id',$res_nodeid)->update(['code'=>$code]);

                            return json(array('status' => '200', 'txt' => '数据添加成功'));
                        }else{
                            return json(array('status' => '0', 'txt' => '数据添加失败'));
                        }
                    }else{return json(array('status' => '0', 'txt' => '添加失败，数据已经存在！'));}

                }else{
                    $res_ff= Db::table('mf_menu_node')
                    ->where('name',$english)
                    ->where('title',$chinaese)
                    ->where('level',$modules)
                    ->where('pid',$quiz2)
                    ->where('status',$sex)
                    ->select();
                    if($quiz1==2){$group_id=1;}elseif($quiz1==1){$group_id=2;}else{$group_id=0;}
                    if (!$res_ff) {

                        $urlname=Db::table('mf_menu_node')->where('node_id',$quiz2)->value('record');

                        $recode=$urlname."/".$english;
                       
                        $datad = ['name' =>$english, 'title' =>$chinaese, 'status' => $sex, 'sort' => 1,'is_api'=>$is_api,
                             'level' => $modules, 'pid' => $quiz2,'group_id' => $group_id,'creat_author'=>$author, 
                             'remark'=>$remark,'creat_time'=>$creat_time,'record'=>$recode ];
                        $new_resa = Db::table('mf_menu_node')->insert($datad);
                        
                        if($new_resa){

                            $res_nodeid= Db::table('mf_menu_node')
                                ->where('name',$english)
                                ->where('title',$chinaese)
                                ->where('level',$modules)
                                ->where('pid',$quiz2)
                                ->where('status',$sex)
                                ->value('node_id');
                            $urlcode=Db::table('mf_menu_node')->where('node_id',$quiz2)->value('code');
                            $code=$urlcode.",(".$res_nodeid.")";
                            Db::table('mf_menu_node')->where('node_id',$res_nodeid)->update(['code'=>$code]);

                            return json(array('status' => '200', 'txt' => '数据添加成功'));
                        }else{
                            return json(array('status' => '0', 'txt' => '数据添加失败'));
                        }
                    }else{return json(array('status' => '0', 'txt' => '添加失败，数据已经存在！'));}

                }

            }
        }
     return $this-> fetch();
    }

    public function menu_list1(){
        $cate=MenuSel::getCate();
        //$cate_list=Db::name('mf_menu_node')->paginate(8);
        $cate_pagis=MenuSel::paginate(8);
        $count=MenuSel::count();
       //$this->view->assign('cate_list',$cate_list);
        $this->view->assign('cate_pagis',$cate_pagis);
        $this->view->assign('cate',$cate);
        $this->view->assign('count',$count);
        return $this-> fetch();
    }
	 public function menu_list(){
         

        $row = 15;//每页的条数；
		$num = Db::name('menu_node')->where('status','neq',0)->count();//总条数
		$page = ceil($num/$row);//总页数
		/* if($page<1){
			$page = 1;
		}
		$p = $this->request->param('p');//页码数通过get下面的棚值传递值
		if($p<1){
			$p  = 1;
		}elseif($p>$page){
			$p = $page;
		} */
		
		//$data = Db::name('menu_node')->page($p,$row)->select();//使用page分页
		$data = Db::name('menu_node')->where('status','neq',0)->paginate(config('paginate.list_rows'));
        // 获取分页显示
        $pages = $data->render();  


        $zcate=MenuSel::getCate();
        $this->assign("zcate",$zcate);

        $this->assign("cate",$data);
		//$this->assign("cate",$data);//数据
		$this->assign("page",$page);//总页数
		$this->assign("pages",$pages);//分页显示
		//$this->assign("p",$this->currentPage());//当前页
		$this->assign("num",$num);//总条数
		 
        return $this-> fetch();
    }
	
	
	
	
    public function menu_nav_left(){
        $cate=MenuSel::getCate();
        $this->assign('cate',$cate);
        return $this-> fetch();
    }


    public function menu_del1()
    {
        if($_POST){

            $lit_arr=$_POST['subBox'];

            foreach($lit_arr as $del_id){


                $dbsql=Db::table('mf_menu_node')->where('pid',$del_id)->where('status',1)->select();
                if(!$dbsql){
                    $res=Db::table('mf_menu_node')->where('node_id',$del_id)->update(['status'=>0]);
                }else{
                    return $res=1;  
                }

            }
            if($res){
                echo "<script>alert('删除成功！');location.href='menu_list';</script>";
            }else{
                     echo "<script>alert('有方法存在不能直接删除！');location.href='menu_list';</script>";
            }

        }else{
            echo "<script>alert('请选择删除菜单！');location.href='menu_list';</script>";
        }
        return $this-> fetch('menu_list');
    }

	
	
	
	
	
	
	
	//删除(3/9)
	public function menu_del()
    {
		$node_id = $this->request->param('node_id');
		$con['node_id'] = $node_id;
		$info = Db::name('menu_node')->where($con)->find();
		if($info){
			$level = $info['level'];
			//dump($level);die;
			switch($level){
				case 1:
					$re['status'] = -1;
					$re['msg'] = "此模块不能删除，请重新选择";
					ajaxReturnJson($re);
					break;
				case 2:
					$con1['pid'] = $node_id;
					$k_info = Db::name('menu_node')->where($con1)->select();
					if($k_info){
						$re['status'] = 2;
						$re['node_id'] = $node_id;
						$re['msg'] = '有方法存在不能直接删除，确认要删除吗？';
						ajaxReturnJson($re);
					}
					break;
				case 3:
					$delinfo = Db::name('menu_node')->where($con)->delete();
					if($delinfo !== false){
						$re['status'] = 1;
						$re['msg'] = "删除成功";
					}else{
						$re['status'] = 0;
						$re['msg'] = "删除失败";
					}
					ajaxReturnJson($re);
					break;
			}
		}
		
		/* if($node_id){
			$con['pid'] = $node_id;
			$dbsql=Db::table('mf_menu_node')->where($con)->select();
			if(!$dbsql){
				$con1['node_id'] = $node_id;
				$res=Db::table('mf_menu_node')->where($con1)->delete();
				if($res !== false){
					$re['status'] = 1;
					$re['msg'] = '删除成功';
				}else{
					$re['status'] = 0;
					$re['msg'] = '删除失败';
				}					
			}else{//如果不是的话
				$re['status'] = 2;
				$re['node_id'] = $node_id;
				$re['msg'] = '有方法存在不能直接删除，确认要删除吗';  
			}			
        }else{
			$re['status'] = -1;
			$re['msg'] = '非法操作';
		}		  
        ajaxReturnJson($re); */
    }
	
	//执行将子级一起删除
	public function menu_delson(){
		$node_id = $this->request->param('node_id');
		if(!$node_id){
			$result['status']=0;
			$result['msg'] = "菜单id为空";
			ajaxReturnJson($result);
		}
		$con['pid'] = $node_id;
		$con1['node_id'] = $node_id;
		$infos = Db::name('menu_node')->where($con)->delete();
		$info = Db::name('menu_node')->where($con1)->delete();
		if($infos!==false && $info!==false){
			$result['status'] = 1;
			$result['msg'] = "删除成功";
			ajaxReturnJson($result);
		}else{
			$result['status'] = 0;
			$result['msg'] = "删除失败";
			ajaxReturnJson($result);
		}
		
	}
	
	
	
	

    public function update(){
        
        $upd=MenuSel::getCate();
        $uid=Request()->param('id');
        $update=MenuSel::get($uid);

        $this->assign('upd',$upd);
        $this->assign('update',$update);

        return $this->fetch();
    }

    public function update_do(){
        if(request()->isPost()){
            $newid=$_POST['node_id'];
            $name=$_POST['name'];
            $title=$_POST['title'];
            $status=$_POST['status'];
            $sort=$_POST['sort'];
            $is_api=$_POST['is_api'];
            //$is_ajax=$_POST['is_ajax'];
            $creat_author=$_POST['creat_author'];
            $remark=$_POST['remark'];
			$con['node_id'] = $newid;
			$level = Db::name('menu_node')->where($con)->value('level');
			
			
			switch($level){
				case 1:
					$name=$_POST['name'];
					$record = '/'.$name;
					break;
				case 2:
					$k_name=$_POST['name'];
					$m_name = Db::name('menu_node mn')
							->join('menu_node mn1','mn1.node_id = mn.pid')
							->where($con)
							->value('mn1.name');
					$record = '/'.$m_name.'/'.$k_name;
					break;
				case 3:
					$con1['mn.node_id'] = $newid;
					$f_name = $_POST['name'];
					$k_name = Db::name('menu_node mn')
							->join('menu_node mn1','mn1.node_id = mn.pid')
							->where($con1)
							->value('mn1.name');
					$m_name = Db::name('menu_node mn')
							->join('menu_node mn1','mn1.node_id = mn.pid')
							->join('menu_node mn2','mn2.node_id = mn1.pid')
							->where($con1)
							->value('mn2.name');
					$record = '/'.$m_name.'/'.$k_name.'/'.$f_name;
					break;
			}
			
			
            
            $creat_time = time();
			
			
			
			
            $upda=['name' => $name, 'title' => $title, 'status' => $status, 'sort' => $sort,'is_api'=> $is_api, 'creat_author'=> $creat_author,'creat_time'=>$creat_time,
                'remark'=> $remark,'record' => $record];
			
          $dsaf = Db::table('mf_menu_node')->where($con)->update($upda);

          if($dsaf){
            return json(array('st' => '1', 'txt' => '数据更新成功'));

          }else{
            return json(array('st' => '0', 'txt' => '数据未做更新处理'));
          }


        }

        return $this->fetch('update');  
    }


    public function menu_option_select(){
            $id=request()->param('id');
            if(!$id){
                 $id=0;
                $cate=MenuSel::getCate($id);
                $zcate=MenuSel::getCate();
            
            }else{
                $cate=MenuSel::getCate($id);
                $zcate=MenuSel::getCate();
                //return json(['status'=>1,'data'=>$select]);

            }


            $this->assign("cate",$cate);
            $this->assign("zcate",$zcate);
            return $this->fetch();

    }








}
