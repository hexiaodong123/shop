<?php
namespace Admin\Model;


class GoodsCategoryModel extends BaseModel
{
    protected $_validate = array(
        array('name', 'require', '分类名称 不能为空'),
        array('parent_id', 'require', '父分类 不能为空'),
        array('left', 'require', '左边界 不能为空'),
        array('right', 'require', '右边界 不能为空'),
        array('deep', 'require', '层级 不能为空'),
        array('status', 'require', '是否显示@radio|1=是&0=否 不能为空'),
    );

    public function getResult($keyword='',$field='*',$id=0){
        if($id!==0){
            $condition['id']=array('eq',$id);
        }
        $condition['name']=array('like',"%$keyword%");
        $condition['status']=array('gt','-1');
        $result=$this->field($field)->where($condition)->order('left')->select();
        return $result;

    }

    public function arrToJson($field){
        $result=$this->getResult('',$field);
        return json_encode($result,JSON_UNESCAPED_UNICODE);
    }




}