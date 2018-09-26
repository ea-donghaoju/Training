<?php
include('Model/departmentModel.php');
class departmentInsertController{
    /**
     * 一览页添加功能
     * @return    void
     */
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            require("View/departmentInsertView.php");
            return;
        }
        $departmentName = $_POST['department_name'];
        $_SESSION['departmentName'] = $departmentName;
        $errorMsgArray = $this->confirmName($departmentName);
            if ($errorMsgArray['department_name'] == null) {
                require('View/departmentCheckView.php');
            } else {
                require('View/Helper/formHelper.php');
                $formHelper = new formHelper();
                require('View/departmentInsertView.php');
            }
    }

    /**
     * 对于接受的参数是否正确，
     * @param    $departmentName string post接受的用户名
     * @return
     */
    public function confirmName($departmentName)
    {
        //声明一个空数组
        $errorMsgArray['department_name'] = [];
        if (!empty($departmentName)) {
                #去除输入的空格
                $departmentName = trim($departmentName);
                #输入的职位内容是否为汉字,和长度不能大于50
                if (!$this->checkName($departmentName)) {
                    $errorMsgArray['department_name'][] = "输入的内容只可以为汉字,字符长度不可以大于50";
                }
                $departmentModel = new DepartmentModel();
                $department = $departmentModel->getDepartmentByName($departmentName);
                if ($department->num_rows != 0) {
                    $errorMsgArray['department_name'][] = "该职位名已经存在，请重新输入";
                }
            } else {
                $errorMsgArray['department_name'][] = "输入的内容不可以为空";
            }
            return $errorMsgArray;
    }

    /**
     * 检查输入的内容是汉字,长度不能大于50
     * @param string 输入的内容
     * @param    bool true 或 false
     */
    private function checkName($insertname)
    {
        if (preg_match('/^[\x80-\xff]{1,50}$/',$insertname)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 确认是否插入/或者更改这些数据这些数据
     * @return void
     */
    public function confirm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            require("View/departmentInsertView.php");
            return;
        }
        $departmentName = $this->editDepartment($_SESSION['departmentName']);
        if ($departmentName) {
            $hostName = $_SERVER['HTTP_HOST'].'/dev/departmentList';
            Header("Location: http://$hostName");
        } else {
            echo "<p style='color : red'>"."数据添加有误,请重新添加"."</p>";
            require("View/departmentInsertView.php");
        }
    }

    /**
     * 插入数据
     * @param    $departmentName string session里面获取的名字
     * @return    void
     */
    private function editDepartment($departmentName)
    {
        var_dump($departmentName);
        $departmentModel = new DepartmentModel();
        $departmentResult = $departmentModel -> insertDepartmentByName($departmentName);
        return $departmentResult;
    }
}
