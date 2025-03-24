@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <nav>
        <h1>RushWave Retreat</h1>
    </nav>
    <div class="mainContent">
        <section>
            <div id="myCarousel" class="carousel slide center" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    @foreach ($cities as $city)
                        @if ($city->city_id == 1)
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        @else
                            <li data-target="#myCarousel" data-slide-to={{ $city->city_id - 1 }}></li>
                        @endif
                    @endforeach
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    @foreach ($cities as $city)
                        @if ($city->city_id == 1)
                            <div class="item active">
                        @else
                            <div class="item">
                        @endif
                        <a href="/telepules/{{ $city->city_id }}">
                            <img src="{{ asset('img/cities/' . $city->city_id . '.jpg') }}" alt="{{ $city->cityName }}"
                                title="{{ $city->cityName }}">
                            <div class="carousel-caption">
                                <h3>{{ $city->cityName }}</h3>
                                <p class="text-center">{{ $city->country }}</p>
                            </div>
                        </a>
                </div>
                @endforeach


                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </section>
        <section>
            <h2>Oldalról</h2>
            <hr>
            <p>

                Üdvözöljük a RushWave Retreat hivatalos weboldalán! Weboldalunk célja, hogy lehetővé tegye a vendégeink számára, hogy könnyen, gyorsan és egyszerűen foglaljanak szállást bármelyik hotelünkben, mindössze néhány kattintással. Fedezze fel a RushWave Retreat által kínált prémium szolgáltatásokat és szokatlan szálláshelyeit.

                Weboldalunkon könnyedén megtekintheti szállodáink széles választékát, valamint azok részletes leírásait és az aktuális elérhetőségeket. Az egyes hotelekhez tartozó értékelések segítenek hogy kitudja választani az önnek megfelelő szállást, ezzel garantálva ön kényelmét. Emellett átfogó információkat talál a szobatípusokról, szolgáltatásainkról, illetve az étkezési lehetőségekről.

                Az egyszerű és biztonságos foglalási rendszerünk segítségével gyorsan és zökkenőmentesen intézheti szállásfoglalását, miközben különböző ajánlataink és akcióink segítségével a legjobb ár-érték arányú szobákat találhatja meg.

                A RushWave Retreat csapata elkötelezett amellett, hogy minden vendégünk számára felejthetetlen élményt nyújtson, és biztosítja, hogy pihenése a lehető legkényelmesebb és legpihentetőbb legyen. Bízunk benne, hogy weboldalunk segíteni fog Önnek a tökéletes szállás kiválasztásában, és hamarosan személyesen is üdvözölhetjük egy szállodánkban!
            </p>
        </section>
        <section>
            <h2>Rólunk:</h2>
            <hr>
            <p>
                A RushWave Retreat nem szokásos hoteleket birtokol, cégünk specialitása ugyanis az extrém élmények. Minden szállodánk egyedi és különleges, valamint igazán szokatlan élményt kínálva vendégeink számára. Szállodáinkat úgy terveztük, hogy azok túllépjenek a hagyományos pihenés határain, és egy új, izgalmas világba repítsék látogatóinkat.

                Kezdve a Frozen Retreat iglu szobáival, ahol a vendégek egy jéggel borított világban pihenhetnek, egészen a Cave Haven lenyűgöző bánya szobáiig, amelyek a természet rejtett titkaiba engednek betekintést. Minden szállodánk más-más varázslatos élményt kínál, legyen szó az vonatkocsikból kialakított szobáinkról, vagy a vízalatti OceanView szobákról, amelyek a a tenger mélyén helyezkednek el.

                A RushWave Retreat nem csupán szállásokat kínál, hanem lehetőséget ad arra, hogy a vendégek valóban elrugaszkodjanak a hétköznapoki nyaralásoktól, és felfedezzék a világ különleges helyeit, ahol minden pillanat új kalandot tartogat.

                Fedezze fel velünk az extrém pihenés új világát, és élvezze a szállodáink által nyújtott kényelmet, miközben új kalandokat élhet át. Várjuk, hogy üdvözölhessük Önt a RushWave Retreat valamelyik különleges szállodájában, és hogy együtt élhessük át a felejthetetlen pillanatokat.
            </p>
        </section>
        <section>
            <h2>Miért válasszon minket?</h2>
            <hr>
            <p>
                A RushWave Retreat egyéni élményeket kínál

            </p>
        </section>
    </div>
@endsection
