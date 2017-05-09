<?php
	$a = new mysqli("localhost", "root", "root", "pixelslash");
	$_GLOBALS['a'] = new mysqli("localhost", "root", "root", "pixelslash");

	// /* check connection */
	// if (mysqli_connect_errno()) {
	// 	printf("Connect failed: %s\n", mysqli_connect_error());
	// 	exit();
	// }

	// /* check if server is alive */
	// if (mysqli_ping($a)) {
	// 	printf ("Our connection is ok!\n");
	// } else {
	// 	printf ("Error: %s\n", mysqli_error($a));
	// }

	if (mysqli_connect_errno() != 0){
		echo '<p>Connecting error: ' . mysqli_connect_error() . '</p>';
	}
	include("language/ENG_eng/lang.php"); // Language file
	$energy_renew_time_in_minutes = 5;
?>  