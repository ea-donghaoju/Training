<?php
include('Model/databaseModel.php');
class selectController
{
	//一览页面的展示
    function index(){ 
    	$databaseModel = new databaseModel();
        $result = $databaseModel->select(); 
    	require("View/selectview.php");
    }
   //数据的更改
    // function update($id){
    // 	$databaseModel = new databaseModel();
    //     $result = $databaseModel->up("$id"); 
    //     if($result){
    //     	return json_encode('status' => 1)
    //     }else{
    //     	require json_encode('status' => 0)
    //     }
    // }
}
?>