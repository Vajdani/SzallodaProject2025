<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset("css/carousel.css") }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    @yield("css")
    <title>Szálloda</title>
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

                <script>
                    setTimeout(() => {
                        let popup = document.getElementById('popup')
                        if (popup) {
                            popup.remove()
                        }
                    }, (5000));
                </script>
            @endif

            @yield("content")
        </div>
        <div class="sidebar">
            <div class="sidebarHeader">
                <h2>Szálloda</h2>
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
                <li><a href="/szalloda/veletlenszeru">Nyaraló ajánlás</a></li>
                @auth
                    <li><a href="/foglalas">Foglalás</a></li>
                @endauth
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
                <li>Tel: <a href="tel:+3620111111">06 20 111 111</a></li>
                <li>E-mail: <a href="mailto:valaki@pelda.hu">valaki@pelda.hu</a></li>
            </ul>
            </div>
        </div>
    </main>
    <footer>
        <p>Footer text</p>
    </footer>
</body>

</html>
