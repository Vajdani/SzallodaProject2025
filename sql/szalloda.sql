-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Már 14. 14:59
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
(4, 'Tokió', 'Japán', 'Tokió, Japán dinamikus fővárosa, egy lenyűgöző metropolisz, ahol a futurisztikus technológia, a hagyományos kultúra és a különleges gasztronómia tökéletes harmóniában élnek egymás mellett. A város élénk nyüzsgése, lenyűgöző látványosságai és gazdag történelme minden látogatót elvarázsol. {break}Fedezd fel Tokió számos ikonikus helyszínét, mint a híres Shibuya keresztutca, a csillogó felhőkarcolók és a nyüzsgő bevásárlónegyedek. Ne hagyd ki a történelmi Asakusa negyedet, ahol a Senso-ji templom ősi varázsa és a hagyományos piacok nyújtanak betekintést Japán gazdag kultúrájába. A csendes és zöld Odaiba-sziget a modern építészet és a lenyűgöző kilátások kedvelőinek kedvelt helyszíne. {break} Tokió egy igazi gasztronómiai paradicsom, ahol a világ legfinomabb sushi éttermeitől kezdve a helyi ramen bárokig mindenki megtalálhatja az ínycsiklandó élményeket. A város híres a legmagasabb szintű Michelin-csillagos éttermekről, de a kis helyi étkezde hangulata is felejthetetlen. {break} Szállodáink Tokió szívében várják, hogy kényelmes és elegáns környezetben pihenj, miközben könnyedén felfedezheted a város legjobb látnivalóit. Akár üzleti úton vagy nyaraláson jársz, Tokió biztosan felejthetetlen élményeket kínál.', 'Tokió, Japán pezsgő fővárosa, ahol a futurisztikus technológia és a hagyományos kultúra találkozik. A város híres látványosságairól, mint a Shibuya keresztutca, a történelmi Senso-ji templom és a zöld Odaiba-sziget. Tokió gasztronómiája világhírű, a legjobb sushi éttermektől a helyi ramen bárokig mindenki megtalálja a kedvére való ínycsiklandó fogásokat. Szállodáink kényelmes helyszínt biztosítanak a város felfedezéséhez, legyen szó üzleti útról vagy nyaralásról.');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `employee`
--

CREATE TABLE `employee` (
  `hotel_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `userType` enum('employee','manager','owner') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 1, 'Frozen Retreat', 'Glacier Avenue 123, 1010', '+47 22 333 444', 'info@frozenretreat.no', 'A Frozen Retreat Hotel egy olyan különleges szálláshely, amely a hideg és a minimalista életstílus szerelmeseinek lett megálmodva. Az Oslo környékén található szálloda különleges jeges esztétikájával és egyedülálló elrendezésével igazi menedéket nyújt mindenkinek, aki szeretne egy kis pihenőt a mindennapok folyamatos forgásától, és egy hűvösebb világba menekülni. {break} A szálloda szobái hagyományos iglukban, azaz sarki menedékekben találhatóak, amelyeket teljes mértékben az északi hideg ihletett. Minden szoba egyedi és kényelmesen berendezett, miközben megőrzi az igluak hagyományos, minimalista stílusát. Az igluk belső terében a jég és a hó elemeit ötvözik a meleg, kényelmes textíliák és a meghitt világítás, így a vendégek egyszerre élvezhetik a téli táj varázsát és a pihentető kikapcsolódást. {break} A Frozen Retreat erős hangsúlyt fektet a jeges esztétikára: az egész szálloda külseje és belső terei egyaránt a természetes jégvilágot tükrözik, amelyet különféle művészeti alkotások, jégszobrok és világító elemek díszítenek. Az igluk belső térben is érezhető a hideg hangulat, mégis biztosítja a maximális kényelmet és melegséget a vendégek számára. {break} A szállodában különféle wellness szolgáltatások is elérhetőek, amelyek segítenek felfrissíteni a testet és a lelket a kemikáliáktól mentes, természetes környezetben. Emellett a hotel környezetében számos téli sportolási lehetőség kínálkozik, mint a síelés, hószánkózás vagy éppen a hófödte tájak felfedezése. {break} A Frozen Retreat Hotel ideális választás mindazoknak, akik szeretnének egy igazán egyedi élményben részesülni, és szeretnék megtapasztalni a természetes hideg varázsát, miközben kényelmes és pihentető környezetben élvezhetik az északi táj szépségeit.'),
(2, 1, 'King\'s Castle', '456 Royal Road, 0123', '+47 22 185 423', 'reservations@kingscastle.no', ''),
(3, 2, 'Oceanview Hotel', '789 Coral Reef Drive 20001', '+960 333 4444', 'contact@oceanviewhotel.mv', ''),
(4, 3, ' Rocky Ridge Lodge', '101 Alpine Heights 3920', '+41 27 123 4567', ' info@rockyridgelodge.ch', ''),
(5, 3, 'Locomotive Lounge', '202 Railway Station Avenue', '+41 27 765 4321', 'bookings@locomotivelounge.ch', ''),
(6, 4, 'Kitty Cove', '12 Meow Street, Shibuya, 150-0001', '+81 3 1234 5678', 'hello@kittycove.jp', ''),
(7, 4, 'Cave Haven', ' 34 Stalactite Lane, Minato, 108-0073', '+81 3 8765 4321', 'info@cavehaven.jp', '');

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
(8, 4, 7, 5, 'fhsdjkfhsjsdkfhsdjkfhsdjks', '2025-03-05 17:50:08');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `roomNumber` varchar(15) NOT NULL,
  `floor` tinyint(4) NOT NULL,
  `capacity` tinyint(4) NOT NULL,
  `pricepernight` int(11) NOT NULL,
  `reserved` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `room`
--

INSERT INTO `room` (`room_id`, `hotel_id`, `roomNumber`, `floor`, `capacity`, `pricepernight`, `reserved`) VALUES
(1, 6, '101', 1, 4, 65000, 0),
(2, 6, '102', 1, 2, 40000, 0),
(3, 6, '103', 1, 1, 25000, 0),
(4, 6, '104A', 1, 3, 45000, 0),
(5, 6, '104B', 1, 3, 47500, 0),
(6, 6, '201', 2, 1, 28000, 0),
(7, 6, '202', 2, 4, 60000, 0),
(8, 6, '203', 2, 3, 48650, 0),
(9, 6, '204', 2, 4, 63000, 0),
(10, 6, '205', 2, 2, 38000, 0),
(11, 6, '301', 3, 1, 25730, 0),
(12, 6, '302', 3, 2, 40000, 0),
(13, 6, '303', 3, 4, 70000, 0),
(14, 6, '304A', 3, 2, 33000, 0),
(15, 6, '304B', 3, 4, 62000, 0),
(16, 6, '305', 3, 6, 115000, 0);

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
(3, 6, 6, 5000, 1, 1, NULL, NULL, NULL, NULL),
(4, 6, 8, 7500, 1, 1, NULL, NULL, NULL, NULL),
(5, 6, 9, 8000, 1, 1, NULL, NULL, NULL, NULL),
(6, 6, 11, 10000, 1, 1, NULL, NULL, NULL, NULL);

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
(12, 'Várostúra részvétel');

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
  `userType` enum('guest','employee','manager','owner') DEFAULT 'guest',
  `active` tinyint(1) DEFAULT 1,
  `profilePic` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`user_id`, `username`, `lastName`, `firstName`, `birthDate`, `phonenumber`, `email`, `password`, `created_at`, `updated_at`, `userType`, `active`, `profilePic`) VALUES
(1, 'Misike28', 'Kovács', 'Mihály Dániel', '2024-05-17', '+36709477699', 'Szekelymegafia@freemail.com', '$2y$12$U.6/gsWyUXQkxD2TSibXne5OqQ1lPVKJ2oYu5FXgX6KeA89td3ffy', '2025-02-24 09:55:37', '2025-03-05 15:52:24', 'guest', 1, 1),
(2, 'Gyuszi', 'Molnár', 'Gyula Dániel', '1982-06-17', '+36307675240', 'gyula_molnar@hotmail.com', '$2y$12$ldDrheSUdRZMXSEi.hJ.3.qb/76.OZ70ON8zHgBSoRmEglh9RHLHK', '2025-02-24 11:10:34', '2025-02-24 11:19:42', 'guest', 1, 0),
(3, 'Mikudayoo', 'Hatsune', 'Miku', '2007-08-31', '+36701234567', 'hatsunemiku@vocaloid.com', '$2y$12$LQyV6fWT83nezYRP53EPDO6aiXmFzA0zHj6uYFzzs/rWWb1BwJrdW', '2025-03-05 16:37:16', '2025-03-05 16:37:52', 'guest', 1, 2),
(4, 'Ila68', 'Kiss', 'Ilona', '2015-10-30', '+36205126141', 'jarfasila68@hotmail.com', '$2y$12$.qAyWsqzqtHgSY47KmxP8umE9/8dQm/jrlXpDxG1FfJdXdPlCU5dm', '2025-03-05 16:48:31', '2025-03-05 16:52:06', 'guest', 0, 1),
(5, 'Vajdani', 'Vajda', 'Dániel', '2006-05-19', '+36201111111', 'vajda.daniel@valami.com', '$2y$12$Rm8jQoZqrkUJBcx40wD80.y5FNaOYD0eO/GfBWKBZiIOWNq77uhpG', '2025-03-05 16:53:08', '2025-03-05 16:53:08', 'guest', 1, 0);

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
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT a táblához `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `servicecategory`
--
ALTER TABLE `servicecategory`
  MODIFY `serviceCategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
