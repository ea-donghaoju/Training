<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>社員管理システム</title>
</head>
<body>
<h1>社員管理システム</h1>
姓名：<p><?php echo $_POST['insertName'] ?></p>
生日：<p><?php echo $_POST['insertBirthday'] ?></p>
职位：<p><?php echo $_POST['insertDepartment'] ?></p>
部门：<p></p>
<p><?php if($result == true){
        echo "OK";
    }else{
        echo "error";
    } ?></p>


</body>
</html>