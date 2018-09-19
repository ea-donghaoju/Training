<?php
include('Model/databaseModel.php');
class MembersModel extends DataBaseModel{
    /**
     * @Author muzi
     * @param string参数
     * @return array
     */
    public function getMembersList()
    {
        $sql = "select member.id,name,Birthday,department_name,status from member join department where member.Department_id=department.id and status = 1";
        $members = $this->execSQL($sql);
        return $members;
    }

    /**
     * 查询方法
     * @param string $searchCondition 搜索条件
     * @param string $name 名字
     * @return array
     */
    public function findData($searchCondition, $name)
    {
        $sql = "select member.*,department_name from member inner join department on member.Department_id=department.id where ". $searchCondition . " like '%" . $name . "%'";
        return $this->execSQL($sql);
    }

    /**
     * 添加方法
     * @param string $name 姓名
     * @param string $birthday 生日
     * @param string $department 电话
     * @return void
     */
    public function insertData($name, $birthday, $department)
    {
        $sql = "insert into member (Name,Birthday,Department_id) values ('" . $name . "','" . $birthday . "','" . $department . "')";
        $result = $this->execSQL($sql);
        return $result;
    }
}
