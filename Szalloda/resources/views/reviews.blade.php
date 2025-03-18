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
                        <option value="0">Összes</option>
                        <option value="1">1 csillag</option>
                        <option value="2">2 csillag</option>
                        <option value="3">3 csillag</option>
                        <option value="4">4 csillag</option>
                        <option value="5">5 csillag</option>
                    </select>
                </li>
                <li>
                    <select name="varos" id="varos">
                        <option value="0">Összes</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->city_id }}" onchange="">{{ $city->cityName }}</option>
                        @endforeach
                    </select>
                </li>
                <li>
                    <select name="szalloda" id="szalloda">
                        <option value="0">Összes</option>
                        @foreach ($hotels as $hotel)
                            <option value="{{ $hotel->hotel_id }}">{{ $hotel->hotelName }}</option>
                        @endforeach
                    </select>
                </li>
            </ul>
        </div>
        <div class="ratingSection center" id="ratingSection">
            <script src="{{ asset('js/reviews.js') }}"></script>
            @foreach ($reviews as $r)
                <script>
                    renderRating("{{ $r->username }}", "{{ $r->hotelName }}", "{{ $r->hotel_id }}", "{{ $r->rating }}", "{{ $r->created_at }}", "{{ $r->reviewText }}", "{{ $r->profilePic }}", "{{ $r->user_id }}", "{{ $r->active == 1 }}")
                </script>
            @endforeach
        </div>
    </div>
@endsection
