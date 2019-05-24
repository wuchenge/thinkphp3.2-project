<?php
// 检测PHP环境
if (version_compare(PHP_VERSION, '5.3.0', '<')) {
    die('require PHP > 5.3.0 !');
}
define("APP_DEBUG", true);
//$_GET['m'] = "Admin";
// echo md5(md5('111111').'2600'.md5('15538373085'));die;
define('BIND_MODULE', 'Admin');
define("APP_PATH", "./App/");
require "./ThinkPHP/ThinkPHP.php";
