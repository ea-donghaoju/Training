<?php require('View/Helper/formHelper.php');?>
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

    <?php  if (isset($message)) : ?>
      <p style="color: red"><?php echo $message;?></p>
    <?php endif;?>
  <form action="/dev/departmentUpdated" method="post">
      <input type="text" name="department_name" value="<?php if ($_SERVER['REQUEST_METHOD'] == 'GET') echo $getDepartment['department_name'] ?>"  required>
      <input type="hidden" name="id" value="<?php if ($_SERVER['REQUEST_METHOD'] == 'GET') echo $getDepartment['id'] ?>">
      <?php
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $formHelper = new formHelper();
            $formHelper->displayError($errorMsgArray['department_name']);
          }
        ?>
      <input type="submit" id="sub">
  </form>
</body>
</html>
