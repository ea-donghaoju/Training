<!DOCTYPE html>
<html>
<head>
    <title>deparment数据添加</title>
    <style type="text/css" media="screen">
        #sub{
            cursor: pointer;
        }
    </style>
</head>
<body>
  <form action="/dev/departmentInsert" method="post">
      <input type="text" name="department_name" placeholder="请输入职位名称" required>
      <input type="submit" id="sub">
  </form>
</body>
</html>
