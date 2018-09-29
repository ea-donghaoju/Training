<?php
include('Model/databaseModel.php');
class DepartmentModel extends DataBaseModel{

    const DELFLAG_TRUE = 0;
    const DELFLAG_FALSE = 1;
    /**
     * 获取department表单所以得内容
     * @return object
     */
    public function getDepartmentList()
    {
        $sql = "select * from department where delflag = " . self::DELFLAG_FALSE;
        return $this->execSQL($sql);
    }

    /**
     * @param    $name string 用户插入的职位名称
     * @return   object
     */
    public function getDepartmentByName($name)
    {
        $sql = "select * from department where department_name = '".$name."'";
        return $this->execSQL($sql);
    }

    /**
     * @param   $id 职务对应的id
     * @return  object
     */
    public function getDepartmentById($id)
    {
        $sql = "select * from department where id = " . $id . "";
        return $this->execSQL($sql)->fetch_assoc();
    }

    /**
     * @param string 参数
     * @param    $id 职务id
     * @return   object
     */
    public function delDepartmentById($id)
    {
        $sql = "update department set delflag = " .self::DELFLAG_TRUE ." where id = " . $id;
        return $this->execSQL($sql);
    }

    /**
     * 根据提供的参数修改数据信息
     * @param    $id 要更改的职位id
     * @param    $departmentName 用户要更改的职位名称
     * @return        [type]                 [description]
     */
    public function updateDepartmentById($id, $departmentName)
    {
        $sql = "update department set department_name = '" . $departmentName . "' where id = " . $id ."";
        return $this->execSQL($sql);
    }

    /**
     * 插入数据
     * @param string $name 职位名称
     * @return void
     */
    public function insertDepartmentByName($name)
    {
        $sql = "insert into `department`(`department_name`) values('" . $name . "')";
        return $this->execSQL($sql);
    }

    /**
     * 对于接受的参数是否正确，
     * @param    $departmentName string post接受的用户名
     * @return array
     */
    public function confirmName($departmentName)
    {
        $errorMsgArray['department_name'] = [];

        //判断是否为空，如果是空，直接返回错误$errorMsgArray信息
        if (empty($departmentName)) {
            $errorMsgArray['department_name'][] = "输入的内容不可以为空";
            return $errorMsgArray;
        }

        //去除输入的空格
        $departmentName = trim($departmentName);

        //输入的职位内容是否为汉字,和长度不能大于50
        if (!$this->checkName($departmentName)) {
            $errorMsgArray['department_name'][] = "输入的内容只可以为汉字,字符长度不可以大于50";
        }

        //判断数据库中是否有相同的数据信息
        $department = $this->getDepartmentByName($departmentName);
        if ($department->num_rows != 0) {
            $errorMsgArray['department_name'][] = "该职位名已经存在，请重新输入";
        }

        //返回错误信息，或者为空
        return $errorMsgArray;
    }

    /**
     * 检查输入的内容是汉字,长度不能大于50
     * @param string 输入的内容
     * @param    bool true 或 false
     */
    private function checkName($insertname)
    {
        if (preg_match('/^[\x80-\xff]{1,50}$/',$insertname)) {
            return true;
        }

        return false;
    }
}
