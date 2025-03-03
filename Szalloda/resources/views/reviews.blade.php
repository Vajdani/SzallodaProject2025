@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/ertekelesek.css') }}">
@endsection

@section('content')
    <div class="mainContent">
        <div class="filterBar">
            <ul>
                <li>Szűrés:</li>
                <li>
                    <select name="csillagok" id="csillagok">
                        <option value="1">1 csillag</option>
                        <option value="2">2 csillag</option>
                        <option value="3">3 csillag</option>
                        <option value="4">4 csillag</option>
                        <option value="5">5 csillag</option>
                    </select>
                </li>
                <li>
                    <select name="varos" id="varos">
                        @foreach ($cities as $city)
                            <option value="{{$city->city_id}}">{{$city->cityName}}</option>
                        @endforeach
                    </select>
                </li>
                <li>
                    <select name="szalloda" id="szalloda">
                        @foreach ($hotels as $hotel)
                            <option value="{{$hotel->hotel_id}}">{{$hotel->hotelName}}</option>
                        @endforeach
                    </select>
                </li>
            </ul>
        </div>
        <div class="ratingSection center">
            @foreach ($reviews as $r)
                <div class="rating">
                    <div class="ratingUser">
                        <div class="profilePicture">
                            <img src="https://placehold.co/400" alt="profilkep" title="Profilkép" class="img-fluid">
                        </div>
                        <div class="data">
                            <div>
                                <p>{{ $r->username }}</p>
                                <p>{{ $r->hotelName }}</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>
                            @for ($i = 0; $i < 5; $i++)
                                @if ($i < $r->rating)
                                    <span class="starTicked">★</span>
                                @else
                                    <span class="starUnTicked">★</span>
                                @endif
                            @endfor — {{ $r->created_at }}
                        </p>
                        <p>
                            {{ $r->reviewText }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="{{asset('js/reviews.js')}}"></script>
@endsection
