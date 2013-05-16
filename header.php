<?php
	session_start();
	include('function.php');
	notify();
	if(!trim(basename($_SERVER['SCRIPT_NAME']))=='index.php'){
		if(!$_SESSION[login_status]){
			$_SESSION['msg']='此頁面需登入才可檢視';
			header("Location:index.php");
		}
		
	}
?>