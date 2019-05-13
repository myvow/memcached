<?php
	
	//在运行session_start(); //启动
	function open($save_path, $session_name){
		global $sess_save_path;

		$sess_save_path=$save_path;

		return true;
	}
	//session_write_close()  session_destroy() 
	function close(){
		return true;
	}
	//session_start(), $_SESSION， 读取session数据到$_SESSION中
	function read($id){
		global $sess_save_path;
		$sess_file=$sess_save_path."/glf_".$id;

		return (string)@file_get_contents($sess_file);
		
	}
	//结束时和session_write_close()强制提交SESSION数据 $_SESSION[]="aaa";
	function write($id, $sess_data){
		global $sess_save_path;
		$sess_file=$sess_save_path."/glf_".$id;

		if($fp=@fopen($sess_file, "w")){
			$return=fwrite($fp, $sess_data);
			fclose($fp);
			return $return;
		}else{
			return false;
		}

	}
	//session_destroy()
	function destroy($id){
		global $sess_save_path;
		$sess_file=$sess_save_path."/glf_".$id;

		return @unlink($sess_file);
	}

	//ession.gc_probability和session.gc_divisor值决定的，open(), read() session_start也会执行gc
	function gc($maxlifetime){
		global $sess_save_path;
		
		foreach(glob($sess_save_path."/glf_*") as $filename){
			if(filemtime($filename)+$maxlifetime < time() ){
				@unlink($filename);
				echo $filename;
			}
		}

		return true;
	}

	session_set_save_handler("open", "close", "read", "write", "destroy","gc");

	session_start();
