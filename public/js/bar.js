const sidebar = document.getElementById("sidebar");
const closeButton = document.getElementById("close");
const openButton = document.querySelector(".menu-open");
function openNav() {
    sidebar.style.width = "40%";
}

function closeNav() {
    sidebar.style.width = "0";
}

openButton.addEventListener("click", openNav);
closeButton.addEventListener("click",closeNav);

