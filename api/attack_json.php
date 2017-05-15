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
	$exp_reward = pow(2,$opponent_lvl+$_POST['opponent_attack_power']/10);

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
		$status = "WIN";	
		$chest = $won_chest_rarity;
		exit();
	}
	if($_SESSION['user_hp']<1){ // LOSE
		$status = "LOST";
		//dead
		exit();
	}

	if($chest == null){
		$chest = "none";
	}

	$arr = array('user_hp' => $_SESSION['user_hp'], 'opponent_hp' => $_SESSION['opponent_hp'], 'status' => $status, 'hp' => $user_hp, 'won_silver_coins' => $reward, 'chest' => $chest);
	return json_encode($arr);


	/*

		{
		"user_hp": int,
		"user_max_hp": int,
		"opponent_hp": int,
		"status": WIN/LOST string,
		"won_silver_coins": int,
		"chest": none/rarity string
		}

	*/
?>

