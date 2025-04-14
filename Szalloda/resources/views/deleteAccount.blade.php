@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/bejelentkezes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fioktorles.css') }}">
@endsection

@section('content')
    <nav>
        <h1>Felhasználói fiók törlése</h1>
    </nav>
    <div class="mainContent">
        <section>
            <div class="center form" style="height:unset">
                <h2 class="text-center">Biztos hogy meg szeretne válni a fiókjától?</h2>
                <hr>
                <div class="formBox">
                    <form action="/fioktorles/megerositem" method="POST">
                        @csrf
                        <div class="text-center">
                            <input type="checkbox" name="deleteReviews" id="deleteReviews">
                            <label for="deleteReviews">Törlöm az értékeléseimet is</label>
                        </div>
                        <input type="submit" class="delete-button" value="Igen, törlöm a fiókom">
                    </form>
                    <div>
                        <a href="/profil"><button class="save-button">Nem, mégsem törlöm a fiókom</button></a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
