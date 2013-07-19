<?php
require('config/database.php');
require('config/functions.php');
if(isset($_GET['postid']) && isset($_GET['blog'])){
	$post_id = $_GET['postid'];
	$slug = $_GET['blog'];
	if($post_id != "" && $slug != ""){
		deletePost($post_id);
	}
	header('Location:blog.php?blog='.$slug);
}
?>