<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<h1>添加用户</h1>
<div style="font-size: 16px;color: #000">
    <!--    添加成功出现提示-->
    <?php
    if(!empty($displayMessage) ){
        //正确的提示
        echo $displayMessage ;
    }?>
</div>
    <form action="/dev/insertUser" method="post" name="insertData">
        <!--添加姓名的验证规则-->
        <div style="width: 280px;" >
        <p>名前：<input type="text" name="insertName" maxlength="11" style="float: right"/></p>
        <!--添加未成功的报错-->
                <?php
                    $formHelper->displayError($nameErrorMSG);
                ?>
        <p>诞生日：<input type="date" name="insertBirthday" style="float: right;"/></p>
<!--关于生日的提示-->
                <?php
                    $formHelper->displayError($birthdayErrorMSG);
                ?>
        <p>电话番号：<input type="text" name="insertTel" style="float: right;"/></p>
<!--未输入电话则提示-->
                <?php
                    $formHelper->displayError($numberErrorMSG);
                ?>
        <input type="submit" value="提交"/>
        </div>

    </form>

    </div>
</body>
</html>