<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/4
 * Time: 19:51
 */

namespace Admin\Controller;


use Think\Controller;

class BaseController extends Controller
{
    protected $model;

    protected function _initialize(){
        $this->model=D(CONTROLLER_NAME);
    }
//>>展示列表
    public function index(){
        //>>1.连接数据库
        //>>2.获取分页数据和关键字(使用关键字查询时才有)
        $keyword=urlencode(I('get.keyword'));
        $result=$this->model->getPageResult($keyword='');
        //>>3.将数据展示到页面
        $this->assign('meta_name',$this->meta_name);
        $this->assign('page_html',$result['html']);
        $this->assign('rows',$result['data']);
        //>>4.保存当前页面的url地址,以便跳转回来
        cookie('forward_url',$_SERVER['REQUEST_URI']);
        $this->display('index');

    }


    //>>增加/更新供应商
    public function add(){
        header('Content-Type:text/html;charset=utf-8');
        if(IS_POST){
            $data=$this->model->create();
            if($data!==false){
                if($data['id']!==''){
                    $result=$this->model->save();
                }else {
                    $result = $this->model->add();
                }
                if($result!==false){
                    $this->success('操作成功',cookie('forward_url'),2);
                    return ;
                }
            }
            $this->error('操作失败:'.error($this->model),'',2);
        }else{
            if(I('get.id')!==''){
                $arr['id']=array('eq',I('get.id'));
                $row=$this->model->where($arr)->select();
                $this->assign('row',$row[0]);
            }

            $this->assign('meta_name',$this->meta_name);
            $this->display('edit');
        }
    }

    //>>删除供应商到回收站
    public function remove($id=''){
        $result=$this->model->changeStatus($id);
        if($result!==false){
            $this->success('删除成功',cookie('forward_url'),2);
        }else{
            $this->error("删除失败:".error($this->model));
        }
    }

    public function change($id,$status){
        $result=$this->model->changeStatus($id,$status);
        if($result!==false){
            $this->success('操作成功',cookie('forward_url'),2);
        }else{
            $this->error('操作失败:'.error($this->model));
        }

    }

}