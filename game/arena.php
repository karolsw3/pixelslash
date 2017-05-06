<?php
	session_start();
	include("user_stats.php");

?>
	<div class="flex" style="background: rgba(0,0,0,0.8); padding: 12px">
			<p><?php echo $lang_Monsters ?></p>
	</div>
<?php

	$query = mysqli_query($a, "select * from monsters order by lvl asc");
	$how_much_monsters = mysqli_num_rows($query);

	for($i=0;$i<$how_much_monsters;$i++){
		$monster_info = mysqli_fetch_array($query);
	?>
		<div class="arena_cell" style="height: 104px">
			<div style="position:relative;">
				<div>
					<img src="images/backgrounds/<?php echo $monster_info['background'] ?>.png" height="104">
				</div>
				<div style="position: absolute;bottom: 8px; left: 32px;">
					<img src="images/monsters/<?php echo $monster_info['image'] ?>" height="64">
				</div>
			</div>
			<p style="margin: auto; max-width: 25%; text-align: center;"><?php echo $monster_info['lvl']."lvl ".$monster_info['name'] ?></p>
			<p style="margin: auto; color: grey"><?php echo "Reward: ".$monster_info['reward'] ?><img src="images/silver_coin.png" height="19"></p>
			<button style="margin: auto 0" class="attack" onclick="sound_play('click'); show_attack_gui(<?php echo $monster_info['id'] ?>,'monster')"/>
		</div>
	<?php		
	}

?>
	<div class="flex" style="background: rgba(0,0,0,0.8); padding: 12px">
			<p><?php echo $lang_Players ?></p>
	</div>
<?php
	$user_login = $_SESSION['login'];
	$query1 = mysqli_query($a, "select * from users where user !='$user_login' ");
	$how_much_users = mysqli_num_rows($query1);

	for($x=0;$x<$how_much_users;$x++){
		$user_info = mysqli_fetch_array($query1);
	?>
		<div class="arena_cell" style="height: 104px">
			<?php $another_user=$user_info['user']; include('user_image.php'); ?>
			<p style="margin: auto"><?php echo $user_info['lvl']."lvl ".$user_info['user'] ?></p>
			<button style="margin: auto 0" class="attack" onclick="sound_play('click'); show_attack_gui('<?php echo $user_info['user'] ?>','user')"/>
		</div>
	<?php		
	}	


	$which_button = 'back';
	include('buttons.php');
?>
