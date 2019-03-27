<?php
  function creer_un_pokemon($num_dresseur, $num_pokemon) {
    $db = mysqli_connect('dwarves.iut-fbleau.fr', 'clementa', 'clementa', 'clementa');
    $query = "INSERT INTO Pokemon_des_dresseurs(Num_dresseur, Num_pokemon, IV_PV, IV_Attaque, IV_Defense, IV_Attaque_Spe, IV_Defense_Spe, IV_Vitesse) VALUES(".$num_dresseur.", ".$num_pokemon.", ".rand(0,31).", ".rand(0,31).", ".rand(0,31).", ".rand(0,31).", ".rand(0,31).", ".rand(0,31).")";
    mysqli_query($db, $query);
		mysqli_close($db);
	}
  function starter_set($num_dresseur){
    $db = mysqli_connect('dwarves.iut-fbleau.fr', 'clementa', 'clementa', 'clementa');
    $query = "UPDATE users SET starter = 1 WHERE id =".$num_dresseur.";";
    mysqli_query($db, $query);
		mysqli_close($db);
  }

  function besoin_de_starter($num_dresseur){
    $db = mysqli_connect('dwarves.iut-fbleau.fr', 'clementa', 'clementa', 'clementa');
    $query = "SELECT starter FROM users WHERE id=".$num_dresseur.";";
    $a = mysqli_query($db, $query);
    foreach($a as $enr){
  		$res =  $enr['starter'];
    }
    mysqli_close($db);
    if($res == 0){
      return 1;
    }
    else{
      return 0;
    }
  }
  function is_connected($num_dresseur){
    $db = mysqli_connect('dwarves.iut-fbleau.fr', 'clementa', 'clementa', 'clementa');
    $query = "UPDATE users SET last_connect =".time()." WHERE id=".$num_dresseur.";";
    mysqli_query($db,$query);
    mysqli_close($db);
  }
  function need_reward($num_dresseur){
    $db = mysqli_connect('dwarves.iut-fbleau.fr', 'clementa', 'clementa', 'clementa');
    $query = "SELECT last_connect,last_reward FROM users WHERE id=".$num_dresseur.";";
    $a = mysqli_query($db, $query);
    mysqli_close($db);
    foreach($a as $enr){
        if(($enr['last_reward'] + 86400) < $enr['last_connect']){
          return 1;
        }
        else {
          return 0;
        }
      }
    }
    function check_objet($num_dresseur,$num_objet){
      $db = mysqli_connect('dwarves.iut-fbleau.fr', 'clementa', 'clementa', 'clementa');
      $query = "SELECT qqte FROM Objets_des_dresseurs WHERE num_dresseur=".$num_dresseur." AND num_objet =".$num_objet.";";
      $result = mysqli_query($db,$query);
      mysqli_close($db);
      if (mysqli_num_rows($result) == 1){
        foreach ($result as $row) {
          $qqte=$row['qqte'];
        }
        return $qqte;
      }
      else {
        return 0;
      }
    }
    function add_objet($num_dresseur,$num_objet,$qqte){
      $db = mysqli_connect('dwarves.iut-fbleau.fr', 'clementa', 'clementa', 'clementa');
      $query = "INSERT INTO Objets_des_dresseurs (num_dresseur,num_objet,qqte) VALUES (".$num_dresseur.",".$num_objet.",".$qqte.");";
      mysqli_query($db,$query);
      mysqli_close($db);
    }
    function update_objet($num_dresseur,$num_objet,$qqte){
      $db = mysqli_connect('dwarves.iut-fbleau.fr', 'clementa', 'clementa', 'clementa');
      $query="UPDATE Objets_des_dresseurs SET qqte=".$qqte." WHERE num_dresseur=".$num_dresseur." AND num_objet=".$num_objet.";";
      mysqli_query($db,$query);
      mysqli_close($db);
    }
    function safe_increase_objet($num_dresseur,$num_objet,$ajout){
      $qqte = check_objet($num_dresseur,$num_objet);
      if($qqte == 0){add_objet($num_dresseur,$num_objet,$ajout);}
      else{update_objet($num_dresseur,$num_objet,$qqte+$ajout);}
    }
    function give_reward_journaliere($num_dresseur){
      safe_increase_objet($num_dresseur,13,50);
      safe_increase_objet($num_dresseur,12,5);
    }
    function update_last_reward($num_dresseur){
      $db = mysqli_connect('dwarves.iut-fbleau.fr', 'clementa', 'clementa', 'clementa');
      $query = "UPDATE users SET last_reward =".time()." WHERE id=".$num_dresseur.";";
      mysqli_query($db,$query);
      mysqli_close($db);
    }
  ?>
