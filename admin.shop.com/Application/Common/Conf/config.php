<?php
defined('URL') or define('URL','http://admin.shop.com');//注意一定要加http://
return array(
    //>>定义css样式的路径常量
    'TMPL_PARSE_STRING'=>array(
        '__CSS__'=>URL.'/Public/Admin/css',
        '__JS__'=>URL.'/Public/Admin/js',
        '__IMG__'=>URL.'/Public/Admin/image',
        '__LAYER__'=>URL.'/Public/Admin/layer-v2.1/layer',
        '__UPLOAD__'=>URL.'/Public/Admin/uploadify'
    ),

    //>>数据库的配置数据
    'DB_TYPE'                => 'mysql', // 数据库类型
    'DB_HOST'                => '127.0.0.1', // 服务器地址
    'DB_NAME'                => 'shop', // 数据库名
    'DB_USER'                => 'root', // 用户名
    'DB_PWD'                 => '111111', // 密码
    'DB_PORT'                => '3306', // 端口
);

