<?php

	include "memsession.class.php";

	if(!$_SESSION["isLogin5"]){
		header("Location:login.php");
	}
