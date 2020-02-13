<?php

session_start();

if (!isset($_SESSION['num_user']) || !isset($_SESSION['login'])) {
    header("location: redirection.php?disconnect=true");
    exit();
}

include 'fonctions.php';

// Mise à jour de la dernière connexion.
is_connected($_SESSION['num_user']);

// Redirection vers la page de sélection des starters si besoin.
if(besoin_de_starter($_SESSION['num_user']) == 1){
    header("location: starter_selection.php");
    exit();
}

// Redirection vers la page des récompenses quotidiennes.
if (need_reward($_SESSION['num_user'])) {
    header("location: reward.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Pokemon</title>
        <link rel="icon" href="icon.ico" />
        <link rel="stylesheet" type="text/css" href="css/home.css">
        <link rel="stylesheet" type="text/css" href="css/add_friend.css">
        <link rel="stylesheet" type="text/css" href="css/window.css">
        <link rel="stylesheet" type="text/css" href="css/friends.css">
        <link rel="stylesheet" type="text/css" href="css/shop.css">
        <link rel="stylesheet" type="text/css" href="css/canvas.css">
        <link rel="stylesheet" type="text/css" href="css/profile.css">
    </head>

    <body>
        <div class="nav-bar">
            <div id="bar-left">
                <i class="fas fa-bars" id="inventory-side"></i>
            </div>
            <div id="bar-right">
                <i class="fas fa-users" id="friends-side"></i>
            </div>
        </div>

        <div class="row">
            <div class="left">
                <div id="gerer_equipe">
                    <i class="fa fa-th-large" aria-hidden="true" onclick="afficher_gerer_equipe()"></i>
                </div>
                <div id="shop">
                    <i class="fa fa-shopping-cart" aria-hidden="true" onclick="afficherShop()"></i>
                </div>
                <div id="profile">
                    <i class="fa fa-user-circle" aria-hidden="true" onclick="afficherProfil()"></i>
                </div>
                <div id="logout">
                    <a href="redirection.php?disconnect=true" class="link">
                        <i class="fa fa-sign-out-alt" aria-hidden="true"></i>
                    </a>
                </div>
            </div>

            
            <div class="center">
                <div class="canvasctn">
                    <canvas id="zoneJouable" width="720" height="480" style="border:2px solid black;">
                    </canvas>
                    <img id='img1'/>
                    <img id='img2'/>
                    <img id='loading'>
                    <div id='pokeBackHud'>
                    <div class=nomLvl></div> 
                    <div class=pvrestant>
                        <div class="pv_restant_modulable"></div></div>
                    </div>
                    
                    <div id='pokeFrontHud'>
                        <div class=nomLvl></div>
                        <div class=pvrestant><div class="pv_restant_modulable"></div></div>
                    </div>
                    
                    <div class="actionctn">
                        <div id="Attaquer" onclick="showAttaqueMenu()"><div>Attaquer</div></div>
                        <div id="Objet" onclick="showObjMenu()"><div>Objet</div></div>
                        <div id="Equipe" onclick="afficher_gerer_equipe()"><div>Equipe</div></div>
                        <div id="Fuite" onclick="abandon()"><div>Abandon</div></div>
                    </div>
                    
                    <div class="attaquectn">
                        <div class="Attaque"id="Attaque0">
                            <div class="nomAttaque">?????????</div>
                            <div class="PP">??/??</div>
                        </div>
                        <div class="Attaque"id="Attaque1">
                            <div class="nomAttaque">?????????</div>
                            <div class="PP">??/??</div>
                        </div>
                        <div class="Attaque"id="Attaque2">
                            <div class="nomAttaque">?????????</div>
                            <div class="PP">??/??</div>
                        </div>
                        <div class="Attaque"id="Attaque3">
                            <div class="nomAttaque">?????????</div>
                            <div class="PP">??/??</div>
                        </div>
                        <div class="Retour" onclick="showMenu()">&lt-</div>
                    </div>

                    <div class="objctn">
                        <div class="Objet" id="Potion" onclick="UsePotion()">
                            <div class="nomObj">Potion</div>
                            <div class="nbr">??</div>
                        </div>
                        <div class="Objet" id="PokeBall" onclick="UsePokeBall()">
                            <div class="nomObj">PokeBall</div>
                            <div class="nbr">??</div>
                        </div>
                        <div class="Retour" onclick="showMenu()">&lt-</div>
                    </div>
                    
                    <div id="Dialogue">
                        <div id="text"></div>
                        <div id="actionDialogue">
                            <div id="oui">Oui</div>
                            <div id="non">Non</div>
                            <div id="Suivant">-&gt</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="right">
                <div id="add"/>
                    <i class="fa fa-user-plus" aria-hidden="true" onclick="afficherDemandeAmis()"></i>
                </div>
                
                <h3 id="d_amis_titre">Demande d'amis</h3>
                <div class="demande_reçus"></div>
                <h3>Vos amis</h3>
                        
                <div class="status">
                    <div class="online_friends"></div>
                    <div class="offline_friends"></div>
                </div>
            </div>
        </div>
    </body>
</html>

<script type="text/javascript" src="js/friends.js"></script>
<script type="text/javascript" src="js/window.js"></script>
<script type="text/javascript" src="js/shop.js"></script>
<script type="text/javascript" src="js/profile.js"></script>
<script type="text/javascript" src="js/equipe.js"></script>
<script type="text/javascript" src="js/addFriends.js"></script>
<script type="text/javascript" src="js/canvas.js"></script>
