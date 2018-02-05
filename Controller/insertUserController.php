<?php
include('Model/databaseModel.php');

class insertUserController
{
    function index()
    {
        //第一次来画面
        //清除左右两边的空格
        if(isset($_POST['insertName'])){
            $insertName = trim($_POST['insertName']);
        }
        //判断输入内容是否为空
        if(!empty($insertName)){
            //正则判断输入内容类型
            if(preg_match('/^[a-zA-z]+$/',$insertName)){
                //正则判断输入长度
                if(preg_match('/^[a-zA-z]{1,10}$/',$insertName)){
                    $result = $this->insert($insertName);
                    $displayMessage = "OK";
                }else{
                    $errorMessage = "长度应为1-10个字节";
                }
            }else{
                $errorMessage = "名字应为英文类型";
            }
        }else{
            $errorMessage = "请输入内容";
        }
        require('View/insertUserView.php');
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