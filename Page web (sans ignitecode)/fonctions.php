<?php
  function creer_un_pokemon($num_dresseur, $num_pokemon) {
    $db = mysqli_connect('***REMOVED***', '***REMOVED***', '***REMOVED***', '***REMOVED***');
    $query = "INSERT INTO Pokemon_des_dresseurs(Num_dresseur, Num_pokemon, IV_PV, IV_Attaque, IV_Defense, IV_Attaque_Spe, IV_Defense_Spe, IV_Vitesse) VALUES(".$num_dresseur.", ".$num_pokemon.", ".rand(0,31).", ".rand(0,31).", ".rand(0,31).", ".rand(0,31).", ".rand(0,31).", ".rand(0,31).")";
    mysqli_query($db, $query);
		mysqli_close($db);
	}
  function starter_set($num_dresseur){
    $db = mysqli_connect('***REMOVED***', '***REMOVED***', '***REMOVED***', '***REMOVED***');
    $query = "UPDATE users SET starter = 1 WHERE id =".$num_dresseur.";";
    mysqli_query($db, $query);
		mysqli_close($db);
  }

  function besoin_de_starter($num_dresseur){
    $db = mysqli_connect('***REMOVED***', '***REMOVED***', '***REMOVED***', '***REMOVED***');
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


  ?>
