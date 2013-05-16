<?php
	include('model/sql.php');
	$col_users=$db->users;
	if($col_users->count()==0){
		try{
			$col_users->insert(array('name'=>'管理員','usernm'=>'admin','passwd'=>md5('00000000')));
		}catch(Exception $e){
			echo "發生錯誤，錯誤訊息：{$e->getMessage()}";
		}
		echo 'Successful';
	}else{
		echo 'Installed';
	}
?>