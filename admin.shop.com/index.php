<?php
if (version_compare(PHP_VERSION, '5.3') < 0) {
    exit('php version is too low !');
}
//>2.定义根目录常量
define('ROOT_PATH', dirname($_SERVER['SCRIPT_FILENAME']).'/');

//>3.定义框架目录
define('THINK_PATH',dirname(ROOT_PATH). '/ThinkPHP/');
//>4.定义应用目录
define('APP_PATH', ROOT_PATH . '/Application/');
//>5.定义运行目录
define('RUNTIME_PATH', ROOT_PATH . '/Runtime/');
//>6.开启调试
define('APP_DEBUG', true);
//>>6.1 自动绑定admin模块
//define('BIND_MODULE','Admin');
//7.加载框架的入口文件
require THINK_PATH . 'ThinkPHP.php';