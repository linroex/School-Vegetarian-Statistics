<?php
	
	include('sql.php');
	include('model_func.php');
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
		function getUserInfoByAuth($usernm,$passwd){
			$info=secunity(array($usernm,$passwd));
			return $this->col_users->findOne(array('usernm'=>$info[0],'passwd'=>md5($info[1])));
		}
		function getUserInfoById($userid){
			
			return $this->col_users->findOne(array('_id'=>new MongoId($userid)));
			
		}
		function addUser($name,$usernm,$passwd,$retrypw){
			$info=secunity(array($name,$usernm,$passwd,$retrypw));
			if($info[2]==$info[3]){
				if($this->col_users->count(array('usernm'=>$info[1]))==0){
					try{
						$this->col_users->insert(array('name'=>$info[0],'usernm'=>$info[1],'passwd'=>md5($info[2])));
						return '建立新用戶成功';
					}catch(Exception $e){
						return $e->getMessage();
					}
				}else{
					return '此帳號已有人使用過';
				}
			}else{
				return '兩次密碼輸入不相同';
			}
		}
		function viewUser(){
			return iterator_to_array($this->col_users->find());
		}
		function updateUser($userid,$name,$new_passwd='',$new_passwd_retry='',$remove=false){
			$info=secunity(array($userid,$name,$new_passwd,$new_passwd_retry));
			
			if($remove=='true'){
				$response=$this->col_users->remove(array('_id'=>new MongoId($info[0])));
				return '已移除';
			}
			if($info[2]==$info[3]){
				if($info[2]!=''){
					$this->col_users->update(array('_id'=>new MongoId($info[0])),array('$set'=>array('name'=>$info[1],'passwd'=>md5($info[2]))));
				}elseif($info[2]==''){
					$this->col_users->update(array('_id'=>new MongoId($info[0])),array('$set'=>array('name'=>$info[1])));
				}
				return '已修改';
			}elseif($info[2]!=$info[3]){
				return '兩次密碼輸入不相同';
			}
		}
		function batchDelUser($userid){
			$info=secunity($userid);
			if(is_array($info)){
				foreach($info as $uid){
					$this->col_users->remove(array('_id'=>new MongoId($uid)));
				}
			}else{
					$this->col_users->remove(array('_id'=>new MongoId($info)));
			}
			return '指定的用戶已移除';
		}
	}
	
?>