let closed = true
function pfpmenu(){
    if(closed==true){
        document.getElementById("pics").style.display="block"
        closed=false
    }
    else{
        document.getElementById("pics").style.display="none"
        closed=true
    }
}
function pfpchange(szam){
    var pfp = document.getElementById("profile");
    pfp.src = "img/pfp/"+szam+".png";
    document.getElementById("pfp").value=szam
}
