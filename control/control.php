<?php
	session_start();
	include('../module/users.php');
	
	$users=new users($db);
	
	if($_POST['cmd']=='login'){
		
		if($users->login($_POST['usernm'],$_POST['passwd'])){
			$_SESSION['user']=$users->getUserInfoByAuth($_POST['usernm'],$_POST['passwd']);
			$_SESSION['login_status']=true;
			header("Location:../addRecord.php");
		}else{
			$_SESSION['msg']='帳號或密碼錯誤';
			header("Location:../index.php");
		}
	}
	
	//防止未登入的用戶存取此頁面
	if($_POST['login_status']!=1){
		if(!$_SESSION['login_status']){
			exit('Please Login');
		}
	}
	
	if($_POST['cmd']=='adduser'){
		$status=$users->addUser($_POST['name'],$_POST['usernm'],$_POST['passwd'],$_POST['retry-passwd']);
		if($status['ok']){
			$_SESSION['msg']='建立新用戶成功';
		}else{
			$_SESSION['msg']=$status;
		}
		header("Location:../viewUser.php");
	}
	
	if($_POST['cmd']=='viewuser'){
		echo json_encode($users->viewUser());
	}
	
	if($_POST['cmd']=='getUserData'){
		echo json_encode($users->getUserInfoById($_POST['userid']));
	}
	
	$mongo->close();
?>