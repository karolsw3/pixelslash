<?php
	session_start();
	include("../config.php");
	$user = mysqli_real_escape_string($a, $_POST['user']);
	$password = mysqli_real_escape_string($a, $_POST['password']);
	$password = md5($password);

	$x = mysqli_query($a, "select * from `users` where user='$user' AND password='$password'");

	if( mysqli_num_rows($x) > 0 ){
		$_SESSION["user_logged"] = true;
		$_SESSION['login'] = $_POST['user'];
		include("logged_user_page.php");
	}else{
		echo "<p id='result'>".$lang_LoginFailed."</p>";
	}

?>