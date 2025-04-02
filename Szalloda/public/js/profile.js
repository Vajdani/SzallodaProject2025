function point(point) {
    slider = document.getElementById("point")
    slider.value = point
}

function loyaltymenu(loyalty, points, currentmin, nextmin, rank_id, ...perks) {
    let panel = document.createElement("div")
    panel.id = "loyaltymenu"
    panel.className = "menuBgOverlay"
    //panel.onclick = CloseMenu
    let perklist = ""
    if (perks != "") {
        perklist = `<ul style="text-align:left">`
        perks.forEach(element => {
            perklist += `<li>` + element + `</li>`
        });
        perklist += `</ul>`
    }
    else {
        perklist = "Jelenleg nincsenek jutalmai!"
    }

    panel.innerHTML = `
    <div class="ProfilePicture-Selection" id="loyal">
        <div class="PPS-head">
            <div class="loyaltyMenuHeader">
                <h2>Jelenlegi rangja: <span>`+ loyalty + `</span></h2>
                <img src="img/loyalty/` + rank_id + `.png" alt="` + rank_id + `.png" title="` + loyalty + `" class="img-fluid" style="max-height:inherit">
            </div>
            <hr>
        </div>
        <div class="loyal-body">
           <p style="width:auto">`+ currentmin + `</p><progress id="point" class="pointslider" value="` + points + `" min="` + currentmin + `" max="` + nextmin + `"></progress>  <p style="float: right;width:auto">` + nextmin + `</p>
        </div>
          <hr>
        <div class="PPS-head">
            <h2>Jutalmai:</h2>
        </div>
        <hr>
        <div class="loyal-body">
           `+ perklist + `
        </div>
        <div class="PPS-buttons">
            <button class="save-button" onclick="CloseMenu('loyaltymenu')">Bezárás</button>
        </div>
    </div>
    `
    document.body.appendChild(panel)

}

function loyaltymax(loyalty, rank_id, ...perks) {
    let panel = document.createElement("div")
    panel.id = "loyaltymenu"
    panel.className = "menuBgOverlay"
    panel.onclick = CloseMenu

    let perklist = `<ul style="text-align:left">`

    perks.forEach(element => {
        perklist += `<li>` + element + `</li>`
    });

    perklist += `</ul>`
    console.log(perklist)

    panel.innerHTML = `
    <div class="ProfilePicture-Selection" id="loyal">
        <div class="PPS-head">
            <div class="loyaltyMenuHeader">
                <h2>Jelenlegi rangja: <span>`+ loyalty + `</span></h2>
                <img src="img/loyalty/` + rank_id + `.png" alt="` + rank_id + `.png" title="` + loyalty + `" class="img-fluid" style="max-height:inherit">
            </div>
            <hr>
        </div>
        <div class="loyal-body">
            <p>Gratulálok, elérted a legmagasabb rangot!</p>
        </div>
        <hr>
        <div class="PPS-head">
            <h2>Jutalmai:</h2>
        </div>
        <hr>
        <div class="loyal-body">
           `+ perklist + `
        </div>
        <div class="PPS-buttons">
            <button class="save-button" onclick="CloseMenu('loyaltymenu')">Bezárás</button>
        </div>
    </div>
    `
    document.body.appendChild(panel)
}

function pfpmenu() {
    let panel = document.createElement("div")
    panel.id = "pfpMenu"
    panel.className = "menuBgOverlay"
    //panel.onclick = () => CloseMenu('pfpMenu')

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
        CloseMenu("pfpMenu")
        CloseMenu("loyaltymenu")
    }
})
