<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/25
 * Time: 13:36
 */

namespace Home\Controller;


use Think\Controller;

class MemberController extends Controller
{
    public function reg(){
        if(IS_POST){
            header('Content-type:text/html;charset=utf-8');
            $model=D('member');
            $data=$model->create();
            $result=$model->register($data);
            if($result==false){
                $this->error('注册失败'.error($model));
            }else{
                $this->success('注册成功',U('login'),100);
            }
        }else{
            $this->display('regist');
        }


    }

    public function login(){
        if(IS_POST){
            $model=D('member');
            $data=$model->create();
            if($data!==false){
                $result=$model->login($data);
                if($result!==false){
                    session('userinfo',$result);
                    $this->success('登录成功',cookie('forward_url'));
                    return;
                }
            }
            $this->error('登录失败'.error($model));

        }else{
            $this->display('login');
        }

    }

    public function logout(){
        session('userinfo',null);
        $this->redirect('Index/index');
    }

    public function check(){
        $data=I('get.');
        $model=D('member');
        $result=$model->check($data);
        $this->ajaxReturn($result);
    }


}