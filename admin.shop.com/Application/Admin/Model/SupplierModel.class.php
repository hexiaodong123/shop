<?php namespace Admin\Model;


class SupplierModel extends BaseModel
{
    protected $_validate = array(
        array('name', 'require', '供应商名称 不能为空'),
        array('name', '', '供应商名称 已经存在', '', 'unique', ''),
        array('intro', 'require', '简介@text 不能为空'),
    );
}