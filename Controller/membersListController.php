<?php
include('Model/databaseModel.php');
class membersListController
{
	//一览页面的展示
    function index()
    {
    	$databaseModel = new databaseModel();
    	$members = $databaseModel->getmembersList();
    	//判断查询语句
    	if($members){
    		require("View/memberListView.php");
    	}else{
    		echo "数据有误，请重新操作";
    	}
    }
}
?>