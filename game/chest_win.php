<?php
	$chances_to_win_a_chest = 12;
	$common = 50;
	$rare = 20;
	$mighty = 5;
	$legendary = 1;
	if($chances_to_win_a_chest>rand(0,100)){
		$number = rand(0,$common);
		if($number==$legendary){
			$won_chest_rarity = "legendary"; 
		}else if($number<$mighty){
			$won_chest_rarity = "mighty";
		}else if($number<$rare){
			$won_chest_rarity = "rare";
		}else if($number<$common){
			$won_chest_rarity = "common";
		}
		$query = mysqli_query($a,"select * from users where `user`='$user_name'");
		$user_info = mysqli_fetch_array($query);
		$user_lvl = $user_info['lvl'];
		$query = mysqli_query($a,"select * from chests where `rarity`='$won_chest_rarity' and `lvl`<'$user_lvl'");
		$select_chest_to_win = rand(0,mysqli_num_rows($query));
		for($i=0;$i<$select_chest_to_win;$i++){
			$chest_info = mysqli_fetch_array($query); 
		}
		if($chest_info['id'] != null){
			$chest_id = $chest_info['id'];
			$chest_id .= ";";
			mysqli_query($a, "UPDATE `p505207_db`.`users` SET `chests`=CONCAT(`chests`,'$chest_id') WHERE `users`.`user`='$user_name'");
		}
	}
?>