<?php
include('Model/databaseModel.php');
class caozuomemberController
{
	//一览页面的展示
    function index(){ 
    	$databaseModel = new databaseModel();
        $result = $databaseModel->selectmember(); 
    	require("View/caozuomemberview.php");
    }
}
?>