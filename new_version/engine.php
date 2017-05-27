<?php
	session_start();
	include("config.php");

	$command = $_GET["command"];

	if($command != ""){
		include("game/".$command);
	}

?>



