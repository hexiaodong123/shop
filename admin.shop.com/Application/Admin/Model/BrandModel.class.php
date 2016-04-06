<?php namespace Admin\Model;


class BrandModel extends BaseModel
{
    protected $_validate=array(
    array('name','require','品牌名称 不能为空'),
array('url','require','品牌网址 不能为空'),
array('logo','require','品牌LOGO@file 不能为空'),
array('sort','require','排序 不能为空'),
array('status','require','是否显示@radio|1=是&0=否 不能为空'),
    );
}