<?php
	include("user_stats.php");
	$_SESSION['page'] = 0;
?>
<div id="buttons2">
	<button onclick="sound_play('click'); display('arena.php')" class="game_button"><p><img src="images/sword_button.png" height="30"><?php echo $lang_Arena ?><img src="images/shield_button.png" height="30"></p></button>
	<button onclick="sound_play('click'); display('equipment.php')" class="game_button"><p><img src="images/equipment_button.png" height="30"><?php echo $lang_Equipment ?><img src="images/equipment_button.png" height="30"></p></button>
	<button onclick="sound_play('click'); display('chests.php')" class="game_button"><p><img src="images/chest_button.png" height="30"><?php echo $lang_Chests ?><img src="images/chest_button.png" height="30"></p></button>	
	<button onclick="sound_play('click'); display('shop_gui.php')" class="game_button"><p><img src="images/shop_button.png" height="30"><?php echo $lang_Shop ?><img src="images/shop_button.png" height="30"></p></button>
	<button onclick="sound_play('click'); display('hall_of_fame.php')" class="game_button"><p><img src="images/podium_button.png" height="30"><?php echo "Hall of fame" ?><img src="images/podium_button.png" height="30"></p></button>
</div>
<button id="Logout" onclick="sound_play('click'); logout()" class="game_button"><p><img src="images/logout_button.png" height="30"><?php echo $lang_Logout ?><img src="images/logout_button.png" height="30"></p></button>
