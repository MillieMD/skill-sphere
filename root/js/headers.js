// Change header when window is resized
window.onresize = toggleHeader;
window.onload = toggleHeader;

function toggleHeader(){
    if(window.innerWidth <= 950){
        document.getElementById("mobile-header").style.display = "flex";
        document.getElementById("desktop-header").style.display = "none";
    }else{
        document.getElementById("mobile-header").style.display = "none";
        document.getElementById("desktop-header").style.display = "flex";
    }
}