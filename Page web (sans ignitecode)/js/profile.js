function afficherProfil() {
	create_fenetre();
	afficherProfile();
}

function afficherProfilImg() {
	return '<i class="fa fa-user-circle" aria-hidden="true" onclick="afficherProfil()"></i>';
}

function afficherItem(numItem) {
	return "<img src=Data/items/"+numItem+".png>";
}

function afficherProfilePokedexPokemon(num){
	return "<img src=Data/pokemon/miniature/"+num+".png>";
}

// function getNomObjet(numItem) {
// 	var xhr = new XMLHttpRequest();
//     xhr.open('GET','redirection.php?getNomObjet='+numItem, true);
//     xhr.send();
// }

function afficherInventaireDresseur() {
	var xhr = new XMLHttpRequest();
	xhr.open('GET','redirection.php?afficherInventaireDresseur=true', true);
	xhr.addEventListener('readystatechange', function () {
		if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)) {
			var tab = JSON.parse(xhr.responseText);

			for (var i = 0; i < tab.length; i++) {
				let objetDiv = document.createElement("div");
				objetDiv.className = "objetDiv";
				document.querySelector(".inventaireTabDresseurListe").appendChild(objetDiv);

					let objetQqte = document.createElement("div");
					objetQqte.className = "objetQqte";
					objetQqte.innerHTML = 'x'+tab[i]['qqte'];
					objetDiv.appendChild(objetQqte);

					let objetImg = document.createElement("div");
					objetImg.className = "objetImg";
					objetImg.innerHTML = afficherItem(tab[i]['num_objet'])
					objetDiv.appendChild(objetImg);

					let objetName = document.createElement("div");
					objetName.className = "objetName";
					objetName.innerHTML = tab[i]['Nom'];
					objetDiv.appendChild(objetName);
			}
		}
	});
	xhr.send();
}

function padLeft(nr, n, str){
    return Array(n-String(nr).length+1).join(str||'0')+nr;
}

function pad(number, length) {
    var str = '' + number;
    while (str.length < length) {
        str = '0' + str;
    }
    return str;
}

function afficherPokedex() {
	var xhr = new XMLHttpRequest();
	xhr.open('GET','redirection.php?afficherPokedex=true', true);
	xhr.addEventListener('readystatechange', function () {
		if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)) {
			var tab = JSON.parse(xhr.responseText);

			for (var i = 0; i < tab.length; i++) {
				let profilePokemonDiv = document.createElement("div");
				profilePokemonDiv.className = "profilePokemonDiv";
				document.querySelector(".pokedexTabPkmnList").appendChild(profilePokemonDiv);

					let profilePokemonNum = document.createElement("div");
					profilePokemonNum.className = "profilePokemonNum";
					profilePokemonNum.innerHTML = pad(tab[i]['Num'], 3);
					profilePokemonDiv.appendChild(profilePokemonNum);

					let profilePokemonImg = document.createElement("div");
					profilePokemonImg.className = "profilePokemonImg";
					profilePokemonImg.innerHTML = afficherProfilePokedexPokemon(tab[i]['Num']);
					profilePokemonDiv.appendChild(profilePokemonImg);

					let profilePokemonName = document.createElement("div");
					profilePokemonName.className = "profilePokemonName";
					profilePokemonName.innerHTML = tab[i]['Nom'];
					profilePokemonDiv.appendChild(profilePokemonName);
			}
		}
	});
	xhr.send();
}

function afficherProfile() {
	var xhr = new XMLHttpRequest();
	xhr.open('GET','redirection.php?afficherProfile=true', true);
	xhr.addEventListener('readystatechange', function () {
		if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
			var table = JSON.parse(xhr.responseText);

			document.querySelector(".window_content").innerHTML = '';
			document.querySelector("html").style.boxSizing = "border-box"; // Très très important

			let profileDiv = document.createElement("div");
			profileDiv.className = "profileDiv";

				let tab = document.createElement("div");
				tab.className = "tab";
				profileDiv.appendChild(tab);

					let profileHeader = document.createElement("div");
					profileHeader.className = "profileHeader";
					tab.appendChild(profileHeader);

						let profileImg = document.createElement("div");
						profileImg.className = "profileImg";
						profileImg.innerHTML = afficherProfilImg();
						profileHeader.appendChild(profileImg);

						let profileName = document.createElement("div");
						profileName.className = "profileName";
						profileName.innerHTML = table['Nom'];
						profileHeader.appendChild(profileName);

						let profileDateInscription = document.createElement("div");
						profileDateInscription.className = "profileDateInscription";
						profileDateInscription.innerHTML = 'Inscrit le '+table['dateInscription'];
						profileHeader.appendChild(profileDateInscription);

					let buttonCombat = document.createElement("button");
					buttonCombat.className = "tablinks";
					buttonCombat.id = "defaultOpen";
					buttonCombat.innerHTML = "Combat";
					tab.appendChild(buttonCombat);

					let buttonInventaire = document.createElement("button");
					buttonInventaire.className = "tablinks";
					buttonInventaire.innerHTML = "Inventaire";
					tab.appendChild(buttonInventaire);

					let buttonPokedex = document.createElement("button");
					buttonPokedex.className = "tablinks";
					buttonPokedex.innerHTML = "Pokedex";
					tab.appendChild(buttonPokedex);

				let tabcontentCom = document.createElement("div");
				tabcontentCom.className = "tabcontent";
				tabcontentCom.id = "combatTab";
				profileDiv.appendChild(tabcontentCom);

					let combatTabNbCombat = document.createElement("div");
					combatTabNbCombat.className = "combatTabNbCombat";
					let pluriel = '';
					if (table['nbCombat'] > 1)
						pluriel = 's';
					combatTabNbCombat.innerHTML = table['nbCombat']+' combat'+pluriel+' joué'+pluriel;
					tabcontentCom.appendChild(combatTabNbCombat);

					let combatTabRatio = document.createElement("div");
					combatTabRatio.className = "combatTabRatio";
					combatTabRatio.innerHTML = 'Ratio '+table['ratio']+'%';
					tabcontentCom.appendChild(combatTabRatio);

					let combatTabVictoire = document.createElement("div");
					combatTabVictoire.className = "combatTabVictoire";
					pluriel = '';
					if (table['nbVictoire'] > 1)
						pluriel = 's';
					combatTabVictoire.innerHTML = table['nbVictoire']+' victoire'+pluriel;
					tabcontentCom.appendChild(combatTabVictoire);

					let combatTabDefaite = document.createElement("div");
					combatTabDefaite.className = "combatTabDefaite";
					pluriel = '';
					if (table['nbDefaite'] > 1)
						pluriel = 's';
					combatTabDefaite.innerHTML = table['nbDefaite']+' défaite'+pluriel;
					tabcontentCom.appendChild(combatTabDefaite);

				let tabcontentInv = document.createElement("div");
				tabcontentInv.className = "tabcontent";
				tabcontentInv.id = "inventaireTab";
				profileDiv.appendChild(tabcontentInv);

					let inventaireTabDresseurListe = document.createElement("div");
					inventaireTabDresseurListe.className = "inventaireTabDresseurListe";
					tabcontentInv.appendChild(inventaireTabDresseurListe);

					afficherInventaireDresseur();

				let tabcontentPkdx = document.createElement("div");
				tabcontentPkdx.className = "tabcontent";
				tabcontentPkdx.id = "pokedexTab";
				profileDiv.appendChild(tabcontentPkdx);

					let pokedexTabPkmnList = document.createElement("div");
					pokedexTabPkmnList.className = "pokedexTabPkmnList";
					tabcontentPkdx.appendChild(pokedexTabPkmnList);

					afficherPokedex();

				buttonCombat.onclick = function() { openTab(this, 'combatTab')};
				buttonInventaire.onclick = function() { openTab(this, 'inventaireTab')};
				buttonPokedex.onclick = function() { openTab(this, 'pokedexTab')};

			document.querySelector(".window_content").appendChild(profileDiv);
		}
	});
	xhr.send();
}

function openTab(evt, nameTab) {
	var i, tabcontent, tablinks;
	tabcontent = document.getElementsByClassName("tabcontent");
	
	for (i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
	}
  	tablinks = document.getElementsByClassName("tablinks");
  	
  	for (i = 0; i < tablinks.length; i++) {
    	tablinks[i].className = tablinks[i].className.replace(" active", "");
  	}
  	document.getElementById(nameTab).style.display = "block";
  	evt.className += " active";
}
