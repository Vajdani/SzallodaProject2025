@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/regisztracio.css') }}">
@endsection

@section('content')
    <div class="mainContent">
        <form action="/bejelentkezes" method="post" class="form-design">
            <h1>Bejelentkezés</h1>
            @csrf

            @if ($errors->any())
                <div class="error">
                    Hibás bejelentkezési adatok
                </div>
            @endif

            <div class="inputItem">
                <label for="username">Felhasználónév/E-mail</label>
                <input type="text" name="username" id="username">
            </div>

            <div class="inputItem">
                <label for="password">Jelszó</label>
                <input type="password" name="password" id="password">
            </div>

            <button type="submit" value="">Bejelentkezés</button>

            <a href="/regisztracio">Még nincs fiókja?</a>
        </form>
    </div>
@endsection
