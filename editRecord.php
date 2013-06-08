<?php include('header.php') ?>
<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<title>衛生組疏食統計系統 ｜ 編輯記錄</title>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="all" />
		<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
		<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
		
		<script type="text/javascript">
			$('.dropdown-toggle').dropdown()
		</script>
	</head>
	<body>
	
		<div class="navbar navbar-fixed-top navbar-inverse">
			<div class="navbar-inner">
				<div class="container ">
					<ul class="nav">
						<li class="brand">衛生組疏食統計系統</li>
						<li><a href="about.php">關於</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">記錄
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="addRecord.php">增加記錄</a></li>
								<li><a href="viewRecord.php">檢視記錄</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">管理
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="addUser.php">增加用戶</a></li>
								<li><a href="viewUser.php">檢視用戶</a></li>
								<li><a href="setting.php">系統設定</a></li>
							</ul>
						</li>
						
					</ul>
					<ul class="pull-right nav">
						<li><a><?=$_SESSION['user']['name']?></a></li>
						<li><a href="logout.php">登出</a></li>
					</ul>
				</div>
			</div>			
		</div>
		
		<div class="container main">
			<div class="page-header"><h1>編輯記錄</h1></div>
			<div class="editRecord content">
			<table class="table" >
				<form action="control/control.php" method="post">
					<input type="hidden" name="semester" value="<?=$_GET['semester']?>" />
					<input type="hidden" name="stuid" value="<?=$_GET['stuid']?>" />
					<input type="hidden" name="cmd" value="removeRecord"/>
					<tr>
						<td colspan="2">學號：<?=$_GET['stuid']?></td>
						
					</tr>
					<tr>
						<td colspan="2">姓名：XXX</td>
						
					</tr>
					<tr>
						<td colspan="2">詳細記錄：</td>
					</tr>
					<!--
					1.已經使用過（銷過/記功）的記錄，會用紅字標示
					2.勾選=刪除此記錄
					-->
					<?php 
						include('model/model_func.php');
						$record=json_decode(post('control/control.php',array('stuid'=>$_GET['stuid'],'semester'=>$_GET['semester'],'login_status'=>1,'cmd'=>'getRecordInfo')),1);
						
						foreach($record as $temp){
					?>
					<tr>
						 <td colspan="2" class="<?php echo $temp['used']==true?'used':''; ?>"><input type="checkbox" name="deleteRecord[]" value="<?=($temp['_id']['$id'])?>" />&nbsp<?=date('Y/m/d',$temp['date']['sec']);?>&nbsp</td>
					</tr>
					<?php } ?>
					<tr>
						<td><input type="submit" value="刪除選定記錄" class="btn btn-primary btn-block" /></td>
						<td><input type="button" value="不變動，回前頁" class="btn btn-block" onclick="window.history.go(-1);"/></td>
						
					</tr>
				</form>
			</table>
			</div>
		</div>
		<?php notify(); ?>
	</body>
</html>