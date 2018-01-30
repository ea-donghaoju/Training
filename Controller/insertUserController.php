<?php
require('../Model/searchModel.php');
header("Content-type:text/html;charset=utf-8");


class insertUser{
    function insert($name){
        $searchModel = new searchModel();
        $insert = $searchModel->insertData($name);
        if($insert == true){
            return $insert;
        }else{
            return false;
        }
    }
}