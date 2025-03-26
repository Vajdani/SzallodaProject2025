let selectedRoomId = 0
let rooms = {}

function InitRooms(roomsJson) {
    rooms = JSON.parse(roomsJson)
    console.log(rooms)
}

function price(price){



    console.log(price)
    console.log("aslfkskfdk")
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

        let roomSelect = document.getElementById("rooms")
        roomSelect.innerHTML = ""
        data.forEach(element => {
            let option = document.createElement("option")
            option.value = element.room_id
            option.innerText = element.roomNumber

            roomSelect.appendChild(option)
        });

        CalculatePrice()
    }).catch((error) => {
        console.error('Fetch error:', error);
    })
}

function RoomSelected() {
    selectedRoomId = document.getElementById("rooms").value

    CalculatePrice()
}

function CalculatePrice() {
    let start = document.getElementById("startDate").value;
    let end = document.getElementById("endDate").value;
    let stayDuration = 0
    if (start != "" && end != "") {
        stayDuration = (Date.parse(end) - Date.parse(start)) / 1000 / 60 / 60 / 24
        console.log(stayDuration)
    }

    let room = GetRoomyId(selectedRoomId)
    console.log(room)
    document.getElementById("osszeg").innerText = room.pricepernight * stayDuration
    console.log(start, end, selectedRoomId)
}



function GetRoomyId(room_id) {
    let i = 0;
    while (i < rooms.length) {
        const element = rooms[i];
        if (element.room_id == room_id) {
            return element
        }

        i++
    }
}
