<?php
	session_start();


	print_r($_SESSION);
	echo '<br>';

	echo session_name().'='.session_id().'<br>';
