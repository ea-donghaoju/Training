<?php
include('Model/databaseModel.php');
class MembersModel extends DataBaseModel{

    /**
     *根据查询条件调用不同的正则验证
     * @param    $searchCondition 验证条件
     * @param    $searchName      验证输入的内容
     * @return   有错误则返回数组，否则则是返回对象
     */
    public function validateMembers($searchCondition, $searchName)
    {
        $result['errorMsgArr'] = [];

        //如果查询条件是birthday，则调用生日正则
        if ($searchCondition == 'Birthday') {
            $result['errorMsgArr'] = $this->checkBirthday($searchName);
        }

        //如果查询条件是Name，则调用姓名正则
        if ($searchCondition == 'Name') {
            $result['errorMsgArr'] = $this->checkName($searchName);
        }

        //如果查询条件是department_name或者position_name，则调用部门和职位正则
        if($searchCondition == 'department_name' || $searchCondition == 'position_name') {
            $result['errorMsgArr'] = $this->checkDepartmentPosition($searchName);
        }

        return $result;
    }

    /**
     * 验证生日的正则
     * @param $searchName string 要验证的名称
     * @return array
     *
     */
    private function checkBirthday($searchName)
    {
        //声明一个空数组，用来储存错误信息
        $errorMsgArr = [];
        if(!preg_match('/^[0-9]*$/', $searchName)) {
            $errorMsgArr[] = '生日只能输入数字';
            return $errorMsgArr;
        }

        return $errorMsgArr;
    }

    /**
     *验证成员名字的正则
     *@param $searchName string 要验证的信息
     *@return array
     */
    private function checkName($searchName)
    {
        //声明一个空数组，用来储存错误信息
        $errorMsgArr = [];
        if (!preg_match('/^[a-zA-Z]*$/', $searchName)) {
            $errorMsgArr[] = '姓名只能是字母';
            return $errorMsgArr;
        }

        return $errorMsgArr;
    }

    /**
     * 职位和部门的验证
     * @param $searchName string 要验证的信息
     * @return        [type] [description]
     */
    private function checkDepartmentPosition($searchName)
    {
        //声明一个空数组，用来储存错误信息
        $errorMsgArr = [];
        if (!preg_match('/^[\x80-\xff]*$/', $searchName)) {
            $errorMsgArr[] = '部门或者职位是中文';
            return $errorMsgArr;
        }

        return $errorMsgArr;
    }

       /**
     * 如果正则验证正确，链接数据库查询数据
     * @param $searchName     string 查询内容
     * @param $searchCondition string 查询条件
     * @return array 或者 object
     */
    public function search($searchCondition, $searchName)
    {
        //声明一个空数组，用来储存错误信息
        $result['errorMsgArr'] = [];
        $result['members'] = [];
        $result['members'] = $this->findData($searchCondition, $searchName);
        if ($result['members'] -> num_rows == 0) {
            $result['errorMsgArr'][] = "未查询到";
            return $result;
        }

        return $result;
    }

    /**
     * @param string参数
     * @return array
     */
    public function getMembersList()
    {
        $sql = "select member.id,name,Birthday,department_name,status from member join department where member.Department_id=department.id and status = 1";
        $members = $this->execSQL($sql);
        return $members;
    }

    /**
     * 查询方法
     * @param string $searchCondition 搜索条件
     * @param string $name 名字
     * @return array
     */
    public function findData($searchCondition, $name)
    {
        $sql = "select member.*,department_name,position_name from member inner join department on member.Department_id = department.id inner join position on member.Position_id = position.id where ". $searchCondition . " like '%" . $name . "%'";
        return $this->execSQL($sql);
    }

    /**
     * 添加方法
     * @param string $name 姓名
     * @param string $birthday 生日
     * @param string $department 电话
     * @return void
     */
    public function insertData($name, $birthday, $department)
    {
        $sql = "insert into member (Name,Birthday,Department_id) values ('" . $name . "','" . $birthday . "','" . $department . "')";
        $result = $this->execSQL($sql);
        return $result;
    }
}
