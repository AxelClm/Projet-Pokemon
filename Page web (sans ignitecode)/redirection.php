<?php
session_start();
include("fonctions.php");


if(isset($_GET['starter'])){
  if(besoin_de_starter($_SESSION['num_user']) == 1){
    //if($_https://dwarves.iut-fbleau.fr/~clementa/Projet-Pokemon/Page%20web%20(sans%20ignitecode)/login.phpGET['starter'] == 1 || $_GET['starter'] == 2 || $_GET['starter'] == 3 )
    creer_un_pokemon($_SESSION['num_user'],$_GET['starter']);
    starter_set($_SESSION['num_user']);
  }
  header("location: home.php");
  exit();
}


if(isset($_GET['disconnect'])){
    // Détruit toutes les variables de session
  $_SESSION = array();
  if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(session_name(), '', time() - 42000,
          $params["path"], $params["domain"],
          $params["secure"], $params["httponly"]
      );
  }

  // Finalement, on détruit la session.
  session_destroy();
  header("location: login.php");
  exit();
}
?>
