<?php
	session_start();
	include("../config.php");
	$query = mysqli_query($a, "select * from monsters ORDER BY lvl ASC");
	$how_much_items = mysqli_num_rows($query);

	for($i=0;$i<$how_much_items;$i++){	
		$item_info = mysqli_fetch_array($query);
		$unencoded = array('id' => $item_info["id"], 'name' => $item_info["name"], 'type' => $item_info["type"], 'stats' => array('rarity' => $item_info["rarity"],'atk' => $item_info["atk"],'def' => $item_info["def"],'hp' => $item_info["hp"],'price' => $item_info["price"]));
		$arr .= json_encode($unencoded);
		if($i<$how_much_items-1){
			$arr .= ",";
		}
	}
	echo json_encode($arr);
?>



