var ele = document.getElementById("hamburger");
var burgerclick = false;
ele.addEventListener("click", function() {
    ele.classList.toggle("burgeron");
    document.getElementById("navbar").classList.toggle("navtoggle");
    document.getElementById("brand").classList.toggle("brandon");
});