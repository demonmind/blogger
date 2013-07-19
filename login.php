<?php
session_start(); 
require('config/database.php');

if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$conn = mysql_connect(HOST, USER, PASS)or die("Mysql connection error:". mysql_error());
	$db = mysql_select_db(DB_NAME);
	$query = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'";
	$result = mysql_query($query);
	if(!$result){
		die("Invalid query ".mysql_error());
	}
	$num_rows = mysql_num_rows($result);
	if($num_rows > 0){
		$row = mysql_fetch_array($result);
		$_SESSION['username'] = $row['username'];
		$_SESSION['user_id'] = $row['userID'];
		$_SESSION['login'] = true;
		header('Location:blog.php');
	}else{
		echo("Login details wrong");
	}
	mysql_close($conn);
}
?>