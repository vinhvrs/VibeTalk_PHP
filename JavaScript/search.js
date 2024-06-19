function Normalize(){
    var navHeight = document.getElementsByClassName("navbar")[0].clientHeight;
    document.getElementsByClassName("nav-side")[0].style.top = navHeight + "px";
    document.getElementById("music-chat").style.top = navHeight + "px";
    document.getElementById("content").style.top = navHeight + "px";
    document.getElementById("switchTab").style.height = navHeight + "px";
}