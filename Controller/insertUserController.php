<?php
include('Model/databaseModel.php');
date_default_timezone_set('PRC');

class insertUserController
{
    function index()
    {
        //initiate error flg
        $errorFlg = false;
        $errorMsgArr = array();
        $errorMsgArr['name'] = array();
        $errorMsgArr['birthday'] = array();
        $errorMsgArr['Tel'] = array();

        //判断输入姓名是否为空
        if(!empty($_POST['insertName'])) {
            $insertName = trim($_POST['insertName']);
            //正则判断输入内容类型，提示错误信息
            if ($this->hasLengthError($insertName) === true) {
                $errorMsgArr['name'][] = "长度应为1-10个字节";
            }
            if ($this->nameError($insertName) === true) {
                $errorMsgArr['name'][] = "名字应为英文类型";
            }
        }else{
            $errorMsgArr['name'][] = "请输入内容";
        }
        //判断输入生日是否为空
        if(!empty($_POST['insertBirthday'])){
            $insertBirthday = trim($_POST['insertBirthday']);
            if($this->checkBirthday($insertBirthday) === false){
                $errorMsgArr['birthday'][] = "选择日期不能超过今天";
                $errorFlg = true;
            }
        }else{
            $errorMsgArr['birthday'][] = "请输入内容";
            $errorFlg = true;
        }
        //判断输入手机号码是否为空
        if(!empty($_POST['insertTel'])){
            $insertTel = trim($_POST['insertTel']);
            if($this->checkPhoneNumber($insertTel) === false){
                $errorMsgArr['Tel'][] = "应为11位数字手机号码格式";
                $errorFlg = true;
            }
        }else{
            $errorMsgArr['Tel'][] = "请输入内容";
            $errorFlg = true;
        }
        //如果没有错误标记(errorFlg)就提交
        if(empty($errorMsgArr)){
            //$result = $this->insert($insertName,$insertBirthday,$insertTel);
            require('View/insertUserCheckView.php');

        }
        require('View/Helper/formHelper.php');
        $formHelper = new formHelper();
        echo "        sb";
        require('View/insertUserView.php');
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

    //-------重复确认输入-------
    function insertCheck(){
        require('View/insertUserCheckView.php');
    }

}