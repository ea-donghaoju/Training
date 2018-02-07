<?php
include('Model/databaseModel.php');
date_default_timezone_set('PRC');

class insertUserController
{
    function index()
    {
        //第一次到页面
        //清除左右两边的空格
        if(isset($_POST['insertName'])){
            $insertName = trim($_POST['insertName']);
            $insertBirthday = trim($_POST['insertBirthday']);
            $insertTel = trim($_POST['insertTel']);
        }
        //initiate error flg
        $errorFlg = false;
        //判断输入姓名是否为空
        if(!empty($insertName)) {
            //正则判断输入内容类型，提示错误信息
            if ($this->hasLengthError($insertName) === true) {
                $nameErrorMSG[] = "长度应为1-10个字节";
                $errorFlg = true;
            }
            if ($this->nameError($insertName) === true) {
                $nameErrorMSG[] = "名字应为英文类型";
            }
        }else{
            $nameErrorMSG[] = "请输入内容";
            $errorFlg = true;
        }
        //判断输入生日是否为空
        if(!empty($insertBirthday)){
            if($this->checkBirthday($insertBirthday) === false){
                $birthdayErrorMSG = "选择日期不能超过今天";
                $errorFlg = true;
            }
        }else{
            $birthdayErrorMSG = "请输入内容";
            $errorFlg = true;
        }
        //判断输入手机号码是否为空
        if(!empty($insertTel)){
            if($this->checkPhoneNumber($insertTel) === false){
                $numberErrorMSG = "手机号码应为11位纯数字";
                $errorFlg = true;
            }
        }else{
            $numberErrorMSG = "请输入内容";
            $errorFlg = true;
        }

        //错误标记
        if($errorFlg === false){
            $result = $this->insert($insertName,$insertBirthday,$insertTel);
            $displayMessage = "OK";
        }
        require('View/insertUserView.php');;
    }

    //-------姓名输入类型错误-------
    function nameError($insertName)
    {
        if(preg_match('/^[a-zA-z]+$/',$insertName)){
            return false;
        }
            return true;
    }

    //-------姓名长度错误-------
    function hasLengthError($insertName)
    {
        if(preg_match('/^.{1,10}$/',$insertName)){
            return false;
        }
            return true;
    }

    //-------验证手机号-------
    function checkPhoneNumber($insertTel)
    {
        if(preg_match('/^1[34578]{1}\d{9}$/',$insertTel)){
            return true;
        }
            return false;
    }
    //-------验证生日日期-------
    function checkBirthday($insertBirthday)
    {
        if(!empty($insertBirthday)){
            $now = time();
            $insertTime = strtotime($insertBirthday);
            if($now >= $insertTime){
                return true;
            }
        }
            return false;
    }

    //-------增加数据-------
    function insert($name,$birthday,$Tel)
    {
        $databaseModel = new databaseModel();
        $insertResult = $databaseModel->insertData($name,$birthday,$Tel);
        if($insertResult == true){
            return $insertResult;
        }else{
            return false;
        }
    }
}