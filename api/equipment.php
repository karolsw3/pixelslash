<?php
	session_start();
	include("../config.php");
	$user_login = $_SESSION['login'];
	$query = mysqli_query($a, "select * from `users` where `user`='$user_login'");
	$user_data = mysqli_fetch_array($query);
	$player_equipment = explode(";", $user_data["eq"]); 

	$arr = [];

	for($i=0;$i<count($player_equipment);$i++){	
		if($player_equipment[$i] > 0){
			$item_id = $player_equipment[$i];
			$query = mysqli_query($a, "select * from `items` where `id`='$item_id'");
			$item_info = mysqli_fetch_array($query);
			$push = "{id:".$item_info['id'].",name:.".$item_info['name'].",type:".$item_info['type'].",stats:{rarity:.".$item_info['rarity'].",atk:".$item_info['atk'].",def:".$item_info['def'].",hp:".$item_info['hp'].",price:".$item_info['price']."}}";
			array_push($arr,$push);
		}
	}

	return json_encode($arr);
	print_r($arr);
?>
