@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ertekelesek.css') }}">
    <meta name="_token" content="{{ csrf_token() }}">

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
                @if ($userActive && $hasPermission)
                    <div class="user-information">
                        <h2>Felhasználói Adatok</h2>
                        <form action="/profil/adat" method="post">
                            @csrf
                            <div class="user-data">
                                <label for="email">Email-cím</label>
                                <input type="text" value="{{ $user->email }}" name="email" id="email">
                                @error('email')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="user-data">
                                <label for="username">Felhasználónév</label>
                                <input type="text" value="{{ $user->username }}" name="username" id="username">
                                @error('username')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="user-data">
                                <label for="realname">Polgári név</label>
                                <input type="text" value="{{ $user->lastName }} {{ $user->firstName }}" name="realname" id="realname">
                                @error('realname')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <button class="save-button" type="submit">Mentés</button>
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
                        <script>
                            RenderReviewSection(`{!! json_encode($reviews) !!}`, @if ($hasPermission) {{3}} @else {{2}} @endif, @auth "{{ Auth::user()->user_id }}" @else "-1" @endauth)
                        </script>
                    </div>
                </div>
                @if ($hasPermission)
                <div class="ratings"></div>
                <h2>Foglalásaid</h2>
                    @foreach ($booking as $b)
                        <div class="rating center">
                            <div class="ratingUser">
                                <div class="profilePicture">
                                    <a href="/szalloda/{{$b->hotel_id}}"><img src="/img/hotels/{{$b->hotel_id}}.jpg" alt="{{$b->hotelName}}.jpg" title="{{$b->hotelName}}" class="img-fluid profile-picture"></a>
                                    <p class="text-center">{{$b->hotelName}}</p>
                                </div>
                                <div class="data">
                                    <div>
                            

                                        <h3>{{$b->bookStart}} — {{$b->bookEnd}} (@if($b->status == "confirmed")
                                            Megerősítve
                                            @elseif($b->status == "cancelled")
                                            Lemondva
                                            @elseif($b->status == "completed")
                                            befejezett
                                        @endif)</h3>
                                        <p>@if($b->status == "confirmed")
                                            Fizetendő összeg: {{$b->price}} Ft
                                            @elseif($b->status == "completed")
                                            Fizetett összeg: {{$b->price}} Ft
                                        @endif</p>
                                        <p>` + created_at + `</p>
                                        <p>` + ((review == "" || review == "null" || review == null) ? "" : review) + `</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
