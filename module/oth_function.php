<?php
	function secunity($var){
		$result[]=array();
		$i=0;
		foreach($var as $var_temp){
			if(!get_magic_quotes_gpc){
				$var_temp=addslashes($var_temp);
			}
			$result[$i]=trim($var_temp);
			$i++;
		}
		return $result;
	}
	
?>