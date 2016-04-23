<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/5
 * Time: 13:23
 */

namespace Admin\Model;


use Think\Model;

class BaseModel extends Model
{
    protected $patchValidate=true;

    public function getPageResult($keyword='',$condition=''){
        //>>1.先对查询条件进行处理
        $this->_handleCondition($condition,$keyword);
        //>>2.获取总的记录数
        $count=$this->where($condition)->count();
        //>>3.实例化page类对象,传入总记录数和每页显示的记录数
        $page=new \Think\Page($count,10);
        //>>3.获取分页工具条
        $show=$page->show();
        //>>4.获取分页数据
        $list=$this->where($condition)->limit($page->firstRow,$page->listRows)->select();
        //>>5.保存分页工具条和分页数据
        $result['html']=$show;
        $result['data']=$list;
        return $result ;
    }


    public function changeStatus($id,$status=-1){
        $data['status']=$status;
        if($status==-1){
            $data['name']=array('exp',"concat(name,'_del')");
        }
        $data['id']=array('in',$id);
        $result=parent::save($data);
        return $result;
    }

    public function getResult($keyword='',$field='*',$id=0){
        if($id!==0){
            $condition['id']=array('eq',$id);
        }
        $condition['name']=array('like',"%$keyword%");
        $condition['status']=array('gt','-1');
        return $this->_excuteSql($field,$condition);
    }

    public  function receive($row){
        $rows=array();
        $rows['keyword']=$row['keyword'];
        if($row['goods_category']!=0){
            $rows['condition']['goods_category']=$row['goods_category'];
        }
        if($row['goods_brand']!=0){
            $rows['condition']['goods_brand']=$row['goods_brand'];
        }
        if($row['is_recommend']=='is_best'){
            $rows['condition']['is_recommend']=array(1,3,5,7);
        }elseif($row['is_recommend']=='is_new'){
            $rows['condition']['is_recommend']=array(2,3,6,7);
        }elseif($row['is_recommend']=='is_hot'){
            $rows['condition']['is_recommend']=array(4,5,6,7);
        }
        if($row['status']!=''){
            $rows['condition']['status']=$row['status'];
        }
        return $rows;

    }

    protected function _excuteSql($field,$condition){ }

    public function _handleData(&$data){}

    protected function _handleCondition(&$condition,$keyword){
        $condition=array();
        $condition['status']=array('gt',-1);
        $condition['name']=array('exp',"like '%$keyword%'");
    }




}