<?php 
	session_start();
	include("fonctions.php");
	if (isset($_SESSION['login'])) {
		header("location: home.php");
		exit();
	}

	$db = connect();

	if (isset($_POST['pseudo']) && isset($_POST['mdp']) && isset($_POST['confirm'])) {
		$username = mysqli_real_escape_string($db, $_POST['pseudo']);

		$sql = "SELECT * FROM users WHERE username='$username'";
		$res = mysqli_query($db, $sql);

		if (mysqli_num_rows($res) > 0) {
			$_SESSION['message'] = "Pseudo déjà existant";
		}
		else if (!ctype_alnum($username)) {
			$_SESSION['message'] = "Pseudo non acceptable";
		}
		else {
			$password = mysqli_real_escape_string($db, $_POST['mdp']);
			$confirm = mysqli_real_escape_string($db, $_POST['confirm']);
			
			if ($password == $confirm) {
				$password = md5($password);
				
				$query = "INSERT INTO users(username, password, dateInscription) VALUES('$username', '$password', NOW())";
				mysqli_query($db, $query);

				$_SESSION['login'] = $username;
				$_SESSION['message'] = "Connecté";
				$_SESSION['username'] = $username;
				
				$query = "SELECT id FROM users WHERE username='$username'";
				$result = mysqli_query($db, $query);
				
				if (mysqli_num_rows($result) == 1) {
					foreach($result as $enr) {
	  		 			$_SESSION['num_user'] = $enr['id'];
					}
				}
				
				header("location: home.php");
				exit();
			}
			else {
				$_SESSION['message'] = "Mots de passe non identiques";
			}
		}
	}

	mysqli_close($db);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Pokemon - Inscription</title>
		<link rel="stylesheet" type="text/css" href="css/register.css">
		<link rel="icon" href="icon.ico" />
	</head>
	<body>
		<?php 
			if (isset($_SESSION['message'])) {
				echo "<div id='error'>".$_SESSION['message']."</div>";
				unset($_SESSION['message']);
			}
		?>
		<form method="post" action="register.php">
			<div class="register-box">
				<h1>Inscription</h1>
				<div class="textbox">
					<i class="fa fa-user" aria-hidden="true"></i>
					<input required type="text" placeholder="Utilisateur" name="pseudo" />
				</div>
				<div class="textbox">
					<i class="fa fa-lock" aria-hidden="true"></i>
					<input required type="password" placeholder="Mot de passe" name="mdp" />
				</div>
				<div class="textbox">
					<i class="fa fa-lock" aria-hidden="true"></i>
					<input required type="password" placeholder="Confirmation" name="confirm" />
				</div>
				<input type="submit" value="S'inscrire" class="btn"/>
				<a href="login.php" id="accueil" ><input type="button" value="Retour à l'accueil" class="btn" /></a>
			</div>
		</form>
	</body> 
</html>
