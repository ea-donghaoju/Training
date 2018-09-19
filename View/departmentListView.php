<!DOCTYPE html>
<html>
<head>
    <title>department一览页面</title>
    <style type="text/css" media="screen">
        td{
            text-align: center;
        }
        button{
            cursor: pointer;
        }
    </style>
</head>
<body>
    <table border="1" cellpadding="0" cellspacing="0" width="600px">
        <thead>
            <tr>
                <th>职位编号</th>
                <th>职位名称</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($departments as $department) {
                    echo "<tr>";
                    echo "<td>" . $department['id'] . "</td>";
                    echo "<td>" . $department['department_name'] . "</td>";
                    echo "</tr>";
                }
             ?>
             <td colspan="3"><button onclick="tianjia()">添加</button></td>
        </tbody>
    </table>
</body>
<script>
function tianjia() {
    window.location.href='/dev/departmentInsert';
}
</script>
</html>
