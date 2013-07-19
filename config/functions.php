<?php
function createBlog($owner_id, $slug){
	$conn = mysql_connect(HOST, USER, PASS)or die("Mysql connection error:". mysql_error());
	$db = mysql_select_db(DB_NAME);
	$create = "INSERT INTO blogs(blogID, user_id, slug) VALUES(DEFAULT, '{$owner_id}', '{$slug}')";
	$result = mysql_query($create);
	if(!$result){
		die("Invalid query ".mysql_error());
	}
	mysql_close($conn);
	return $slug;
}

function createPost($owner_id, $blog_id, $title, $message){
	$conn = mysql_connect(HOST, USER, PASS)or die("Mysql connection error:". mysql_error());
	$db = mysql_select_db(DB_NAME);
	$create = "INSERT INTO posts(postID, blog_id, user_id, title, message, date ) VALUES(DEFAULT, '{$blog_id}', '{$owner_id}', '{$title}', '{$message}', CURRENT_TIMESTAMP)";
	$result = mysql_query($create);
	if(!$result){
		die("Invalid query ".mysql_error());
	}
	mysql_close($conn);
	return $title;
}

function getComments($post_id){
	$conn = mysql_connect(HOST, USER, PASS)or die("Mysql connection error:". mysql_error());
	$db = mysql_select_db(DB_NAME);
	
	$sql = "SELECT * FROM comments where post_id = '{$post_id}'";
	$result = mysql_query($sql);
	if(!$result){
		die("Invalid query ".mysql_error());
	}
	mysql_close($conn);
	return $result;
}

function createComment($post_id, $owner_id, $message){
	$conn = mysql_connect(HOST, USER, PASS)or die("Mysql connection error:". mysql_error());
	$db = mysql_select_db(DB_NAME);
	$create = "INSERT INTO comments(commentID, post_id, user_id, title, message, date ) VALUES(DEFAULT, '{$post_id}', '{$owner_id}', NULL, '{$message}', CURRENT_TIMESTAMP)";
	$result = mysql_query($create);
	if(!$result){
		die("Invalid query ".mysql_error());
	}
	mysql_close($conn);
}

function setUserSession($user){
	$conn = mysql_connect(HOST, USER, PASS)or die("Mysql connection error:". mysql_error());
	$db = mysql_select_db(DB_NAME);
	
	$sql = "SELECT * FROM users where username = '{$user}'";
	$result = mysql_query($sql);
	if(!$result){
		die("Invalid query ".mysql_error());
	}else{
		while($row = mysql_fetch_array($result)){
			$_SESSION["user_id"] = $row['userID'];
		}
	}
	mysql_close($conn);
}

function verifyPostPerms($blog){
	$conn = mysql_connect(HOST, USER, PASS)or die("Mysql connection error:". mysql_error());
	$db = mysql_select_db(DB_NAME);
	$case = '';
	$sql = "SELECT user_id FROM blogs where slug = '{$blog}'";
	$result = mysql_query($sql);
	if(!$result){
		die("Invalid query ".mysql_error());
	}else{
		while($row = mysql_fetch_array($result)){
			if($_SESSION["user_id"] == $row['user_id']){
				$case = 'ok';
			}else{
				$case = 'deny';
			}
		}
	}
	return $case;
	mysql_close($conn);
}

function getCommentAuthor($comment_id){
	$conn = mysql_connect(HOST, USER, PASS)or die("Mysql connection error:". mysql_error());
	$db = mysql_select_db(DB_NAME);
	$sql = "SELECT username FROM users where userID = (SELECT user_id FROM comments WHERE commentID = '{$comment_id}')";
	$result = mysql_query($sql);
	if(!$result){
		die("Invalid query ".mysql_error());
	}else{
		while($row = mysql_fetch_array($result)){
			return $row['username'];
		}
	}
	mysql_close($conn);
}

function limitBlogs($user_id){
	$conn = mysql_connect(HOST, USER, PASS)or die("Mysql connection error:". mysql_error());
	$db = mysql_select_db(DB_NAME);
	$slug = '';
	$sql = "SELECT * FROM blogs where user_id = '{$user_id}'";
	$result = mysql_query($sql);
	if(!$result){
		die("Invalid query ".mysql_error());
	}else{
		$num_rows = mysql_num_rows($result);
		while($row = mysql_fetch_array($result)){
			$slug = $row['slug'];
		}	
	}
	return $slug;
	mysql_close($conn);
}

function getBlogAuthor($blog_id){
	$conn = mysql_connect(HOST, USER, PASS)or die("Mysql connection error:". mysql_error());
	$db = mysql_select_db(DB_NAME);
	$sql = "SELECT username FROM users where userID = (SELECT user_id FROM blogs WHERE blogID = '{$blog_id}')";
	$result = mysql_query($sql);
	if(!$result){
		die("Invalid query ".mysql_error());
	}else{
		while($row = mysql_fetch_array($result)){
			return $row['username'];
		}
	}
	mysql_close($conn);
}

function getBlogPosts($blog_id){
	$conn = mysql_connect(HOST, USER, PASS)or die("Mysql connection error:". mysql_error());
	$db = mysql_select_db(DB_NAME);
	$sql = "SELECT * FROM posts where blog_id = '{$blog_id}'";
	$result = mysql_query($sql);
	if(!$result){
		die("Invalid query ".mysql_error());
	}else{
		$numrows = mysql_num_rows($result);
		return $numrows;
	}
	mysql_close($conn);
}

function isSuperadmin($user_id){
	$conn = mysql_connect(HOST, USER, PASS)or die("Mysql connection error:". mysql_error());
	$db = mysql_select_db(DB_NAME);
	$sql = "SELECT * FROM users where userID = '{$user_id}'";
	$result = mysql_query($sql);
	if(!$result){
		die("Invalid query ".mysql_error());
	}else{
		while($row = mysql_fetch_array($result)){
			return $row['superadmin'];
		}
	}
	mysql_close($conn);
}

function deletePost($post_id){
	$conn = mysql_connect(HOST, USER, PASS)or die("Mysql connection error:". mysql_error());
	$db = mysql_select_db(DB_NAME);
	$sql = "DELETE FROM posts where postID = '{$post_id}'";
	$result = mysql_query($sql);
	if(!$result){
		die("Invalid query ".mysql_error());
	}
	mysql_close($conn);
}

function deletecomment($comment_id){
	$conn = mysql_connect(HOST, USER, PASS)or die("Mysql connection error:". mysql_error());
	$db = mysql_select_db(DB_NAME);
	$sql = "DELETE FROM comments where commentID = '{$comment_id}'";
	$result = mysql_query($sql);
	if(!$result){
		die("Invalid query ".mysql_error());
	}
	mysql_close($conn);
}
?>