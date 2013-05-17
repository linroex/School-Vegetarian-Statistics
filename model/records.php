<?php
	include('sql.php');
	include_once('model_func.php');
	class records{
		var $col_records;
		function __construct($sqlhandle){
			$this->col_records=$sqlhandle->records;
		}
		function addRecord($date,$stuid){
			//注意user_num只有一筆的情況
			$date=secunity($date);
			$num=explode(',',$stuid);
			if($date==''){
				$date=date('Y/m/d');
			}
			foreach($num as $num_temp){
				$this->col_records->insert(array('date'=>new MongoDate(strtotime($date)),'stuid'=>$num_temp,'used'=>false));
			}
			return '新增完成';
		}
		function listRecord(){
		
		}
		
		
		function getSemester(){
			//第X學年度Y學期
		}
		function getRecordInfo(){
		
		}
		function editRecord(){
		
		}
		function setRecordUsed(){
		
		}
	}
?>