<?php
function connect(){
    return mysqli_connect('***REMOVED***', '***REMOVED***', '***REMOVED***', '***REMOVED***');
}
function creer_un_pokemon($num_pokemon, $level){
    $db = connect();
    $query = "INSERT INTO Pokemon_des_dresseurs(Num_pokemon, IV_PV, IV_Attaque, IV_Defense, IV_Attaque_Spe, IV_Defense_Spe, IV_Vitesse, Niveau) VALUES($num_pokemon,".rand(0,31).", ".rand(0,31).", ".rand(0,31).", ".rand(0,31).", ".rand(0,31).", ".rand(0,31).", 0);";
    mysqli_query($db, $query);    
    $a = mysqli_insert_id($db);
    mysqli_close($db);

    while ($level > 0) {
        pokemonLevelUp($a);
        $level = $level - 1;
    }
    initAttaques($a);
    return $a;
}

function initAttaques($id_pokemon){
    $db = connect();
    $query = "CALL initPremierComp($id_pokemon);";
    mysqli_query($db, $query);
    mysqli_close($db);
}

function pokemonLevelUp($id_pokemon){
    $db = connect();
    $query = "CALL LvlUP($id_pokemon , @out);";
    mysqli_query($db, $query);
    mysqli_close($db);
}

function add_pokemon_dresseur($id_pokemon, $num_dresseur){
   $db = connect();
   $query = "UPDATE Pokemon_des_dresseurs SET Num_dresseur = $num_dresseur WHERE Id_pokemon = $id_pokemon";
   mysqli_query($db,$query);
   mysqli_close($db);
}

function ajouter_equipe_suite($id_pokemon, $num_dresseur){
    $db = connect();
    $last = get_equipe($num_dresseur) + 1;
    if ($last <= 6) {
        $query = "UPDATE Pokemon_des_dresseurs SET equipe = 1 , Place_dans_equipe = $last WHERE Id_pokemon = $id_pokemon";
        mysqli_query($db, $query);
        mysqli_close($db);
    }
}

function create_starter($num_pokemon, $num_dresseur, $level){
    $poke = creer_un_pokemon($num_pokemon, $level);
    add_pokemon_dresseur($poke, $num_dresseur);
    ajouter_equipe_suite($poke, $num_dresseur);
    starter_set($num_dresseur);
}

function get_equipe($num_dresseur){
    $db = connect();
    $query = "SELECT Id_pokemon FROM Pokemon_des_dresseurs WHERE Num_dresseur = $num_dresseur AND Equipe = 1";
    $result = mysqli_query($db, $query);
    $re = mysqli_num_rows($result);
    return $re;
}

function get_equipe2($num_dresseur){
    $db = connect();
    $query = "SELECT Id_pokemon FROM Pokemon_des_dresseurs WHERE Num_dresseur = $num_dresseur AND Equipe = 1 ORDER BY Place_dans_equipe";
    $result = mysqli_query($db, $query);
    return $result;
}

function starter_set($num_dresseur){
    $db = connect();
    $query = "UPDATE users SET starter = 1 WHERE id =".$num_dresseur.";";
    mysqli_query($db, $query);
    mysqli_close($db);
}

function besoin_de_starter($num_dresseur){
    $db = connect();
    $query = "SELECT starter FROM users WHERE id=".$num_dresseur.";";
    $a = mysqli_query($db, $query);
    mysqli_close($db);

    foreach($a as $enr){
        $res = $enr['starter'];
    }
    
    if($res == 0) {
        return 1;
    } else {
        return 0;
    }
}

function is_connected($num_dresseur){
    $db = connect();
    $query = "UPDATE users SET last_connect =".time()." WHERE id=".$num_dresseur.";";
    mysqli_query($db, $query);
    mysqli_close($db);
}

function need_reward($num_dresseur){
    $db = connect();
    $query = "SELECT last_connect, last_reward FROM users WHERE id=".$num_dresseur.";";
    $a = mysqli_query($db, $query);
    mysqli_close($db);

    foreach ($a as $enr){
        if (($enr['last_reward'] + 86400) < $enr['last_connect']) {
            return 1;
        } else {
            return 0;
        }
    }
}

function check_objet($num_dresseur, $num_objet){
    $db = connect();
    $query = "SELECT qqte FROM Objets_des_dresseurs WHERE num_dresseur=".$num_dresseur." AND num_objet =".$num_objet.";";
    $result = mysqli_query($db, $query);
    mysqli_close($db);
    
    if (mysqli_num_rows($result) == 1) {
        foreach ($result as $row) {
            $qqte=$row['qqte'];
        }
        return $qqte;
    } else {
        return 0;
    }
}

function add_objet($num_dresseur, $num_objet, $qqte){
    $db = connect();
    $query = "INSERT INTO Objets_des_dresseurs (num_dresseur, num_objet, qqte) VALUES (".$num_dresseur.", ".$num_objet.", ".$qqte.");";
    mysqli_query($db,$query);
    mysqli_close($db);
}

function update_objet($num_dresseur, $num_objet, $qqte){
    $db = connect();
    $query="UPDATE Objets_des_dresseurs SET qqte=".$qqte." WHERE num_dresseur=".$num_dresseur." AND num_objet=".$num_objet.";";
    mysqli_query($db, $query);
    mysqli_close($db);
}

function safe_increase_objet($num_dresseur, $num_objet, $ajout){
    $qqte = check_objet($num_dresseur, $num_objet);
    if($qqte == 0) {
        add_objet($num_dresseur, $num_objet, $ajout);
    } else {
        update_objet($num_dresseur, $num_objet, $qqte+$ajout);
    }
}

function give_reward_journaliere($num_dresseur){
    safe_increase_objet($num_dresseur, 13, 50);
    safe_increase_objet($num_dresseur, 12, 5);
}

function update_last_reward($num_dresseur){
    $db = connect();
    $query = "UPDATE users SET last_reward =".time()." WHERE id=".$num_dresseur.";";
    mysqli_query($db, $query);
    mysqli_close($db);
}

function get_demande_amis_reçus($id){
    $db = connect();
    $query = "SELECT users.id, users.username FROM `friends`,users WHERE friends.friend = users.id and accepte is null and friends.user=".$id.";";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    return $res;
}

function is_friend_relation($user, $friend){
    $db = connect();
    $query = "SELECT * FROM `friends` WHERE user=".$user." and friend=".$friend.";";
    $res = mysqli_query($db, $query);
    mysqli_close($db);

    if (mysqli_num_rows($res) == 1) {
        return 1;
    }

    return 0;
}

function add_friends($user, $friend){
    $db = connect();
    $query ="INSERT INTO friends (user, friend) VALUES ($user, $friend)";
    mysqli_query($db, $query);
    mysqli_close($db);
}

function update_friends($user, $friend, $value){
    $db = connect();
    $query = "UPDATE friends SET accepte = ".$value." WHERE user=".$user." and friend=".$friend.";";
    mysqli_query($db, $query);
    mysqli_close($db);
}

function accepter_demande_amis($user, $friend){
    if (is_friend_relation($user, $friend)) {
        update_friends($user, $friend, 1);
    }

    if (is_friend_relation($friend, $user)) {
        update_friends($friend, $user, 1);
    } else {
        add_friends($friend, $user);
        update_friends($friend, $user, 1);
    }
}

function refuser_demande_amis($user, $friend){
    if(is_friend_relation($user, $friend)) {
        update_friends($user, $friend, 0);
    }
    
    if(is_friend_relation($friend, $user)){
        update_friends($friend, $user, 0);
    } else {
        add_friends($friend, $user);
        update_friends($friend, $user, 0);
    }
}

function get_friends_list($user){
    $db = connect();
    $query = "SELECT users.id, users.username, users.last_connect, users.map_actuel FROM friends, users WHERE friends.accepte = 1 and friends.user = $user and friends.friend = users.id;";
    $res =  mysqli_query($db, $query);
    mysqli_close($db);
    return $res;
}

function get_users_list($num_user, $username, $shema){
    $db = connect();
    $shema = mysqli_real_escape_string($db, $shema);
    $query = "SELECT username,id FROM users WHERE username LIKE '$shema' AND username != '$username' AND username NOT IN( SELECT username FROM users, friends WHERE friends.user = $num_user AND friends.friend = users.id ) AND username NOT IN( SELECT username FROM users, friends WHERE friends.friend = $num_user AND friends.user = users.id )LIMIT 10";
    $res =  mysqli_query($db, $query);
    mysqli_close($db);
    return $res;
}
function get_pokemon_equipe($num_user){
    $db = connect();
    $query = "SELECT
        Pokemon.Nom,
        Pokemon_des_dresseurs.Id_pokemon,
        Pokemon_des_dresseurs.Num_pokemon,
        Pokemon_des_dresseurs.Place_dans_equipe,
        Pokemon_des_dresseurs.Niveau
    FROM
        Pokemon_des_dresseurs,
        Pokemon
    WHERE
        Pokemon_des_dresseurs.Equipe = 1 AND Pokemon_des_dresseurs.Num_dresseur = $num_user AND Pokemon_des_dresseurs.Num_pokemon = Pokemon.Num
    ORDER BY Pokemon_des_dresseurs.Place_dans_equipe";
    $res =  mysqli_query($db, $query);
    mysqli_close($db);
    return $res;
}
function get_pokemon_boite($num_user){
    $db = connect();
    $query = "SELECT
        Pokemon.Nom,
        Pokemon_des_dresseurs.Id_pokemon,
        Pokemon_des_dresseurs.Num_pokemon,
        Pokemon_des_dresseurs.Place_dans_equipe,
        Pokemon_des_dresseurs.Niveau
    FROM
        Pokemon_des_dresseurs,
        Pokemon
    WHERE
        Pokemon_des_dresseurs.Num_dresseur = $num_user AND Pokemon_des_dresseurs.Num_pokemon = Pokemon.Num AND Pokemon_des_dresseurs.Id_pokemon NOT IN
        (
        SELECT
            Pokemon_des_dresseurs.Id_pokemon
        FROM
            Pokemon_des_dresseurs
        WHERE
            Pokemon_des_dresseurs.Equipe = 1 AND Pokemon_des_dresseurs.Num_dresseur = $num_user
        )";
    $res =  mysqli_query($db,$query);
    mysqli_close($db);
    return $res;
}
function pokemon_is_in_equipe($num_user, $num_pokemon){
    $db = connect();
    $query = "
    SELECT
        Id_pokemon
    FROM
        `Pokemon_des_dresseurs`
    WHERE
        Id_pokemon = $num_pokemon AND Num_dresseur = $num_user AND equipe = 1;";
    $res =  mysqli_query($db, $query);
    mysqli_close($db);
    if (mysqli_num_rows($res) == 1) {
        return 1;
    }
    return 0;
}
function pokemon_is_in_boite($num_user, $num_pokemon){
    $db = connect();
    $query = "
    SELECT
        Id_pokemon
    FROM
        `Pokemon_des_dresseurs`
    WHERE
        Id_pokemon = $num_pokemon AND Num_dresseur = $num_user AND Equipe = 0;";
    $res =  mysqli_query($db, $query);
    mysqli_close($db);
    if (mysqli_num_rows($res) == 1) {
        return 1;
    }
    return 0;
}

function swap_pokemon_equipe($num_user, $num_pokemon1, $num_pokemon2){
    //On commence par verifier que les pokemon soient bien dans l'équipe du dresseur
    if (pokemon_is_in_equipe($num_user, $num_pokemon1) != 1 || pokemon_is_in_equipe($num_user, $num_pokemon2) != 1) {
        exit();
    }

    $db = connect();
    $query = "CALL Pokemon_swap_equipe($num_pokemon1, $num_pokemon2);";
    mysqli_query($db, $query);
    mysqli_close($db);
}

function pokemon_vers_boite($num_user, $num_pokemon){
    if (pokemon_is_in_equipe($num_user, $num_pokemon) != 1) {
        exit();
    }
    $db = connect();
    $query = "CALL pokemon_vers_boite($num_user, $num_pokemon);";
    mysqli_query($db, $query);
    mysqli_close($db);
}

function boite_vers_equipe($num_user, $num_pokemon){
    if (pokemon_is_in_equipe($num_user, $num_pokemon)){ 
        exit();
    }
    $db = connect();
    $query = "CALL pokemon_vers_equipe($num_user, $num_pokemon);";
    mysqli_query($db, $query);
    mysqli_close($db);
}

function get_pokemon_hp($num_pokemon){
    $db = connect();
    $query = "CALL get_pokemon_hp($num_pokemon,@hpmax,@hp);";
    mysqli_query($db, $query);
    $query = "SELECT @hpmax as HPmax , @hp as HP;";
    $res = mysqli_query($db, $query);  
    mysqli_close($db);
    return $res;
}

// ===== Shop functions ===== //

function getItemInformations() {
    $db = connect();
    $query = "SELECT * FROM Objets WHERE Num <> 13";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    return $res;
}

function getArgentDresseur($num) {
    $db = connect();
    $query = "SELECT qqte FROM Objets_des_dresseurs WHERE num_dresseur=$num AND num_objet=13"; // num_objet = 13 correspond au Pokédollar
    $res = mysqli_query($db, $query);
    mysqli_close($db);

    if (mysqli_num_rows($res) == 1) {
        foreach ($res as $enr) {
            $money = $enr['qqte'];
        }
        return $money;
    } else {
        return 0;
    }
}
function getObjetNom($idObjet){
    $db = connect();
    $query = "SELECT Nom FROM Objets WHERE Num = $idObjet";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    foreach ($res as $enr) {
        return $enr["Nom"];
    }
}
function getPrixObjet($num) {
    $db = connect();
    $query = "SELECT Prix FROM Objets WHERE Num=$num";
    $res = mysqli_query($db, $query);
    mysqli_close($db);

    foreach ($res as $enr) {
        $price = $enr['Prix'];
    }

    return $price;
}

function updateArgentDresseur($num_dresseur, $num_objet) {
    $db = connect();
    $query = "UPDATE Objets_des_dresseurs SET qqte = qqte - (SELECT Prix FROM Objets WHERE Num=$num_objet) WHERE num_dresseur=$num_dresseur AND num_objet=13;";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    return $res;
}

function ajouterObjetDresseur($num_dresseur, $num_objet) {
    $db = connect();
    $query = "SELECT * FROM Objets_des_dresseurs WHERE num_dresseur=$num_dresseur AND num_objet=$num_objet";
    $res = mysqli_query($db, $query);
    mysqli_close($db);

    if (mysqli_num_rows($res) == 0) {
        if (getArgentDresseur($num_dresseur) >= getPrixObjet($num_objet)) {
            ajouterObjetQueDresseurNaPas($num_dresseur, $num_objet);
            updateArgentDresseur($num_dresseur, $num_objet);
        }
    } else {
        if (getArgentDresseur($num_dresseur) >= getPrixObjet($num_objet)) {
            ajouterObjetQueDresseurADeja($num_dresseur, $num_objet);
            updateArgentDresseur($num_dresseur, $num_objet);
        }
    }
}

function ajouterObjetQueDresseurNaPas($num_dresseur, $num_objet) {
    $db = connect();
    $query = "INSERT INTO Objets_des_dresseurs(num_dresseur, num_objet, qqte) VALUES ($num_dresseur, $num_objet, 1)";
    mysqli_query($db, $query);
    mysqli_close($db);
}

function ajouterObjetQueDresseurADeja($num_dresseur, $num_objet) {
    $db = connect();
    $query = "UPDATE Objets_des_dresseurs SET qqte=qqte+1 WHERE num_dresseur=$num_dresseur AND num_objet=$num_objet";
    mysqli_query($db, $query);
    mysqli_close($db);
}

// ===== Profile functions ===== //

function getNombreCombat($num) {
    $db = connect();
    $query = "SELECT COUNT(*) AS total FROM CombatEnCours WHERE User1=$num OR User2=$num";
    $res = mysqli_query($db, $query);
    $count = mysqli_fetch_assoc($res);
    $count = $count['total'];
    mysqli_close($db);
    return $count;
}

function getNbPokemonDresseur($num) {
    $db = connect();
    $query = "SELECT COUNT(*) AS total FROM Pokemon_des_dresseurs WHERE Num_dresseur=$num";
    $res = mysqli_query($db, $query);
    $count = mysqli_fetch_assoc($res);
    $count = $count['total'];
    mysqli_close($db);
    return $count;
}

function getNbVictoire($num) {
    $db = connect();
    
    $query = "SELECT COUNT(*) AS total FROM CombatEnCours WHERE User1=$num AND User1Gagne=1";
    $res = mysqli_query($db, $query);
    $a = mysqli_fetch_assoc($res);
    $a = $a['total'];

    $query = "SELECT COUNT(*) AS total FROM CombatEnCours WHERE User2=$num AND User1Gagne=0";
    $res = mysqli_query($db, $query);
    $b = mysqli_fetch_assoc($res);
    $b = $b['total'];
    mysqli_close($db);

    $count = $a + $b;
    return $count;
}

function getNbDefaite($num) {
    $db = connect();
    
    $query = "SELECT COUNT(*) AS total FROM CombatEnCours WHERE User1=$num AND User1Gagne=0";
    $res = mysqli_query($db, $query);
    $a = mysqli_fetch_assoc($res);
    $a = $a['total'];

    $query = "SELECT COUNT(*) AS total FROM CombatEnCours WHERE User2=$num AND User1Gagne=1";
    $res = mysqli_query($db, $query);
    $b = mysqli_fetch_assoc($res);
    $b = $b['total'];
    mysqli_close($db);

    $count = $a + $b;
    return $count;
}

function getRatioVictoire($num) {
    $ttl = getNombreCombat($num);
    
    if ($ttl == 0) {
        return 0;
    }

    $ratio = (getNbVictoire($num) / $ttl) * 100;
    return round($ratio, 2);
}

function getDateInscription($num) {
    $db = connect();
    $query = "SELECT dateInscription FROM users WHERE id=$num";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    
    foreach ($res as $enr) {
        $date = $enr['dateInscription'];
    }
    
    return $date;
}

function getObjetsDresseur($num) {
    $db = connect();
    $query = "SELECT Objets.Nom, Objets_des_dresseurs.num_objet, Objets_des_dresseurs.qqte FROM Objets, Objets_des_dresseurs WHERE Objets.Num = Objets_des_dresseurs.num_objet AND Objets_des_dresseurs.num_objet <> 13 AND Objets.Num <> 13 AND Objets_des_dresseurs.num_dresseur=$num AND Objets_des_dresseurs.qqte > 0";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    return $res;
}

function getPokedex() {
    $db = connect();
    $query = "SELECT Num, Nom FROM Pokemon";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    return $res;
}

// ===== Combat functions ===== //

function isPokemonMort($numPokemon){
    $res = get_pokemon_hp($numPokemon);
    foreach ($res as $enr) {
        if ($enr['HP'] < 0) {
            return 1;
        } else {
            return 0;
        }
    }
}

function updateDRTime($user){
    $time = time();
    $db = connect();
    $query = "UPDATE users SET derniereRencontre = $time WHERE id = $user;";
    mysqli_query($db, $query);
    mysqli_close($db);
}
function peutFaireUneAutreRencontre($id, $map){
    $db = connect();
    $query = "SELECT map_actuel, derniereRencontre, EnCombat FROM users WHERE id = $id";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    foreach ($res as $enr) {
        if (($enr["derniereRencontre"] + 20) < time() && $enr["map_actuel"] == $map && $enr["EnCombat"] == 0) {
            return 1;
        } else {
            return 0;
        }
    }
}
function saveCoordMap($id, $coordX, $coordY){
    $db = connect();
    $query = "UPDATE users SET coordX_last = $coordX ,coordY_last =$coordY WHERE id =$id ;";
    mysqli_query($db, $query);  
    mysqli_close($db);
}
function getCoordMap($user){
    $db = connect();
    $query = "SELECT map_actuel, coordX_last, coordY_last FROM users WHERE id = $user";
    $res = mysqli_query($db, $query);  
    mysqli_close($db);
    return $res;
}
function unsetCombatState($id){
    $db = connect();
    $query= "UPDATE users SET EnCombat = 0 WHERE id = $id";
    mysqli_query($db, $query);  
    mysqli_close($db);
}
function setCombatState($id){
    $db = connect();
    $query= "UPDATE users SET EnCombat = 1 WHERE id = $id";
    mysqli_query($db, $query);  
    mysqli_close($db);
}
function instancierCombatPokeSauvage($id, $idpoke){
    $db = connect();
    $query = "INSERT INTO CombatEnCours(User1,User2,PokemonSauvage,Tours,PokemonActuelEquipe1,PokemonActuelEquipe2) VALUES ($id,null,$idpoke,0,(SELECT Id_pokemon FROM Pokemon_des_dresseurs WHERE Place_dans_equipe = 1 AND Equipe = 1 AND Num_dresseur = $id),null);";
    mysqli_query($db, $query);  
    mysqli_close($db);
}
function instancierCombatContreJoueur($user1, $user2){
    $db = connect();
    $query = "INSERT INTO CombatEnCours(User1,User2,Tours,PokemonActuelEquipe1) VALUES ($user1,$user2,0,(SELECT Id_pokemon FROM Pokemon_des_dresseurs WHERE Place_dans_equipe = 1 AND Equipe = 1 AND Num_dresseur = $user1));";
    mysqli_query($db, $query);  
    mysqli_close($db);
}
function isCombatStateOn($id){
    $db = connect();
    $query ="SELECT EnCombat FROM users WHERE id = $id";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    if (mysqli_num_rows($res) != 0) {
        foreach($res as $enr) {
            $test = $enr["EnCombat"];
        }
        if ($test == 1) {
            return 1;
        } else {
            return 0;
        }
    }
}
function pokemonSauvageVersIdCombat($id){
    $db = connect();
    $query = "SELECT idCombat FROM CombatEnCours WHERE PokemonSauvage = $id AND User1Gagne is null";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    foreach ($res as $enr) {
        return $enr["idCombat"];   
    }
}
function BeginCombatContreJoueur($user1, $user2){
    if (isCombatStateOn($user1) == 1 || isCombatStateOn($user2) == 1) {
        exit();
    }
    instancierCombatContreJoueur($user1, $user2);
    updatePokemon1(getIdCombatByUser($user1), getLastPokemonAlive($user1));
    updatePokemon2(getIdCombatByUser($user2), getLastPokemonAlive($user2));
    setCombatState($user1);
    setCombatState($user2);
}
function getMoyenneEquipe($user){
    $db = connect();
    $query = "SELECT AVG(Niveau) AS Moyenne FROM Pokemon_des_dresseurs WHERE Num_dresseur = $user AND Equipe = 1 ";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    foreach ($res as $enr){
        return $enr["Moyenne"];   
    }
}
function BeginCombatPokeSauvage($id){
    $oui = getMoyenneEquipe($id);
    $pokeSauvage = creer_un_pokemon(rand(1, 151), $oui);
    instancierCombatPokeSauvage($id, $pokeSauvage);
    setCombatState($id);
    updatePokemon1(getIdCombatByUser($id), getLastPokemonAlive($id));
    PokeSauvageAttaque($pokeSauvage, pokemonSauvageVersIdCombat($pokeSauvage));
    
}
function idPokemonVersNum($idPokemon){
    $db = connect();
    $query = "SELECT Pokemon_des_dresseurs.Num_pokemon FROM Pokemon_des_dresseurs WHERE Pokemon_des_dresseurs.Id_pokemon = $idPokemon";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    foreach ($res as $enr) {
        return $enr["Num_pokemon"];   
    }
}
function idPokemonVersName($idPokemon){
    $db = connect();
    $query = "SELECT Pokemon.Nom from Pokemon WHERE Pokemon.Num = (SELECT Num_pokemon From Pokemon_des_dresseurs WHERE Pokemon_des_dresseurs.Id_pokemon = $idPokemon)";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    foreach ($res as $enr) {
        return $enr["Nom"];   
    }
}
function idPokemonVersLvl($idPokemon){
    $db = connect();
    $query = "SELECT Niveau FROM Pokemon_des_dresseurs WHERE Id_pokemon = $idPokemon";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    foreach ($res as $enr) {
        return $enr["Niveau"];   
    }
}
function aPerdu($num_user){
    $db = connect();
    $query = "SELECT idCombat,User1,User2,PokemonSauvage FROM CombatEnCours WHERE User1 = $num_user  AND User1Gagne is null;";
    $res = mysqli_query($db, $query);
    $user=1;
    $PokemonSauvage = null;

    if (mysqli_num_rows($res) == 0) {
        $query = "SELECT idCombat,User1,User2 FROM CombatEnCours WHERE User2 = $num_user  AND User1Gagne is null;";
        $res = mysqli_query($db, $query);
        if (mysqli_num_rows($res) == 0) {
            mysqli_close($db);
            exit();
        }
        $user=2;
    }

    if ($user==1) {
        foreach ($res as $enr) {
            $user1 = $enr["User1"];
            $user2 = $enr["User2"];
            $PokemonSauvage = $enr["PokemonSauvage"];
        }
        $query = "UPDATE CombatEnCours SET User1Gagne = 0 WHERE User1 = $user1 AND User1Gagne is null;";
        mysqli_query($db, $query);
    }

    if ($user==2) {
        foreach ($res as $enr) {
            $user2 = $enr["User1"];
            $user1 = $enr["User2"];
            unsetCombatState($user2);
        }
        $query = "UPDATE CombatEnCours SET User1Gagne = 1 WHERE User2 = $user1 AND User1Gagne is null;";
        mysqli_query($db, $query);
    }

    if ($PokemonSauvage != null) {
        unsetCombatState($user1);
        updateDRTime($user1);
    } else {
        unsetCombatState($user1);
        unsetCombatState($user2);
    }

    soignerPokemon($num_user);
    changeMap($num_user, "Lobby");
    mysqli_close($db);
    return $res;
}
function getPokemonSortie($id){
    $db = connect();
    $query = "SELECT * FROM CombatEnCours WHERE (User1 = $id OR User2 = $id) AND User1Gagne is null";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    return $res;
}
function getAttaquePokemon($idPokemon){
    $db = connect();
    $query = "SELECT Capacite.Nom,Capacite.Num,CapaciteChoix.PPUtilise,Capacite.PP From CapaciteChoix,Capacite WHERE Capacite.Num = CapaciteChoix.Capacite AND CapaciteChoix.Pokemon = $idPokemon AND CapaciteChoix.Choix = 1;";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    return $res;
}

function updatePPUtilise($idPokemon, $idAttaque) {
    $db = connect();
    $query = "UPDATE CapaciteChoix SET PPUtilise=PPUtilise+1 WHERE Pokemon=$idPokemon AND Capacite=$idAttaque";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
}

function peutUtiliserAttaque($idPokemon,$idAttaque){
    $db = connect();
    $query = "SELECT PPUtilise,PP FROM CapaciteChoix,Capacite WHERE CapaciteChoix.Choix = 1 AND CapaciteChoix.Capacite = Capacite.Num AND CapaciteChoix.Pokemon = $idPokemon AND CapaciteChoix.Capacite = $idAttaque;";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    foreach ($res as $enr) {
        if ($enr["PP"] - $enr["PPUtilise"] < 1) {
            return 0;
        } else {
            return 1;
        }
    }
}

function TourActuel($idCombat){
    $db = connect();
    $query = "SELECT Tours FROM CombatEnCours WHERE idCombat = $idCombat LIMIT 1;";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    if (!$res) {
        return 0;
    }
    foreach ($res as $enr) {
        return $enr['Tours'];
    }
}
function aDejaAttaquer($idPokemon, $idCombat){
    $db = connect();
    $query = "SELECT Tour FROM CombatHistorique WHERE idCombat = $idCombat AND Pokemon = $idPokemon ORDER BY Tour  DESC LIMIT 1;";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    
    if (mysqli_num_rows($res) == 0) {
        return 0;
    } else {
        foreach ($res as $enr) {
            $DTour = $enr['Tour'];
        }
        
        if ($DTour < TourActuel($idCombat)) {
            return 0;
        } else {
            return 1;
        }
    }
}
function estLePokemonSortie($idPokemon, $idCombat){
    $db = connect();
    $query = "SELECT * FROM `CombatEnCours` WHERE (PokemonActuelEquipe1 = $idPokemon OR PokemonActuelEquipe2 = $idPokemon OR PokemonSauvage = $idPokemon) AND idCombat = $idCombat;";
    $res = mysqli_query($db,$query);
    mysqli_close($db);
    if (mysqli_num_rows($res) == 1) {
        return 1;
    } else {
        return 0;
    }
}
function rowObj($idObjet, $Reussi, $idCombat, $PokemonCible, $idPokemon){
    $db = connect();
    $Tour = TourActuel($idCombat);
    $query = "INSERT INTO CombatHistorique(idCombat,Tour,Pokemon,PokemonCible,ObjetUtiliser,ObjetReussis) VALUES ($idCombat,$Tour,$idPokemon,$PokemonCible,$idObjet,$Reussi);";
    mysqli_query($db, $query);
    mysqli_close($db);
}
function rowSwap($idPokemon, $idCombat, $PokemonCible){
    $db = connect();
    $Tour = TourActuel($idCombat);
    $query = "INSERT INTO CombatHistorique(idCombat,Tour,Pokemon,PokemonCible,SwapPokemon) VALUES ($idCombat,$Tour,$idPokemon,$PokemonCible,$PokemonCible);";
    echo $query;
    mysqli_query($db, $query);
    mysqli_close($db);
}
function utiliseAttaque($idPokemon, $idAttaque, $idCombat, $PokemonCible){
    if (estLePokemonSortie($idPokemon, $idCombat) == 1 && estLePokemonSortie($PokemonCible, $idCombat) == 1 && aDejaAttaquer($idPokemon, $idCombat) == 0
        && peutUtiliserAttaque($idPokemon, $idAttaque) == 1) {
        $Tour = TourActuel($idCombat);
        $db = connect();
        $query = "INSERT INTO CombatHistorique(idCombat,Tour,Pokemon,PokemonCible,AttaqueEffectue,AttaqueReussi)VALUES 
                  ($idCombat,$Tour,$idPokemon,$PokemonCible,$idAttaque,1)";
        mysqli_query($db, $query);
        mysqli_close($db);
        
        updatePPUtilise($idPokemon, $idAttaque);
    }
}
function PokeSauvageAdversaire($idPokemon){
    $db = connect();
    $query = "SELECT PokemonActuelEquipe1 FROM CombatEnCours WHERE PokemonSauvage = $idPokemon AND User1Gagne is null ";
    $res = mysqli_query($db, $query);
    foreach ($res as $enr) {
        return $enr["PokemonActuelEquipe1"];
    }
}

function PokeSauvageAttaque($idPokemon,$idCombat) {
    $PokemonCible = PokeSauvageAdversaire($idPokemon);
    $res = getAttaquePokemon($idPokemon);
    $BorneRandMax = mysqli_num_rows($res) - 1;
    //echo " ".$BorneRandMax." ".$idPokemon;
    $rows = array();
    while ($r = mysqli_fetch_assoc($res)) {
        $rows[] = $r;
    }
    //echo json_encode($rows);
    utiliseAttaque($idPokemon, $rows[rand(0,$BorneRandMax)]['Num'],$idCombat,$PokemonCible);    
}

function getPokemonSauvageByIdCombat($idCombat) {
    $db = connect();
    $query = "SELECT PokemonSauvage FROM CombatEnCours WHERE idCombat = $idCombat";
    $res = mysqli_query($db,$query);
    mysqli_close($db);
    foreach ($res as $enr) {
        return $enr["PokemonSauvage"];
    }
}

function SelectPokemon1($idCombat) {
    $db = connect();
    $query = "SELECT PokemonActuelEquipe1 FROM CombatEnCours WHERE idCombat = $idCombat";
    $res = mysqli_query($db,$query);
    mysqli_close($db);
    foreach ($res as $enr) {
        return $enr["PokemonActuelEquipe1"];
    }
}

function SelectPokemon2($idCombat) {
    $db = connect();
    $query = "SELECT PokemonActuelEquipe2 FROM CombatEnCours WHERE idCombat = $idCombat";
    $res = mysqli_query($db,$query);
    mysqli_close($db);
    foreach ($res as $enr) {
        return $enr["PokemonActuelEquipe2"];
    }
}

function AttaquerPokemonSauvage($idAttaque, $idPokemon, $idCombat) {
    $PokeCible = getPokemonSauvageByIdCombat($idCombat);
    utiliseAttaque($idPokemon, $idAttaque, $idCombat, $PokeCible);
    newTour($idCombat);
}

function AttaquerPokemonJoueur($idAttaque, $idCombat, $userA){
    $User1 = getUser1byiC($idCombat);
    
    if($User1 == $userA) {
        $pokeA = SelectPokemon1($idCombat);
        $pokeD = SelectPokemon2($idCombat);
        utiliseAttaque($pokeA,$idAttaque,$idCombat,$pokeD);
    } else {
        $pokeA = SelectPokemon2($idCombat);
        $pokeD = SelectPokemon1($idCombat);
        utiliseAttaque($pokeA,$idAttaque,$idCombat,$pokeD);
    }
}

function getIdCombatByUser($id) {
    $db =  connect();
    $query = "SELECT idCombat FROM CombatEnCours WHERE (User1 = $id OR User2 = $id) AND User1Gagne is null";
    $res = mysqli_query($db,$query);
    mysqli_close($db);
    foreach ($res as $enr) {
        return $enr["idCombat"];
    }
}

function canLaunchANewTour($idCombat, $tour) {
    $db = connect();
    $query = "SELECT * FROM CombatHistorique WHERE idCombat = $idCombat AND Tour = $tour";
    $res = mysqli_query($db,$query);
    mysqli_close($db);
    
    if (mysqli_num_rows($res) == 2){
        return 1;
    } else {
        return 0;
    }
}
function getActionByTour($idCombat, $tour) {
    $db = connect();
    $query = "SELECT * FROM CombatHistorique WHERE idCombat = $idCombat AND Tour = $tour";
    $res = mysqli_query($db,$query);
    mysqli_close($db);
    $rows = array();
    while ($r = mysqli_fetch_assoc($res)){
        $rows[] = $r;
    }
    return $rows;
}
function getInformationPokemons($poke1, $poke2){
    $db = connect();
    if ($poke1 > $poke2) {
    $query = "SELECT * FROM Pokemon_des_dresseurs,Stat_basique_pokemon,Pokemon WHERE Stat_basique_pokemon.Num = Pokemon_des_dresseurs.Num_pokemon AND Pokemon_des_dresseurs.Num_pokemon = Pokemon.Num AND (Id_pokemon = $poke1 OR Id_pokemon = $poke2) ORDER BY Id_pokemon DESC";
    } else {
         $query = "SELECT * FROM Pokemon_des_dresseurs,Stat_basique_pokemon,Pokemon WHERE Stat_basique_pokemon.Num = Pokemon_des_dresseurs.Num_pokemon AND Pokemon_des_dresseurs.Num_pokemon = Pokemon.Num AND (Id_pokemon = $poke1 OR Id_pokemon = $poke2) ORDER BY Id_pokemon ASC";
    }
    $res = mysqli_query($db,$query);
    mysqli_close($db);
    $rows = array();
    while ($r = mysqli_fetch_assoc($res)) {
        $rows[] = $r;
    }
    return $rows;
}
function getMultiplicateurType($type1, $type2){
    if ($type1 != null) {
        $db = connect();
        $query = "SELECT Multiplicateur FROM `Faiblesse_et_Resistances` WHERE Type_defensif = $type1 AND Type_offensif = $type2";
        $res = mysqli_query($db,$query);
        mysqli_close($db);
        foreach ($res as $enr) {
            return $enr['Multiplicateur'];
        }
    } else {
        return 1;
    }
}
function DegatNormal($idAttaque, $Pokemons, $indexA, $indexD){
    if ($idAttaque != null) {
        $db = connect();
        $query = "SELECT * FROM Capacite WHERE Capacite.Num = $idAttaque ";
        $res = mysqli_query($db,$query);
        foreach ($res as $enr) {
            $multi=getMultiplicateurType($Pokemons[$indexD]["Type_1"],$enr["Type"]) * getMultiplicateurType($Pokemons[$indexD]["Type_2"],$enr["Type"]);
            $rng = rand(85,100)/100;
            if ($enr["Type_capacite"] == 1) {
                $degatSubis = ($Pokemons[$indexA]["Niveau"] * 0.4 + 2) * (($Pokemons[$indexA]["IV_Attaque"] + $Pokemons[$indexA]["BonusAttaque"] + $Pokemons[$indexA]["Attaque"]) * $Pokemons[$indexA]["Niveau"]) * ($enr["Puissance"]);
                $degatSubis = $degatSubis/(($Pokemons[$indexD]["IV_Defense"] + $Pokemons[$indexD]["BonusDefense"] + $Pokemons[$indexD]["Defense"])* $Pokemons[$indexD]["Niveau"]*50);
                echo $degatSubis;
                $degatSubis = ($degatSubis + 2) * $multi * $rng;
            }
            if ($enr["Type_capacite"] == 2) {
                $degatSubis = ($Pokemons[$indexA]["Niveau"] * 0.4 + 2) * (($Pokemons[$indexA]["IV_Attaque_Spe"] + $Pokemons[$indexA]["BonusAttaque"] + $Pokemons[$indexA]["Attaque_Spe"]) * $Pokemons[$indexA]["Niveau"]) * ($enr["Puissance"]);
                $degatSubis = $degatSubis/(($Pokemons[$indexD]["IV_Defense_Spe"] + $Pokemons[$indexD]["BonusDefense"] + $Pokemons[$indexD]["Defense_Spe"]) * $Pokemons[$indexD]["Niveau"]*50);
                echo $degatSubis;
                $degatSubis = ($degatSubis + 2) * $multi * $rng;
            }
        $pokeA = $Pokemons[$indexA]["Id_pokemon"];
        $pokeD = $Pokemons[$indexD]["Id_pokemon"];
        echo "Degat Subis par $pokeD de $pokeA = $degatSubis avec l'attaque $idAttaque multi : $multi et rng : $rng\n";
        $idCible = $Pokemons[$indexD]['Id_pokemon'];
        $query = "UPDATE Pokemon_des_dresseurs SET degat_subis = degat_subis + $degatSubis WHERE Id_pokemon = $idCible ";
        mysqli_query($db, $query);
        mysqli_close($db);
        }
    }
}

function getLastPokemonAlive($user) {
    $db = connect();
    $query = "SELECT
        Pokemon_des_dresseurs.Id_pokemon
    FROM
        Pokemon_des_dresseurs,
        Pokemon,
        Stat_basique_pokemon
    WHERE
        Pokemon_des_dresseurs.Equipe = 1 AND Pokemon_des_dresseurs.Num_dresseur = $user AND Pokemon_des_dresseurs.Num_pokemon = Pokemon.Num AND Stat_basique_pokemon.Num = Pokemon_des_dresseurs.Num_pokemon AND Pokemon_des_dresseurs.degat_subis < (Pokemon_des_dresseurs.IV_PV + Stat_basique_pokemon.PV)
    ORDER BY Pokemon_des_dresseurs.Place_dans_equipe";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    if (mysqli_num_rows($res) == 0) {
        return null;
    }
    foreach ($res as $enr) {
        return $enr["Id_pokemon"];
    }

}
function getUser1byiC($idCombat){
    $db = connect();
    $query = "SELECT User1 FROM `CombatEnCours` WHERE idCombat = $idCombat";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    foreach ($res as $enr) {
        return $enr['User1'];
    }
}
function getUser2byiC($idCombat){
    $db = connect();
    $query = "SELECT User2 FROM `CombatEnCours` WHERE idCombat = $idCombat";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    foreach ($res as $enr) {
        return $enr['User2'];
    }
}
function TourUp($idCombat){
    $db = connect();
    $query = "UPDATE CombatEnCours SET Tours = Tours + 1 WHERE idCombat = $idCombat";
    mysqli_query($db, $query);
    mysqli_close($db);
}
function updatePokemon1($idCombat, $idPokemon){
    $db = connect();
    $query = "UPDATE CombatEnCours SET PokemonActuelEquipe1 = $idPokemon WHERE idCombat = $idCombat";
    mysqli_query($db, $query);
    mysqli_close($db);
}
function updatePokemon2($idCombat, $idPokemon){
    $db = connect();
    $query = "UPDATE CombatEnCours SET PokemonActuelEquipe2 = $idPokemon WHERE idCombat = $idCombat";
    mysqli_query($db, $query);
    mysqli_close($db);
}
function gagneXp($PokeCible, $niveauTue){
    $db = connect();
    $xp = $niveauTue/7 * 300 *(rand(80,150)/100);
    echo $xp;
    $query = "CALL AjouterXp($PokeCible,$xp)";
    mysqli_query($db, $query);
    mysqli_close($db);
} 
function afterACombat($user){
    if (getLastPokemonAlive($user) == null) {
        $db = connect();
        $query = "UPDATE users SET  map_actuel = 'Lobby' , coordX_last = null , coordY_last = null WHERE id = $user";
        mysqli_query($db, $query);
        mysqli_close($db);
    }
}
function putLancement($idCombat, $pokemon, $tour, $lancement){
        $db = connect();
        $query = "UPDATE CombatHistorique SET Lancement = $lancement WHERE idCombat = $idCombat AND Tour = $tour AND Pokemon = $pokemon";
        mysqli_query($db, $query);
        mysqli_close($db);
}
function newTour($idCombat){
    //On commence par Calculer les degats effectués
    //Pour se faire il faut recuperer les deux actions effectués
    $action = getActionByTour($idCombat, TourActuel($idCombat));
    //On recupere les pokemon liés aux actions;
    $action0L = 0;
    $action1L = 0;
    if ($action[0]["SwapPokemon"] != null) {
        $action0L = 1;
        putLancement($idCombat,$action[0]["Pokemon"],TourActuel($idCombat),$action0L);
        $action[0]['Pokemon'] = $action[0]["SwapPokemon"];
        echo "\n";
        var_dump($action[0]);
        echo "\n";
         echo "\n";
        var_dump($action[1]);
        echo "\n";
    }

    if ($action[1]["SwapPokemon"] != null) {
        $action1L = $action0L + 1;
        putLancement($idCombat, $action[1]["Pokemon"], TourActuel($idCombat),$action1L);
        $action[1]['Pokemon'] = $action[1]["SwapPokemon"];
        echo "\n";
        var_dump($action[0]);
        echo "\n";
         echo "\n";
        var_dump($action[1]);
        echo "\n";
    }

    if ($action[0]["ObjetUtiliser"] != null) {
        $action0L = $action1L + 1;
        putLancement($idCombat, $action[0]["Pokemon"], TourActuel($idCombat), $action0L);
    }

    if ($action[1]["ObjetUtiliser"] != null) {
        $action1L = $action0L + 1;
        putLancement($idCombat,$action[1]["Pokemon"],TourActuel($idCombat), $action1L);
    }
    $Pokemons = getInformationPokemons($action[0]['Pokemon'], $action[1]['Pokemon']);
    //On commence par effectuer l'action du pokemon plus rapide, Si le pokemon effectue un swap ou utilise un objet , il n'aura pas fait d'attaque donc il ne fera pas d'attaque donc la vitesse ne changera rien
    $vitesseP1 = ($Pokemons[0]["IV_Vitesse"] + $Pokemons[0]["BonusVitesse"] + $Pokemons[0]["Vitesse"]) * $Pokemons[0]["Niveau"];
    $vitesseP2 = ($Pokemons[1]["IV_Vitesse"] + $Pokemons[1]["BonusVitesse"] + $Pokemons[1]["Vitesse"])  * $Pokemons[1]["Niveau"];
    
    if ($action0L != 0 && $action1L == 0) {
        $action1L = $action0L + 1;
        putLancement($idCombat, $action[1]["Pokemon"], TourActuel($idCombat), $action1L); 
    }
    
    if ($action1L !=0 && $action0L == 0) {
        $action0L = $action1L + 1;
        putLancement($idCombat, $action[0]["Pokemon"], TourActuel($idCombat), $action0L);
    }
    
    if ($action0L == 0 && $action1L == 0){ 
        if ($vitesseP1 > $vitesseP2) {
            $action0L = $action1L + 1;
            putLancement($idCombat, $action[0]["Pokemon"], TourActuel($idCombat), $action0L);
            $action1L = $action0L + 1;
            putLancement($idCombat, $action[1]["Pokemon"],TourActuel($idCombat), $action1L);
        } else {
            $action1L = $action0L + 1;
            putLancement($idCombat, $action[1]["Pokemon"], TourActuel($idCombat), $action1L);
            $action0L = $action1L + 1;
            putLancement($idCombat, $action[0]["Pokemon"], TourActuel($idCombat), $action0L);
        }
    }

    if ($vitesseP1 > $vitesseP2) {
        //La premiere action est effectué en premiére
        $indexA = 0;
        $indexD = 1;
        echo "1";
        echo "INDEX A :".$Pokemons[$indexA]["Id_pokemon"];
        echo "INDEX D :".$Pokemons[$indexD]["Id_pokemon"];
        echo "ACTION A".$action[$indexA]["AttaqueEffectue"];
        echo "ACTION D".$action[$indexD]["AttaqueEffectue"];
        DegatNormal($action[$indexA]["AttaqueEffectue"], $Pokemons, $indexA, $indexD);
        if (isPokemonMort($action[$indexD]["Pokemon"]) == 0){
            DegatNormal($action[$indexD]["AttaqueEffectue"], $Pokemons, $indexD, $indexA);
            if (isPokemonMort($action[$indexA]["Pokemon"]) == 1){
                gagneXp($Pokemons[$indexD]["Id_pokemon"], $Pokemons[$indexA]["Niveau"]);
            }
        } else {
            gagneXp($Pokemons[$indexA]["Id_pokemon"], $Pokemons[$indexD]["Niveau"]);
        }

    } else {
        echo "2";
        $indexA = 1;
        $indexD = 0;
        echo "INDEX A :".$Pokemons[$indexA]["Id_pokemon"];
        echo "INDEX D :".$Pokemons[$indexD]["Id_pokemon"];
        echo "ACTION A :".$action[$indexA]["AttaqueEffectue"];
        echo "ACTION D :".$action[$indexD]["AttaqueEffectue"];
        DegatNormal($action[$indexA]["AttaqueEffectue"], $Pokemons, $indexA, $indexD);
        if (isPokemonMort($action[$indexD]["Pokemon"]) == 0){
            DegatNormal($action[$indexD]["AttaqueEffectue"], $Pokemons, $indexD, $indexA);
            if (isPokemonMort($action[$indexA]["Pokemon"]) == 1){
                gagneXp($Pokemons[$indexD]["Id_pokemon"], $Pokemons[$indexA]["Niveau"]);
            }
        } else {
            gagneXp($Pokemons[$indexA]["Id_pokemon"],$Pokemons[$indexD]["Niveau"]);
        }
    }
    // Dans le cas où l'objet utilisé était une pokeball
    $CombatTermine = 0;
    $PokeSauvageMort = 0;

    if ($action[0]["ObjetUtiliser"] != null || $action[1]["ObjetUtiliser"] != null) {
        if ($action[0]["ObjetUtiliser"] == 12 && $action[0]["ObjetReussis"] == 1) {
            $PokeSauvageMort = 1;
            $CombatTermine = 1;
        }
        if($action[1]["ObjetUtiliser"] == 12 && $action[1]["ObjetReussis"] == 1) {
            $PokeSauvageMort = 1;
            $CombatTermine = 1;
        }
    }
    $User1 = getUser1byiC($idCombat);
    $User2 = getUser2byiC($idCombat);
    //echo "| User1 : $User1 |";
    //echo "| User2 : $User2 |";
    if ($User2 == null) {
        if ($Pokemons[$indexD]["Num_dresseur"] == null) {
            $pokeSauvage = $action[$indexD]["Pokemon"];
            if (isPokemonMort($action[$indexD]["Pokemon"])) {
                $PokeSauvageMort = 1;
                $CombatTermine = 1;
            }
        }
        if ($Pokemons[$indexA]["Num_dresseur"] == null) {
            $pokeSauvage = $action[$indexA]["Pokemon"];
            if (isPokemonMort($action[$indexA]["Pokemon"])) {
                $PokeSauvageMort = 1;
                $CombatTermine = 1;
            }
        }
        if (getLastPokemonAlive($User1) == null) {
            $CombatTermine = 1;
            aPerdu($User1);
        }
    } else {
        if (getLastPokemonAlive($User1) == null) {
            $CombatTermine = 1;
            aPerdu($User1);
        }
        if (getLastPokemonAlive($User2) == null) {
            $CombatTermine = 1;
            aPerdu($User2);
        }
    }
    if ($CombatTermine == 0) {
        TourUp($idCombat);
        if ($User2 == null) {
            PokeSauvageAttaque($pokeSauvage, $idCombat);
            updatePokemon1($idCombat, getLastPokemonAlive($User1));
        } else {
            updatePokemon1($idCombat, getLastPokemonAlive($User1));
            updatePokemon2($idCombat, getLastPokemonAlive($User2));
        }
    } else {
        if ($User2 == null) {
            afterACombat($User1);
            if ($PokeSauvageMort == 1) {
                $db = connect();
                $query = "UPDATE CombatEnCours SET User1Gagne = 1 WHERE idCombat = $idCombat";
                mysqli_query($db, $query);
                mysqli_close($db);
                unsetCombatState($User1);
                updateDRTime($User1);
            } 
        } 
    }
}

function isInLobby($user){
    $db = connect();
    $query ="SELECT map_actuel FROM `users` WHERE id = $user";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    foreach ($res as $enr) {
        if ($enr["map_actuel"] == "Lobby") {
            return 1;
        } else {
            return 0;
        }
    }
}

function soignerPokemon($user) {
    $db = connect();
    $query = "UPDATE Pokemon_des_dresseurs set degat_subis = 0 WHERE Num_dresseur = $user;";
    mysqli_query($db, $query);
    $query = "UPDATE CapaciteChoix SET PPUtilise = 0 WHERE Pokemon IN (SELECT Pokemon_des_dresseurs.Id_pokemon FROM Pokemon_des_dresseurs WHERE Pokemon_des_dresseurs.Num_dresseur = $user);";
    mysqli_query($db, $query);
    mysqli_close($db);
}

function soignerUnPokemon($idpoke) {
    $db = connect();
    $query = "UPDATE Pokemon_des_dresseurs set degat_subis = 0 WHERE Id_pokemon = $idpoke";
    mysqli_query($db, $query);
    mysqli_close($db);
}

function recupererDemandeC($user) {
    $db = connect();
    $query = "SELECT users.username FROM CombatEntreDresseur,users WHERE J2 = $user AND accepte is null AND J1 = users.id;";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    return $res;
}

function demanderEnDuel($user1, $userCible) {
    if (mysqli_num_rows(recupererDemandeC($userCible)) == 0) {
        $db = connect();
        $query = "INSERT INTO CombatEntreDresseur(J1,J2) VALUES ($user1,$userCible)";
        mysqli_query($db, $query);
        mysqli_close($db);
        return "true";
    } else {
        return "false";
    }
}

function isVsPokemonSauvage($user) {
    $db = connect();
    $query = "SELECT * FROM `CombatEnCours` WHERE (User1 = $user OR User2 = $user) AND User1Gagne is null AND User2 is null;";
    $res= mysqli_query($db, $query);
    mysqli_close($db);
    if (mysqli_num_rows($res) == 0) {
        return 0;
    } else {
        return 1;
    }
}

function refuserDemandeC($user) {
    $db = connect();
    $query = "UPDATE CombatEntreDresseur SET accepte = 0 WHERE J2 = $user";
    mysqli_query($db, $query);
    mysqli_close($db);
}

function accepterDemandeC($user) {
    $db = connect();
    $query = "SELECT J1,J2 FROM CombatEntreDresseur WHERE J2 = $user and accepte is null";
    $res = mysqli_query($db, $query);
    foreach ($res as $enr) {
        $user1 = $enr["J1"];
        $user2 = $enr["J2"];
    }
    BeginCombatContreJoueur($user1, $user2);
    $query = "UPDATE CombatEntreDresseur SET accepte=1 WHERE accepte is null AND (J1 = $user OR J2 = $user);";
    mysqli_query($db, $query);
    mysqli_close($db);
}

function changeMap($user, $map) {
    $db = connect();
    $query = "UPDATE users set map_actuel = \"$map\" ,coordX_last = null, coordY_last = null WHERE id = $user";
    echo $query;
    mysqli_query($db, $query);
    mysqli_close($db);
}

function mapAleatoire($user) {
    $mapArray = array(0 => "Lobby", 1 => "route01");
    $num = rand(1,1);
    changeMap($user,$mapArray[1]);
}

function getNbrItem($user, $item) {
    $db = connect();
    $query = "SELECT qqte FROM Objets_des_dresseurs WHERE num_objet = $item AND num_dresseur = $user";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    if (mysqli_num_rows($res) == 0) {
        return 0;
    }
    foreach ($res as $enr) {
        return $enr["qqte"];
    }
}

function useItem($user, $item) {
    $db = connect();
    $query = "UPDATE Objets_des_dresseurs SET qqte = qqte - 1 WHERE num_objet = $item AND num_dresseur = $user";
    mysqli_query($db, $query);
    mysqli_close($db);
}

function returnNextAttaqueToLearn($user) {
    //On recupere lequipe pokemon
    $res = get_equipe2($user);
    if (!$res) {
        return null;
    }
    foreach ($res as $enr) {
        $attaque = isAttaqueToLearn($enr["Id_pokemon"]);
        if ($attaque != null) {
            foreach ($attaque as $enr2) {
                return $enr2["Capacite"]."&".$enr2["Pokemon"];
            }
        }
    }
}

function isAttaqueToLearn($idPokemon) {
    $db = connect();
    $query = "SELECT * FROM CapaciteChoix WHERE Choix is null AND Pokemon = $idPokemon LIMIT 1;";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    if (!$res) {
        return null;
    }
    return $res;
}

function capaciteVersNom($idCapacite) {
    $db = connect();
    $query = "SELECT Nom FROM Capacite WHERE Num = $idCapacite";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    foreach ($res as $enr) {
        return $enr["Nom"];
    }
}
function accepterAttaque($idAttaque, $idPokemon){
    $db = connect();
    $query = "UPDATE CapaciteChoix SET Choix = 1 WHERE Pokemon = $idPokemon and Capacite = $idAttaque";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
}
function refuserAttaque($idAttaque, $idPokemon){
    $db = connect();
    $query = "UPDATE CapaciteChoix SET Choix = 0 WHERE Pokemon = $idPokemon and Capacite = $idAttaque";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
}
function oublierAttaque($idAttaque, $idPokemon){
    $db = connect();
    $query = "UPDATE CapaciteChoix SET Choix = 0 WHERE Pokemon = $idPokemon and Capacite = $idAttaque";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
}
function idCapaciteVersNom($idAttaque){
    $db = connect();
    $query = "SELECT Nom FROM `Capacite`WHERE Num = $idAttaque";
    $res = mysqli_query($db, $query);
    mysqli_close($db);
    foreach ($res as $enr) {
        return $enr["Nom"];
    }
}

?>
