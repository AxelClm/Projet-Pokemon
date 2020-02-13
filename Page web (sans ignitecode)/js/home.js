var friends = 0;
var inventory = 0;

document.querySelector("#inventory-side").addEventListener("click", afficherInventory);
document.querySelector("#friends-side").addEventListener("click", afficherFriends);
var a = document.querySelector(".right");
document.querySelector("body").removeChild(document.querySelector(".right"));
document.querySelector(".center").appendChild(a);

function afficherInventory() {
	if (friends == 1){
		document.querySelector(".right").style.visibility = "hidden";
		document.querySelector(".right").style.width = "0";
		document.querySelector(".right").style.height = "0";
		document.querySelector(".right").style.margin = "0";
		document.querySelector(".right").style.padding = "0";
		document.querySelector(".right").style.zIndex = "0";

		friends = 0; 
	}

	if (inventory == 1){
		document.querySelector(".left").style.visibility = "hidden";
		document.querySelector(".left").style.width = "0";
		document.querySelector(".left").style.height = "0";
		document.querySelector(".left").style.margin = "0";
		document.querySelector(".left").style.padding = "0";
		document.querySelector(".left").style.zIndex = "-1111";

		inventory = 0;
	} else {
		document.querySelector(".left").style.visibility = "visible";
		document.querySelector(".left").style.width = "100%";
		document.querySelector(".left").style.height = "100%";
		document.querySelector(".left").style.zIndex = "1111";
		document.querySelector(".left").style.top = "0";
		document.querySelector(".left").style.left = "0";

		inventory = 1;
	}
}

function afficherFriends() {
	if (inventory == 1){
		document.querySelector(".left").style.visibility = "hidden";
		document.querySelector(".left").style.width = "0";
		document.querySelector(".left").style.height = "0";
		document.querySelector(".left").style.margin = "0";
		document.querySelector(".left").style.padding = "0";
		document.querySelector(".left").style.zIndex = "0";

		inventory = 0;
	}

	if (friends == 1) {
		document.querySelector(".right").style.visibility = "hidden";
		document.querySelector(".right").style.width = "0";
		document.querySelector(".right").style.height = "0";
		document.querySelector(".right").style.margin = "0";
		document.querySelector(".right").style.padding = "0";
		document.querySelector(".right").style.zIndex = "-1111";

		friends = 0;
	} else {
		document.querySelector(".right").style.visibility = "visible";
		document.querySelector(".right").style.width = "100%";
		document.querySelector(".right").style.height = "100%";
		document.querySelector(".right").style.zIndex = "1111";
		document.querySelector(".right").style.top = "0";
		document.querySelector(".right").style.left = "0";
		document.querySelector(".right").style.overflow = "scroll";

		friends = 1;
	}
}
