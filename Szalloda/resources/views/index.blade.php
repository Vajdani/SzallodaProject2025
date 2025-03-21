@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="mainContent">
        <section>
            <h1>RushWave Retreat</h1>
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

                Kezdve a Frozen Retreat iglu szobáival, ahol a vendégek egy mesés, jéggel borított világban pihenhetnek, egészen a Cave Haven lenyűgöző bánya szobáiig, amelyek a természet rejtett titkaiba engednek betekintést. Minden szállodánk más-más varázslatos élményt kínál, legyen szó az vonatkabinból kialakított szobáinkról, vagy a vízalatti OceanView szobákról, amelyek a a tenger mélyén helyezkednek el.
                
                A RushWave Retreat nem csupán szállásokat kínál, hanem lehetőséget ad arra, hogy a vendégek valóban elrugaszkodjanak a hétköznapoki nyaralásoktól, és felfedezzék a világ különleges helyeit, ahol minden pillanat új kalandot tartogat.
                
                Fedezze fel velünk az extrém pihenés új világát, és élvezze a szállodáink által nyújtott kényelmet, miközben új kalandokat élhet át. Várjuk, hogy üdvözölhessük Önt a RushWave Retreat valamelyik különleges szállodájában, és hogy együtt élhessük át a felejthetetlen pillanatokat.
            </p>
        </section>
        <section>
            <h2>Miért válasszon minket?</h2>
            <hr>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget porta tellus. Vestibulum
                semper purus et vulputate sagittis. Fusce id malesuada ante. Nunc a libero nec urna tincidunt
                condimentum eget eu arcu. Cras lacinia sapien sit amet arcu placerat interdum. Praesent sed
                fringilla augue. Pellentesque et ex ut justo interdum commodo. Integer condimentum, magna et
                volutpat fermentum, justo orci interdum ante, et luctus nisl nisi vel justo. Quisque nunc diam,
                mollis at tincidunt id, faucibus et mauris. Etiam venenatis congue neque, sodales vestibulum augue
                tincidunt vel.

                Pellentesque mattis, tortor id aliquam semper, dui ex euismod dolor, in aliquet massa nunc ut neque.
                Nulla non est sed mauris mollis lobortis non dapibus tortor. Mauris nulla sem, fringilla in vehicula
                ut, dignissim quis nibh. Etiam a commodo lectus. In egestas nisl eget augue lacinia tempus. Proin eu
                diam finibus, vehicula leo non, facilisis dolor. Phasellus in eros ac velit suscipit pretium ut quis
                leo. Donec gravida, ante non molestie blandit, risus leo dictum massa, eget rutrum ligula ante et
                metus. Curabitur quis ullamcorper leo. Pellentesque id placerat tellus. Aenean porta mi nisl, vel
                pellentesque leo pulvinar vitae. Etiam ultrices risus vitae dapibus dignissim. Aenean vitae sapien
                convallis, pharetra enim at, cursus eros.

                Etiam lobortis ex et velit suscipit, eu ultricies erat bibendum. Integer varius massa et interdum
                fringilla. Etiam rutrum euismod risus, id tempor nisl rutrum sed. Quisque a sem auctor, egestas urna
                sed, faucibus nisi. Etiam pulvinar diam vel mauris volutpat facilisis. Phasellus luctus consequat
                sapien, a consequat augue tristique id. Aenean in euismod purus. Duis gravida dui a elit maximus
                aliquet. Ut placerat congue mi ut gravida. Maecenas euismod ut dui at condimentum. Nam laoreet erat
                et risus laoreet, vitae consequat est dignissim. Nunc feugiat gravida nulla in tincidunt.
            </p>
        </section>
    </div>
@endsection
