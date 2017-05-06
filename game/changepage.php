<?php
	session_start();
	if($_POST['page'] != null){
		$_SESSION['page'] = $_POST['page'];
	}else{
		$_SESSION['page'] = 0;
	}
?>
<script>display('hall_of_fame.php')</script>
