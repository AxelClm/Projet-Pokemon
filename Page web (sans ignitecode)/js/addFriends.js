
function request_friend(num_user){
    var xhr = new XMLHttpRequest();
    xhr.open('GET','redirection.php?add_friend='+num_user,true);
    xhr.addEventListener('readystatechange', function(){
        if ((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
            updateAddFriendDiv();
        }
    });
    xhr.send();
}

function updateAddFriendDiv(){
	var match = document.querySelector(".inputRequest").value;
	var xhr = new XMLHttpRequest();
    xhr.open('GET','redirection.php?get_users_list='+match+'%',true);
    xhr.addEventListener('readystatechange', function(){
        if ((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
            var tab = JSON.parse(xhr.responseText);
            document.querySelector(".requestDiv").innerHTML = '';
            for(var i = 0; i < tab.length; i++){
                let joueurDiv = document.createElement("div");
                joueurDiv.className = "joueurDiv";
                    let joueurDivLeft = document.createElement("div");
                    joueurDivLeft.className = "joueurDivLeft";
                    joueurDivLeft.innerHTML = "<i class=\"far fa-user-circle\"></i>";
                joueurDiv.appendChild(joueurDivLeft);
                    let joueurDivRight = document.createElement("div");
                    joueurDivRight.className = "joueurDivRight";
                        let joueurName = document.createElement("div");
                        joueurName.className = "joueurName";
                        joueurName.innerHTML = tab[i]["username"];
                    joueurDivRight.appendChild(joueurName);
                        let joueurDemander = document.createElement("div");
                        joueurDemander.className = "joueurDemander";
                        joueurDemander.innerHTML = "Demander en ami";
                        joueurDemander.demandeCible = tab[i]["id"];
                        joueurDemander.onclick = function(){request_friend(this.demandeCible)};
                    joueurDivRight.appendChild(joueurDemander);
                joueurDiv.appendChild(joueurDivRight);

                document.querySelector(".requestDiv").appendChild(joueurDiv);
            }
        }});
    xhr.send();
}


function setFenetreAddFriendsDiv(){
    document.querySelector("html").style.boxSizing = "content-box";
    
	let findFriend = document.createElement("div");
	findFriend.className = "findFriend";
		let inputRequest = document.createElement("input");
		inputRequest.className = "inputRequest";
		inputRequest.type = "text";
		inputRequest.placeholder = "Entrez votre recherche...";
		inputRequest.oninput = function(){
            updateAddFriendDiv();
        };
		findFriend.appendChild(inputRequest);
	document.querySelector(".window_content").appendChild(findFriend);

	let requestDiv = document.createElement("div")
	requestDiv.className = "requestDiv";
	document.querySelector(".window_content").appendChild(requestDiv);
}
function afficherDemandeAmis(){
    create_fenetre();
    setFenetreAddFriendsDiv();
    updateAddFriendDiv();
}