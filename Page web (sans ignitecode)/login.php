<!--

Avant toute chose tu dois créer ça :
La table users qui contient l'ID (clé primaire, auto-incrémentée), le pseudo et le mot de passe (cryptée)

CREATE TABLE users (
	id INT NOT NULL,
	username VARCHAR(100) NOT NULL,
	password VARCHAR(100) NOT NULL,
	PRIMARY KEY (id)
); 

-->

<?php
	session_start();

	if (isset($_SESSION['login'])) {
		header("location: home.php");
	}

	/*
	 *
	 *	Modifie en fonction de ta base de données les valeurs en dessous : mysqli_connect('dwarves', 'clementa', ...)
	 *
	 */

	$db = mysqli_connect('dwarves.iut-fbleau.fr', 'clementa', 'clementa', 'clementa');
	
	if (isset($_POST['pseudo']) && isset($_POST['mdp'])) {

		$username = $_POST['pseudo'];
		$password = $_POST['mdp'];

		$password = md5($password);

		$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
		$result = mysqli_query($db, $query);

		if (mysqli_num_rows($result) == 1) {
			$_SESSION['login'] = $_POST['pseudo'];
			$_SESSION['message'] = "Connecté";
			$_SESSION['username'] = $username;
			header("location: home.php");
		} else {
			$_SESSION['message'] = "Invalide";
		}
	}

	mysqli_close($db);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>login.php</title>
		<link rel="stylesheet" type="text/css" href="css/login.css">
		<link rel="icon" href="icon.ico" />
	</head>
	<body>
		<?php 
			if (isset($_SESSION['message'])) {
				echo "<div id='error'>".$_SESSION['message']."</div>";
				unset($_SESSION['message']);
			}
		?>
		<form method="post" action="login.php">
			<div class="login-box">
				<h1>S'identifier</h1>
				<div class="textbox">
					<i class="fa fa-user" aria-hidden="true"></i>
					<input type="text" placeholder="Utilisateur" name="pseudo" />
				</div>
				<div class="textbox">
					<i class="fa fa-lock" aria-hidden="true"></i>
					<input type="password" placeholder="Mot de passe" name="mdp"/>
				</div>
				<input type="submit" value="Se connecter" class="btn"/>
				<a href="register.php" id="register" ><input type="button" value="S'inscrire" class="btn" /></a>
			</div>
		</form>
	</body> 
</html>
