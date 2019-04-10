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
        xhr.addEventListener('readystatechange',function(){
            if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
                var tab = JSON.parse(xhr.responseText);
                var text="";
                for (var i = 0;i<tab.length;i++){
                  text = text+"<div><p>"+tab[i]['username']+"</p><p id='demande_add_"+tab[i]['id']+"' class='btn'>Accepter</p>"+"<p id='demande_refus_"+tab[i]['id']+"' class='btn'>Refuser</p></div>";
                }
                document.querySelector(".demande_reçus").innerHTML = text;
                for (var j = 0;j<tab.length;j++){
                    document.querySelector("#demande_add_"+tab[j]['id']).invitation_cible = tab[j]['id'];
                    document.querySelector("#demande_add_"+tab[j]['id']).addEventListener("click",function () {accepter_demande(this.invitation_cible);});
                    document.querySelector("#demande_refus_"+tab[j]['id']).invitation_cible = tab[j]['id'];
                    document.querySelector("#demande_refus_"+tab[j]['id']).addEventListener("click",function () {refuser_demande(this.invitation_cible);});

                }
            }
        });
        xhr.send();
    }

    function update_friends_div(){
        var xhr = new XMLHttpRequest();
        xhr.open('GET','redirection.php?friends=friend_list',true);
        xhr.addEventListener('readystatechange',function(){
            if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
                var tab = JSON.parse(xhr.responseText);
                var text_online="";
                var text_offline="";
                var time_actuel = Date.now()/1000;
                var time_deconnecter;
                for (var i = 0;i<tab.length;i++){
                    if(time_actuel - tab[i]['last_connect'] < 20){
                        text_online = text_online + "<div>"+"<p>"+tab[i]["username"]+"</p>"+"<p>En ligne</p>"+"</div>";
                } else {
                    time_deconnecter = time_actuel - tab[i]['last_connect'];
                    if((time_actuel - tab[i]['last_connect']) < 60){
                        time_deconnecter = parseInt(time_deconnecter/60) + ' minutes(s)';
                        
                    }
                    else if ((time_actuel - tab[i]['last_connect']) > 3600 && (time_actuel - tab[i]['last_connect']) < 86400 ){
                        time_deconnecter = parseInt(time_deconnecter/3600) + ' heure(s)';
                    } 
                    else {
                        time_deconnecter = parseInt(time_deconnecter/86400) + ' jour(s)';
                    }
                    text_offline = text_offline  + "<div>"+"<p>"+tab[i]["username"]+"</p>"+"<p>Hors-ligne depuis "+ time_deconnecter+"</p>"+"</div>";
                    }
                }
                document.querySelector(".online_friends").innerHTML = text_online;
                document.querySelector(".offline_friends").innerHTML = text_offline;
            }
        });
        xhr.send();
    }

    function update_social_div(){
        update_demande_reçus();
        update_friends_div();
    }
update_social_div();
    setInterval(update_demande_reçus,5000);
    setInterval(update_friends_div,10000);