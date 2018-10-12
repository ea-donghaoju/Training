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
            return;
        }

        //获取post提交的数据
        $memberData = $_POST;

        //根据condition查询条件验证查询内容，$memberData是返回的错误信息
        $resultData = $this->membersModel->validateMembers($memberData);

        // 去除数组中空值，并判断是否有错误，如无错误则链接数据库查询数据
        if (array_filter($resultData['errorMsgArr'])  == null) {
            $resultData = $this->membersModel->search($memberData);

            //判断错误信息是否为空，否则返回对象数组
            if ($resultData['errorMsgArr'] != null) {
                 $resultData['errorMsgArr'];
            }

             $resultData['members'];
        }

        require('View/searchUserView.php');
    }
}
