<?php
include('Model/databaseModel.php');


class searchUserController
{
    function index()
    {
        //保留上一次选择的条件值
        $_SESSION['searchCondition'] = isset($_POST['searchCondition'])?$_POST['searchCondition']:"";
        $cSession = isset($_SESSION['searchCondition'])?$_SESSION['searchCondition']:"";

        //POST Validation
        //清除搜索内容左右两边的空格
        $searchName = '';
        if(isset($_POST['searchName'])){
            $searchName = trim($_POST['searchName']);
        }

        $searchCondition = false;
        if(isset($_POST['searchCondition'])){
            $searchCondition = $this->checkPostCondition($_POST['searchCondition']);
        }

        if($searchCondition === false){
            //Post error
            die("ERROR");
        }

        //判断输入内容
        if (!empty($searchName)) {
            if(preg_match('/^[\w\?\-]+$/',$searchName))
            {
                $result = $this->search($searchName, $searchCondition);//给search()传值
                if($result == null){
                    $errorStr = "未查询到";
                }
            }else{
                $errorStr = "输入类型为英文";
            }
        }else{
            $errorStr = "请输入内容";
        }
        require('View/searchUserView.php');
    }

        //-----验证搜索条件-----
        //input Posted Search Condition
        //output Validated Search Condition or Validate False
    function checkPostCondition($postCondition)
    {
        if ($postCondition == 'Name'
            || $postCondition == 'Tel'
            || $postCondition == 'Birthday') {
            return $postCondition;
        }
        return false;
    }

        //-----查询数据-----
    function search($name, $searchCondition)
    {
        $databaseModel = new databaseModel();
        $searchResult = $databaseModel->findData($name, $searchCondition);
        //做判断$search有没有查到
        if ($searchResult) {
            return $searchResult;
        } else {
            return false;;
        }
    }
}
