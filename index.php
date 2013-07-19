<?php 
session_start(); 
require('config/database.php');
require('config/functions.php');
?>
<!DOCTYPE XHTML 1.1 PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="application/xhtml; charset=UTF-8" />
	<link rel="stylesheet" href="css/style.css" />
	<title>BLOG</title>
</head>
<body>
	<?php
	if(isset($_SESSION['username']) || isset($_SESSION['login'])){
		$username = $_SESSION['username'];
		$login = $_SESSION['login'];
		setUserSession($username);
	}else{
		echo "<div class='welcome'><span class='innertext'>Welcome Guest! Login below or <a href=register.php>Register</a></span></div>";
	}
	if(isset($username)){
		echo "<div class='welcome'><span class='innertext'>Welcome ".$username." (<a href=logout.php>Logout</a>)</span></div>";
		echo "<div class='info'>Please proceed to the <a href='blog.php' class='mainlink infos'>Blogs</a></div>";
	}else{
	?>
	<div id='login'>
		<form id='loginform' action='login.php' method='post' accept-charset='UTF-8' onsubmit='return valData()'>
			<h2><span class="signin"></span>Log In</h2>
			<fieldset >
			<p><label for='username' >UserName*</label></p>
			<p><input type='text' name='username' id='username'  maxlength="50" /> </p>
			<p><label for='password' >Password*</label></p>
			<p><input type='password' name='password' id='password' maxlength="50" /></p>
			<p><input type='submit' name='login' value='Submit' /></p>
			</fieldset>
		</form>
	</div>
	
	<?php	
		}
	?>
	
	<script type="text/javascript">
	function valData(){
		var em = document.getElementById("username");
		var pwd = document.getElementById("password");
		
		if(em.value.length <= 0){
			alert("Please enter a valid username");
			em.style.background = "#F5C9C9";
			return false;
		}else{
			em.style.background = "#eee";
		}
		if(pwd.value.length <= 0){
			alert("Please enter a password");
			pwd.style.background = "#F5C9C9";
			return false;
		}else{
			pwd.style.background = "#eee";
		}
	}
	</script>
	<!-- <div id="footer"><span class="cpr">Copyrighted Forever</span></div> -->
</body>
</html>