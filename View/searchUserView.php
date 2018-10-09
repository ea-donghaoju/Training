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
    请输入：<input type="text" name="searchName" placeholder="请输入内容" />&nbsp;&nbsp;
    选择条件：<select name="searchCondition">
            <option value="Name" selected>名字</option>
            <option value="Birthday" >诞生日</option>
            <option value="department_name" >所属部门</option>
            <option value="position_name">职位</option>
          </select>&nbsp;&nbsp;
    <input type="submit" value="Search"/>
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
