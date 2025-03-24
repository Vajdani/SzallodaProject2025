@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/bejelentkezes.css') }}">
@endsection

@section('content')
    <div class="mainContent">
        <nav>
            <h1>Felhasználói fiók törlése</h1>
        </nav>
        <section>
            <div class="center form">
                <p>Biztos hogy meg szeretne válni a fiókjától?</p>

                <form action="/fioktorles/megerositem" method="POST">
                    @csrf
                    <input type="checkbox" name="deleteReviews" id="deleteReviews">
                    <label for="deleteReviews">Törlöm az értékeléseimet is</label>

                    <input type="submit" class="save-button" value="Igen, törlöm a fiókom">
                </form>

                <a href="/profil"><button class="delete-button">Nem, mégsem törlöm a fiókom</button></a>
            </div>
        </section>
    </div>
@endsection
