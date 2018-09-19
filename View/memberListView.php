<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <style type="text/css" media="screen">
    </style>
</head>
<body>
    <table border="1" cellpadding="0" cellspacing="0" width="400px">
        <thead>
            <tr>
                <th class="id">id</th>
                <th>name</th>
                <th>birthday</th>
                <th>所属部门</th>
            </tr>
        </thead>
        <tbody style="text-align: center;">
        <?php
          if (!empty($members)) {
            foreach ($members as $member) {
                echo "<tr>";
                echo "<td class = 'id' id='id_01'>".$member['id']."</td>";
                echo "<td>" . $member['name'] . "</td>";//显示姓名
                echo "<td>" . $member['Birthday'] . "</td>";//显示生日
                echo "<td>" . $member['department_name'] . "</td>";//显示部门
                echo "</tr>";
            }
          }
        ?>
        </tbody>
    </table>
</body>
</html>