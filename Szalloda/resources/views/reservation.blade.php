@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/foglalas.css') }}">

    <script src="{{ asset('js/reserve.js') }}"></script>
@endsection

@section('content')
    <div class="mainContent">
        <nav>
            <h1>Foglalás</h1>
        </nav>
        <section>
            <form action="/foglalas" method="post" class="center">
                <div class="form">
                    @csrf
                    <label for="hotel_id">Szálloda neve:</label>
                    <input type="text" name="hotel_id" id="hotel_id" style="display:none" value="{{$hotel->hotel_id}}">
                    <p>{{$hotel->hotelName}}</p>

                    <label {{--for="service"--}}>Szolgálatások:</label>
                    {{-- <select name="service" id="service">
                        @foreach ($services as $s)
                            <option value="{{$s->service_id}}">{{$s->serviceName}}</option>
                        @endforeach
                    </select> --}}
                    <div>
                        @error('ellatas')
                        <p class="error">{{ $message }}</p>
                        @enderror
                        <input type="radio" name="ellatas" id="service_0">
                        <label for="service_0">Nem kérek ellátást</label>
                        @foreach ($services as $s)
                            @if ($s->category_id<3)
                            <input type="radio" name="ellatas" id="service_{{$s->service_id}}">
                            <label for="service_{{$s->service_id}}">{{$s->serviceName}}</label>
                            @else
                            <div>
                                <input type="checkbox" name="services[]" value="{{$s->price}}|{{$s->service_id}}" id="service_{{$s->service_id}}">
                                <label for="service_{{$s->service_id}}">{{$s->serviceName}}</label>
                            </div>
                            @endif
                        @endforeach

                    </div>

                    <label for="rooms">Szoba:</label>
                    <select name="rooms" id="rooms">
                        @foreach ($room as $r)
                            <option value="{{$r->room_id}}|{{$r->pricepernight}}">{{$r->roomNumber}}</option>
                        @endforeach
                    </select>
                    <p>Dátum</p>
                    <div style="display:flex;justify-content:space-between">
                        <input type="date" id="startDate" style="display: inline" name="startDate">
                        <p class="inline">—</p>
                        <input type="date" id="endDate" style="display: inline" name="endDate">
                    </div>
                    @error('startDate')
                    <p class="error">{{ $message }}</p>
                    @enderror
                    @error('endDate')
                    <p class="error">{{ $message }}</p>
                    @enderror

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
