<?php
session_start();
if (!isset($_SESSION['num_user']) || !isset($_SESSION['login'])) {
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
if (need_reward($_SESSION['num_user'])){
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
        <link rel="stylesheet" type="text/css" href="css/window.css">
    </head>

    <body>
        <div class="row">
                <div class="left">
                        <div id="gerer_equipe">
                            <i class="fa fa-th-large" aria-hidden="true" onclick="afficher_gerer_equipe()"></i>
                        </div>

                        <div id="shop">
                            <i class="fa fa-shopping-cart" aria-hidden="true" onclick=""></i>
                        </div>

                        <div id="profile">
                            <i class="fa fa-user-circle" aria-hidden="true" onclick=""></i>
                        </div>

                        <div id="logout">
                            <a href="redirection.php?disconnect=true" class="link">
                                <i class="fa fa-sign-out-alt" aria-hidden="true"></i>
                            </a>
                        </div>
                </div>

                <div class="center">
                        <p>Le jeu</p>
                </div>

                <div class="right">
                        <div id="add"/>
                            <i class="fa fa-user-plus" aria-hidden="true" onclick=""></i>
                        </div>
                        
                        <h3>Vos amis</h3>
                        
                        <div class="demande_reçus">
                        </div>
                        
                        <div class="status">
                                <div class="online_friends">
                                </div>
                                
                                <div class="offline_friends">
                                </div>
                        </div>
                </div>
            </div>
    </body>
</html>
<script type="text/javascript" src="friends.js"></script>
<script type="text/javascript" src="window.js"></script>
