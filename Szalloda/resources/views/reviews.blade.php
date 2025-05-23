@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/ertekelesek.css') }}">
    <script src="https://kit.fontawesome.com/26a3e6423d.js"crossorigin="anonymous"></script>
@endsection

@section('content')
    <nav class="filterBar" style="padding: 0;">
        <ul>
            <li>Szűrés:</li>
            <li>
                <div style="display:inline">
                    <select name="csillagok" id="csillagok">
                        <option value="0">Összes</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    ★
                </div>
            </li>
            <li>
                <div style="display:inline">
                    <select name="varos" id="varos">
                        <option value="0">Összes</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->city_id }}" onchange="">{{ $city->cityName }}</option>
                        @endforeach
                    </select>
                    város
                </div>
            </li>
            <li>
                <div style="display:inline">
                    <select name="szalloda" id="szalloda">
                        <option value="0">Összes</option>
                        @foreach ($hotels as $hotel)
                            <option value="{{ $hotel->hotel_id }}">{{ $hotel->hotelName }}</option>
                        @endforeach
                    </select>
                    szálloda
                </div>
            </li>
        </ul>
    </nav>
    <div class="mainContent">
        <div class="ratingSection center" id="ratingSection">
            <script src="{{ asset('js/reviews.js') }}"></script>
            <script>
                RenderReviewSection(`{!! json_encode($reviews) !!}`, 0, @auth "{{ Auth::user()->user_id }}" @else "-1" @endauth)
            </script>
        </div>
    </div>
@endsection
