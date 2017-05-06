<form id="register_form">

	<input class="padding" type="text" id="user" name="user" placeholder="<?php echo $lang_User; ?>" />
	<input class="padding" type="password" id="password" name="password" placeholder="<?php echo $lang_Password; ?>" />
	<input class="padding" type="password" id="password_repeat" name="password_repeat" placeholder="<?php echo $lang_Password_Repeat; ?>" />
	<button onclick="sound_play('click'); register(); return false" class="game_button"><p><?php echo $lang_Register; ?></p></button>

</form>