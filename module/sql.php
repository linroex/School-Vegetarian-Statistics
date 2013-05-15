<?php
	
	$config=array(
		'usernm'=>'',
		'passwd'=>'',
		'server'=>'localhost',
		'dbname'=>'school'
	);
	
	try{
		$mongo=new MongoClient($config['usernm']==''?"mongodb://{$config['server']}":"mongodb://{$config['usernm']}:{$config['passwd']}@{$config['server']}");
		$db=$mongo->$config['dbname'];
			
	}catch(Exception $e){
		echo "連線失敗，錯誤訊息：{$e->getMessage()}";
	}
	
?>