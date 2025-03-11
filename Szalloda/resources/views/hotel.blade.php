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
            <img src="https://placehold.co/600x400" alt="szalloda_kep_0" title="Szálloda" class="szallodaMainImg img-fluid">
        </section>
        <section class="szallodaAdatSection">
            <div>
                <h2>A szállodáról</h2>
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
                <hr>
            </div>
            <div>
                <p>Képek</p>
                <div class="szallodaImgGrid">
                    <img src="https://placehold.co/600x400" alt="szalloda_kep_1" title="Szálloda 1.kép" class="img-fluid">
                    <img src="https://placehold.co/600x400" alt="szalloda_kep_2" title="Szálloda 2.kép" class="img-fluid">
                    <img src="https://placehold.co/600x400" alt="szalloda_kep_3" title="Szálloda 3.kép" class="img-fluid">
                    <img src="https://placehold.co/600x400" alt="szalloda_kep_4" title="Szálloda 4.kép" class="img-fluid">
                    <img src="https://placehold.co/600x400" alt="szalloda_kep_5" title="Szálloda 5.kép" class="img-fluid">
                    <img src="https://placehold.co/600x400" alt="szalloda_kep_6" title="Szálloda 6.kép" class="img-fluid">
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
                            <td>{{$room->floor}}. emelet</td>
                            <td>{{$room->roomNumber}}. szoba</td>
                            <td>{{$room->capacity}} fő</td>
                            <td>{{$room->pricepernight}} Ft</td>
                        </tr>
                    @endforeach
                </table>
                <hr>
            </div>
        </section>
        <section>
            <h2>Értékelések</h2>
            <div class="ratingSection center" id="ratingSection">
                <script src="{{ asset('js/reviews.js') }}"></script>
                @foreach ($reviews as $r)
                    <script>
                        renderRating("", "{{ $r->username }} - {{ $r->hotelName }}", "{{ $r->rating }}", "{{ $r->created_at }}", "{{ $r->reviewText }}", "{{ $r->profilePic }}", "{{ $r->user_id }}", "{{ $r->active == 1 }}")
                    </script>
                @endforeach
            </div>
        </section>
        <section>
            <h2>A városról</h2>
            <div class="varosGrid">
                <div>
                    <p>{{ $city->cityName }}</p>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore a officia perspiciatis rem cumque
                        iusto.
                        Dolore expedita at, commodi nam voluptas architecto asperiores. Magnam perspiciatis facere quod
                        voluptate molestiae accusantium.
                    </p>
                </div>
                <img src="{{ asset("img/cities/$city->city_id.jpg") }}" alt="{{ $city->cityName }}" title="{{ $city->cityName }}" class="img-fluid">
            </div>
        </section>
    </div>
@endsection
