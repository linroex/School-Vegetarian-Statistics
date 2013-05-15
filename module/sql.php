<?php
	$config=array(
		'usernm'=>'',
		'passwd'=>'',
		'server'=>'localhost',
		'dbname'=>'school'
	);
				
	try{
		$db=new Mongo();
		//$db=new MongoClient($config['usernm']==''?"mongodb://{$config['server']}":"mongodb://{$config['usernm']}:{$config['passwd']}@{$config['server']}/{$config['dbname']}");
		//echo ($config['usernm']==''?"mongodb://{$config['server']}/{$config['dbname']}":"mongodb://{$config['usernm']}:{$config['passwd']}@{$config['server']}/{$config['dbname']}");
		//$col_users=$db->users;
		//$col_users->insert(array('name'=>'linroex'));
		var_dump($db);
	}catch(Exception $e){
		echo "連線失敗，錯誤訊息：{$e->getMessage()}";
	}
?>