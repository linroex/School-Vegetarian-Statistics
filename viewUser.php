<?php include('header.php') ?>
<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<title>衛生組疏食統計系統 ｜ 檢視用戶</title>
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
				<h1>檢視用戶</h1>
			</div>
			<div class="viewUser content">
				<?php
					include('module/oth_function.php');
					
					var_dump(post('http://' . $_SERVER['SERVER_NAME'] .  '/school/control/control.php',array('cmd'=>'viewuser')));
				?>
				<form action="" method="post">
					<table class="table table-hover">
						<tr>
							<td style="width:5%;"></td>
							<td style="width:30%;">姓名</td>
							<td style="width:30%;">帳號</td>
							<td style="width:10%;">編輯</td>
						</tr>
						<tr>
							<td><input type="checkbox" name=""/></td>
							<td>林熙哲</td>
							<td>linroex</td>
							<td><a href="editUser.php"><input type="button" value="編輯" class="btn"/></a></td>
						</tr>
						
					</table>
					<input type="submit" class="btn btn-primary" value="刪除選定帳號" />
				</form>
			</div>
		</div>
	</body>
</html>