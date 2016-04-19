<?php namespace Admin\Model;


class MemberPriceModel extends BaseModel
{
    protected $_validate=array(
    array('goods_id','require','商品ID 不能为空'),
/*array('member_level_id','require','会员级别ID 不能为空'),
array('price','require','商品价格 不能为空'),*/
    );
}