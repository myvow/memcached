<?php
	include "comm.php";
	include "conn.inc.php";

	echo "用户<b>".$_SESSION["username"]."</b>您好, 这是网站第三个页面！";
		echo session_id()."<br>";
	echo "你的权限如下:<br>";

	$sql="select allow_1, allow_2, allow_3, allow_4 from users where id='{$_SESSION["uid"]}'";

	$result=$mysqli->Query($sql);

	$user=$result->fetch_assoc();

	if($user["allow_1"]){
		echo "111111111111111111111111<br>";
	}
	if($user["allow_2"]){
		echo "2222222222222222<br>";
	}
	if($user["allow_3"]){
		echo "333333333333333333333<br>";
	}
	if($user["allow_4"]){
		echo "444444444444444444444444<br>";
	}

?>
	<a href="index.php">首页</a><br>
	<a href="two.php">第二页</a> <br>
	<a href="three.php">第三页</a> <br>
	<a href="logout.php">退出</a> <br>
