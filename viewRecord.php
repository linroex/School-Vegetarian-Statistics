<?php include('header.php') ?>
<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<title>衛生組疏食統計系統 ｜ 檢視記錄</title>
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
			<div class="page-header">
				<h1>檢視記錄</h1>
			</div>
			<div class="viewRecord content">
				
				<form action="" method="get">
					<p style="text-align:center;"><b>以下資料為第
					<?=date('m')<7?date('Y')-1912:date('Y')-1911;?>
					學年度
						<select class="span1" name="semester">
							<?php
								if(isset($_GET['semester'])){
									$semester=$_GET['semester'];
								}else{
									$semester=date('m')<8?1:0;
								}
								
							?>
							
							<option value="0" <?=$semester==0?'selected':'';?>>上</option>
							<option value="1" <?=$semester==1?'selected':'';?>>下</option>
						</select>
					學期之記錄</b>&nbsp<input type="submit" value="Go" class="btn btn-small" /></p>
					
					
				</form>

				<form action="control/control.php" method="post">
					<?php
						if(isset($_GET['semester']) and $_GET['semester']!=''){
							$semester=$_GET['semester'];
							
						}else{
							$semester=date('m')<8?1:0;
						}
					?>
					<input type="hidden" name="cmd" value="setused" />
					<input type="hidden" name="semester" value="<?=$semester;?>" />
					<table class="table">
						<tr>
							<td style="width:5%;"></td>
							<td style="width:10%;">學號</td>
							<td style="width:10%;">姓名</td>
							<td style="width:10%;">總次數</td>
							<td style="width:10%;">剩餘次數</td>
							<td style="width:8%;">檢視</td>
						</tr>
						<?php
							include('model/model_func.php');
							
							$recordsData=json_decode(post('/control/control.php',array('cmd'=>'viewrecord','semester'=>$_GET['semester'],'login_status'=>$_SESSION['login_status'])),true);
							
							if(!empty($recordsData)){
								foreach($recordsData as $recordtemp){
								$surplus=$recordtemp['total']-$recordtemp['used'];
								
						?>
						
						
						<tr class="<?=($recordtemp['total']-$recordtemp['used'])>=5?'success':'';?>">
							<td style="width:5%;"><input type="checkbox" name="batch_used[]" value="<?="{$recordtemp['stuid']},{$surplus}"?>" /></td>
							<td style="width:10%;"><?=$recordtemp['stuid']?></td>
							<td style="width:10%;">XXX</td>
							<td style="width:10%;"><?=$recordtemp['total']?></td>
							<td style="width:10%;"><?=$surplus?></td>
							<td style="width:8%;"><a href="editRecord.php/?stuid=<?=$recordtemp['stuid']?>"><input type="button" class="btn" value="檢視" /></a></td>
							
							
						</tr>
						<?php }}?>
						<!--
						多選（批次完成「使用」動作）
						學號
						姓名
						總次數
						剩餘次數（總次數-已使用次數）
						檢視（檢視詳細吃疏食的日期）
						使用（按下去「已使用次數」會增加5，並且標示最過去的五次記錄為used）
						-->
						<!--滿五次會使用.success標示-->
						<!--加入分頁功能-->
					</table>
					<input type="submit" value="標記選取的項目為已使用" class="btn btn-primary" />
				</form>
			</div>
		</div>
		<?php notify(); ?>
	</body>
</html>