<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/5
 * Time: 13:23
 */

namespace Admin\Model;


use Think\Model;

class BaseModel extends Model
{
    protected $patchValidate=true;

    public function getPageResult($keyword=''){
        //>>1.��ȡ��ѯ���ܼ�¼��
        $condition['status']=array('gt',-1);
        $condition['name']=array('exp',"like '%$keyword%'");
        $count=$this->where($condition)->count();
        //>>2.ʵ����page�����,�����ܼ�¼����ÿҳ��ʾ�ļ�¼��
        $page=new \Think\Page($count,4);
        //>>3.��ȡ��ҳ������
        $show=$page->show();
        //>>4.��ȡ��ҳ����
        $list=$this->where($condition)->limit($page->firstRow,$page->listRows)->select();
        //>>5.�����ҳ�������ͷ�ҳ����
        $result['html']=$show;
        $result['data']=$list;
        return $result ;
    }


    public function changeStatus($id,$status=-1){
        $data['status']=$status;
        if($status==-1){
            $data['name']=array('exp',"concat(name,'_del')");
        }
        $data['id']=array('in',$id);
        $result=parent::save($data);
        return $result;
    }


}