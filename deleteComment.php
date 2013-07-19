<?php
require('config/database.php');
require('config/functions.php');
if(isset($_GET['comment_id']) && isset($_GET['blog'])){
	$comment_id = $_GET['comment_id'];
	$slug = $_GET['blog'];
	if($comment_id != "" && $slug != ""){
		deleteComment($comment_id);
	}
	header('Location:blog.php?blog='.$slug);
}
?>