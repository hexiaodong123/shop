<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/28
 * Time: 15:23
 */

namespace Home\Model;


use Think\Model;

class AddressModel extends Model
{
    protected $_auto=array(
        array('user_id','get_user_id',3,'callback'),
    );
    public function get_user_id(){
        $userinfo=login();
        return $userinfo[0]['id'];
    }

    public function handleData(&$data){  //省市县id转换为名字
        $province_id=$data['province_id'];
        $province_name=D('hat_province')->where("provinceID=$province_id")->select()[0]['province'];
        $data['province']=$province_name;

        $city_id=$data['city_id'];
        $city_name=D('hat_city')->where("cityID=$city_id")->select()[0]['city'];
        $data['city']=$city_name;

        $town_id=$data['town_id'];
        $town_name=D('hat_area')->where("areaID=$town_id")->select()[0]['area'];
        $data['town']=$town_name;

        if(array_key_exists('status',$data)){
            $data['status']=1;
        }
        return $data;
    }

    public function add($data){
        if($data['status']==1){
            $user_id=$data['user_id'];
            $arr['status']=0;
            $this->where("user_id=$user_id")->save($arr);
        }
        return parent::add($data);
    }

    public function getList($user_id='',$address_id=''){
        $condition=array();
        if($user_id!==''){
            $condition['user_id']=$user_id;
        }
        if($address_id!==''){
            $condition['id']=$address_id;
        }
        $result=$this->where($condition)->select();
        return $result;
    }

    public  function nameToId(&$data){
        $province=$data['province'];
        $city=$data['city'];
        $town=$data['town'];


    }

}