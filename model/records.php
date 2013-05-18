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
			if(trim($stuid)==''){
				return '請輸入要記錄的學號';
			}else{
				foreach($num as $num_temp){
					$num_temp=secunity($num_temp);
					if(trim($num_temp)!=''){
						$this->col_records->insert(array('date'=>new MongoDate(strtotime($date)),'stuid'=>$num_temp,'used'=>false));
					}
				}
				return '新增完成';
			}

		}
		function listRecord(){
		
		}		
		function getSemester(){
			//第X學年度Y學期
			$date=array('year'=>(date('Y')-1911),'month'=>date('m'));
			
			$date['year']=($date['month']<7?$date['year']-1:$date['year']);
			$date['month']=($date['month']<8?1:0);	//0代表上學期，1代表下學期
			return $date;
		}
		function getRecordInfo(){
		
		}
		function editRecord(){
		
		}
		function setRecordUsed(){
		
		}
	}
?>