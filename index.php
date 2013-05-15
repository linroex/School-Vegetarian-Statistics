<?php include('header.php') ?>
<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<title>衛生組疏食統計系統</title>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="all" />
		<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="row">
		<div class="container ">
			<div class="form_login ">
				<h2>LOGIN</h2>
				<fieldset>
				<form action="control/control.php" method="post">
					
					<input type="text" class="span4" name="usernm" id="usernm" placeholder="請輸入帳號"/><br />
					<input type="password" class="span4" name="passwd" id="passwd" placeholder="請輸入密碼" /><br />
					<?php
						if(isset($_SESSION['message'])){
							echo '<div class="error">' , $_SESSION['message'] ,'</div><br />';
							unset($_SESSION['message']);
						}
					?>
					<input type="submit" class="loginbtn span4 btn btn-large btn-block btn-primary" value="登入" />
					<input type="hidden" name="cmd" value="login" />
					
				</form>
			</fieldset>
			</div>
			
		</div>
		</div>
	</body>
</html>