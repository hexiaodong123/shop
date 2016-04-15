<?php namespace Admin\Controller;

class GoodsCategoryController extends BaseController
{
   protected $meta_name="商品分类";

    public function index(){
        $keyword=I('get.keyword');
        $result=$this->model->getResult($keyword);
        $this->assign('meta_name',$this->meta_name);
        $this->assign('rows',$result);
        $this->display('index');
    }

    public function add(){
        header('Content-Type:text/html;charset=utf-8');
        $field="id,parent_id,name";
        $result=$this->model->arrToJson($field);
        if(IS_POST){

        }else{
            if(I('get.id')!==''){
                $row=$this->model->getResult('','',I('get.id'));
                $this->assign('row',$row[0]);
            }
            $this->assign('zNodes',$result);
            $this->assign('meta_name',$this->meta_name);
            $this->display('edit');
        }
    }

}