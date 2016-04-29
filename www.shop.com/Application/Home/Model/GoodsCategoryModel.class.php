<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/23
 * Time: 11:13
 */

namespace Home\Model;


use Think\Model;

class GoodsCategoryModel extends Model
{
    public function getCategory(){
        $result=S('goods_category');
        if(empty($result)){
            $result=$this->order(`left`)->select();
            S('goods_category',$result);
        }
        return $result;
   }

    public function getParentCategory($id){
        $record=$this->where(array('id'=>$id))->select()[0];
        $left=$record['left'];
        $right=$record['right'];
        $result=$this->query("select * from goods_category where `left`<=$left and `right`>=$right order by `left`");
        return $result;
    }

    public function getChildCategory($id){
        $record=$this->where(array('id'=>$id))->select()[0];
        $left=$record['left'];
        $right=$record['right'];
        $result=$this->query("select * from goods_category where `left`>$left and `right`<$right order by `left`");
        array_unshift($result,$record);
        return $result;
    }

    public function getChildCategoryId($id){
        $result=$this->getChildCategory($id);
        $arr=array();
        array_unshift($arr,$id);
        foreach($result as $value){
            $arr[]=$value['id'];
        }
        return $arr;
    }

}