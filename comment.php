<?php 
session_start();
require 'config/database.php';
require 'config/functions.php';

if(!isset($_SESSION['login'])){
	header('Location:index.php');
}
if(isset($_POST['comment'])){
	if($_POST['message'] == ""){
		echo("Please go back and fill in all the required fields");
	}else{
		$name = $_POST['blogname'];
		createComment($_POST['post_id'],$_POST['user_id'],$_POST['message']);		
		echo('<div class="cSuccess">Comment Successfully Created.<a href="blog.php?blog='.$name.'">View</a> your blog</div>');
		die();
	}
}
?>
<!DOCTYPE XHTML 1.1 PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="application/xhtml; charset=UTF-8" />
	<link rel="stylesheet" href="css/style.css" />
<title>Blog - Comment</title>
</head>
<body>
	<?php
		$username = $_SESSION['username'];
		echo("<div class='welcome'><span class='innertext'><a href='blog.php?blog=".$_GET['blog']."' class='mainlink'> < Back </a>Welcome ".$username." <a href=logout.php> Logout </a></span></div>");
	?>
	<div id='login'>
		<form id='login' action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post' accept-charset='UTF-8'>
			<h2><span class="signin"></span>Write a Comment</h2>
			<fieldset >
	
			<input type='hidden' name='user_id' id='user_id' value="<?php echo($_SESSION['user_id']); ?>"/>
			<input type='hidden' name='post_id' id='postid' value="<?php echo($_GET['postid']); ?>"/>
			<input type='hidden' name='blogname' id='blogname' value="<?php echo($_GET['blog']); ?>"/>
 
			<label for='message' >Message*:</label><br />
			<textarea name='message' id='message'></textarea>
	
 
			<input type='submit' name='comment' value='Comment' />
 
			</fieldset>
		</form>
</body>
</html>