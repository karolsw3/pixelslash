<?php
	session_start();
	include("user_stats.php");
	if($_SESSION['page'] != null){
		$page = $_SESSION['page'];
	}else{
		$page = 0;
	}
	
?>
	<div class="flex" style="background: rgba(0,0,0,0.8); padding: 12px">
			<p><?php echo $lang_Players ?></p>
	</div>
<?php
	$query1 = mysqli_query($a, "select * from users order by lvl desc");
	$how_much_users = mysqli_num_rows($query1);

	for($x=0;$x<$page*10;$x++){
		$user_info = mysqli_fetch_array($query1);
	}
	for($x=$page*10;$x<$page*10+10;$x++){
		$user_info = mysqli_fetch_array($query1);
	?>
		<div class="arena_cell" style="height: 104px">
			<p style="margin: auto 10px">#<?php echo $x+1 ?></p>
			<?php $another_user=$user_info['user']; include('user_image.php'); ?>
			<p style="margin: auto"><?php echo $user_info['lvl']."lvl ".$user_info['user'] ?></p>
		</div>
	<?php		
	}
	?>
	<div style="display: inline-flex; margin: 0 auto; left: 0; right: 0; font-size: 30px;">
	<?	
	if($page>0){
		?>
			<a class="buy" style="color: green" onclick="show_page(<?php echo $page-1 ?>)"/><?php echo $page ?></a>
		<?php
	}
	?>
	<p><?php echo $page+1 ?></p>
	<a class="buy" style="color: green" onclick="show_page(<?php echo $page+1 ?>)"/><?php echo $page+2 ?></a>
	</div>
	<?php
	$which_button = 'back';
	include('buttons.php');
?>
