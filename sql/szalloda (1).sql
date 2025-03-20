-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Már 20. 11:29
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `szalloda`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `billing`
--

CREATE TABLE `billing` (
  `billing_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `bookingDate` datetime NOT NULL,
  `paymentDate` datetime NOT NULL,
  `paymentStatus` enum('pending','completed','failed','refunded') NOT NULL,
  `paymentMethod` enum('cash','credit card','debit card','paypal','bank transfer') DEFAULT NULL,
  `country` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `city` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `zipcode` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `line1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `line2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `bookStart` datetime NOT NULL,
  `bookEnd` datetime NOT NULL,
  `totalPrice` int(11) NOT NULL,
  `status` enum('confirmed','cancelled','completed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `cityName` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `description` text NOT NULL,
  `description_short` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `city`
--

INSERT INTO `city` (`city_id`, `cityName`, `country`, `description`, `description_short`) VALUES
(1, 'Oslo', 'Norvégia', '', ''),
(2, 'Malé', 'Maldív-szigetek', '', ''),
(3, 'Zermatt', 'Svájc', '', ''),
(4, 'Tokió', 'Japán', 'Tokió, Japán fővárosa, a világ egyik legizgalmasabb és legdinamikusabb metropolisza, amely a múlt és a jövő harmonikus egyesülését kínálja. A város modern felhőkarcolóival és csúcstechnológiai vívmányaival együtt számos történelmi helyszínt is magában foglal, így egyedülálló élményt biztosít minden látogató számára. A hagyományos japán kultúra szelleme, mint a templomok és szentélyek, tökéletesen megfér a modern életstílussal, ami igazán különlegessé teszi Tokiót.\n{break}\nA város közlekedési rendszere példaértékű, így a látogatók könnyedén elérhetik a különböző városrészeket és látnivalókat. A Tokiói metróhálózat és a jól kiépített vasúti rendszer lehetővé teszi, hogy a turisták könnyedén felfedezhessék a város minden szegletét, legyen szó a híres Shibuya Crossing átkelőhelyről, vagy a gazdag éjszakai életéről híres Shinjukuról. Minden sarkon új élmények várják a látogatókat, a vásárlónegyedektől kezdve a lenyűgöző éttermeken át a történelmi templomokig.\n{break}\nTokió nemcsak a látványos városi tájakkal és az izgalmas kulturális élményekkel vonzza a turistákat, hanem a gasztronómiai élményekkel is. A város étkezési kultúrája világszerte elismert, és minden étkezés egy újabb felfedezés. A japán konyha ínycsiklandó fogásai, mint a sushi, ramen vagy tempura, mindenki számára különleges élményt nyújtanak. A Michelin-csillagos éttermek és a helyi utcai étkezők egyaránt egyedülálló gasztronómiai kalandra hívják az ínyenceket.\n{break}\nA szállások terén Tokió számos lehetőséget kínál, hogy mindenki megtalálja a számára legmegfelelőbb pihenési formát. Az ötcsillagos luxus szállodáktól kezdve a középkategóriás hotelekig és a tradicionális japán stílusú ryokan szállásokig minden igényt kielégítő opciók közül választhatnak a látogatók. A szállodák magas színvonalú szolgáltatásokat, modern kényelmet és egyedülálló atmoszférát biztosítanak, hogy a vendégek valóban feltöltődve térjenek haza.\n{break}\nSzállodánk tökéletes választás, ha Tokióban szeretne pihenni, miközben felfedezi a város különleges látnivalóit és kulturális örökségét. A kényelmes szobák, a wellness-részleg és a figyelmes személyzet mind hozzájárulnak ahhoz, hogy tartózkodása valóban felejthetetlen élményt nyújtson. Akár üzleti, akár szabadidős utazásról van szó, nálunk minden adott ahhoz, hogy teljes körű kényelmet és élményt biztosítsunk a vendégeink számára.', 'Tokió, Japán pezsgő fővárosa, ahol a futurisztikus technológia és a hagyományos kultúra találkozik. A város híres látványosságairól, mint a Shibuya keresztutca, a történelmi Senso-ji templom és a zöld Odaiba-sziget. Tokió gasztronómiája világhírű, a legjobb sushi éttermektől a helyi ramen bárokig mindenki megtalálja a kedvére való ínycsiklandó fogásokat. Szállodáink kényelmes helyszínt biztosítanak a város felfedezéséhez, legyen szó üzleti útról vagy nyaralásról.');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `employee`
--

CREATE TABLE `employee` (
  `hotel_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `userType` enum('employee','manager','owner') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `employee`
--

INSERT INTO `employee` (`hotel_id`, `user_id`, `userType`) VALUES
(1, 10, 'owner');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `hotel`
--

CREATE TABLE `hotel` (
  `hotel_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `hotelName` varchar(150) NOT NULL,
  `address` text NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `hotel`
--

INSERT INTO `hotel` (`hotel_id`, `city_id`, `hotelName`, `address`, `phoneNumber`, `email`, `description`) VALUES
(1, 1, 'Frozen Retreat', 'Glacier Avenue 123, 1010', '+47 22 333 444', 'info@frozenretreat.no', 'A Frozen Retreat Hotel egy olyan különleges szálláshely, amely a hideg és a minimalista életstílus szerelmeseinek lett megálmodva. Az Oslo környékén található szálloda különleges jeges esztétikájával és egyedülálló elrendezésével igazi menedéket nyújt mindenkinek, aki szeretne egy kis pihenőt a mindennapok folyamatos forgásától, és egy hűvösebb világba menekülni.\n{break}\nA szálloda hagyományos szobák helyett iglukat biztosít a vendékegnek, amelyeket a tradicionális északi sarki igluk ihlettek. Minden szoba egyedi és kényelmesen berendezett, miközben megőrzi az igluk hagyományos, minimalista stílusát. Az igluk belső terében a jég és a hó elemeit ötvözik a meleg, kényelmes textilek és a meghitt világítás, így a vendégek egyszerre élvezhetik a téli táj varázsát és a pihentető kikapcsolódást.\n{break}\n A Frozen Retreat erős hangsúlyt fektet a jeges esztétikára, az egész szálloda külseje és belső terei egyaránt a természetes jégvilágot tükrözik, amelyet különféle művészeti alkotások, jégszobrok és világító elemek díszítenek. Az igluk belső terében is érezhető a hideg hangulat, mégis biztosítja a maximális kényelmet és melegséget a vendégek számára.\n{break}\n A szállodában különféle wellness szolgáltatások is elérhetőek, amelyek segítenek felfrissíteni a testet és a lelket természetes környezetben. Emellett a hotel környezetében számos téli sportolási lehetőség kínálkozik, mint a síelés, hószánkózás vagy éppen a hófödte tájak felfedezése.\n{break}\n A Frozen Retreat Hotel ideális választás mindazoknak, akik szeretnének egy igazán egyedi élményben részesülni, és szeretnék megtapasztalni a természetes hideg varázsát, miközben kényelmes és pihentető környezetben élvezhetik az északi táj szépségeit.'),
(2, 1, 'King\'s Castle', '456 Royal Road, 0123', '+47 22 185 423', 'reservations@kingscastle.no', 'A King\'s Castle Hotel Oslo szívében, Norvégiában található, egy autentikus és impozáns régi norvég kastély falai között. A szálloda egyedülálló módon ötvözi a történelem és a modern luxus elemeit, így vendégei egy felejthetetlen élményben részesülhetnek, miközben a kastély díszes belső terében pihenhetnek. {break} A King\'s Castle Hotel elegáns szobái a hagyományos norvég építészeti stílust tükrözik, miközben minden modern kényelmet biztosítanak a látogatók számára. Az impozáns termek, a festői kilátás és a történelmi légkör ideális helyszínt biztosítanak a pihenéshez, valamint egy különleges szállásélményt nyújtanak minden látogatónak. {break} A kastély lenyűgöző atmoszférája, a klasszikus bútorok és a finom részletek ötvözete egy mesés utazást biztosít a történelem és a luxus világában. A szálloda exkluzív éttermében a norvég gasztronómia remekeit kóstolhatják meg a vendégek, miközben a történelem egy darabja veszi körül őket. {break} A King\'s Castle Hotel nemcsak egy szálláshely, hanem egy különleges élmény, amely lehetőséget ad arra, hogy a vendégek valóban átéljék Norvégia királyi múltját, miközben élvezhetik a modern kényelem minden előnyét. Ha egy különleges, történelmi hangulatú helyen szeretne pihenni, a King\'s Castle Hotel a tökéletes választás.'),
(3, 2, 'Oceanview Hotel', '789 Coral Reef Drive 20001', '+960 333 4444', 'contact@oceanviewhotel.mv', 'Az Oceanview Hotel a Maldív-szigetek szívében, Malé városában található, és egyedülálló élményt kínál azoknak, akik szeretnék egyesíteni a luxust és a természeti csodákat. A szálloda különleges vízalatti elhelyezkedésével valóban egyedülálló élményt biztosít, hiszen nemcsak egy pihentető szállás, hanem egy igazi akvárium is egyben. {break} A vízalatti szobák és közösségi terek lehetővé teszik a vendégek számára, hogy a szálloda belsejéből szemléljék a lenyűgöző tengeri élővilágot. A kristálytiszta vízben úszó színes halak, tengeri teknősök és egyéb csodálatos vízi lények mind-mind a szobák ablakán keresztül csodálhatók meg, így a vendégek egy egészen különleges, víz alatti világban érezhetik magukat. {break} Az Oceanview Hotel nemcsak a vizuális élményről szól, hanem a pihenésről és a kikapcsolódásról is. Az exkluzív szolgáltatások, mint a víz alatti étterem, ahol a vendégek miközben a tengeri életet figyelik, élvezhetik a friss tengeri étkeket, vagy a relaxáló wellness-kezelések, mind hozzájárulnak ahhoz, hogy az itt töltött idő valóban felejthetetlen legyen. {break} A szálloda modern dizájnja és a természetes környezet harmóniájának köszönhetően az Oceanview Hotel a tökéletes választás mindazok számára, akik szeretnék egyesíteni a luxust a természet közelségével, miközben egy varázslatos tengeri világban pihenhetnek. Ha valami igazán különleges élményre vágyik, ne habozzon meglátogatni az Oceanview Hotel-t – a Maldív-szigetek egyik legkülönlegesebb szállodáját.'),
(4, 3, ' Rocky Ridge Lodge', '101 Alpine Heights 3920', '+41 27 123 4567', ' info@rockyridgelodge.ch', 'A Rocky Ridge Lodge Svájc gyönyörű Alpokjai között helyezkedik el, és egyedülálló élményt kínál mindazok számára, akik a természet közvetlen közelében szeretnének pihenni. A szálloda különlegessége, hogy nem hagyományos szobákat kínál, hanem üveg kapszulákat, amelyek közvetlenül a hegy oldalára vannak rögzítve. Ezek a kapszulák lehetővé teszik, hogy a vendégek páratlan panorámában gyönyörködjenek, miközben több száz méter magasban élvezhetik a nyugalmat és a friss alpesi levegőt. {break} A kapszulák különleges, teljesen átlátszó üvegből készültek, így minden szögből csodálhatók a lenyűgöző hegyi tájak, a hófödte csúcsok, a zöldellő völgyek és a kristálytiszta égbolt. A vendégek igazi természetközeli élményben részesülnek, miközben kényelmesen pihenhetnek, mintha a hegyek csúcsán lebegnének. {break} Minden kapszula modern dizájnnal és kényelmes felszereltséggel rendelkezik, hogy biztosítsa a maximális pihenést és komfortot. Az éjszakai égbolt alatt, a hegyekre nyíló panorámával való alvás egy igazán felejthetetlen élményt kínál. {break} A Rocky Ridge Lodge ideális választás azok számára, akik el szeretnének szakadni a hétköznapoktól, és egy igazán különleges, természetközeli pihenést keresnek. Legyen szó romantikus kikapcsolódásról vagy egy kalandos alpesi élményről, a Rocky Ridge Lodge egy varázslatos hely, ahol a hegyek nyújtotta szépség és a modern kényelem tökéletes harmóniában találkozik.'),
(5, 3, 'Locomotive Lounge', '202 Railway Station Avenue', '+41 27 765 4321', 'bookings@locomotivelounge.ch', 'A Locomotive Lounge Zermatt városában található, egy olyan különleges szálloda, amely a vasúti történelem szerelmeseinek és azoknak kínál valami igazán egyedit, akik szeretnék a múltat és a jelent ötvözni. A szálloda egy régi, már nem használt pályaudvar területén helyezkedik el, ahol a forgalomból kivont, legendás vonatok kaptak új életet hotelszobákként. {break} A Locomotive Lounge minden egyes szobája egy-egy átalakított, egykori vonat kocsi, amely még a vasúti korszak hangulatát idézi. Az autentikus vonatbelsők modern kényelmi szolgáltatásokkal lettek felszerelve, hogy a vendégek egyedülálló élményben részesülhessenek. A vonat kocsik hangulatos, nosztalgikus légkört biztosítanak, miközben minden modern igényt kielégítenek, így a vendégek valódi \"utazásra\" indulhatnak a kényelem és a történelem ötvözetében. {break} A szállodában a vendégek nemcsak a vonatok különleges atmoszféráját élvezhetik, hanem egyedi étkezési élményeket is kínál. A vasúti étterem modern ínycsiklandó fogásokat kínál, miközben a vendégek élvezhetik a pályaudvarra jellemző hangulatot. {break} A Locomotive Lounge tehát tökéletes választás mindazok számára, akik szeretnék átélni a régi idők vasúti kalandjait, miközben a modern kényelmet élvezik. Az egyedülálló történelmi háttér és a szálloda különleges dizájnja felejthetetlen élményt nyújt a látogatók számára, és egy utazás a múltba egyben a mai világ luxusával.'),
(6, 4, 'Kitty Cove', '12 Meow Street, Shibuya, 150-0001', '+81 3 1234 5678', 'hello@kittycove.jp', 'A Kitty Cove egy bájos és különleges szálloda Tokió szívében, amely a macskák szerelmeseinek kínál egy igazán egyedülálló élményt. Bár az épület kívülről egy átlagos hotelnek tűnhet, az egyedülálló jellemzője, hogy a szálloda területén számos barátságos macska él, akik a vendégek társaságában várják a közönséget. {break} A Kitty Cove különleges hangulata egyedülálló lehetőséget ad arra, hogy a látogatók ne csak pihenjenek, hanem élvezzék a macskák társaságát is. A vendégek szabadon játszhatnak, simogathatják és interakcióba léphetnek a szálloda macskáival, akik igazi kedvencek és mindig készen állnak egy kis figyelemre. {break} A szálloda további különlegessége, hogy a vendégek kérvényezhetik, hogy egy adott macska személyesen a szobájukban tartózkodjon, így még intimebb kapcsolatba kerülhetnek a kis kedvencekkel. Ez tökéletes lehetőség azok számára, akik szeretnének egy kis nyugalmat és boldogságot találni a macskák társaságában, miközben élvezhetik a szálloda kényelmét. {break} Ezek felett a Kitty Cove együttműködik egy helyi állatmenhellyel is, így amennyiben egy látogató kialakít egy különleges kapcsolatot szállodánk valamelyik macskájával, kérvényezheti annak örökbe fogadását is! {break} A Kitty Cove nemcsak egy szálloda, hanem egy igazi menedék a macskák szerelmeseinek, ahol mindenki megtalálhatja a saját kis szórakozását, pihenését és örök barátját. Legyen szó pihenésről vagy egy kis vidám szórakozásról a macskákkal, a Kitty Cove a tökéletes választás azok számára, akik egy különleges és szórakoztató szállásélményt keresnek Tokióban.'),
(7, 4, 'Cave Haven', ' 34 Stalactite Lane, Minato, 108-0073', '+81 3 8765 4321', 'info@cavehaven.jp', 'A Cave Haven egy igazán egyedülálló és különleges szálloda Japán egyik lenyűgöző barlangjában, egy már felfedezett bányában található. Ez a titokzatos szálloda azok számára kínál felejthetetlen élményt, akik szeretnék egyesíteni a természet csodáit a modern kényelemmel. A szálloda egy régi bányában került kialakításra, amely a föld mélyén rejlő varázslatos atmoszférájával varázsolja el a látogatókat. {break} A Cave Haven szobái a barlang egyes természetes formációinak figyelembevételével lettek kialakítva, így a vendégek egy olyan egyedülálló környezetben pihenhetnek, amely a természet adta szépséget ötvözi a kényelmes, modern dizájnnal. A szobák mennyezetét a barlang természetes kőzetformái díszítik, és az ambient világításnak köszönhetően igazán különleges hangulatot biztosítanak. {break} A szálloda emellett számos egyedülálló szolgáltatással rendelkezik. A vendégek élvezhetik a barlanghőmérsékletet és a hűvös levegőt, miközben a természet és a történelem különleges harmóniáját tapasztalják meg. A szálloda étterme is egyedülálló élményt kínál, ahol a helyi ételek mellett a barlang különleges atmoszféráját élvezhetik. {break} A Cave Haven ideális választás mindazok számára, akik szeretnék eltölteni az éjszakát egy természetes, ősi környezetben, miközben a modern kényelem és a bányászhagyományok varázslatos keverékét élvezhetik. Ha egy igazán különleges és mesés élményre vágyik, a Cave Haven biztosan felejthetetlen élményben részesíti.');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `loyalty`
--

CREATE TABLE `loyalty` (
  `loyalty_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rank_id` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `loyaltyrank`
--

CREATE TABLE `loyaltyrank` (
  `rank_id` int(11) NOT NULL,
  `rank` enum('bronze','silver','gold','platinum') NOT NULL,
  `discount` double(3,1) NOT NULL,
  `minPoint` int(11) NOT NULL,
  `perks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `loyaltyrank`
--

INSERT INTO `loyaltyrank` (`rank_id`, `rank`, `discount`, `minPoint`, `perks`) VALUES
(1, 'bronze', 0.0, 0, ''),
(2, 'silver', 5.0, 1000, 'ingyenes törölköző'),
(3, 'gold', 10.0, 5000, 'ingyenes törölköző, későbbi távozás'),
(4, 'platinum', 25.0, 15000, 'ingyenes törölköző, későbbi távozás, hozzáférés a platinum részlegünkhöz');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `reviewText` text DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `hotel_id`, `rating`, `reviewText`, `created_at`) VALUES
(2, 1, 2, 5, 'Nagyon faszánkos a hely', '2025-02-24 11:16:52'),
(3, 1, 3, 2, 'Bunkók a helyiek', '2025-02-24 11:55:23'),
(4, 2, 2, 4, 'Remek a hely viszont a helyi pacalpörkölt lehetne finomabb', '2025-02-24 12:11:04'),
(5, 1, 2, 1, 'SZAR', '2025-02-24 13:27:18'),
(6, 3, 4, 5, 'Én mint Miku Hatsune nagyon élveztem a helyet, rendkívül aranyosak a macskák', '2025-03-05 17:38:33'),
(7, 4, 3, 4, NULL, '2025-03-05 17:49:56'),
(8, 4, 7, 5, 'fhsdjkfhsjsdkfhsdjkfhsdjks', '2025-03-05 17:50:08'),
(9, 9, 4, 3, NULL, '2025-03-17 12:10:18');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `roomNumber` varchar(25) NOT NULL,
  `floor` tinyint(4) DEFAULT NULL,
  `capacity` tinyint(4) NOT NULL,
  `pricepernight` int(11) NOT NULL,
  `reserved` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `room`
--

INSERT INTO `room` (`room_id`, `hotel_id`, `roomNumber`, `floor`, `capacity`, `pricepernight`, `reserved`) VALUES
(1, 1, 'Alap iglu 1', NULL, 2, 40000, 0),
(2, 1, 'Alap iglu 2', NULL, 2, 45000, 0),
(3, 1, 'Deluxe iglu 1', NULL, 4, 60000, 0),
(4, 1, 'Deluxe iglu 2', NULL, 4, 65000, 0),
(5, 1, 'Deluxe iglu 3', NULL, 5, 80000, 0),
(6, 1, 'Premium iglu', NULL, 2, 60000, 0),
(7, 1, 'Családi iglu', NULL, 6, 75000, 0),
(8, 2, 'Royal Suite 1', 0, 4, 80000, 0),
(9, 2, 'Royal Suite 2', 0, 4, 80000, 0),
(10, 2, 'Royal Suite 3', 0, 4, 80000, 0),
(11, 2, 'Királyi kamra 1', 0, 2, 70000, 0),
(12, 2, 'Királyi kamra 2', 1, 2, 70000, 0),
(13, 2, 'Királyi kamra 3', 1, 2, 70000, 0),
(14, 2, 'Kiránynő szobája 1', 1, 2, 65000, 0),
(15, 2, 'Kiránynő szobája 2', 1, 2, 65000, 0),
(16, 2, 'Kiránynő szobája 3', 2, 2, 65000, 0),
(17, 2, 'Deluxe szoba 1', 2, 3, 75000, 0),
(18, 2, 'Deluxe szoba 2', 2, 3, 75000, 0),
(19, 2, 'Deluxe szoba 3', 2, 3, 75000, 0),
(20, 2, 'Lovagi szállás 1', 3, 4, 85000, 0),
(21, 2, 'Lovagi szállás 2', 3, 4, 85000, 0),
(22, 2, 'Lovagi szállás 3', 3, 4, 85000, 0),
(23, 3, '101', -1, 2, 120000, 0),
(24, 3, '102A', -1, 2, 125000, 0),
(25, 3, '102B', -1, 2, 130000, 0),
(26, 3, '201A', -2, 2, 130000, 0),
(27, 3, '201B', -2, 2, 135000, 0),
(28, 3, '201C', -2, 2, 140000, 0),
(29, 3, '202', -2, 2, 140000, 0),
(30, 3, '301', -3, 2, 145000, 0),
(31, 3, '302', -3, 2, 150000, 0),
(32, 3, '303A', -3, 4, 150000, 0),
(33, 3, '304B', -3, 4, 155000, 0),
(34, 3, '401', -4, 4, 160000, 0),
(35, 3, '402', -4, 4, 160000, 0),
(36, 3, '403A', -4, 4, 165000, 0),
(37, 3, '404B', -4, 4, 170000, 0),
(38, 4, '1. számú kabin', NULL, 2, 75000, 0),
(39, 4, '2. számú kabin', NULL, 2, 80000, 0),
(40, 4, '3. számú kabin', NULL, 3, 90000, 0),
(41, 4, '4. számú kabin', NULL, 3, 95000, 0),
(42, 4, '5. számú kabin', NULL, 4, 105000, 0),
(43, 4, '6. számú kabin', NULL, 4, 110000, 0),
(44, 4, '7. számú kabin', NULL, 2, 75000, 0),
(45, 4, '8. számú kabin', NULL, 2, 80000, 0),
(46, 4, '9. számú kabin', NULL, 3, 85000, 0),
(47, 4, '10. számú kabin', NULL, 4, 100000, 0),
(48, 5, '1. számú kabin', 1, 2, 60000, 0),
(49, 5, '2. számú kabin', 1, 2, 65000, 0),
(50, 5, '3. számú kabin', 1, 3, 70000, 0),
(51, 5, '4. számú kabin', 1, 2, 67000, 0),
(52, 5, '5. számú kabin', 2, 3, 75000, 0),
(53, 5, '6. számú kabin', 2, 4, 80000, 0),
(54, 5, '7. számú kabin', 2, 2, 69000, 0),
(55, 5, '8. számú kabin', 2, 2, 73000, 0),
(56, 5, '9. számú kabin', 3, 3, 80000, 0),
(57, 5, '10. számú kabin', 3, 4, 85000, 0),
(58, 5, '11. számú kabin', 3, 2, 72000, 0),
(59, 5, '12. számú kabin', 3, 3, 77000, 0),
(60, 5, '13. számú kabin', 4, 2, 70000, 0),
(61, 5, '14. számú kabin', 4, 3, 75000, 0),
(62, 5, '15. számú kabin', 4, 4, 85000, 0),
(63, 5, '16. számú kabin', 4, 2, 70000, 0),
(64, 6, '101. szoba', 1, 4, 65000, 0),
(65, 6, '102. szoba', 1, 2, 40000, 0),
(66, 6, '103. szoba', 1, 1, 25000, 0),
(67, 6, '104A. szoba', 1, 3, 45000, 0),
(68, 6, '104B. szoba', 1, 3, 47500, 0),
(69, 6, '201. szoba', 2, 1, 28000, 0),
(70, 6, '202. szoba', 2, 4, 60000, 0),
(71, 6, '203. szoba', 2, 3, 48650, 0),
(72, 6, '204. szoba', 2, 4, 63000, 0),
(73, 6, '205. szoba', 2, 2, 38000, 0),
(74, 6, '301. szoba', 3, 1, 25730, 0),
(75, 6, '302. szoba', 3, 2, 40000, 0),
(76, 6, '303. szoba', 3, 4, 70000, 0),
(77, 6, '304A. szoba', 3, 2, 33000, 0),
(78, 6, '304B. szoba', 3, 4, 62000, 0),
(79, 6, '305. szoba', 3, 6, 115000, 0),
(80, 7, 'Kőszivárvány Szoba 1', 1, 2, 40000, 0),
(81, 7, 'Kőszivárvány Szoba 2', 1, 2, 42000, 0),
(82, 7, 'Barlangi Kényelem 1', 2, 2, 45000, 0),
(83, 7, 'Barlangi Kényelem 2', 2, 2, 45000, 0),
(84, 7, 'Mélységi Nyugalom 1', 3, 2, 48000, 0),
(85, 7, 'Mélységi Nyugalom 2', 3, 2, 48000, 0),
(86, 7, 'Földi Harmónia 1', 1, 2, 40000, 0),
(87, 7, 'Földi Harmónia 2', 1, 2, 42000, 0),
(88, 7, 'Bányász Panoráma 1', 2, 2, 47000, 0),
(89, 7, 'Bányász Panoráma 2', 2, 2, 47000, 0),
(90, 7, 'Ősi Barlang 1', 3, 2, 50000, 0),
(91, 7, 'Ősi Barlang 2', 3, 2, 50000, 0),
(92, 7, 'Kőszikla Lak 1', 1, 3, 55000, 0),
(93, 7, 'Kőszikla Lak 2', 1, 3, 55000, 0),
(94, 7, 'Csendes Mély', 2, 2, 43000, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `service`
--

CREATE TABLE `service` (
  `service_id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `available` tinyint(1) DEFAULT 1,
  `allYear` tinyint(1) NOT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `openTime` time DEFAULT NULL,
  `closeTime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `service`
--

INSERT INTO `service` (`service_id`, `hotel_id`, `category_id`, `price`, `available`, `allYear`, `startDate`, `endDate`, `openTime`, `closeTime`) VALUES
(1, 6, 1, 15000, 1, 1, NULL, NULL, NULL, NULL),
(2, 6, 2, 25000, 1, 1, NULL, NULL, NULL, NULL),
(3, 6, 6, 5000, 1, 1, NULL, NULL, '07:00:00', '21:00:00'),
(4, 6, 8, 7500, 1, 1, NULL, NULL, '10:00:00', '20:00:00'),
(5, 6, 9, 8000, 1, 1, NULL, NULL, '07:30:00', '20:00:00'),
(6, 6, 11, 10000, 1, 1, NULL, NULL, NULL, NULL),
(7, 1, 1, 13500, 1, 1, NULL, NULL, NULL, NULL),
(8, 1, 2, 20000, 1, 1, NULL, NULL, NULL, NULL),
(9, 1, 9, 8000, 1, 1, NULL, NULL, NULL, NULL),
(10, 1, 13, 10000, 1, 0, NULL, NULL, NULL, NULL),
(11, 1, 14, 7500, 1, 1, NULL, NULL, NULL, NULL),
(12, 1, 15, 12500, 1, 1, NULL, NULL, NULL, NULL),
(13, 1, 17, 8000, 1, 1, NULL, NULL, NULL, NULL),
(14, 2, 1, 16000, 1, 1, NULL, NULL, NULL, NULL),
(15, 2, 2, 24000, 1, 1, NULL, NULL, NULL, NULL),
(16, 2, 3, 2500, 1, 1, NULL, NULL, NULL, NULL),
(17, 2, 4, 7000, 1, 0, NULL, NULL, NULL, NULL),
(18, 2, 7, 4000, 1, 1, NULL, NULL, NULL, NULL),
(19, 2, 16, 8750, 1, 1, NULL, NULL, NULL, NULL),
(20, 2, 17, 10000, 1, 1, NULL, NULL, NULL, NULL),
(21, 3, 1, 15000, 1, 1, NULL, NULL, NULL, NULL),
(22, 3, 2, 24750, 1, 1, NULL, NULL, NULL, NULL),
(23, 3, 3, 4500, 1, 1, NULL, NULL, NULL, NULL),
(24, 3, 4, 5000, 1, 1, NULL, NULL, NULL, NULL),
(25, 3, 5, 4500, 1, 1, NULL, NULL, NULL, NULL),
(26, 3, 7, 4000, 1, 1, NULL, NULL, NULL, NULL),
(27, 3, 10, 8000, 1, 1, NULL, NULL, NULL, NULL),
(28, 3, 18, 17500, 1, 0, NULL, NULL, NULL, NULL),
(29, 4, 1, 20000, 1, 1, NULL, NULL, NULL, NULL),
(30, 4, 2, 27500, 1, 1, NULL, NULL, NULL, NULL),
(31, 4, 19, 22000, 1, 1, NULL, NULL, NULL, NULL),
(32, 4, 20, 17500, 1, 0, NULL, NULL, NULL, NULL),
(33, 5, 1, 12000, 1, 1, NULL, NULL, NULL, NULL),
(34, 5, 2, 19000, 1, 1, NULL, NULL, NULL, NULL),
(35, 5, 5, 4000, 1, 1, NULL, NULL, NULL, NULL),
(36, 5, 7, 2500, 1, 1, NULL, NULL, NULL, NULL),
(37, 5, 21, 8500, 1, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `servicecategory`
--

CREATE TABLE `servicecategory` (
  `serviceCategory_id` int(11) NOT NULL,
  `serviceName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `servicecategory`
--

INSERT INTO `servicecategory` (`serviceCategory_id`, `serviceName`) VALUES
(1, 'Teljes ellátás'),
(2, 'Félpanzió'),
(3, 'Köntös igénylés'),
(4, 'Medence'),
(5, 'Bár hozzáférés'),
(6, 'Szoba szervíz'),
(7, 'Játékterem hozzáférés'),
(8, 'Szauna'),
(9, 'Thai masszázs'),
(10, 'Háziállat barát'),
(11, 'Szobamacska'),
(12, 'Várostúra részvétel'),
(13, 'Fóka simogatás'),
(14, 'Ice Bar'),
(15, 'Sífelszerelés biztosítás'),
(16, 'Királyi vacsora'),
(17, 'Jegy előadásra'),
(18, 'Búvárkodás'),
(19, 'Hegyi túra'),
(20, 'Drótkötélpálya'),
(21, 'Vezetőfülke túra'),
(22, 'Bánya túra'),
(23, 'Érc bemutató');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `birthDate` date NOT NULL,
  `phonenumber` varchar(15) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `active` tinyint(1) DEFAULT 1,
  `profilePic` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`user_id`, `username`, `lastName`, `firstName`, `birthDate`, `phonenumber`, `email`, `password`, `created_at`, `updated_at`, `active`, `profilePic`) VALUES
(1, 'Misike28', 'Kovács', 'Mihály Dániel', '2024-05-17', '+36709477699', 'Szekelymegafia@freemail.com', '$2y$12$U.6/gsWyUXQkxD2TSibXne5OqQ1lPVKJ2oYu5FXgX6KeA89td3ffy', '2025-02-24 09:55:37', '2025-03-05 15:52:24', 1, 1),
(2, 'Gyuszi', 'Molnár', 'Gyula Dániel', '1982-06-17', '+36307675240', 'gyula_molnar@hotmail.com', '$2y$12$ldDrheSUdRZMXSEi.hJ.3.qb/76.OZ70ON8zHgBSoRmEglh9RHLHK', '2025-02-24 11:10:34', '2025-02-24 11:19:42', 1, 0),
(3, 'Mikudayoo', 'Hatsune', 'Miku', '2007-08-31', '+36701234567', 'hatsunemiku@vocaloid.com', '$2y$12$LQyV6fWT83nezYRP53EPDO6aiXmFzA0zHj6uYFzzs/rWWb1BwJrdW', '2025-03-05 16:37:16', '2025-03-05 16:37:52', 1, 2),
(4, 'Ila68', 'Kiss', 'Ilona', '2015-10-30', '+36205126141', 'jarfasila68@hotmail.com', '$2y$12$.qAyWsqzqtHgSY47KmxP8umE9/8dQm/jrlXpDxG1FfJdXdPlCU5dm', '2025-03-05 16:48:31', '2025-03-05 16:52:06', 0, 1),
(5, 'Vajdani', 'Vajda', 'Dániel', '2006-05-19', '+36201111111', 'vajda.daniel@valami.com', '$2y$12$Rm8jQoZqrkUJBcx40wD80.y5FNaOYD0eO/GfBWKBZiIOWNq77uhpG', '2025-03-05 16:53:08', '2025-03-05 16:53:08', 1, 0),
(9, 'horvathAti', 'Dr.', 'Horváth Attila', '1980-04-01', '+36307672240', 'horvath.attila@verebelyszki.hu', '$2y$12$aZDS/wu./xR5FRm9.OC52uYh8AMN4ANxPG4WK72SwSiv0E.1kzZPO', '2025-03-17 11:05:58', '2025-03-17 11:13:15', 1, 1),
(10, 'Boss', 'Lakatos', 'István', '1969-08-06', '+36201111112', 'boss@gmail.com', '$2y$12$ChUtVpaPJbIrYSD9qIDw8eXDyqvkB60I7CQxSdqqrSVsfGfaaE1v.', '2025-03-20 09:02:09', '2025-03-20 09:02:09', 1, 0);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`billing_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- A tábla indexei `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`,`room_id`),
  ADD KEY `room_id` (`room_id`);

--
-- A tábla indexei `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- A tábla indexei `employee`
--
ALTER TABLE `employee`
  ADD KEY `hotel_id` (`hotel_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`hotel_id`),
  ADD KEY `city_id` (`city_id`) USING BTREE;

--
-- A tábla indexei `loyalty`
--
ALTER TABLE `loyalty`
  ADD PRIMARY KEY (`loyalty_id`),
  ADD KEY `rank_id` (`rank_id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `loyaltyrank`
--
ALTER TABLE `loyaltyrank`
  ADD PRIMARY KEY (`rank_id`);

--
-- A tábla indexei `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`,`hotel_id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- A tábla indexei `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- A tábla indexei `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `hotel_id` (`hotel_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- A tábla indexei `servicecategory`
--
ALTER TABLE `servicecategory`
  ADD PRIMARY KEY (`serviceCategory_id`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `phonenumber` (`phonenumber`),
  ADD UNIQUE KEY `email` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `billing`
--
ALTER TABLE `billing`
  MODIFY `billing_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `hotel`
--
ALTER TABLE `hotel`
  MODIFY `hotel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT a táblához `loyalty`
--
ALTER TABLE `loyalty`
  MODIFY `loyalty_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `loyaltyrank`
--
ALTER TABLE `loyaltyrank`
  MODIFY `rank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT a táblához `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT a táblához `servicecategory`
--
ALTER TABLE `servicecategory`
  MODIFY `serviceCategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `billing`
--
ALTER TABLE `billing`
  ADD CONSTRAINT `billing_ibfk_1` FOREIGN KEY (`billing_id`) REFERENCES `booking` (`booking_id`);

--
-- Megkötések a táblához `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`);

--
-- Megkötések a táblához `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`);

--
-- Megkötések a táblához `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `hotel_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`);

--
-- Megkötések a táblához `loyalty`
--
ALTER TABLE `loyalty`
  ADD CONSTRAINT `loyalty_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `loyalty_ibfk_2` FOREIGN KEY (`rank_id`) REFERENCES `loyaltyrank` (`rank_id`);

--
-- Megkötések a táblához `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`);

--
-- Megkötések a táblához `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`);

--
-- Megkötések a táblához `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `servicecategory` (`serviceCategory_id`),
  ADD CONSTRAINT `service_ibfk_2` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
