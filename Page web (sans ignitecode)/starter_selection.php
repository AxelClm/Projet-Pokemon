<?php

session_start();
include 'fonctions.php';

if (!besoin_de_starter($_SESSION['num_user'])) {
    echo "Fixing";
    // header("location: home.php");
    // exit();
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
        <div class="background">
            <div id="c1">
                <a href="redirection.php?starter=1"><img src="css/bulbizarre.png" id="bulb"></a>
            </div>
            <div id="c2">
                <a href="redirection.php?starter=4"><img src="css/salameche.png" id="sala"></a>
            </div>
            <div id="c3">
                <a href="redirection.php?starter=8"><img src="css/carapuce.png" id="cara"></a>
            </div>
        </div>
    </body>
</html>
