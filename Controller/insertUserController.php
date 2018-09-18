<?php
include('Model/databaseModel.php');
date_default_timezone_set('PRC');

class InsertUserController
{
    /**
     * 注册页面
     * @return void
     */
    public function index()
    {
        $errorFlg = false;
        $errorMsgArr = [];
        $errorMsgArr['name'] = [];
        $errorMsgArr['birthday'] = [];
        $errorMsgArr['Department'] = [];
        //判断输入姓名是否为空
        if (!empty($_POST['insertName'])) {
            $insertName = trim($_POST['insertName']);
            //正则判断输入内容类型，提示错误信息
            if ($this->hasLengthError($insertName) === true) {
                $errorMsgArr['name'][] = "长度应为1-10个字节";
                $errorFlg = true;
            }
            if ($this->nameError($insertName) === true) {
                    $errorMsgArr['name'][] = "名字应为英文类型";
                    $errorFlg = true;
            }
        } else {
            $errorMsgArr['name'][] = "请输入内容";
            $errorFlg = true;
        }
        //判断输入生日是否为空
        if (!empty($_POST['insertBirthday'])) {
            $insertBirthday = trim($_POST['insertBirthday']);
            if ($this->checkBirthday($insertBirthday) === false) {
                $errorMsgArr['birthday'][] = "选择日期不能超过今天";
                $errorFlg = true;
            }
        } else {
            $errorMsgArr['birthday'][] = "请输入内容";
            $errorFlg = true;
        }
        $department = $_POST['departmentCondition'];
        //如果没有存入错误标记(errorFlg)，则跳转到insertCheck页面中确认信息
        if ($errorFlg === false) {
            require('View/insertUserCheckView.php');
        } else {
            require('View/Helper/formHelper.php');
            $formHelper = new formHelper();
            require('View/insertUserView.php');
        }
    }

    /**
     * 姓名错误
     * @param string $insertName 输入的姓名
     * @return boolin
     */
    public function nameError($insertName)
    {
        if (preg_match('/^[a-zA-z]+$/', $insertName)) {
            return false;
        }

        return true;
    }

    /**
     * 姓名长度错误
     * @param string $insertName 输入的姓名
     * @return boolin
     */
    public function hasLengthError($insertName)
    {
        if (preg_match('/^.{1,10}$/', $insertName)) {
            return false;
        }

        return true;
    }

    /**
     * 验证手机号
     * @param string $insertDepartment 输入的手机号
     * @return boolin
     */
    public function checkDepartment($insertDepartment)
    {
        if (preg_match('/^\d{3}$/', $insertDepartment)) {
            return true;
        }

        return false;
    }

    /**
     * 验证生日日期
     * @param string $insertBirthday 输入的生日
     * @return boolin
     */
    public function checkBirthday($insertBirthday)
    {
        if (!empty($insertBirthday)) {
            $now = time();
            $insertTime = strtotime($insertBirthday);
            if ($now >= $insertTime) {
                return true;
            }
        }

        return false;
    }

    /**
     * 添加数据
     * @param string $name 姓名
     * @param string $birthday 生日
     * @param string $department 电话
     * @return boolin
     */
    public function insert($name, $birthday, $department)
    {
        $databaseModel = new databaseModel();
        $insertResult = $databaseModel->insertData($name, $birthday, $department);
        if ($insertResult == true) {
            return $insertResult;
        } else {
            return false;
        }
    }

    /**
     * 重复确认输入
     * @param string $insertName 姓名
     * @param string $insertBirthday 生日
     * @param string $department 电话
     * @return boolin
     */
    public function insertCheck($insertName, $insertBirthday, $department)
    {
        //如果通过审查元素修改了输入内容，再次判断
        $errorFlg = false;
        $errorMsgArr = [];
        $errorMsgArr['name'] = [];
        $errorMsgArr['birthday'] = [];
        $errorMsgArr['Department'] = [];
        if (!empty($_POST['insertName'])) {
            $insertName = trim($_POST['insertName']);
            //正则判断输入内容类型，提示错误信息
            if ($this->hasLengthError($insertName) === true) {
                $errorMsgArr['name'][] = "长度应为1-10个字节";
                $errorFlg = true;
            }
            if ($this->nameError($insertName) === true) {
                $errorMsgArr['name'][] = "名字应为英文类型";
                $errorFlg = true;
            }
        } else {
            $errorMsgArr['name'][] = "请输入内容";
            $errorFlg = true;
        }
        //判断输入生日是否为空
        if (!empty($_POST['insertBirthday'])) {
            $insertBirthday = trim($_POST['insertBirthday']);
            if ($this->checkBirthday($insertBirthday) === false) {
                $errorMsgArr['birthday'][] = "选择日期不能超过今天";
                $errorFlg = true;
            }
        } else {
            $errorMsgArr['birthday'][] = "请输入内容";
            $errorFlg = true;
        }
        $department = $_SESSION['departmentCondition'];
        //如果没有errorFlg，执行insert方法添加，返回正确的结果之后进入结果页面。如果结果被人更改，则跳转警告
        if ($errorFlg === false) {
            $result = $this->insert($insertName, $insertBirthday, $department);
            if ($result == true) {
                require('View/insertUserSuccessView.php');
            } else {
                return false;
            }
        } else {
            //如果通过审查元素修改了输入内容，再次判断，报错
            require('View/searchUserView.php');
        }
    }
}
