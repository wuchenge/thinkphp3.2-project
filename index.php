<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 检测PHP环境
if (version_compare(PHP_VERSION, '5.3.0', '<')) {
    die('require PHP > 5.3.0 !');
}
// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG', true);
//define('APP_DEBUG',false);
//$_GET['m'] = "Web";
//电脑端和手机端判断
// $agent = $_SERVER['HTTP_USER_AGENT'];
// if(strpos($agent, 'iPhone') || strpos($agent, 'Android')){
//     define('BIND_MODULE','Mobile');
// }ELSE{
    define('BIND_MODULE', 'Home');
//}
//define('BIND_MODULE','Web');
// 定义应用目录
define('APP_PATH', './App/');
define('_PHP_FILE_', $_SERVER['SCRIPT_NAME']);

// 判断是否安装过
if (function_exists('saeAutoLoader') || isset($_SERVER['HTTP_BAE_ENV_APPID'])) {
} else {
    if (file_exists("install") && !file_exists("install/install.lock")) {
        header("Location:./install");
        exit();
    }
}
// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';
