<?php

session_start();
include 'fonctions.php';

if (!besoin_de_starter($_SESSION['num_user'])) {
    header("location: home.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Pokemon - Starter</title>
        <link rel="stylesheet" type="text/css" href="css/starter.css">
    </head>
    <body>
        <!-- Bulbizarre -->
        <a href="redirection.php?starter=1" id="blbzr"><img src="css/bg1.png"></a>
        <!-- Salamèche -->
        <a href="redirection.php?starter=4" id="slm"><img src="css/bg2.png"></a>
        <!-- Carapuce -->
        <a href="redirection.php?starter=8" id="crpc"><img src="css/bg3.png"></a>
    </body>
</html>
