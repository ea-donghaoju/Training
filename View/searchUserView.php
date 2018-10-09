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
            <option value="Name" <?php if($cSession=='Name'){ ?>selected="selected"<?php } ?>>名字</option>
            <option value="Birthday" <?php if($cSession=='Birthday'){ ?>selected="selected"<?php } ?>>诞生日</option>
            <option value="department_name" <?php if($cSession=='department_name'){ ?>selected="selected"<?php } ?>>所属部门</option>
            <option value="position_name" <?php if($cSession=='position_name'){ ?>selected="selected"<?php } ?>>职位</option>
          </select>&nbsp;&nbsp;
    <input type="submit" value="Search"/>
</form><br/>
<div style="font-size: 16px;color: #FF0000">
    <?php
        $formHelper->displayError($membersData['errorMsg']);
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
        if(!empty($membersData['members'])){
            foreach($membersData['members'] as $key=>$v)
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