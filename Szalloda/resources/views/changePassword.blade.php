@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/bejelentkezes.css') }}">
@endsection

@section('content')
    <div class="mainContent">
        <section>
            <h1>Jelszó módosítása</h1>
            <form action="/jelszovaltoztatas" method="post" class="center">
                @csrf

                <label for="password">Régi jelszó</label>
                <input type="password" name="password" id="password">

                <label for="newpassword">Új jelszó</label>
                <input type="password" name="newpassword" id="newpassword">

                <label for="newpassword_confirmation">Új jelszó megerősítése</label>
                <input type="password" name="newpassword_confirmation" id="newpassword_confirmation">

                <input type="submit" value="Módosítás">
            </form>
        </section>
    </div>
@endsection
