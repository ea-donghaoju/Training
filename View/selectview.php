<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<table border="1" cellpadding="0" cellspacing="0" width="300px"> 
		<thead>
			<tr>
				<th>name</th>
				<th>birthday</th>
			</tr>
		</thead>
		<tbody>
		<?php
          if(!empty($result)){  
            foreach($result as $key=>$v)
            {
                echo "<tr>";
                echo "<td>" . $v[0] . "</td>";//显示姓名
                echo "<td>" . $v[1] . "</td>";//显示生日  
                echo "</tr>";
            }
        }
		?>
		</tbody>
	</table>
</body>
</html>