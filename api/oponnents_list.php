<?php
	session_start();
	include("../config.php");
	$min_page = $_GET['page']*10;
	$max_page = $min_page+10;
	$login = $_SESSION['login'];
	$query= mysqli_query($a,"select * from users WHERE user='$login'");
	$user_info = mysqli_fetch_array($query);
	$user_lvl = $user_info['lvl'];
	$query = mysqli_query($a, "select * from monsters WHERE lvl>'$user_lvl'-2 AND lvl<'$user_lvl'+2 ORDER BY lvl ASC LIMIT $min_page, $max_page");
	$how_much_monsters = mysqli_num_rows($query);

	$arr = [];
	for($i=0;$i<$how_much_monsters;$i++){	
		$monster_info = mysqli_fetch_array($query);
		$unencoded = array('name' => $monster_info["name"],'lvl' => $monster_info["lvl"], 'hp' => $monster_info["hp"], 'atk' => $monster_info["atk"], 'def' => $monster_info["def"],'image' => $monster_info["image"],'background' => $monster_info["background"],'reward' => $monster_info["reward"]);
		array_push($arr,$unencoded);
	}
	echo json_encode($arr);
?>



