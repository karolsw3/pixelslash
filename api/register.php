<?php
	session_start();
	include("../config.php");
	$user = mysqli_real_escape_string($a, $_GET['user']);
	$password = mysqli_real_escape_string($a, $_GET['password']);

	if($password != $_GET['password_2']){
		echo '{"registered":"error_badPasswords"}';
		exit();
	}
	if(strlen($password) <= '4') {
        echo '{"registered":"error_tooShortPassword"}';
		exit();
    }

	$password = md5($password);

	$query = mysqli_query($a, "select * from users where user='$user'");
	
	if(mysqli_num_rows($query) > 0){
		echo '{"registered":"error_nameAlreadyUsed"}';
		exit();
	}else{
		mysqli_query($a,"insert into users (user,password) values ('$user','$password')");
		$_SESSION["user_logged"] = true;
		$_SESSION['login'] = $_POST['user'];
		echo '{"registered":true}';
		// foward to logged_user_page.php
	}
?>