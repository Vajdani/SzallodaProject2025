function point(point){
    slider = document.getElementById("point")
    slider.value=point
}

function loyaltymenu(loyalty,points,currentmin,nextmin){
    let panel = document.createElement("div")
    panel.id="loyaltymenu"
    panel.className = "menuBgOverlay"
    panel.onclick = CloseMenu
    
    panel.innerHTML = `
    <div class="ProfilePicture-Selection" id="loyal">
        <div class="PPS-head">
            <h2>Az ön jelenlegi rangja: `+loyalty+`</h2>
        </div>
        <hr> 
        <div class="loyal-body">
           <p>`+currentmin+`</p><progress id="point" class="pointslider" value="`+points+`" min="`+currentmin+`" max="`+nextmin+`"></progress>  <p style="float: right">`+nextmin+`</p>
        </div>  
        <div class="PPS-buttons">
            <button class="save-button" onclick="CloseMenu('loyaltymenu')">Mégse</button>
        </div>
    </div>
    `
    document.body.appendChild(panel)
   
}

function loyaltymax(loyalty){
    let panel = document.createElement("div")
    panel.id="loyaltymenu"
    panel.className = "menuBgOverlay"
    panel.onclick = CloseMenu
    
    panel.innerHTML = `
    <div class="ProfilePicture-Selection" id="loyal">
        <div class="PPS-head">
            <h2>Az ön jelenlegi rangja: `+loyalty+`</h2>
        </div>
        <hr> 
        <div class="loyal-body">
            <p>Gratulálok, elérted a legmagasabb rangot!</p>
        </div>  
        <div class="PPS-buttons">
            <button class="save-button" onclick="CloseMenu('loyaltymenu')">Mégse</button>
        </div>
    </div>
    `
    document.body.appendChild(panel)
}

function pfpmenu() {
    let panel = document.createElement("div")
    panel.id = "pfpMenu"
    panel.className = "menuBgOverlay"
    //panel.onclick = CloseMenu

    let pfps = `<div class="PPS-body">`
    for (let i = 0; i < 8; i++) {
        pfps += `<img src="img/pfp/` + i + `.png" alt="` + i + `" class="profile-picture" onclick="pfpchange(` + i + `)" />`
    }
    pfps += `</div>`

    const form = document.createElement("div")
    form.className = "menuPanel"
    form.innerHTML = `
        <form action="/profil/pfp" method="post">
            <input type="hidden" name="_token" value="` + document.querySelector('meta[name="_token"]').content + `">
            <div class="ProfilePicture-Selection" id="pics">
                <div class="PPS-head">
                    <h2>Válasza ki a profilképét!</h2>
                </div>
                <hr>
                ` + pfps + `
                <div class="PPS-buttons">
                    <button class="save-button" onclick="CloseMenu('pfpMenu')">Mégse</button>
                    <button class="save-button" type="submit">Profilkép beállítása</button>
                    <input type="text" name="pfp" id="pfp" style="display: none">
                </div>
            </div>
        </form>
    `

    panel.appendChild(form)
    document.body.appendChild(panel)
}

function pfpchange(szam) {
    var pfp = document.getElementById("profile");
    pfp.src = "img/pfp/" + szam + ".png";
    document.getElementById("pfp").value = szam
}

function CloseMenu(menuid) {
    let menu = document.getElementById(menuid)
    if (menu) {
        menu.remove()
    }
}

document.addEventListener("keydown", (e) => {
    if (e.key == "Escape") {
        CloseMenu()
    }
})
