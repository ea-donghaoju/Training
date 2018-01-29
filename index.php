<?php
session_start();
header("Content-type:text/html;charset=utf-8");
require('Model/searchModel.php');

//保留上一次选择的条件值
$_SESSION['condition'] = isset($_POST['condition'])?$_POST['condition']:"";
$cSession = isset($_SESSION['condition'])?$_SESSION['condition']:"";

//如果有报错就把下面的两个变量注释一下
$result = "";
$errorStr = "";

//需要判断是insert或者是search，只使用其中一种方法
    //判断searchName是否为空，不为空进行查询
    if(!empty($_POST['searchName'])){
        if($_POST['searchCondition']=='Name'){
            $searchCondition = 'name';
        }elseif($_POST['searchCondition']=='Tel'){
            $searchCondition = 'Tel';
        }elseif($_POST['searchCondition']=='Birthday'){
            $searchCondition = 'Birthday';
        }
        $result = search($_POST['searchName'],$searchCondition);//给search()传值
        if($result == null){
            $errorStr = "未查询到<br/>";
        }
    }
    //判断insertName是否为空，不为空进行添加
    elseif(!empty($_POST['insertName'])){
        $insertResult = insert($_POST['insertName']);
    }
    //全部为空，提示输入
    elseif(empty($_POST['searchName'])){
        $errorStr = "请输入内容<br/>";
    }
require('View/index.php');

    //-----查询方法-----
    function search($name,$searchCondition)
    {
        $searchModel =  new searchModel();
        $search = $searchModel->findData($name,$searchCondition);
        //做判断$search有没有查到
        if($search){
            return $search;
        }else{
            return false;;
        }
    }
    //-----添加方法-----
    function insert($name)
    {
        $searchModel = new searchModel();
        $insert = $searchModel->insertData($name);
        if($insert == true){
            return $insert;
        }else{
            return false;
        }
    }