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
//            echo "<br>".$sql;
//            echo "<br>".$mysqli ->error;
            return $result;
    }

    //-----查询方法-----

    function findData($name,$searchCondition)
    {
        $sql = "select * from member where {$searchCondition} like '%{$name}%'";
        $result = $this -> execSQL($sql);
        return $result -> fetch_all();
    }
    //-----添加方法-----
    function insertData($Name,$Birthday,$department)
    {
        $sql = "insert into member (Name,Birthday,Department) values ('{$Name}','{$Birthday}','{$department}')";
        $result = $this->execSQL($sql);
        return $result;
    }
}