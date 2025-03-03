const csillagok = document.getElementById("csillagok")
const varos = document.getElementById("varos")
const szalloda = document.getElementById("szalloda")
const ratingSection = document.getElementById("ratingSection")

function renderRating(uname,hname,rating,createdat,text) {
    const starT = "<span class='starTicked'>★</span>"
    const starU = "<span class='starUnTicked'>★</span>"

    const div = document.createElement("div")
    div.innerHTML = `
         <div class="rating">
                    <div class="ratingUser">
                        <div class="profilePicture">
                            <img src="https://placehold.co/400" alt="profilkep" title="Profilkép" class="img-fluid">
                        </div>
                        <div class="data">
                            <div>
                                <p>`+uname+`</p>
                                <p>`+hname+`</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>
                            `+starT.repeat(rating)+starU.repeat(5-rating)+` — `+createdat+`
                        </p>
                        <p>
                            `+text+`
                        </p>
                    </div>
                </div>
    `
    ratingSection.appendChild(div)
}