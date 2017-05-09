<?php
	include("user_stats.php");
	$_SESSION['page'] = 0;
	$user_login = $_SESSION['login'];
	$query = mysqli_query($a,"select * from users where user='$user_login'");
	$user_info = mysqli_fetch_array($query);
	$user_chests = explode(";",$user_info['chests']);
	$how_much_chests = count($user_chests);
	for($i=0;$i<$how_much_chests;$i++){
		if($user_chests[$i] == ""){
			unset($user_chests[$i]);
		}
	}
	$how_much_chests = count($user_chests);

?>
<div id="buttons2">
	<button onclick="sound_play('click'); display('arena.php')" class="game_button"><p><img src="images/sword_button.png" height="30"><?php echo $lang_Arena ?><img src="images/shield_button.png" height="30"></p></button>
	<button onclick="sound_play('click'); display('equipment.php')" class="game_button"><p><img src="images/equipment_button.png" height="30"><?php echo $lang_Equipment ?><img src="images/equipment_button.png" height="30"></p></button>
	<button onclick="sound_play('click'); display('chests.php')" class="game_button"><p><img src="images/chest_button.png" height="30">
		<?php
		 	echo $lang_Chests; 
			if($how_much_chests>0){
				echo "(".$how_much_chests.")";
			}
		 ?>
	<img src="images/chest_button.png" height="30"></p></button>	
	<button onclick="sound_play('click'); display('shop_gui.php')" class="game_button"><p><img src="images/shop_button.png" height="30"><?php echo $lang_Shop ?><img src="images/shop_button.png" height="30"></p></button>
	<button onclick="sound_play('click'); display('hall_of_fame.php')" class="game_button"><p><img src="images/podium_button.png" height="30"><?php echo $lang_Hall_Of_Fame ?><img src="images/podium_button.png" height="30"></p></button>
	<p style="color: orange">* Update 0.0.3 *<br>New common items in the shop!</p>	
</div>
<button id="Logout" onclick="sound_play('click'); logout()" class="game_button"><p><img src="images/logout_button.png" height="30"><?php echo $lang_Logout ?><img src="images/logout_button.png" height="30"></p></button>
