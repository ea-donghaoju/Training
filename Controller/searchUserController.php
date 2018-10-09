<?php
include('Model/MembersModel.php');
class SearchUserController
{
    //生命一个变量,用来储存实例化模型对象
    public $membersModel = null;

    public function __construct()
    {
        $this->membersModel = new MembersModel();
    }
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

        //调用checkByConditionName方法检测，在$searchName不为空的情况下，根据$searchCondition进行正则判断
        $membersData = $this->membersModel->validateMembers($searchCondition, $searchName);
        if (is_array($membersData)) {
            $errorMsgArr = $membersData;
        } else {
            $result = $membersData;
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

}
