<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/7
 * Time: 12:41
 */

namespace Admin\Controller;


use Think\Controller;

class UploadController extends Controller
{
    public function index(){
        $root=I('post.root');
        $dir=I('post.dir');
        $config=array(
            'rootPath'     => $root, //保存根路径
            'savePath'     => $dir, //保存路径
        );
        $upload=new \Think\Upload($config);
        $result=$upload->uploadOne($_FILES['fileData']);
        echo $result['name'].'@';
        if($result!==false){
            echo $result['savepath'].$result['savename'];
        }else{
            echo $upload->getError();
        }



    }
    public function test(){
        $this->display('test');
    }

}