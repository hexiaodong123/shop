<?php
if (version_compare(PHP_VERSION, '5.3') < 0) {
    exit('php version is too low !');
}
//>2.�����Ŀ¼����
define('ROOT_PATH', dirname($_SERVER['SCRIPT_FILENAME']).'/');

//>3.������Ŀ¼
define('THINK_PATH',dirname(ROOT_PATH). '/ThinkPHP/');
//>4.����Ӧ��Ŀ¼
define('APP_PATH', ROOT_PATH . '/Application/');
//>5.��������Ŀ¼
define('RUNTIME_PATH', ROOT_PATH . '/Runtime/');
//>6.��������
define('APP_DEBUG', true);
//define('BIND_MODULE','Admin');
//7.���ؿ�ܵ�����ļ�
require THINK_PATH . 'ThinkPHP.php';