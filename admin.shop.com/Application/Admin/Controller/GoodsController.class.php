<?php namespace Admin\Controller;

class GoodsController extends BaseController
{
    protected $meta_name = "商品";

    public function add(){
        header('Content-Type:text/html;charset=utf-8');
        if(IS_POST) {
            /***先获取表单提交的所有数据,不同表中的数据通过各自model的create方法收集****/
            $data=$this->model->getData();


            if($data==false){
                $this->error('操作失败'.error($this->model));
            }
           /**再将数据添加到数据库中**************/
            $result=$this->model->addData($data);
            if($result!==false){
                $this->success('操作成功',cookie('forward_url'));
            }else{
                $this->error('操作失败:'.error($this->model));
            }

        }else{
            //>>1.如果有id传过来,获取对应id的数据
            if(I('get.id')!==''){
                $id=I('get.id');
                //>>1.1 获取商品信息的数据
                $result=$this->model->getResult('','',$id);
                $this->assign('result',$result[0]);
                //>>1.2 获取商品简介的数据
                $goods_intro_model=M('goods_intro');
                $goods_intro=$goods_intro_model->query("select * from goods_intro where goods_id=$id");
                $this->assign('goods_intro',$goods_intro[0]);
                //>>1.3 获取会员价格数据
                $goods_price=D('member_price')->query("select * from member_price where goods_id=$id order by member_level_id");
                $this->assign('goods_price',$goods_price);
                //>>1.4 获取商品图片数据
                $goods_photo=D('goods_photo')->query("select * from goods_photo where goods_id=$id");
                $this->assign('goods_photos',$goods_photo);
            }

            //>>2.获取商品分类数据
            $category_model=D('GoodsCategory');
            $field="id,parent_id,name";
            $category_result=$category_model->arrToJson($field);
            //>>3.获取品牌数据
            $brand_model=D('brand');
            $brand_result=$brand_model->getResult();
            //>>4.展示数据
            $this->assign('rows',$brand_result);
            $this->assign('zNodes',$category_result);
            $this->display('edit');
        }
    }

    public  function _display_view_before(){
        $goods_category_result=D('GoodsCategory')->getResult();
        $brand_result=D('brand')->getResult();
        $this->assign('goods_categorys',$goods_category_result);
        $this->assign('goods_brands',$brand_result);
    }

}