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

        //调用checkByConditionName方法检测，在$searchName不为空的情况下，根据$searchCondition进行正则判断
        $resultData = $this->checkByConditionName($searchCondition, $searchName);
        if (is_array($resultData)) {
            $errorMsgArr = $resultData;
        } else {
            $result = $resultData;
        }

        require('View/Helper/formHelper.php');
        $formHelper = new formHelper();
        require('View/searchUserView.php');
    }

    /**
     *根据不同的条件去使用正则判断，条件是否正确
     *@param $searchCondition string   查询条件
     *@param $searchName      string   查询名称
     *@return $errorMsgArr() array     错误信息
     */
    private function checkByConditionName($searchCondition, $searchName)
    {
        $errorMsgArr = [];
        if (!empty($searchName)) {
            $errorMsgArr = $this->checkBySearchCondition($searchCondition, $searchName);
            return $errorMsgArr;
        } else {
            $searchName = "";
            $searchCondition = "name";
            $errorMsgArr[] = "请输入内容";
            return $errorMsgArr;
        }
        return $errorMsgArr;

    }

    /**
     * 正则验证，根据查询条件，验证不同的正则
     * @param $searchCondition string 查询条件
     * @param $searchName string 查询名称
     * @return $errorMsgArr array
     */
    private function checkBySearchCondition($searchCondition, $searchName)
    {
        $errorMsgArr = [];

        //如果查询的条件是“Birthday”
        if ($searchCondition == 'Birthday') {
            if(!preg_match('/^[0-9]*$/', $searchName)) {
                $errorMsgArr[] = '生日只能输入数字';
                return $errorMsgArr;
            }
            $result = $this->search($searchCondition, $searchName);//给search()传值
            if ($result -> num_rows == 0) {
                $errorMsgArr[] = "未查询到";
                return $errorMsgArr;
            }
            return $result;

        //如果查询的条件是姓名
        } else if ($searchCondition == 'Name') {
            if (!preg_match('/^[a-zA-Z]*$/', $searchName)) {
                $errorMsgArr[] = '姓名只能是字母';
                return $errorMsgArr;
            }

            $result = $this->search($searchCondition, $searchName);//给search()传值
            if ($result -> num_rows == 0) {
                $errorMsgArr[] = "未查询到";
                return $errorMsgArr;
            }
            return $result;

        //如果查询的条件是部门或者职位
        }else if ($searchCondition == 'department_name' || $searchCondition == 'position_name') {
            if (!preg_match('/^[\x80-\xff]*$/', $searchName)) {
                $errorMsgArr[] = '部门或者职位是中文';
                return $errorMsgArr;
            }

            $result = $this->search($searchCondition, $searchName);//给search()传值
            if ($result -> num_rows == 0) {
                $errorMsgArr[] = "未查询到";
                return $errorMsgArr;
            }
            return $result;
        }

        return $errorMsgArr;
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
