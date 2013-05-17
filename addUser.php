<?php include('header.php') ?>
<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<title>衛生組疏食統計系統 ｜ 增加用戶</title>
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
				<div class="page-header"><h1>新增用戶</h1></div>
				<div class="addUser content">
					<fieldset>
					<form action="control/control.php" method="post">
						
							<table>
								<tr>
									<td>姓名：</td>
									<td><input type="text" name="name" placeholder="請輸入姓名" /></td>
								</tr>
								<tr>
									<td>帳號：</td>
									<td><input type="text" name="usernm" placeholder="請輸入帳號"/></td>
								</tr>
								<tr>
									<td>密碼：</td>
									<td><input type="password" name="passwd" placeholder="請輸入密碼"/></td>
								</tr>
								<tr>
									<td>在輸入一次：</td>
									<td><input type="password" name="retry-passwd" placeholder="在輸入一次密碼"/></td>
								</tr>
								<tr>
									<td></td>
									<td><input type="submit" class="btn btn-primary" value="送出" />&nbsp <input class="btn" type="reset" value="清空" /></td>
								</tr>
								
							</table>
							<input type="hidden" name="cmd" value="adduser"/>
					</form>
					</fieldset>
				</div>
		</div>
		<?php notify(); ?>
	</body>
</html>
