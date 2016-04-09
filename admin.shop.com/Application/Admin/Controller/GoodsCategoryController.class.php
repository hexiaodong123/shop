<?php namespace Admin\Controller;

class GoodsCategoryController extends BaseController
{
    protected $meta_name = "商品分类";
    public function index(){
//        $keyword=urlencode(I('get.keyword'));
        $keyword=I('get.keyword');
        $result=$this->model->getPageResult($keyword);
        $this->assign('rows',$result);
        $this->display('index');
    }

}