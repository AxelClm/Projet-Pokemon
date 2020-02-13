function afficherItem(numItem) {
	return "<img src=Data/items/"+numItem+".png>";
}

function afficherShop() {
	create_fenetre();
	afficherShopping();
}

function acheteItem(numItem) {
	var xhr = new XMLHttpRequest();
    xhr.open('GET','redirection.php?acheteItem='+numItem, true);
    xhr.addEventListener('readystatechange', function() {
        if ((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
        	afficherArgentDresseur();
        }
    });
    xhr.send();
}

function afficherArgentDresseur() {
	var xhr = new XMLHttpRequest();
    xhr.open('GET','redirection.php?afficherArgentDresseur=true', true);
    xhr.addEventListener('readystatechange', function() {
        if ((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
        	document.querySelector(".userMoney").innerHTML = '';
        	
        	var x = xhr.responseText;
        	document.querySelector(".userMoney").innerHTML = 'Vous possédez '+x+'₽';
        }
    });
    xhr.send();
}

function afficherShopping() {
	var xhr = new XMLHttpRequest();
    xhr.open('GET','redirection.php?getItemList=true', true);
    xhr.addEventListener('readystatechange', function() {
        if ((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
        	var tab = JSON.parse(xhr.responseText);
        	document.querySelector(".window_content").innerHTML = '';
        	document.querySelector("html").style.boxSizing = "content-box"; // Très très important

            let itemDiv = document.createElement("div");
			itemDiv.className = "itemDiv";

				let userMoney = document.createElement("div");
				userMoney.className = "userMoney";
				
				afficherArgentDresseur(); // =======================
				
				itemDiv.appendChild(userMoney);

				let boxItemList = document.createElement("div");
				boxItemList.className = "boxItemList";
				itemDiv.appendChild(boxItemList);
				for (var i = 0; i < tab.length; i++) {
					let boxItem = document.createElement("div");
					boxItem.className = "boxItem";
					boxItemList.appendChild(boxItem);

						let itemName = document.createElement("div");
						itemName.className = "itemName";
						itemName.innerHTML = tab[i]['Nom'];
						boxItem.appendChild(itemName);

						let itemImg = document.createElement("div");
						itemImg.className = "itemImg";
						itemImg.innerHTML = afficherItem(i+1) // =======================
						boxItem.appendChild(itemImg);

						let itemPrice = document.createElement("div");
						itemPrice.className = "itemPrice";
						itemPrice.innerHTML = tab[i]['Prix']+'₽';
						boxItem.appendChild(itemPrice);

					boxItem.numItem = tab[i]['Num'];

					boxItem.onclick	= function() { acheteItem(this.numItem); }
				}

			document.querySelector(".window_content").appendChild(itemDiv);
        }
    });
    xhr.send();
}