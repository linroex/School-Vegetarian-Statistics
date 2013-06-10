<?php include('header.php') ?>
<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<title>衛生組疏食統計系統 ｜ 系統設定</title>
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
				<h1>系統設定</h1>
			</div>
			<div class="setting content">
				<h3>系統設定</h3>
				<h3>系統記錄</h3>
				
				<?php
					include('model/model_func.php');
					$count=post('control/control.php',array('cmd'=>'countLog','login_status'=>1,'date'=>$_GET['date'],'page'=>$_GET['page'],'text'=>$_GET['text'],'user'=>$_GET['user']));
					$pagenum=ceil($count/20);
					$data=json_decode(post('control/control.php',array('cmd'=>'searchLog','login_status'=>1,'date'=>$_GET['date'],'page'=>$_GET['page'],'text'=>$_GET['text'],'user'=>$_GET['user'])),1);
					
				?>
				<div class="pagination pagination-centered">
					<ul>
						<?php for($i=1;$i<=$pagenum;$i++){ ?>
							<li><a href="<?=(empty($_GET) || $_GET['page']!=''?'?page=':'&page=') . $i?>"><?=$i?></a></li>
						<? } ?>
					</ul>
				</div>
				<table class="table">
					<tr>
						<td>用戶</td>
						<td>時間</td>
						<td>來源</td>
						<td>內容</td>
					</tr>
					<?php foreach($data as $data_row){ ?>
					<tr>
						<td><?=$data_row['user']?></td>
						<td><?=date('Y/m/d',$data_row['date']['sec'])?></td>
						<td><?=$data_row['ip']?></td>
						<td><?=$data_row['text']?></td>
					</tr>
					<?php } ?>
				</table>
				
			</div>
		</div>
		<?php notify(); ?>
	</body>
</html>