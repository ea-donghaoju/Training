<?php
include('Model/departmentModel.php');
class DepartmentListController
{
    /**
     * department一览页面
     * @return void
     */
    public function index()
    {
        $databaseModel = new DepartmentModel();
        $departments = $databaseModel->getdepartmentList();
        require("View/departmentListView.php");
    }
}
