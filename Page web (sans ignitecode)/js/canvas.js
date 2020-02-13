function coordDepartcarte(map,vec){
	if(map == "route01"){
		if(vec == "X"){
			return 200;
		}
		if(vec == "Y"){
			return 600;
		}
	}
	else if (map == "Lobby"){
		if(vec == "X"){
			return 116;
		}
		if(vec == "Y"){
			return 140;
		}
	}

}

function setIdle(){
	walk.state = 0;
	setCamera(walk.coordx,walk.coordy);
}
function deplacementG(){
	let autorisation = autoriserDeplacement(walk.coordx - 4 , walk.coordy);
	if(autorisation == 1){
		walk.exeption = 0;
		walk.coordx = walk.coordx - 4;
	}
	else if(autorisation == 4){
		walk.exeption = 0;
		walk.coordx = walk.coordx - 4;
		trycombat();
	}
	else if(autorisation == 3){
		mapAleatoire();
	}
	if(walk.state == 1){
		walk.state =2;
	}
	else{walk.state = 1;}
	setCamera(walk.coordx,walk.coordy);
}
function deplacementD(){
	let autorisation =autoriserDeplacement(walk.coordx + 4 , walk.coordy); 
	if (autorisation == 1){
		walk.exeption = 0;
		walk.coordx = walk.coordx + 4;
	}
	else if(autorisation == 4){
		walk.exeption = 0;
		walk.coordx = walk.coordx + 4;
		trycombat();
	}
	else if(autorisation == 3){
		mapAleatoire();
	}
	if(walk.state == 1){
		walk.state =2;
	}
	else{walk.state = 1;}
	setCamera(walk.coordx,walk.coordy);
}
function deplacementB(){
	let autorisation = autoriserDeplacement(walk.coordx, walk.coordy + 4) 
	if(autorisation == 1){
		walk.coordy = walk.coordy+ 4;
		walk.exeption = 0;
	}
	else if (autorisation == 4){
		walk.coordy = walk.coordy+ 4;
		walk.exeption = 0;
		trycombat();
	}
	else if (autorisation == 5){
		walk.coordy = walk.coordy + 4;
		walk.exeption = 5;
	}
	else if(autorisation == 3){
		mapAleatoire();
	}
	if(walk.state == 1){
		walk.state =2;
	}
	else{walk.state = 1;}
	setCamera(walk.coordx,walk.coordy);;

}
function deplacementH(){
	let autorisation = autoriserDeplacement(walk.coordx, walk.coordy - 4);
	if(autorisation == 1){
		walk.exeption = 0;
		walk.coordy = walk.coordy- 4;
	}
	else if(autorisation == 4){
		walk.exeption = 0;
		walk.coordy = walk.coordy - 4;
		trycombat();
	}
	else if(autorisation == 3){
		mapAleatoire();
	}
	if(walk.state == 1){
		walk.state =2;
	}
	else{walk.state = 1;}
	setCamera(walk.coordx,walk.coordy);
}

function setBackground(map){
	if(map != "combat"){
	if(walk.coordx == null || walk.coordy == null){
		walk.coordx = coordDepartcarte(map,"X");
		walk.coordy = coordDepartcarte(map,"Y");
	}
	background.map = map;
	console.log(background.map);
	background.src = currentLocation + "/maps/" + map + ".png";
	background.onload = function(){setCamera(walk.coordx,walk.coordy);};
	}
	if(map == "combat"){
		background.map = map;
		background.src = currentLocation + "/maps/" + map + ".png";
		background.onload = function(){setCamera2(369,86);AfficherHud()};
	}
}
function setCamera(posjx,posjy){
	if(enCombat == 0){
		let resoW = background.naturalWidth;
		let resoH = background.naturalHeight;
		//On cherche a savoir si l'on peut faire un rectangle de 240x160 autours du joueur.
		//C'est a dire qu'il y ai 120 a droite et 120 a gauche ainsi que 80 en haut et 80 en bas(240x160 etant la resolution des sprites de base);
		//Dans le cas contraire , on ne dois pas faire depasser la camera du bord;
		let sx = posjx - 120;
		let sWidth = 240;
		let sy = posjy - 80;
		let sHeight = 160;
		if(posjx < 120){
			sx = 0;
		}
		if(posjx + 120 > resoW){
			sx = resoW - 240;
		}
		if(posjy < 80){
			sy = 0;
		}
		if(posjy + 80 > resoH){
			sy = resoH - 160;
		}
		//console.log("sx : " + sx);
		//console.log("sy : " + sy);
		//console.log("img max : " + background.naturalHeight);
		ctx.drawImage(background,sx,sy,sWidth,sHeight,0,0,240,160);
		dessinerjoueur(sx,sy);
	}	
}
function setCamera2(posjx,posjy){
		let resoW = background.naturalWidth;
		let resoH = background.naturalHeight;
		//On cherche a savoir si l'on peut faire un rectangle de 240x160 autours du joueur.
		//C'est a dire qu'il y ai 120 a droite et 120 a gauche ainsi que 80 en haut et 80 en bas(240x160 etant la resolution des sprites de base);
		//Dans le cas contraire , on ne dois pas faire depasser la camera du bord;
		let sx = posjx - 120;
		let sWidth = 240;
		let sy = posjy - 80;
		let sHeight = 160;
		if(posjx < 120){
			sx = 0;
		}
		if(posjx + 120 > resoW){
			sx = resoW - 240;
		}
		if(posjy < 80){
			sy = 0;
		}
		if(posjy + 80 > resoH){
			sy = resoH - 160;
		}
		//console.log("sx : " + sx);
		//console.log("sy : " + sy);
		//console.log("img max : " + background.naturalHeight);
		ctx.drawImage(background,sx,sy,sWidth,sHeight,0,0,240,160);
		dessinerjoueur(sx,sy);	
}
function dessinerjoueur(offsetx,offsety){
	let fakex = walk.coordx - offsetx;
	let fakey = walk.coordy - offsety;
	if(walk.direction == "bas"){
		if(walk.exeption == 5){
			console.log("glisse basse");
			ctx.drawImage(glisse,0,2,16,20,fakex,fakey,16,20);
		}
		else{
			if(walk.state == 1){
				ctx.drawImage(walk,0,6,16,20,fakex,fakey,16,20);
			}
			else if(walk.state == 2){
				ctx.drawImage(walk,32,6,16,20,fakex,fakey,16,20);
			}
			else if(walk.state == 0){
				ctx.drawImage(walk,16,6,16,20,fakex,fakey,16,20);
			}
		}
	}
	else if(walk.direction == "haut"){
		if(walk.state == 1){
			ctx.drawImage(walk,0,38,16,20,fakex,fakey,16,20);
		}
		else if(walk.state == 2){
			ctx.drawImage(walk,32,38,16,20,fakex,fakey,16,20);
		}
		else if(walk.state == 0){
			ctx.drawImage(walk,16,38,16,20,fakex,fakey,16,20);
		}
	}
	else if(walk.direction == "gauche"){
		if(walk.state == 1){
			ctx.drawImage(walk,0,70,16,20,fakex,fakey,16,20);
		}
		else if(walk.state == 2){
			ctx.drawImage(walk,32,70,16,20,fakex,fakey,16,20);
		}
		else if(walk.state == 0){
			ctx.drawImage(walk,16,70,16,20,fakex,fakey,16,20);
		}
	}
	else if(walk.direction == "droite"){
		if(walk.state == 1){
			ctx.drawImage(walk,0,93,16,20,fakex,fakey,16,20);
		}
		else if(walk.state == 2){
			ctx.drawImage(walk,32,93,16,20,fakex,fakey,16,20);
		}
		else if(walk.state == 0){
			ctx.drawImage(walk,16,93,16,20,fakex,fakey,16,20);
		}
	}
}
function updateImage(id1,id3,i){
	document.querySelector("#img"+i).idPokemon = id3;
	var cote = "BACK";
	if(i == 2){
		cote = "FRONT";
	}
	if(id1 < 10){
		document.querySelector("#img"+i).src = "Data/pokemon/"+cote+"/00"+id1+".gif";
	}
	else if(id1 < 100){
		document.querySelector("#img"+i).src = "Data/pokemon/"+cote+"/0"+id1+".gif";
	}
	else{
		document.querySelector("#img"+i).src = "Data/pokemon/"+cote+"/"+id1+".gif";
	}
	document.querySelector("#img"+i).onload = function(){
		document.querySelector("#img"+i).height = document.querySelector("#img"+i).naturalHeight * 2;
		document.querySelector("#img"+i).width = document.querySelector("#img"+i).naturalWidth * 2;
	}
	
}
function actualiseImage(id1,id2,id3,id4){
		document.querySelector("#img1").idPokemon = id3;
		document.querySelector("#img2").idPokemon = id4;
	if(id1 < 10){
		document.querySelector("#img1").src = "Data/pokemon/BACK/00"+id1+".gif";
	}
	else if(id1 < 100){
		document.querySelector("#img1").src = "Data/pokemon/BACK/0"+id1+".gif";
	}
	else{
		document.querySelector("#img1").src = "Data/pokemon/BACK/"+id1+".gif";
	}
	if(id2 < 10){
		document.querySelector("#img2").src = "Data/pokemon/FRONT/00"+id2+".gif";
	}
	else if(id2 < 100){
		document.querySelector("#img2").src = "Data/pokemon/FRONT/0"+id2+".gif";
	}
	else{
		document.querySelector("#img2").src = "Data/pokemon/FRONT/"+id2+".gif";
	}
	document.querySelector("#img1").onload = function(){
		document.querySelector("#img1").height = document.querySelector("#img1").naturalHeight * 2;
		document.querySelector("#img1").width = document.querySelector("#img1").naturalWidth * 2;
	}
	document.querySelector("#img2").onload = function(){
		document.querySelector("#img2").height = document.querySelector("#img2").naturalHeight * 2;
		document.querySelector("#img2").width = document.querySelector("#img2").naturalWidth * 2;
	}
}
function reprise(){
	var xhr = new XMLHttpRequest();
        xhr.open('GET','redirection.php?reprise=',true);
        xhr.addEventListener('readystatechange', function () {
            if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
                var tab = JSON.parse(xhr.responseText);
                walk.coordx = tab[0]["coordX_last"];
                walk.coordy = tab[0]["coordY_last"];
                setBackground(tab[0]["map_actuel"]); 
            }});
        xhr.send();
}
function mapAleatoire(){
	var xhr = new XMLHttpRequest();
    xhr.open('GET','redirection.php?mapAleatoire=',true);
    xhr.addEventListener('readystatechange', function () {
        if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
        	reprise();
        }});
    xhr.send();
}
function abandon(){
	var xhr = new XMLHttpRequest();
        xhr.open('GET','redirection.php?abandon=',true);
        xhr.addEventListener('readystatechange', function () {
            if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
                isAlreadyInCombat();
            }});
        xhr.send();
}

function AfficherHud(){
	document.querySelector(".actionctn").style.display = "block";
	document.querySelector("#img1").style.display = "block";
	document.querySelector("#img2").style.display = "block";
	document.querySelector("#pokeBackHud").style.display = "block";
	document.querySelector("#pokeFrontHud").style.display = "block";
}
function closeHud(){
	document.querySelector(".actionctn").style.display = "none";
	document.querySelector("#img1").style.display = "none";
	document.querySelector("#img2").style.display = "none";
	document.querySelector("#pokeBackHud").style.display = "none";
	document.querySelector("#pokeFrontHud").style.display = "none";
	document.querySelector(".attaquectn").style.display = "none";
	document.querySelector("#loading").style.display= "none";
	document.querySelector(".objctn").style.display = "none";
}
function showAttaqueMenu(){
	document.querySelector(".actionctn").style.display = "none";
	document.querySelector(".objctn").style.display = "none";
	document.querySelector(".attaquectn").style.display = "block";
	actualiseAttaque(document.querySelector("#img1").idPokemon);
}
function showObjMenu(){
	document.querySelector(".objctn").style.display = "block";
	document.querySelector(".actionctn").style.display = "none";
	document.querySelector(".attaquectn").style.display = "none";
	UpdateNbrPotion();
	UpdateNbrPokeBall();
}
function showMenu(){
	document.querySelector(".actionctn").style.display = "block";
	document.querySelector(".attaquectn").style.display = "none";
	document.querySelector(".objctn").style.display = "none";

}
function hideMenu(){
	document.querySelector(".actionctn").style.display = "none";
	document.querySelector(".attaquectn").style.display = "none";
}
function lancerAttaque(numAttaque){
	var xhr = new XMLHttpRequest();
    xhr.open('GET','redirection.php?LanceAttaque='+numAttaque+"&"+"Poke="+document.querySelector("#img1").idPokemon,true);
    document.querySelector("#loading").style.display = "inline-block";
    hideMenu();
    xhr.addEventListener('readystatechange', function( 	){
	    	if ((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
	    		console.log(xhr.responseText);
	    		isAlreadyInCombat();
	    	}});
    xhr.send();
}
function initTour(){
	var xhr = new XMLHttpRequest();
    xhr.open('GET','redirection.php?getTour',true);
    xhr.addEventListener('readystatechange', function(){
    	if ((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
    		tour=xhr.responseText;
    		if(tour > 0){
    			tour = tour - 1;
    		}
    	}});
}
function getTour(){
	var xhr = new XMLHttpRequest();
    xhr.open('GET','redirection.php?getTour',true);
    xhr.addEventListener('readystatechange', function(){
	    	if ((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
	    		if(tour != xhr.responseText){
	    			isAlreadyInCombat();
	    			document.querySelector("#loading").style.display = "none";
					
					TourNew(tour);
	    			tour = xhr.responseText;
	    			
	    			
	    		}
	    		
	    	}});
    xhr.send();
}
function TourNew(tour){
	var xhr = new XMLHttpRequest();
    xhr.open('GET','redirection.php?Tour='+tour,true);
    	xhr.addEventListener('readystatechange', function(){
	    	if ((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
	    		var tab = JSON.parse(xhr.responseText);
	    		document.querySelector("#Dialogue").nextD = tab[0][1];
	    		document.querySelector("#Dialogue").nextD2= tab[1][1];
	    		document.querySelector("#Dialogue").atq = tab[0][0];
	    		document.querySelector("#Dialogue").atq2= tab[1][0];    
	    		document.querySelector("#Dialogue").p1 = tab[0][2];
	    		document.querySelector("#Dialogue").p2 = tab[1][2];
	    		dialogue(6);

	    	}});
    xhr.send();
}
function actualiseAttaque(numPoke){
	var xhr = new XMLHttpRequest();
	console.log(1);
    xhr.open('GET','redirection.php?attaquePoke='+numPoke,true);
    xhr.addEventListener('readystatechange', function(){
	    	if ((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
	    		var tab = JSON.parse(xhr.responseText);
	    		for(var i = 0 ; i<4; i++){
	    			if(i<tab.length){
	    				document.querySelector("#Attaque"+i).idAttaque = tab[i]["Num"];
	    				document.querySelector("#Attaque"+i+" .nomAttaque").innerHTML = tab[i]["Nom"];
	    				document.querySelector("#Attaque"+i+" .PP").innerHTML = (tab[i]["PP"] - tab[i]["PPUtilise"]) + "/" + tab[i]["PP"];
	    				document.querySelector("#Attaque"+i).onclick = function(){lancerAttaque(this.idAttaque);};

	    			}
	    			else{
	    				document.querySelector("#Attaque"+i).idAttaque = null;
	    				document.querySelector("#Attaque"+i+" .nomAttaque").innerHTML ="Vide";
	    				document.querySelector("#Attaque"+i+" .PP").innerHTML ="0/0";
	    			}


	    		}
	    	}});
    xhr.send();
}
function actualiseAttaque2(numPoke){
	var xhr = new XMLHttpRequest();
    xhr.open('GET','redirection.php?attaquePoke='+numPoke,true);
    console.log(2);
    xhr.addEventListener('readystatechange', function(){
	    	if ((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
	    		var tab = JSON.parse(xhr.responseText);
	    		for(var i = 0 ; i<4; i++){
	    			if(i<tab.length){
	    				document.querySelector("#Attaque"+i).idAttaque = tab[i]["Num"];
	    				document.querySelector("#Attaque"+i+" .nomAttaque").innerHTML = tab[i]["Nom"];
	    				document.querySelector("#Attaque"+i+" .PP").innerHTML = (tab[i]["PP"] - tab[i]["PPUtilise"]) + "/" + tab[i]["PP"];
	    				document.querySelector("#Attaque"+i).onclick = function(){oublierCapacite(this.idAttaque,document.querySelector("#Dialogue").poke);};
	    			}
	    		}
	    		document.querySelector(".actionctn").style.display = "none";
				document.querySelector(".objctn").style.display = "none";
				document.querySelector(".attaquectn").style.display = "block";
	    	}});
    xhr.send();
}
function UsePotion(){
	var xhr = new XMLHttpRequest();
    xhr.open('GET','redirection.php?UsePotion',true);
    xhr.send()
}
function UsePokeBall(){
	var xhr = new XMLHttpRequest();
    xhr.open('GET','redirection.php?UsePokeBall',true);
    xhr.send();
}
function UpdateNbrPotion(){
	var xhr = new XMLHttpRequest();
    xhr.open('GET','redirection.php?getNbrItem=11',true);
    xhr.addEventListener('readystatechange', function(){
	    	if ((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
	    		document.querySelector("#Potion .nbr").innerHTML = xhr.responseText;
	    	}});
    xhr.send();
}
function UpdateNbrPokeBall(){
	var xhr = new XMLHttpRequest();
    xhr.open('GET','redirection.php?getNbrItem=12',true);
    xhr.addEventListener('readystatechange', function(){
	    	if ((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
	    		document.querySelector("#PokeBall .nbr").innerHTML = xhr.responseText;
	    	}});
    xhr.send();
}
function getPokemonSortie(){
	var xhr = new XMLHttpRequest();
    xhr.open('GET','redirection.php?pokemonCombat',true);
    xhr.addEventListener('readystatechange', function(){
	    	if ((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
	    		var tab = JSON.parse(xhr.responseText);
	    		actualiseImage(tab["PokeBackID"],tab["PokeFrontID"],tab["PokeBack"],tab["PokeFront"]);
	    		initHpbarre(document.querySelector("#img1").idPokemon,document.querySelector("#pokeBackHud .pvrestant .pv_restant_modulable"));
	    		initNameLvl(document.querySelector("#img1").idPokemon,document.querySelector("#pokeBackHud .nomLvl"));
	    		initHpbarre(document.querySelector("#img2").idPokemon,document.querySelector("#pokeFrontHud .pvrestant .pv_restant_modulable"));
	    		initNameLvl(document.querySelector("#img2").idPokemon,document.querySelector("#pokeFrontHud .nomLvl"));
	    	}});
    xhr.send();
}

function pokemonClignote(numImgPokemon) {
	if (document.querySelector("#img"+numImgPokemon).style.visibility == "hidden") {
		document.querySelector("#img"+numImgPokemon).style.visibility = "visible";
	} else {
		document.querySelector("#img"+numImgPokemon).style.visibility = "hidden";
	}
}

// setInterval(pokemonClignote(1), 400);
// clearInterval(, 2000);

function initNameLvl(numPokemon,objet){
	var xhr = new XMLHttpRequest();
        xhr.open('GET','redirection.php?idPokemonVersNameLvl='+numPokemon,true);
        xhr.addEventListener('readystatechange', function () {
            if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
            	objet.innerHTML = xhr.responseText;
            }});
        xhr.send();
}
function initHpbarre(numPokemon,objet){
        var xhr = new XMLHttpRequest();
        xhr.open('GET','redirection.php?getPokemonHp='+numPokemon,true);
        xhr.addEventListener('readystatechange', function () {
            if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
                var tab = JSON.parse(xhr.responseText);
                for(var i = 0 ; i < tab.length ; i++){
                    objet.style.width = ((tab[i]["HP"] * 100) / tab[i]["HPmax"]) + "%";
                    objet.style.backgroundColor = "rgb(180," + (253 * ((tab[i]["HP"] * 100) / tab[i]["HPmax"]) / 100) + ",0)";
                }
            }});
        xhr.send();
    }
function LaunchCombat(){
	if(enCombat == 1){
		//On arrete de bouger
		walk.onMouvement = 0;
 		clearInterval(intervaleDeplacement);
 		setTimeout(setIdle(),1000);
 		getPokemonSortie();
 		setBackground("combat");
	}
}
function trycombat(){
	var xhr = new XMLHttpRequest();
    xhr.open('GET','redirection.php?rencontrePokemon='+background.map+'&X='+walk.coordx+'&Y='+walk.coordy,true);
    xhr.addEventListener('readystatechange', function(){
	    	if ((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
	    		if(xhr.responseText == "fight"){
	    			LaunchCombat();
	    		}
	    	}});
    xhr.send();
}
function isAlreadyInCombat(){
		var xhr = new XMLHttpRequest();
	    xhr.open('GET','redirection.php?isCombatStateOn',true);
	    xhr.addEventListener('readystatechange', function(){
	    console.log(enCombat);
	    	if ((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
	    		if(xhr.responseText == "true"){
	    			console.log("true");
	    			if(enCombat == 0){
	    				enCombat = 1;
	    				LaunchCombat();
	    				clearInterval(inter);
	    				console.log("nouveau inter2");
	    				inter2 = setInterval(getTour,1000);
	    				}
	    			}
	    		}
	    		if(xhr.responseText == "false"){
	    			console.log("false");
	    			if(enCombat == 1){
	    				console.log("clear inter2");
	    				clearInterval(inter2);
	    				enCombat = 0;
	    				setTimeout(closeHud,1000);
	    				reprise();
	    				inter = setInterval(isAlreadyInCombat,5000);
	    				verifierCapacite();
	    			}
	    		}
	    	});
	    xhr.send();
}
var enCombat = 0;
var inter = setInterval(isAlreadyInCombat,5000);
var inter2 = setInterval(getTour,1000);
clearInterval(inter2);
setInterval(isdemandeCombat,2000);
var canvaHidden = document.getElementById("zoneJouable");
var ctx = canvaHidden.getContext("2d");
ctx.scale(3,3);
var tour = 0;
initTour();
var background = new Image;
var walk = new Image; 
var glisse = new Image;
var currentLocation = document.location.href;
currentLocation = currentLocation.substring(0 ,currentLocation.lastIndexOf( "/" ) );
walk.src = currentLocation + "/maps/walk.png";
glisse.src = currentLocation + "/maps/glisse.png"
walk.direction = "bas";
walk.state = 0;
walk.onMouvement = 0;
var enDialogue = 0;
document.querySelector("#loading").src = currentLocation + "/maps/loading.gif"; 
reprise();
var intervaleDeplacement;
isAlreadyInCombat();
 document.querySelector("body").addEventListener('keydown', function(e) {
    switch (e.which) {
        //key code for left arrow
        case 37:
            if(walk.onMouvement == 0 && enCombat == 0 && enDialogue == 0){
        		walk.onMouvement = 2;
        		walk.direction = "gauche";
        		intervaleDeplacement = setInterval(deplacementG	,150);
        	}
        break;
         
        //key code for right arrow
        case 39:
            if(walk.onMouvement == 0 && enCombat == 0 && enDialogue == 0){
        		walk.onMouvement = 2;
        		walk.direction = "droite";
        		intervaleDeplacement = setInterval(deplacementD,150);
        	}
        break;
        //key code for down arrow
        case 40:
        	if(walk.onMouvement == 0 && enCombat == 0 && enDialogue == 0){
        		walk.onMouvement = 2;
        		walk.direction = "bas";
        		intervaleDeplacement = setInterval(deplacementB,150);
        	}
     	break;
     	//key code for up arrow
     	case 38:
     		if(walk.onMouvement == 0 && enCombat == 0 && enDialogue == 0){
        		walk.onMouvement = 2;
        		walk.direction = "haut";
        		intervaleDeplacement = setInterval(deplacementH,150);
        	}
        break;
        case 13:
        	if(enCombat == 0){
        		walk.onMouvement = 0;
 				clearInterval(intervaleDeplacement);
 				setTimeout(setIdle(),1000);
 				effectuerAction()

        	}
    }
});
 document.querySelector("body").addEventListener('keyup', function(e) {
 	walk.onMouvement = 0;
 	clearInterval(intervaleDeplacement);
 	setTimeout(setIdle(),1000);
 });
function closeDialogue(){
	document.querySelector("#Dialogue").style.display="none";
	enDialogue = 0;
}
function soignerPokemon(){
	var xhr = new XMLHttpRequest();
        xhr.open('GET','redirection.php?soignerPokemon',true);
        xhr.addEventListener('readystatechange', function () {
            if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
            	dialogue(1);
            }});
        xhr.send();
}
function accepterCombat(){
	var xhr = new XMLHttpRequest();
    xhr.open('GET','redirection.php?accepterCombat',true);
    xhr.send();
}
function refuserCombat(){
	var xhr = new XMLHttpRequest();
    xhr.open('GET','redirection.php?refuserCombat',true);
    xhr.send();
}
function isdemandeCombat(){
	if(enCombat == 0 && enDialogue == 0){
		var xhr = new XMLHttpRequest();
        xhr.open('GET','redirection.php?demandeCombat',true);
        xhr.addEventListener('readystatechange', function () {
            if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
            	if(xhr.responseText != "false"){
            		document.querySelector("#Dialogue").nextD = xhr.responseText;
            		dialogue(2);
            	}
            }});
        xhr.send();
	}
}
function verifierCapacite(){
	var xhr = new XMLHttpRequest();
        xhr.open('GET','redirection.php?PokemonAttaqueApprendre',true);
        xhr.addEventListener('readystatechange', function () {
            if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
            	if(xhr.responseText != "false"){
            		var tab = JSON.parse(xhr.responseText);
            	if (tab[0] == 0){
            		document.querySelector("#Dialogue").nextD = tab[1];
            		document.querySelector("#Dialogue").poke = tab[2];
            		document.querySelector("#Dialogue").Attaque = tab[3]
            		dialogue(3);
            		}
            	else if(tab[0] == 1){
            		document.querySelector("#Dialogue").nextD = tab[1];
            		document.querySelector("#Dialogue").poke = tab[2];
            		document.querySelector("#Dialogue").Attaque = tab[3]
            		dialogue(4);
            		}
            	}
            }});
        xhr.send();
}
function accepterCapacite(atq,poke){
	var xhr = new XMLHttpRequest();
        xhr.open('GET','redirection.php?accepterAttaque='+atq+'&poke='+poke,true);
        xhr.addEventListener('readystatechange', function () {
            if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
            	verifierCapacite();
            }});
        xhr.send();
}
function refuserCapacite(atq,poke){
	var xhr = new XMLHttpRequest();
        xhr.open('GET','redirection.php?refuserAttaque='+atq+'&poke='+poke,true);
        xhr.addEventListener('readystatechange', function () {
            if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
            	verifierCapacite();
            }});
        xhr.send();
}
function oublierCapacite(atq,poke){
	var xhr = new XMLHttpRequest();
        xhr.open('GET','redirection.php?oublierAttaque='+atq+'&poke='+poke,true);
        xhr.addEventListener('readystatechange', function () {
            if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
            	closeHud();
            	accepterCapacite(document.querySelector("#Dialogue").Attaque,document.querySelector("#Dialogue").poke);
            	closeDialogue();
            	verifierCapacite();
            }});
        xhr.send();
}
function dialogue(num){
	enDialogue = 1;
	if(num == 0){
		document.querySelector("#Dialogue #text").innerHTML = "Voulez-vous soigner vos Pokemon ?";
		document.querySelector("#Dialogue").style.display="block";
		document.querySelector("#oui").style.display = "inline-block";
		document.querySelector("#non").style.display = "inline-block";
		document.querySelector("#Suivant").style.display = "none";
		document.querySelector("#oui").onclick = function(){soignerPokemon();};
		document.querySelector("#non").onclick = function(){closeDialogue();};
	}
	if(num == 1){
		document.querySelector("#Dialogue #text").innerHTML = "Vos Pokemon sont soignés!";
		document.querySelector("#Dialogue").style.display="block";
		document.querySelector("#oui").style.display = "none";
		document.querySelector("#non").style.display = "none";
		document.querySelector("#Suivant").style.display = "inline-block";
		document.querySelector("#Suivant").onclick = function(){closeDialogue();};
	}
	if(num == 2){
		document.querySelector("#Dialogue #text").innerHTML = document.querySelector("#Dialogue").nextD;
		document.querySelector("#Dialogue").style.display="block";
		document.querySelector("#oui").style.display = "inline-block";
		document.querySelector("#non").style.display = "inline-block";
		document.querySelector("#Suivant").style.display = "none";
		document.querySelector("#oui").onclick = function(){accepterCombat();closeDialogue();};
		document.querySelector("#non").onclick = function(){refuserCombat();closeDialogue();};
	}
	if(num == 3){
		document.querySelector("#Dialogue #text").innerHTML = document.querySelector("#Dialogue").nextD;
		document.querySelector("#Dialogue").style.display="block";
		document.querySelector("#oui").style.display = "inline-block";
		document.querySelector("#non").style.display = "inline-block";
		document.querySelector("#Suivant").style.display = "none";
		document.querySelector("#oui").onclick = function(){accepterCapacite(document.querySelector("#Dialogue").Attaque,document.querySelector("#Dialogue").poke);closeDialogue();};
		document.querySelector("#non").onclick = function(){refuserCapacite(document.querySelector("#Dialogue").Attaque,document.querySelector("#Dialogue").poke);closeDialogue();};
	}
	if(num == 4){
		document.querySelector("#Dialogue #text").innerHTML = document.querySelector("#Dialogue").nextD;
		document.querySelector("#Dialogue").style.display="block";
		document.querySelector("#oui").style.display = "inline-block";
		document.querySelector("#non").style.display = "inline-block";
		document.querySelector("#Suivant").style.display = "none";
		document.querySelector("#oui").onclick = function(){dialogue(5);};
		document.querySelector("#non").onclick = function(){refuserCapacite(document.querySelector("#Dialogue").Attaque,document.querySelector("#Dialogue").poke);closeDialogue();};
	}
	if(num == 5){
		document.querySelector("#Dialogue #text").innerHTML = "Choisissez l'attaque à oublier.";
		document.querySelector("#Dialogue").style.display="block";
		document.querySelector("#oui").style.display = "none";
		document.querySelector("#non").style.display = "none";
		document.querySelector("#Suivant").style.display = "none";
		actualiseAttaque2(document.querySelector("#Dialogue").poke);

	}
	if(num == 6){
		document.querySelector("#Dialogue #text").innerHTML = document.querySelector("#Dialogue").nextD;
		document.querySelector("#Dialogue").style.display="block";
		document.querySelector("#oui").style.display = "none";
		document.querySelector("#non").style.display = "none";
		document.querySelector("#Suivant").style.display = "inline-block";
		document.querySelector("#Suivant").onclick = function(){dialogue(7);};
		if(document.querySelector("#Dialogue").atq == 0){
			if(document.querySelector("#Dialogue").p1 == "FRONT"){
				var interClignote = setInterval(function(){pokemonClignote(2);},100);
				setTimeout(function(){clearInterval(interClignote);document.querySelector("#img2").style.visibility = "visible";},1100);
				initHpbarre(document.querySelector("#img2").idPokemon,document.querySelector("#pokeFrontHud .pvrestant .pv_restant_modulable"));
			}
			if(document.querySelector("#Dialogue").p1 == "BACK"){
				var interClignote = setInterval(function(){pokemonClignote(1);},100);
				setTimeout(function(){clearInterval(interClignote);document.querySelector("#img1").style.visibility = "visible";},1100);
				initHpbarre(document.querySelector("#img1").idPokemon,document.querySelector("#pokeBackHud .pvrestant .pv_restant_modulable"));
			}	
		}
		if(document.querySelector("#Dialogue").atq == 2){
			let a = document.querySelector("#Dialogue").p1;
			if(a[2] == "BACK"){
				updateImage(a[1],a[0],2);
				initHpbarre(document.querySelector("#img2").idPokemon,document.querySelector("#pokeFrontHud .pvrestant .pv_restant_modulable"));
	    		initNameLvl(document.querySelector("#img2").idPokemon,document.querySelector("#pokeFrontHud .nomLvl"));
			}
			if(a[2] == "FRONT"){
				updateImage(a[1],a[0],1);
				initHpbarre(document.querySelector("#img1").idPokemon,document.querySelector("#pokeBackHud .pvrestant .pv_restant_modulable"));
	    		initNameLvl(document.querySelector("#img1").idPokemon,document.querySelector("#pokeBackHud .nomLvl"));
			}
		}
		if(document.querySelector("#Dialogue").atq == 1){
			let a = document.querySelector("#Dialogue").p1;
			if(a[0] == 11){
				if(a[1] == "BACK"){
					initHpbarre(document.querySelector("#img2").idPokemon,document.querySelector("#pokeFrontHud .pvrestant .pv_restant_modulable"));
				}
				if(a[1] == "FRONT"){
					initHpbarre(document.querySelector("#img1").idPokemon,document.querySelector("#pokeBackHud .pvrestant .pv_restant_modulable"));
				}
			}
		}
	}
	if(num==7){
		document.querySelector("#Dialogue #text").innerHTML = document.querySelector("#Dialogue").nextD2;
		document.querySelector("#Dialogue").style.display="block";
		document.querySelector("#oui").style.display = "none";
		document.querySelector("#non").style.display = "none";
		document.querySelector("#Suivant").style.display = "inline-block";
		document.querySelector("#Suivant").onclick = function(){showMenu();closeDialogue();};

		if(document.querySelector("#Dialogue").atq2 == 0){
			if(document.querySelector("#Dialogue").p2 == "FRONT"){
				var interClignote2 = setInterval(function(){pokemonClignote(2);},100);
				setTimeout(function(){clearInterval(interClignote2);document.querySelector("#img2").style.visibility = "visible";},1100);
				initHpbarre(document.querySelector("#img2").idPokemon,document.querySelector("#pokeFrontHud .pvrestant .pv_restant_modulable"));
			}
			if(document.querySelector("#Dialogue").p2 == "BACK"){
				var interClignote2 = setInterval(function(){pokemonClignote(1);},100);
				setTimeout(function(){clearInterval(interClignote2);document.querySelector("#img1").style.visibility = "visible";},1100);
				initHpbarre(document.querySelector("#img1").idPokemon,document.querySelector("#pokeBackHud .pvrestant .pv_restant_modulable"));
			}
			
		}
		if(document.querySelector("#Dialogue").atq2 == 2){
			let a = document.querySelector("#Dialogue").p2;
			if(a[2] == "BACK"){
				updateImage(a[1],a[0],2);
				initHpbarre(document.querySelector("#img2").idPokemon,document.querySelector("#pokeFrontHud .pvrestant .pv_restant_modulable"));
	    		initNameLvl(document.querySelector("#img2").idPokemon,document.querySelector("#pokeFrontHud .nomLvl"));
			}
			if(a[2] == "FRONT"){
				updateImage(a[1],a[0],1);
				initHpbarre(document.querySelector("#img1").idPokemon,document.querySelector("#pokeBackHud .pvrestant .pv_restant_modulable"));
	    		initNameLvl(document.querySelector("#img1").idPokemon,document.querySelector("#pokeBackHud .nomLvl"));
			}
		}
		if(document.querySelector("#Dialogue").atq2 == 1){
			let a = document.querySelector("#Dialogue").p2;
			if(a[0] == 11){
				if(a[1] == "BACK"){
					initHpbarre(document.querySelector("#img2").idPokemon,document.querySelector("#pokeFrontHud .pvrestant .pv_restant_modulable"));
				}
				if(a[1] == "FRONT"){
					initHpbarre(document.querySelector("#img1").idPokemon,document.querySelector("#pokeBackHud .pvrestant .pv_restant_modulable"));
				}
			}
		}
		getPokemonSortie();
	}
}
function effectuerAction(){
	console.log("Action on x:"+walk.coordx+" y:"+walk.coordy);
	if((walk.coordx == 116 && walk.coordy == 80) || (walk.coordx == 120 && walk.coordy == 80)){
		dialogue(0)
	}
	if((walk.coordx == 180 && walk.coordy == 52)){
		afficher_gerer_equipe();
	}
}
function autoriserDeplacement(x,y){
	//NOTATION : 0 -> pas autoriser , 1 -> autoriser , 2 -> nage , 3-> sortie de map , 4-> herbe , 5 -> saut d'obstacle
	//On commence par les bords
	console.log("x: " +x+ " y: "+y);
	if(background.map == "Lobby"){
		if(y>148){
			if(x>108 && x<124){
				return 3;
			}
			return 0;
		}
		if(y<=48){
			if(x>=196){
				return 0;
			}
			return 0;
		}
		if(x>12 && x<52){
			if(y<56){
				return 0;
			}
		}
		if(x>56 && x<180){
			if(y<80 && y>0){
				return 0;
			}
		}
		if(x<4){
			return 0; 
		}
		if(x<32 && x>0){
			if(y<136 && y>96){
				return 0;
			}
		}
		if(x>168 && x<208){
			if(y>104&& y<144){
				return 0;
			}
		}
		if(x>=228){
			return 0;
		}
		return 1;
	}
	if(background.map == "route01"){
		if(x<32){
			return 0;
		}
		else if(x>344){
			return 0;
		}
		
		//Maintenant qu'on a fait les bords evidents, on fait en fonction de x et de y pour minimiser les test.
		if (y<200){ //premier tier de la map
			if(y<24 && y>0){
				if (x>158 && x < 216){
					return 1;
				}
				return 0;
			}
			if(y <=-8){
				return 3;
			}
			if(x>120 && x<156){
				if(y>32 && y<184){
					return 0;
				}
			}
			if(y>=68 && y<=84){
				if(x>=32 && x<=244){
					if(walk.direction == "bas"){
						return 5;
					}
					else{return 0;}
				}
			}
			if(y>=88 && y<=152){
				if(x>=160 && x<=336){
					return 4;
				}
			}
			if(y>148&&y<164){
				if(x>28 && x<=116){
					if(walk.direction == "bas"){
						return 5;
					}
					else{return 0;}
				}
			}
		}
		else if (y < 300){
			if(y>208 && y<260){
				if(x>32 && x<68){
					return 0;
				}
				if(x>148 && x<256){
					return 0
				}
			}
			if(y>228 && y <248){
				if(x>=68 && x<=144){
					if(walk.direction == "bas"){
						return 5;
					}
					else{return 0;}
				}
			}
			if(y>=200 &&  y<=264){
				if(x>= 256 && x<=336){
					return 4;
				}
			}
		}
		else if(y<400){
			if(y>308&&y<324){
				if(x>=32&&x<=52 || x>=76 && x<=128 || x>=176 && x<=332){
					if(walk.direction == "bas"){
						return 5;
					}
					else{return 0;}
				}
				else{
					return 1;
				}
			}
			if(y>368 && y<416){
				if (x<192){
					return 0;
				}
			}
			if(y>=376 && y<=440){
				if(x>= 192 && x<=272){
					return 4;
				}
			}
			if(y>404 && y<420){
				if(x>=288 && x<=340){
					if(walk.direction == "bas"){
						return 5;
					}
					else{return 0;}
				}
			}
		}
		else if(y < 600){
			if(y>476 && y<504){
				if(x>128 && x<160){
					return 0;
				}
				if(x<=340 && x>=160 || x<84 && x>24){
					if(walk.direction == "bas"){
						return 5;
					}
					else{return 0;}
				}
				return 1;
			}
			if(y>=504 && y<= 556){
				if(x<=176 || x>=224){
					return 4;
				}
				return 1;
			}
		}	
		if(y>556 && y<624){
			if(x>=192 && x<=208){
				return 4;
			}
			else{
				return 0;
			}
		}
		if(y >= 628){
			return 3;
		}
		return 1;
	}
}