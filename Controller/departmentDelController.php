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
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $id = $_GET['id'];
            $_SESSION['id'] = $id;
            //根据id去获取所有的数据
            try {
                $departmentData = $this->departmentModel->getDepartmentById($id);
            } catch(Exception $e) {
                echo $e->getMessage();
            }
            $_SESSION['department_name'] = $departmentData['department_name'];
            require("View/departmentDelView.php");
        }
    }

    // 根据获取的ID确认是否删除对应的职位信息
    public function confirmDel()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            try {
                $delResult = $this->departmentModel->delDepartmentById($_SESSION['id']);
            } catch(Exception $e) {
                echo $e->getMessage();
            }
        }

        require("View/departmentDelconfirmView.php");
        }
}
