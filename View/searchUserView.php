<?php  require('View/Helper/formHelper.php');
        $formHelper = new formHelper();?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>社員管理システム</title>
</head>
<body>
<h1>社員管理システム</h1>
<form action="/dev/searchUser" method="post" name="searchData">
    <h5> 请在以下文本框输入想要查找的内容：</h5>
    <table width="700px" color="gray">
        <tr>
            <td>姓名</td>
            <td>生日</td>
            <td>部门</td>
            <td>职位</td>
        </tr>
    </table>
    <div>
        <input type="text" name="Name" placeholder="请输入要查找的姓名" />&nbsp;&nbsp;
        <input type="text" name="Birthday" placeholder="请输入你要查找的生日日期">&nbsp;&nbsp;
        <input type="text" name="department_name" placeholder="请输入你要查找的部门名称">&nbsp;&nbsp;
        <input type="text" name="position_name" placeholder="请输入你要查找的职位名称">
    </div>
    选择查找内容的关系：
    <select name="connection">
        <option value="and">并且</option>
        <option value="and">或者</option>
    </select>
    <input type="submit" value="查找"/>
</form><br/>
<div style="font-size: 16px;color: #FF0000">
   <?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $formHelper->displayError($resultData['errorMsgArr']);
      }
    ?>
</div>
<table width="700px" border="1" cellpadding="0" cellspacing="0">
    <tr>
        <td>Name</td>
        <td>Birthday</td>
        <td>Department</td>
        <td>Position</td>
    </tr>
    <?php
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return;
        }
        if(!empty($resultData['members'])){
            foreach($resultData['members'] as $key=>$v)
            {
                echo "<tr>";
                echo "<td>" . $formHelper->h($v['Name']) . "</td>";
                echo "<td>" . $formHelper->h($v['Birthday']) . "</td>";
                echo "<td>" . $formHelper->h($v['department_name']) . "</td>";
                echo "<td>" . $formHelper->h($v['position_name']). "</td>";
                echo "</tr>";
            }
        }
    ?>
</table>
<hr/>
</body>
</html>
