<?php
	session_start();
	include('../model/users.php');
	include('../model/records.php');
	
	$users=new users($db);
	$records=new records($db);
	//insertLog($db,$user,$type,$text);
	
	
	if($_POST['cmd']=='login'){
		
		if($users->login($_POST['usernm'],$_POST['passwd'])){
			$_SESSION['user']=$users->getUserInfoByAuth($_POST['usernm'],$_POST['passwd']);
			$_SESSION['login_status']=true;
			insertLog($db,$_SESSION['user']['usernm'],$_POST['cmd'],$_POST['cmd']);
			header("Location:../addRecord.php");
			_exit($mongo);
		}else{
			$_SESSION['msg']='帳號或密碼錯誤';
			insertLog($db,$_SESSION['login_status']?$_SESSION['user']['usernm']:'guest','login error','login error');
			header("Location:../index.php");
			_exit($mongo);
		}
	}
	
	if(!empty($_SESSION['user']['usernm'])){
		insertLog($db,$_SESSION['login_status']?$_SESSION['user']['usernm']:'guest',$_POST['cmd'],$_POST['cmd']);
	}
	
	//防止未登入的用戶存取此頁面
	if($_POST['login_status']!=1){
		if(!$_SESSION['login_status']){
			
			_exit($mongo,'Please Login');
		}
	}
	
	if($_POST['cmd']=='adduser'){
		$status=$users->addUser($_POST['name'],$_POST['usernm'],$_POST['passwd'],$_POST['retry-passwd']);
		$_SESSION['msg']=$status;
		if($status=='兩次密碼輸入不相同'){
			header("Location:../addUser.php");
			_exit($mongo);
		}else{
			header("Location:../viewUser.php");
			_exit($mongo);
		}
	}
	
	if($_POST['cmd']=='viewuser'){
		echo json_encode($users->viewUser());
		_exit($mongo);
	}
	
	if($_POST['cmd']=='getUserData'){
		echo json_encode($users->getUserInfoById($_POST['userid']));
		_exit($mongo);
	}
	
	if($_POST['cmd']=='edituser'){
		try{
			$_SESSION['msg']=$users->updateUser($_POST['userid'],$_POST['name'],$_POST['passwd'],$_POST['retry-passwd'],$_POST['removeUser']);
			
		}catch(Exception $e){
			$_SESSION['msg']=$e->getMessage();
		}
		header("Location:../viewUser.php");
		_exit($mongo);
	}
	if($_POST['cmd']=='batchdeluser'){
		$_SESSION['msg']=$users->batchDelUser($_POST['id']);
		header("Location:../viewUser.php");
		_exit($mongo);
	}
	if($_POST['cmd']=='addrecord'){
		$_SESSION['msg']=$records->addRecord($_POST['date'],$_POST['stuid']);
		header("Location:../viewRecord.php");
		_exit($mongo);
	}
	if($_POST['cmd']=='viewrecord'){
		
		echo json_encode($records->listRecord($_POST['semester'],$_POST['sort']));
		_exit($mongo);
	}
	if($_POST['cmd']=='setused'){
		$temp=explode(',',$_POST['batch_used']);
		
		foreach($_POST['batch_used'] as $temp){
			
			$data=explode(',',$temp);
			$_SESSION['msg']=$records->setRecordUsed($data[0],$_POST['semester'],$data[1]);
			header('Location:../viewRecord.php');
			_exit($mongo);
		}
		
	}
	if($_POST['cmd']=='getRecordInfo'){
		echo json_encode($records->getRecordInfo($_POST['stuid'],$_POST['semester']));
		_exit($mongo);
	}
	if($_POST['cmd']=='removeRecord'){
		$_SESSION['msg']=$records->removeRecord($_POST['deleteRecord']);
		header('Location:../viewRecord.php');
		_exit($mongo);
	}
	if($_POST['cmd']=='searchLog'){
		echo json_encode(searchLog($db,$_POST['text'],$_POST['date'],$_POST['user'],$_POST['page']));
		_exit($mongo);
	}
	if($_POST['cmd']=='countLog'){
		echo (countLog($db,$_POST['text'],$_POST['date'],$_POST['user']));
		_exit($mongo);
	}
?>