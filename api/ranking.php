<?php
	include("../config.php");
	$page = $_POST['page'];
	
	$query = mysqli_query($a, "select * from users order by lvl desc");
	$how_much_users = mysqli_num_rows($query);

	for($x=0;$x<$page*10;$x++){
		$user_info = mysqli_fetch_array($query);
	}
	for($x=$page*10;$x<$page*10+10;$x++){
		$user_info = mysqli_fetch_array($query);
		$unencoded = array("user" => $user_info['user'],"pos" => $x);	
		$arr .= json_encode($unencoded);
		if($x<($page*10+10)-1){
			$arr .= ",";
		}
	}
	$object = new stdClass();
	$object -> data = $arr;
	echo $object -> data;
?>
