<div id="buttons">
<?php
	switch($which_button){
		case 'back':
			?>
				<button onclick="sound_play('click'); display('logged_user_page.php');" class="game_button"><p><img src="images/back_button.png" height="30"><?php echo $lang_Back ?><img src="images/back_button.png" height="30"></p></button>
			<?php
			break;
	}
?>
</div>