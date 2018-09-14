<?php
include('Model/databaseModel.php');
class selectController
{
    function index(){ 
    	$databaseModel = new databaseModel();
        $result = $databaseModel->findData(); 
    	require("View/selectview.php");
    }
}
?>