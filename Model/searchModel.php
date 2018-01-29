<?php

class searchModel{
    public $host = "127.0.0.1";
    public $user = "root";
    public $pwd  ="root";
    public $dbName = "dong";
    //-----链接数据库-----
    function query($sql){
            $mysqli=new mysqli($this->host,$this->user,$this->pwd,$this->dbName);//链接数据库
            $result=$mysqli->query($sql);

            return $result;
    }

    //-----查询方法-----
    function findData($name,$searchCondition)
    {
        $sql = "select * from test where {$searchCondition} like '%{$name}%' ";
        $arr = $this->query($sql);
        return $arr->fetch_all();
    }

    //-----添加方法-----
    function insertData($Name)
    {
        $sql = "insert into test (Name) values ('{$Name}')";
        $arr = $this->query($sql);
        return $arr;
    }
}























//class test{
//    public $host = "127.0.0.1";
//    public $user = "root";
//    public $pwd  ="root";
//    public $dbName = "dong";
//
//    function query($sql){
//        $DB=new mysqli($this->host,$this->user,$this->pwd,$this->dbName);//链接数据库
//        $result=$DB->query($sql);
//        return $result->fetch_all();//
//    }
//}