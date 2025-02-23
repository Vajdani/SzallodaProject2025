@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/bejelentkezes.css') }}">
@endsection

@section('content')
    <div class="mainContent">
        <section>
            <h1>Bejelentkezés</h1>
            <form action="/bejelentkezes" method="post" class="center">
                   @if($errors->any())
                        <div class="error">
                            Hibás bejelentkezési adatok
                        </div>
                    @endif
                @csrf
                <label for="name">Felhasználónév/E-mail</label>
                <input type="text" name="username" id="username">


                <label for="password">Jelszó</label>
                <input type="password" name="password" id="password">


                <input type="submit" value="Bejelentkezés">

                <a href="/regisztracio">Még nincs fiókja?</a>
            </form>
        </section>
    </div>
@endsection
