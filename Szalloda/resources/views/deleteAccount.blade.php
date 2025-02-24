@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/bejelentkezes.css') }}">
@endsection

@section('content')
    <div class="mainContent">
        <section>
            <h1>Felhasználói fiók törlése</h1>
            <div class="center form">
                <p>Biztos hogy meg szeretne válni a fiókjától?</p>
                <a href="/fioktorles/megerositem"><button class="save-button">Igen, törlöm a fiókom</button></a>
                <a href="/profil"><button class="delete-button">Nem, mégsem törlöm a fiókom</button></a>
            </div>
        </section>
    </div>
@endsection
