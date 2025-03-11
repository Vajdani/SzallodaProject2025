const csillagok = document.getElementById("csillagok")
const varos = document.getElementById("varos")
const szalloda = document.getElementById("szalloda")
const ratingSection = document.getElementById("ratingSection")

let lastSzalloda = 0
let varosChanged = false

function renderRating(username, hotelName, rating, created_at, review, pfp, user_id, userActive) {
    const starT = "<span class='starTicked'>★</span>"
    const starU = "<span class='starUnTicked'>★</span>"

    const div = document.createElement("div")
    div.innerHTML = `
        <div class="rating center">
            <div class="ratingUser">
                <div class="profilePicture">
                    <a href="/profil/` + user_id + `"><img src="/img/pfp/` + (userActive ? pfp : 0) + `.png" alt="profilkep" title="Profilkép" class="img-fluid profile-picture"></a>
                    <p class="text-center">` + (userActive ? username : "Törölt fiók") + `</p>
                </div>
                <div class="data">
                    <div>
                        <h3>` + hotelName + `</h3>
                        <p>` + starT.repeat(rating) + starU.repeat(5 - rating) + `</p>
                        <p>` + created_at + `</p>
                        <p>` + ((review == "" || review == "null" || review == null) ? "" : review) + `</p>
                    </div>
                </div>
            </div>
        </div>
    `
    ratingSection.appendChild(div)
}

function renderHotel(hotelName, hotelId) {
    var option = document.createElement("option");
    option.text = hotelName;
    option.value = hotelId;

    szalloda.appendChild(option);
}


function renderNone() {
    const div = document.createElement("div")
    div.innerHTML = `
        <div class="rating">
            Egy olyan értékelés sincs, ami megfelel a szűrőnek!
        </div>
    `
    ratingSection.appendChild(div)
}

async function updateContents() {
    //"/ertekelesek/ertek/"+ csillagok.value +"/varos/"+ varos.value +"/szalloda/"+ szalloda.value
    lastSzalloda = szalloda.value
    await fetch("/ertekelesek/" + csillagok.value + "/" + varos.value + "/" + szalloda.value).then((response) => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    }).then((data) => {
        let reviews = data.reviews
        ratingSection.innerHTML = ""
        if (reviews.length == 0) {
            renderNone()
        }
        else {
            reviews.forEach(element => {
                renderRating(element.username, element.hotelName, element.rating, element.created_at, element.reviewText, element.profilePic, element.user_id, element.active == 1)
            });
        }

        szalloda.innerHTML = ""

        renderHotel("Összes", 0)
        let hotels = data.hotels
        if (hotels.length > 1) {
            hotels.forEach(element => {
                renderHotel(element.hotelName, element.hotel_id)
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
    csillagok.onchange = updateContents
    varos.onchange = () => {
        varosChanged = true
        szalloda.value = 0
        updateContents()
    }
    szalloda.onchange = updateContents
}
