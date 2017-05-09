<?php
	$a = new mysqli("localhost", "root", "root", "pixelslash");
	$_GLOBALS['a'] = new mysqli("localhost", "root", "root", "pixelslash");

	if (mysqli_connect_errno() != 0){
		echo '<p>Connecting error: ' . mysqli_connect_error() . '</p>';
	}
	include("language/ENG_eng/lang.php"); // Language file
	$energy_renew_time_in_minutes = 5;
?>  