<?php
session_start(); 
require('config/database.php');
require('config/functions.php');
$username = $_SESSION['username'];
$login = $_SESSION['login'];
setUserSession($username);
//Check do we have username and password
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
if(!$username && !$login){
	header('Location:index.php');
}else{
	echo("<div class='welcome'><span class='innertext'>Welcome ".$username." <a href=logout.php> Logout </a></span>");
	if(!isset($_GET['blog']) || $_GET['blog'] == ""){
		if(limitBlogs($_SESSION['user_id']) == ""){
			echo("<span class='innertext'><a  href='create.php' class='createblog'> Create a Blog </a></span>");
		}else{
			$slug = limitBlogs($_SESSION['user_id']);
			echo("<span class='innertext'><a  href='blog.php?blog=".$slug."' class='viewblog'> View Your Blog </a></span>");
		}
	}
	echo("</div>");
	echo("<div id='maincontainer'>");
	$conn = mysql_connect(HOST, USER, PASS)or die("Mysql connection error:". mysql_error());
	$db = mysql_select_db(DB_NAME);
	if(!isset($_GET['blog']) || $_GET['blog'] == ""){
		$getblogs = "SELECT * FROM blogs";
		$results = mysql_query($getblogs);
		if(!$results){
			die("Invalid query ".mysql_error());
		}else{
			$num_rows = mysql_num_rows($results);
			if($num_rows > 0){
				while($blogarray = mysql_fetch_array($results)){
					echo("<div class='blogentry'>");
					echo("Title: <a href='blog.php?blog=".$blogarray['slug']."'>".$blogarray['slug']."</a>");
					echo("<div class='author'> Author: ".getBlogAuthor($blogarray['blogID'])."</div>");
					echo("<div class='author'> Posts: ".getBlogPosts($blogarray['blogID'])."</div>");
					echo("</div>");
				}
			}else{
				echo('<div class="noblogs">No Blogs Yet</div>');
			}
		}
	}else{
		echo("<a href='blog.php' class='mainlink'> < Back </a>");
		$slug = $_GET['blog'];
		$getblog = "SELECT * FROM blogs WHERE slug = '{$slug}'";
		$results = mysql_query($getblog);
		if(!$results){
			die("Invalid query ".mysql_error());
		}else{
			$num_rows = mysql_num_rows($results);
			if($num_rows > 0){
				$blogarray = mysql_fetch_array($results);
				$id = $blogarray['user_id'];
				$bid = $blogarray['blogID'];
				$bname = $blogarray['slug'];
				$posts = "SELECT * FROM posts WHERE blog_id = '{$bid}'";
				$getposts = mysql_query($posts);
				if(!$getposts){
					die("Invalid query ".mysql_error());
				}else{
					$num_rows = mysql_num_rows($getposts);
					if($num_rows > 0){
						echo("<div class='container'>");
						while($data = mysql_fetch_array($getposts)){
							$auth = mysql_query("SELECT username FROM users WHERE userID = '{$id}'");
							$author = mysql_fetch_array($auth);
							echo('<div class="infopost">');
								echo('<div class="author">'.$author['username'].'</div>');
								echo('<div class="title">'.$data['title'].'</div>');
								echo('<div class="date">'.$data['date'].'</div>');
								echo('<div class="message">'.$data['message'].'</div>');
								echo("<div class='createcomment'><a href='comment.php?postid=".$data['postID']."&user_id=".$_SESSION['user_id']."&blog=".$slug."'>Write a Comment</a></div>");
								echo('<div class="comments">');
									$comments = getComments($data['postID']);
									while($comm = mysql_fetch_array($comments)){
										echo('<div class="comment">');
											echo('<div class="commentMessage">'.$comm['message'].'</div>');
											echo('<div class="commentAuthor">'.getCommentAuthor($comm['commentID']).'</div>');
											echo('<div class="commentDate">'.$comm['date'].'</div>');
										echo('</div>');
									}
								echo('</div');
							echo('</div>');
						}
						echo('</div>');
						if(verifyPostPerms($slug) == 'ok'){
							echo("<div class='createpost'><a href='post.php?bid=".$bid."&bname=".$bname."'>Post to Blog</a></div>");
						}
					}else{
						echo('<div class="noposts">No Posts</div>');
						if(verifyPostPerms($slug) == 'ok'){
							echo("<div class='createpost'><a href='post.php?bid=".$bid."&bname=".$bname."'>Post to Blog</a></div>");
						}
					}
				}
			}else{
				echo('<div class="blognotFound">Blog Not Found</div>');
			}
		}
	}
	echo("</div>");
	echo("</div>");
	echo("</div>");
	mysql_close($conn);
}
?>
<div id="footer"><span class="cpr">Copyrighted Forever</span></div>
</body>
</html>