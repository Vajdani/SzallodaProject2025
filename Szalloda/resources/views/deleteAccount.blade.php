@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/bejelentkezes.css') }}">
@endsection

@section('content')
    <div class="mainContent">
        <section>
            <h1>Felhasználó törlése</h1>
            <form action="/" method="post" class="center">
                <label for="name">Felhasználónév/E-mail</label>
                <input type="text" name="name" id="name">

                <label for="password"> jelszó</label>
                <input type="password" name="password" id="password">

                <label for="password_confirmation">jelszó megerősítése</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
                <input type="submit" value="Törlés">

            </form>
        </section>
    </div>
@endsection
