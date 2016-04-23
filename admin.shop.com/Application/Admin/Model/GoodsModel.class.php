<?php
namespace Admin\Model;


class GoodsModel extends BaseModel
{
    protected $_validate = array(
        array('name', 'require', '商品名称 不能为空'),
        array('name', '', '商品名称 已经存在', '', 'unique', ''),
        array('goods_sn', 'require', '商品货号 不能为空'),
        array('goods_category', 'require', '商品分类 不能为空'),
        array('goods_brand', 'require', '商品品牌 不能为空'),
        array('shop_price', 'require', '本店价格 不能为空'),
        array('market_price', 'require', '市场价格 不能为空'),
        array('status', 'require', '是否显示 不能为空'),
    );

    public function getData(){
        $data=array();
        /*
         * 获取表单提取的数据;对于不同的表,通过D(表名)->create()来收集对应表的数据,所以对每个表都
         * 必须有个Model类来进行自动验证;使用D方法创建的模型类对象才会进行自动验证;
         * 对于不同的表的数据,在edit页面都要添加一个隐藏的id字段,以便收集数据
         */
        //>>1.1 获取商品简介的数据
        $goods_intro=D('goods_intro')->create();
        if($goods_intro===false){
            $this->error=D('goods_intro')->getError(); //将goods_intro模型中的错误信息放到goodsModel中,以便输出错误
            return false;
        }
        //>>1.2.获取商品信息数据
        $goods_info=$this->create();
        if($goods_info==false){
            return false;
        }

        //>>1.3 获取会员价格信息
        $goods_price=D('member_price')->create();
        if($goods_price===false){
            $this->error=D('member_price')->create();
            return false;
        }

        //>>1.4 获取商品相册数据
        $goods_photo=D('goods_photo')->create();
        if($goods_photo===false){
            $this->error=D('goods_photo')->getError();
            return false;
        }

        //>>2.对商品信息数据进行处理
        $arr=$goods_info['is_recommend'];
        $num=0;
        foreach($arr as $key=>$value){
            $num+=pow(2,$key)*$value;
        }
        $goods_info['is_recommend']=$num;

        //>>4.将商品信息,商品简介,会员价格保存到$data中
        $data['goods_intro']=$goods_intro;
        $data['goods_info']=$goods_info;
        $data['goods_price']=$goods_price;
        $data['goods_photo']=$goods_photo;
        return $data;
    }

    public  function addData($data){
        $goods_intro=$data['goods_intro'];
        $goods_info=$data['goods_info'];
        $goods_price=$data['goods_price'];
        $goods_photo=$data['goods_photo'];


        /*************开启事务*******************/
        $this->startTrans();
        /***************判断是添加还是更新****************************/
        if($goods_info['id']!=0){  //更新
            $goods_intro_result=D('goods_intro')->save($goods_intro); //更新商品简介
            $goods_info_result=$this->save($goods_info); //更新商品信息
            $this->update_member_price($goods_price,false); //更新会员价格信息
            $this->delete_goods_photo($goods_photo['goods_id']);
            $this->add_goods_photo($goods_photo);//更新商品图片信息,先删除，再添加

        }else{   //添加
            $goods_info_result=$this->add($goods_info); //添加商品信息,同时获得添加后的id

            if($goods_info_result==false){
                $this->rollback();
                return false;
            }else{
                $goods_intro['goods_id']=$goods_info_result; //添加商品简介
                $goods_intro_result=D('goods_intro')->add($goods_intro);
                $goods_price['goods_id']=$goods_info_result;
                $this->update_member_price($goods_price);//添加会员价格
                $goods_photo['goods_id']=$goods_info_result;
                $this->add_goods_photo($goods_photo);//添加商品图片
            }

        }
        /**************如果操作失败,则回滚*************************************/
        if($goods_intro_result===false){
            $this->rollback();
            $this->error=D('goods_intro')->getError();
            return false;
        }
        if($goods_info_result===false){
            $this->rollback();
            return false;
        }

        $this->commit();
        return true;
    }

    public function delete_goods_photo($goods_id){
        $result=D('goods_photo')->execute("delete from goods_photo where goods_id=$goods_id");
        if($result===false){
            $this->rollback();
            $this->error=D('goods_photo')->getError();
            return false;
        }
        return true;
    }



    public  function add_goods_photo($goods_photo){
        $arr['goods_id']=$goods_photo['goods_id'];

        foreach($goods_photo['photo_name'] as $key=>$value){
            $arr['photo_name']=$value;
            $arr['photo_path']=$goods_photo['photo_path'][$key];
            $goods_photo_result=D('goods_photo')->add($arr);
            if($goods_photo_result===false){
                $this->rollback();
                $this->error=D('goods_photo')->getError();
                return false;
            }
        }
        return true;
    }




    public function update_member_price($goods_price,$handle=true){
        $arr['goods_id']=$goods_price['goods_id'];
        if($handle===true){
            foreach($goods_price['price'] as $key=>$value){
                $arr['member_level_id']=$key;
                $arr['price']=$value;
                $goods_price_result=D('member_price')->add($arr);
                if($goods_price_result===false){
                    $this->rollback();
                    $this->error=D('member_price')->getError();
                    return false;
                }
            }
        }else{
            foreach($goods_price['price'] as $key=>$value){
                $arr['member_price_id']=$goods_price['member_price_id'][$key];
                $arr['member_level_id']=$key;
                $arr['price']=$value;
                $goods_price_result=D('member_price')->save($arr);

                if($goods_price_result===false){
                    $this->rollback();
                    $this->error=D('member_price')->getError();
                    return false;
                }
            }
        }

        return true;
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