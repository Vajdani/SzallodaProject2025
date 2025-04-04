@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/telepules.css') }}">
@endsection

@section('content')
    <nav>
        <h1>{{ $city->cityName }}</h1>
    </nav>
    <div class="mainContent">
        <section>
            <img src="{{ asset('img/cities/'.$city->city_id.'.jpg') }}" alt="{{ $city->cityName }}.jpg" title="{{ $city->cityName }}" class="szallodaMainImg img-fluid" width="600px" height="400px">
            <div class="cityDescription">
                @for ($i = 0; $i < count($description); $i++)
                    <p>{{ $description[$i] }}</p>
                    <br>
                @endfor
            </div>
        </section>
        <div class="citySection">
            @foreach ($hotels as $hotel)
                <div class="city">
                    <a href="/szalloda/{{ $hotel->hotel_id }}">
                        <h2>{{ $hotel->hotelName }}</h2>
                    </a>
                    <div class="cityImgContainer">
                        <a href="/szalloda/{{ $hotel->hotel_id }}">
                            <img src="{{ asset('img/hotels/'.$hotel->hotel_id.'.jpg') }}" alt="{{ $hotel->hotelName }}" title="{{ $hotel->hotelName }}" class="img-fluid">
                        </a>
                        <p>
                            @if ($hotel->rating == '')
                                <p>Nincsenek értékelések.</p>
                            @else
                                <span class="starTicked">{{ str_repeat('★', $hotel->rating) }}</span><span class="halfStarTicked" {{--style="--ratio:{{ceil(($hotel->rating - floor($hotel->rating)) * 100)}}%"--}}>{{ str_repeat('★', ceil($hotel->rating - floor($hotel->rating))) }}</span><span class="starUnTicked">{{ str_repeat('★', 5 - ceil($hotel->rating)) }} - {{ $hotel->rating }}</span>
                                <p>{{ $hotel->ratingCount }} értékelés</p>
                            @endif
                        </p>
                    </div>
                    <table>
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
                    <hr>
                    @foreach (explode('{break}', $hotel->description) as $desc)
                        <p style="float: none;">
                            {{$desc}}
                        </p>
                        <br>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection
