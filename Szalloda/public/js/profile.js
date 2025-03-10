let isOpen = false

function pfpmenu() {
    isOpen = !isOpen
    document.getElementById("pics").style.display = isOpen ? "block" : "none"
}

function pfpchange(szam) {
    var pfp = document.getElementById("profile");
    pfp.src = "img/pfp/" + szam + ".png";
    document.getElementById("pfp").value = szam
}
