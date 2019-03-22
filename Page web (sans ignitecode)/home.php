<?php
	session_start();
	if(!isset($_SESSION['num_user']) || !isset($_SESSION['login'])) {
		header("location: login.php");
		exit();
	}
	include 'fonctions.php';
	//redirection vers la page de selection des starters si besoin
	if(besoin_de_starter($_SESSION['num_user']) == 1){
		header("location: starter_selection.php");
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
		<?php
			if (isset($_SESSION['message'])) {
				echo "<div id='error'>".$_SESSION['message']."</div>";
				unset($_SESSION['message']);
			}
		?>
		<p><a href="redirection.php?disconnect=true">Log out</a></p>
	</body>
</html>
