<?php
include('Controller/departmentInsertController.php');
class departmentUpdatedController
{
    //声明一个变量，用来存储实例化的对象
    public $departmentModel = null;

    /**
     * 构造函数,自动实例化DepartmentModelm模型
     *@return object
     */
    public function __construct()
    {
        $this->departmentModel = new DepartmentModel();
    }

    public function index()
    {
        //根据id值获取相应数据，加载departmentupdateView页面
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $id = $_GET['id'];
            $getDepartment = $this->departmentModel->getDepartmentById($id);

            //如果数据获取失败，显示错误信息
            if (!$getDepartment) {
                $message = "查询失败，请重新操作";
                require("View/departmentupdateView.php");
                return;
            }

            //数据获取成功,将数据显示在对于的departmentupdateView视图
            require("View/departmentupdateView.php");
            return;
        }

        $id = $_POST['id'];
        $departmentName = $_POST['department_name'];
        $errorMsgArray = $this->departmentModel->confirmName($departmentName);

        //判断错误信息是否为空，为空则加载departmentupdateView，显示错误信息
        if ($errorMsgArray['department_name'] != null) {
            require("View/departmentupdateView.php");
            return;
        }

        //如果更改的数据没有错误，那么就连接数据库更改数据信息
        try {
            $this->departmentModel->updateDepartmentById($id, $departmentName);
        } catch (Exception $e) {
            echo "数据库更改失败,请重新操作，检查id是否存在";
        }
        $hostName = $_SERVER['HTTP_HOST'].'/dev/departmentList';
        Header("Location: http://".$hostName);
    }
}
