<?php
include('Model/membersModel.php');
class MembersListController
{
    /**
     * 一览页面
     * @return void
     */
    public function index()
    {
        $databaseModel = new MembersModel();
        $members = $databaseModel->getmembersList();
        require("View/memberListView.php");
    }
}
