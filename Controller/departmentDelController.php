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
    }

    public function index()
    {
        $id = $_GET['id'];
        $_SESSION['id'] = $id;
        //根据id去获取所有的数据
        try {
            $this->isNumId($id);
            $departmentData = $this->departmentModel->getDepartmentById($id);
        } catch(Exception $e) {
            echo $e->getMessage();
        }
        $_SESSION['department_name'] = $departmentData['department_name'];
        require("View/departmentDelConfirmView.php");
    }

    /**
     * 根据获取的ID确认是否删除对应的职位信息
     * @return    void
     */
    public function confirmDel()
    {
        $id = $_SESSION['id'];
        unset($_SESSION['id']);

        //根据id去更改delflag字段状态
        try {
            $this->isNumId($id);
            $delResult = $this->departmentModel->delDepartmentById($id);
        } catch(Exception $e) {
            echo $e->getMessage();
        }

        $departmentName = $_SESSION['department_name'];
        require("View/departmentDelCompleteView.php");
        unset($departmentName);
    }

    /**
     * 判断ID值是否为数字，否则终止执行
     * @param    $id  $get传递过来的数字
     * @return        boolean     [description]
     */
    private function isNumId($id)
    {
        if (!is_numeric($id)) {
            throw new Exception("ID值应该为数字");
            return;
        }

        return true;
    }

}
