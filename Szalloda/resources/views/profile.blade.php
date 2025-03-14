@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ertekelesek.css') }}">

    <script src="{{ asset('js/profile.js') }}"></script>
@endsection

@php
    $hasPermission = Auth::check() && Auth::user()->user_id == $user->user_id;
    $userActive = $user->active == 1
@endphp

@section('content')
    <div class="mainContent">
        <div class="profile-con">
            <div class="profile-header">
                <div class="profile-picture-con">
                    <img src="{{ asset('img/pfp/' . ($userActive ? $user->profilePic : 0) . '.png') }}" alt="Profilkép" class="profile-picture" id="profile">
                </div>
                <div class="profile-details-con">
                    <h2>{{ $userActive ? $user->username : "Törölt fiók" }}</h2>
                    @if ($hasPermission)
                        <div class="profile-option-con">
                            <a onclick="pfpmenu()">Profilképcsere</a>
                            <a href="/jelszovaltoztatas">Jelszóváltoztatás</a>
                            <a href="/fioktorles">Felhasználói fiókom törlése</a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="profile-body">
                @if ($userActive)
                    <div class="user-information">
                        <h2>Felhasználói Adatok</h2>
                        <form action="/profil/adat" method="post">
                            @csrf
                            <div class="user-data">
                                @if ($hasPermission)
                                    <label for="email">Email-cím</label>
                                    <input type="text" value="{{ $user->email }}" name="email" id="email">
                                    @error('email')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                @else
                                    <p>Email-cím: {{ $user->email }}</p>
                                @endif
                            </div>
                            <div class="user-data">
                                @if ($hasPermission)
                                    <label for="username">Felhasználónév</label>
                                    <input type="text" value="{{ $user->username }}" name="username" id="username">
                                    @error('username')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                @else
                                    <p>Felhasználónév: {{ $user->username }}</p>
                                @endif
                            </div>
                            <div class="user-data">
                                @if ($hasPermission)
                                    <label for="realname">Polgári név</label>
                                    <input type="text" value="{{ $user->lastName }} {{ $user->firstName }}" name="realname" id="realname">
                                    @error('realname')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                @else
                                    <p>Polgári név: {{ $user->lastName }} {{ $user->firstName }}</p>
                                @endif
                            </div>

                            @if ($hasPermission)
                                <button class="save-button" type="submit">Mentés</button>
                            @endif
                        </form>
                    </div>
                @endif
                <div class="ratings">
                    <h2>Értékelések</h2>
                    @if ($hasPermission)
                        <div class="flex">
                            <a href="/ertekeles"><button class="review-button">Új értékelés írása</button></a>
                        </div>
                    @endif
                    <div class="ratingSection center" id="ratingSection">
                        <script src="{{ asset('js/reviews.js') }}"></script>
                        @foreach ($reviews as $r)
                            <script>
                                renderRating("", "{{ $r->username }} - {{ $r->hotelName }}", "{{ $r->rating }}", "{{ $r->created_at }}", "{{ $r->reviewText }}", "{{ $r->profilePic }}", "{{ $r->user_id }}", "{{ $r->active == 1 }}")
                            </script>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <form action="/profil/pfp" method="post">
            @csrf
            <div class="ProfilePicture-Selection" id="pics" style="display: none">
                <div class="PPS-head">
                    <h2>Válasza ki a profilképét!</h2>
                </div>
                <hr>
                <div class="PPS-body">
                    @for ($i = 0; $i < 4; $i++)
                        <img src="{{ asset('img/pfp/' . $i . '.png') }}" alt="{{ $i }}" class="profile-picture" onclick="pfpchange({{ $i }})">
                    @endfor
                </div>
                <div class="PPS-buttons">
                    <button class="save-button" onclick="pfpmenu()">Mégse</button>
                    <button class="save-button" type="submit">Profilkép beállítása</button>
                    <input type="text" name="pfp" id="pfp" style="display: none">
                </div>
            </div>
        </form>
    </div>
@endsection
