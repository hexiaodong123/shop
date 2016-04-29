<?php
defined('URL') or define('URL','http://www.shop.com');//注意一定要加http://
return array(
    //>>定义css样式的路径常量
    'TMPL_PARSE_STRING'=>array(
        '__CSS__'=>URL.'/Public/css',
        '__JS__'=>URL.'/Public/js',
        '__IMG__'=>URL.'/Public/images',
        '__VALIDATION__'=>URL.'/Public/jquery-validation',
        '__VENDOR__'=>URL.'/Vendor',
        '__LAYER__'=>URL.'/Public/layer-v2.1/layer'
    ),

    //>>数据库的配置数据
    'DB_TYPE'                => 'mysql', // 数据库类型
    'DB_HOST'                => '127.0.0.1', // 服务器地址
    'DB_NAME'                => 'shop', // 数据库名
    'DB_USER'                => 'root', // 用户名
    'DB_PWD'                 => '111111', // 密码
    'DB_PORT'                => '3306', // 端口

    'DATA_CACHE_TYPE'        => 'Redis',//设置缓存采用redis
    'REDIS_HOST'             =>'127.0.0.1',//设置redis服务器地址
    'REDIS_PORT'             =>'6379' //设置redis端口
);