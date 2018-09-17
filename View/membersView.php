<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<style type="text/css" media="screen">
		.del{
			cursor:pointer;
		}
		.id{
			display: none;
		}
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
				<th></th>
			</tr>
		</thead>
		<tbody style="text-align: center;">
		<?php
          if(!empty($members)){
            foreach($members as $member)
            {
            	if($member['status'] == 1){
                echo "<tr>";
                echo "<td class = 'id' id='id_01'>".$member['id']."</td>";
                echo "<td>" . $member['name'] . "</td>";//显示姓名
                echo "<td>" . $member['Brithday'] . "</td>";//显示生日  
                echo "<td>" . $member['department_name'] . "</td>";//显示部门 
                echo "<td class='del'>删除</td>";
                echo "</tr>";
            	}
            }
        }
		?>
		</tbody>
	</table>
</body>
</html>
<script type="text/javascript" charset="utf-8" async defer>
	 $(function(){
	    $('.del').click(function(){ 
	        alert("删除功能待完成");
	    });
});
</script>