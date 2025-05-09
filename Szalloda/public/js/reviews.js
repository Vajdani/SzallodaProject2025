const csillagok = document.getElementById("csillagok")
const varos = document.getElementById("varos")
const szalloda = document.getElementById("szalloda")
const ratingSection = document.getElementById("ratingSection")

const MAXVISIBLEREVIEWLENGTH = 250
const MAXFULLREVIEWLENGTH = 1000

let lastHotelId = 0
let cityChanged = false
let ratings = {}
let activeUserId
let reviewType

function RenderRating(username, hotelName, hotel_id, rating, created_at, review, pfp, user_id, userActive, review_id, isEdited, maxReviewLength, disableFooter) {
    const reviewIsNull = (review == "" || review == "null" || review == null)
    const profilePictureId = userActive ? pfp : 0
    const finalUserName = userActive ? username : "Törölt fiók"
    const ratingStars = ("<span class='starTicked'>★</span>").repeat(rating) + ("<span class='starUnTicked'>★</span>").repeat(5 - rating)
    const finalReviewText = (reviewIsNull ? "" : (review.replace(/<br>/g, "").length > maxReviewLength ? review.substring(0, maxReviewLength) + "..." : review))
    const footer = `
        <div class="reviewFooter" id="reviewFooter_` + review_id + `">
            ` + (!reviewIsNull && review.length > MAXVISIBLEREVIEWLENGTH ? `
                <div class="openFullReview" title="Teljes értékelés">
                    <i class="fa-solid fa-book"></i>
                    <i class="fa-solid fa-book-open" onclick="OpenFullReview(` + review_id + `)"></i>
                </div>` : "") + `
            ` + (activeUserId == user_id ? `<a href="/ertekelesmodositas/` + review_id + `"><button style="border: 0; background:0"><i class="fa-solid fa-pen-to-square"></i></button></a><button style="border: 0; background:0" onclick="OpenReviewDeleteMenu(` + review_id + `)"><i class="fa-solid fa-trash"></i></button>` : ``) + `
        </div>
    `

    const div = document.createElement("div")
    div.id = "review_" + review_id
    div.innerHTML = `
        <div class="ratingUser">
            <div class="profilePicture">
                <a href="/profil/` + user_id + `"><img src="/img/pfp/` + profilePictureId + `.png" alt="profilkep" title="` + finalUserName + ` profilképe" class="img-fluid profile-picture"></a>
                <p class="text-center">` + finalUserName + `</p>
            </div>
            <div class="ratingData">
                <h3 style="text-wrap:auto;"><a href="/szalloda/` + hotel_id + `">` + hotelName + `</a></h3>
                <p>` + ratingStars + `</p>
                <p style="text-wrap:auto;margin-bottom:5px">` + created_at + (isEdited ? " <span style='color: gold'>(szerkesztve)</span>" : "") + `</p>
                <p style="text-wrap:auto;white-space:pre-wrap">` + finalReviewText + `</p>
                ` + (disableFooter == true ? "" : footer) + `
            </div>
        </div>
    `

    div.classList.add("rating", "center")

    return div
}

function RenderHotelRating(username, hotelName, hotel_id, rating, created_at, review, pfp, user_id, userActive, review_id, isEdited, maxReviewLength, disableFooter) {
    return RenderRating(username, "", "", rating, created_at, review, pfp, user_id, userActive, review_id, isEdited, maxReviewLength, disableFooter)
}

function RenderUserRating(username, hotelName, hotel_id, rating, created_at, review, pfp, user_id, userActive, review_id, isEdited, maxReviewLength, disableFooter) {
    return RenderRating("", hotelName, hotel_id, rating, created_at, review, pfp, user_id, userActive, review_id, isEdited, maxReviewLength, disableFooter)
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
    },
    3: {
        render: RenderUserRating,
        noneText: "Még nem írtál értékeléseket!",
    }
}

function RenderReviewSection(reviews, review_type, user_id_active) {
    let hasReplaced = false
    if (typeof(reviews) == "string") {
        reviews = JSON.parse(reviews.replace(/\r\n/g, "<br>"))
        hasReplaced = true
    }

    ratings = reviews
    reviewType = review_type
    activeUserId = user_id_active

    ratingSection.innerHTML = ""

    let data = reviewData[reviewType]
    if (ratings.length == 0) {
        RenderNone(data.noneText)
    }
    else {
        ratings.forEach(element => {
            let text = element.reviewText
            if (text && !hasReplaced) {
                text = text.replace(/\r\n/g, "<br>")
            }

            let rating = data.render(
                element.username, element.hotelName, element.hotel_id, element.rating,
                element.created_at, text, element.profilePic, element.user_id,
                element.active == 1, element.review_id, element.edited == 1,
                MAXVISIBLEREVIEWLENGTH
            )

            ratingSection.appendChild(rating)
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
    lastHotelId = szalloda.value
    await fetch("/ertekelesek/" + csillagok.value + "/" + varos.value + "/" + szalloda.value).then((response) => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    }).then((data) => {
        RenderReviewSection(data.reviews, 0, activeUserId)

        szalloda.innerHTML = ""

        RenderHotelOption("Összes", 0)
        let hotels = data.hotels
        if (hotels.length > 1) {
            hotels.forEach(element => {
                RenderHotelOption(element.hotelName, element.hotel_id)
            });
        }

        if (!cityChanged) {
            szalloda.value = lastHotelId
        }

        cityChanged = false
    }).catch((error) => {
        console.error('Fetch error:', error);
    })
}

if (csillagok != null) {
    csillagok.onchange = UpdateContents
    varos.onchange = () => {
        cityChanged = true
        szalloda.value = 0
        UpdateContents()
    }
    szalloda.onchange = UpdateContents
}



function OpenReviewDeleteMenu(review_id) {
    if (document.getElementById("reviewDeleteMenu")) { return }

    let panel = document.createElement("div")
    panel.id = "reviewDeleteMenu"
    panel.className = "menuBgOverlay"
    // panel.onclick = CloseReviewDeleteMenu

    const form = document.createElement("div")
    form.className = "menuPanel"
    form.innerHTML = `
        <h1>Biztos hogy törölni szeretné az értékelését?</h1>

        <div id="reviewHolder"></div>

        <div style="display:flex;justify-content:space-between">
            <a href="/ertekelestorles/` + review_id + `" style="max-width:50%"><button class="review-button">Igen, törlöm az értékelést.</button></a>
            <button onclick="CloseReviewDeleteMenu()" class="delete-button" style="max-width:50%">Nem, mégsem törlöm az értékelést.</button>
        </div>
    `

    panel.appendChild(form)
    document.body.appendChild(panel)

    let review = GetReviewById(review_id)
    document.getElementById("reviewHolder").appendChild(reviewData[reviewType].render(
        review.username, review.hotelName, review.hotel_id, review.rating,
        review.created_at, review.reviewText, review.profilePic, review.user_id,
        review.active == 1, review.review_id, review.edited == 1, MAXVISIBLEREVIEWLENGTH,
        true
    ))
}

function CloseReviewDeleteMenu() {
    let menu = document.getElementById("reviewDeleteMenu")
    if (menu) {
        menu.remove()
    }
}



function OpenFullReview(review_id) {
    if (document.getElementById("fullReviewMenu")) { return }

    let panel = document.createElement("div")
    panel.id = "fullReviewMenu"
    panel.className = "menuBgOverlay"
    panel.onclick = CloseFullReviewMenu

    const form = document.createElement("div")
    form.className = "menuPanel"
    form.innerHTML = `
        <div id="reviewHolder"></div>

        <button onclick="CloseFullReviewMenu()" class="delete-button" style="float:right">Bezárás</button>
    `

    panel.appendChild(form)
    document.body.appendChild(panel)

    let review = GetReviewById(review_id)
    document.getElementById("reviewHolder").appendChild(reviewData[reviewType].render(
        review.username, review.hotelName, review.hotel_id, review.rating,
        review.created_at, review.reviewText, review.profilePic, review.user_id,
        review.active == 1, review.review_id, review.edited == 1, MAXFULLREVIEWLENGTH,
        true
    ))
}

function CloseFullReviewMenu() {
    let menu = document.getElementById("fullReviewMenu")
    if (menu) {
        menu.remove()
    }
}



document.addEventListener("keydown", (e) => {
    if (e.key == "Escape") {
        CloseReviewDeleteMenu()
        CloseFullReviewMenu()
    }
})



function GetReviewById(review_id) {
    let i = 0;
    while (i < ratings.length) {
        const element = ratings[i];
        if (element.review_id == review_id) {
            return element
        }

        i++
    }
}
