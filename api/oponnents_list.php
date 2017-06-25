<?php
	session_start();
	include("../config.php");
	$login = $_SESSION['login'];
	$query= mysqli_query($a,"select * from users WHERE user='$login'");
	$user_info = mysqli_fetch_array($query);
	$user_lvl = $user_info['lvl'];

	$query = mysqli_query($a, "select * from monsters WHERE lvl>'$user_lvl'-2 AND lvl<'$user_lvl'+2 ORDER BY lvl ASC");
	$how_much_monsters = mysqli_num_rows($query);

	for($i=0;$i<$how_much_monsters;$i++){	
		$monster_info = mysqli_fetch_array($query);
		$unencoded = array('name' => $monster_info["name"],'lvl' => $monster_info["lvl"], 'hp' => $monster_info["hp"], 'atk' => $monster_info["atk"], 'def' => $monster_info["def"],'image' => $monster_info["image"],'background' => $monster_info["background"],'reward' => $monster_info["reward"]);
		$arr .= json_encode($unencoded);
		if($i<$how_much_monsters-1){
			$arr .= ",";
		}
	}
	echo json_encode($arr);
?>



