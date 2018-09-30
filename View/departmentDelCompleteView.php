<?php
    require('View/Helper/formHelper.php');
    $formHelper = new formHelper();
?>
<!DOCTYPE html>
<html>
<head>
    <title>显示已删除信息</title>
</head>
<body>
    <h5>显示已删除信息</h5>
    <p>已经删除职务为：<?php echo $formHelper->h($departmentName);?></p>
    <button><a href="/dev/departmentList" style="text-decoration: none; color: black;">确认</a></button>
</body>
</html>
