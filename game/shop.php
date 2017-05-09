<?php
	session_start();
	include("../config.php");
	include("user_stats.php");
	$query = mysqli_query($a, "select * from items ORDER BY lvl ASC");
	$how_much_items = mysqli_num_rows($query);

	for($i=0;$i<$how_much_items;$i++){
		$item_info = mysqli_fetch_array($query);
		include("rarity_color_info.php");
		?>
		<div class="arena_cell">
			<div style="position: relative; top: 0; left: 0;">
				<div style="position: relative; top: 0; left: 0;"><img src="<?php echo 'images/'.$item_info['rarity'].'.png' ?>" height="70"></div>
				<div style="position: absolute; top: 0; left: 0;"><img src="<?php echo 'images/items/'.$item_info['image'] ?>" height="70"></div>
			</div>
			<p style="margin: auto; color: <?php echo $item_color ?>"><?php echo $item_info['lvl']."lvl ".$item_info['name'] ?></p>
			<a style="margin: auto 0" onclick="sound_play('click'); item_action('<?php echo $item_info['id'] ?>','buy');"><p class="buy" style="color: #00da00"><?php echo $lang_Buy."(".$item_info['price'] ?><img src="images/silver_coin.png" height="19">)</p></a>
		</div>
		<div class="arena_cell" style="height: auto; border-bottom: 3px solid rgba(0,0,0,0.5)">
			<p style="margin: auto; color: <?php echo $item_color ?>"><b><?php echo strtoupper($item_info['rarity']) ?></b></p>
			<p style="margin: auto; color: <?php echo $item_color ?>"><b><?php echo $GLOBALS['lang_attack_short']; ?>: +</b><?php echo $item_info['atk']; ?></p>
			<p style="margin: auto; color: <?php echo $item_color ?>"><b><?php echo $GLOBALS['lang_defense_short']; ?>: +</b><?php echo $item_info['def']; ?></p>
			<p style="margin: auto; color: <?php echo $item_color ?>"><b><?php echo $GLOBALS['lang_hp_short']; ?>: +</b><?php echo $item_info['hp']; ?></p>
		</div>
		<?php	
	}
	$which_button = 'back';
	include('buttons.php');
?>



