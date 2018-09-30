<?php
include('Model/departmentModel.php');
class departmentDelController
{
    //生命一个变量，用来存储MOdel对象
    public $departmentModel = null;

    /**
     * 构造函数，自动实例化model模型类
     * @return void
     */
    public function __construct()
    {
        $this->departmentModel = new DepartmentModel();

        $this->getDepartmentId = $_GET['id'];

        $this->sessionDepartmentId = $_SESSION['id'];
        unset($_SESSION['id']);

        $this->sessionDepartmentName = $_SESSION['department_name'];
        unset($_SESSION['department_name']);
    }

    public function index()
    {
        $delId = $this->getDepartmentId;

        //根据id去获取所有的数据
        try {
            $this->isNumId($delId);
            $departmentData = $this->departmentModel->getDepartmentById($delId);
        } catch(Exception $e) {
            echo htmlspecialchars($e->getMessage());
        }
        $_SESSION['department_name'] = $departmentData['department_name'];
        $_SESSION['id'] = $delId;

        require("View/departmentDelConfirmView.php");
    }

    /**
     * 根据获取的ID确认是否删除对应的职位信息
     * @return    void
     */
    public function confirmDel()
    {
        $delId = $this->sessionDepartmentId;

        //根据id去更改delflag字段状态
        try {
            $this->isNumId($delId);
            $this->departmentModel->delDepartmentById($delId);
        } catch(Exception $e) {
            echo htmlspecialchars($e->getMessage());
        }

        $departmentName = $this->sessionDepartmentName;
        require("View/departmentDelCompleteView.php");
    }

    /**
     * 判断ID值是否为数字，否则终止执行
     * @param    $id  $get传递过来的数字
     * @return        boolean     [description]
     */
    private function isNumId($delId)
    {
        if (!is_numeric($delId)) {
            throw new Exception("ID值应该为数字");
            return;
        }

        return true;
    }

}
