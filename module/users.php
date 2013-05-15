<?php
	include('sql.php');
	include('oth_function.php');
	class users{
		var $col_users;
		function __construct($sqlhandle){
			$this->col_users=$sqlhandle->users;
		}
		function login($usernm,$passwd){
			$info=secunity(array($usernm,$passwd));
			$userinfo=$this->col_users->findOne(array('usernm'=>$info[0]));
			if(md5($info[1])==$userinfo['passwd']){
				return "1";
			}else{
				return '0';
			}
		}
		function getUserInfo($usernm,$passwd){
			$info=secunity(array($usernm,$passwd));
			return $this->col_users->findOne(array('usernm'=>$info[0],'passwd'=>md5($info[1])));
		}
		
	}
	
?>