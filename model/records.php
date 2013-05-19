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
						$this->col_records->insert(array('date'=>new MongoDate(strtotime($date)),'stuid'=>$num_temp,'used'=>false,'semester'=>date('m',strtotime($date))<8?1:0));
						//1=下學期，0=下學期
					}
				}
				return '新增完成';
			}

		}
		function listRecord($_semester){
			$_semester=secunity($_semester);
			
			if($_semester==''){
				$_semester=$date['month']<8?1:0;
			}else{
				$_semester=(int)$_semester;
			}
			
			$i=0;
			
			$data=$this->col_records->distinct('stuid',array('semester'=>$_semester));
			asort($data);
			foreach($data as $stuid){
				$result[$i]=array(
					'stuid'=>$stuid,
					'name'=>'XXX',
					'total'=>$this->col_records->find(array('stuid'=>$stuid,'semester'=>$_semester))->count(),
					'used'=>$this->col_records->find(array('stuid'=>$stuid,'used'=>true,'semester'=>$_semester))->count()
				);
				$i++;
			}
			return $result;
			
		}		
		function getRecordInfo(){
		
		}
		function editRecord(){
		
		}
		function setRecordUsed($stuid,$semester,$surplus){
			if($surplus<5){
				echo '未滿五筆';
				echo $surplus;
			}else{
				$semester=(int)secunity($semester);
				$stuid=secunity($stuid);
				//修改				
				$data=$this->col_records->find(array('stuid'=>$stuid,'semester'=>$semester,'used'=>false),array('_id'=>1))->sort(array('date'=>1))->limit(5);
				//return array('stuid'=>$stuid,'semester'=>$semester,'used'=>false);
				return ($data);
			}
		}
	}
?>