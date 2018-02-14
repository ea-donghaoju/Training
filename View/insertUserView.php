<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>社員管理システム</title>
</head>
<body>

<h1>社員管理システム</h1>
<div style="font-size: 16px;color: #000">
    <!--    添加成功出现提示-->
    <?php
    if($errorFlg === false){
        //正确的提示
        echo "OK" ;
    }?>
</div>
        <form action="/dev/insertUser" method="post" name="insertData">
        <!--添加姓名的验证规则-->
        <div style="width: 280px;" >
        <p>名前：<input type="text" name="insertName" maxlength="11" style="float: right"/></p>
        <!--添加未成功的报错-->
                <?php
                    $formHelper->displayError($errorMsgArr['name']);
                ?>
        <p>诞生日：<input type="date" name="insertBirthday" style="float: right;"/></p>
        <!--关于生日的提示-->
                <?php
                    $formHelper->displayError($errorMsgArr['birthday']);
                ?>
        <p>部门：
<!--                 <input type="text" name="insertDepartment" style="float: right;"/>-->
                 <select name="departmentCondition" >
                     <option value="1">人事部</option>
                     <option value="2">総務部</option>
                     <option value="3">開発部</option>
                 </select>
        </p>
        <!--未输入职位则提示-->
                <?php
                    $formHelper->displayError($errorMsgArr['Department']);
                ?>
<!--<p>部门：<input type="text" name=""/></p>-->
            <input type="submit" value="提交"/>
<!--<a href="insertUser/insertCheck">???</a>-->
        </div>

    </form>

    </div>
</body>
</html>