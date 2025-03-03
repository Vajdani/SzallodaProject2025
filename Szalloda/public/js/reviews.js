const csillagok = document.getElementById("csillagok")
const varos = document.getElementById("varos")
const szalloda = document.getElementById("szalloda")
const ratingSection = document.getElementById("ratingSection")

function renderRating(uname, hname, rating, createdat, text,pfp) {
    const starT = "<span class='starTicked'>★</span>"
    const starU = "<span class='starUnTicked'>★</span>"

    const div = document.createElement("div")
    div.innerHTML = `
        <div class="rating">
            <div class="ratingUser">
                <div class="profilePicture">
                    <img src="img/pfp/`+pfp+`.png" alt="profilkep" title="Profilkép" class="img-fluid profile-picture">
                </div>
                <div class="data">
                    <div>
                        <p>`+ uname + `</p>
                        <p>`+ hname + `</p>
                    </div>
                </div>
            </div>
            <div>
                <p>`+ starT.repeat(rating) + starU.repeat(5 - rating) + ` — ` + createdat + `</p>
                <p>`+ text + `</p>
            </div>
        </div>
    `
    ratingSection.appendChild(div)
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
    await fetch("/ertekelesek/" + csillagok.value + "/" + varos.value + "/" + szalloda.value).then((response) => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    }).then((data) => {
        ratingSection.innerHTML = ""
        if (data.length == 0) {
            renderNone()
        }
        else {
            data.forEach(element => {
                renderRating(element.username, element.hotelName, element.rating, element.created_at, element.reviewText,element.profilePic)
            });
        }
    }).catch((error) => {
        console.error('Fetch error:', error);
    })
}

csillagok.onchange = updateContents
varos.onchange = updateContents
szalloda.onchange = updateContents
