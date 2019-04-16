function create_fenetre(){
        let window_div = document.createElement("div");
        let topbar_div = document.createElement("div");
        let close_div  = document.createElement("div");
        let content = document.createElement("div");
        window_div.className = "window";
        topbar_div.className = "topbar";
        close_div.className = "close";
        content.className = "window_content"
        document.querySelector("body").appendChild(window_div);
        document.querySelector(".window").appendChild(topbar_div);
        document.querySelector(".topbar").appendChild(close_div);
        document.querySelector(".close").innerHTML = 'x';
        document.querySelector(".window").appendChild(content);
        document.querySelector(".close").addEventListener("click",function ()
            { 
            document.querySelector("body").removeChild(document.querySelector(".window")); 
            openFenetre = 0;
            });

    }
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
                        equipe_droit_pv.innerHTML ="PV:"
                        pokemon_div_equipe_droit.appendChild(equipe_droit_pv);
                        
                        let equipe_droit_numpv=document.createElement("div");
                        equipe_droit_numpv.className="equipe_droit_numpv";
                        equipe_droit_numpv.innerHTML="XXXX/XXXX";
                        pokemon_div_equipe_droit.appendChild(equipe_droit_numpv);

                        pokemon_div_equipe.Id_pokemon = tab[i]['Id_pokemon'];
                        pokemon_div_equipe.place_dans_equipe = i + 1;
                        
                        let boutons_div= document.createElement("div");
                        boutons_div.className="boutons_div";
                        pokemon_div_equipe.appendChild(boutons_div);

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
                document.querySelector(".equipe_pokemon_div").appendChild(pokemon_div_equipe);
                }
               
            }
        });
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
        let boite_pokemon_div = document.createElement("div");
        equipe_pokemon_div.className = "equipe_pokemon_div";
        boite_pokemon_div.className = "boite_pokemon_div";
        document.querySelector(".window_content").appendChild(equipe_pokemon_div);
        document.querySelector(".window_content").appendChild(boite_pokemon_div);
        openGereEquipe = 1;
        document.querySelector(".close").addEventListener("click",function ()
            { 
            openGereEquipe = 0; 
            });
    }
    function afficher_gerer_equipe(){
        if (openGereEquipe == 0 && openFenetre == 0){
            create_fenetre();
            setFenetreGererEquipeP();
            update_pokemon_div();
            update_pokemon_boite();
        }
    }
    var afficher_pokemon_equipe = 0;
    var openGereEquipe = 0;
    var openFenetre = 0;
    