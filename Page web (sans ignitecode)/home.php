<?php 
	session_start();

	if (!isset($_SESSION['login'])) {
		header("location: login.php");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>home.php</title>
		<link rel="stylesheet" type="text/css" href="css/home.css">
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
