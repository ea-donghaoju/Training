<?php
include('Model/databaseModel.php');
class DepartmentModel extends DataBaseModel{
    /**
     * @Author muzi
     * @return array
     */
    public function getdepartmentList()
    {
        $sql = "select * from department";
        return $this -> execSQL($sql);
    }

    /**
     * @Author muzi
     * @param string $name 职位名称
     */
    public function Insertdepartment($name)
    {
        $sql = "insert into `department`(`department_name`) values('" . $name . "')";
        return $this -> execSQL($sql);
    }
}
