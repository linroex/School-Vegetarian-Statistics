<?php
	function secunity($var){
		if(is_array($var)){
			$i=0;
			foreach($var as $var_temp){
				
				$var_temp=htmlspecialchars($var_temp);
				$result[$i]=trim($var_temp);
				$i++;
			}
		}else{
			$result=trim(htmlspecialchars($var));
		}
		return $result;
	}
	function post($target,$data){
		$curl=curl_init();
		$options = array(
			CURLOPT_URL=>'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) . (substr(trim($target),1,1)=='/'?'':'/') . $target,
			CURLOPT_HEADER=>0,
			CURLOPT_VERBOSE=>0,
			CURLOPT_RETURNTRANSFER=>true,
			CURLOPT_USERAGENT=>"Mozilla/4.0 (compatible;)",
			CURLOPT_POST=>true,
			CURLOPT_POSTFIELDS=>http_build_query($data),
		);
		curl_setopt_array($curl,$options);
		$result=curl_exec($curl);
		curl_close($curl);
		return $result;
	}
	function get_client_ip(){
		foreach (array(
					'HTTP_CLIENT_IP',
					'HTTP_X_FORWARDED_FOR',
					'HTTP_X_FORWARDED',
					'HTTP_X_CLUSTER_CLIENT_IP',
					'HTTP_FORWARDED_FOR',
					'HTTP_FORWARDED',
					'REMOTE_ADDR') as $key) {
			if (array_key_exists($key, $_SERVER)) {
				return $_SERVER[$key];
			}
		}
		return null;
	}
	function insertLog($db,$user,$type,$text){
		file_put_contents('../log.php',json_encode(array('type'=>trim($type),'text'=>trim(htmlspecialchars($text)),'date'=>new MongoDate(time()),'ip'=>get_client_ip(),'user'=>trim($user))) . "\n",FILE_APPEND);
		return $db->log->insert(array('type'=>trim($type),'text'=>trim(htmlspecialchars($text)),'date'=>new MongoDate(time()),'ip'=>get_client_ip(),'user'=>trim($user)));
	}
	function searchLog($db,$text='',$date='',$user='',$page=''){
		$info=secunity(array($text,$date,$user));
		$skip=$page==''?0:$page*20-20;
		
		return iterator_to_array($db->log->find(array
		(
			'user'=>new MongoRegex("/{$info[2]}/"),
			'date'=>array('$gte'=>new MongoDate(strtotime($date==''?0:($date . '0:0'))),'$lte'=>new MongoDate(strtotime($date . '23:59'))),
			'text'=>new MongoRegex("/{$info[0]}/")))->limit(20)->skip($skip)
		);
	}
	function countLog($db,$text='',$date='',$user=''){
		$info=secunity(array($text,$date,$user));
		return (int)($db->log->find(array
		(
			'user'=>new MongoRegex("/{$info[2]}/"),
			'date'=>array('$gte'=>new MongoDate(strtotime($date==''?0:($date . '0:0'))),'$lte'=>new MongoDate(strtotime($date . '23:59'))),
			'text'=>new MongoRegex("/{$info[0]}/")))->count()
		);
	}
	function _exit($dbhandle,$text=''){
		$dbhandle->close();
		exit($text);
	}
?>