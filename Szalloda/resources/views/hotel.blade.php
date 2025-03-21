@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/szalloda.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ertekelesek.css') }}">
@endsection

@section('content')
    <div class="mainContent">
        <section>
            <h1>{{ $hotel->hotelName }}</h1>
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
                        <td>{{ $hotel->phoneNumber }}</td>
                    </tr>
                    <tr>
                        <th>E-mail cím:</th>
                        <td>{{ $hotel->email }}</td>
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
            <!--<div>
                <p>Szolgáltatások</p>
                <table class="roomsTable">
                    <tr>
                        <th>Név</th>
                        <th>Ár</th>
                        <th>Jelenleg elérhető-e</th>
                        <th>Egész évben elérhető-e</th>
                    </tr>
                    @foreach ($services as $service)
                        <tr>
                            <td>{{$service->serviceName}}</td>
                            <td>{{$service->price}} Ft</td>
                            <td>{{$service->available == 1 ? "Igen" : "Nem"}}</td>
                            <td>{{$service->allYear == 1 ? "Igen" : "Nem"}}</td>
                        </tr>
                    @endforeach
                </table>
                <hr>
            </div>
            -->
            <div class="text-center">
            <button class="book-button " type="submit">Foglalok!</button>
            </div>
        </section>
        <section>
            <h2>Értékelések @auth
                - <a href="/ertekeles/{{$hotel->hotel_id}}"><button class="review-button">Új értékelés írása</button></a>
            @endauth</h2>
            <div class="ratingSection center" id="ratingSection">
                <script src="{{ asset('js/reviews.js') }}"></script>
                @foreach ($reviews as $r)
                    @if ($r->active == 1)
                        <script>
                            renderRating("{{ $r->username }}", "", "", "{{ $r->rating }}", "{{ $r->created_at }}", "{{ $r->reviewText }}", "{{ $r->profilePic }}", "{{ $r->user_id }}", "{{ $r->active == 1 }}")
                        </script>
                    @else
                        <script>
                            renderRating("Törölt fiók", "", "", "{{ $r->rating }}", "{{ $r->created_at }}", "{{ $r->reviewText }}", "{{ $r->profilePic }}", "{{ $r->user_id }}", "{{ $r->active == 1 }}")
                        </script>
                    @endif
                @endforeach
            </div>
        </section>
        <section>
            <h2>A városról</h2>
            <div class="varosGrid">
                <div>
                    <h3>{{ $city->cityName }}</h3>
                    <p>
                       {{ $city_description }}
                    </p>
                </div>
                <a href="/telepules/{{ $city->city_id }}">
                    <img src="{{ asset("img/cities/$city->city_id.jpg") }}" alt="{{ $city->cityName }}" title="{{ $city->cityName }}" class="img-fluid">
                </a>
            </div>
        </section>
    </div>
@endsection
