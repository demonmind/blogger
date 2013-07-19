<?php 
session_start(); 
require('config/database.php');
echo($host);
$username = $_POST["username"];
$password = $_POST["password"];
$email = $_POST["email"];

// Check if user inputed special char for dangerous behavior.
$username = htmlspecialchars($username);
$password = md5(htmlspecialchars($password));
$email = htmlspecialchars($email);

//Check do we have username and password
if(isset($_POST['submit'])){
	if($username == "" || $password == "" || $email == ""){
		echo("Please go back and fill in all the required fields");
	}else{
		$conn = mysql_connect(HOST,USER,PASS) or die("MYSQL error:".mysql_error());
		$db = mysql_select_db(DB_NAME);
		if (!$db){
			echo("Failed to connect to MySQL database.");
		}else{
			$checkquery = "SELECT * FROM users WHERE username = '{$username}'";
			$results = mysql_query($checkquery);
			$num_rows = mysql_num_rows($results);
			if($num_rows > 0){
			  echo("Username Already Taken");
			  die();
			}else{
			  $sqlquery = "INSERT INTO users(userID, username, password, email) VALUES(DEFAULT, '{$username}', '{$password}', '{$email}')";
			  $result = mysql_query($sqlquery);
			  if(!$result){
				  die("Invalid query ".mysql_error());
			  }
			}
		}
		mysql_close($conn);
		$_SESSION['username'] = $username;
		$_SESSION['login'] = true;
		header('Location: index.php');
	}
}
?>
<!DOCTYPE XHTML 1.1 PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="application/xhtml; charset=UTF-8" />
	<link rel="stylesheet" href="css/style.css" />
<title>Blog - Register</title>
</head>
<body>
	<?php
		echo "<div class='welcome'><span class='innertext'><a href='index.php' class='mainlink'> < Back </a> Welcome Guest! Register below.</span></div>";
	?>
	<div id='register'>
		<form id='registerform' action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post' accept-charset='UTF-8' onsubmit="return valData()">
			<h2><span class="signin"></span>Register</h2>
			<fieldset >
			<p><label for='username' >UserName*</label></p>
			<p><input type='text' name='username' id='username'  maxlength="50" /></p>
			<p><label for='password' >Password*</label></p>
			<p><input type='password' name='password' id='password' maxlength="50" /></p>
			<p><label for='username' >Email*</label></p>
			<p><input type='text' name='email' id='email'  maxlength="50" /></p>
			<p><input type='submit' name='submit' value='Submit' /></p>
			</fieldset>
		</form>
	</div>
	
	<script type="text/javascript">
	function valData(){
		var em = document.getElementById("username");
		var pwd = document.getElementById("password");
		var ema = document.getElementById("email");
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
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		if(ema.value.length <= 0 || !em.value.match(mailformat)){
			alert("Please enter valid email");
			ema.style.background = "#F5C9C9";
			return false;
		}else{
			ema.style.background = "#eee";
		}
	}
	</script>
	<div id="footer"><span class="cpr">Copyrighted Forever</span></div>
</body>
</html>