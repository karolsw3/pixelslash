<?php
	session_start();
	include("config.php");
	include("user_stats.php");
	$user_login = $_SESSION['login'];
	$query = mysqli_query($a, "select * from `users` where `user`='$user_login'");
	$user_data = mysqli_fetch_array($query);

	if(!$_SESSION["user_logged"]){
		echo "You are not logged in.";
		exit();
	}

	function show_chest($chest_id,$chest_index_in_player_eq){
		global $a;
		$query = mysqli_query($a, "select * from `chests` where `id`='$chest_id'");
		$chest_info = mysqli_fetch_array($query);

		include("rarity_color_info.php");
		?>
		<div class="arena_cell">
			<div style="position: relative; top: 0; left: 0;">
				<div style="position: relative; top: 0; left: 0;"><img src="<?php echo 'images/'.$chest_info['rarity'].'.png' ?>" height="70"></div>
				<div style="position: absolute; top: 0; left: 0;"><img src="images/chest.png" height="70"></div>
			</div>
			<p style="margin: auto; color: <?php echo $chest_color ?>"><?php echo $chest_info['lvl']."lvl ".$chest_info['name'] ?></p>
			<a style="margin: auto 0" onclick="sound_play('click'); open_chest(<?php echo $chest_index_in_player_eq; ?>)"><pp class="buy" style="color: #00da00">Open</p></a>
		</div>
		<?php
	}

	$player_chests = explode(";", $user_data["chests"]); 
	$count_chests = 0;
	for($i=0;$i<count($player_chests);$i++){	
		if($player_chests[$i] > 0){
			$chest_id = $player_chests[$i];
			show_chest($chest_id,$i);	
			$count_chests++;
		}
	}
	if($count_chests == 0){
		echo $lang_you_dont_have_any_chests;
	}

	$which_button = 'back';
	include('buttons.php');
?>
