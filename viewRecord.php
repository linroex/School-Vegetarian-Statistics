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
						<li><a>XXX</a></li>
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
				<form action="" method="post">
					<p style="text-align:center;"><b>以下資料為第
					<select class="span1" name="academic_year">
						<option value="99">99</option>
						<option value="100">100</option>
					</select>
					學年度
						<select class="span1" name="semester">
							<option value="上">上</option>
							<option value="下">下</option>
						</select>
					學期之記錄</b>&nbsp<input type="submit" value="Go" class="btn btn-small" /></p>
					<!--PHP 預設值會自動偵測時間並改變-->
					<!--使用Ajax-->
				</form>
				<form action="" method="post">
					<table class="table">
						<tr>
							<td class="td_select" style="width:5%;"></td>
							<td class="td_stuid" style="width:10%;">學號</td>
							<td class="td_name" style="width:10%;">姓名</td>
							<td class="td_total" style="width:10%;">總次數</td>
							<td class="td_surplus"  style="width:10%;">剩餘次數</td>
							<td class="td_detail" style="width:8%;">檢視</td>
							<td class="td_done"  style="width:8%;">使用</td>
						</tr>
						<tr >
							<td class="td_select" style="width:5%;"><input type="checkbox" name="batch_used[]"/></td>
							<td class="td_stuid" style="width:10%;">91504</td>
							<td class="td_name" style="width:10%;">林熙哲</td>
							<td class="td_total" style="width:10%;">20</td>
							<td class="td_surplus"  style="width:10%;">4</td>
							<td class="td_detail" style="width:8%;"><a href="editRecord.php"><input type="button" class="btn" value="檢視" /></a></td>
							<td class="td_done"  style="width:8%;"><input type="button" value="使用" class="btn" /></td>
						</tr>
						<tr class="success">
							<td class="td_select" style="width:5%;"><input type="checkbox" name="batch_used[]"/></td>
							<td class="td_stuid" style="width:10%;">91504</td>
							<td class="td_name" style="width:10%;">林熙哲</td>
							<td class="td_total" style="width:10%;">20</td>
							<td class="td_surplus"  style="width:10%;">4</td>
							<td class="td_detail" style="width:8%;"><a href="editRecord.php"><input type="button" class="btn" value="檢視" /></a></td>
							<td class="td_done"  style="width:8%;"><input type="button" value="使用" class="btn" /></td>
						</tr>
						<tr >
							<td class="td_select" style="width:5%;"><input type="checkbox" name="batch_used[]"/></td>
							<td class="td_stuid" style="width:10%;">91504</td>
							<td class="td_name" style="width:10%;">林熙哲</td>
							<td class="td_total" style="width:10%;">20</td>
							<td class="td_surplus"  style="width:10%;">4</td>
							<td class="td_detail" style="width:8%;"><a href="editRecord.php"><input type="button" class="btn" value="檢視" /></a></td>
							<td class="td_done"  style="width:8%;"><input type="button" value="使用" class="btn" /></td>
						</tr>
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
					</table>
					<input type="submit" value="標記選取的項目為已使用" class="btn btn-primary" />
				</form>
			</div>
		</div>
	</body>
</html>