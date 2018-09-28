<?php
class DataBaseModel{
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
            if (!$result) {
                throw new Exception("数据库操作失败");
            }

            return $result;
    }
}
