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
        @yield("content")
        <div class="sidebar">
            <ul class="sidebarContacts">
                <li><h4>Szálloda</h4></li>
                <label for="" class="toggleButtonCon">
                    <input type="checkbox" id="toggleButtonCheckbox" class="toggleButtonCheckbox">
                </label>
            </ul>
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
    </main>
    <footer>
        <p>Footer text</p>
    </footer>
</body>

</html>
