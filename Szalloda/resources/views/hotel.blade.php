@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/szalloda.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ertekelesek.css') }}">
@endsection

@php
    $oceanfloor = [ "Teknős","Bohóchal","Cápa","Horgászhal" ];
@endphp

@section('content')
    <nav>
        <h1>{{ $hotel->hotelName }} szálloda</h1>
    </nav>
    <div class="mainContent">
        <section>
            <img src="{{asset('img/hotels/'.$hotel->hotel_id.'.jpg')}}" alt="{{$hotel->hotel_id}}.jpg" title="{{$hotel->hotelName}}" class="szallodaMainImg img-fluid">
        </section>
        <section class="szallodaAdatSection">
            <div>
                <h2>A szállodáról</h2>
                <hr>
                {{-- <p>{{$hotel->description}}</p> --}}
                @for ($i = 0; $i < count($hotel_description); $i++)
                    <p>{{ $hotel_description[$i]}}</p>
                    <br>
                @endfor
                <hr>
            </div>
            <div>
                <p>Adatok:</p>
                <table>
                    <tr>
                        <th>Ország:</th>
                        <td>{{ $city->country }}</td>
                    </tr>
                    <tr>
                        <th>Város:</th>
                        <td>{{ $city->cityName }}</td>
                    </tr>
                    <tr>
                        <th>Cím:</th>
                        <td>{{ $hotel->address }}</td>
                    </tr>
                    <tr>
                        <th>Telefonszám:</th>
                        <td><a href="tel:{{ $hotel->phoneNumber }}">{{ $hotel->phoneNumber }}</a></td>
                    </tr>
                    <tr>
                        <th>E-mail cím:</th>
                        <td><a href="mailto:{{ $hotel->email }}">{{ $hotel->email }}</a></td>
                    </tr>
                </table>
                <br>
                <hr>
            </div>
            <div>
                <p>Képek</p>
                <div class="szallodaImgGrid">
                    @for ($i = 1; $i < 7; $i++)
                    <img src="{{asset('img/hotels/'.$hotel->hotel_id.'_'.$i.'.jpg')}}" alt="{{$hotel->hotelName}}_{{$i}}" title="{{$hotel->hotelName}} {{$i}}. kép" class="img-fluid">
                    @endfor
                </div>
                <hr>
            </div>
            <div>
                <p>Szobák</p>
                <table class="roomsTable">
                    <tr>
                        <th>Emelet</th>
                        <th>Szoba szám</th>
                        <th>Férőhely</th>
                        <th>Ár/éjszaka</th>
                    </tr>
                    @foreach ($rooms as $room)
                        <tr>
                            <td>
                                @if ($room->hotel_id == 5)
                                    {{$room->floor}}. vágány
                                @elseif($room->hotel_id == 3)
                                    {{$oceanfloor[$room->floor*-1-1]}} ({{$room->floor}}. emelet)
                                @else
                                    @if ($room->floor != null)
                                    {{$room->floor}}. emelet
                                    @elseif($room->floor === 0)
                                    fsz.
                                    @else
                                    —
                                    @endif
                                @endif
                            </td>
                            <td>{{$room->roomNumber}}</td>
                            <td>{{$room->capacity}} fő</td>
                            <td>{{$room->pricepernight}} Ft</td>
                        </tr>
                    @endforeach
                </table>
                <hr>
            </div>
            @auth
                <div class="text-center">
                    <a href="/foglalas/{{$hotel->hotel_id}}"><button class="book-button" type="submit">Foglalok!</button></a>
                </div>
            @else
                <div class="sectionHeader">
                    <hr>
                    <h2 class="text-center">A foglaláshoz először be kell jelentkeznie!</h2>
                    <hr>
                </div>
            @endauth
        </section>
        <section>
            <h2>Értékelések
            @auth
                @if ($writeReviews)
                    - <a href="/ertekeles/{{$hotel->hotel_id}}"><button class="review-button">Új értékelés írása</button></a>
                @endif
            @endauth</h2>
            <div class="ratingSection center" id="ratingSection">
                <script src="{{ asset('js/reviews.js') }}"></script>
                <script>
                    RenderReviewSection(`{!! json_encode($reviews) !!}`, 1, @auth "{{ Auth::user()->user_id }}" @else "-1" @endauth)
                </script>
            </div>
        </section>
        <section>
            <h2>A városról</h2>
            <div class="cityGrid">
                <div>
                    <h3>{{ $city->cityName }}</h3>
                    <p>
                       {{ $city_description }}
                    </p>
                </div>
                <a href="/telepules/{{ $city->city_id }}" style="flex-shrink:0.25;display:flex;justify-content:center">
                    <img src="{{ asset("img/cities/$city->city_id.jpg") }}" alt="{{ $city->cityName }}" title="{{ $city->cityName }}" class="img-fluid">
                </a>
            </div>
        </section>
    </div>
@endsection
