<?php
	include("../config.php");
	session_start();
	$_SESSION["user_logged"] = false;
	$_SESSION['login'] = "";
	echo $lang_logout;
?>