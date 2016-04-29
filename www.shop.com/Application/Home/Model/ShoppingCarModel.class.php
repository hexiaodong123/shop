<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/27
 * Time: 21:30
 */

namespace Home\Model;


use Think\Model;

class ShoppingCarModel extends Model
{
    public function add($data){
        if(is_login()){
            $userinfo=login();
            $user_id=$userinfo[0]['id'];
            $goods_id=$data['goods_id'];
            $goods_num=$data['goods_num'];
            //>>判断该用户是否已在购物车中添加了该商品
            $is_exist=$this->where(array('user_id'=>$user_id,'goods_id'=>$goods_id))->select();
            if(!empty($is_exist)){ //已添加
               return $this->where(array('user_id'=>$user_id,'goods_id'=>$goods_id))->setInc('goods_num',$goods_num);
            }else{  //未添加
                $data['user_id']=$user_id;
                return parent::add($data);
            }
        }else{

        }
    }

    public function getList($id){
        $condition['user_id']=array('eq',$id);
        $shoppingCarData=$this->where($condition)->select();
        $goods_info=array();
        foreach($shoppingCarData as $item){
            $data=D('goods')->where(array('id'=>$item['goods_id']))->select()[0];
            $data['goods_num']=$item['goods_num'];
            $data['shopping_id']=$item['id'];
            $goods_info[]=$data;
        }
        return $goods_info;

    }

    public function remove($id){
        return $this->where(array('id'=>$id))->delete();
    }

}