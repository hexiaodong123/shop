<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/5
 * Time: 17:19
 */

namespace Admin\Controller;


use Think\Controller;

class GiiController extends Controller
{
    public function index(){
        header("Content-Type:text/html;charset=utf-8");
        if(IS_POST){
            //>>1.接收index页面传递过来的名字,并根据Thinkphp的parse_name函数将名字转换为:goods=>Goods,goodstype=>GoodsType的形式
            $model=M();
            $name=I('post.controller_name');
            $controller_name=parse_name($name,1);

            //>>2.定义模板目录
            defined('TMPL_PATH') or define('TMPL_PATH',ROOT_PATH.'Template');

            //>>3.生成控制器代码
            $sql="select TABLE_COMMENT from information_schema.TABLES where TABLE_NAME='$name' ";
            $result=$model->query($sql);
            $meta_name=$result[0]['table_comment'];
            require TMPL_PATH."/Controller.tpl";
            $controller_code="<?php ".ob_get_clean();
            file_put_contents(APP_PATH."Admin/Controller/".$controller_name."Controller.class.php",$controller_code);

            //>>4.生成模型代码
            ob_start();//第二次使用ob缓存,要先开启
            $sql="show full columns from $name ";
            $fields=$model->query($sql);
            require TMPL_PATH.'/Model.tpl';
            $model_code="<?php ".ob_get_clean();
            file_put_contents(APP_PATH."Admin/Model/".$controller_name."Model.class.php",$model_code);

            //>>5.生成index.html代码
            ob_start();//再次开启ob缓存
            require TMPL_PATH.'/index.tpl';
            $index_code=ob_get_clean();
            file_put_contents(APP_PATH."Admin/View/".$controller_name."/index.html",$index_code);







        }else{
            $this->assign('meta_name',"代码生成器");
            $this->display('index');
        }

    }

}