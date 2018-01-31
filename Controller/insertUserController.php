<?php
include('Model/databaseModel.php');

class insertUserController
{

    function index(){
        if(!empty($_POST['insertName'])){;
            $result = $this->insert($_POST['insertName']);
        }
        require('View/insertUserView.php');
    }

    function insert($name){
        $searchModel = new databaseModel();
        $insert = $searchModel->insertData($name);
        if($insert == true){
            return $insert;
        }else{
            return false;
        }
    }
}