<?php
session_start();
include 'fonctions.php';
if(!besoin_de_starter($_SESSION['num_user'])){
  header("location: home.php");
  exit();
}
 ?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <a href="redirection.php?starter=1">Bulbizarre</a>
    <a href="redirection.php?starter=2">Salaméche</a>
    <a href="redirection.php?starter=3">Carapuce</a>
  </body>
</html>
