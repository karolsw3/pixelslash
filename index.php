<?php
    session_start();
    include("config.php"); // Connect to the database
    
    $user_logged = $_SESSION["user_logged"];
	$login = $_SESSION['login'];
?>

<html>

<head>
	<title>Pixel slash alpha</title>
	<link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet"> 
	<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="theme-color" content="#ffffff">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="style/main.css" rel="stylesheet" type="text/css" />
	<style>
		span a{
			pointer-events: none;
			cursor: default;
			color: rgba(140,140,140,0.5);
			text-align: center;
			text-shadow: 2px 2px 1px black;
		}
	</style>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.1/jquery.form.min.js"></script>
	<script src="javascript/main.js"></script>
</head>

<body>

	<!-- LOGO -->
	<a href="index.php"><img src="images/logo.png" style="width: 100%"></a>

	<img src="images/back_top.png" height="60" style="width: 100%"/>
	<div id="game">
	<?php
		if($user_logged){	
			include("game/logged_user_page.php");
		}else{
	?>
	<form id="login_form">

		<input class="padding" type="text" id="user" name="user" placeholder="<?php echo $lang_User; ?>" />
		<input class="padding" type="password" id="password" name="password" placeholder="<?php echo $lang_Password; ?>" />
		<button id="Enter" onclick="sound_play('click'); login(); return false" class="game_button"><p><?php echo $lang_Enter; ?></p></button>

	</form>
		<button id="Register" class="game_button" onclick="sound_play('click'); display('show_register_form.php')"><p><?php echo $lang_Register ?></p></button>
	<?php } ?>
	</div>
	<img src="images/back_top.png" height="60" style="transform: rotate(180deg); width: 100%"/>

	<div style="text-align: center; margin: 0 auto; left: 0; right:0; margin-top: 10px;">
		<script language="JavaScript">var fhs = document.createElement('script');var fhs_id = "5471306";
		var ref = (''+document.referrer+'');var pn =  window.location;var w_h = window.screen.width + " x " + window.screen.height;
		fhs.src = "//s1.freehostedscripts.net/ocounter.php?site="+fhs_id+"&e1=user online&e2=users online&r="+ref+"&m=0&wh="+w_h+"&a=1&pn="+pn+"";
		document.head.appendChild(fhs);document.write("<span id='o_"+fhs_id+"'></span>");
		</script>
	</div>


	<p style="cursor: pointer; color: rgba(140,140,140,0.3); text-align: center; margin-top: 10px">Proudly developed by Karol Swierczek</p>
	<p style="cursor: pointer; color: rgba(140,140,140,0.3); text-align: center; margin-top: 10px">2017</p>
</body>

</html>

