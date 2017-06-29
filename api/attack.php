<?php
	session_start();
	include("../config.php");
	$user = $_SESSION['user'];
	$query = mysqli_query($a,"select * from users where user='$user'");
	$user_data = mysqli_fetch_array($query);

	if(!$_SESSION['attack_end']){
		if($user_data['energy'] > 0){
			if($opponent_name != null){
				/*
					USER AND OPPONENT DATA
				*/
				$opponent_name = $_SESSION["opponent_name"];
				$is_monster = $_SESSION["is_monster"];

				$player_weared_equipment = explode(";", $user_data["eq_weared"]);

				for($i=0;$i<count($player_weared_equipment);$i++){	
					$query = mysqli_query($a,"select * from `items` where `id`='$player_weared_equipment[$i]' ");
					$item_data = mysqli_fetch_array($query);

					$eq_atk += $item_data['atk'];
					$eq_def += $item_data['def'];
					$eq_hp += $item_data['hp'];
				}
				$user_atk = $eq_atk+$user_data['atk'];
				$user_def = $eq_def+$user_data['def'];

				$user_attack_power = rand($user_atk,$user_atk*1.2);
				$user_defense_power = rand($user_def,$user_def*1.2);
				$user_hp = $user_data['hp']+$eq_hp;

				$eq_atk=0;$eq_def=0;$eq_hp=0;
				if($is_monster){
					$query = mysqli_query($a,"select * from monsters where name='$opponent_name'");
					$opponent_data = mysqli_fetch_array($query);

					$opponent_atk = $opponent_data['atk'];
					$opponent_def = $opponent_data['def'];
					$opponent_hp  = $opponent_data['hp'];
				}else{
					$query = mysqli_query($a,"select * from users where user='$opponent_name'");
					$opponent_data = mysqli_fetch_array($query);

					$opponent_weared_equipment = explode(";", $user_data["eq_weared"]);

					for($i=0;$i<count($player_weared_equipment);$i++){	
						$query = mysqli_query($a,"select * from `items` where `id`='$opponent_weared_equipment[$i]' ");
						$item_data = mysqli_fetch_array($query);

						$eq_atk += $item_data['atk'];
						$eq_def += $item_data['def'];
						$eq_hp += $item_data['hp'];
					}
					$opponent_atk = $eq_atk+$opponent_data['atk'];
					$opponent_def = $eq_def+$opponent_data['def'];
					$opponent_hp  = $eq_hp+$opponent_data['hp'];
				}

				$opponent_attack_power = rand($opponent_atk,$opponent_atk*1.2);
				$opponent_defense_power = rand($opponent_def,$opponent_def*1.2);
				$opponent_lvl = $opponent_data['lvl'];

				$reward = 10*($opponent_lvl*0.2*$opponent_lvl*0.2);
				$exp_reward = pow(2,$opponent_lvl+$opponent_atk/10);

				if($_SESSION['opponent_hp'] != null && $_SESSION['user_hp'] != null){
					$opponent_hp = $_SESSION['opponent_hp'];
					$user_hp = $_SESSION['user_hp'];
				}else{
					$_SESSION['opponent_hp'] = $opponent_hp;
					$_SESSION['user_hp'] = $user_hp;
				}
				/*
					END USER AND opponent DATA
				*/
				
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
					mysqli_query($a, "UPDATE `p505207_db`.`users` SET `silver_coins`=`silver_coins`+'$reward',`exp`=`exp`+'$exp_reward' WHERE `users`.`user`='$user'"); // SAVE REWARD
					$status = "WIN";	
					$chest = $won_chest_rarity;
					$_SESSION['user_hp'] = null;
					$_SESSION['opponent_hp'] = null;
					$_SESSION['attack_end'] = true; // attack_request.php Changes this to false
				}
				if($_SESSION['user_hp']<1){ // LOSE
					$status = "LOST";
					$_SESSION['user_hp'] = null;
					$_SESSION['opponent_hp'] = null;
					$_SESSION['attack_end'] = true; // attack_request.php Changes this to false
				}

				if($chest == null){
					$chest = "none";
				}

			}else{
				$status = "ERROR";
				$message = "Unselected opponent";	
				$_SESSION['attack_end'] = true;			
			}
		}else{
			$status = "ERROR";
			$message = "You don't have enough energy to attack";	
			$_SESSION['attack_end'] = true;		
		}
	}else{
		$status = "ERROR";
		$message = "You aren't allowed to attack";
		$_SESSION['attack_end'] = true;
	}

	$arr = array(
		'user_hp' => $_SESSION['user_hp'],
		'opponent_hp' => $_SESSION['opponent_hp'], 
		'status' => $status, 
		'won_silver_coins' => $reward, 
		'chest' => $chest
		'message' => $message
	);

	echo json_encode($arr);

?>

