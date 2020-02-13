    function afficher_pokemon(typeAffichage,numPokemon){
        if(typeAffichage == "miniature" || typeAffichage == "miniature_shiny"){
            return "<img src=Data/pokemon/"+typeAffichage+"/"+numPokemon+".png>";
        }
        return "<img src=Data/pokemon/"+typeAffichage+"/"+numPokemon+".gif>"
    }
    function swap_pokemon(numPokemon1,numPokemon2){
        var xhr = new XMLHttpRequest();
        xhr.open('GET','redirection.php?Swap_Pokemon_id='+numPokemon1+'&with='+numPokemon2,true);
        xhr.addEventListener('readystatechange', function () {
            if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
               update_pokemon_div();
            }});
        xhr.send()

    }
    function pokemon_vers_boite(numPokemon1){
        var xhr = new XMLHttpRequest();
        xhr.open('GET','redirection.php?Pokemon_vers_boite='+numPokemon1,true);
        xhr.addEventListener('readystatechange', function () {
            if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
               update_pokemon_div();
               update_pokemon_boite();
            }});
        xhr.send()

    }
    function getPokemonHp(numPokemon,objet){
        var xhr = new XMLHttpRequest();
        xhr.open('GET','redirection.php?getPokemonHp='+numPokemon,true);
        xhr.addEventListener('readystatechange', function () {
            if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
                var tab = JSON.parse(xhr.responseText);
                for(var i = 0 ; i < tab.length ; i++){
                    objet.innerHTML = tab[i]["HP"] + "/" + tab[i]["HPmax"];
                }
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
    function update_pokemon_div(){
        var xhr = new XMLHttpRequest();
        xhr.open('GET','redirection.php?get_pokemon_equipe=true',true);
        xhr.addEventListener('readystatechange', function () {
            if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
                var tab = JSON.parse(xhr.responseText);
                document.querySelector(".equipe_pokemon_div").innerHTML = "";
                for(var i = 0 ; i < 6 ; i++){
                        let pokemon_div_equipe = document.createElement("div");
                        pokemon_div_equipe.className = "pokemon_div_equipe";
                    if(i<tab.length){
                        let pokemon_div_equipe_gauche = document.createElement("div");
                        pokemon_div_equipe_gauche.className = "pokemon_div_equipe_gauche";
                        pokemon_div_equipe.appendChild(pokemon_div_equipe_gauche);

                        let equipe_gauche_img = document.createElement("div");
                        equipe_gauche_img.className="equipe_gauche_img";
                        equipe_gauche_img.innerHTML= afficher_pokemon("miniature",tab[i]['Num_pokemon']);
                        pokemon_div_equipe_gauche.appendChild(equipe_gauche_img);

                        let equipe_gauche_lvl = document.createElement("div");
                        equipe_gauche_lvl.className="equipe_gauche_lvl";
                        equipe_gauche_lvl.innerHTML="N." + tab[i]['Niveau'];
                        pokemon_div_equipe_gauche.appendChild(equipe_gauche_lvl);

                        let pokemon_div_equipe_droit = document.createElement("div");
                        pokemon_div_equipe_droit.className="pokemon_div_equipe_droit";
                        pokemon_div_equipe.appendChild(pokemon_div_equipe_droit);

                        let equipe_droit_nom=document.createElement("div");
                        equipe_droit_nom.className="equipe_droit_nom";
                        equipe_droit_nom.innerHTML=tab[i]["Nom"];
                        pokemon_div_equipe_droit.appendChild(equipe_droit_nom);

                        let equipe_droit_pv=document.createElement("div");
                        equipe_droit_pv.className ="equipe_droit_pv";
                          let equipe_droit_pv_num = document.createElement("div");
                          equipe_droit_pv_num.className = "equipe_droit_pv_num";
                        equipe_droit_pv.appendChild(equipe_droit_pv_num);
                          let equipe_droit_pv_restant = document .createElement ("div");
                          equipe_droit_pv_restant.className = "equipe_droit_pv_restant";
                            let pv_restant_modulable = document.createElement("div");
                            pv_restant_modulable.Id_pokemon = tab[i]["Id_pokemon"];
                            pv_restant_modulable.className = "pv_restant_modulable";
                            initHpbarre(pv_restant_modulable.Id_pokemon , pv_restant_modulable);
                          equipe_droit_pv_restant.appendChild(pv_restant_modulable);
                        equipe_droit_pv.appendChild(equipe_droit_pv_restant);
                        pokemon_div_equipe_droit.appendChild(equipe_droit_pv);

                        let equipe_droit_numpv=document.createElement("div");
                        equipe_droit_numpv.className="equipe_droit_numpv";
                        equipe_droit_numpv.Id_pokemon = tab[i]["Id_pokemon"];
                        equipe_droit_numpv.innerHTML="????/????";
                        getPokemonHp(equipe_droit_numpv.Id_pokemon,equipe_droit_numpv);
                        pokemon_div_equipe_droit.appendChild(equipe_droit_numpv);

                        pokemon_div_equipe.Id_pokemon = tab[i]['Id_pokemon'];
                        pokemon_div_equipe.place_dans_equipe = i + 1;

                        let boutons_div= document.createElement("div");
                        boutons_div.className="boutons_div";
                        pokemon_div_equipe.appendChild(boutons_div);
                        if(enCombat == 0){
                            let bouton_haut = document.createElement("div");
                            bouton_haut.pokemon_id = tab[i]["Id_pokemon"];
                            bouton_haut.className="triangle_haut";
                            if(i == 0){
                                bouton_haut.pointeur_pokemon = tab[tab.length - 1]["Id_pokemon"];
                            }
                            else{
                                bouton_haut.pointeur_pokemon = tab[i - 1]["Id_pokemon"];
                            }
                            bouton_haut.onclick = function(){swap_pokemon(this.pokemon_id,this.pointeur_pokemon);};
                            boutons_div.appendChild(bouton_haut);
                            let bouton_bas = document.createElement("div");
                            bouton_bas.pokemon_id = tab[i]["Id_pokemon"];
                            bouton_bas.className="triangle_bas";
                            if(i == tab.length - 1){
                                bouton_bas.pointeur_pokemon = tab[0]["Id_pokemon"];
                            }
                            else{
                                if(tab.length >= i+1){
                                    bouton_bas.pointeur_pokemon = tab[i + 1]["Id_pokemon"];
                                }
                            }
                            bouton_bas.onclick = function(){swap_pokemon(this.pokemon_id,this.pointeur_pokemon);};
                            boutons_div.appendChild(bouton_bas);

                            let bouton_droit = document.createElement("div");
                            bouton_droit.className="triangle_droit";
                            bouton_droit.pokemon_id = tab[i]["Id_pokemon"];
                            bouton_droit.onclick = function(){pokemon_vers_boite(this.pokemon_id);};
                            boutons_div.appendChild(bouton_droit);
                        }
                        else{
                            if(i>0){
                            let boutonSwap = document.createElement("div");
                            boutonSwap.className = "boutonSwap";
                            boutonSwap.innerHTML = "<i class=\"fas fa-exchange-alt\"></i>";
                            boutonSwap.Id_pokemon = tab[i]["Id_pokemon"];
                            boutonSwap.onclick = function(){
                                pokemonSwapDuringFight(this.Id_pokemon);
                                document.querySelector("body").removeChild(document.querySelector(".window"));
                                document.querySelector("#loading").style.display = "inline-block";
                                hideMenu();
                                };
                            boutons_div.appendChild(boutonSwap);
                            }
                        }

                    }
                document.querySelector(".equipe_pokemon_div").appendChild(pokemon_div_equipe);
                }

            }
        });
        xhr.send();
    }
    function pokemonSwapDuringFight(numPokemon1){
        var xhr = new XMLHttpRequest();
        xhr.open('GET','redirection.php?swapPokemonDuringCombat='+numPokemon1,true);
        xhr.addEventListener('readystatechange', function () {
            if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
            }});
        xhr.send();
    }
    function pokemon_vers_equipe(numPokemon1){
        var xhr = new XMLHttpRequest();
        xhr.open('GET','redirection.php?Pokemon_vers_equipe='+numPokemon1,true);
        xhr.addEventListener('readystatechange', function () {
            if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
               update_pokemon_div();
               update_pokemon_boite();
            }});
        xhr.send()

    }
    function update_pokemon_boite(){
        var xhr = new XMLHttpRequest();
        xhr.open('GET','redirection.php?get_pokemon_boite=true',true);
        xhr.addEventListener('readystatechange', function () {
            if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
                document.querySelector(".boite_pokemon_div").innerHTML = '';
                var tab = JSON.parse(xhr.responseText);
                if(background.map != "Lobby"){
                        document.querySelector(".boite_pokemon_div").innerHTML = 
                        "<p style=\"text-align :center;margin-top : 20px;color:red;\">/!\\ Impossible de transferer des Pokemons dans la boite en dehors du Centre Pokemon /!\\</p><br>"
                    }
                for(var i = 0 ; i < tab.length ; i++){
                    let pokemon_div_boite = document.createElement("div");
                    pokemon_div_boite.className = "pokemon_div_boite";
                    pokemon_div_boite.Id_pokemon = tab[i]["Id_pokemon"];
                        let container = document.createElement("div");
                        container.className = "pokemon_boite_container";

                            let img_pokemon = document.createElement("div");
                            img_pokemon.className = "img_div_boite";
                            img_pokemon.innerHTML = afficher_pokemon("miniature",tab[i]['Num_pokemon']);
                            container.appendChild(img_pokemon);

                            let pokemon_name = document.createElement("div");
                            pokemon_name.className = "name_pokemon_boite";
                            pokemon_name.innerHTML = tab[i]["Nom"] + " N." + tab[i]["Niveau"];
                            container.appendChild(pokemon_name);

                        pokemon_div_boite.appendChild(container);
                        let boite_middle = document.createElement("div");
                        boite_middle.className = "boite_middle";
                            let fleche=document.createElement("div");
                            fleche.className = "boite_fleche";
                            fleche.pokemon_id = tab[i]["Id_pokemon"];
                            fleche.onclick = function(){pokemon_vers_equipe(this.pokemon_id);};
                            boite_middle.appendChild(fleche);
                        pokemon_div_boite.appendChild(boite_middle);
                    document.querySelector(".boite_pokemon_div").appendChild(pokemon_div_boite);
                }
            }
        });
        xhr.send();
    }
    function setFenetreGererEquipeP(){
        let equipe_pokemon_div = document.createElement("div");
        equipe_pokemon_div.className = "equipe_pokemon_div";

        let boite_pokemon_div = document.createElement("div");
        boite_pokemon_div.className = "boite_pokemon_div";

        document.querySelector(".window_content").appendChild(equipe_pokemon_div);
        document.querySelector(".window_content").appendChild(boite_pokemon_div);

    }
function afficher_gerer_equipe(){
        create_fenetre();
        setFenetreGererEquipeP();
        update_pokemon_div();
        update_pokemon_boite();
}
