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
        $this->display('register');

    }

    public function login(){
        $this->display('login');

    }

}