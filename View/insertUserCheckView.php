<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>社員管理システム</title>
</head>
<body>
<h1>社員管理システム</h1>

<?php echo $_SESSION['insertName']."       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;←name的值<br/>"; ?>
<?php echo $_POST['insertName']."       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;←name的值<br/>"; ?>
<?php echo $_SESSION['insertBirthday']."       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;←birth的值<br/>"; ?>
<?php echo $_POST['insertBirthday']."       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;←birth的值<br/>"; ?>
<?php echo $_SESSION['insertTel']."       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;←tel的值<br/>"; ?>
<?php echo $_POST['insertTel']."       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;←tel的值<br/>"; ?>

<form action="/dev/insertUser/insertCheck" method="post">
    <div style="width: 280px;" >
    <p>名前：<input type="text" name="insertName"  style="float: right" readonly="on"  value="<?php echo $_POST['insertName'] ?>"/></p>
    <p>诞生日：<input type="text" name="insertBirthday" style="float: right;" readonly="on" value="<?php echo $_POST['insertBirthday'] ?>"/></p>
    <p>电话番号：<input type="text" name="insertTel" style="float: right;" readonly="on" value="<?php echo $_POST['insertTel'] ?>"/></p>
<!--    部门：<p></p>-->
<!--    职位：<p></p>-->
    </div>
    <hr/>
    <p>この内容で登録します。よろしいですか?</p>
    <span>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="登録"/>&nbsp;&nbsp;&nbsp;&nbsp;</span>
    <span>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="修正"/>&nbsp;&nbsp;&nbsp;&nbsp;</span>
</form>

</body>
</html>