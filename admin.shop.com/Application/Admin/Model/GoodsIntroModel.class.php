<?php namespace Admin\Model;


class GoodsIntroModel extends BaseModel
{
    protected $_validate=array(
    array('goods_id','require',' 不能为空'),
    );
}