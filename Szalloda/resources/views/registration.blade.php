@extends('layout')

@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('css/bejelentkezes.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/regisztracio.css') }}">
@endsection

@section('content')
    <div class="mainContent">
        <form action="/regisztracio" method="post" class="form-design">
            @csrf

            <h1>Regisztráció</h1>

            <div class="inputItem">
                <label for="name">Felhasználónév</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}">
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="inputItem">
                <label for="lastName">Vezetéknév</label>
                <input type="text" name="lastName" id="lastName" value="{{ old('lastName') }}">
                @error('lastName')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="inputItem">
                <label for="firstName">Keresztnév</label>
                <input type="text" name="firstName" id="firstName" value="{{ old('firstName') }}">
                @error('firstName')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="inputItem">
                <label for="email">E-mail cím</label>
                <input type="text" name="email" id="email" value="{{ old('email') }}"
                    placeholder="pl: valaki@gmail.com">
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="inputItem">
                <label for="phonenumber">Telefonszám</label>
                <input type="text" name="phonenumber" id="phonenumber" value="{{ old('phonenumber') }}"
                    placeholder="pl: +36201111111">
                @error('phonenumber')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="inputItem">
                <label for="password">Jelszó</label>
                <input type="password" name="password" id="password">
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="inputItem">
                <label for="password_confirmation">Jelszó ismét</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
                @error('password_confirmation')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="inputItem">
                <label for="date">Születési dátum</label>
                <input type="date" name="date" id="date" value="{{ old('date') }}" max="{{ date("Y-m-d", strtotime("-18 year")) }}">
                @error('date')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="inputItem text-center">
                <input type="checkbox" name="tos" id="tos">
                <label for="tos" style="display: inline">Elfogadom a <a href="/felhasznaloi_feltetetel">felhasználói feltételeket</a></label>
                @error('tos')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit">Regisztráció</button>
        </form>
    </div>
@endsection
