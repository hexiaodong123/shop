<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    protected function getCategory(){  //获取所有商品分类数据
        $category_model=D('GoodsCategory');
        $goods_categorys=$category_model->getCategory();
        return $goods_categorys;
    }

    public function index()
    {

        //>>1.获取所有商品分类数据
        $goods_categorys=$this->getCategory();
        //>>2.获取商品数据
        $goods_model=D('goods');
        $goods_1s=$goods_model->getGoodsinfo('1,3,5,7','',5);
        $goods_2s=$goods_model->getGoodsinfo('2,3,6,7','',5);
        $goods_3s=$goods_model->getGoodsinfo('4,5,6,7','',5);
        //>>保存当前页面,以便登录后跳转回来
        cookie('forward_url',$_SERVER['REQUEST_URI']);

        //>>3.将数据分配到前台页面
        $this->assign('title_name',"三亿商城");
        $this->assign('userinfo',session('userinfo')[0]);
        $this->assign('goods_1s',$goods_1s);
        $this->assign('goods_2s',$goods_2s);
        $this->assign('goods_3s',$goods_3s);
        $this->assign('goods_categorys',$goods_categorys);
        $this->display('index'); //展示首页
    }

    public  function lst($id=8){
        //>>获取所有商品分类数据
        $goods_categorys=$this->getCategory();
        //>>获取当前类及其父类
        $parent_categorys=D('goods_category')->getParentCategory($id);
        //>>获取当前类及其子类
        $child_categorys=D('goods_category')->getChildCategory($id);
        //>>获取当前类及其子类的id
        $child_categorys_id=D('goods_category')->getChildCategoryId($id);
        //>>获取当前类及其子类对应的商品
        $goods=D('goods')->getGoodsInfo('',$child_categorys_id);
        //>>获取当前类及其子类对应的热销商品
        $goods_hot=D('goods')->getGoodsInfo('4,5,6,7',$child_categorys_id,3);
        //>>获取当前类及其子类对应的新品
        $goods_new=D('goods')->getGoodsInfo('1,3,5,7',$child_categorys_id,3);
        //>>保存当前页面,以便登录后跳转回来
        cookie('forward_url',$_SERVER['REQUEST_URI']);


        //>>3.将数据分配到前台页面
        $this->assign('userinfo',session('userinfo')[0]);
        $this->assign('child_categorys',$child_categorys);
        $this->assign('goods_hot',$goods_hot);
        $this->assign('goods_new',$goods_new);
        $this->assign('goods',$goods);
        $this->assign('parent_categorys',$parent_categorys);
        $this->assign('goods_categorys',$goods_categorys);
        $this->display('list');//展示商品列表
    }

    public  function goods($id=39){
        //>>获取分类数据
        $goods_categorys=$this->getCategory();
        //>>获取商品数据
        $goods_info=D('goods')->getGoodsInfo('','','',$id);
        //>>获取当前商品的父类
        $category_id=$goods_info[0]['goods_category'];
        $parentCategorys=D('goods_category')->getParentCategory($category_id);
        $parentCategorys[]=$goods_info[0];
        //>>保存当前页面,以便登录后跳转回来
        cookie('forward_url',$_SERVER['REQUEST_URI']);


        //>>3.将数据分配到前台页面
        $this->assign('userinfo',session('userinfo')[0]);
        $this->assign('parentCategorys',$parentCategorys);
        $this->assign('goods_info',$goods_info[0]);
        $this->assign('goods_categorys',$goods_categorys);
        $this->display('goods');//展示商品列表
    }
}