<?php
	session_start();
	include("../config.php");
	$user_login = $_SESSION['user'];
	$query = mysqli_query($a, "select * from `users` where `user`='$user_login'");
	$user_data = mysqli_fetch_array($query);
	$player_equipment = explode(";", $user_data["eq"]); 

	for($i=0;$i<count($player_equipment);$i++){	
		if($player_equipment[$i] > 0){
			$item_id = $player_equipment[$i];
			$query = mysqli_query($a, "select * from `items` where `id`='$item_id'");
			$item_info = mysqli_fetch_array($query);
			$unencoded = array('id' => $item_info["id"], 'name' => $item_info["name"], 'type' => $item_info["type"], 'stats' => array('rarity' => $item_info["rarity"],'atk' => $item_info["atk"],'def' => $item_info["def"],'hp' => $item_info["hp"],'price' => $item_info["price"]));
			$arr .= json_encode($unencoded);
			if($i<count($player_equipment)-2){
				$arr .= ",";
			}
		}
	}
	echo "[".$arr."]";
	//return json_encode($arr);
?>
