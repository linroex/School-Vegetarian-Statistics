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
		function addUser($name,$usernm,$passwd,$retrypw){
			$info=secunity(array($name,$usernm,$passwd,$retrypw));
			if($info[2]==$info[3]){
				if($this->col_users->count(array('usernm'=>$info[1]))==0){
					try{
						return $this->col_users->insert(array('name'=>$info[0],'usernm'=>$info[1],'passwd'=>md5($info[2])));
					}catch(Exception $e){
						return $e->getMessage();
					}
				}else{
					return '此帳號已有人使用過';
				}
			}else{
				return "兩次密碼輸入不相同";
			}
		}
		function viewUser(){
			return iterator_to_array($this->col_users->find());
		}
	}
	
?>