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
  <form action="/dev/departmentupdated" method="post">
      <input type="text" name="department_name" value="<?php if ($_SERVER['REQUEST_METHOD'] == 'GET') echo $getDepartment['department_name'] ?>"  required>
      <input type="hidden" name="id" value="<?php if ($_SERVER['REQUEST_METHOD'] == 'GET') echo $getDepartment['id'] ?>">
      <?php
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $formHelper->displayError($errorMsgArray['department_name']);
          }
        ?>
      <input type="submit" id="sub">
  </form>
</body>
</html>
