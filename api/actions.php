<?php
	session_start();
	include("../config.php");

	$percent_of_real_price_in_shop = 0.25;

	$user_login = $_SESSION['login'];
	$action = $_POST["action"];
	$item_index_in_player_eq = $_POST["item_index_in_player_eq"];
	$item_id = $_POST["item_id"];

	// All most important in-game actions such as buying, selling, wearing and unweraing items, opening chests and more

	switch ($action){
		case "buy": // !important - For first check if player has got enough money to buy the item!
			$query = mysqli_query($a,"select * from items where id='$item_id'");
			$item_id .= ";";
			mysqli_query($a, "UPDATE `p505207_db`.`users` SET `eq`=CONCAT(`eq`,'$item_id'),`silver_coins`=`silver_coins`-'$item_price' WHERE `users`.`user`='$user_login' ");
			break;
		case "sell":
			for($i=0;$i<count($player_equipment);$i++){	
				if($i == $item_index){
					$item_id = $player_equipment[$i];
					$query = mysqli_query($a,"select * from items where id='$item_id'");
					$item_info = mysqli_fetch_array($query);
					$item_price = $item_info['price']*$percent_of_real_price_in_shop; // 25% of the real price in shop
					unset($player_equipment[$i]);
					$updated_player_equipment = implode(";",$player_equipment);
				}
			}
			mysqli_query($a, "UPDATE `p505207_db`.`users` SET `eq`='$updated_player_equipment',`silver_coins`=`silver_coins`+'$item_price' WHERE `users`.`user`='$user_login' ");
			break;		
	}

?>

