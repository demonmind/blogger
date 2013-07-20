<?php
require('config/database.php');
require('config/functions.php');
if(isset($_GET['blog_id'])){
	$blog_id = $_GET['blog_id'];
	if($blog_id != ""){
		deleteblog($blog_id);
	}
	header('Location:blog.php');
}
?>