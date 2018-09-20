<?php
include('Model/databaseModel.php');
class DepartmentModel extends DataBaseModel{
    /**
     * 获取department表单所以得内容
     * @return array
     */
    public function getDepartmentList()
    {
        $sql = "select * from department";
        return $this->execSQL($sql);
    }

    /**
     * 插入数据
     * @param string $name 职位名称
     * @return void
     */
    public function InsertDepartmentByName($name)
    {
        $sql = "insert into `department`(`department_name`) values('" . $name . "')";
        return $this->execSQL($sql);
    }
}
