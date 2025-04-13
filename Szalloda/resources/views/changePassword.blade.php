@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/regisztracio.css') }}">
@endsection

@section('content')
    <nav>
        <h1>Jelszó módosítása</h1>
    </nav>
    <div class="mainContent">
        <form action="/jelszovaltoztatas" method="post" class="form-design">
            @csrf
            <div class="inputItem">
                <label for="password">Régi jelszó</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="inputItem">
                <label for="newpassword">Új jelszó</label>
                <input type="password" name="newpassword" id="newpassword">
            </div>
            <div class="inputItem">
                <label for="newpassword_confirmation">Új jelszó megerősítése</label>
                <input type="password" name="newpassword_confirmation" id="newpassword_confirmation">
            </div>


            <button type="submit">Módosítás</button>
        </form>
    </div>
@endsection
