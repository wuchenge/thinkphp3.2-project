<?php
return array(
    //'配置项'=>'配置值'
    //数据库配置信息
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'db_qylh', // 数据库名
    'DB_USER'   => 'root', // 用户名
    // 'DB_PWD'    => 'ltwIJiU9RQ01bl7E', // 密码
    'DB_PWD'    => '12345678', // 密码
    // 'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => 'xmb_', // 数据库表前缀
    /*------------------------------------跳转模板-----------------------------------------------*/
    'TMPL_ACTION_ERROR'         => 'Public:dispatch_jump',                                // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'    => 'Public:dispatch_jump',                                // 默认成功跳转对应的模板文件


    'DEFAULT_FILTER' => 'htmlspecialchars,trim', // 默认参数过滤方法 用于I函数...

    'URL_CASE_INSENSITIVE' =>true,      //URL访问不再区分大小写
    'URL_MODEL'   =>2,           //URL模式
    'URL_ROUTER_ON' =>true,
    'URL_HTML_SUFFIX'       => '',  // URL伪静态后缀设置

    'appid'=>'wx5391175bb38ef6b6',
    'secret'=>'ff76aa91dc6955fd84e8fea6f0a51884'
);
