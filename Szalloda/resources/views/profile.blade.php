@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ertekelesek.css') }}">
    <meta name="_token" content="{{ csrf_token() }}">

    <script src="{{ asset('js/profile.js') }}"></script>
@endsection

@php
    $hasPermission = Auth::check() && Auth::user()->user_id == $user->user_id;
    $userActive = $user->active == 1;
@endphp
@section('content')
    <div class="mainContent">
        <div class="profile-con">
            <div class="profile-header">
                <div class="profile-picture-con">
                    <img src="{{ asset('img/pfp/' . ($userActive ? $user->profilePic : 0) . '.png') }}" alt="Profilkép"
                        class="profile-picture" id="profile">
                </div>
                <div class="profile-details-con">
                    <h2>{{ $userActive ? $user->username : 'Törölt fiók' }} — <img src="{{ asset('img/loyalty/' . $loyalty[0]->rank_id . '.png') }}" alt="{{ $loyalty[0]->rank }}.png" title="{{$loyalty[0]->rank}}" class="loyalty"></h2>
                    @if ($hasPermission)
                        <div class="profile-option-con">
                            <a
                            @if ($loyalty[0]->rank_id!=4)
                            onclick="loyaltymenu('{{$loyalty[0]->rank}}', '{{$loyalty[0]->points}}', '{{$loyalty[0]->minPoint}}', '{{$nextRank[0]->minPoint}}', '{{$loyalty[0]->rank_id}}' @foreach($perks as $p),'{{$p}}' @endforeach)"
                            @else
                            onclick="loyaltymax('{{$loyalty[0]->rank}}', '{{$loyalty[0]->rank_id}}' @foreach($perks as $p),'{{$p}}' @endforeach)"
                            @endif
                            >Hűségprogram megtekintése</a>
                            <a onclick="pfpmenu()">Profilképcsere</a>
                            <a href="/jelszovaltoztatas">Jelszóváltoztatás</a>
                            <a href="/fioktorles">Felhasználói fiókom törlése</a>
                        </div>
                    @else
                    @if ($userActive == 1)
                    <p>Polgári név: {{ $user->lastName }} {{ $user->firstName }}</p>
                    @endif
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
                                <label for="phonenumber">Telefonszám</label>
                                <input type="text" name="phonenumber" id="phonenumber" value="{{ $user->phonenumber }}" placeholder="pl: +36201111111">
                                @error('phonenumber')
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
                                <input type="text" value="{{ $user->lastName }} {{ $user->firstName }}" name="realname"
                                    id="realname">
                                @error('realname')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <button class="save-button" type="submit">Mentés</button>
                        </form>
                    </div>
                @endif
                <div class="ratings">
                    <h2>
                        Értékelések
                        @if ($hasPermission && $writeReviews)
                            <span style="font-weight:normal">
                                — <a href="/ertekeles"><button class="review-button">Új értékelés írása</button></a>
                            </span>
                        @endif
                    </h2>

                    <div class="ratingSection center" id="ratingSection">
                        <script src="{{ asset('js/reviews.js') }}"></script>
                        <script>
                            RenderReviewSection(
                                `{!! json_encode($reviews) !!}`,
                                @if ($hasPermission) {{ 3 }} @else {{ 2 }} @endif,
                                @auth "{{ Auth::user()->user_id }}" @else "-1" @endauth
                            )
                        </script>
                    </div>
                </div>
                @if ($hasPermission)
                    <div class="ratings"></div>
                    <h2>Foglalásaid</h2>
                    <div class="bookingSection center">
                        @foreach ($booking as $b)
                            <div class="rating center">
                                <div class="ratingUser">
                                    <div class="profilePicture">
                                        <a href="/szalloda/{{ $b->hotel_id }}">
                                            <img src="/img/hotels/{{ $b->hotel_id }}.jpg" alt="{{ $b->hotelName }}.jpg" title="{{ $b->hotelName }}" class="img-fluid profile-picture">
                                        </a>
                                        <p class="text-center" style="text-wrap:auto">{{ $b->hotelName }}</p>
                                    </div>
                                    <div class="ratingData">
                                        <div>
                                            <form action="/profil/lemond" method="post">
                                                @csrf
                                            <h3 style="text-wrap:auto">{{ $b->bookStart }} — {{ $b->bookEnd }}
                                                (@if ($b->status == 'confirmed')
                                                    Megerősítve
                                                @elseif($b->status == 'cancelled')
                                                    Visszatérítve
                                                @elseif($b->status == 'refund requested')
                                                    visszatérítés kérvényezve
                                                @elseif($b->status == 'completed')
                                                    Befejezve
                                                @endif)
                                                @if($b->status=='confirmed')
                                                    <button class="cancel-button" type="submit" value="{{$b->booking_id}}" id="cancel" name="cancel">Lemondás</button>
                                                @endif
                                            </h3>
                                            </form>
                                            <p>
                                                @if ($b->status == 'confirmed')
                                                    Fizetendő összeg: {{ $b->totalPrice }} Ft
                                                @elseif($b->status == 'completed')
                                                    Fizetett összeg: {{ $b->totalPrice }} Ft
                                                @endif
                                            </p>

                                            @if ($b->services != '')
                                                <h4>Szolgáltatások:</h4>
                                                <ul>
                                                    @foreach ($services[$b->booking_id] as $service)
                                                        <li>{{ $service->serviceName }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
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
