@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/bejelentkezes.css') }}">
@endsection

@section('content')
    <div class="mainContent">
        <section>
            <h1>Regisztráció</h1>
            <form action="/" method="post" class="center regisztracio">
                <label for="name">Felhasználónév</label>
                <input type="text" name="name" id="name">

                <label for="last">Vezetéknév</label>
                <input type="text" name="last" id="last" class="half">

                <label for="first">Keresztnév</label>
                <input type="text" name="first" id="first" class="half">

                <label for="email">E-mail cím</label>
                <input type="text" name="email" id="email">

                <label for="phone">Telefonszám</label>
                <input type="text" name="phone" id="phone" class="half">

                <label for="password">Jelszó</label>
                <input type="password" name="password" id="password">

                <label for="password_confirmation">Jelszó ismét</label>
                <input type="password" name="password_confirmation" id="password_confirmation">

                <label for="date">Születési dátum</label>
                <input type="date" name="date" id="date">

                <input type="checkbox" name="tos" id="tos">
                <label for="tos">Elfogadom a felhasználói feltételeket</label>


                <input type="submit" value="Bejelentkezés">
            </form>
        </section>
    </div>
@endsection
