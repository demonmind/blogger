<?php
session_start();
require 'config/database.php';
require 'config/functions.php';

if(!isset($_SESSION['login'])){
	header('Location:index.php');
}
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
	$username = $_SESSION['username'];
	$login = $_SESSION['login'];
	if(!$username && !$login){
		header('Location:index.php');
	}
	if(isset($username)){
		echo "<div class='welcome'><span class='innertext'><a href='blog.php' class='mainlink'> < Back </a>Welcome ".$username." (<a href=logout.php>Logout</a>)</span></div>";
	}
	if(isset($_POST['create'])){
		if($_POST['blogname'] == ""){
			echo("<div id='error'>Please go back and fill in all the required fields</div>");
		}else{
			$name = createBlog($_POST['user_id'],ltrim($_POST['blogname']));		
			echo('<div class="cSuccess">Blog Created.<a href="blog.php?blog='.$name.'">View</a> your blog</div>');
		}
	}else{
	?>
	<div id='login'>
	<form id='createblogform' action='create.php' method='post' accept-charset='UTF-8'>
		<h2><span class="signin"></span>Create Blog</h2>
		<fieldset >
		<p><input type='hidden' name='user_id' id='userid' value="<?php echo($_SESSION['user_id']); ?>"/></p>
		<p><label for='username' >Blog Name*:</label></p>
		<p><input type='text' name='blogname' id='blogname'  maxlength="50" /> </p>
		<p><input type='submit' name='create' value='Create' /></p>
		</fieldset>
	</form>	
	</div>
	<?php
	}
	?>
</body>
</html>