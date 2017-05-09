<?php
	session_start();
	include("../config.php");
	$user = mysqli_real_escape_string($a, $_POST['user']);
	$password = mysqli_real_escape_string($a, $_POST['password']);

	if($password != $_POST['password_repeat']){
		echo "Passwords are not maching.";
		exit();
	}
	if(strlen($password) <= '4') {
        echo "Your Password Must Contain At Least 5 Characters!";
		exit();
    }

	$password = md5($password);

	$query = mysqli_query($a, "select * from users where user='$user'");
	
	if(mysqli_num_rows($query) > 0){
		echo "There's already an user with that name.";
		exit();
	}else{
		mysqli_query($a,"insert into users (user,password) values ('$user','$password')");
		$_SESSION["user_logged"] = true;
		$_SESSION['login'] = $_POST['user'];
		include("logged_user_page.php");
	}
?>