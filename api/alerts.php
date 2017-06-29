<?php
	session_start();
	include("../config.php");
	$action = $_POST["action"];
	$item_name = $_POST["item_name"];
	$user = $_SESSION['user'];

	$alert = "";

	$query = mysqli_query($a, "select * from items where name='$item_name'");
	$item_info = mysqli_fetch_array($query);

	$query = mysqli_query($a, "select * from users where user='$user'");
	$user_info = mysqli_fetch_array($query);

	$item_price = $item_info["price"];
	$user_silver_coins = $user_info['silver_coins'];
	$user_energy = $user_info['energy'];

	switch($action){
		case "buy":
			// Check if user has got enough money to buy the item
			if($user_silver_coins<$item_price){
				$alert = "You don't have enough money to buy this item.";
			}
			break;
		case "attack":
			//Check if user can start a fight
			if($user_energy<1){
				$alert = "You don't have enough energy to attack.";
			}
	}

	echo json_encode(array('alert' => $alert));
?>



