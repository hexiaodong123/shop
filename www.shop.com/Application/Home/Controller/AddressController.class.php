<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/28
 * Time: 14:54
 */

namespace Home\Controller;


use Think\Controller;

class AddressController extends Controller
{
    public function index(){
        //>>获取商品分类数据
        $category_model=D('GoodsCategory');
        $goods_categorys=$category_model->getCategory();
        //>>获取收货人信息数据
        $model=D('Address');
        if(is_login()){
            $userinfo=login()[0];
            $user_id=$userinfo['id'];
            $address_info=$model->getList($user_id);
        }else{

        }
        //>>获取省的数据
        $province_data=D('hat_province')->select();
        /*dump($address_info);
        exit;*/

        //分配数据到页面
        $this->assign('province_data',$province_data);
        $this->assign('goods_categorys',$goods_categorys);
        $this->assign('address_infos',$address_info);
        $this->assign('userinfo',login()[0]);
        $this->display('index');
    }

    public function add(){
        $model=D('Address');
        $data=$model->create();
        //>>对收集到的地址信息进行处理，将省市县的id变为名字,将status的值变为1（若存在）
        $data=$model->handleData($data);
        $id=$model->add($data);
        $data['id']=$id;
        $this->ajaxReturn($data);
    }

    public function getCityAddress(){
        $id=I('post.province_id');
        $city_data=D('hat_city')->where(array('father'=>$id))->select();
        $this->ajaxReturn($city_data);
    }

    public function getTownAddress(){
        $city_id=I('post.city_id');
        $town_data=D('hat_area')->where(array('father'=>$city_id))->select();
        $this->ajaxReturn($town_data);
    }

    public function getAddressinfo(){
        $id=I('post.id');
        $model=D('address');
        $address_info=$model->where("id=$id")->select()[0];
        $data=$model->nameToId($address_info);//省市县的名字转换为id
        $this->ajaxReturn($data);
    }

}