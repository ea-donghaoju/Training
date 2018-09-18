<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>社員管理システム</title>
</head>
<body>
<h1>社員管理システム</h1>
<form action="/index.php/insertUser/insertCheck" method="post">
    <div style="width: 280px;" >
    <p>名前：<input type="text" name="insertName"  style="float: right" readonly="on"  value="<?php echo $_POST['insertName'] ?>"/></p>
    <p>诞生日：<input type="text" name="insertBirthday" style="float: right;" readonly="on" value="<?php echo $_POST['insertBirthday'] ?>"/></p>
    <p>部门：
        <?php
        //判断属于什么职位
        $department = $_POST['departmentCondition'];
        if( $department == 1){
            echo "人事部";
        }elseif( $department == 2){
            echo "総務部";
        }elseif( $department == 3){
            echo "開発部";
        }
        ?>
    </p>
    <p>
        职位：
    </p>
        <?php $_SESSION['insertName'] = $_POST['insertName'];
            $_SESSION['insertBirthday'] = $_POST['insertBirthday'];
            $_SESSION['departmentCondition'] = $_POST['departmentCondition'];
        ?>
<!--    部门：<p></p>-->
    </div>
    <hr/>
    <p>この内容で登録します。よろしいですか?</p>
    <span><input type="submit" value="登録"/></span>
    <span><input type="button" value="修正"/></span>
</form>
</body>
</html>