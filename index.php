<?php
session_start();
header("Content-type:text/html;charset=utf-8");
date_default_timezone_set('PRC');

//-----set URL Params(url参数设置)-----
$param = rtrim($_SERVER['REQUEST_URI'], '/');//获取当前脚本路径
$params = array();
if ('' != $param) {
    $params = explode('/', $param);
}

// -----set Controller and Action（设置控制器）-----
$controller = "";
if (0 < count($params)) {
    if(isset($params[2])){
        $controller = $params[2];
    } else {
        //error
        $controller = "index";
    }
    if(isset($params[3])){
        $action = $params[3];
    } else {
        $action= 'index';
    }
}

// -----execute （执行）-----
$className = $controller . 'Controller';
$name = 'Controller/' . $className . '.php';
echo $name."←路径是这个<br/>";
echo $controller . "←控制器名字是这个<br/>";
echo $action . "←方法名是这个";

if(file_exists($name)){
    include 'Controller/' . $className . '.php';
    $controllerInstance = new $className();
    $controllerInstance->$action();
}else{
    echo "<h1> error </h1>";
}


