<?php
	session_start();
	include('../module/users.php');
	$users=new users($db);
	if($_POST['cmd']=='login'){
		
		if($users->login($_POST['usernm'],$_POST['passwd'])){
			$_SESSION['user']=$users->getUserInfo($_POST['usernm'],$_POST['passwd']);
			$_SESSION['login_status']=1;
			header("Location:../addRecord.php");
		}else{
			$_SESSION['msg']='帳號或密碼錯誤';
			header("Location:../index.php");
		}
	}
	
	if($_POST['cmd']=='adduser'){
		$status=$users->addUser($_POST['name'],$_POST['usernm'],$_POST['passwd'],$_POST['retry-passwd']);
		if($status['ok']){
			$_SESSION['msg']='建立新用戶成功';
		}else{
			$_SESSION['msg']=$status;
		}
	}
	
	$mongo->close();
?>