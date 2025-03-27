let selectedRoomId = -1
let rooms = {}
let services = {}

function InitData(roomsJson, servicesJson) {
    rooms = JSON.parse(roomsJson)
    services = JSON.parse(servicesJson)

    ResetRoomId()
}

async function DateChanged() {
    let start = document.getElementById("startDate").value
    let end = document.getElementById("endDate")
    end.min = start

    if (Date.parse(start) > Date.parse(end.value)) {
        end.value = ""
    }

    if (start == "" || end.value == "") { return }

    await fetch("/foglalas/szabadszobak/" + document.getElementById("hotel_id").value + "/" + start + "/" + end.value).then((response) => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    }).then((data) => {
        rooms = data

        let roomSelect = document.getElementById("room_id")
        roomSelect.innerHTML = ""
        data.forEach(element => {
            let option = document.createElement("option")
            option.value = element.room_id
            option.innerText = element.roomNumber

            roomSelect.appendChild(option)
        });

        ResetRoomId()
        CalculatePrice()
    }).catch((error) => {
        console.error('Fetch error:', error);
    })
}

function RoomSelected() {
    selectedRoomId = document.getElementById("room_id").value
    CalculatePrice()
}

function ServiceSelected() {
    CalculatePrice()
}

function CalculatePrice() {
    let start = document.getElementById("startDate").value;
    let end = document.getElementById("endDate").value;
    let stayDuration = 0
    if (start != "" && end != "") {
        stayDuration = (Date.parse(end) - Date.parse(start)) / 1000 / 60 / 60 / 24
    }

    let finalPrice = 0
    let room = GetRoomById(selectedRoomId)
    if (room) {
        finalPrice += room.pricepernight * stayDuration
    }

    services.forEach(element => {
        if (document.getElementById("service_" + element.service_id).checked) {
            finalPrice += element.price * ((stayDuration == 0 || element.category_id >= 3) ? 1 : stayDuration)
        }
    })

    document.getElementById("osszeg").innerText = finalPrice
}



function GetRoomById(room_id) {
    let i = 0;
    while (i < rooms.length) {
        const element = rooms[i];
        if (element.room_id == room_id) {
            return element
        }

        i++
    }
}

function ResetRoomId() {
    selectedRoomId = rooms[0].room_id
}