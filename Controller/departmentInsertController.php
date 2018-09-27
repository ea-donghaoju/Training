<?php
include('Model/departmentModel.php');
class departmentInsertController
{
    //声明一个变量,存储实例化对象
    public $departmentModel = null;
    /**
     * 构造函数,自动实例化DepartmentModelm模型
     *@return object
     */
    public function __construct()
    {
        $this->departmentModel = new DepartmentModel();
    }

    /**
     * 一览页添加功能
     * @return    void
     */
    public function index()
    {
        //不是post提交时，返回Department添加画面
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            require("View/departmentInsertView.php");
            return;
        }

        //检查post提交的Name
        $insertName = $_POST['department_name'];
        $this->setInsertDepartmentName($insertName);
        $errorMsgArray = $this->departmentModel->confirmName($insertName);

        //有错误信息时返回到Department添加页面
        if ($errorMsgArray['department_name'] != null) {
            require('View/departmentInsertView.php');
            return;
        }

        //没有错误信息，返回到Department确认页面
         require('View/departmentCheckView.php');
    }

    /**
     * 将post提交的数据保存到session里
     * @param string 插入数据post提交的数据
     */
    private function setInsertDepartmentName($name)
    {
        $_SESSION['insertDepartmentName'] = $name;
        return;
    }

    /**
     * 确认是否插入/或者更改这些数据这些数据
     * @return void
     */
    public function confirm()
    {
        //判断提交方式如果不是post ,加载departmentInsertView页面
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            require("View/departmentInsertView.php");
            return;
        }

        //post提交数据，添加成功返回列表页
        $departmentName = $this->editDepartment($_SESSION['insertDepartmentName']);
        if (!$departmentName) {
            echo "<p style='color : red'>"."数据添加有误,请重新添加"."</p>";
            require("View/departmentInsertView.php");
            return;
        }

        $hostName = $_SERVER['HTTP_HOST'].'/dev/departmentList';
        Header("Location: http://" . $hostName);
    }

    /**
     * 插入数据
     * @param    $departmentName string session里面获取的名字
     * @return    void
     */
    private function editDepartment($departmentName)
    {
         return $this->departmentModel->insertDepartmentByName($departmentName);
    }
}
