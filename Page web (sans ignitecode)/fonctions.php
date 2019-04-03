<?php
  function creer_un_pokemon($num_pokemon ,$level){
    $db = mysqli_connect('***REMOVED***', '***REMOVED***', '***REMOVED***', '***REMOVED***');
    $query = "INSERT INTO Pokemon_des_dresseurs(Num_pokemon, IV_PV, IV_Attaque, IV_Defense, IV_Attaque_Spe, IV_Defense_Spe, IV_Vitesse, Niveau) VALUES($num_pokemon,".rand(0,31).", ".rand(0,31).", ".rand(0,31).", ".rand(0,31).", ".rand(0,31).", ".rand(0,31).", ".$level.");";
    mysqli_query($db,$query);
    $a = mysqli_insert_id($db);
    mysqli_close($db);
    return $a;
	}
  function add_pokemon_dresseur($id_pokemon,$num_dresseur){
  	$db = mysqli_connect('***REMOVED***', '***REMOVED***', '***REMOVED***', '***REMOVED***');
    $query = "UPDATE Pokemon_des_dresseurs SET Num_dresseur = $num_dresseur WHERE Id_pokemon = $id_pokemon";
    mysqli_query($db,$query);
    mysqli_close($db);
  }
  function ajouter_equipe_suite($id_pokemon,$num_dresseur){
  	$db = mysqli_connect('***REMOVED***', '***REMOVED***', '***REMOVED***', '***REMOVED***');
  	$last = get_equipe($num_dresseur) + 1;
  	if($last <= 6) {
	  	$query = "UPDATE Pokemon_des_dresseurs SET equipe = 1 , Place_dans_equipe = $last WHERE Id_pokemon = $id_pokemon";
	    mysqli_query($db, $query);
	    mysqli_close($db);
	}
  }
  function create_starter($num_pokemon,$num_dresseur,$level){
  	$poke = creer_un_pokemon($num_pokemon,$level);
  	add_pokemon_dresseur($poke,$num_dresseur);
  	ajouter_equipe_suite($poke,$num_dresseur);
  	starter_set($num_dresseur);
  }
  function get_equipe($num_dresseur){
  	$db = mysqli_connect('***REMOVED***', '***REMOVED***', '***REMOVED***', '***REMOVED***');
    $query = "SELECT Id_pokemon FROM Pokemon_des_dresseurs WHERE Num_dresseur = $num_dresseur AND Equipe = 1";
    $result = mysqli_query($db, $query);
    $re = mysqli_num_rows($result);
    return $re;
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
  		$res = $enr['starter'];
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
    $db = mysqli_connect('***REMOVED***', '***REMOVED***', '***REMOVED***', '***REMOVED***');
    $query = "UPDATE users SET last_connect =".time()." WHERE id=".$num_dresseur.";";
    mysqli_query($db,$query);
    mysqli_close($db);
  }
  function need_reward($num_dresseur){
    $db = mysqli_connect('***REMOVED***', '***REMOVED***', '***REMOVED***', '***REMOVED***');
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
      $db = mysqli_connect('***REMOVED***', '***REMOVED***', '***REMOVED***', '***REMOVED***');
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
      $db = mysqli_connect('***REMOVED***', '***REMOVED***', '***REMOVED***', '***REMOVED***');
      $query = "INSERT INTO Objets_des_dresseurs (num_dresseur,num_objet,qqte) VALUES (".$num_dresseur.",".$num_objet.",".$qqte.");";
      mysqli_query($db,$query);
      mysqli_close($db);
    }
    function update_objet($num_dresseur,$num_objet,$qqte){
      $db = mysqli_connect('***REMOVED***', '***REMOVED***', '***REMOVED***', '***REMOVED***');
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
      $db = mysqli_connect('***REMOVED***', '***REMOVED***', '***REMOVED***', '***REMOVED***');
      $query = "UPDATE users SET last_reward =".time()." WHERE id=".$num_dresseur.";";
      mysqli_query($db,$query);
      mysqli_close($db);
    }
    function get_demande_amis_reçus($id){
      $db = mysqli_connect('***REMOVED***', '***REMOVED***', '***REMOVED***', '***REMOVED***');
      $query = "SELECT users.id,users.username  FROM `friends`,users WHERE friends.friend = users.id and accepte is null and friends.user=".$id.";";
      $res = mysqli_query($db,$query);
      mysqli_close($db);
      return $res;
    }
    function is_friend_relation($user,$friend){
      $db = mysqli_connect('***REMOVED***', '***REMOVED***', '***REMOVED***', '***REMOVED***');
      $query = "SELECT * FROM `friends` WHERE user=".$user." and friend=".$friend.";";
      $res = mysqli_query($db,$query);
      mysqli_close($db);
      if (mysqli_num_rows($res) == 1){
        return 1;
      }
      return 0;
    }
    function add_friends($user,$friend){
      $db = mysqli_connect('***REMOVED***', '***REMOVED***', '***REMOVED***', '***REMOVED***');
      $query ="INSERT INTO friends (user,friend) VALUES ($user,$friend)";
      mysqli_query($db,$query);
      mysqli_close($db);
    }
    function update_friends($user,$friend,$value){
      $db = mysqli_connect('***REMOVED***', '***REMOVED***', '***REMOVED***', '***REMOVED***');
      $query = "UPDATE friends SET accepte = ".$value." WHERE user=".$user." and friend=".$friend.";";
      mysqli_query($db,$query);
      mysqli_close($db);
    }
    function accepter_demande_amis($user,$friend){
      if(is_friend_relation($user,$friend)){
        update_friends($user,$friend,1);
      }
      if(is_friend_relation($friend,$user)){
        update_friends($friend,$user,1);
      }
      else{
        add_friends($friend,$user);
        update_friends($friend,$user,1);
      }
    }
    function refuser_demande_amis($user,$friend){
      if(is_friend_relation($user,$friend)){
        update_friends($user,$friend,0);
      }
      if(is_friend_relation($friend,$user)){
        update_friends($friend,$user,0);
      }
      else{
        add_friends($friend,$user);
        update_friends($friend,$user,0);
      }
    }
    function get_friends_list($user){
      $db = mysqli_connect('***REMOVED***', '***REMOVED***', '***REMOVED***', '***REMOVED***');
      $query = "SELECT users.id,users.username,users.last_connect FROM friends,users WHERE friends.accepte = 1 and friends.user = $user and friends.friend = users.id;";
      $res =  mysqli_query($db,$query);
      mysqli_close($db);
      return $res;
    }
    function get_users_list($num_user,$username,$shema){
      $db = mysqli_connect('***REMOVED***', '***REMOVED***', '***REMOVED***', '***REMOVED***');
      $query = "SELECT username,id FROM users WHERE username LIKE '$shema' AND username != '$username' AND username NOT IN( SELECT username FROM users, friends WHERE friends.user = $num_user AND friends.friend = users.id ) AND username NOT IN( SELECT username FROM users, friends WHERE friends.friend = $num_user AND friends.user = users.id )LIMIT 10";
      $res =  mysqli_query($db,$query);
      mysqli_close($db);
      return $res;
    }
  ?>
