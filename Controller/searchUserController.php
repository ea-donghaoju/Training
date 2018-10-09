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
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            require('View/searchUserView.php');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $searchCondition = $_POST['searchCondition'];
            $searchName = trim($_POST['searchName']);

            //根据condition查询条件验证查询内容，$memberData是返回的错误信息
            $resultData = $this->membersModel->validateMembers($searchCondition, $searchName);

            // 如果没有错写信息，链接数据库查询数据
            if ($resultData['errorMsgArr'] == null) {
                $resultData = $this->membersModel->search($searchCondition, $searchName);
            }

            require('View/searchUserView.php');
        }
    }
}
