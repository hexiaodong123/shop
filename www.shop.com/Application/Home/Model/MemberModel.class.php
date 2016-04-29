<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/25
 * Time: 18:51
 */

namespace Home\Model;


use Think\Model;

class MemberModel extends Model
{
    protected $_auto=array(
       array('salt','\Org\Util\String::randString',3,'function'),
       array('regtime',NOW_TIME,3),
       array('reg_ip','get_client_ip_bigint',3,'callback'),
    );

    public function get_client_ip_bigint(){
        $ip=get_client_ip();
        return ip2long($ip);
    }
    public function check($data){

        $result=$this->where($data)->select();
        if(empty($result)){
            return true;
        }else{
            return false;
        }
    }

    public function register($data){
        $password=$data['password'];
        $salt=$data['salt'];
        $data['password']=md5(md5($password).$salt);
        $result=$this->add($data);
        if($result===false){
            $this->error="注册失败";
            return false;
        }else{
            return true;
        }

    }

    public function login($data){
        $username=$data['username'];
        $password=$data['password'];
        $condition['username']=$username;
        $result=$this->where($condition)->select();
        if(empty($result)){ //表名用户名不存在
            $this->error="用户名不存在";
            return false;
        }else{
            $salt=$result[0]['salt'];
            $password=md5(md5($password).$salt);
            if($password==$result[0]['password']){
                return $result;
            }else{
                $this->error="密码错误";
                return false;
            }

        }

    }

}