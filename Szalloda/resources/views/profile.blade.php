@extends('layout')

@section("css")
    <link rel="stylesheet" href="{{ asset("css/profil.css") }}">
    <script src="{{asset('js/profile.js')}}"></script>
@endsection

@section('content')
    <div class="mainContent">
        <div class="profile-con">
            <div class="profile-header">
                <div class="profile-picture-con">
                    <img src="{{asset('img/pfp/'.Auth::user()->profilePic.'.png')}}" alt="Profilkép" class="profile-picture" id="profile">
                </div>
                <div class="profile-details-con">
                    <h2>{{Auth::user()->username}}</h2>
                    <div class="profile-option-con">
                        <a onclick="pfpmenu()">Profilképcsere</a>
                        <a href="/jelszovaltoztatas">Jelszóváltoztatás</a>
                        <a href="/fioktorles">Felhasználó törlése</a>
                    </div>
                </div>
            </div>
            <div class="profile-body">
                <div class="user-information">
                    <h2>Felhasználói Adatok</h2>
                    <form action="/profil/adat" method="post">
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
                    <div class="flex">
                        <a href="/ertekeles"><button class="review-button">Új értékelés írása</button></a>
                    </div>
                    <div class="rating-con">
                    @foreach ($result as $review)
                        <div class="rating">
                            <div class="rating-head">
                                <div class="profile-picture-con">
                                    <img class="profile-picture" src="{{asset('img/pfp/'.Auth::user()->profilePic.'.png')}}" alt="">
                                </div>
                            </div>
                            <div class="rating-body">
                                <div class="rating-title">
                                    <h3>{{Auth::user()->username}} - {{$review->hotelName}}</h3>
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
        </div>
        <form action="/profil/pfp" method="post">
            @csrf
            <div class="ProfilePicture-Selection" id="pics" style="display: none">
                <div class="PPS-head">
                    <h2>Vállasza ki a porfilképet</h2>
                </div>
                <hr>
                <div class="PPS-body">
                    @for($i=0;$i<4;$i++)
                    <img src="{{asset('img/pfp/'.$i.'.png')}}" alt="{{$i}}" class="profile-picture" onclick="pfpchange({{$i}})">
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
