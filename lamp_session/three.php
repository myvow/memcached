<?php
	session_start();

	$_SESSION=array();
	
	if(isset($_COOKIE[session_name()])){
		setCookie(session_name(), '', time()-100, '/');
	}

	session_destroy();

	echo session_name().'='.session_id().'<br>';
