<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/24
 * Time: 11:18
 */

namespace Home\Model;


use Think\Model;

class GoodsModel extends Model
{
    public function getGoodsInfo($is_recommend='',$category_id='',$num='',$goods_id=''){
        $condition=array();
        $condition['status']=array('eq',1);
        if($is_recommend!==''){
            $condition['is_recommend']=array('in',$is_recommend);
        }
        if($category_id!==''){
            $condition['goods_category']=array('in',$category_id);
        }
        if($goods_id!==''){
            $condition['id']=array('eq',$goods_id);
        }
        if($num!==''){
            $result=$this->where($condition)->limit($num)->select();
        }else{
            $result=$this->where($condition)->select();
        }
        return $result;
    }


}