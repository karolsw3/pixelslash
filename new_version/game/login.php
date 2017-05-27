<?php
	session_start();
	include("../config.php");
	$user = mysqli_real_escape_string($a, $_POST['user']);
	
	$password = mysqli_real_escape_string($a, $_POST['password']);
	$password = md5($password);
	$query = mysqli_query($a, "select * from users where user='$user' AND password='$password'");

	if( mysqli_num_rows($query) > 0 ){
		$token = substr(md5(uniqid(mt_rand(), true)) , 0, 64);
		$_SESSION["user_logged"] = true;
		$_SESSION['login'] = $_POST['user'];
		$_SESSION["token"] = $token;
		mysqli_query($a, "update users set token='$token' WHERE user='$user'");
		include("logged_user_page.php");
	}else{
		echo "<p id='result'>".$lang_LoginFailed."</p>";
	}

?>
