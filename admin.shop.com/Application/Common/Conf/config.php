<?php
defined('URL') or define('URL','http://admin.shop.com');//ע��һ��Ҫ��http://
return array(
    //>>����css��ʽ��·������
    'TMPL_PARSE_STRING'=>array(
        '__CSS__'=>URL.'/Public/Admin/css',
        '__JS__'=>URL.'/Public/Admin/js',
        '__IMG__'=>URL.'/Public/Admin/image',
        '__LAYER__'=>URL.'/Public/Admin/layer-v2.1/layer',
        '__UPLOAD__'=>URL.'/Public/Admin/uploadify'
    ),

    //>>���ݿ����������
    'DB_TYPE'                => 'mysql', // ���ݿ�����
    'DB_HOST'                => '127.0.0.1', // ��������ַ
    'DB_NAME'                => 'shop', // ���ݿ���
    'DB_USER'                => 'root', // �û���
    'DB_PWD'                 => '111111', // ����
    'DB_PORT'                => '3306', // �˿�
);

