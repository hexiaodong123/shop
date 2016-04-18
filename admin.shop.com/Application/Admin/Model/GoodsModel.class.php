<?php
namespace Admin\Model;


class GoodsModel extends BaseModel
{
    protected $_validate = array(
       /* array('name', 'require', '商品名称 不能为空'),
        array('name', '', '商品名称 已经存在', '', 'unique', ''),
        array('goods_sn', 'require', '商品货号 不能为空'),
        array('goods_category', 'require', '商品分类 不能为空'),
        array('goods_brand', 'require', '商品品牌 不能为空'),
        array('shop_price', 'require', '本店价格 不能为空'),
        array('market_price', 'require', '市场价格 不能为空'),
        array('status', 'require', '是否显示 不能为空'),
        array('is_recommend', 'require', '加入推荐 不能为空'),*/
    );

    public function getData(){
        $result=$this->create();
        $arr=$result['is_recommend'];
        $num=0;
        foreach($arr as $key=>$value){
            $num+=pow(2,$key)*$value;
        }
        $result['is_recommend']=$num;
        return $result;
    }

    public function _handleData(&$data){
        foreach($data['data'] as $key=>&$result){
            $recommend=$result['is_recommend'];
            $result['good']=$recommend%2;
            $result['new']=($recommend>>1)%2;
            $result['hot']=($recommend>>2)%2;
            unset($result['is_recommend']);
        }

    }

    public function _excuteSql($field,$condition){
         return $this->field($field)->where($condition)->select();
    }

    protected function _handleCondition(&$condition,$keyword){
        if(isset($condition['goods_category'])){
            $model=M();
            /*
             * 1. 先获取分类的id
             * 2.再根据分类的id获取该分类的left和right值
             * 3.最后根据left和right值获取该分类下的所有子分类
             *
             */
            $id=$condition['goods_category'];
            $result=$model->query("select `left`,`right` from goods_category where id=$id");
            $left=(int)$result[0]['left'];
            $right=(int)$result[0]['right'];
            $category_result=$model->query("select * from goods_category where `left`>$left and `right`<$right");
            $category_id=array();
            $category_id[]=$id;
            foreach($category_result as $value){
                $category_id[]=$value['id'];
            }
            $condition['goods_category']=array('in',$category_id);
        }
        if(isset($condition['is_recommend'])){
            $condition['is_recommend']=array('in',$condition['is_recommend']);
        }
        if(!isset($condition['status'])){
            $condition['status']=array('gt',-1);
        }
        $condition['name']=array('exp',"like '%$keyword%'");
    }




}