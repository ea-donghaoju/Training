<?php
include('Controller/departmentInsertController.php');
class departmentupdatedController extends departmentInsertController{
    public function index()
    {
        #错误判断标识
        $errorFlag = false;
        #错误信息，一个空数组
        $errorMsgArray['department_name'] = [];
        $departmentModel = new DepartmentModel();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $departmentName = $_POST['department_name'];
            $id = $_POST['id'];
            if (!empty($departmentName)) {
                #去除输入的空格
                $departmentName = trim($departmentName);
                #输入的职位内容是否为汉字,和长度不能大于50
                if (!$this->checkName($departmentName)) {
                    $errorMsgArray['department_name'][] = "输入的内容只可以为汉字,字符长度不可以大于50";
                    $errorFlag = true;
                }
                $department = $departmentModel->getDepartmentByName($departmentName);
                if ($department->num_rows != 0) {
                        $errorMsgArray['department_name'][] = "该用职位名已经存在，请重新输入";
                        $errorFlag = true;
                }
            }
            if ($errorFlag == false) {
                #如果更改的数据没有错误，那么就连接数据库更改数据信息
                $updateResult = $departmentModel->updateDepartmentById($id,$departmentName);
                if ($updateResult) {
                    $hostName = $_SERVER['HTTP_HOST'].'/dev/departmentList';
                    Header("Location: http://$hostName");
                } else {
                    echo "<p style='color : red'>"."数据更改失败,请检查逻辑代码啦啦"."</p>";
                }
            } else {
                require('View/Helper/formHelper.php');
                $formHelper = new formHelper();
                require("View/departmentupdateView.php");
            }
        } else {
            $id = $_GET['id'];
            $getDepartment = $departmentModel->getDepartmentById($id);
            if ($getDepartment) {
                require("View/departmentupdateView.php");
            } else {
                echo "<p style='color : red'>"."数据查询失败，请检查逻辑代码"."</p>";
            }
        }
    }
}
