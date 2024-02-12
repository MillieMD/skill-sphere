let nav = document.getElementById("mobile-nav");
let overlay = document.getElementById("overlay");

function showSideNav(){
    
    nav.style.transform = "translateX(0%)";
    nav.setAttribute("aria-hidden", "false");

    overlay.style.display = "inline";

}

function hideSideNav(){

    nav.style.transform = "translateX(100%)";
    nav.setAttribute("aria-hidden", "true");

    overlay.style.display = "none";

}