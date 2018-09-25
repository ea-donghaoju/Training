<?php
include('Model/databaseModel.php');
class DepartmentModel extends DataBaseModel{
    /**
     * 获取department表单所以得内容
     * @return object
     */
    public function getDepartmentList()
    {
        $sql = "select * from department";
        return $this->execSQL($sql);
    }

    /**
     * @param    $name string 用户插入的职位名称
     * @return   object
     */
    public function getDepartmentByName($name)
    {
        $sql = "select * from department where department_name = '".$name."'";
        return $this->execSQL($sql);
    }

    /**
     * @param   $id 职务对应的id
     * @return  object
     */
    public function getDepartmentById($id)
    {
        $sql = "select * from department where id = " . $id . "";
        return $this->execSQL($sql)->fetch_assoc();
    }

    /**
     * 根据提供的参数修改数据信息
     * @param    $id 要更改的职位id
     * @param    $departmentName 用户要更改的职位名称
     * @return        [type]                 [description]
     */
    public function updateDepartmentById($id,$departmentName)
    {
        $sql = "update department set department_name = '" . $departmentName . "' where id = " . $id ."";
        return $this->execSQL($sql);
    }

    /**
     * 插入数据
     * @param string $name 职位名称
     * @return void
     */
    public function insertDepartmentByName($name)
    {
        $sql = "insert into `department`(`department_name`) values('" . $name . "')";
        return $this->execSQL($sql);
    }
}
