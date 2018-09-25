<?php
include('Model/departmentModel.php');
class departmentInsertController{
    /**
     * 一览页添加功能
     * @return    void
     */
    public function index()
    {
        #错误判断标识
        $errorFlag = false;
        #错误信息，一个空数组
        $errorMsgArray['department_name'] = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $departmentName = $_POST['department_name'];
            $_SESSION['departmentName'] = $departmentName;
            if (!empty($departmentName)) {
                #去除输入的空格
                $departmentName = trim($departmentName);
                #输入的职位内容是否为汉字,和长度不能大于50
                if (!$this->checkName($departmentName)) {
                    $errorMsgArray['department_name'][] = "输入的内容只可以为汉字,字符长度不可以大于50";
                    $errorFlag = true;
                }
                $departmentModel = new DepartmentModel();
                $department = $departmentModel->getDepartmentByNeme($departmentName);
                if ($department->num_rows != 0) {
                        $errorMsgArray['department_name'][] = "该用职位名已经存在，请重新输入";
                        $errorFlag = true;
                }
            } else {
                $errorFlag['department_name'][] = "输入的内容不可以为空";
                $errorFlag = true;
            }
            if ($errorFlag == false) {
                require('View/departmentCheckView.php');
            } else {
                require('View/Helper/formHelper.php');
                $formHelper = new formHelper();
                require('View/departmentInsertView.php');
            }
        } else {
            require("View/departmentInsertView.php");
        }
    }

    /**
     * 检查输入的内容是汉字,长度不能大于50
     * @param string 输入的内容
     * @param    bool true 或 false
     */
    public function checkName($insertname)
    {
        if (preg_match('/^[\x80-\xff]{1,50}$/',$insertname)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 确认是否插入这些数据
     * @return void
     */
    public function confirm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $departmentName = $_POST['department_name'];
            $departmentModel = new DepartmentModel();
            $departResult = $departmentModel -> insertDepartmentByName($departmentName);
                if ($departResult) {
                    $hostName = $_SERVER['HTTP_HOST'].'/dev/departmentList';
                    Header("Location: http://$hostName");
                } else {
                    echo "<p style='color : red'>"."数据添加有误,请重新添加"."</p>";
                    require("View/departmentInsertView.php");
                }
        } else {
            echo "<p style='color : red'>"."操作有误请重新输入数据"."</p>";
            require("View/departmentInsertView.php");
        }
    }
}
