<!DOCTYPE html>
<html>
<head>
    <title>deparment数据添加确认</title>
    <style type="text/css" media="screen">
        .sub{
            cursor: pointer;
        }
        a{
          text-decoration: none;
          color: black;
        }
    </style>
</head>
<body>
  <form action="/dev/DepartmentInsert/confirm" method="post">
      <input type="text" name="department_name" value="<?php echo $_POST['department_name']?>" readonly="readonly">
      <input type="submit" value="确认" class="sub">
  </form>
  <button><a href="javaScript:history.go(-1)">返回上一页</a></button>
</body>
</html>
