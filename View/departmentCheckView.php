<!DOCTYPE html>
<html>
<head>
    <title>deparment数据添加确认</title>
    <style type="text/css" media="screen">
        .sub{
            cursor: pointer;
            float: left;
            margin-right: 5px;
        }
        a{
          text-decoration: none;
          color: black;
        }
    </style>
</head>
<body>
  <form action="/dev/DepartmentInsert/confirm" method="post">
    <p name"department_name" >要添加的内容为：<?php echo $_SESSION['insertDepartmentName'] ?></p>
      <input type="submit" value="确认" class="sub">
  </form>
  <button><a href="javaScript:history.go(-1)">返回上一页</a></button>
</body>
</html>
