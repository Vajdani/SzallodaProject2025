function loyaltymenu(loyalty,points){
    let panel = document.createElement("div")
    panel.id="loyaltymenu"
    panel.className = "menuBgOverlay"
    window.alert(loyalty+" "+points)

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
                    <button class="save-button" onclick="CloseMenu()">Mégse</button>
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

function CloseMenu() {
    let menu = document.getElementById("pfpMenu")
    if (menu) {
        menu.remove()
    }
}

document.addEventListener("keydown", (e) => {
    if (e.key == "Escape") {
        CloseMenu()
    }
})
