<?php 
	session_start();

	if (!isset($_SESSION['login'])) {
		header("location: login.php");
	}

	function creer_un_pokemon($num_dresseur, $num_pokemon) {
		$db = mysqli_connect('https://dwarves.iut-fbleau.fr', 'clementa', 'clementa', 'clementa');
		$query = "INSERT INTO Pokemon_des_dresseurs(Num_dresseur, Num_pokemon, IV_PV, IV_Attaque, IV_Defense, IV_Attaque_Spe, IV_Defense_Spe, IV_Vitesse) VALUES(".$num_dresseur.", ".$num_pokemon.", ".rand(0,31).", ".rand(0,31).", ".rand(0,31).", ".rand(0,31).", ".rand(0,31).", ".rand(0,31).")";

		mysqli_query($db, $query);
		mysqli_close($db);
	}

	creer_un_pokemon(2, 1);

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
		<p><a href="logout.php">Log out</a></p>
	</body> 
</html>
