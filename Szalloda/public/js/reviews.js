const csillagok = document.getElementById("csillagok")
const varos = document.getElementById("varos")
const szalloda = document.getElementById("szalloda")
const ratingSection = document.getElementById("ratingSection")

let lastSzalloda = 0
let varosChanged = false

function renderRating(uname, hname, rating, createdat, text, pfp) {
    const starT = "<span class='starTicked'>★</span>"
    const starU = "<span class='starUnTicked'>★</span>"

    const div = document.createElement("div")
    div.innerHTML = `
        <div class="rating">
            <div class="ratingUser">
                <div class="profilePicture">
                    <img src="img/pfp/`+pfp+`.png" alt="profilkep" title="Profilkép" class="img-fluid profile-picture">
                    <p class="text-center">` + uname+ `</p>
                </div>
                <div class="data">
                    <div>
                        <h3>` + hname + `</h3>
                        <p>` + starT.repeat(rating) + starU.repeat(5 - rating) + `</p>
                        <p>` + createdat + `</p>
                        <p>` + ((text == "" || text == "null" || text == null) ? "" : text) + `</p>
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
                renderRating(element.username, element.hotelName, element.rating, element.created_at, element.reviewText,element.profilePic)
            });
        }

        szalloda.innerHTML = ""

        renderHotel("Összes", 0)
        data.hotels.forEach(element => {
            renderHotel(element.hotelName, element.hotel_id)
        });

        if (!varosChanged) {
            szalloda.value = lastSzalloda
        }

        varosChanged = false
    }).catch((error) => {
        console.error('Fetch error:', error);
    })
}

csillagok.onchange = updateContents
varos.onchange = () => {
    varosChanged = true
    szalloda.value = 0
    updateContents()
}
szalloda.onchange = updateContents
