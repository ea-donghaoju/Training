<?php
header("Content-type:text/html;charset=utf-8");
//require('../View/insertUserView.php');

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