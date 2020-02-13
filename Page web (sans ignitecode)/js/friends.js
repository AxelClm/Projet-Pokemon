function accepter_demande(num){
    var xhr = new XMLHttpRequest
    xhr.open('GET','redirection.php?accepter_demande_r='+num);
    xhr.addEventListener('readystatechange',function(){
        if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
            update_social_div();
        }
    });
    xhr.send();
}

function refuser_demande(num){
    var xhr = new XMLHttpRequest
    xhr.open('GET','redirection.php?refuser_demande_r='+num);
    xhr.addEventListener('readystatechange',function(){
        if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
            update_social_div();
        }
    });
    xhr.send();
}

function update_demande_reçus(){
    var xhr = new XMLHttpRequest();
    xhr.open('GET','redirection.php?friends=demande_r',true);
    document.querySelector("#d_amis_titre").style.display = "none";
    xhr.addEventListener('readystatechange',function(){
        if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
            var tab = JSON.parse(xhr.responseText);
            document.querySelector(".demande_reçus").innerHTML = "";
            for (var i = 0;i<tab.length;i++){
                document.querySelector("#d_amis_titre").style.display = "block";
                let demande_friends = document.createElement("div");
                demande_friends.className = "demande_friends";
                    let left_demande_div = document.createElement("div");
                    left_demande_div.className = "left_demande_div";
                        let demande_img = document.createElement("div");
                        demande_img.className = "demande_img";
                        demande_img.innerHTML = "<i class=\"far fa-user-circle\"></i>";
                        left_demande_div.appendChild(demande_img);

                    demande_friends.appendChild(left_demande_div);
                    let middle_demande_friends = document.createElement("div");
                    middle_demande_friends.className = "middle_demande_friends";
                        let demande_name = document.createElement("div");
                        demande_name.className = "demande_name";
                        demande_name.innerHTML = tab[i]["username"];
                        middle_demande_friends.appendChild(demande_name);
                    demande_friends.appendChild(middle_demande_friends);
                    let right_demande_div = document.createElement("div");
                    right_demande_div.className = "right_demande_div";
                        let accepter_demande_d = document.createElement("div");
                        accepter_demande_d.className = "accepter_demande";
                        accepter_demande_d.innerHTML = "<i class='fa fa-check'></i>";
                        accepter_demande_d.invitation_cible = tab[i]["id"];
                        accepter_demande_d.onclick = function(){accepter_demande(this.invitation_cible);};
                        right_demande_div.appendChild(accepter_demande_d);

                        let refuser_demande_d = document.createElement("div")
                        refuser_demande_d.className = "refuser_demande";
                        refuser_demande_d.innerHTML = "<i class='fa fa-times'></i>";
                        refuser_demande_d.invitation_cible = tab[i]["id"];
                        refuser_demande_d.onclick = function(){refuser_demande(this.invitation_cible);};
                        right_demande_div.appendChild(refuser_demande_d);
                    demande_friends.appendChild(right_demande_div);
                document.querySelector(".demande_reçus").appendChild(demande_friends);

            }
        }
    });
    xhr.send();
}
function demanderEnDuel(num){
    var xhr = new XMLHttpRequest();
    xhr.open('GET','redirection.php?demanderEnDuel='+num,true);
    xhr.addEventListener('readystatechange',function(){
        if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
            if(xhr.responseText != "true"){
                alert("impossible de demande le joueur en combat pour l'instant");
            }
        }});
    xhr.send();
}
function update_friends_div(){
    var xhr = new XMLHttpRequest();
    xhr.open('GET','redirection.php?friends=friend_list',true);
    xhr.addEventListener('readystatechange',function(){
        if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
            var tab = JSON.parse(xhr.responseText);
            var time_actuel = Date.now()/1000;
            var time_deconnecter;
            document.querySelector(".online_friends").innerHTML = "";
            document.querySelector(".offline_friends").innerHTML = "";
            for (var i = 0;i<tab.length;i++){
                if(time_actuel - tab[i]['last_connect'] < 20){
                    let friends_div = document.createElement("div");
                    friends_div.className = "friends_div";
                        let left_friends_div = document.createElement("div");
                        left_friends_div.className = "left_friends_div";
                            friends_img = document.createElement("div");
                            friends_img.innerHTML = "<i class=\"far fa-user-circle\"></i>";
                            friends_img.className = "friends_img";
                            left_friends_div.appendChild(friends_img);
                        friends_div.appendChild(left_friends_div);
                        right_friends_div = document.createElement("div");
                        right_friends_div.className = "right_friends_div";
                            let friends_name = document.createElement("div");
                            friends_name.className = "friends_name";
                            friends_name.innerHTML = tab[i]["username"];
                            right_friends_div.appendChild(friends_name);

                            let friends_status = document.createElement("div");
                            friends_status.className = "friends_status";
                            friends_status.innerHTML = "<i class=\"fa fa-circle\"></i> En ligne";
                            right_friends_div.appendChild(friends_status);

                            let friends_activite = document.createElement("div");
                            friends_activite.className = "friends_activite";
                            friends_activite.innerHTML = tab[i]["map_actuel"];
                            right_friends_div.appendChild(friends_activite);

                        friends_div.appendChild(right_friends_div);
                        let fight_div = document.createElement("div");
                        fight_div.className = "fight_div";
                        fight_div.innerHTML = "<i class=\"fas fa-fire\"></i>";
                        fight_div.numId = tab[i]["id"];
                        fight_div.onclick = function(){demanderEnDuel(this.numId)};
                        friends_div.appendChild(fight_div);
                    document.querySelector(".online_friends").appendChild(friends_div);


                } else {
                    time_deconnecter = time_actuel - tab[i]['last_connect'];
                    if((time_actuel - tab[i]['last_connect']) < 3600){
                        time_deconnecter = parseInt(time_deconnecter/60) + ' minute(s)';

                    }
                    else if ((time_actuel - tab[i]['last_connect']) > 3600 && (time_actuel - tab[i]['last_connect']) < 86400 ){
                        time_deconnecter = parseInt(time_deconnecter/3600) + ' heure(s)';
                    }
                    else {
                        time_deconnecter = parseInt(time_deconnecter/86400) + ' jour(s)';
                    }
                    let friends_div = document.createElement("div");
                    friends_div.className = "friends_div";
                        let left_friends_div = document.createElement("div");
                        left_friends_div.className = "left_friends_div";
                            friends_img = document.createElement("div");
                            friends_img.innerHTML = "<i class=\"far fa-user-circle\"></i>";
                            friends_img.className = "friends_img";
                            left_friends_div.appendChild(friends_img);
                        friends_div.appendChild(left_friends_div);
                        right_friends_div = document.createElement("div");
                        right_friends_div.className = "right_friends_div";
                            let friends_name = document.createElement("div");
                            friends_name.className = "friends_name";
                            friends_name.innerHTML = tab[i]["username"];
                            right_friends_div.appendChild(friends_name);

                            let friends_status = document.createElement("div");
                            friends_status.className = "friends_status";
                            friends_status.innerHTML = "<i class=\"fa fa-circle\"></i> Hors-ligne";
                            right_friends_div.appendChild(friends_status);

                            let friends_activite = document.createElement("div");
                            friends_activite.className = "friends_activite";
                            friends_activite.innerHTML = "Il y a "+time_deconnecter;
                            right_friends_div.appendChild(friends_activite);

                        friends_div.appendChild(right_friends_div);

                    document.querySelector(".offline_friends").appendChild(friends_div);

                }
            }
        }
    });
    xhr.send();
}

function update_social_div(){
    update_demande_reçus();
    update_friends_div();
}

update_social_div();
setInterval(update_demande_reçus,5000); // 5000
setInterval(update_friends_div,10000); // 10000
