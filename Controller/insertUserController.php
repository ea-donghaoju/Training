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
        $databaseModel = new databaseModel();
        $insertResult = $databaseModel->insertData($name);
        if($insertResult == true){
            return $insertResult;
        }else{
            return false;
        }
    }
}