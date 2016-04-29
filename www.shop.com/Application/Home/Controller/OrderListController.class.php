<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/28
 * Time: 14:29
 */

namespace Home\Controller;


use Think\Controller;

class OrderListController extends Controller
{
    public function index(){

    }

    public function detail(){
        if(is_login()){

        }else{

        }
        $this->display('detail');
    }

}