<?php

session_start();

include 'fonctions.php';

if (need_reward($_SESSION['num_user'])) {
    give_reward_journaliere($_SESSION['num_user']);
    update_last_reward($_SESSION['num_user']);
}
else {
    header("location: home.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Pokemon - Récompense</title>
        <link rel="stylesheet" type="text/css" href="css/reward.css">
        <link rel="icon" href="icon.ico"/>
    </head>
    <body>
        <div class="reward-box">
            <h1>Récompense du jour</h1>
            <div class="reward">
                Vous avez obtenu 50₽ et 5 pokéballs
            </div>
            <a href="home.php" id="home"><input type="button" value="Continuer" class="btn"/></a>
        </div>
   </body>
</html>
