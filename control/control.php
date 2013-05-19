<?php
	session_start();
	include('../model/users.php');
	include('../model/records.php');
	$users=new users($db);
	$records=new records($db);
	if($_POST['cmd']=='login'){
		
		if($users->login($_POST['usernm'],$_POST['passwd'])){
			$_SESSION['user']=$users->getUserInfoByAuth($_POST['usernm'],$_POST['passwd']);
			$_SESSION['login_status']=true;
			header("Location:../addRecord.php");
			exit();
		}else{
			$_SESSION['msg']='帳號或密碼錯誤';
			header("Location:../index.php");
			exit();
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
		$_SESSION['msg']=$status;
		if($status=='兩次密碼輸入不相同'){
			header("Location:../addUser.php");
			exit();
		}else{
			header("Location:../viewUser.php");
			exit();
		}
	}
	
	if($_POST['cmd']=='viewuser'){
		echo json_encode($users->viewUser());
		exit();
	}
	
	if($_POST['cmd']=='getUserData'){
		echo json_encode($users->getUserInfoById($_POST['userid']));
		exit();
	}
	
	if($_POST['cmd']=='edituser'){
		try{
			$_SESSION['msg']=$users->updateUser($_POST['userid'],$_POST['name'],$_POST['passwd'],$_POST['retry-passwd'],$_POST['removeUser']);
			
		}catch(Exception $e){
			$_SESSION['msg']=$e->getMessage();
		}
		header("Location:../viewUser.php");
		exit();
	}
	if($_POST['cmd']=='batchdeluser'){
		$_SESSION['msg']=$users->batchDelUser($_POST['id']);
		header("Location:../viewUser.php");
		exit();
	}
	if($_POST['cmd']=='addrecord'){
		$_SESSION['msg']=$records->addRecord($_POST['date'],$_POST['stuid']);
		header("Location:../viewRecord.php");
		exit();
	}
	if($_POST['cmd']=='viewrecord'){
		
		echo json_encode($records->listRecord($_POST['semester']));
		exit();
	}
	if($_POST['cmd']=='setused'){
		$temp=explode(',',$_POST['batch_used']);
		
		foreach($_POST['batch_used'] as $temp){
			
			$data=explode(',',$temp);
			echo '<pre>';
			$t=$records->setRecordUsed($data[0],$_POST['semester'],$data[1]);
			foreach($t as $temp){
				var_dump($temp['_id']);
				exit();
			}
			
		}
		
	}
	$mongo->close();
?>