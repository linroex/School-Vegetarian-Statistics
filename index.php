<?php include('header.php') ?>
<?php if(isset($_SESSION['login_status']) && $_SESSION['login_status']){header("Location:addRecord.php");} //已經登入的用戶，直接導向新增記錄頁面?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<title>衛生組疏食統計系統</title>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="all" />
		<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/login.css" media="screen" />
 		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body>
	   <div class="container">
	           <div class="row">
	               <div class="form_login">
	                   <h2>LOGIN</h2>
				
	                   <form action="control/control.php" method="post">
	                   <fieldset>
	                       <input type="text" class="span4" name="usernm" id="usernm" placeholder="請輸入帳號"/>
	                       <input type="password" class="span4" name="passwd" id="passwd" placeholder="請輸入密碼" />
	                       <input type="submit" class="loginbtn span4 btn btn-large btn-block btn-primary" value="登入" />
	                       <input type="hidden" name="cmd" value="login" />
	                   </fieldset>	
	                   </form>
	               </div> <!-- .form_login -->
	           </div> <!-- .row -->
	       </div> <!-- .content -->
	   		<?php notify(); ?>
	</body>
</html>