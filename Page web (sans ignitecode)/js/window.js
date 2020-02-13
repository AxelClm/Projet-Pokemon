function create_fenetre(){
    if (document.querySelector(".window") != null) {
        document.querySelector("body").removeChild(document.querySelector(".window"));
    }

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
    
    document.querySelector(".close").addEventListener("click", function () {
        document.querySelector("html").style.boxSizing = "content-box";
        document.querySelector("body").removeChild(document.querySelector(".window"));
    });
}

function confirmationDemandeCombat() {
    let demandeCombatDiv = document.createElement("div");
    demandeCombatDiv.className = "demandeCombatDiv";

    let envoyerDemandeCombat = document.createElement("div");
    envoyerDemandeCombat.className = "envoyerDemandeCombat";

    let pasEnvoyerDemandeCombat = document.createElement("div");
    pasEnvoyerDemandeCombat.className = "pasEnvoyerDemandeCombat";

    document.querySelector("body").appendChild(demandeCombatDiv);
    document.querySelector(".demandeCombatDiv").appendChild(envoyerDemandeCombat);
    document.querySelector(".demandeCombatDiv").appendChild(pasEnvoyerDemandeCombat);
    document.querySelector("envoyerDemandeCombat").innerHTML = 'Oui';
    document.querySelector("pasEnvoyerDemandeCombat").innerHTML = 'Non';

    document.querySelector(".envoyerDemandeCombat").addEventListener("click", function() {
        document.querySelector("body").removeChild(document.querySelector(".demandeCombatDiv"))
    })

    document.querySelector(".pasEnvoyerDemandeCombat").addEventListener("click", function() {
        document.querySelector("body").removeChild(document.querySelector(".demandeCombatDiv"))
    })

}