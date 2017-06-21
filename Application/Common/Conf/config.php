<?php
return array(
	//'配置项'=>'配置值'
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => '127.0.0.1', // 服务器地址
    'DB_NAME'   => 'php34', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => 'root', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => 'php34_', // 数据库表前缀
     'DB_CHARSET'=> 'utf8', // 字符集
    /**************上传图片******************/
    'IMG_maxSize' => '3M',
    'IMG_exts' => array('jpg', 'gif', 'png', 'jpeg'),
    'IMG_rootPath' => './Public/Uploads/',
    /***************修改I底层函数过滤时使用的函数********/
    'DEFAULT_FILTER' => 'trim,removeXss',
);