<?php
include('Controller/departmentInsertController.php');
class departmentupdatedController extends departmentInsertController{
    public function index()
    {
        //根据id值获取相应数据，加载departmentupdateView页面
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $id = $_GET['id'];
            $getDepartment = $this->departmentModel->getDepartmentById($id);

            //如果数据获取失败，显示错误信息
            if (!$getDepartment) {
                echo "<p style='color : red'>"."数据查询失败，请检查逻辑代码"."</p>";
                return;
            }

        //数据获取成功,将数据显示在对于的departmentupdateView视图
        require("View/departmentupdateView.php");
        return;
        }

        $id = $_POST['id'];
        $departmentName = $_POST['department_name'];
        $errorMsgArray = $this->confirmName($departmentName);

        //判断错误信息是否为空，为空则加载departmentupdateView，显示错误信息
        if ($errorMsgArray['department_name'] != null) {
            require('View/Helper/formHelper.php');
            $formHelper = new formHelper();
            require("View/departmentupdateView.php");
            return;
        }

        //如果更改的数据没有错误，那么就连接数据库更改数据信息
        $this->editDepartmentByIdName($id, $departmentName);

    }

    /**
     * 数据都正常的时候，修改数据
     * @param    $id 职务id
     * @param    $departmentName string
     * @return   void
     */
    public function editDepartmentByIdName($id, $departmentName)
    {
        try {
            $updateResult = $this->departmentModel->updateDepartmentById($id,$departmentName);
            if ($updateResult) {
                $hostName = $_SERVER['HTTP_HOST'].'/dev/departmentList';
                Header("Location: http://$hostName");
            } else {
                throw new Exception("数据更改失败,请重新操作,请检查id");
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            return;
    }

}
