<?php
class databaseModel{
    public $host = "127.0.0.1";
    public $user = "root";
    public $pwd = "root";
    public $dbName = "dong";

    /**
     * 数据库执行方法
     * @param string $sql 查询语句
     * @return string
     */
    public function execSQL($sql)
    {
            //链接数据库
            $mysqli = new mysqli($this->host, $this->user, $this->pwd, $this->dbName);
            $result = $mysqli->query($sql);

            return $result;
    }

    /**
     * 查询方法
     * @param string $searchCondition 搜索条件
     * @param string $name 名字
     * @return array
     */
    public function findData($searchCondition, $name)
    {
        $sql = "select member.*,department.department_name from member inner join department on member.Department_id=department.id where {$searchCondition} like '%{$name}%'";

        return $this->execSQL($sql);
    }

    /**
     * 添加方法
     * @param string $name 姓名
     * @param string $birthday 生日
     * @param string $department 电话
     * @return string
     */
    public function insertData($name, $birthday, $department)
    {
        $sql = "insert into member (Name,Birthday,Department_id) values ('{$name}','{$birthday}','{$department}')";
        $result = $this->execSQL($sql);

        return $result;
    }

    /**
     * 添加方法
     * @return array
     */
    public function getMembersList()
    {
        $sql = "select member.id,name,Brithday,department_name,status from member join department where member.Department_id=department.id and status = 1";
        $members = $this->execSQL($sql);

        return $members;
    }
}
