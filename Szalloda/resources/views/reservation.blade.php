@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/foglalas.css') }}">

    <script src="{{ asset('js/reserve.js') }}"></script>
@endsection

@section('content')
    <div class="mainContent">
        <section>
            <h1>Foglalás</h1>
            <form action="/" method="post" class="center">
                <div class="form">
                    <label for="szalloda">Szálloda neve:</label>
                        <input type="text" name="szalloda" id="szalloda" style="display:none" value="{{$hotel->hotel_id}}">
                        <p>{{$hotel->hotelName}}</p>

                    <label for="service">Szolgálatások:</label>
                    <select name="service" id="service">
                        @foreach ($services as $s)
                            <option value="{{$s->service_id}}">{{$s->serviceName}}</option>
                        @endforeach
                    </select>

                    <label for="rooms">Szoba:</label>
                    <select name="rooms" id="rooms">
                        @foreach ($room as $r)
                        <option value="{{$r->room_id}}">{{$r->roomNumber}}</option>
                        @endforeach
                    </select>
                    <p>Dátum</p>
                    <input type="date">
                    <p class="inline">—</p>
                    <input type="date">
                    <br>
                    <br>
                    <p >Létszám: <span id="letszam"></span></p>

                    <p>Összeg</p>
                    <p class="flex"><span id="osszeg" class="inline">0</span> Ft</p>
                </div>

                <input type="submit" value="Foglalok">
            </form>
        </section>
    </div>
@endsection
