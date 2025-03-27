@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/foglalas.css') }}">

    <script src="{{ asset('js/reserve.js') }}"></script>
    <script>
        InitData(`{!! json_encode($rooms) !!}`, `{!! json_encode($services) !!}`)
    </script>
@endsection

@section('content')
    <nav>
        <h1>Foglalás</h1>
    </nav>
    <div class="mainContent">
        <section>
            <form action="/foglalas" method="post" class="center">
                <div class="form">
                    @csrf
                    <label for="hotel_id">Szálloda neve:</label>
                    <input type="text" name="hotel_id" id="hotel_id" style="display:none" value="{{ $hotel->hotel_id }}">
                    <p>{{ $hotel->hotelName }}</p>

                    <label {{-- for="service" --}}>Szolgálatások:</label>
                    {{-- <select name="service" id="service">
                        @foreach ($services as $s)
                            <option value="{{$s->service_id}}">{{$s->serviceName}}</option>
                        @endforeach
                    </select> --}}
                    <div>
                        @error('service_id')
                            <p class="error">{{ $message }}</p>
                        @enderror
                        <input type="radio" name="service_id" id="service_0" value="0" onchange="ServiceSelected()">
                        <label for="service_0">Nem kérek ellátást</label>
                        @foreach ($services as $s)
                            @if ($s->category_id < 3)
                                <input type="radio" name="service_id" id="service_{{ $s->service_id }}" value="{{ $s->service_id }}" onchange="ServiceSelected()">
                                <label for="service_{{ $s->service_id }}">{{ $s->serviceName }}</label>
                            @else
                                <div>
                                    <input type="checkbox" name="services[]" id="service_{{ $s->service_id }}" value="{{ $s->service_id }}" onchange="ServiceSelected()">
                                    <label for="service_{{ $s->service_id }}">{{ $s->serviceName }}</label>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <label for="room_id">Szoba:</label>
                    <select name="room_id" id="room_id" onchange="RoomSelected()">
                        @foreach ($rooms as $r)
                            <option value="{{ $r->room_id }}">{{ $r->roomNumber }}</option>
                        @endforeach
                    </select>
                    <p>Dátum</p>
                    <div style="display:flex;justify-content:space-between">
                        <input type="date" id="startDate" style="display: inline" name="startDate" onchange="DateChanged()" min="{{date("Y-m-d")}}" value="{{ old('startDate') }}">
                        <p class="inline">—</p>
                        <input type="date" id="endDate" style="display: inline" name="endDate" onchange="DateChanged()" value="{{ old('endDate') }}">
                    </div>
                    @error('startDate')
                        <p class="error">{{ $message }}</p>
                    @enderror
                    @error('endDate')
                        <p class="error">{{ $message }}</p>
                    @enderror

                    <br>
                    <br>
                    <p>Létszám: <span id="letszam"></span></p>

                    <p>Összeg</p>
                    <p class="flex"><span id="osszeg" class="inline">0</span> Ft</p>
                </div>

                <input type="submit" value="Foglalok">
            </form>
        </section>
    </div>
@endsection
