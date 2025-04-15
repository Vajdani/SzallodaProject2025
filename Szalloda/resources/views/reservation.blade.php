@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/foglalas.css') }}">

    <script src="{{ asset('js/reserve.js') }}"></script>
    <script>
        InitData(`{!! json_encode($rooms) !!}`, `{!! json_encode($services) !!}`, `{!! json_encode($userLoyalty)!!}` )
    </script>
@endsection

@php
    $minDate = date("Y-m-d", strtotime("+1 day"));
@endphp

@section('content')
    <nav>
        <h1>Foglalás</h1>
    </nav>
    <div class="mainContent">
        <section>
            <form action="/foglalas" method="post" class="center">
                <div class="formWindow">
                    @csrf
                    <div class="formHeader">
                        <h2>Foglalás adatai</h2>
                        <hr>
                    </div>

                    <div style="margin-bottom:5px">
                        <label for="hotel_id">Szálloda neve:</label>
                        <input type="text" name="hotel_id" id="hotel_id" style="display:none" value="{{ $hotel->hotel_id }}">
                        <p style="font-size:100%" class="inline">{{ $hotel->hotelName }}</p>
                    </div>

                    <div style="margin-bottom: 10px">
                        <p class="text-center">Dátum</p>
                        <div style="display:flex;justify-content:space-between">
                            <input type="date" id="startDate" class="inline" name="startDate" onchange="DateChanged()" min="{{$minDate}}" value="{{ old('startDate') }}">
                            <p class="inline" style="margin: 0 5px 0 5px">—</p>
                            <input type="date" id="endDate" class="inline" name="endDate" onchange="DateChanged()" min="{{$minDate}}" value="{{ old('endDate') }}">
                        </div>
                        @error('startDate')
                            <p class="error">{{ $message }}</p>
                        @enderror
                        @error('endDate')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="margin-bottom: 10px">
                        @error('service_id')
                            <p class="error">{{ $message }}</p>
                        @enderror

                        <label for="service_0">Szolgálatások:</label>
                        <div style="margin-bottom: 5px">
                            <input type="radio" name="service_id" id="service_0" value="0" onchange="ServiceSelected()">
                            <label for="service_0">Nem kérek ellátást</label>
                            @foreach ($services as $s)
                                @if ($s->category_id < 3)
                                    <div>
                                        <input type="radio" name="service_id" id="service_{{ $s->service_id }}" value="{{ $s->service_id }}" onchange="ServiceSelected()">
                                        <label for="service_{{ $s->service_id }}">{{ $s->serviceName }} - {{$s->price}} Ft <span style="font-weight: bolder">/</span> éjszaka</label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <hr>
                        <div id="services">
                            @foreach ($services as $s)
                                @if ($s->category_id >= 3)
                                    <div>
                                        <input type="checkbox" name="services[]" id="service_{{ $s->service_id }}" value="{{ $s->service_id }}" onchange="ServiceSelected()">
                                        <label for="service_{{ $s->service_id }}">{{ $s->serviceName }} - {{$s->price}} Ft</label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label for="room_id" style="align-self:flex-start">Szoba:</label>
                        <select name="room_id" id="room_id" onchange="RoomSelected()" style="align-self:flex-end">
                            @foreach ($rooms as $r)
                                <option value="{{ $r->room_id }}">{{ $r->roomNumber }}</option>
                            @endforeach
                        </select>
                    </div>


                    <p style="margin-top:10px">Létszám: <span id="letszam"></span></p>
                    <p>Összeg</p>
                    <p id="osszeg" class="finalPrice">0</p>
                </div>

                <div class="formWindow formWindow2" style="align-items: flex-start">
                    <div class="formHeader">
                        <h2>Számlázási adatok</h2>
                        <hr>
                    </div>

                    <div class="inputItem">
                        <label for="method">Fizetési módszer</label>
                        <select name="method" id="method">
                            <option value="cash">Készpénz</option>
                            <option value="credit card">Bank kártya</option>
                            <option value="debit card">Betéti kártya</option>
                            <option value="paypal">Paypal</option>
                        </select>
                        @error('method')
                            <p class="error">{{ $message }}</p>
                        @enderror
                        <hr>
                    </div>
                    <div class="inputItem">
                        <label for="country">Ország</label>
                        <input type="text" name="country" id="country" value="{{ old('country') }}" autocomplete="false">
                        @error('country')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="inputItem" style="display:flex;flex-direction:row;gap:10px">
                        <div class="w-100">
                            <label for="city">Város</label>
                            <input type="text" name="city" id="city" value="{{ old('city') }}">
                            @error('city')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-100">
                            <label for="zip">Zipcode</label>
                            <input type="text" name="zip" id="zip" value="{{ old('zip') }}">
                            @error('zip')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="inputItem">
                        <label for="line1">Utca és házszám</label>
                        <input type="text" name="line1" id="line1" value="{{ old('line1') }}">
                        @error('line1')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="inputItem">
                        <label for="line2">Egyéb adatok (például emelet és ajtószám)</label>
                        <input type="text" name="line2" id="line2" value="{{ old('line2') }}">
                        @error('line2')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <input type="submit" value="Foglalok" class="center">
                </div>
            </form>
        </section>
    </div>
@endsection
