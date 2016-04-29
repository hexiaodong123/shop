<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/27
 * Time: 21:10
 */

namespace Home\Controller;


use Think\Controller;

class ShoppingCarController extends Controller
{
    public function index(){
        $model=D('shopping_car');
        if(is_login()){
            $userinfo=login(); //获取当前用户id,根据用户id获取用户购物车信息
            $shoppingData=$model->getList($userinfo[0]['id']);
        }
        //>>保存当前页面,以便登录后跳转回来
        cookie('forward_url',$_SERVER['REQUEST_URI']);

        $this->assign('shoppingDatas',$shoppingData);
        $this->assign('userinfo',login()[0]);
        $this->display('index');
    }

    public function add(){
        $model=D('shopping_car');
        $data=$model->create();
        $result=$model->add($data);
        if($result){
            $this->success('添加成功',U('index'));
        }else{
            $this->error('添加失败'.error($model));
        }

    }

    public  function remove(){
        $id=I('get.id');
        $result=D('shopping_car')->remove($id);
        if($result!==false){
            $this->success('删除成功',U('index'));
        }else{
            $this->error('删除失败'.error(D('shopping_car')));
        }

    }

}