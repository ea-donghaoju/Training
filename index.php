<?php
session_start();
header("Content-type:text/html;charset=utf-8");
date_default_timezone_set('PRC');
//获取当前脚本路径
$param = rtrim($_SERVER['REQUEST_URI'], '/');
$params = [];
if ('' != $param) {
    $params = explode('/', $param);
}

//set Controller and Action（设置控制器）
$controller = "";
if (count($params) > 0) {
    if (isset($params[2])) {
        $controller = $params[2];
    } else {
        $controller = "index";
    }
    if (isset($params[3])) {
        $action = $params[3];
    } else {
        $action = 'index';
    }
}

//控制器名字
$className = $controller . 'Controller';
//文件名字
$name = 'Controller/' . $className . '.php';
//判断文件是否存在
if (file_exists($name)) {
    include 'Controller/' . $className . '.php';
    $controllerInstance = new $className();
    $controllerInstance->$action();
} else {
    echo "<h1>error</h1>";
}