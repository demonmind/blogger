<?php
session_start();
require 'config/database.php';
require 'config/functions.php';

if(!isset($_SESSION['login'])){
	header('Location:index.php');
}
if(isset($_POST['create'])){
	if($_POST['blogname'] == ""){
		echo("Please go back and fill in all the required fields");
	}else{
		$name = createBlog($_POST['user_id'],$_POST['blogname']);		
		echo('<div class="cSuccess">Blog Created.<a href="blog.php?blog='.$name.'">View</a> your blog</div>');
		die();
	}
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
	<form id='createblogform' action='create.php' method='post' accept-charset='UTF-8'>
		<fieldset >
		<legend>Create Blog</legend>
		<input type='hidden' name='user_id' id='userid' value="<?php echo($_SESSION['user_id']); ?>"/>
		<label for='username' >Blog Name*:</label>
		<input type='text' name='blogname' id='blogname'  maxlength="50" /> 
		<input type='submit' name='create' value='Create' />
		</fieldset>
	</form>	
</body>
</html>