@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/foglalas.css') }}">
@endsection

@section('content')
    <div class="mainContent">
        <section>
            <h1>Foglalás</h1>
            <form action="/" method="post" class="center">
                <div class="form">
                    <label for="szalloda">Szálloda neve:</label>
                    @isset($hotel_id)
                        <input type="text" name="szalloda" id="szalloda" style="display:none" value="{{$hotel_id}}">
                        <p>{{$hotelName}}</p>
                    @else
                        <select name="szalloda" id="szalloda">
                            @foreach ($hotels as $hotel)
                                <option value="{{$hotel["hotel_id"]}}">{{$hotel["hotelName"]}}</option>
                            @endforeach
                        </select>
                    @endisset                    
                    <p>Ellátás típusa</p>
                    <div class="ellatas-opcio">
                        <label for="full" class="inline">Teljes ellátás</label> <input type="radio" name="ellatas"
                            id="full"><span></span>
                    </div>
                    <div class="ellatas-opcio">
                        <label for="half" class="inline">Fél panzió</label> <input type="radio" name="ellatas"
                            id="half"><span></span>
                    </div>
                    <div class="ellatas-opcio">
                        <label for="none" class="inline">Nincs</label> <input type="radio" name="ellatas"
                            id="none">
                    </div>
                    <p>Dátum</p>
                    <input type="date">
                    <p class="inline">—</p> <input type="date">
                    <br>
                    <br>
                    <label for="letszam">Létszám:</label>
                    <select name="letszam" id="letszam">
                        <option value="1">Egy fő</option>
                        <option value="2">Két fő</option>
                        <option value="3">Három fő</option>
                        <option value="4">Négy fő</option>
                    </select>
                    <p class="inline">xxx Ft/fő</p>
                </div>
                <div class="form">
                    <label for="nev">Vásárló teljes neve</label> <input type="text" name="nev" id="nev">
                    <label for="bankkartya" class="block">Fizetési módszer</label>
                    <div class="ellatas-opcio">
                        <label for="bankkartya" class="inline">Bankkártya</label>
                        <input type="radio" name="fizetes" id="bankkartya" class="inline">
                    </div>
                    <div class="ellatas-opcio">
                        <label for="keszpenz" class="inline">Készpénz</label>
                        <input type="radio" name="fizetes" id="keszpenz">
                    </div>


                    <label for="szuldate">Születési dátum</label>
                    <input type="date" id="szuldate">
                    <br>
                    <label for="kod">Telefonszám</label>
                    <div class="telefonszam">
                        <input type="text" name="kod" id="kod" class="kod inline" value="+36">
                        <input type="text" name="szam" id="szam" class="szam inline"><br>
                    </div>
                    <label for="email">E-mail</label> <input type="text" name="email" id="email"><br>
                    <label for="special">Speciális információ (allergiák, étrendek)</label>
                    <textarea name="special" id="special"></textarea>
                </div>

                <input type="submit" value="Foglalok">
            </form>
        </section>
    </div>
@endsection
