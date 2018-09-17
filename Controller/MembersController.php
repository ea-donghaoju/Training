<?php
include('Model/databaseModel.php');
class MembersController
{
	//一览页面的展示
    function index(){
    	$databaseModel = new databaseModel();
        $members = $databaseModel->getMembers();
    	require("View/membersView.php");
    }
}
?>