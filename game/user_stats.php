<?php
	function lvl_up($mysqli,$user,$user_lvl){
		$won_sc = ($user_lvl+1)*500;
		$won_gc = 5;
		mysqli_query($mysqli, "UPDATE `p505207_db`.`users` SET `lvl`=`lvl`+1,`exp`=0,`silver_coins`=`silver_coins`+'$won_sc',`golden_coins`=`golden_coins`+'$won_gc' WHERE `users`.`user`='$user'"); 
		echo mysqli_error($mysqli);
	}

	function get_max_exp($_user_lvl){ // Calculating maximum exp per lvl
		return floor(pow(1.5,$_user_lvl)*400);
	}

	if($show_short_stats == ""){
		$show_short_stats = false;
	}

	$user_login = $_SESSION['login'];
	$query = mysqli_query($a, "select * from `users` where user='$user_login'");
	$user_data = mysqli_fetch_array($query);

	$user_lvl = $user_data['lvl'];
	$max_exp = get_max_exp($user_lvl);

	$time = time();
	$user = $_SESSION['login'];

	for($n=1;$n<30;$n++){
		if($time > $user_data['last_time_energy_point_used']+60*$energy_renew_time_in_minutes*$n && $user_data['last_time_energy_point_used'] != 0){ // 1 ENERGY EVERY $energy_renew_time_in_minutes MINUTES
			if($user_data['energy']<$user_data['maxenergy']){
				mysqli_query($a, "UPDATE `p505207_db`.`users` SET `energy`=`energy`+1,`last_time_energy_point_used`='$time' WHERE `users`.`user`='$user'"); 
				$user_data['energy']++;
			}
		}
	}

	if($user_data['exp'] > $max_exp){
		lvl_up($a,$user_login,$user_lvl);
		?>
			<div style="text-align: center;">
			<b><p style="color: green">Lvl up!</p></b>
			<b><p>+<?php echo ($user_lvl+1)*500; ?><img src="images/silver_coin.png" height="19"></p></b>
			<b><p>+5<img src="images/golden_coin.png" height="19"></p></b><br>
			</div>
		<?php
	}

	$query = mysqli_query($a, "select * from `users` where user='$user_login'");
	$user_data = mysqli_fetch_array($query);
	$max_exp = get_max_exp($user_lvl);
	if(!$_SESSION["user_logged"]){
		echo "You are not logged in.";
		exit();
	}

	$player_weared_equipment = explode(";", $user_data["eq_weared"]);

	for($i=0;$i<count($player_weared_equipment);$i++){	
		$query = mysqli_query($a,"select * from `items` where `id`='$player_weared_equipment[$i]' ");
		$item_data = mysqli_fetch_array($query);

		$eq_atk += $item_data['atk'];
		$eq_def += $item_data['def'];
		$eq_hp += $item_data['hp'];
	}

	
	$user_atk = ($user_data['atk']+$eq_atk);
	$user_def = ($user_data['def']+$eq_def);
	$user_hp = ($user_data['hp']+$eq_hp);
	$user_exp = $user_data['exp'];
	$user_energy = $user_data['energy'];
	$user_maxenergy = $user_data['maxenergy'];
?>

<div id="player">
	<div id="new-player"></div>
	<div class="flex">
		<p style="color: white"><?php echo $user_login ?></p>
	</div>

	<?php if(!$show_short_stats){ ?>
		<div class="flex" style="background: rgba(0,0,0,0.5); padding: 12px">
			<p><?php echo $user_lvl."lvl" ?></p>
			<p style="margin-left: 20px"><?php echo $user_data['silver_coins']; ?><img src="images/silver_coin.png" height="19"></p> 
			<p style="margin-left: 20px"><?php echo $user_data['golden_coins']; ?><img src="images/golden_coin.png" height="19"></p><br>
		</div>
		<div class="flex" style="height: 112px">
			<!-- <img src="images/bob.png" height="110"> PLAYER IMAGE -->
			<?php include("user_image.php"); ?>
		</div>
	<?php } ?>
	<div style="background: rgba(0,0,0,0.5); padding: 12px">
		<div class="flex">
			<p style="color: #ff1717"><b><?php echo $lang_attack_short ?>: </b></p><p><?php echo $user_atk ?></p>
			<p style="color: #307449; margin-left: 20px"><b><?php echo $lang_defense_short ?>: </b></p><p><?php echo $user_def ?></p>
			<p style="color: #0193d7; margin-left: 20px"><b><?php echo $lang_experience_short ?>: </b></p><p><?php echo $user_exp."/".$max_exp ?></p>
		</div>

		<div class="flex">
			<p style="color: #ff1717; margin-left: 20px"><b><?php echo $lang_hp_short ?>: </b></p><p id="user_hp"><?php echo $user_hp ?></p>
			<p style="color: #ff17ff; margin-left: 20px"><b>ENERGY: </b></p><p><?php echo $user_energy."/".$user_maxenergy ?></p>
			<p style="margin-left: 3px; color:#303030">(</p><p id="energy_seconds_left" style="color: #303030">
			<?php 
				$time_left = 60*$energy_renew_time_in_minutes-(time()-$user_data['last_time_energy_point_used']);
				if($time_left>=0){
					echo $time_left;
				}
			?>
			</p><p style="color: #303030">)</p>
		</div>
		<div class="flex">
			<div id="bar">
				<div id="progress"></div>
			</div>
		</div>
	</div>
</div>