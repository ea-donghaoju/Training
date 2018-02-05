<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<h1>添加用户</h1>
    <form action="/dev/insertUser" method="post" name="insertData">
        <!--添加姓名的验证规则-->
        名前：<input type="text" name="insertName" maxlength="11"/>
        <input type="submit" value="提交"/>
    </form>
    <div style="font-size: 16px;color: #FF0000">
        <!--    添加成功或者失败 出现提示-->
        <?php
        if(!empty($displayMessage) ){
            //正确的提示
            echo $displayMessage . "<br/>";
        }elseif(!empty($errorMessage)){
            //错误的提示
            echo $errorMessage."<br/>";
        }?>
    </div>
</body>
</html>