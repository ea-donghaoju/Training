<?php
session_start();
header("Content-type:text/html;charset=utf-8");

//-----set URL Params(url参数设置)-----
$param = rtrim($_SERVER['REQUEST_URI'], '/');//获取当前脚本路径
$params = array();
if ('' != $param) {
    $params = explode('/', $param);
}

// -----set Controller and Action（设置控制器）-----
$controller = "searchUser";
if (0 < count($params)) {
    if(isset($params[2])){
        $controller = $params[2];
    } else {
        //error
        $controller = "searchUser";
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
if(file_exists($name)){
    include 'Controller/' . $className . '.php';
    $controllerInstance = new $className();
    $controllerInstance->$action();
}else{
    echo "<h1> error </h1>";
}


