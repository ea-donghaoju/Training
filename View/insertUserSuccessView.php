<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>社員管理システム</title>
</head>
<body>
<h1>社員管理システム</h1>

<p>姓名：<?php echo $_SESSION['insertName'] ?></p>
<p>生日：<?php echo $_SESSION['insertBirthday'] ?></p>
<p>职位：</p>
<p>部门：<?php
    //判断属于什么职位
    $department = $_SESSION['departmentCondition'];
    if( $department == 1){
        echo "人事部";
    }elseif( $department == 2){
        echo "総務部";
    }elseif( $department == 3){
        echo "開発部";
    }
    ?></p>
<p><?php if($result == true){
        echo "OK";
    }else{
        echo "error";
    } ?></p>


</body>
</html>