<?php
session_start();
include("fonctions.php");


if(isset($_GET['starter'])){
  if(besoin_de_starter($_SESSION['num_user']) == 1){
    create_starter($_GET['starter'],$_SESSION['num_user'],1);
  }
  header("location: home.php");

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
if(isset($_GET['friends'])){
  //is_connected($_SESSION['num_user']);
  if($_GET['friends']=="demande_r"){
    is_connected($_SESSION['num_user']);
    $res=get_demande_amis_reçus($_SESSION['num_user']);
    $rows =array();
    while($r = mysqli_fetch_assoc($res)){
        $rows[] = $r;
    }
    echo json_encode($rows);
    exit();
  }
  if($_GET['friends']=="friend_list"){
    $res = get_friends_list($_SESSION['num_user']);
    $rows = array();
    while($r = mysqli_fetch_assoc($res)){
        $rows[] = $r;
    }
    echo json_encode($rows);
    exit();
  }
}

if(isset($_GET['accepter_demande_r'])){
  accepter_demande_amis($_SESSION["num_user"],$_GET['accepter_demande_r']);
}
if(isset($_GET['refuser_demande_r'])){
  refuser_demande_amis($_SESSION["num_user"],$_GET['refuser_demande_r']);
}
if(isset($_GET['get_users_list'])){
  $res = get_users_list($_SESSION["num_user"],$_SESSION["username"],$_GET['get_users_list']);
  $rows = array();
  while($r = mysqli_fetch_assoc($res)){
      $rows[] = $r;
  }
  echo json_encode($rows);
  exit();
}
if (isset($_GET['add_friend'])){
  add_friends($_GET['add_friend'],$_SESSION['num_user']);
}
?>
