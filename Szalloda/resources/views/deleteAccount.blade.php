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
                <a href="/fioktorles/megerositem">Igen, törlöm a fiókom</a>
                <a href="/profil">Nem, mégsem törlöm a fiókom</a>
            </div>
        </section>
    </div>
@endsection
