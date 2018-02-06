<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<form action="/dev/searchUser" method="post" name="searchData">
    请输入：<input type="text" name="searchName"/>&nbsp;&nbsp;
    选择条件：<select name="searchCondition">
            <option value="Name" <?php if($cSession=='Name'){ ?>selected="selected"<?php } ?>>名前</option>
            <option value="Tel" <?php if($cSession=='Tel'){ ?>selected="selected"<?php } ?>>电话番号</option>
            <option value="Birthday" <?php if($cSession=='Birthday'){ ?>selected="selected"<?php } ?>>诞生日</option>
          </select>&nbsp;&nbsp;
    <input type="submit" value="Search"/>
</form><br/>
<div style="font-size: 16px;color: #FF0000">
    <?php
    if(!empty($errorStr) ){
        echo $errorStr . "<br/>";
    }?>
</div>
<table width="400px" border="1" cellpadding="0" cellspacing="0">
    <tr>
        <td>Name</td>
        <td>Birthday</td>
        <td>Tel</td>
    </tr>
    <?php
        if(!empty($result)){
            foreach($result as $key=>$v)
            {
                $userName = htmlspecialchars($v[1]);
                $userBirthday = htmlspecialchars($v[2]);
                $userTel = htmlspecialchars($v[3]);
                echo "<tr>
                <td>$userName</td>
                <td>$userBirthday</td>
                <td>$userTel</td>
                      </tr>";
            }
        }
    ?>
</table>
<hr/>
</body>
</html>