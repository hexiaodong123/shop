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

    public function getPageResult($keyword=''){
        //>>1.获取查询的总记录数
        $condition['status']=array('gt',-1);
        $condition['name']=array('exp',"like '%$keyword%'");
        $count=$this->where($condition)->count();
        //>>2.实例化page类对象,传入总记录数和每页显示的记录数
        $page=new \Think\Page($count,4);
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


}