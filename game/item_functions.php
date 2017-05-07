<?php
	session_start();
	include("../config.php");
	include("user_stats.php");
	$user_login = $_SESSION['login'];
	$query = mysqli_query($a, "select * from `users` where `user`='$user_login'");
	$user_data = mysqli_fetch_array($query);

	if(!$_SESSION["user_logged"]){
		echo "You are not logged in.";
		exit();
	}

	$player_weared_equipment = explode(";", $user_data["eq_weared"]); 
	$player_equipment = explode(";", $user_data["eq"]); 
	$player_lvl = $user_data["lvl"];

	$player_silver_coins = $user_data["silver_coins"];
	$item_index = $_POST["item_index"];
	$types_of_eq_acctually_weared_by_user = [];

	if($item_index != null){
		$item_id;
		if($_POST["action"] == "equip"){//equip
			for($i=0;$i<count($player_weared_equipment);$i++){	
				$query = mysqli_query($a,"select * from items where id='$player_weared_equipment[$i]'");
				$item_info = mysqli_fetch_array($query);
				$types_of_eq_acctually_weared_by_user[$i] = $item_info['type'];
			}

			for($i=0;$i<count($player_equipment);$i++){	
				if($i == $item_index){
					$item_id = $player_equipment[$i];
					$query = mysqli_query($a,"select * from items where id='$item_id'");
					$item_info = mysqli_fetch_array($query);

					for($x=0;$x<count($types_of_eq_acctually_weared_by_user);$x++){
						if($item_info['type'] == $types_of_eq_acctually_weared_by_user[$x]){ // User already have this type of item weared!
							?>
							<p style="text-align: center">You cannot wear two items of the same type</p>
							<button onclick="sound_play('click'); display('shop_gui.php');" class="game_button"><p><?php echo $lang_Back ?></p></button>
							<?php
							exit();
						}
						$types_of_eq_acctually_weared_by_user[$x] = null;
					}

					if($player_lvl<$item_info["lvl"]){
						echo "<p style='text-align: center'>This item is for ".$item_info["lvl"]."lvl players. You have got ".$player_lvl."lvl</p>";
						?>
						<button onclick="sound_play('click'); display('shop_gui.php');" class="game_button"><p><?php echo $lang_Back ?></p></button>
						<?php
						exit();
					}

					unset($player_equipment[$i]);
					$updated_player_equipment = implode(";",$player_equipment);
				}
			}
			$item_id .= ";";

			mysqli_query($a, "UPDATE `p505207_db`.`users` SET `eq`='$updated_player_equipment' WHERE `users`.`user`='$user_login' ");
			mysqli_query($a, "UPDATE `p505207_db`.`users` SET `eq_weared`=CONCAT(`eq_weared`,'$item_id') WHERE `users`.`user`='$user_login' ");
			echo "<script>display('equipment.php')</script>";
		}

		else if($_POST["action"] == "unequip"){//unequip
			for($i=0;$i<count($player_weared_equipment);$i++){	
				if($i == $item_index){
					$item_id = $player_weared_equipment[$i];
					unset($player_weared_equipment[$i]);
					$updated_player_weared_equipment = implode(";",$player_weared_equipment);
				}
			}
			$item_id .= ";";
			mysqli_query($a, "UPDATE `p505207_db`.`users` SET `eq_weared`='$updated_player_weared_equipment' WHERE `users`.`user`='$user_login' ");
			mysqli_query($a, "UPDATE `p505207_db`.`users` SET `eq`=CONCAT(`eq`,'$item_id') WHERE `users`.`user`='$user_login' ");
			echo "<script>display('equipment.php')</script>";
		}

		else if($_POST["action"] == "buy"){//buy
			$item_id = $item_index;
			$query = mysqli_query($a,"select * from items where id='$item_id'");
			$item_info = mysqli_fetch_array($query);
			$item_price = $item_info['price'];

			if($player_silver_coins<$item_price){
				echo "<p style='text-align: center'>You don't have enough money</p>";
			}else{
				$item_id .= ";";
				mysqli_query($a, "UPDATE `p505207_db`.`users` SET `eq`=CONCAT(`eq`,'$item_id'),`silver_coins`=`silver_coins`-'$item_price' WHERE `users`.`user`='$user_login' ");
				echo "<p style='text-align: center'>Item bought succesfully</p>";
			}
			?>
			<button onclick="sound_play('click'); display('shop_gui.php');" class="game_button"><p><?php echo $lang_Back ?></p></button>
			<?php
		}

		else if($_POST["action"] == "sell"){//sell
			for($i=0;$i<count($player_equipment);$i++){	
				if($i == $item_index){
					$item_id = $player_equipment[$i];
					$query = mysqli_query($a,"select * from items where id='$item_id'");
					$item_info = mysqli_fetch_array($query);
					$item_price = $item_info['price']/4; // 25% of the real price in shop
					unset($player_equipment[$i]);
					$updated_player_equipment = implode(";",$player_equipment);
				}
			}
			mysqli_query($a, "UPDATE `p505207_db`.`users` SET `eq`='$updated_player_equipment',`silver_coins`=`silver_coins`+'$item_price' WHERE `users`.`user`='$user_login' ");
			echo "Item sold succesfully";
			?>
			<button onclick="sound_play('click'); display('equipment.php');" class="game_button"><p><?php echo $lang_Back ?></p></button>
			<?php
		}

	}
	

?>

