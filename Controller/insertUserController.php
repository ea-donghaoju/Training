<?php
include('Model/databaseModel.php');

class insertUserController
{
    function index()
    {
        //第一次到页面
        //清除左右两边的空格
        if(isset($_POST['insertName'])){
            $insertName = trim($_POST['insertName']);
        }

        //initiate error flg
        $errorFlg = false;
        //判断输入内容是否为空
        if(!empty($insertName)){
            //正则判断输入内容类型
            if($this->hasLengthError($insertName) === true) {
                $errorMessage[] = "长度应为1-10个字节";
                $errorFlg = true;
            }
            if($this->nameError($insertName) === true){
                $errorMessage[] = "名字应为英文类型";
                $errorFlg = true;
            }
        }else{
            $errorMessage[] = "请输入内容";
            $errorFlg = true;
        }

        if($errorFlg === false){
            $result = $this->insert($insertName);
            $displayMessage = "OK";
        }

        require('View/insertUserView.php');
    }
        //-----输入类型错误-----
    function nameError($insertName)
    {
        if(preg_match('/^[a-zA-z]+$/',$insertName)){
            return false;
        }
            return true;
    }

        //-----长度错误-----
    function hasLengthError($insertName)
    {
        if(preg_match('/^.{1,10}$/',$insertName)){
            return false;
        }
            return true;
    }

        //-----增加数据-----
    function insert($name)
    {
        $databaseModel = new databaseModel();
        $insertResult = $databaseModel->insertData($name);
        if($insertResult == true){
            return $insertResult;
        }else{
            return false;
        }
    }
}