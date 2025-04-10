<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/26a3e6423d.js"crossorigin="anonymous"></script>
    <script>
        setTimeout(() => {
            let popup = document.getElementById('popup')
            if (popup) {
                popup.remove()
            }
        }, (5000));
    </script>
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    @yield("css")
    <title>RushWave Retreat</title>
</head>

<body>
    <main>
        <div class="w-100">
            @if (Session::has("sv"))
                <div class='info-popup' id='popup'>
                    <div>
                        <p>{{Session::get("sv")}}</p>
                        <button onclick="document.getElementById('popup').remove()">X</button>
                    </div>
                </div>
            @endif

            @yield("content")
        </div>
        <div class="sidebar">
            <div class="sidebarHeader">
                <h2>RushWave Retreat</h2>
                <label for="toggleButtonCheckbox" class="toggleButtonCon">
                    <input name="toggleButtonCheckbox" type="checkbox" id="toggleButtonCheckbox" class="toggleButtonCheckbox">
                    <p>≡</p>
                </label>
            </div>
            <div class="sidebarCollapsableContent">
                <hr>
                <ul class="sidebarLinks">

                    <li><a href="/">Főoldal</a></li>
                    @auth
                        <li><a href="/profil">Profilom</a></li>
                    @endauth

                    <li><a href="/ertekelesek">Értékelések</a></li>
                    <li><a href="/szalloda/veletlenszeru">Véletlenszerű szálloda</a></li>
                    <li><hr></li>
                    @auth
                        <li><a href="/kijelentkezes">Kijelentkezés</a></li>
                    @else
                        <li><a href="/regisztracio">Regisztráció</a></li>
                        <li><a href="/bejelentkezes">Bejelentkezés</a></li>
                    @endauth
                </ul>
                <hr>
                <ul class="sidebarContacts">
                    <li>Elérhetőségeink</li>
                    <li><i class="fa-solid fa-phone"></i> : <a href="tel:+36203568954">06 20 356 8954</a></li>
                    <li><i class="fa-regular fa-envelope"></i>: <a href="mailto:RushWaveRetreat@hotelchain.hu">RushWave@hotelchain.hu</a></li>
                    <li>Közösségi médiáink:</li>
                    <a target="_blank" href="https://facebook.com/RushWave_Retreat" class="white"><i class="fa-brands fa-facebook"></i></a>
                    <a target="_blank" href="https://reddit.com/RushWave_Retreat" class="white"><i class="fa-brands fa-reddit-alien"></i></a>
                    <a target="_blank" href="https://twitter.com/RushWave_Retreat" class="white"><i class="fa-brands fa-twitter"></i></a>
                </ul>
            </div>
        </div>
    </main>
    <footer>
        <p>2025 RushWave Retreat © - Szerzői és minden jog fenntartva.</p>
    </footer>

    @yield("loyal")
</body>

</html>
