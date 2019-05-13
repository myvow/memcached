<?php
	
	include "comm.php";

	$username=$_SESSION["username"];
	$sid=session_id();
	//开启SESSION
	session_start();

	//清空SESSION值
	$_SESSION=array();


	//删除客户端的在COOKIE中的Sessionid
	if(isset($_COOKIE[session_name()])){
		setCookie(session_name(), '', time()-3600, '/');
	}
	//彻底销毁session
	session_destroy();
	
	echo $username."再见!";
	echo $sid;
?>
<br>
	<a href="login.php">重新登录</a>
