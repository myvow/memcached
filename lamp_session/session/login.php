<?php
	include "memsession.class.php";	
	echo session_id()."<br>";
	if(isset($_POST["sub"])){
		include "conn.inc.php";

		$sql="select id from users where name='{$_POST["name"]}' and password='".md5($_POST["password"])."'";
	
		$result=$mysqli->query($sql);

		if($result->num_rows > 0){
			$row=$result->fetch_assoc();
			
			$_SESSION["username"]=$_POST["name"];
			$_SESSION["uid"]=$row["id"];
			$_SESSION["isLogin5"]=1;

			echo '<script>';
			echo "location='index.php?".SID."'";
			echo '</script>';
			
		}

		echo "用户名密码有误！<br>";
	}
?>
<html>
	<head>
		<title>用户登录</title>
	</head>
	<body>
	<form action="login.php" method="post">
		<table align="center" border="1" width="300">
			<caption><h1>用户登录</h1></caption>
			<tr>
				<th>用户名</th>
				<td><input type="text" name="name"></td>
			</tr>
			<tr>
				<th>密 码</th>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				
				<td colspan="2" align="center">
					<input type="submit" name="sub" value="登 录">
				</td>
			</tr>
		</table>
		</form>
	</body>
</html>
