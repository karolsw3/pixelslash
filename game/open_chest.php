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

	$player_chests = explode(";", $user_data["chests"]); 
	$player_lvl = $user_data["lvl"];

	$chest_index = $_POST["item_index"];

	if($chest_index != null){

		$chest_id = $player_chests[$chest_index];
		$query = mysqli_query($a,"select * from chests where id='$chest_id'");
		$chest_info = mysqli_fetch_array($query);
		$items_to_win = explode(";", $chest_info["items_to_win"]);

		$random_item = rand(0,count($items_to_win)-1);
		$item_won = $items_to_win[$random_item]; // Absolutely magnificient lottery algorithm.
		$item_won .= ";";

		unset($player_chests[$chest_index]);
		$updated_player_chests = implode(";",$player_chests);
		mysqli_query($a, "UPDATE `p505207_db`.`users` SET `eq`=CONCAT(`eq`,'$item_won'),`chests`='$updated_player_chests' WHERE `users`.`user`='$user_login' ");

		$query = mysqli_query($a, "select * from items where id='$item_won'");
		$item_info = mysqli_fetch_array($query);
		?>
		<p style="text-align: center; font-size: 34px">YOU WON:</p>
		<div class="arena_cell">
			<div style="position: relative; top: 0; left: 0;">
				<div style="position: relative; top: 0; left: 0;"><img src="<?php echo 'images/'.$item_info['rarity'].'.png' ?>" height="70"></div>
				<div style="position: absolute; top: 0; left: 0;"><img src="<?php echo 'images/items/'.$item_info['image'] ?>" height="70"></div>
			</div>
			<p style="margin: auto; color: <?php echo $item_color ?>"><?php echo $item_info['lvl']."lvl ".$item_info['name'] ?></p>
		</div>
		<div class="arena_cell" style="height: auto">
			<p style="margin: auto; color: <?php echo $item_color ?>"><b><?php echo strtoupper($item_info['rarity']) ?></b></p>
			<p style="margin: auto; color: <?php echo $item_color ?>"><b><?php echo $GLOBALS['lang_attack_short']; ?>: +</b><?php echo $item_info['atk']; ?></p>
			<p style="margin: auto; color: <?php echo $item_color ?>"><b><?php echo $GLOBALS['lang_defense_short']; ?>: +</b><?php echo $item_info['def']; ?></p>
			<p style="margin: auto; color: <?php echo $item_color ?>"><b><?php echo $GLOBALS['lang_hp_short']; ?>: +</b><?php echo $item_info['hp']; ?></p>
		</div>
		<?php

		?>
		<button onclick="sound_play('click'); display('chests.php');" class="game_button"><p><?php echo $lang_Back ?></p></button>
		<?php
	}
?>

