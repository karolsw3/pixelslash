<?php
	session_start();
	include("../config.php");
	include('user_stats.php');
	$text = $_POST['text'];
	$type = $_POST['type'];
?>
<div style="text-align: center">
	<?php if($type == "reward"){ ?>
		<p><?php echo $lang_Reward." ".$text ?><img src="images/silver_coin.png" height="19"></p>
		<button onclick="sound_play('click'); display('arena.php');" class="game_button"><p><?php echo $lang_Back ?></p></button>
	<?php } ?>

	<?php if($type == "text"){ ?>
		<p><?php echo $text ?></p>
		<button onclick="sound_play('click'); display('logged_user_page.php');" class="game_button"><p><?php echo $lang_Back ?></p></button>
	<?php } ?>
</div>
