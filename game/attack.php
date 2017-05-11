<?php
	session_start();
	include("../config.php");



	$user_attack_power = rand($_POST['user_attack_power'],$_POST['user_attack_power']*2);
	$user_defense_power = rand($_POST['user_defense_power'],$_POST['user_defense_power']*2);
	$user_hp = $_POST['user_hp'];
	$user_name = $_SESSION['login'];

	$opponent_attack_power = rand($_POST['opponent_attack_power'],$_POST['opponent_attack_power']*2);
	$opponent_defense_power = rand($_POST['opponent_defense_power'],$_POST['opponent_defense_power']*2);
	$opponent_hp = $_POST['opponent_hp'];
	$opponent_name = $_POST['opponent_name'];
	$opponent_lvl = $_POST['opponent_lvl'];

	$reward = $_POST['reward'];
	$exp_reward = pow(2,$_POST['opponent_attack_power']+1)*$opponent_lvl;

	if($_SESSION['opponent_hp'] != null && $_SESSION['user_hp'] != null){
		$opponent_hp = $_SESSION['opponent_hp'];
		$user_hp = $_SESSION['user_hp'];
	}else{
		$_SESSION['opponent_hp'] = $opponent_hp;
		$_SESSION['user_hp'] = $user_hp;
	}
	// User attacks first
	if($user_attack_power>0){
		$_SESSION['opponent_hp'] -= $user_attack_power;
	}
	// Then opponent
	if($opponent_attack_power>0){
		$_SESSION['user_hp'] -= $opponent_attack_power;
	}
	if($_SESSION['opponent_hp']<1){ // WIN
		include('chest_win.php');
		mysqli_query($a, "UPDATE `p505207_db`.`users` SET `silver_coins`=`silver_coins`+'$reward',`exp`=`exp`+'$exp_reward' WHERE `users`.`user`='$user_name'"); // SAVE REWARD
		$communicat = "You won ".$reward." silver coins ";
		if($chest_info['rarity'] != null){
			$communicat .= "and ".$chest_info['rarity']." chest"; 
		}

		?>
			<script>communicat("text", "<?php echo $communicat ?>")</script>
		<?php	
		$_SESSION['opponent_hp'] = pow(9,9);
		exit();
	}
	if($_SESSION['user_hp']<1){ // LOSE
		?>
			<script>communicat("text", "You lost")</script>
		<?php
		//dead
		exit();
	}

	echo "<p id='actual_opponent_hp' style='display: none'>".$_SESSION['opponent_hp']."</p>";

	echo "<p id='actual_user_hp' style='display: none'>".$_SESSION['user_hp']."</p>";

	