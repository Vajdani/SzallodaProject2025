const csillagok = document.getElementById("csillagok")
const varos = document.getElementById("varos")
const szalloda = document.getElementById("szalloda")
const ratingSection = document.getElementById("ratingSection")

let lastSzalloda = 0
let varosChanged = false

function RenderRating(username, hotelName, hotel_id, rating, created_at, review, pfp, user_id, userActive, user_id_active, review_id) {
    const starT = "<span class='starTicked'>★</span>"
    const starU = "<span class='starUnTicked'>★</span>"

    const div = document.createElement("div")
    div.id = "review_" + review_id
    div.innerHTML = `
        <div class="ratingUser">
            <div class="profilePicture">
                <a href="/profil/` + user_id + `"><img src="/img/pfp/` + (userActive ? pfp : 0) + `.png" alt="profilkep" title="Profilkép" class="img-fluid profile-picture"></a>
                <p class="text-center">` + (userActive ? username : "Törölt fiók") + `</p>
            </div>
            <div class="ratingData">
                <h3 style="text-wrap:auto"><a style="color:white" href="/szalloda/` + hotel_id + `">` + hotelName + `</a></h3>
                <p>` + starT.repeat(rating) + starU.repeat(5 - rating) + `</p>
                <p style="text-wrap:auto">` + created_at + `</p>
                <p style="text-wrap:auto">` + ((review == "" || review == "null" || review == null) ? "" : review) + `</p>
                ` + (user_id_active == user_id ? `
                <div class="deleteRating" id="review_deleteRating_` + review_id + `">
                    <button style="border: 0; background:0" onclick="OpenReviewDeleteMenu(` + review_id + `)"><i class="fa-solid fa-trash white"></i></button>
                </div>` : ``) + `
            </div>
        </div>
    `

    div.classList.add("rating", "center")

    ratingSection.appendChild(div)
}

function RenderHotelRating(username, hotelName, hotel_id, rating, created_at, review, pfp, user_id, userActive, user_id_active, review_id) {
    RenderRating(username, "", "", rating, created_at, review, pfp, user_id, userActive, user_id_active, review_id)
}

function RenderUserRating(username, hotelName, hotel_id, rating, created_at, review, pfp, user_id, userActive, user_id_active, review_id) {
    RenderRating("", hotelName, hotel_id, rating, created_at, review, pfp, user_id, userActive, user_id_active, review_id)
}

function RenderNone(noneText) {
    const div = document.createElement("div")
    div.innerHTML = `<div class="rating">`+ noneText + `</div>`
    ratingSection.appendChild(div)
}



const reviewData = {
    0: {
        render: RenderRating,
        noneText: "Egy olyan értékelés sincs, ami megfelel a szűrőnek!",
    },
    1: {
        render: RenderHotelRating,
        noneText: "Ehhez a szállodához még nem érkeztek értékelések!",
    },
    2: {
        render: RenderUserRating,
        noneText: "Ez a felhasználó még nem írt értékeléseket!",
    }
}

function RenderReviewSection(reviews, reviewType) {
    if (typeof(reviews) == "string") {
        reviews = JSON.parse(reviews)
    }

    ratingSection.innerHTML = ""

    let data = reviewData[reviewType]
    if (reviews.length == 0) {
        RenderNone(data.noneText)
    }
    else {
        reviews.forEach(element => {
            data.render(element.username, element.hotelName, element.hotel_id, element.rating, element.created_at, element.reviewText, element.profilePic, element.user_id, element.active == 1)
        });
    }
}

function RenderHotelOption(hotelName, hotelId) {
    var option = document.createElement("option");
    option.text = hotelName;
    option.value = hotelId;

    szalloda.appendChild(option);
}

async function UpdateContents() {
    //"/ertekelesek/ertek/"+ csillagok.value +"/varos/"+ varos.value +"/szalloda/"+ szalloda.value
    lastSzalloda = szalloda.value
    await fetch("/ertekelesek/" + csillagok.value + "/" + varos.value + "/" + szalloda.value).then((response) => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    }).then((data) => {
        RenderReviewSection(data.reviews, 0)

        szalloda.innerHTML = ""

        RenderHotelOption("Összes", 0)
        let hotels = data.hotels
        if (hotels.length > 1) {
            hotels.forEach(element => {
                RenderHotelOption(element.hotelName, element.hotel_id)
            });
        }

        if (!varosChanged) {
            szalloda.value = lastSzalloda
        }

        varosChanged = false
    }).catch((error) => {
        console.error('Fetch error:', error);
    })
}

if (csillagok != null) {
    csillagok.onchange = UpdateContents
    varos.onchange = () => {
        varosChanged = true
        szalloda.value = 0
        UpdateContents()
    }
    szalloda.onchange = UpdateContents
}



function OpenReviewDeleteMenu(review_id) {
    if (document.getElementById("reviewDeleteMenu")) { return }

    let panel = document.createElement("div")
    panel.id = "reviewDeleteMenu"
    panel.className = "reviewDeleteMenu"
    panel.onclick = CloseReviewDeleteMenu

    const form = document.createElement("div")
    form.style = "background-color: var(--colour_randomgreen2);border-radius: 25px;padding: 25px;max-width: 500px;height: 30vh"
    form.innerHTML = `
        <p>Biztos hogy törölni szeretné az értékelését?</p>

        <div id="reviewHolder"></div>

        <div style="display:flex;justify-content:space-between">
            <a href="/ertekelestorles/` + review_id + `"><button class="review-button">Igen, törlöm az értékelést.</button></a>
            <button onclick="CloseReviewDeleteMenu()" class="delete-button">Nem, mégsem törlöm az értékelést.</button>
        </div>
    `

    panel.appendChild(form)
    document.getElementsByTagName("main")[0].appendChild(panel)

    //hide trash can icon for the cloning, then unhide after cloning
    let trashButton = document.getElementById("review_deleteRating_" + review_id)
    trashButton.style.display = "none"

    document.getElementById("reviewHolder").appendChild(document.getElementById("review_" + review_id).cloneNode(true))

    trashButton.style.display = "flex"
}

function CloseReviewDeleteMenu() {
    let menu = document.getElementById("reviewDeleteMenu")
    if (menu) {
        menu.remove()
    }
}

document.addEventListener("keydown", (e) => {
    if (e.key == "Escape") {
        CloseReviewDeleteMenu()
    }
})