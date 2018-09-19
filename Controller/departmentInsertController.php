<?php
include('Model/departmentModel.php');
class DepartmentInsertController{
    /**
     * @Author muzi
     * @paramstring参数
     * @return        [type] [description]
     */
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $department_name = $_POST['department_name'];
            $departments = new DepartmentModel();
            $departResult = $departments -> Insertdepartment($department_name);
            if ($departResult) {
                header("Location:http://www.training.com/dev/departmentList");
            } else {
                echo "数据插入有误请重新添加";
                require("View/departmentInsertView.php");
            }
        } else {
            require("View/departmentInsertView.php");
        }
    }
}
