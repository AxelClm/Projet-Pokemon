<?php

session_start();

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Ajouter un ami</title>
        <link rel="stylesheet" type="text/css" href="css/add_friend.css">
    </head>
    <body>
        <div class="add_friend">
            <input type="text" id="find_friend" placeholder="Entrez votre recherche" oninput="update_addfriends_div()">
            <div></div>
        </div>
    </body>
</html>

<script>

    function request_friend(num_user){
        var match = document.querySelector("#find_friend").value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET','redirection.php?add_friend='+num_user,true);
        xhr.addEventListener('readystatechange',function(){

            if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
                update_addfriends_div();
            }
        });
        xhr.send();
    }

    function update_addfriends_div(){
        var match = document.querySelector("#find_friend").value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET','redirection.php?get_users_list='+match+'%',true);
        xhr.addEventListener('readystatechange',function(){
            if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
                var tab = JSON.parse(xhr.responseText);
                var text="";
                for (var i = 0; i < tab.length; i++){
                    text=text+"<div class='friends'><p class='user'><i class='fa fa-user' aria-hidden='true'></i> "+ tab[i]['username'] +"</p><p id=user_"+tab[i]['id']+" class='add'>Ajouter</p></div>";
                }
                document.querySelector('.add_friend div').innerHTML = text;
                for (var j = 0; j < tab.length; j++){
                    document.querySelector("#user_" + tab[j]['id']).id_user = tab[j]['id'];
                    document.querySelector("#user_" + tab[j]['id']).addEventListener("click",function(){
                        request_friend(this.id_user);
                    });
                }
            }
        });
        xhr.send();
    }
    update_addfriends_div();

</script>
