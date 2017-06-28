<?php

	session_start();
	include("../config.php");

	$user_login = $_GET['login'];// <------------ GET USER LOGIN TO CHECK STATS
	$isMonster = $_GET['isMonster'];

	function get_max_exp($_user_lvl){ // Calculating maximum exp per lvl
		return floor(pow(1.5,$_user_lvl)*400);
	}

	if($isMonster){
		$query = mysqli_query($a, "select * from `monsters` where name='$user_login'");
	}else{
		$query = mysqli_query($a, "select * from `users` where user='$user_login'");
	}
	
	$user_data = mysqli_fetch_array($query);
	$user_lvl = $user_data['lvl'];

	$max_exp = get_max_exp($user_lvl);

	$player_weared_equipment = explode(";", $user_data["eq_weared"]);

	for($i=0;$i<count($player_weared_equipment);$i++){	
		$query = mysqli_query($a,"select * from `items` where `id`='$player_weared_equipment[$i]' ");
		$item_data = mysqli_fetch_array($query);

		$eq_atk += $item_data['atk'];
		$eq_def += $item_data['def'];
		$eq_hp += $item_data['hp'];
	}

	$user_lvl = $user_data['lvl'];

	$user_atk = ($user_data['atk']+$eq_atk);
	$user_def = ($user_data['def']+$eq_def);
	$user_hp = ($user_data['hp']+$eq_hp);
	$user_exp = $user_data['exp'];
	$user_test = $user_data['lvl'];
	$user_maxexp = $max_exp;
	$user_energy = $user_data['energy'];
	$user_maxenergy = $user_data['maxenergy'];
	$user_silver_coins = $user_data['silver_coins'];
	$user_golden_coins = $user_data['golden_coins'];
	
	$arr = array('lvl' => $user_lvl, 'atk' => $user_atk, 'def' => $user_def, 'hp' => $user_hp, 'exp' => $user_exp,
		'maxexp' => $user_maxexp, 'energy' => $user_energy,'maxenergy' => $user_maxenergy, 'silver_coins' => $user_silver_coins, 'golden_coins' => $user_golden_coins);
	echo json_encode($arr);

?>


