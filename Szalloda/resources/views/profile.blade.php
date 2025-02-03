@extends('layout')

@section("css")
    <link rel="stylesheet" href="css/profil.css">
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset("css/profil.css") }}">

    <div class="profile-con">
        <div class="profile-header">
            <div class="profile-picture-con">
                <img src="https://placehold.co/100" alt="Profilkép" class="profile-picture">
            </div>
            <div class="profile-details-con">
                <h2>Felhasználónév</h2>
                <div class="profile-option-con">
                    <a href="">Profilképcsere</a>
                    <a href="jelszomodosit.html">Jelszóváltoztatás</a>
                    <a href="torles.html">Felhasználó törlése</a>
                </div>
            </div>
        </div>
        <div class="profile-body">
            <div class="user-information">
                <h2>Felhasználói Adatok</h2>
                <form action="/" method="POST">
                    <div class="user-data">
                        <label for="email">Email-cím</label>
                        <input type="text" value="valami@pelda.kell" name="email" id="email">
                    </div>
                    <div class="user-data">
                        <label for="username">Felhasználónév</label>
                        <input type="text" value="SzallodaFoglalo330" name="username" id="username">
                    </div>
                    <div class="user-data">
                        <label for="realname">Polgári név</label>
                        <input type="text" value="Sólyom Miklós" name="realname" id="realname">
                    </div>
                    <button class="save-button" type="submit">Mentés</button>
                </form>
            </div>
            <div class="ratings">
                <h2>Értékelések</h2>
                <div class="rating-con">
                    <div class="rating">
                        <div class="rating-head">
                            <div class="profile-picture-con">
                                <img class="profile-picture" src="https://placehold.co/100" alt="">
                            </div>
                            <div class="rating-title">
                                <h3>Felhasználónév</h3>

                            </div>
                        </div>
                        <div class="rating-info">
                            <p><span class="starTicked">★★★★★</span> — Dátum</p>
                        </div>
                        <div class="rating-desc">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In urna leo, varius eget augue eu,
                                tincidunt viverra justo. Nullam eu volutpat quam. Maecenas mauris ex, tempor eget orci
                                aliquam, iaculis vestibulum lorem. Nulla quis ligula fermentum, feugiat odio at, venenatis
                                mauris. Vestibulum eget efficitur neque, a ornare lectus. Sed id porta nisi. Cras porta urna
                                sit amet luctus accumsan. Nam in ex malesuada, facilisis odio in, varius nulla. Nullam
                                semper diam finibus, blandit neque id, faucibus massa. In convallis ligula vel quam sagittis
                                hendrerit. Nullam vulputate lobortis nibh quis tristique. Fusce at sem pellentesque leo
                                tincidunt pellentesque. Vestibulum sodales velit ex, in auctor lectus vestibulum ut. Integer
                                ultrices leo nibh. Curabitur ornare volutpat rhoncus.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
