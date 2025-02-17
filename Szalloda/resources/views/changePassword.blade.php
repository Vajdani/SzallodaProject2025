@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/bejelentkezes.css') }}">
@endsection

@section('content')
    <div class="mainContent">
        <section>
            <h1>Jelszó módosítása</h1>
            <form action="/" method="post" class="center">
                <label for="name">Felhasználónév/E-mail</label>
                <input type="text" name="name" id="name">

                <label for="old_password">Régi jelszó</label>
                <input type="password" name="old_password" id="old_password">


                <label for="new_password">Új jelszó</label>
                <input type="password" name="new_password" id="new_password">

                <label for="new_password_confirmation">Új jelszó megerősítése</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation">

                <input type="submit" value="Módosítás">

            </form>
        </section>
    </div>
@endsection
