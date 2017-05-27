<?php
	session_start();
	$_SESSION['opponent_hp'] = null;
	$_SESSION['user_hp'] = null;
	include("../config.php");
	$opponnent_id = $_POST["monster_id"];
	if($_POST["type"] == 'monster'){
		$query = mysqli_query($a, "select * from monsters where id='$opponnent_id'");
	}
	if($_POST["type"] == 'user'){
		$query = mysqli_query($a, "select * from users where user='$opponnent_id'");
	}
	$monster_info = mysqli_fetch_array($query);
?>

<div>
	<?php
		$show_short_stats = true;
		include("user_stats.php"); 
		
		if($_POST["type"] == 'monster'){
			$opponent_name = $monster_info['name'];
			$reward = $monster_info['reward'];
		}
		if($_POST["type"] == 'user'){
			$opponent_name = $monster_info['user'];
			$reward = $monster_info['lvl']*30;
			$player_weared_equipment = explode(";", $monster_info["eq_weared"]);

			for($i=0;$i<count($player_weared_equipment);$i++){	// ATK, DEF and HP from users eq
				$query = mysqli_query($a,"select * from `items` where `id`='$player_weared_equipment[$i]' ");
				$item_data = mysqli_fetch_array($query);

				$monster_info['atk'] += $item_data['atk'];
				$monster_info['def'] += $item_data['def'];
				$monster_info['hp'] += $item_data['hp'];
			}
		}
		/*
			ENERGY
		*/
		$user = $_SESSION['login'];
		$time = time();
		if($user_energy <= 0){
			echo "<p style='text-align: center'>You don't have enough energy!</p>";
			?>
			<button onclick="sound_play('click'); display('arena.php');" class="game_button"><p><?php echo $lang_Back ?></p></button>
			<?php
			exit(0);
		}else{
			mysqli_query($a, "UPDATE `p505207_db`.`users` SET `energy`=`energy`-1,`last_time_energy_point_used`='$time' WHERE `users`.`user`='$user'"); 
		}

		/* */
		$user_attack_power = $user_atk-$monster_info['def'];
		$user_defense_power = $user_def-$monster_info['atk'];

		$opponent_attack_power = $monster_info['atk']-$user_def;
		$opponent_defense_power = $monster_info['def']-$user_atk;

		$opponent_hp = $monster_info['hp'];
		$opponent_lvl = $monster_info['lvl'];

		$data = "user_attack_power=".$user_attack_power."&".
				"user_defense_power=".$user_defense_power."&".
				"opponent_attack_power=".$opponent_attack_power."&".
				"opponent_defense_power=".$opponent_defense_power."&".
				"opponent_name=".$opponent_name."&".
				"user_hp=".$user_hp."&".
				"reward=".$reward."&".
				"opponent_lvl=".$opponent_lvl."&".
				"opponent_hp=".$opponent_hp;
	?>
</div>

<div class="flex">
	<?php
		$another_background = $monster_info['background']; 
		include("user_image.php");
	if($_POST["type"] == 'monster'){
	?>
		<div style="position:relative;">
			<div>
				<img src="images/backgrounds/<?php echo $monster_info['background'] ?>.png" height="104">
			</div>
			<div style="position: absolute;bottom: 8px; left: 32px;">
				<img src="images/monsters/<?php echo $monster_info['image'] ?>" height="64">
			</div>
		</div>
	<?php }else{ ?>
		<?php $another_user=$opponnent_id; include('user_image.php'); ?>
	<?php } ?>
</div>

<div class="flex" style="background: rgba(0,0,0,0.5)">

	<div style="padding: 12px">
		<div class="flex">
			<p style="color: #ff1717"><?php echo $monster_info['name'] ?></p>
		</div>
		<div class="flex">
			<p><?php echo $monster_info['lvl'] ?>lvl</p>
		</div>
		<div class="flex">
			<p style="color: #ff1717; margin-left: 20px"><b><?php echo $lang_hp_short ?>: </b></p><p id="opponent_hp"><?php echo $monster_info['hp'] ?></p>
			<p style="color: #ff1717; margin-left: 20px"><b><?php echo $lang_attack_short ?>: </b></p><p><?php echo $monster_info['atk'] ?></p>
			<p style="color: #307449; margin-left: 20px"><b><?php echo $lang_defense_short ?>: </b></p><p><?php echo $monster_info['def'] ?></p>
		</div>
		<div class="flex">
			<div id="bar">
				<div id="progress_opponent"></div>
			</div>
		</div>
	</div>

</div>

<button class="game_button" id="attack" onclick="sound_play('click'); post_data('game/attack.php', '<?php echo $data ?>', 'log'); attack_animation()"><p><?php echo "Attack"; ?></p></button>
<div id="log" style="text-align: center">

</div>
