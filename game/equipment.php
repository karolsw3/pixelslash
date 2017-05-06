<?php
	session_start();
	include("config.php");
	include("user_stats.php");
	$user_login = $_SESSION['login'];
	$query = mysqli_query($a, "select * from `users` where `user`='$user_login'");
	$user_data = mysqli_fetch_array($query);

	if(!$_SESSION["user_logged"]){
		echo "You are not logged in.";
		exit();
	}

	function show_item($item_id,$action,$item_index_in_player_eq){
		global $a;
		$query = mysqli_query($a, "select * from `items` where `id`='$item_id'");
		$item_info = mysqli_fetch_array($query);

		switch ($item_info['rarity']){
			case 'common':
				$item_color = "#969696";
				break;
			case 'rare':
				$item_color = "#2849ef";
				break;
			case 'mighty':
				$item_color = "#9d33ff";
				break;			
		}
		?>
		<div class="arena_cell">
			<div style="position: relative; top: 0; left: 0;">
				<div style="position: relative; top: 0; left: 0;"><img src="<?php echo 'images/'.$item_info['rarity'].'.png' ?>" height="70"></div>
				<div style="position: absolute; top: 0; left: 0;"><img src="<?php echo 'images/items/'.$item_info['image'] ?>" height="70"></div>
			</div>
			<p style="margin: auto; color: <?php echo $item_color ?>"><?php echo $item_info['lvl']."lvl ".$item_info['name'] ?></p>
			<button class="<?php echo $action; ?>" onclick="sound_play('click'); item_action(<?php echo $item_index_in_player_eq; ?>,'<?php echo $action; ?>')"/>
		</div>
		<div class="arena_cell" style="height: auto">
			<p style="margin: auto; color: <?php echo $item_color ?>"><b><?php echo strtoupper($item_info['rarity']) ?></b></p>
			<p style="margin: auto; color: <?php echo $item_color ?>"><b><?php echo $GLOBALS['lang_attack_short']; ?>: +</b><?php echo $item_info['atk']; ?></p>
			<p style="margin: auto; color: <?php echo $item_color ?>"><b><?php echo $GLOBALS['lang_defense_short']; ?>: +</b><?php echo $item_info['def']; ?></p>
			<p style="margin: auto; color: <?php echo $item_color ?>"><b><?php echo $GLOBALS['lang_hp_short']; ?>: +</b><?php echo $item_info['hp']; ?></p>
		</div>
		<div class="arena_cell" style="height: auto; border-bottom: 3px solid rgba(0,0,0,0.5)">
			<?php if($action == "equip"){ ?>
				<a style="margin: auto 0" onclick="sound_play('click'); item_action(<?php echo $item_index_in_player_eq ?>,'sell');"><p class="sell" style="color: red"><?php echo $GLOBALS['lang_Sell']."(".$item_info['price']/2 ?><img src="images/silver_coin.png" height="19">)</p></a>
			<?php } ?>
		</div>
		<?php
	}

	$player_weared_equipment = explode(";", $user_data["eq_weared"]); 
	$player_equipment = explode(";", $user_data["eq"]); 
	?>
	<div class="flex" style="background: rgba(0,0,0,0.8); padding: 12px">
			<p><?php echo $lang_EquippedItems ?></p>
	</div>
	<?php

	for($i=0;$i<count($player_weared_equipment);$i++){	
		if($player_weared_equipment[$i] > 0){
			$item_id = $player_weared_equipment[$i];
			show_item($item_id,"unequip",$i);	
		}
	}

	?>
	<div class="flex" style="background: rgba(0,0,0,0.8); padding: 12px">
			<p><?php echo $lang_Equipment ?></p>
	</div>
	<?php

	for($i=0;$i<count($player_equipment);$i++){	
		if($player_equipment[$i] > 0){
			$item_id = $player_equipment[$i];
			show_item($item_id,"equip",$i);	
		}
	}
	$which_button = 'back';
	include('buttons.php');
?>
