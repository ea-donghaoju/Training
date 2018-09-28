<!DOCTYPE html>
<html>
<head>
    <title>department一览页面</title>
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <style type="text/css" media="screen">
        td{
            text-align: center;
        }
        a{
            text-decoration: none;
            color: black;
        }
        button{
            cursor: pointer;
            margin-right: 3px;
        }
    </style>
</head>
<body>
    <table border="1" cellpadding="0" cellspacing="0" width="600px">
        <thead>
            <tr>
                <th>职位编号</th>
                <th>职位名称</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
             <td colspan="4"><button><a href="/dev/departmentInsert" class="btn">添加</a></button></td>
            <?php
                foreach ($departments as $department) {
                    echo "<tr>";
                    echo "<td>" . $department['id'] . "</td>";
                    echo "<td>" . $department['department_name'] . "</td>";
                    echo "<td>" . "<button><a href=" . '/dev/departmentUpdated/index?id=' . "" . $department['id'] . ">编辑</a></button>" ."<button><a href=" . '/dev/departmentDel/index?id=' . "" . $department['id'] . ">删除</a></button>". "</td>";
                    echo "</tr>";
                }
             ?>
        </tbody>
    </table>
</body>
</html>
