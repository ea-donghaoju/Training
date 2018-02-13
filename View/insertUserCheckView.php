<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>社員管理システム</title>
</head>
<body>
<h1>社員管理システム</h1>

<form action="">

    姓名：<p><? echo $_SESSION['insertName']; ?></p>
    生日：<p><? echo $_SESSION['insertBirthday']; ?></p>
    电话号码：<p><? echo $_SESSION['insertTel']; ?></p>
    部门：<p></p>
    职位：<p></p>
    <span><input type="submit" value="登録"/></span>
    <span><input type="button" value="修正"/></span>
</form>

</body>
</html>