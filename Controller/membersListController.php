<?php
include('Model/databaseModel.php');
class MembersListController
{
    /**
     * 一览页面
     * @return void
     */
    public function index()
    {
        $databaseModel = new databaseModel();
        $members = $databaseModel->getmembersList();
        require("View/memberListView.php");
    }
}
