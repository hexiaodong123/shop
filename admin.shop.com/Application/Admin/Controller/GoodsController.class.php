<?php namespace Admin\Controller;

class GoodsController extends BaseController
{
    protected $meta_name = "商品";

    public function add(){
        header('Content-Type:text/html;charset=utf-8');
        if(IS_POST) {
            $data=$this->model->getData();
            if($data['id']!=0){
                $result=$this->model->save($data);
            }else{
                $result=$this->model->add($data);
            }

            if($result!==false){
                $this->success('操作成功',cookie('forward_url'));
            }else{
                $this->error('操作失败:'.error($this->model));
            }
        }else{
            //>>1.获取商品分类数据
            if(I('get.id')!==''){
                $result=$this->model->getResult('','',I('get.id'));
                $this->assign('result',$result[0]);
            }
            $category_model=D('GoodsCategory');
            $field="id,parent_id,name";
            $category_result=$category_model->arrToJson($field);
            //>>2.获取品牌数据
            $brand_model=D('brand');
            $brand_result=$brand_model->getResult();
            //>>3.展示数据
            $this->assign('rows',$brand_result);
            $this->assign('zNodes',$category_result);
            $this->display('edit');
        }
    }

    public  function _display_view_before(){
        $goods_category_result=D('GoodsCategory')->getResult();
        $brand_result=D('brand')->getResult();

        /*dump($brand_result);
        exit;*/

        $this->assign('goods_categorys',$goods_category_result);
        $this->assign('goods_brands',$brand_result);
    }

}