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
				<form action="model/editRecord.php" method="post">
					<tr>
						<td>學號：</td>
						<td></td>
					</tr>
					<tr>
						<td>姓名：</td>
						<td></td>
					</tr>
					<tr>
						<td colspan="2">詳細記錄：</td>
					</tr>
					<!--
					1.已經使用過（銷過/記功）的記錄，會用紅字標示
					2.勾選=刪除此記錄
					-->
					<tr>
						<td colspan="2" class="used"><input type="checkbox" name="deleteRecord[]" value="20120101" /> &nbsp 2012/01/01</td>
					</tr>
					<tr>
						<td colspan="2"><input type="checkbox" name="deleteRecord[]" value="20120201" /> &nbsp 2012/02/01</td>
					</tr>
					<tr>
						<td colspan="2"><input type="checkbox" name="deleteRecord[]" value="20120301" /> &nbsp 2012/03/01</td>
					</tr>
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