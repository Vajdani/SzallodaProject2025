@extends('layout')

@section("css")
    <link rel="stylesheet" href="css/profil.css">
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset("css/profil.css") }}">

    <div class="profile-con">
        <div class="profile-header">
            <div class="profile-picture-con">
                <img src="https://placehold.co/100" alt="Profilkép" class="profile-picture">
            </div>
            <div class="profile-details-con">
                <h2>{{Auth::user()->username}}</h2>
                <div class="profile-option-con">
                    <a href="">Profilképcsere</a>
                    <a href="/jelszovaltoztatas">Jelszóváltoztatás</a>
                    <a href="/fioktorles">Felhasználó törlése</a>
                </div>
            </div>
        </div>
        <div class="profile-body">
            <div class="user-information">
                <h2>Felhasználói Adatok</h2>
                <form action="/profil" method="post">
                    @csrf
                    <div class="user-data">
                        <label for="email">Email-cím</label>
                        <input type="text" value="{{Auth::user()->email}}" name="email" id="email">
                        @error('email')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="user-data">
                        <label for="username">Felhasználónév</label>
                        <input type="text" value="{{Auth::user()->username}}" name="username" id="username">
                        @error('username')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="user-data">
                        <label for="realname">Polgári név</label>
                        <input type="text" value="{{Auth::user()->lastName}} {{Auth::user()->firstName}}" name="realname" id="realname">
                        @error('realname')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button class="save-button" type="submit">Mentés</button>
                </form>
            </div>
            <div class="ratings">
                <h2>Értékelések</h2>
                <a href="/ertekeles"><button class="save-button">Új értékelés írása</button></a>
                @foreach ($result as $review)
                <div class="rating-con">
                    <div class="rating">
                        <div class="rating-head">
                            <div class="profile-picture-con">
                                <img class="profile-picture" src="https://placehold.co/100" alt="">
                            </div>
                            <div class="rating-title">
                                <h3>{{Auth::user()->username}} - {{$hotel[$review->hotel_id-1]}}</h3>
                            </div>
                        </div>
                        <div class="rating-info">
                            <p>@for ($i = 0; $i < 5; $i++)
                                @if($i < $review->rating)
                                    <span class="starTicked">★</span>
                                @else
                                <span class="starUnTicked">★</span>
                                @endif
                            @endfor — {{$review->created_at}}</p>
                        </div>
                        <div class="rating-desc">
                            <p>{{$review->reviewText}}</p>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
