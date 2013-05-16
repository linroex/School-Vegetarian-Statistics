<?php include('header.php') ?>
<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<title>衛生組疏食統計系統 ｜ 編輯用戶</title>
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
				<h1>編輯用戶</h1>
			</div>
			<div class="content">
				<?php
					include('module/oth_function.php');
					$data= json_decode(post('/control/control.php',array('cmd'=>'getUserData','login_status'=>$_SESSION['login_status'],'userid'=>$_GET['id'])),true);
					
				?>
				<form action="control/control.php" method="post">
					<table>
						<tr>
							<td>姓名</td>
							<td><input type="text" name="name" value="<?=$data['name']?>" /></td>
						</tr>
						<tr>
							<td>帳號：</td>
							<td><input type="text" value="<?=$data['usernm']?>" disabled="disabled" /></td>
						</tr>
						<tr>
							<td>修改密碼：</td>
							<td><input type="password" name="passwd" placeholder="請輸入密碼"/>（如果沒有要修改密碼，此欄請留空）</td>
						</tr>
						<tr>
							<td>在輸入一次：</td>
							<td><input type="password" name="retry-passwd" placeholder="請在輸入一次"/>（如果沒有要修改密碼，此欄請留空）</td>
						</tr>
						<tr>
							<td>移除帳戶：</td>
							<td ><input type="radio" name="removeUser" value="false" checked/>保留 &nbsp &nbsp <input type="radio" name="removeUser" value="true" />移除</td>
						</tr>
						<tr>
							<td></td>
							<td><br /><input type="submit" value="送出" class="btn btn-primary" />&nbsp <input type="button" value="回前頁" class="btn " /></td>
						</tr>
					</table>
					<input type="hidden" name="cmd" value="edituser" />
					<input type="hidden" name="userid" value="<?=$data['_id']['$id']?>" />
				</form>
			</div>
		</div>
	</body>
</html>