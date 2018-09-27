<?php
include('Model/departmentModel.php');
class departmentInsertController{
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
        $errorMsgArray = $this->confirmName($insertName);

        //有错误信息时返回到Department添加页面
        if ($errorMsgArray['department_name'] != null) {
            require('View/Helper/formHelper.php');
            $formHelper = new formHelper();
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
     * 对于接受的参数是否正确，
     * @param    $departmentName string post接受的用户名
     * @return array
     */
    public function confirmName($departmentName)
    {
        $errorMsgArray['department_name'] = [];

        //判断是否为空，如果是空，直接返回错误$errorMsgArray信息
        if (empty($departmentName)) {
            $errorMsgArray['department_name'][] = "输入的内容不可以为空";
            return $errorMsgArray;
        }

        //去除输入的空格
        $departmentName = trim($departmentName);

        //输入的职位内容是否为汉字,和长度不能大于50
        if (!$this->checkName($departmentName)) {
            $errorMsgArray['department_name'][] = "输入的内容只可以为汉字,字符长度不可以大于50";
        }

        //判断数据库中是否有相同的数据信息
        $department = $this->departmentModel->getDepartmentByName($departmentName);
        if ($department->num_rows != 0) {
            $errorMsgArray['department_name'][] = "该职位名已经存在，请重新输入";
        }

        //返回错误信息，或者为空
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
        }

        return false;
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
