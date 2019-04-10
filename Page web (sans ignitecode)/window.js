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
    function update_pokemon_div(){
        var xhr = new XMLHttpRequest();
        xhr.open('GET','redirection.php?get_pokemon_equipe=true',true);
        xhr.addEventListener('readystatechange', function () {
            if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
                var tab = JSON.parse(xhr.responseText);
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
                        pokemon_div_equipe.onclick = function(){console.log(this.Id_pokemon + "&&" + this.place_dans_equipe)};
                    }
                document.querySelector(".equipe_pokemon_div").appendChild(pokemon_div_equipe);
                }
               
            }
        });
        xhr.send();
    }
    function update_pokemon_boite(){
        var xhr = new XMLHttpRequest();
        xhr.open('GET','redirection.php?get_pokemon_boite=true',true);
        xhr.addEventListener('readystatechange', function () {
            if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
                var tab = JSON.parse(xhr.responseText);
                text_pokemon = '<p>boite<p>';
                for(var i = 0 ; i < tab.length ; i++){
                    text_pokemon = text_pokemon + "<div class=\"boite_pokemon\">"+afficher_pokemon("miniature",tab[i]["Num_pokemon"])+"<p> "+tab[i]["Nom"]+"</p><p> lvl: "+tab[i]["Niveau"]+"</p></div>";
                }
                document.querySelector(".boite_pokemon_div").innerHTML = text_pokemon;
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
    var openGereEquipe = 0;
    var openFenetre = 0;
    