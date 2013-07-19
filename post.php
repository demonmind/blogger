<?php 
session_start();
require 'config/database.php';
require 'config/functions.php';

if(!isset($_SESSION['login'])){
	header('Location:index.php');
}
if(isset($_POST['post'])){
	if($_POST['title'] == "" || $_POST['message'] == ""){
		echo("Please go back and fill in all the required fields");
	}else{
		$name = $_POST['blog_name'];
		$postname = createPost($_POST['user_id'],$_POST['blog_id'],$_POST['title'],$_POST['message']);		
		echo('<div class="cSuccess">Post Created:'.$postname.'.<a href="blog.php?blog='.$name.'">View</a> your blog</div>');
		die();
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
	<form id='login' action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post' accept-charset='UTF-8'>
	<fieldset >
	<legend>Register</legend>
	<input type='hidden' name='user_id' id='user_id' value="<?php echo($_SESSION['user_id']); ?>"/>
	<input type='hidden' name='blog_id' id='blogid' value="<?php echo($_GET['bid']); ?>"/>
	<input type='hidden' name='blog_name' id='blogname' value="<?php echo($_GET['bname']); ?>"/>
	<label for='title' >Title*:</label>
	<input type='text' name='title' id='title'  maxlength="50" />
 
	<label for='message' >Message*:</label>
	<textarea rows="5" cols="10" name='message' id='message'></textarea>
	
 
	<input type='submit' name='post' value='Post' />
 
	</fieldset>
	</form>
</body>
</html>