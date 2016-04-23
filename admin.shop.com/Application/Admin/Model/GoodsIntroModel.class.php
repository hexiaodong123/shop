<?php namespace Admin\Model;


class GoodsIntroModel extends BaseModel
{
    protected $_validate = array(
        array('goods_id', 'require', '商品ID不能为空'),
        array('intro', 'require', '商品简介不能为空'),
    );
}