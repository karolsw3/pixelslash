
<div style="position:relative;">
	<div>
	<?php
		if($another_user == null){
			$query = mysqli_query($a, "select * from `users` where `user`='$user_login'");
		}else{
			$query = mysqli_query($a, "select * from `users` where `user`='$another_user'");
			$another_user = null;
		}
		$user_data = mysqli_fetch_array($query);

		if($another_background == null){
	?>
		<img src="images/backgrounds/<?php echo $user_data['background'] ?>.png" height="104">
	<?php }else{ ?>
		<img src="images/backgrounds/<?php echo $another_background ?>.png" height="104">
	<?php 
		$another_background = null;
	 }
	 ?>

	</div>
	<div style="position: absolute; bottom: 4px; left: 36px;">
		<img src="images/bob.png" height="96">
	</div>
	<?php
		$player_weared_equipment = explode(";", $user_data["eq_weared"]);

		for($i=0;$i<count($player_weared_equipment);$i++){	
			if($player_weared_equipment[$i] > 0){
				$item_id = $player_weared_equipment[$i];
				$query = mysqli_query($a, "select * from `items` where `id`='$item_id'");
				$item_info = mysqli_fetch_array($query);
				?>
				<div style="position: absolute; bottom: 4px; left: 28px;">
					<img src="<?php echo 'images/items/user_image/'.$item_info['image'] ?>" height="96">	
				</div>
				<?php
			}
		}
	?>

</div>