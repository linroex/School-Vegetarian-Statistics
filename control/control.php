<?php
	session_start();
	include('../module/users.php');
	if($_POST['cmd']=='login'){
		$users=new users($db);
		if($users->login($_POST['usernm'],$_POST['passwd'])){
			$_SESSION['user']=$users->getUserInfo($_POST['usernm'],$_POST['passwd']);
			$_SESSION['login_status']=1;
			header("Location:../addRecord.php");
		}else{
			$_SESSION['msg']='帳號或密碼錯誤';
			header("Location:../index.php");
		}
	}
?>