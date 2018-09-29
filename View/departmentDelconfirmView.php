<!DOCTYPE html>
<html>
<head>
    <title>是否删除这个职位</title>
    <style type="text/css" media="screen">
        #sub{
            cursor: pointer;
        }
        a{
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>
    <form action="/dev/departmentDel/confirmDel" method="get">
        <p>
        是否删除职位：<?php echo $_SESSION['department_name']?>
        </p>
        <input type="submit" value="确认" id = "sub" style="float: left; margin-right: 6px;">
    </form>
    <button style="float: left;"><a href="/dev/departmentList">返回</a></button>
</body>
</html>
