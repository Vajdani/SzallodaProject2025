@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/tos.css') }}">
@endsection

@section('content')
    <div class="mainContent">
        <div class="tos_div">
            <ol class="tos_mainlist">
                <li class="tos_item">A Weboldal Használata
                    <ol class="tos_sublist">
                        <li class="tos_subitem">A RushWave Retreat weboldalát kizárólag a szállásfoglalás céljából használhatja. A weboldalon található információk, képek és anyagok szerzői jogvédelem alatt állnak, és azok másolása, terjesztése, módosítása vagy bármely más jogellenes felhasználása tilos.</li>
                        <li class="tos_subitem">A weboldalon történő foglalások a rendszer automatikus elérhetősége alapján történnek. Az Ön által végrehajtott foglalás nem minősül véglegesnek, amíg azt a szálloda megerősíti.</li>
                    </ol>
                </li>
                <li class="tos_item">Foglalás és Fizetés
                  <ol class="tos_sublist">
                    <li class="tos_subitem">A foglalás érvényesítéséhez a weboldalon megadott adatokat (pl. név, cím, érkezés és távozás dátuma, szobatípus) helyesen kell kitölteni.</li>
                    <li class="tos_subitem">A szállásdíj fizetése történhet bankkártyával, átutalással vagy a szállodában történő közvetlen kifizetéssel, a foglalás típusától függően.</li>
                    <li class="tos_subitem">A fizetési folyamat során a rendszer banki és/vagy hitelesítési szolgáltatók által biztosított biztonságos fizetési rendszert használ. A weboldal nem tárolja a bankkártya-adatokat.</li>
                  </ol>
                </li>
                <li class="tos_item">Foglalás lemondása
                  <ol class="tos_sublist">
                    <li class="tos_subitem">A foglalás lemondása a szálloda lemondási politikájának megfelelően történhet. Kérjük, vegye figyelembe, hogy egyes foglalások nem mondhatóak le díjmentesen.</li>
                    <li class="tos_subitem">A legkésőbbi díjmentes lemondási időpont egy héttel a foglalás dátuma előtt van. Az ezután történő lemondásokat nem tudjuk díjmentesen visszatéríteni</li>
                  </ol>
                </li>
                <li class="tos_item">Szállás Szolgáltatások
                    <ol class="tos_sublist">
                        <li class="tos_subitem">A  szálloda minden tőle telhetőt megtesz annak érdekében, hogy biztosítsa a szolgáltatások minőségét és elérhetőségét, de fenntartja a jogot a szolgáltatások módosítására vagy felfüggesztésére.</li>
                        <li class="tos_subitem">A szállodai szobák és egyéb szolgáltatások elérhetősége előzetes foglalás alapján történik. A szálloda nem garantálja, hogy minden szolgáltatás vagy szoba típus mindig elérhető lesz.</li>
                    </ol>
                </li>
                <li class="tos_item">Felhasználói felelősség
                    <ol class="tos_sublist">
                        <li class="tos_subitem">A felhasználó felelős a weboldalon megadott adatok helyességéért. A hamis vagy hiányos adatok megadása a foglalás érvénytelenítését eredményezheti.</li>
                        <li>A felhasználó vállalja, hogy nem használja a weboldalt jogellenes vagy káros célra, és nem zavarja a weboldal működését.</li>
                    </ol>
                </li>
                <li class="tos_item">Adatvédelem
                    <ol class="tos_sublist">
                        <li class="tos_subitem">A felhasználói adait a RushWave Retreat az adatvédelmi jogszabályoknak megfelelően megőrzi és nem használja káros célra</li>
                    </ol>
                </li>
                <li class="tos_item">Felelősség
                    <ol class="tos_sublist">
                        <li class="tos_subitem">A szálloda nem vállal felelősséget semmilyen közvetett vagy közvetlen kárért, amely a weboldal használatából vagy a foglalás során felmerült problémákból ered.</li>
                        <li class="tos_subitem">A szálloda nem vállal felelősséget az esetleges technikai hibákért, amelyek befolyásolják a weboldal működését.</li>
                    </ol>
                </li>
                <li class="tos_item">Jogviták és Alkalmazandó Jog
                    <ol class="tos_sublist">
                        <li class="tos_subitem">A jelen felhasználói feltételekkel kapcsolatos jogviták esetén a RushWave Retreat székhelye szerinti bíróság kizárólagos illetékességgel rendelkezik.</li>
                        <li class="tos_subitem"> jelen feltételek értelmezésére Magyarország jogszabályai az irányadóak</li>
                    </ol>
                </li>
                <li class="tos_item">Kárfelelősség és Kártérítés
                    <ol class="tos_sublist">
                        <li class="tos_subitem">A felhasználó felelősséggel tartozik a szállodában okozott bármilyen kárért, amely szándékos vagy gondatlanság következményeként keletkezik. Ha a felhasználó bármilyen módon károsítja a szálloda tulajdonát, berendezését, eszközeit, vagy egyéb ingóságait, köteles a kár teljes összegét megtéríteni.</li>
                        <li class="tos_subitem">A kártérítési összeg magában foglalhatja az eszközök javításának vagy cseréjének költségeit, valamint a szálloda által felmerült egyéb költségeket, amelyek a kár következményeként keletkeztek. A szálloda fenntartja a jogot, hogy a kártérítési igényt a felhasználó által használt hitelkártyán keresztül, vagy egyéb, jogszerű módon érvényesítse.</li>
                        <li class="tos_subitem">A felhasználónak haladéktalanul értesítenie kell a szálloda személyzetét, amennyiben kárt okoz, hogy a megfelelő intézkedések megtörténhessenek.</li>
                    </ol>
                </li>
                <li class="tos_item">A Feltételek Módosítása
                    <ol class="tos_sublist">
                        <li class="tos_subitem">A RushWave Retreat fenntartja a jogot a felhasználói feltételek módosítására. Minden módosítás a weboldalon történő közzététellel lép érvénybe.</li>
                    </ol>
                </li>
              </ol>
        </div>
    </div>
@endsection
