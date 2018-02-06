<?php
include('Model/databaseModel.php');


class searchUserController
{
    function index()
    {
        //保留上一次选择的条件值
        $_SESSION['searchCondition'] = isset($_POST['searchCondition'])?$_POST['searchCondition']:"";
        $cSession = isset($_SESSION['searchCondition'])?$_SESSION['searchCondition']:"";
        //清除左右两边的空格
        if(isset($_POST['searchName'])){
            $searchName = trim($_POST['searchName']);
        }
        //判断输入内容
        if (!empty($searchName)) {
            if ($_POST['searchCondition'] == 'Name') {
                $searchCondition = 'name';
            } elseif ($_POST['searchCondition'] == 'Tel') {
                $searchCondition = 'Tel';
            } elseif ($_POST['searchCondition'] == 'Birthday') {
                $searchCondition = 'Birthday';
            }
            $result = $this->search($searchName, $searchCondition);//给search()传值
            if($result == null){
                $errorStr = "未查询到";
            }
        }else{
            $errorStr = "请输入内容";
        }

        require('View/searchUserView.php');
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
