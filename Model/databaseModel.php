<?php

class databaseModel{
    public $host = "127.0.0.1";
    public $user = "root";
    public $pwd  ="root";
    public $dbName = "dong";

    //-----链接数据库执行语句-----
    function execSQL($sql){
            $mysqli=new mysqli($this->host,$this->user,$this->pwd,$this->dbName);//链接数据库
            $result=$mysqli->query($sql);
            return $result;
    }

    //-----查询方法-----

    function findData($name,$searchCondition)
    {
        $sql = "select * from test where {$searchCondition} like '%{$name}%' ";
        $result = $this->execSQL($sql);
        return $result->fetch_all();
    }
    //-----添加方法-----
    function insertData($Name)
    {
        $sql = "insert into test (Name) values ('{$Name}')";
        $result = $this->execSQL($sql);
        return $result;
    }
}