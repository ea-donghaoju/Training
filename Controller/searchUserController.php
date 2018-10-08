<?php
include('Model/MembersModel.php');
class SearchUserController
{
    /**
     * 搜索页面
     * @return void
     */
    public function index()
    {
        //保留上一次选择的条件值
        $_SESSION['searchCondition'] = isset($_POST['searchCondition'])?$_POST['searchCondition']:"";
        $cSession = isset($_SESSION['searchCondition'])?$_SESSION['searchCondition']:"";

        //清除搜索内容左右两边的空格
        $searchName = '';
        $errorMsgArr = [];

        if (isset($_POST['searchName'])) {
            $searchName = trim($_POST['searchName']);
        }
        $searchCondition = false;
        if (isset($_POST['searchCondition'])) {
            $searchCondition = $this->checkPostCondition($_POST['searchCondition']);
        }

        //判断输入内容
        if (!empty($searchName)) {
            if (preg_match('/^[\x80-\xff_a-zA-Z0-9]+$/', $searchName)) {
                $result = $this->search($searchCondition, $searchName);//给search()传值
                if ($result -> num_rows == 0) {
                    $errorMsgArr[] = "未查询到";
                }
            } else {
                $errorMsgArr[] = "请输入中文、英文或者数字";
            }
        } else {
            $searchName = "";
            $searchCondition = "name";
            $errorMsgArr[] = "请输入内容";
        }
        require('View/Helper/formHelper.php');
        $formHelper = new formHelper();
        require('View/searchUserView.php');
    }

    /**
     * 验证搜索条件
     * @param string $postCondition 搜索条件
     * @return boolin
     */
    public function checkPostCondition($postCondition)
    {
        if ($postCondition == 'Name'
            || $postCondition == 'department_name'
            || $postCondition == 'Birthday'
            || $postCondition == 'position_name') {
            return $postCondition;
        }
        return false;
    }

    /**
     * 查询数据
     * @param string $name 名字
     * @param string $searchCondition 搜索条件
     * @return bool
     */
    public function search($searchCondition, $name)
    {
        $membersModel = new MembersModel();
        $searchResult = $membersModel->findData($searchCondition, $name);

        //做判断$search有没有查到
        if ($searchResult) {
            return $searchResult;
        } else {
            return false;
        }
    }
}
