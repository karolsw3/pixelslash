<?php
	include("../config.php");
	session_start();
	$_SESSION["user_logged"] = false;

	$query = $a->prepare("update users set token=null where user=?");
	$query->bind_param("s", $_SESSION["login"]);
	$query->execute();

	$_SESSION['login'] = "";
	$_SESSION["token"] = "";


	echo $lang_logout;
?>
