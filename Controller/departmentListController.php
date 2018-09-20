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
        $departmentModel = new DepartmentModel();
        $departments = $departmentModel->getdepartmentList();
        require("View/departmentListView.php");
    }
}
