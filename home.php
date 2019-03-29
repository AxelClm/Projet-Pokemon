<?php
	session_start();
	if(!isset($_SESSION['num_user']) || !isset($_SESSION['login'])) {
		header("location: redirection.php?disconnect=true");
		exit();
	}
	include 'fonctions.php';
	//Mise a jour de la derniere connection
	is_connected($_SESSION['num_user']);
	//redirection vers la page de selection des starters si besoin
	if(besoin_de_starter($_SESSION['num_user']) == 1){
		header("location: starter_selection.php");
		exit();
	}
	//redirection vers la page des recompenses
	if(need_reward($_SESSION['num_user'])){
		header("location: reward.php");
		exit();
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Pokemon</title>
		<link rel="stylesheet" type="text/css" href="css/home.css">
		<link rel="icon" href="icon.ico" />
	</head>
	<body>
		<p>Welcome <?php echo $_SESSION['username']; ?></p>
		<div class="friends">
			<h6>Amis</h6>
			<div class="online_friends">
			</div>
			<div class="offline_friends">
			</div>
		</div>
		<p><a href="redirection.php?disconnect=true">Log out</a></p>
	</body>
</html>
<script>
function friends(){
	var xhr = new XMLHttpRequest();
	xhr.open('GET', 'redirection.php?friends=true', true);
	xhr.addEventListener('readystatechange', function() {
		if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				var tab = JSON.parse(xhr.responseText);
				var time_actuel = Date.now()/1000;
				var text_online="";
				var text_offline="";
				for (var i=0 ; i<tab.length;i++){
					if( time_actuel - tab[i]['last_connect'] < 15){
						text_online = text_online + "<div><p>"+tab[i]['username'] +"<p>En ligne</p></div>";
					}
					else {
						text_offline = text_offline + "<div><p>"+tab[i]['username'] +"<p>Hors ligne</p></div>";
					}
				}
					document.querySelector(".online_friends").innerHTML = text_online;
					document.querySelector(".offline_friends").innerHTML = text_offline;
				}
		});
		xhr.send();
}
	friends();
	setInterval(friends,"10000");
</script>
