<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/11
 * Time: 11:27
 */


namespace app\menu\model;

use think\Paginator;
use think\Collection;
use think\Model;
use think\Db;


class Menu extends Model {
    //定义表名
    protected $table='mf_menu_node';
    //分类树结构
    public static function getCate($pid=0,&$result=[],$blank=0){

        $dada['pid']=$pid;
        $dada['status']=array('neq',0);
        $res=self::all($dada);

		
		
        $blank +=2;
        foreach($res as $key=>$value){

            if($value['pid']==0){$cate_name=$value->title;}else{
            $cate_name='|--'.$value->title;
            $value->title=str_repeat('&nbsp',$blank).$cate_name;
           }
            $result[]=$value;
            self::getCate($value->node_id,$result,$blank);

        }

        return Collection::make($result)->toArray();
    }




}
