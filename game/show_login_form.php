<form id="login_form">

	<input class="padding" type="text" id="user" name="user" placeholder="<?php echo $lang_User; ?>" />
	<input class="padding" type="password" id="password" name="password" placeholder="<?php echo $lang_Password; ?>" />
	<button id="Enter" onclick="sound_play('click'); login(); return false" class="game_button"><p><?php echo $lang_Enter; ?></p></button>

</form>