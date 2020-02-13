<?php

session_start();

include("fonctions.php");

if (isset($_GET['starter'])) {
    if (besoin_de_starter($_SESSION['num_user']) == 1 && ($_GET["starter"] == 1 || $_GET["starter"] == 4 || $_GET["starter"] == 7)) {
        create_starter($_GET['starter'], $_SESSION['num_user'], 1);
    }
    header("location: home.php");
    exit();
}

if (isset($_GET['disconnect'])) {
    // Détruit toutes les variables de session
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]);
    }

    // Finalement, on détruit la session.
    session_destroy();
    header("location: login.php");
    exit();
}

if (isset($_GET['friends'])){
    if ($_GET['friends'] == "demande_r") {
        is_connected($_SESSION['num_user']);
        $res = get_demande_amis_reçus($_SESSION['num_user']);
        $rows = array();
        while ($r = mysqli_fetch_assoc($res)){
            $rows[] = $r;
        }
        echo json_encode($rows);
        exit();
    }

    if ($_GET['friends'] == "friend_list") {
        $res = get_friends_list($_SESSION['num_user']);
        $rows = array();
        while ($r = mysqli_fetch_assoc($res)) {
            $rows[] = $r;
        }
        echo json_encode($rows);
        exit();
    }
}

if (isset($_GET['accepter_demande_r'])) {
    if (!is_numeric($_GET['accepter_demande_r'])) {
        exit();
    }
    accepter_demande_amis($_SESSION["num_user"], $_GET['accepter_demande_r']);
}

if (isset($_GET['refuser_demande_r'])) {
    if (!is_numeric($_GET['refuser_demande_r'])){
        exit();
    }
    refuser_demande_amis($_SESSION["num_user"], $_GET['refuser_demande_r']);
}

if (isset($_GET['get_users_list'])) {
    $res = get_users_list($_SESSION["num_user"], $_SESSION["username"], $_GET['get_users_list']);
    $rows = array();
    while ($r = mysqli_fetch_assoc($res)) {
        $rows[] = $r;
    }
    echo json_encode($rows);
    exit();
}

if (isset($_GET['add_friend'])) {
    if (!is_numeric($_GET['add_friend'])) {
        exit();
    }
    add_friends($_GET['add_friend'], $_SESSION['num_user']);
    exit();
}

if (isset($_GET["get_pokemon_equipe"])) {
    $res = get_pokemon_equipe($_SESSION['num_user']);
    $rows = array();
    while ($r = mysqli_fetch_assoc($res)){
        $rows[] = $r;
    }
    echo json_encode($rows);
    exit();
}

if(isset($_GET["get_pokemon_boite"])) {
    $res = get_pokemon_boite($_SESSION['num_user']);
    $rows = array();
    while ($r = mysqli_fetch_assoc($res)){
        $rows[] = $r;
    }
    echo json_encode($rows);
    exit();
}

if (isset($_GET["Swap_Pokemon_id"]) && $_GET["with"]) {
    if (!is_numeric($_GET["Swap_Pokemon_id"]) || !is_numeric($_GET["with"]) || isCombatStateOn($_SESSION["num_user"]) == 1) {
        exit();
    }
    swap_pokemon_equipe($_SESSION['num_user'], $_GET["Swap_Pokemon_id"], $_GET["with"]);
}

if (isset($_GET["Pokemon_vers_boite"])) {
    if (!is_numeric($_GET["Pokemon_vers_boite"]) || isCombatStateOn($_SESSION["num_user"]) == 1 || isInLobby($_SESSION["num_user"]) == 0) {
        exit();
    }
    pokemon_vers_boite($_SESSION['num_user'], $_GET["Pokemon_vers_boite"]);
}

if (isset($_GET["Pokemon_vers_equipe"])) {
    if (!is_numeric($_GET["Pokemon_vers_equipe"]) || isCombatStateOn($_SESSION["num_user"]) == 1 || isInLobby($_SESSION["num_user"]) == 0 ) {
        exit();
    }
    boite_vers_equipe($_GET["Pokemon_vers_equipe"], $_SESSION['num_user']);
}

if (isset($_GET['getItemList'])) {
    $res = getItemInformations();
    $rows = array();
    while ($r = mysqli_fetch_assoc($res)) {
        $rows[] = $r;
    }
    echo json_encode($rows);
    exit();
}

if (isset($_GET['acheteItem'])) {
    if (!is_numeric($_GET["acheteItem"]) || isCombatStateOn($_SESSION['num_user']) == 1 || isInLobby($_SESSION['num_user']) == 0) {
        exit();
    }
    echo $_GET['acheteItem'];
    ajouterObjetDresseur($_SESSION['num_user'], $_GET['acheteItem']);
}

if (isset($_GET['afficherArgentDresseur'])) {
    echo getArgentDresseur($_SESSION['num_user']);
}

if (isset($_GET['afficherProfile'])) {
    $nom = $_SESSION['login'];
    $dateInscription = date('d-m-Y', strtotime(getDateInscription($_SESSION['num_user'])));
    $dateInscription = str_replace('-', '.', $dateInscription);
    $nbCombat = getNombreCombat($_SESSION['num_user']);
    $nbVictoire = getNbVictoire($_SESSION['num_user']);
    $nbDefaite = getNbDefaite($_SESSION['num_user']);
    $ratio = getRatioVictoire($_SESSION['num_user']);

    $combat = array(
                    "Nom" => $nom,
                    "dateInscription" => $dateInscription,
                    "nbCombat" => $nbCombat,
                    "nbVictoire" => $nbVictoire,
                    "nbDefaite" => $nbDefaite,
                    "ratio" => $ratio);
    echo json_encode($combat);
    exit();
}

if (isset($_GET['afficherInventaireDresseur'])) {
    $res = getObjetsDresseur($_SESSION['num_user']);
    $rows = array();
    while ($r = mysqli_fetch_assoc($res)) {
        $rows[] = $r;
    }
    echo json_encode($rows);
    exit();
}

if (isset($_GET['afficherPokedex'])) {
    $res = getPokedex();
    $rows = array();
    while ($r = mysqli_fetch_assoc($res)) {
        $rows[] = $r;
    }
    echo json_encode($rows);
    exit();
}

if (isset($_GET["getPokemonHp"])){
    if (!is_numeric($_GET["getPokemonHp"])){
        exit();
    }
    $res = get_pokemon_hp($_GET["getPokemonHp"]);
    $rows = array();
    while ($r = mysqli_fetch_assoc($res)) {
        $rows[] = $r;
    }
    echo json_encode($rows);
    exit();
}

if (isset($_GET["rencontrePokemon"]) && $_GET["X"] && $_GET["Y"]) {
    if (!is_numeric($_GET["X"]) || !is_numeric($_GET["Y"])) {
        echo 'error';
        exit();
    }

    if (peutFaireUneAutreRencontre($_SESSION['num_user'], $_GET["rencontrePokemon"])) {
        $chance = rand(0,2);
        if ($chance == 0) {
            echo 'fight';
            saveCoordMap($_SESSION['num_user'], $_GET["X"], $_GET["Y"]);
            BeginCombatPokeSauvage($_SESSION["num_user"]);

        } else {
            echo 'nonFight1';
        }
    } else {
        echo'nonFight3';
    }
}

if (isset($_GET["isCombatStateOn"])) {
    if (isCombatStateOn($_SESSION["num_user"]) == 1) {
        echo "true";
    } else {
        echo "false";
    }
}

if (isset($_GET["pokemonCombat"])) {
    $res = getPokemonSortie($_SESSION["num_user"]);
    foreach ($res as $enr) {
        if ($enr["User2"] == null){
            $PokeBack = $enr["PokemonActuelEquipe1"];
            $PokeFront = $enr["PokemonSauvage"];
        } else {
            if($_SESSION["num_user"] == $enr["User1"]){
                $PokeBack = $enr["PokemonActuelEquipe1"];
                $PokeFront = $enr["PokemonActuelEquipe2"];
            } else {
                $PokeBack = $enr["PokemonActuelEquipe2"];
                $PokeFront = $enr["PokemonActuelEquipe1"];
            }
        }
    $row = array("PokeFront" => $PokeFront,"PokeFrontID" => idPokemonVersNum($PokeFront), "PokeBack" => $PokeBack , "PokeBackID" => idPokemonVersNum($PokeBack));
    }
    echo json_encode($row);
}

if(isset($_GET["idPokemonVersNameLvl"])) {
    if(!is_numeric($_GET["idPokemonVersNameLvl"])) {
        exit();
    }
    echo idPokemonVersName($_GET["idPokemonVersNameLvl"])." N.".idPokemonVersLvl($_GET["idPokemonVersNameLvl"]);
}

if (isset($_GET["abandon"])) {
    aPerdu($_SESSION["num_user"]);
}

if (isset($_GET["reprise"])) {
    $res = getCoordMap($_SESSION["num_user"]);
    $rows = array();
    while ($r = mysqli_fetch_assoc($res)) {
        $rows[] = $r;
    }
    echo json_encode($rows);
    exit();
}

if (isset($_GET["attaquePoke"])) {
    if (!is_numeric($_GET["attaquePoke"])) {
        exit();
    }
    $res = getAttaquePokemon($_GET["attaquePoke"]);
    $rows = array();
    while ($r = mysqli_fetch_assoc($res)) {
        $rows[] = $r;
    }
    echo json_encode($rows);
    exit();
}

if (isset($_GET["LanceAttaque"]) && isset($_GET["Poke"])) {
    if (!is_numeric($_GET["LanceAttaque"]) && !is_numeric($_GET["Poke"])) {
        exit();
    }
    if (isVsPokemonSauvage($_SESSION["num_user"]) == 0) {
        $numCombat = getIdCombatByUser($_SESSION["num_user"]);
        $TourActuel = TourActuel($numCombat);
        AttaquerPokemonJoueur($_GET["LanceAttaque"],$numCombat,$_SESSION["num_user"]);
        if (canLaunchANewTour($numCombat,$TourActuel) == 1) {
            newTour($numCombat);
        }
    } else {
        AttaquerPokemonSauvage($_GET["LanceAttaque"],$_GET["Poke"],getIdCombatByUser($_SESSION["num_user"]));
    }
    exit();
}

if (isset($_GET["getTour"])) {
    $numCombat = getIdCombatByUser($_SESSION["num_user"]);
    echo  TourActuel($numCombat);
    exit();
}

if (isset($_GET["soignerPokemon"])) {
    if (isInLobby($_SESSION["num_user"])) {
        echo "soignés";
        soignerPokemon($_SESSION["num_user"]);
    }
    exit();
}

if (isset($_GET["demandeCombat"])) {
    $res = recupererDemandeC($_SESSION["num_user"]);
    if(mysqli_num_rows($res) == 0){
        echo "false";
    } else {
        foreach ($res as $enr) {
            $username = $enr["username"];
            echo "L'utilisateur $username vous défie en duel.<br> Acceptez-vous ?";
        }
    }
    exit();
}

if (isset($_GET["demanderEnDuel"])) {
    if (!is_numeric($_GET["demanderEnDuel"])) {
        exit();
    }
    echo demanderEnDuel($_SESSION["num_user"], $_GET["demanderEnDuel"]);
    exit();
}

if (isset($_GET["refuserCombat"])) {
    refuserDemandeC($_SESSION["num_user"]);
    exit();
}

if (isset($_GET["accepterCombat"])) {
    accepterDemandeC($_SESSION["num_user"]);
    exit();
}

if (isset($_GET["mapAleatoire"])) {
    if(isInLobby($_SESSION["num_user"]) == 1){
        mapAleatoire($_SESSION["num_user"]);
    } else {
        changeMap($_SESSION["num_user"], "Lobby");
    }
    exit();
}

if (isset($_GET["getNbrItem"])) {
    if (!is_numeric($_GET["getNbrItem"])){
        exit();
    }
   echo getNbrItem($_SESSION["num_user"], $_GET["getNbrItem"]);
}

if (isset($_GET["UsePokeBall"])) {
    $idCombat = getIdCombatByUser($_SESSION["num_user"]);
    $poke1 = getLastPokemonAlive($_SESSION["num_user"]);
    $num_pokemon = getPokemonSauvageByIdCombat($idCombat);
    $TourActuel = TourActuel($idCombat);
    if (isVsPokemonSauvage($_SESSION["num_user"]) == 1 && getNbrItem($_SESSION["num_user"],12) > 0 && aDejaAttaquer($poke1,$idCombat) == 0){
        $res = get_pokemon_hp($num_pokemon);
        $reussi = 0;
        foreach ($res as $enr) {
            $HpManquantR = $enr["HP"] / $enr["HPmax"];
        }
        $ChanceCapture = 1.01 - $HpManquantR;
        $Chance = rand(0,100)/100;
        echo "$ChanceCapture | $Chance";
        if ($ChanceCapture >= $Chance) {
            add_pokemon_dresseur($num_pokemon,$_SESSION["num_user"]);
            ajouter_equipe_suite($num_pokemon,$_SESSION["num_user"]);
            $reussi = 1;
        }
        useItem($_SESSION["num_user"], 12);
        rowObj(12, $reussi, $idCombat, $num_pokemon, $poke1);
        newTour($idCombat);
    } else {
        if (getNbrItem($_SESSION["num_user"],12) > 0 && aDejaAttaquer($poke1,$idCombat) == 0) {
            rowObj(12, 0, $idCombat, $num_pokemon, $poke1);
            if (canLaunchANewTour($idCombat,$TourActuel) == 1) {
                newTour($idCombat);
            }
        }
    }
    exit();
}

if (isset($_GET["UsePotion"])) {
    $idCombat = getIdCombatByUser($_SESSION["num_user"]);
    $poke1 = getLastPokemonAlive($_SESSION["num_user"]);
    $TourActuel = TourActuel($idCombat);
    if (getNbrItem($_SESSION["num_user"], 11) > 0 && aDejaAttaquer($poke1,$idCombat) == 0) {
        soignerUnPokemon($poke1);
        useItem($_SESSION["num_user"], 11);
        rowObj(11, 1, $idCombat, $poke1, $poke1);
        if (canLaunchANewTour($idCombat, $TourActuel) == 1) {
            newTour($idCombat);
        }
    }
    exit();
}

if (isset($_GET["swapPokemonDuringCombat"])) {
    if (!is_numeric($_GET["swapPokemonDuringCombat"]) || pokemon_is_in_equipe($_SESSION["num_user"],$_GET["swapPokemonDuringCombat"]) == 0) {
        exit();
    }
    $idCombat = getIdCombatByUser($_SESSION["num_user"]);
    $poke1 = getLastPokemonAlive($_SESSION["num_user"]);
    $TourActuel = TourActuel($idCombat);
    swap_pokemon_equipe($_SESSION["num_user"], $poke1, $_GET["swapPokemonDuringCombat"]);
    rowSwap($poke1, $idCombat, $_GET["swapPokemonDuringCombat"]);
    if (canLaunchANewTour($idCombat,$TourActuel) == 1) {
        newTour($idCombat);
    }
}

if (isset($_GET["PokemonAttaqueApprendre"])) {
    $str = returnNextAttaqueToLearn($_SESSION["num_user"]);
    if($str == null){
        echo "false";
        exit();
    }
    $array = explode("&", $str);
    $StrADire = "Le Pokemon ".idPokemonVersName($array[1])." peut apprendre la capacité ".capaciteVersNom($array[0]);
    $res = getAttaquePokemon($array[1]);
    if (mysqli_num_rows($res) < 4){
        $arrayStr = array(0 => 0,1 => $StrADire."<br>Voulez vous lui faire apprendre cette capacité ?",2 => $array[1], 3 => $array[0]);
    } else {
        $arrayStr = array(0 => 1,1 => $StrADire."<br>Mais il connais deja 4 capacités.Voulez vous lui faire oublier une attaque pour apprendre celle-ci ?",2 => $array[1], 3 => $array[0]);
    }
    echo json_encode($arrayStr);
    exit();
}

if (isset($_GET["accepterAttaque"]) && isset($_GET["poke"])) {
    if (!is_numeric($_GET["poke"]) ||  pokemon_is_in_equipe($_SESSION["num_user"],$_GET["poke"]) == 0 ){
        exit();
    }
    accepterAttaque($_GET["accepterAttaque"],$_GET["poke"]);
    exit();
}
if (isset($_GET["refuserAttaque"]) && isset($_GET["poke"])) {
    if(!is_numeric($_GET["poke"]) ||  pokemon_is_in_equipe($_SESSION["num_user"],$_GET["poke"]) == 0 ){
        exit();
    }
    refuserAttaque($_GET["refuserAttaque"],$_GET["poke"]);
    exit();
}
if (isset($_GET["oublierAttaque"]) && isset($_GET["poke"])) {
    if (!is_numeric($_GET["poke"]) ||  pokemon_is_in_equipe($_SESSION["num_user"],$_GET["poke"]) == 0 ) {
        exit();
    }
    oublierAttaque($_GET["oublierAttaque"],$_GET["poke"]);
    exit();
}
if (isset($_GET["Tour"])) {
    if (!is_numeric($_GET["Tour"])) {
        exit();
    }
    //0->Attaque|1->Objet|2->Swap
    $idCombat = getIdCombatByUser($_SESSION["num_user"]);
    $rows = getActionByTour($idCombat,$_GET["Tour"]);
    if ($rows[0]["ObjetUtiliser"] != null) {
        $nom = $_SESSION["username"];
        $nomobj = getObjetNom($rows[0]["ObjetUtiliser"]);
        if(pokemon_is_in_equipe($_SESSION["num_user"],$rows[0]["Pokemon"]) == 1){
            $poke = "FRONT";
        }
        else{
            $poke = "BACK";
        }
        $res1 = array(0 => 1, 1 => "$nom utilise une $nomobj",2 => array(0 =>$rows[0]["ObjetUtiliser"],1=>$poke));
    }
    if($rows[0]["SwapPokemon"] != null){
        $nom = $_SESSION["username"];
        $poke1 = idPokemonVersName($rows[0]["Pokemon"]);
        $pokeCible = idPokemonVersName($rows[0]["SwapPokemon"]);
        if(pokemon_is_in_equipe($_SESSION["num_user"],$rows[0]["SwapPokemon"]) == 1){
            $poke = "FRONT";
        }
        else{
            $poke = "BACK";
        }
        $res1 = array(0 => 2, 1 => "$nom rappelle $poke1 et l'échange avec $pokeCible !",2 => array(0 => $rows[0]["SwapPokemon"], 1 => idPokemonVersNum($rows[0]["SwapPokemon"]),2=> $poke));
    }
    if($rows[0]["AttaqueEffectue"] != null ){
        $poke1 = idPokemonVersName($rows[0]["Pokemon"]);
        $attaque = capaciteVersNom($rows[0]["AttaqueEffectue"]);
        if(pokemon_is_in_equipe($_SESSION["num_user"],$rows[0]["Pokemon"]) == 1){
            $poke = "FRONT";
        }
        else{
            $poke = "BACK";
        }
        $res1 = array(0 => 0, 1 => "$poke1 utilise $attaque !",2 => $poke);
    }
    if($rows[1]["ObjetUtiliser"] != null){
        $nom = $_SESSION["username"];
        $nomobj = getObjetNom($rows[1]["ObjetUtiliser"]);
        if(pokemon_is_in_equipe($_SESSION["num_user"],$rows[1]["Pokemon"]) == 1){
            $poke = "FRONT";
        }
        else{
            $poke = "BACK";
        }
        $res2 = array(0 => 1, 1 => "$nom utilise une $nomobj",2 => array(0 =>$rows[0]["ObjetUtiliser"],1=>$poke));
    }
    if($rows[1]["SwapPokemon"] != null){
        $nom = $_SESSION["username"];
        $poke1 = idPokemonVersName($rows[1]["Pokemon"]);
        $pokeCible = idPokemonVersName($rows[1]["SwapPokemon"]);
        if(pokemon_is_in_equipe($_SESSION["num_user"],$rows[1]["SwapPokemon"]) == 1){
            $poke = "FRONT";
        }
        else{
            $poke = "BACK";
        }
        $res2 = array(0 => 2, 1 => "$nom rappelle $poke1 et l'échange avec $pokeCible !",2 => array(0 => $rows[1]["SwapPokemon"], 1 => idPokemonVersNum($rows[1]["SwapPokemon"]),2=> $poke));
    }
    if($rows[1]["AttaqueEffectue"] != null ){
        $poke1 = idPokemonVersName($rows[1]["Pokemon"]);
        $attaque =  capaciteVersNom($rows[1]["AttaqueEffectue"]);
        if(pokemon_is_in_equipe($_SESSION["num_user"],$rows[1]["Pokemon"]) == 1){
            $poke = "FRONT";
        }
        else{
            $poke = "BACK";
        }
        $res2 = array(0 => 0, 1 => "$poke1 utilise $attaque !",2 => $poke);
    }
    if($rows[0]["Lancement"] == 1){
        $res = array(0=>$res1,1=>$res2);
    }
    else{
        $res = array(0=>$res2,1=>$res1);
    }
    echo json_encode($res);
    exit();

}

?>
