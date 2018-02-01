<?php
include('Model/databaseModel.php');


class searchUserController
{
    function index()
    {
        //保留上一次选择的条件值
        $_SESSION['condition'] = isset($_POST['condition'])?$_POST['condition']:"";
        $cSession = isset($_SESSION['condition'])?$_SESSION['condition']:"";

        //如果有报错就把下面的两个变量注释一下
            $result = "";
            $errorStr = "";
        if (!empty($_POST['searchName'])) {
            if ($_POST['searchCondition'] == 'Name') {
                $searchCondition = 'name';
            } elseif ($_POST['searchCondition'] == 'Tel') {
                $searchCondition = 'Tel';
            } elseif ($_POST['searchCondition'] == 'Birthday') {
                $searchCondition = 'Birthday';
            }
            $result = $this->search($_POST['searchName'], $searchCondition);//给search()传值
            if($result == null){
                $errorStr = "未查询到";
            }
        }else{
            $errorStr = "请输入内容";
        }

        require('View/searchUserView.php');
    }
        //-----查询方法-----
        function search($name, $searchCondition)
        {
            $searchModel = new databaseModel();
            $search = $searchModel->findData($name, $searchCondition);
            //做判断$search有没有查到
            if ($search) {
                return $search;
            } else {
                return false;;
            }
        }
    }
