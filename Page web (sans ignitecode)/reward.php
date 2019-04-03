<?php
session_start();
include 'fonctions.php';
if(need_reward($_SESSION['num_user'])){
    give_reward_journaliere($_SESSION['num_user']);
    update_last_reward($_SESSION['num_user']);
}
else{
    header("location: home.php");
    exit();
}





 ?>

 <!DOCTYPE html>
 <html lang="fr">
   <head>
     <meta charset="utf-8">
     <title>Pokemon - Reward</title>
   </head>
   <body>
     Vous avez obtenu 50 Pokedollar et 5 Pokeball.
     <br>
     <a href="home.php">Continuer</a>
   </body>
 </html>
