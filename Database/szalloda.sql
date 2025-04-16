-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2025 at 07:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `szalloda`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing`
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

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`billing_id`, `booking_id`, `amount`, `bookingDate`, `paymentDate`, `paymentStatus`, `paymentMethod`, `country`, `city`, `zipcode`, `line1`, `line2`) VALUES
(1, 7, 143500, '2025-03-31 11:23:20', '2025-03-31 11:23:20', 'pending', 'debit card', 'Magyarország', 'Budapest', '1056', 'váci utca 6', '6/8/3'),
(2, 8, 310500, '2025-03-31 11:51:37', '0000-00-00 00:00:00', 'pending', 'cash', 'Magyarország', 'Budapest', '1056', 'váci utca 6', '6/8/3'),
(3, 9, 723000, '2025-03-31 11:53:03', '2025-03-31 11:53:03', 'pending', 'credit card', 'Magyarország', 'Budapest', '1056', 'váci utca 6', '6/8/3'),
(4, 10, 195000, '2025-03-31 12:02:39', '0000-00-00 00:00:00', 'pending', 'cash', 'Magyarország', 'Budapest', '1056', 'váci utca 6', '6/8/3');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `bookStart` date NOT NULL,
  `bookEnd` date NOT NULL,
  `totalPrice` int(11) NOT NULL,
  `status` enum('confirmed','cancelled','completed','refund requested') NOT NULL,
  `services` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `user_id`, `room_id`, `bookStart`, `bookEnd`, `totalPrice`, `status`, `services`) VALUES
(1, 2, 4, '2025-03-12', '2025-03-15', 260000, 'confirmed', ''),
(2, 3, 2, '2025-03-14', '2025-03-18', 80000, 'confirmed', ''),
(3, 5, 7, '2025-03-08', '2025-03-13', 300000, 'completed', ''),
(4, 2, 5, '2025-08-13', '2025-08-16', 298500, 'confirmed', '1-3-4'),
(5, 2, 12, '2025-04-02', '2025-04-06', 359750, 'completed', '8-11-13'),
(6, 2, 68, '2025-03-06', '2025-03-09', 232500, 'cancelled', '33-34-37'),
(7, 2, 80, '2025-03-31', '2025-04-02', 143500, 'confirmed', '39-40-41-42'),
(8, 2, 7, '2025-08-02', '2025-08-05', 310500, 'refund requested', '2-3-4-5'),
(9, 2, 1, '2025-03-31', '2025-04-13', 723000, 'confirmed', '2-3'),
(10, 25, 64, '2025-04-01', '2025-04-04', 195000, 'completed', ''),
(11, 2, 4, '2023-03-12', '2023-03-15', 260000, 'completed', ''),
(12, 3, 2, '2023-03-14', '2023-03-18', 80000, 'completed', ''),
(13, 5, 7, '2024-03-08', '2024-03-13', 300000, 'completed', ''),
(14, 2, 5, '2024-08-13', '2024-08-16', 298500, 'completed', '1-3-4'),
(15, 2, 12, '2022-04-02', '2022-04-06', 359750, 'completed', '8-11-13'),
(16, 2, 68, '2023-03-06', '2023-03-09', 232500, 'cancelled', '33-34-37'),
(17, 2, 80, '2024-03-31', '2024-04-02', 143500, 'completed', '39-40-41-42'),
(18, 2, 7, '2024-08-02', '2024-08-05', 310500, 'completed', '2-3-4-5'),
(19, 2, 1, '2023-03-31', '2023-04-13', 723000, 'completed', '2-3'),
(20, 25, 64, '2022-04-01', '2022-04-04', 195000, 'completed', ''),
(21, 12, 4, '2023-05-14', '2023-05-17', 255000, 'completed', '1-4'),
(22, 18, 15, '2022-06-10', '2022-06-14', 320000, 'completed', '9-10'),
(23, 5, 28, '2024-09-01', '2024-09-05', 360000, 'completed', '16-18'),
(24, 30, 42, '2025-04-12', '2025-04-15', 210000, 'cancelled', '23-24'),
(25, 7, 85, '2022-11-08', '2022-11-11', 225000, 'completed', '40-41'),
(26, 14, 6, '2023-02-02', '2023-02-06', 280000, 'completed', '3-5'),
(27, 11, 18, '2024-12-01', '2024-12-05', 345000, 'completed', '12-13'),
(28, 2, 35, '2022-08-20', '2022-08-24', 295000, 'cancelled', '20-22'),
(29, 33, 40, '2023-07-15', '2023-07-18', 270000, 'completed', '25-26'),
(30, 4, 53, '2024-04-05', '2024-04-08', 225000, 'completed', '28-30'),
(31, 21, 64, '2022-05-01', '2022-05-06', 395000, 'completed', '33-34'),
(32, 26, 90, '2025-07-07', '2025-07-10', 285000, 'refund requested', '42-43'),
(33, 8, 7, '2023-09-09', '2023-09-12', 240000, 'completed', '2-6'),
(34, 22, 10, '2024-03-18', '2024-03-21', 210000, 'completed', '8-11'),
(35, 6, 25, '2022-10-10', '2022-10-13', 255000, 'completed', '15-16'),
(36, 13, 44, '2023-06-06', '2023-06-11', 385000, 'cancelled', '24-25'),
(37, 10, 50, '2025-03-02', '2025-03-07', 395000, 'confirmed', '30-31'),
(38, 35, 66, '2022-04-01', '2022-04-05', 320000, 'completed', '34-36'),
(39, 3, 84, '2023-10-21', '2023-10-24', 255000, 'completed', '40-43'),
(40, 28, 1, '2022-12-12', '2022-12-15', 225000, 'completed', '2-3'),
(41, 17, 20, '2023-01-05', '2023-01-09', 280000, 'completed', '13-14'),
(42, 20, 32, '2025-10-15', '2025-10-20', 420000, 'refund requested', '18-20'),
(43, 19, 38, '2024-07-11', '2024-07-15', 345000, 'completed', '23-26'),
(44, 31, 58, '2023-08-03', '2023-08-07', 290000, 'cancelled', '29-30'),
(45, 15, 71, '2022-09-14', '2022-09-18', 310000, 'completed', '34-35'),
(46, 9, 89, '2025-01-25', '2025-01-29', 340000, 'confirmed', '40-42'),
(47, 16, 5, '2024-10-10', '2024-10-12', 180000, 'completed', '4-5'),
(48, 25, 12, '2022-06-04', '2022-06-08', 260000, 'cancelled', '8-9'),
(49, 24, 23, '2023-03-15', '2023-03-19', 290000, 'completed', '15-17'),
(50, 18, 47, '2025-06-11', '2025-06-14', 255000, 'completed', '25-26'),
(51, 1, 56, '2024-01-20', '2024-01-24', 310000, 'completed', '28-31'),
(52, 29, 68, '2023-05-02', '2023-05-05', 240000, 'refund requested', '34-36'),
(53, 7, 83, '2022-07-18', '2022-07-21', 255000, 'completed', '39-40'),
(54, 23, 2, '2025-09-22', '2025-09-27', 400000, 'completed', '1-2'),
(55, 14, 19, '2023-04-11', '2023-04-14', 225000, 'cancelled', '13-14'),
(56, 27, 26, '2022-11-05', '2022-11-10', 365000, 'completed', '17-18'),
(57, 11, 41, '2025-02-14', '2025-02-18', 310000, 'completed', '23-24'),
(58, 19, 48, '2024-03-08', '2024-03-11', 240000, 'completed', '27-29'),
(59, 20, 62, '2022-10-20', '2022-10-24', 310000, 'cancelled', '30-31'),
(60, 3, 77, '2023-06-17', '2023-06-20', 240000, 'completed', '35-37'),
(61, 6, 91, '2025-12-01', '2025-12-05', 345000, 'completed', '41-43'),
(62, 8, 3, '2022-05-15', '2022-05-17', 165000, 'completed', '1-3'),
(63, 26, 11, '2023-09-05', '2023-09-08', 210000, 'refund requested', '9-13'),
(64, 34, 36, '2024-02-22', '2024-02-25', 225000, 'completed', '21-22'),
(65, 10, 39, '2025-11-11', '2025-11-16', 395000, 'confirmed', '25-26'),
(66, 32, 52, '2023-08-12', '2023-08-15', 255000, 'completed', '28-30'),
(67, 13, 65, '2024-09-01', '2024-09-04', 255000, 'cancelled', '33-35'),
(68, 2, 87, '2022-06-28', '2022-07-03', 410000, 'completed', '39-42'),
(69, 12, 8, '2023-01-18', '2023-01-21', 225000, 'completed', '6-7'),
(70, 5, 17, '2025-08-07', '2025-08-12', 390000, 'confirmed', '10-13'),
(71, 15, 22, '2022-03-03', '2022-03-06', 210000, 'completed', '13-14'),
(72, 17, 30, '2023-11-09', '2023-11-14', 385000, 'completed', '17-19'),
(73, 30, 46, '2025-10-01', '2025-10-05', 330000, 'cancelled', '25-26'),
(74, 28, 59, '2024-06-17', '2024-06-20', 270000, 'completed', '29-31'),
(75, 6, 69, '2023-04-25', '2023-04-29', 320000, 'completed', '34-36'),
(76, 24, 92, '2022-08-08', '2022-08-11', 255000, 'completed', '42-43'),
(77, 4, 6, '2023-05-06', '2023-05-09', 225000, 'completed', '2-5'),
(78, 35, 13, '2024-02-14', '2024-02-19', 345000, 'completed', '8-11'),
(79, 9, 27, '2025-09-12', '2025-09-15', 255000, 'refund requested', '15-18'),
(80, 7, 43, '2022-07-21', '2022-07-24', 240000, 'completed', '23-24'),
(81, 23, 49, '2023-03-28', '2023-04-01', 310000, 'completed', '27-30'),
(82, 1, 61, '2024-12-22', '2024-12-26', 360000, 'cancelled', '30-31'),
(83, 12, 76, '2022-09-17', '2022-09-20', 255000, 'completed', '35-36'),
(84, 20, 93, '2025-02-03', '2025-02-07', 345000, 'completed', '41-43'),
(85, 10, 1, '2022-11-02', '2022-11-05', 210000, 'completed', '2-4'),
(86, 29, 16, '2023-06-01', '2023-06-04', 240000, 'cancelled', '10-12'),
(87, 13, 24, '2024-05-13', '2024-05-17', 325000, 'completed', '15-17'),
(88, 8, 37, '2025-03-05', '2025-03-09', 290000, 'confirmed', '20-21'),
(89, 27, 45, '2022-12-18', '2022-12-22', 320000, 'completed', '25-26'),
(90, 22, 55, '2023-07-26', '2023-07-29', 270000, 'refund requested', '29-31'),
(91, 16, 67, '2024-01-02', '2024-01-06', 310000, 'completed', '33-34'),
(92, 31, 82, '2022-10-15', '2022-10-19', 340000, 'completed', '38-41'),
(93, 5, 9, '2023-02-11', '2023-02-14', 210000, 'completed', '5-7'),
(94, 11, 14, '2024-03-25', '2024-03-28', 240000, 'cancelled', '9-10'),
(95, 18, 29, '2025-06-06', '2025-06-11', 375000, 'confirmed', '16-19'),
(96, 14, 34, '2022-04-19', '2022-04-22', 225000, 'completed', '20-21'),
(97, 19, 51, '2023-05-03', '2023-05-07', 310000, 'completed', '27-28'),
(98, 26, 60, '2025-11-06', '2025-11-09', 255000, 'cancelled', '30-31'),
(99, 33, 70, '2024-08-11', '2024-08-16', 400000, 'completed', '34-36'),
(100, 21, 88, '2023-01-28', '2023-02-01', 300000, 'completed', '40-43'),
(101, 6, 5, '2022-07-01', '2022-07-05', 280000, 'completed', '1-4'),
(102, 18, 21, '2024-09-18', '2024-09-22', 320000, 'completed', '13-14'),
(103, 25, 33, '2023-03-14', '2023-03-18', 295000, 'refund requested', '18-19'),
(104, 8, 57, '2025-05-19', '2025-05-24', 410000, 'confirmed', '29-30'),
(105, 2, 72, '2022-10-05', '2022-10-08', 255000, 'completed', '34-36'),
(106, 32, 94, '2024-02-01', '2024-02-05', 320000, 'completed', '42-43'),
(107, 1, 6, '2023-11-17', '2023-11-21', 310000, 'cancelled', '2-3'),
(108, 11, 17, '2025-09-10', '2025-09-15', 370000, 'confirmed', '10-12'),
(109, 4, 31, '2023-06-26', '2023-06-30', 300000, 'completed', '17-18'),
(110, 15, 54, '2024-04-18', '2024-04-22', 320000, 'completed', '28-30'),
(111, 5, 66, '2022-09-08', '2022-09-12', 310000, 'completed', '34-36'),
(112, 23, 86, '2023-10-04', '2023-10-07', 240000, 'completed', '41-42'),
(113, 30, 2, '2022-12-01', '2022-12-05', 280000, 'completed', '1-2'),
(114, 12, 8, '2025-01-10', '2025-01-15', 365000, 'refund requested', '6-7'),
(115, 17, 26, '2024-05-20', '2024-05-24', 310000, 'completed', '16-17'),
(116, 35, 44, '2023-07-30', '2023-08-03', 300000, 'completed', '24-25'),
(117, 3, 63, '2022-06-12', '2022-06-16', 310000, 'cancelled', '30-31'),
(118, 20, 74, '2024-11-04', '2024-11-07', 270000, 'completed', '35-37'),
(119, 7, 81, '2025-03-22', '2025-03-26', 330000, 'confirmed', '38-40'),
(120, 22, 4, '2022-03-08', '2022-03-11', 210000, 'completed', '1-3'),
(121, 13, 15, '2023-09-01', '2023-09-06', 390000, 'completed', '9-10'),
(122, 29, 38, '2024-08-21', '2024-08-25', 330000, 'cancelled', '23-24'),
(123, 9, 46, '2025-10-10', '2025-10-14', 320000, 'confirmed', '25-26'),
(124, 10, 67, '2023-04-10', '2023-04-14', 310000, 'completed', '33-35'),
(125, 27, 91, '2022-05-14', '2022-05-18', 320000, 'completed', '41-42'),
(126, 1, 3, '2024-01-10', '2024-01-14', 240000, 'completed', '1-3'),
(127, 2, 7, '2024-02-05', '2024-02-09', 280000, 'completed', '4-5'),
(128, 3, 2, '2024-03-12', '2024-03-15', 210000, 'completed', '1-2'),
(129, 4, 5, '2024-04-20', '2024-04-24', 265000, 'completed', '2-4'),
(130, 5, 1, '2024-05-02', '2024-05-05', 195000, 'completed', '3-5'),
(131, 6, 9, '2024-06-08', '2024-06-12', 290000, 'refund requested', '6-7'),
(132, 7, 4, '2024-07-17', '2024-07-20', 220000, 'completed', '1-4'),
(133, 8, 6, '2024-08-01', '2024-08-06', 310000, 'completed', '2-3'),
(134, 9, 2, '2024-09-03', '2024-09-07', 260000, 'cancelled', '3-4'),
(135, 10, 8, '2024-10-12', '2024-10-15', 215000, 'completed', '5-7'),
(136, 11, 7, '2024-11-19', '2024-11-23', 275000, 'completed', '2-5'),
(137, 12, 1, '2024-12-04', '2024-12-07', 200000, 'completed', '1-2'),
(138, 13, 3, '2024-01-22', '2024-01-25', 230000, 'completed', '3-6'),
(139, 14, 9, '2024-02-18', '2024-02-21', 245000, 'completed', '2-4'),
(140, 15, 5, '2024-03-27', '2024-03-31', 295000, 'completed', '5-7'),
(141, 16, 4, '2024-04-11', '2024-04-14', 210000, 'cancelled', '1-3'),
(142, 17, 6, '2024-05-16', '2024-05-20', 270000, 'completed', '4-6'),
(143, 18, 2, '2024-06-23', '2024-06-27', 260000, 'completed', '1-5'),
(144, 19, 8, '2024-07-29', '2024-08-02', 305000, 'completed', '6-7'),
(145, 20, 1, '2024-08-10', '2024-08-13', 215000, 'completed', '2-3'),
(146, 21, 9, '2024-09-14', '2024-09-17', 250000, 'completed', '3-5'),
(147, 22, 3, '2024-10-21', '2024-10-24', 230000, 'completed', '1-4'),
(148, 23, 7, '2024-11-02', '2024-11-06', 280000, 'completed', '2-3'),
(149, 24, 6, '2024-12-13', '2024-12-17', 295000, 'refund requested', '4-6'),
(150, 25, 5, '2024-01-07', '2024-01-11', 265000, 'completed', '2-3'),
(151, 26, 8, '2024-02-13', '2024-02-17', 290000, 'completed', '5-6'),
(152, 27, 2, '2024-03-18', '2024-03-21', 220000, 'completed', '1-2'),
(153, 28, 9, '2024-04-24', '2024-04-27', 245000, 'completed', '6-7'),
(154, 29, 4, '2024-05-06', '2024-05-09', 210000, 'cancelled', '2-5'),
(155, 30, 3, '2024-06-15', '2024-06-18', 235000, 'completed', '1-3'),
(156, 31, 1, '2024-07-01', '2024-07-04', 205000, 'completed', '1-4'),
(157, 32, 6, '2024-08-08', '2024-08-12', 275000, 'completed', '3-5'),
(158, 33, 5, '2024-09-20', '2024-09-24', 260000, 'completed', '2-4'),
(159, 34, 7, '2024-10-14', '2024-10-18', 285000, 'completed', '4-6'),
(160, 35, 2, '2024-11-29', '2024-12-03', 300000, 'completed', '1-2'),
(161, 1, 9, '2024-01-16', '2024-01-19', 235000, 'completed', '5-6'),
(162, 2, 4, '2024-02-21', '2024-02-24', 220000, 'cancelled', '2-3'),
(163, 3, 8, '2024-03-03', '2024-03-06', 210000, 'completed', '4-7'),
(164, 4, 6, '2024-04-09', '2024-04-12', 250000, 'completed', '3-5'),
(165, 5, 1, '2024-05-19', '2024-05-23', 265000, 'completed', '2-6'),
(166, 6, 3, '2024-06-27', '2024-06-30', 235000, 'completed', '1-4'),
(167, 7, 5, '2024-07-05', '2024-07-08', 225000, 'refund requested', '3-5'),
(168, 8, 7, '2024-08-14', '2024-08-18', 275000, 'completed', '4-6'),
(169, 9, 9, '2024-09-10', '2024-09-13', 240000, 'completed', '6-7'),
(170, 10, 2, '2024-10-25', '2024-10-29', 280000, 'completed', '1-3'),
(171, 11, 4, '2024-11-11', '2024-11-14', 215000, 'completed', '2-4'),
(172, 12, 6, '2024-12-19', '2024-12-22', 245000, 'completed', '3-6'),
(173, 13, 8, '2024-01-03', '2024-01-07', 255000, 'completed', '5-7'),
(174, 14, 3, '2024-02-10', '2024-02-14', 230000, 'completed', '1-2'),
(175, 15, 9, '2024-03-25', '2024-03-29', 275000, 'completed', '4-6'),
(176, 16, 5, '2024-04-05', '2024-04-08', 215000, 'cancelled', '3-4'),
(177, 17, 7, '2024-05-12', '2024-05-15', 245000, 'completed', '6-7'),
(178, 18, 2, '2024-06-20', '2024-06-23', 220000, 'completed', '1-3'),
(179, 19, 4, '2024-07-16', '2024-07-20', 270000, 'completed', '2-5'),
(180, 20, 1, '2024-08-26', '2024-08-30', 250000, 'completed', '3-6'),
(181, 21, 6, '2024-09-04', '2024-09-07', 235000, 'completed', '1-4'),
(182, 22, 8, '2024-10-07', '2024-10-11', 275000, 'completed', '5-7'),
(183, 23, 9, '2024-11-15', '2024-11-19', 260000, 'completed', '4-6'),
(184, 24, 3, '2024-12-28', '2024-12-31', 240000, 'completed', '2-3'),
(185, 25, 5, '2024-01-29', '2024-02-02', 270000, 'completed', '3-5'),
(186, 3, 4, '2025-04-01', '2025-04-05', 260000, 'confirmed', '2-4'),
(187, 12, 7, '2025-04-03', '2025-04-06', 215000, 'refund requested', '5-7'),
(188, 7, 2, '2025-04-05', '2025-04-09', 240000, 'confirmed', '1-3'),
(189, 20, 1, '2025-04-08', '2025-04-12', 195000, 'confirmed', '2-5'),
(190, 11, 9, '2025-04-10', '2025-04-13', 275000, 'refund requested', '6-7'),
(191, 5, 6, '2025-04-12', '2025-04-15', 225000, 'confirmed', '3-4'),
(192, 16, 3, '2025-04-14', '2025-04-18', 250000, 'confirmed', '1-2'),
(193, 9, 5, '2025-04-17', '2025-04-21', 265000, 'refund requested', '2-3'),
(194, 14, 8, '2025-04-19', '2025-04-22', 235000, 'confirmed', '5-6'),
(195, 6, 7, '2025-04-23', '2025-04-27', 270000, 'confirmed', '4-6'),
(196, 19, 2, '2025-04-25', '2025-04-28', 220000, 'refund requested', '1-2'),
(197, 22, 1, '2025-04-26', '2025-04-30', 245000, 'confirmed', '3-5');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `cityName` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `description` text NOT NULL,
  `description_short` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `cityName`, `country`, `description`, `description_short`) VALUES
(1, 'Oslo', 'Norvégia', 'Oslo, Norvégia fővárosa, egyedülálló élményeket kínál minden látogatónak. A város a festői Oslofjord partján helyezkedik el, és zöldellő hegyek, erdők övezik, így a természet és a modern városi élet tökéletes harmóniában találkozik. A városban járva a látogatók élvezhetik a friss levegőt, miközben a kultúra, a művészetek és a gasztronómia kínálata is lenyűgöző. {break} A város gazdag kulturális örökséggel rendelkezik. A világhírű Munch Múzeumban az egyik legnagyobb norvég művész, Edvard Munch alkotásai várják a látogatókat, köztük a híres \"A sikoly\" festmény. Az Oslói Opera Ház modern építészete és lenyűgöző belső tere szintén kihagyhatatlan látnivaló, ahogy a Vigeland Park is, mely a világ legnagyobb emberi szoborparkja, és 200-nál is több szobrával Gustav Vigeland művész egyedülálló alkotásai révén egy különleges élményt biztosít. {break} Oslo nemcsak a kultúra szerelmeseinek, hanem a természetkedvelőknek is bőven tartogat látnivalókat. A város körüli hegyek és erdők számos túrázási, biciklizési és síelési lehetőséget kínálnak. A Holmenkollen síugrósánc és sípályák télen ideális helyszínt biztosítanak a téli sportok szerelmeseinek. Az Oslofjord vizein pedig hajókirándulások során élvezhetjük a város és a természet lenyűgöző összhangját. {break} A város gasztronómiája is egyedülálló élményt nyújt. Az éttermekben és kávézókban friss, helyben beszerzett alapanyagokkal dolgoznak, és a tenger gyümölcsei mellett számos norvég specialitást kóstolhatunk meg, mint a halgombóc vagy az erjesztett hal, rakfisk. Az osztriga és a friss halételek iránt érdeklődőknek különleges ínycsiklandó fogásokban lesz részük. {break} Oslo számos szálláslehetőséget kínál, amelyek minden igényt kielégítenek. A város szállodái között megtalálhatóak a luxus hotelek, a kényelmes boutique szállodák és a családbarát helyek is. A szállások elhelyezkedése változatos, így akár a város szívében, akár a természet közvetlen közelében szeretne megszállni, Oslo mindenki számára biztosít kényelmes és pihentető tartózkodást. {break} A város varázslatos atmoszférája, gazdag kulturális kínálata, és a természeti szépségek mindenkit magukkal ragadnak. Akár egy romantikus hétvégére, egy családi nyaralásra, akár egy üzleti útra érkezik, Oslo minden látogatót különleges élményekkel ajándékoz meg.', 'Oslo, Norvégia fővárosa, lenyűgöző módon ötvözi a modern városi életet és a természeti szépségeket. A festői Oslofjord partján elhelyezkedő város gazdag kulturális örökséggel rendelkezik, mint a híres Munch Múzeum és a Vigeland Park, melyek egyedülálló művészeti élményeket kínálnak. A város körüli hegyek és erdők ideális helyszínt biztosítanak túrázáshoz, biciklizéshez és téli sportokhoz, míg a friss tenger gyümölcsei és hagyományos norvég fogásai gasztronómiai élvezeteket nyújtanak. Oslo változatos szálláslehetőségei, a luxushotelektől a kényelmes boutique szállodákig, minden igényt kielégítenek, így a látogatók tökéletes kényelmet találhatnak a város szívében vagy annak zöldövezeteiben. A norvég főváros mindenki számára felejthetetlen élményeket kínál, legyen szó pihenésről, felfedezésről vagy üzleti útról.'),
(2, 'Malé', 'Maldív-szigetek', 'Malé, a Maldív-szigetek fővárosa, egy igazán különleges trópusi város, amely a csendes-óceáni szigetvilág szívében található. A város, bár kicsi, rengeteg látnivalót és élményt kínál, amelyek azonnal magukkal ragadják az ide látogatókat. Malé szigete tele van vibráló piacokkal, hagyományos bazárokkal és színes épületekkel, amelyek a maldív kultúra gazdagságát tükrözik. A város szűk utcáin sétálva, a gyönyörű helyi építészeti stílusban gyönyörködhetünk, miközben felfedezzük a vallási és történelmi jelentőségű helyszíneket is, mint például a Hukuru Miskiy, a Vén templom, mely az egyik legrégebbi és legfontosabb iszlám vallási épület a szigeteken. {break} A tengerparti sétányok és strandok varázslatos panorámát nyújtanak, ahol az kristálytiszta víz és a fehér homokos partok hívogatják a látogatókat. A város közelében fekvő apró szigetek egyedülálló élményeket kínálnak a vízi sportok kedvelőinek, mint például a snorkeling, búvárkodás vagy a hajókirándulások. Malé a vízisportok paradicsoma, mivel a vizek tele vannak színes korallzátonyokkal és változatos tengeri élettel. A sziget legnépszerűbb tevékenységei közé tartozik a vitorlázás, a kajakozás és a vízi túrák, melyek mind lehetőséget adnak arra, hogy a látogatók igazán közelről megismerkedjenek a Maldív-szigetek természeti csodáival. {break} Malé nyújtja a helyi maldív élet igazi ínycsiklandó élményét is, hiszen a szigeten található éttermek és kávézók különleges tengeri fogásokat kínálnak, amelyek friss tenger gyümölcseivel, egzotikus fűszerekkel és helyi alapanyagokkal készült ételekkel várják az ínycsiklandó élvezeteket kereső vendégeket. A város színes piacai és a helyi étkezési kultúra olyan autentikus élményeket adnak, amelyeket nem érdemes kihagyni. Malé olyan hely, ahol a helyi lakosok mindennapi élete, a hagyományos maldív vendégszeretet és a modern városi dinamika tökéletes harmóniában találkozik. {break} Malé szállásai is kényelmesek és jól felszereltek, számos szállodával és üdülőhelyekkel rendelkezik, így mindenki megtalálhatja az ideális helyet, hogy pihenjen és élvezze a szigetek varázslatos atmoszféráját. A város tökéletes bázist biztosít azok számára, akik szeretnék felfedezni a Maldív-szigetek szépségeit, miközben minden kényelmet és szolgáltatást élvezhetnek, amit egy nagyváros tud nyújtani. {break} Malé egy igazán különleges hely, ahol a trópusi paradicsom szépsége és a maldív kultúra egyedülálló keveredése nyújt felejthetetlen élményeket, így minden látogatónak garantáltan maradandó élményeket kínál.', 'Malé, a Maldív-szigetek szíve, egy kis, de nyüzsgő város, mely a trópusi szépségeket és a helyi kultúra gazdagságát ötvözi. A város szűk utcáin sétálva felfedezhetjük a tradicionális maldív építészeti stílust, miközben a város piacon friss tengeri fogásokat és egzotikus gyümölcsöket vásárolhatunk. Malé tengerparti területei ideálisak a napozáshoz, úszáshoz és snorkelinghez, míg a közeli szigetek számos luxus üdülőhelyet kínálnak a kikapcsolódásra. A híres Maldives Islamic Centre és a Nemzeti Múzeum betekintést nyújtanak a maldív történelembe és vallási örökségbe, így Malé tökéletes kiindulópont a Maldív-szigetek felfedezéséhez, miközben minden igényt kielégítő kényelmet biztosít az ide látogatóknak.'),
(3, 'Zermatt', 'Svájc', 'Zermatt, a svájci Alpok egyik legelbűvölőbb városa, egy varázslatos hely, amely a hegyek és a friss alpesi levegő szerelmeseinek igazi paradicsoma. A város a híres Matterhorn hegy lábánál terül el, és bár kicsi, minden szempontból impozáns. Zermatt nemcsak a természet szépségeivel, hanem a gazdag történelmével és kultúrájával is elbűvöli a látogatókat. Az autómentes övezetnek köszönhetően a város tiszta, nyugodt légkört biztosít, így ideális helyszín a pihenésre, feltöltődésre, vagy éppen a kalandok keresésére. {break} Zermatt igazi alpesi kisváros, amely tele van bájos, tradicionális svájci faházakkal, helyi éttermekkel és elegáns üzletekkel, melyek mind az alpesi stílust tükrözik. A város hangulata tökéletes egyedülálló kombinációja a tradicionális hegyi kultúrának és a modern luxusnak. A látogatók felfedezhetik a helyi múzeumokat, mint a Zermatt Múzeum, ahol betekintést nyerhetnek a város történetébe, a hegymászás hagyományaiba és a régió kulturális örökségébe. Zermatt a hegymászás és túrázás rajongóinak is kedvez, mivel számos híres túraútvonal vezet a környező hegyekbe, és a Matterhorn fenséges látványa mindenki számára örök emlék marad. {break} A hegyi túrák mellett Zermatt különleges téli sport lehetőségekkel is büszkélkedhet. A város híres sípályái és sífelvonói az Alpok egyik legjobb síparadicsomának számítanak. A régió rengeteg lehetőséget kínál a síelésre, snowboardozásra, de akár a sífutásra és a hócipős túrákra is. A Zermatt környékén fekvő Gornergrat vasútvonal, amely a hegycsúcsra vezet, mesés panorámát biztosít a látogatóknak, ahonnan lenyűgöző kilátás nyílik a Matterhornra és a környező hegyekre. {break} Nyáron Zermatt egy igazi túrázó paradicsommá válik, a hegyekben való sétálás és a kerékpározás remek módja annak, hogy a látogatók felfedezzék a festői tájat. A híres Matterhorn Glacier Paradise, amely Európa legmagasabb hegyi állomása, szintén egyedülálló élményt kínál, ahol a látogatók lélegzetelállító kilátásban gyönyörködhetnek, és akár a gleccseren is sétálhatnak. A város környékén található tavak és alpesi rétek tökéletes helyszínt biztosítanak a piknikezéshez vagy egy pihentető délutáni sétához. {break} Zermatt nemcsak természetjáróknak és sportolóknak, hanem a gasztronómia kedvelőinek is számos lehetőséget kínál. A helyi éttermekben a svájci és alpesi konyha remekei közül válogathatunk, mint a fondü, raclette, vagy a friss alpesi sajtok. Az ínycsiklandó étkezések mellett Zermatt kávézói és bájai a pihenésre vágyókat várják, hogy élvezzék a hegyi tájat, miközben egy csésze forró csokoládét vagy egy pohár helyi bort kortyolgatnak. {break} A szálláslehetőségek Zermattban a luxustól a barátságos családi hotelekig terjednek, így mindenki megtalálhatja a számára ideális helyet, ahol kényelmesen pihenhet és felfrissülhet. A város szállodái a hegyi tájra orientáltak, és a látogatók élvezhetik a gyönyörű kilátásokat, miközben élvezhetik a magas szintű szolgáltatásokat. Az autómentes város minden sarkában a nyugalom és a friss hegyi levegő garantálja a tökéletes kikapcsolódást. {break} Zermatt valóban egy olyan hely, ahol a természet, a kaland és a pihenés egyedülálló harmóniában találkozik. Akár télen a sípályákra vágyik, akár nyáron a túrákra, Zermatt minden évszakban varázslatos élményeket kínál, amelyeket sosem fog elfelejteni.', 'Zermatt, a svájci Alpok szívében fekvő kisváros, a híres Matterhorn hegy lábánál található, és lenyűgöző panorámát, valamint számos szabadtéri kalandot kínál. A város autómentes övezete biztosítja a nyugodt légkört, ahol a látogatók élvezhetik a friss alpesi levegőt, miközben felfedezik a tradicionális svájci építészeti stílust és a helyi kultúrát. Zermatt híres téli sportparadicsom, sípályáival és sífelvonóival, de nyáron is ideális helyszín túrázáshoz, hegyi kerékpározáshoz és gleccsertúrákhoz. A város gasztronómiai élvezetekkel is várja a látogatókat, ahol a svájci alapételek mellett friss alpesi sajtokat és helyi borokat is kóstolhatunk. Zermatt tökéletes választás mindenki számára, aki a természet, a sport és a pihenés harmóniáját keresni.'),
(4, 'Tokió', 'Japán', 'Tokió, Japán fővárosa, a világ egyik legizgalmasabb és legdinamikusabb metropolisza, amely a múlt és a jövő harmonikus egyesülését kínálja. A város modern felhőkarcolóival és csúcstechnológiai vívmányaival együtt számos történelmi helyszínt is magában foglal, így egyedülálló élményt biztosít minden látogató számára. A hagyományos japán kultúra szelleme, mint a templomok és szentélyek, tökéletesen megfér a modern életstílussal, ami igazán különlegessé teszi Tokiót.\n{break}\nA város közlekedési rendszere példaértékű, így a látogatók könnyedén elérhetik a különböző városrészeket és látnivalókat. A Tokiói metróhálózat és a jól kiépített vasúti rendszer lehetővé teszi, hogy a turisták könnyedén felfedezhessék a város minden szegletét, legyen szó a híres Shibuya Crossing átkelőhelyről, vagy a gazdag éjszakai életéről híres Shinjukuról. Minden sarkon új élmények várják a látogatókat, a vásárlónegyedektől kezdve a lenyűgöző éttermeken át a történelmi templomokig.\n{break}\nTokió nemcsak a látványos városi tájakkal és az izgalmas kulturális élményekkel vonzza a turistákat, hanem a gasztronómiai élményekkel is. A város étkezési kultúrája világszerte elismert, és minden étkezés egy újabb felfedezés. A japán konyha ínycsiklandó fogásai, mint a sushi, ramen vagy tempura, mindenki számára különleges élményt nyújtanak. A Michelin-csillagos éttermek és a helyi utcai étkezők egyaránt egyedülálló gasztronómiai kalandra hívják az ínyenceket.\n{break}\nA szállások terén Tokió számos lehetőséget kínál, hogy mindenki megtalálja a számára legmegfelelőbb pihenési formát. Az ötcsillagos luxus szállodáktól kezdve a középkategóriás hotelekig és a tradicionális japán stílusú ryokan szállásokig minden igényt kielégítő opciók közül választhatnak a látogatók. A szállodák magas színvonalú szolgáltatásokat, modern kényelmet és egyedülálló atmoszférát biztosítanak, hogy a vendégek valóban feltöltődve térjenek haza.\n{break}\nSzállodánk tökéletes választás, ha Tokióban szeretne pihenni, miközben felfedezi a város különleges látnivalóit és kulturális örökségét. A kényelmes szobák, a wellness-részleg és a figyelmes személyzet mind hozzájárulnak ahhoz, hogy tartózkodása valóban felejthetetlen élményt nyújtson. Akár üzleti, akár szabadidős utazásról van szó, nálunk minden adott ahhoz, hogy teljes körű kényelmet és élményt biztosítsunk a vendégeink számára.', 'Tokió, Japán pezsgő fővárosa, ahol a futurisztikus technológia és a hagyományos kultúra találkozik. A város híres látványosságairól, mint a Shibuya keresztutca, a történelmi Senso-ji templom és a zöld Odaiba-sziget. Tokió gasztronómiája világhírű, a legjobb sushi éttermektől a helyi ramen bárokig mindenki megtalálja a kedvére való ínycsiklandó fogásokat. Szállodáink kényelmes helyszínt biztosítanak a város felfedezéséhez, legyen szó üzleti útról vagy nyaralásról.');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `hotel_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `userType` enum('employee','manager','owner') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`hotel_id`, `user_id`, `userType`) VALUES
(1, 7, 'owner'),
(2, 7, 'owner'),
(3, 7, 'owner'),
(4, 7, 'owner'),
(5, 7, 'owner'),
(6, 7, 'owner'),
(7, 7, 'owner'),
(1, 11, 'employee'),
(2, 12, 'manager'),
(3, 13, 'employee'),
(4, 14, 'employee'),
(5, 15, 'employee'),
(6, 16, 'employee'),
(7, 17, 'employee'),
(1, 18, 'manager'),
(2, 19, 'manager'),
(3, 20, 'manager'),
(4, 21, 'manager'),
(5, 22, 'manager'),
(6, 23, 'manager'),
(7, 24, 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
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
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`hotel_id`, `city_id`, `hotelName`, `address`, `phoneNumber`, `email`, `description`) VALUES
(1, 1, 'Frozen Retreat', 'Glacier Avenue 123, 1010', '+47 22 333 444', 'info@frozenretreat.no', 'A Frozen Retreat Hotel egy olyan különleges szálláshely, amely a hideg és a minimalista életstílus szerelmeseinek lett megálmodva. Az Oslo környékén található szálloda különleges jeges esztétikájával és egyedülálló elrendezésével igazi menedéket nyújt mindenkinek, aki szeretne egy kis pihenőt a mindennapok folyamatos forgásától, és egy hűvösebb világba menekülni.\n{break}\nA szálloda hagyományos szobák helyett iglukat biztosít a vendékegnek, amelyeket a tradicionális északi sarki igluk ihlettek. Minden szoba egyedi és kényelmesen berendezett, miközben megőrzi az igluk hagyományos, minimalista stílusát. Az igluk belső terében a jég és a hó elemeit ötvözik a meleg, kényelmes textilek és a meghitt világítás, így a vendégek egyszerre élvezhetik a téli táj varázsát és a pihentető kikapcsolódást.\n{break}\n A Frozen Retreat erős hangsúlyt fektet a jeges esztétikára, az egész szálloda külseje és belső terei egyaránt a természetes jégvilágot tükrözik, amelyet különféle művészeti alkotások, jégszobrok és világító elemek díszítenek. Az igluk belső terében is érezhető a hideg hangulat, mégis biztosítja a maximális kényelmet és melegséget a vendégek számára.\n{break}\n A szállodában különféle wellness szolgáltatások is elérhetőek, amelyek segítenek felfrissíteni a testet és a lelket természetes környezetben. Emellett a hotel környezetében számos téli sportolási lehetőség kínálkozik, mint a síelés, hószánkózás vagy éppen a hófödte tájak felfedezése.\n{break}\n A Frozen Retreat Hotel ideális választás mindazoknak, akik szeretnének egy igazán egyedi élményben részesülni, és szeretnék megtapasztalni a természetes hideg varázsát, miközben kényelmes és pihentető környezetben élvezhetik az északi táj szépségeit.'),
(2, 1, 'King\'s Castle', '456 Royal Road, 0123', '+47 22 185 423', 'reservations@kingscastle.no', 'A King\'s Castle Hotel Oslo szívében, Norvégiában található, egy autentikus és impozáns régi norvég kastély falai között. A szálloda egyedülálló módon ötvözi a történelem és a modern luxus elemeit, így vendégei egy felejthetetlen élményben részesülhetnek, miközben a kastély díszes belső terében pihenhetnek. {break} A King\'s Castle Hotel elegáns szobái a hagyományos norvég építészeti stílust tükrözik, miközben minden modern kényelmet biztosítanak a látogatók számára. Az impozáns termek, a festői kilátás és a történelmi légkör ideális helyszínt biztosítanak a pihenéshez, valamint egy különleges szállásélményt nyújtanak minden látogatónak. {break} A kastély lenyűgöző atmoszférája, a klasszikus bútorok és a finom részletek ötvözete egy mesés utazást biztosít a történelem és a luxus világában. A szálloda exkluzív éttermében a norvég gasztronómia remekeit kóstolhatják meg a vendégek, miközben a történelem egy darabja veszi körül őket. {break} A King\'s Castle Hotel nemcsak egy szálláshely, hanem egy különleges élmény, amely lehetőséget ad arra, hogy a vendégek valóban átéljék Norvégia királyi múltját, miközben élvezhetik a modern kényelem minden előnyét. Ha egy különleges, történelmi hangulatú helyen szeretne pihenni, a King\'s Castle Hotel a tökéletes választás.'),
(3, 2, 'Oceanview Hotel', '789 Coral Reef Drive 20001', '+960 333 4444', 'contact@oceanviewhotel.mv', 'Az Oceanview Hotel a Maldív-szigetek szívében, Malé városában található, és egyedülálló élményt kínál azoknak, akik szeretnék egyesíteni a luxust és a természeti csodákat. A szálloda különleges vízalatti elhelyezkedésével valóban egyedülálló élményt biztosít, hiszen nemcsak egy pihentető szállás, hanem egy igazi akvárium is egyben. {break} A vízalatti szobák és közösségi terek lehetővé teszik a vendégek számára, hogy a szálloda belsejéből szemléljék a lenyűgöző tengeri élővilágot. A kristálytiszta vízben úszó színes halak, tengeri teknősök és egyéb csodálatos vízi lények mind-mind a szobák ablakán keresztül csodálhatók meg, így a vendégek egy egészen különleges, víz alatti világban érezhetik magukat. {break} Az Oceanview Hotel nemcsak a vizuális élményről szól, hanem a pihenésről és a kikapcsolódásról is. Az exkluzív szolgáltatások, mint a víz alatti étterem, ahol a vendégek miközben a tengeri életet figyelik, élvezhetik a friss tengeri étkeket, vagy a relaxáló wellness-kezelések, mind hozzájárulnak ahhoz, hogy az itt töltött idő valóban felejthetetlen legyen. {break} A szálloda modern dizájnja és a természetes környezet harmóniájának köszönhetően az Oceanview Hotel a tökéletes választás mindazok számára, akik szeretnék egyesíteni a luxust a természet közelségével, miközben egy varázslatos tengeri világban pihenhetnek. Ha valami igazán különleges élményre vágyik, ne habozzon meglátogatni az Oceanview Hotel-t – a Maldív-szigetek egyik legkülönlegesebb szállodáját.'),
(4, 3, 'Rocky Ridge Lodge', '101 Alpine Heights 3920', '+41 27 123 4567', ' info@rockyridgelodge.ch', 'A Rocky Ridge Lodge Svájc gyönyörű Alpokjai között helyezkedik el, és egyedülálló élményt kínál mindazok számára, akik a természet közvetlen közelében szeretnének pihenni. A szálloda különlegessége, hogy nem hagyományos szobákat kínál, hanem üveg kapszulákat, amelyek közvetlenül a hegy oldalára vannak rögzítve. Ezek a kapszulák lehetővé teszik, hogy a vendégek páratlan panorámában gyönyörködjenek, miközben több száz méter magasban élvezhetik a nyugalmat és a friss alpesi levegőt. {break} A kapszulák különleges, teljesen átlátszó üvegből készültek, így minden szögből csodálhatók a lenyűgöző hegyi tájak, a hófödte csúcsok, a zöldellő völgyek és a kristálytiszta égbolt. A vendégek igazi természetközeli élményben részesülnek, miközben kényelmesen pihenhetnek, mintha a hegyek csúcsán lebegnének. {break} Minden kapszula modern dizájnnal és kényelmes felszereltséggel rendelkezik, hogy biztosítsa a maximális pihenést és komfortot. Az éjszakai égbolt alatt, a hegyekre nyíló panorámával való alvás egy igazán felejthetetlen élményt kínál. {break} A Rocky Ridge Lodge ideális választás azok számára, akik el szeretnének szakadni a hétköznapoktól, és egy igazán különleges, természetközeli pihenést keresnek. Legyen szó romantikus kikapcsolódásról vagy egy kalandos alpesi élményről, a Rocky Ridge Lodge egy varázslatos hely, ahol a hegyek nyújtotta szépség és a modern kényelem tökéletes harmóniában találkozik.'),
(5, 3, 'Locomotive Lounge', '202 Railway Station Avenue', '+41 27 765 4321', 'bookings@locomotivelounge.ch', 'A Locomotive Lounge Zermatt városában található, egy olyan különleges szálloda, amely a vasúti történelem szerelmeseinek és azoknak kínál valami igazán egyedit, akik szeretnék a múltat és a jelent ötvözni. A szálloda egy régi, már nem használt pályaudvar területén helyezkedik el, ahol a forgalomból kivont, legendás vonatok kaptak új életet hotelszobákként. {break} A Locomotive Lounge minden egyes szobája egy-egy átalakított, egykori vonat kocsi, amely még a vasúti korszak hangulatát idézi. Az autentikus vonatbelsők modern kényelmi szolgáltatásokkal lettek felszerelve, hogy a vendégek egyedülálló élményben részesülhessenek. A vonat kocsik hangulatos, nosztalgikus légkört biztosítanak, miközben minden modern igényt kielégítenek, így a vendégek valódi \"utazásra\" indulhatnak a kényelem és a történelem ötvözetében. {break} A szállodában a vendégek nemcsak a vonatok különleges atmoszféráját élvezhetik, hanem egyedi étkezési élményeket is kínál. A vasúti étterem modern ínycsiklandó fogásokat kínál, miközben a vendégek élvezhetik a pályaudvarra jellemző hangulatot. {break} A Locomotive Lounge tehát tökéletes választás mindazok számára, akik szeretnék átélni a régi idők vasúti kalandjait, miközben a modern kényelmet élvezik. Az egyedülálló történelmi háttér és a szálloda különleges dizájnja felejthetetlen élményt nyújt a látogatók számára, és egy utazás a múltba egyben a mai világ luxusával.'),
(6, 4, 'Kitty Cove', '12 Meow Street, Shibuya, 150-0001', '+81 3 1234 5678', 'hello@kittycove.jp', 'A Kitty Cove egy bájos és különleges szálloda Tokió szívében, amely a macskák szerelmeseinek kínál egy igazán egyedülálló élményt. Bár az épület kívülről egy átlagos hotelnek tűnhet, az egyedülálló jellemzője, hogy a szálloda területén számos barátságos macska él, akik a vendégek társaságában várják a közönséget. {break} A Kitty Cove különleges hangulata egyedülálló lehetőséget ad arra, hogy a látogatók ne csak pihenjenek, hanem élvezzék a macskák társaságát is. A vendégek szabadon játszhatnak, simogathatják és interakcióba léphetnek a szálloda macskáival, akik igazi kedvencek és mindig készen állnak egy kis figyelemre. {break} A szálloda további különlegessége, hogy a vendégek kérvényezhetik, hogy egy adott macska személyesen a szobájukban tartózkodjon, így még intimebb kapcsolatba kerülhetnek a kis kedvencekkel. Ez tökéletes lehetőség azok számára, akik szeretnének egy kis nyugalmat és boldogságot találni a macskák társaságában, miközben élvezhetik a szálloda kényelmét. {break} Ezek felett a Kitty Cove együttműködik egy helyi állatmenhellyel is, így amennyiben egy látogató kialakít egy különleges kapcsolatot szállodánk valamelyik macskájával, kérvényezheti annak örökbe fogadását is! {break} A Kitty Cove nemcsak egy szálloda, hanem egy igazi menedék a macskák szerelmeseinek, ahol mindenki megtalálhatja a saját kis szórakozását, pihenését és örök barátját. Legyen szó pihenésről vagy egy kis vidám szórakozásról a macskákkal, a Kitty Cove a tökéletes választás azok számára, akik egy különleges és szórakoztató szállásélményt keresnek Tokióban.'),
(7, 4, 'Cave Haven', ' 34 Stalactite Lane, Minato, 108-0073', '+81 3 8765 4321', 'info@cavehaven.jp', 'A Cave Haven egy igazán egyedülálló és különleges szálloda Japán egyik lenyűgöző barlangjában, egy már felfedezett bányában található. Ez a titokzatos szálloda azok számára kínál felejthetetlen élményt, akik szeretnék egyesíteni a természet csodáit a modern kényelemmel. A szálloda egy régi bányában került kialakításra, amely a föld mélyén rejlő varázslatos atmoszférájával varázsolja el a látogatókat. {break} A Cave Haven szobái a barlang egyes természetes formációinak figyelembevételével lettek kialakítva, így a vendégek egy olyan egyedülálló környezetben pihenhetnek, amely a természet adta szépséget ötvözi a kényelmes, modern dizájnnal. A szobák mennyezetét a barlang természetes kőzetformái díszítik, és az ambient világításnak köszönhetően igazán különleges hangulatot biztosítanak. {break} A szálloda emellett számos egyedülálló szolgáltatással rendelkezik. A vendégek élvezhetik a barlanghőmérsékletet és a hűvös levegőt, miközben a természet és a történelem különleges harmóniáját tapasztalják meg. A szálloda étterme is egyedülálló élményt kínál, ahol a helyi ételek mellett a barlang különleges atmoszféráját élvezhetik. {break} A Cave Haven ideális választás mindazok számára, akik szeretnék eltölteni az éjszakát egy természetes, ősi környezetben, miközben a modern kényelem és a bányászhagyományok varázslatos keverékét élvezhetik. Ha egy igazán különleges és mesés élményre vágyik, a Cave Haven biztosan felejthetetlen élményben részesíti.');

-- --------------------------------------------------------

--
-- Table structure for table `loyalty`
--

CREATE TABLE `loyalty` (
  `loyalty_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rank_id` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loyalty`
--

INSERT INTO `loyalty` (`loyalty_id`, `user_id`, `rank_id`, `points`, `updated_at`) VALUES
(1, 1, 1, 0, '2025-03-31 00:00:00'),
(2, 2, 2, 1178, '2025-03-31 11:53:03'),
(3, 3, 1, 0, '2025-03-31 00:00:00'),
(4, 4, 1, 0, '2025-03-31 00:00:00'),
(5, 5, 1, 0, '2025-03-31 00:00:00'),
(6, 6, 1, 0, '2025-03-31 00:00:00'),
(7, 7, 1, 0, '2025-03-31 00:00:00'),
(8, 8, 1, 0, '2025-03-31 00:00:00'),
(9, 9, 1, 0, '2025-03-31 00:00:00'),
(10, 10, 1, 0, '2025-03-31 00:00:00'),
(11, 11, 1, 0, '2025-03-31 00:00:00'),
(12, 12, 1, 0, '2025-03-31 00:00:00'),
(13, 13, 1, 0, '2025-03-31 00:00:00'),
(14, 14, 1, 0, '2025-03-31 00:00:00'),
(15, 15, 1, 0, '2025-03-31 00:00:00'),
(16, 16, 1, 0, '2025-03-31 00:00:00'),
(17, 17, 1, 0, '2025-03-31 00:00:00'),
(18, 18, 1, 0, '2025-03-31 00:00:00'),
(19, 19, 1, 0, '2025-03-31 00:00:00'),
(20, 20, 1, 0, '2025-03-31 00:00:00'),
(21, 21, 1, 0, '2025-03-31 00:00:00'),
(22, 22, 1, 195, '2025-03-31 12:02:39'),
(23, 23, 1, 0, '2025-04-04 14:29:43'),
(24, 24, 1, 0, '2025-04-04 14:33:28'),
(25, 25, 1, 0, '2025-04-04 14:34:32'),
(26, 26, 1, 0, '2025-04-04 14:36:50'),
(27, 27, 1, 0, '2025-04-04 14:38:39'),
(28, 28, 1, 0, '2025-04-04 14:40:21'),
(29, 29, 1, 0, '2025-04-04 14:43:10'),
(30, 30, 1, 0, '2025-04-04 14:45:13'),
(31, 31, 1, 0, '2025-04-04 14:47:18'),
(32, 32, 1, 0, '2025-04-04 14:48:30'),
(33, 33, 1, 0, '2025-04-04 14:49:23'),
(34, 34, 1, 0, '2025-04-04 14:50:14'),
(35, 35, 1, 0, '2025-04-04 14:51:28');

-- --------------------------------------------------------

--
-- Table structure for table `loyaltyrank`
--

CREATE TABLE `loyaltyrank` (
  `rank_id` int(11) NOT NULL,
  `rank` enum('bronze','silver','gold','diamond') NOT NULL,
  `discount` double(3,1) NOT NULL,
  `minPoint` int(11) NOT NULL,
  `perks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loyaltyrank`
--

INSERT INTO `loyaltyrank` (`rank_id`, `rank`, `discount`, `minPoint`, `perks`) VALUES
(1, 'bronze', 0.0, 0, ''),
(2, 'silver', 5.0, 1000, 'ingyenes törölköző'),
(3, 'gold', 10.0, 5000, 'ingyenes törölköző, későbbi távozás'),
(4, 'diamond', 25.0, 15000, 'ingyenes törölköző, későbbi távozás, hozzáférés a diamond részlegünkhöz');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `reviewText` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `edited` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `hotel_id`, `rating`, `reviewText`, `created_at`, `active`, `edited`) VALUES
(1, 31, 1, 5, 'Igazán különleges élmény volt, az igluk belsejei remekek!', '2025-02-18 00:00:00', 1, 0),
(2, 14, 2, 5, 'Remek a hely, csak ajánlani tudom!', '2025-02-24 11:16:52', 1, 0),
(3, 16, 3, 2, 'Bunkók a helyiek', '2025-02-24 11:55:23', 1, 0),
(4, 21, 2, 4, 'Remek a hely viszont a helyi pacalpörkölt lehetne finomabb', '2025-02-24 12:11:04', 0, 0),
(5, 1, 2, 1, 'Nem éreztem jól magam a helyszínen', '2025-02-24 13:27:18', 1, 0),
(6, 3, 6, 5, 'Én mint Miku Hatsune nagyon élveztem a helyet, rendkívül aranyosak a macskák', '2025-03-05 17:38:33', 1, 0),
(7, 4, 3, 4, NULL, '2025-03-05 17:49:56', 1, 0),
(8, 34, 7, 5, 'Klausztrofóbiásoknak nem ajánlom, viszont ezt leszámítva fenomenális!', '2025-03-05 17:50:08', 1, 0),
(9, 9, 4, 3, NULL, '2025-03-17 12:10:18', 1, 0),
(10, 2, 1, 5, 'Fagyos', '2025-03-24 15:29:27', 1, 0),
(11, 25, 6, 5, 'jó volt', '2025-03-31 12:03:03', 1, 0),
(12, 30, 7, 4, 'Macskák mindenhol! Imádtam!', '2024-06-24 11:24:11', 1, 1),
(13, 13, 5, 5, 'Tiszta, rendezett helyszín, jó volt a programkínálat.', '2024-01-04 09:16:12', 1, 0),
(14, 25, 4, 5, 'Tiszta, rendezett helyszín, jó volt a programkínálat.', '2024-12-01 07:11:26', 1, 0),
(15, 30, 1, 5, 'Remek kikapcsolódás, gyönyörű táj és barátságos emberek.', '2025-03-20 23:59:59', 1, 0),
(16, 35, 5, 3, 'A hely hangulata nagyon kellemes volt, de a kiszolgálás lehetne figyelmesebb.', '2022-07-20 01:21:50', 1, 0),
(17, 3, 4, 3, 'Sajnos elég csalódottan távoztunk, nem azt kaptuk, amit ígértek.', '2025-01-19 10:58:40', 1, 0),
(18, 8, 1, 5, 'Ha tehetitek, mindenképp látogassatok el ide! A kilátás lenyűgöző és a környék gasztronómiája is megér egy misét.', '2025-01-19 17:12:58', 1, 0),
(19, 9, 7, 2, 'Túlértékelt hely. Nem volt különleges élmény.', '2025-01-20 09:47:36', 1, 0),
(20, 5, 3, 4, 'Meglepően jó volt! Egy kis gyöngyszem a térképen, amiről korábban nem is hallottunk.', '2025-01-21 13:33:27', 1, 0),
(21, 11, 2, 3, NULL, '2025-01-22 14:25:03', 1, 0),
(22, 12, 5, 5, 'Egyik legjobb hétvégém volt itt! A szállás kényelmes, a személyzet segítőkész, és minden pontosan úgy volt, ahogy ígérték. Még a helyi macskák is barátságosak voltak.', '2025-01-23 11:51:19', 1, 0),
(23, 10, 1, 4, 'Jó hely, de kicsit drágának tartom a belépőt a kínált szolgáltatásokhoz képest.', '2025-01-23 18:40:44', 1, 0),
(24, 7, 6, 5, 'Ez a hely tényleg elvarázsolt! A naplemente a dombtetőről látva egy életre szóló emlék marad. Már tervezzük a visszatérést.', '2025-01-24 16:31:07', 1, 0),
(25, 13, 4, 2, 'Nem volt rossz, de sokkal jobbat is láttam már.', '2025-01-24 19:12:22', 1, 0),
(26, 14, 6, 5, NULL, '2025-01-25 08:27:13', 1, 0),
(27, 15, 1, 2, 'Nagyon csalódott voltam. Koszos volt, a személyzet sem volt segítőkész.', '2025-01-25 10:45:58', 1, 0),
(28, 16, 3, 4, 'Tökéletes hely egy romantikus hétvégéhez. Csend, nyugalom és gyönyörű táj.', '2025-01-25 17:18:31', 1, 0),
(29, 17, 6, 5, NULL, '2025-01-26 09:07:43', 1, 0),
(30, 18, 2, 5, 'Egyik kedvenc helyem lett! Külön köszönet a helyi idegenvezetőnek, aki fantasztikus túrát tartott nekünk.', '2025-01-26 15:59:12', 1, 0),
(31, 19, 4, 2, 'Kicsit túl reklámozott hely, de a természet szépsége vitathatatlan.', '2025-01-27 11:24:46', 1, 0),
(32, 20, 7, 4, 'Nagyon jól szervezett programokkal és barátságos légkörrel találkoztunk.', '2025-01-28 14:10:39', 1, 0),
(33, 21, 3, 1, 'Nem ajánlom senkinek, aki nyugodt pihenésre vágyik.', '2025-01-28 18:22:53', 1, 0),
(34, 22, 5, 3, NULL, '2025-01-29 07:31:15', 1, 0),
(35, 23, 2, 5, 'Lenyűgöző kilátás, fantasztikus vendéglátás, és elképesztően jó hangulat. Itt tényleg minden adott egy tökéletes kikapcsolódáshoz!', '2025-01-29 12:46:01', 1, 0),
(36, 24, 6, 4, 'Kellemes meglepetés volt. Ajánlom mindenkinek, aki aktív pihenésre vágyik.', '2025-01-29 15:34:49', 1, 0),
(37, 25, 1, 2, 'Kissé zsúfolt volt, de ettől függetlenül jó élmény.', '2025-01-30 10:39:27', 1, 0),
(38, 26, 4, 3, 'Átlagos. Nem hagyott mély nyomot bennem.', '2025-01-30 14:18:33', 1, 0),
(39, 27, 6, 5, 'Aki szereti a természetközeli élményeket és az autentikus falusi életet, annak ez a hely telitalálat.', '2025-01-30 18:07:41', 1, 0),
(40, 28, 7, 3, NULL, '2025-01-31 09:33:29', 1, 0),
(41, 29, 3, 4, 'Nagyon jól szórakoztunk, de a szállás lehetne kényelmesebb.', '2025-01-31 13:56:16', 1, 0),
(42, 30, 5, 5, 'Ez volt eddig a legjobb élményünk az évben! A kilátás, a programok, és a hely hangulata mind felejthetetlenek voltak.', '2025-01-31 16:44:52', 1, 0),
(43, 31, 6, 3, 'Csak azoknak ajánlom, akik szeretik a nyüzsgést.', '2025-02-01 08:19:03', 1, 0),
(44, 32, 1, 2, 'Néhány részét túl turistásnak találtam, de voltak igazán békés zugok is.', '2025-02-01 10:42:40', 1, 0),
(45, 33, 4, 4, NULL, '2025-02-01 13:58:10', 1, 0),
(46, 34, 7, 5, 'Ha valami különlegesre vágytok, ne hagyjátok ki ezt a helyet! A reggeli kávé a teraszon örökre emlékezetes marad.', '2025-02-02 09:06:49', 1, 0),
(47, 35, 2, 3, 'Kicsit hosszú volt az utazás, de megérte.', '2025-02-02 11:23:17', 1, 0),
(48, 26, 3, 4, 'Nem volt semmi extra, de egy délutánra megfelelt.', '2025-02-02 15:34:01', 1, 0),
(49, 27, 6, 2, NULL, '2025-02-02 18:50:55', 1, 0),
(50, 28, 5, 5, 'Elképesztő hétvégét töltöttünk itt. A túraútvonalak jól karbantartottak, a látvány pedig minden várakozásunkat felülmúlta.', '2025-02-03 08:44:13', 1, 0),
(51, 19, 1, 4, 'Hangulatos kis hely, a kávézók különösen jók.', '2025-02-03 11:22:48', 1, 0),
(52, 10, 4, 3, 'Az éttermekben lehetne jobb a kiszolgálás, de amúgy kellemes élmény.', '2025-02-03 16:09:29', 1, 0),
(53, 11, 7, 2, 'A várakozási idő hosszú volt, ez sokat rontott az összképen.', '2025-02-04 10:17:36', 1, 0),
(54, 12, 3, 5, 'Imádtam minden percét! A természet és a kultúra itt kéz a kézben jár.', '2025-02-04 13:11:51', 1, 0),
(55, 33, 2, 4, NULL, '2025-02-04 17:03:27', 1, 0),
(56, 24, 5, 3, 'Egyszerű, de nagyszerű. Pont erre volt szükségem.', '2025-02-05 08:55:15', 1, 0),
(57, 15, 6, 3, 'Nem volt rossz, de túl messze van mindentől.', '2025-02-05 12:34:48', 1, 0),
(58, 26, 1, 2, 'Az utazás megérte, de a szállás hagyott kívánnivalót maga után.', '2025-02-05 15:47:20', 1, 0),
(59, 17, 4, 5, 'Ez volt életem egyik legszebb élménye. Hosszú séták, kedves emberek, ízletes ételek és lenyűgöző tájak. Egy pillanatig sem unatkoztunk. Mindenkinek szívből ajánlom.', '2025-02-06 09:23:37', 1, 0),
(60, 18, 7, 4, 'Barátságos környezet, kiváló programok. Jól éreztük magunkat.', '2025-02-06 13:56:03', 1, 0),
(61, 29, 2, 3, NULL, '2025-02-06 17:44:11', 1, 0),
(62, 20, 3, 5, 'Minden elvárásunkat felülmúlta! Az időjárás is kedvezett, de a környezet és a vendégszeretet tették igazán különlegessé.', '2025-02-07 10:11:58', 1, 0),
(63, 34, 2, 4, 'Az ételek finomak voltak, de az adagok mérete csalódást okozott. A környezet viszont barátságos és hangulatos.', '2023-06-12 10:05:44', 1, 0),
(64, 27, 3, 5, 'A szállás szuper volt, külön kiemelném a reggelit, ami bőséges és változatos. A személyzet is nagyon kedves és segítőkész volt.', '2022-10-04 08:42:39', 1, 0),
(65, 18, 4, 1, 'Sajnos csalódtam. A reklám alapján sokkal többet vártam, mint amit kaptam. A fürdő koszos volt, a személyzet unott, nem ajánlanám másnak.', '2022-11-17 15:13:28', 1, 0),
(66, 21, 7, 5, 'Kiváló élmény! A környék gyönyörű, a programok változatosak, és az egész nagyon jól szervezett volt. Visszajövünk jövőre is!', '2024-04-26 13:18:52', 1, 0),
(67, 18, 1, 3, 'Nem volt rossz, de nem is kiemelkedő. A közlekedés lehetne jobb, és kicsit drágálltam a belépőt.', '2023-09-09 19:23:17', 1, 0),
(68, 26, 5, 5, 'Lenyűgöző élmény! A barlang túra felejthetetlen volt, a vezetőnk profi és humoros, a gyerekek is imádták. Mindenkinek ajánlom, aki szereti a természetet.', '2025-02-07 12:44:03', 1, 0),
(69, 19, 3, 2, 'A parkolás szörnyű, alig találtunk helyet. Maga a program rendben volt, de nem igazán nyűgözött le.', '2023-03-13 17:08:21', 1, 0),
(70, 21, 2, 4, 'Nagyon barátságos hely, finom ételek, kellemes zene. A hangulat igazán megfogott, főleg a nyári esték különlegesek itt.', '2024-06-29 20:46:18', 1, 0),
(71, 13, 6, 1, 'Zajos, zsúfolt, és a vendéglátás is hagyott kívánnivalót maga után. Nem érzem, hogy újra visszamennék.', '2022-08-22 11:27:34', 1, 0),
(72, 14, 4, 4, 'Remek ár-érték arány, tiszta és jól karbantartott helyszín. A gyerekek is nagyon élvezték a játszóteret.', '2023-12-15 09:03:58', 1, 0),
(73, 10, 1, 5, 'Az egész családnak szuper élmény volt. A kiállítás informatív, a gyerekprogramok színvonalasak, és még a büfé is meglepően jó volt.', '2024-03-03 16:22:16', 1, 0),
(74, 2, 2, 3, 'Nem volt rossz, de kicsit több interaktív elem jól jött volna. A hely történelme viszont érdekes volt.', '2023-10-26 10:36:42', 1, 0),
(75, 3, 5, 4, 'Rendezett, kulturált, kellemes légkör. Jól éreztük magunkat, és a személyzet hozzáállása is példás.', '2024-07-21 12:51:37', 1, 0),
(76, 6, 3, 2, 'A belépő árát nem igazolta a szolgáltatás. Az élmény gyenge volt, és a tömeg miatt nem is tudtunk mindent kipróbálni.', '2022-12-02 14:19:08', 1, 0),
(77, 11, 4, 5, 'Bámulatos hely, remek túraútvonalakkal. A levegő tiszta, a kilátás pedig páratlan. Aki szereti a természetet, annak kötelező!', '2023-04-07 18:37:01', 1, 0),
(78, 8, 2, 4, 'Nagyon meg voltunk elégedve. A személyzet mindenben segített, és külön köszönet a kis meglepetésért a szobában.', '2024-09-12 07:54:45', 1, 0),
(79, 35, 3, 3, 'Átlagos élmény. Nem volt rossz, de különösebben nem is emlékezetes. Az árakat túlzónak éreztem.', '2023-05-28 16:09:29', 1, 0),
(80, 9, 6, 1, 'Csalódottan távoztunk. Az időzítés nem volt jó, a programok elmaradtak, és a kommunikáció sem volt megfelelő.', '2022-06-20 13:50:51', 1, 0),
(81, 10, 1, 5, 'Csodálatos élmény minden szempontból. A szolgáltatások magas színvonalúak, a környezet gyönyörű. Visszatérünk!', '2024-11-04 15:35:00', 1, 0),
(82, 9, 3, 2, 'Nem ért meg ennyit az egész. A látványosság sem volt annyira érdekes, és a tömeg is idegesítő volt.', '2023-07-10 20:28:14', 1, 0),
(83, 24, 4, 4, 'Minden rendben ment, a program jól szervezett volt. Az idegenvezető felkészült, informatív és vicces volt.', '2025-01-13 09:41:38', 1, 0),
(84, 7, 5, 5, 'Életem egyik legjobb hétvégéje volt! A programok fantasztikusak, az emberek barátságosak, és mindenhol látszik az odafigyelés.', '2023-08-16 18:11:02', 1, 0),
(85, 4, 2, 2, 'A várakozásokhoz képest gyengébb élmény volt. A vendéglátás közepes, és a higiénia sem volt a legjobb.', '2022-09-01 10:02:11', 1, 0),
(86, 8, 4, 4, 'Nagyon pozitív benyomásom volt a helyről. Letisztult, rendezett, informatív. Jó szívvel ajánlom mindenkinek.', '2024-05-19 14:43:33', 1, 0),
(87, 3, 6, 1, 'Az étterem és a környezet csalódás volt. Az ételek drágák és középszerűek, a mosdók pedig piszkosak.', '2022-03-14 12:00:21', 1, 0),
(88, 5, 1, 5, 'Az Oslo melletti Frozen Retreat egyszerűen lélegzetelállító! A feleségemmel szerettünk volna kiszakadni a nyüzsgésből, és valami teljesen mást megtapasztalni – ez a szálloda pontosan ezt nyújtotta. A jégből és hóból épített igluk olyan fantasztikus atmoszférát teremtenek, amit máshol lehetetlen megtapasztalni. A belső tér meglepően meleg és barátságos, a puha textilek és a hangulatvilágítás teljesen elfeledteti a kinti hideget. Esténként jégszobrok között sétálni, majd forró teát kortyolgatni egy igluban – ez igazi varázslat volt. A wellness részleg külön kiemelést érdemel: szauna, jeges fürdő, mindez egy havas fenyőerdő közepén! Aki egy mesebeli téli élményre vágyik, ne hagyja ki!', '2024-12-14 12:00:21', 1, 0),
(89, 12, 1, 4, 'Ez volt az első alkalom, hogy jégszállodában szálltunk meg, és őszintén szólva, kicsit szkeptikusak voltunk. De már az első pillanatban elvarázsolt minket a látvány. A Frozen Retreat tényleg egy műalkotás – minden iglu más, minden részlet ki van dolgozva, és minden szolgáltatás arra törekszik, hogy a vendég elfelejtse a mindennapokat. A hideg dizájn és a meleg vendéglátás remek egyensúlyban van. A személyzet kedves és figyelmes volt, még extra takarót is hoztak nekünk, pedig a szoba már így is nagyon komfortos volt. Nagyon tetszett a közeli sípálya és a lehetőség hószánkózásra – igazi téli kaland!', '2025-02-21 13:23:24', 1, 0),
(90, 23, 2, 5, 'A Kings Castle egy időutazás – de nem akárhova, hanem egy fényűző, aranykorbeli kastélyba! A szálloda minden szeglete lélegzetelállító, a szobánk ablakából festői kilátás nyílt az udvarra és a távoli hegyekre. A bútorok és a díszítések történelmet mesélnek, de közben ott van a modern luxus is: tökéletesen felszerelt fürdő, kényelmes ágy, gyors wifi. A reggelik bőségesek és elegánsak voltak, a vacsorát pedig soha nem fogom elfelejteni – az étterem hangulata olyan volt, mintha egy filmforgatáson lennék. Mindenképpen visszatérünk, mert ez a hely nemcsak szálloda, hanem élmény is!', '2022-01-14 22:17:51', 1, 0),
(91, 33, 2, 5, 'Ez a hotel olyan volt, mintha beléptünk volna egy történelmi regény lapjaira. Minden részlet aprólékosan kidolgozott, a dísztermek, a csillárok, a régi festmények... egyszerűen gyönyörű! A személyzet rendkívül udvarias, folyamatosan azt éreztették velünk, hogy különleges vendégek vagyunk. Az ágyak kényelmesek, a fürdőszoba modern, mégis illeszkedik a történelmi stílushoz. Nagyon tetszett, hogy a szálloda központi elhelyezkedése ellenére csendes és nyugodt. A vacsora valóban kulináris élmény volt, a norvég specialitások fantasztikusak!', '2024-03-14 12:14:21', 1, 0),
(92, 20, 3, 5, 'Az Oceanview Hotel életem egyik legkülönlegesebb élményét nyújtotta! Soha nem gondoltam volna, hogy egyszer a tengeralatt járás érzését ilyen kényelemben élhetem át. A szoba fala teljesen üvegből volt, és egész nap csodálhattuk a halakat, teknősöket és még rájákat is! A nyugalom, amit ez a látvány nyújtott, leírhatatlan. Az étterem külön élmény volt, mintha egy víz alatti szentélyben vacsoráztunk volna – a friss tenger gyümölcsei kifogástalanok voltak. Ha valaki a természetet szeretné egy igazán exkluzív környezetben élvezni, ne keresgéljen tovább!', '2023-02-14 09:30:12', 1, 0),
(93, 5, 3, 4, 'A Maldív-szigetek önmagukban is csodásak, de az Oceanview Hotel valami egészen más szint. Olyan, mint egy víz alatti mennyország. A dizájn rendkívül elegáns, minden apró részlet illeszkedik a tengeri tematika világához. A wellness részleg is fantasztikus, kipróbáltuk a tengeri sóval végzett kezelést – frissítő és relaxáló egyszerre. Az egyik este a szobánk ablakánál egy kis cápa úszott el – olyan volt, mintha egy természetfilm főszereplői lennénk. Ez az a hely, ahová ha egyszer eljutsz, örökké emlékezni fogsz rá.', '2024-10-14 20:54:51', 1, 0),
(94, 8, 4, 5, 'A Rocky Ridge Lodge-ban eltöltött időszak maga volt a csoda. A kapszulák, amelyek szó szerint a hegyoldalra vannak erősítve, valami egészen elképesztő látványt nyújtanak. Éjszaka, amikor az ég tele volt csillagokkal, és alattunk a völgy fényei ragyogtak – olyan érzés volt, mintha lebegnénk. A szoba teljesen felszerelt, a fűtés kiválóan működik, és a kilátás minden percben új arcát mutatta. A túrák a környéken szintén fantasztikusak – ez a hely minden természetimádónak kötelező!', '2025-01-14 17:42:42', 1, 0),
(95, 12, 5, 3, 'A Locomotive Lounge egy igazi rejtett gyöngyszem! A vasúti témájú szálloda annyira hitelesen adja vissza a régi idők hangulatát, hogy az ember szinte hallja a mozdonyok füttyét. A vonatkocsi, ahol megszálltunk, tágas és kényelmes volt, de megőrizte a nosztalgikus hangulatot. Az étterem is különleges – mintha egy első osztályú dining car-ban ülnél az Orient Expresszen. Imádtuk az apró részleteket: régi jegykiadó gépek, vasúti csengők, eredeti ülések. Egy élmény volt, nem csak egy szállás!', '2022-07-14 11:27:29', 1, 0),
(96, 9, 6, 5, 'A Kitty Cove nem csak szálloda – ez maga a boldogság! Már a recepción néhány cica üdvözölt minket, és onnantól kezdve egyetlen perc sem telt el úgy, hogy ne lettünk volna macskák között. A szobánkba is beköltözhetett az általunk kiválasztott kedvenc, és egész éjjel ott dorombolt mellettünk. Nagyon otthonos és tiszta a szálloda, a személyzet kedves és nyitott. A macskák jól ápoltak, barátságosak és egyáltalán nem tolakodóak – csak ott vannak, ha szeretnéd őket. Igazi lélekmelengető élmény volt!', '2023-04-14 08:12:30', 1, 1),
(97, 16, 7, 4, 'A Cave Haven teljesen lenyűgözött! A barlangszállás ötlete elsőre kissé szokatlannak tűnt, de az élmény magáért beszélt. A szobák a természetes kőzetformációkhoz illeszkednek, különleges hangulatot teremtve. A világítás hangulatos, a hűvös levegő pedig frissítő, különösen a nyári melegben. Az étterem szintén a barlangba van építve – egyedülálló atmoszféra, kiváló helyi ételek, csodás borválaszték. Ha valaki valami teljesen másra vágyik, itt megtalálja.', '2024-06-14 11:55:21', 1, 0),
(98, 23, 1, 2, 'Bár a Frozen Retreat elsőre rendkívül látványosnak és különlegesnek tűnt a fotók alapján, a valóság sajnos egészen más képet mutatott. Az ötlet – az igluk és a jeges esztétika – valóban kreatív és ígéretes, de a megvalósítás hagy kívánnivalót maga után.\r\nAz iglunk belső tere túl hideg volt még a meleg textilek ellenére is, és a fűtés nem volt elegendő ahhoz, hogy komfortosan érezzük magunkat. Az ágy kemény és kényelmetlen volt, és a világítás is túlságosan gyenge – romantikusnak szánták, de inkább nyomasztóan sötét volt.\r\nA wellness részleg sajnos túlzsúfolt volt, és nem sikerült időpontot foglalnunk sem masszázsra, sem szaunára. A személyzet kedves, de láthatóan túlterhelt és kissé szervezetlen volt. Ráadásul az étkezési lehetőségek nagyon korlátozottak, és a hideg környezetben még az ételek is hamar kihűltek, mire az asztalhoz értünk.\r\nÖsszességében az élmény sajnos inkább kényelmetlen és fárasztó volt, mintsem különleges vagy pihentető. Két csillagot adok, mert az ötlet tényleg jó, és a helyszín is gyönyörű, de a kivitelezés komolyan javításra szorul.', '2025-04-14 18:17:21', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `roomNumber` varchar(25) NOT NULL,
  `floor` tinyint(4) DEFAULT NULL,
  `capacity` tinyint(4) NOT NULL,
  `pricepernight` int(11) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `hotel_id`, `roomNumber`, `floor`, `capacity`, `pricepernight`, `available`) VALUES
(1, 1, 'Alap iglu 1', NULL, 2, 35000, 0),
(2, 1, 'Alap iglu 2', NULL, 2, 45000, 1),
(3, 1, 'Deluxe iglu 1', NULL, 4, 60000, 1),
(4, 1, 'Deluxe iglu 2', NULL, 4, 65000, 1),
(5, 1, 'Deluxe iglu 3', NULL, 5, 80000, 1),
(6, 1, 'Premium iglu', NULL, 2, 60000, 1),
(7, 1, 'Családi iglu', NULL, 6, 75000, 1),
(8, 2, 'Royal Suite 1', 0, 4, 80000, 1),
(9, 2, 'Royal Suite 2', 0, 4, 80000, 1),
(10, 2, 'Royal Suite 3', 0, 4, 80000, 1),
(11, 2, 'Királyi kamra 1', 0, 2, 70000, 1),
(12, 2, 'Királyi kamra 2', 1, 2, 70000, 1),
(13, 2, 'Királyi kamra 3', 1, 2, 70000, 1),
(14, 2, 'Kiránynő szobája 1', 1, 2, 65000, 1),
(15, 2, 'Kiránynő szobája 2', 1, 2, 65000, 1),
(16, 2, 'Kiránynő szobája 3', 2, 2, 65000, 1),
(17, 2, 'Deluxe szoba 1', 2, 3, 75000, 1),
(18, 2, 'Deluxe szoba 2', 2, 3, 75000, 1),
(19, 2, 'Deluxe szoba 3', 2, 3, 75000, 1),
(20, 2, 'Lovagi szállás 1', 3, 4, 85000, 1),
(21, 2, 'Lovagi szállás 2', 3, 4, 85000, 1),
(22, 2, 'Lovagi szállás 3', 3, 4, 85000, 1),
(23, 3, '101', -1, 2, 120000, 1),
(24, 3, '102A', -1, 2, 125000, 1),
(25, 3, '102B', -1, 2, 130000, 1),
(26, 3, '201A', -2, 2, 130000, 1),
(27, 3, '201B', -2, 2, 135000, 1),
(28, 3, '201C', -2, 2, 140000, 1),
(29, 3, '202', -2, 2, 140000, 1),
(30, 3, '301', -3, 2, 145000, 1),
(31, 3, '302', -3, 2, 150000, 1),
(32, 3, '303A', -3, 4, 150000, 1),
(33, 3, '304B', -3, 4, 155000, 1),
(34, 3, '401', -4, 4, 160000, 1),
(35, 3, '402', -4, 4, 160000, 1),
(36, 3, '403A', -4, 4, 165000, 1),
(37, 3, '404B', -4, 4, 170000, 1),
(38, 4, '1. számú kabin', NULL, 2, 75000, 1),
(39, 4, '2. számú kabin', NULL, 2, 80000, 1),
(40, 4, '3. számú kabin', NULL, 3, 90000, 1),
(41, 4, '4. számú kabin', NULL, 3, 95000, 1),
(42, 4, '5. számú kabin', NULL, 4, 105000, 1),
(43, 4, '6. számú kabin', NULL, 4, 110000, 1),
(44, 4, '7. számú kabin', NULL, 2, 75000, 1),
(45, 4, '8. számú kabin', NULL, 2, 80000, 1),
(46, 4, '9. számú kabin', NULL, 3, 85000, 1),
(47, 4, '10. számú kabin', NULL, 4, 100000, 1),
(48, 5, '1. számú kabin', 1, 2, 60000, 1),
(49, 5, '2. számú kabin', 1, 2, 65000, 1),
(50, 5, '3. számú kabin', 1, 3, 70000, 1),
(51, 5, '4. számú kabin', 1, 2, 67000, 1),
(52, 5, '5. számú kabin', 2, 3, 75000, 1),
(53, 5, '6. számú kabin', 2, 4, 80000, 1),
(54, 5, '7. számú kabin', 2, 2, 69000, 1),
(55, 5, '8. számú kabin', 2, 2, 73000, 1),
(56, 5, '9. számú kabin', 3, 3, 80000, 1),
(57, 5, '10. számú kabin', 3, 4, 85000, 1),
(58, 5, '11. számú kabin', 3, 2, 72000, 1),
(59, 5, '12. számú kabin', 3, 3, 77000, 1),
(60, 5, '13. számú kabin', 4, 2, 70000, 1),
(61, 5, '14. számú kabin', 4, 3, 75000, 1),
(62, 5, '15. számú kabin', 4, 4, 85000, 1),
(63, 5, '16. számú kabin', 4, 2, 70000, 1),
(64, 6, '101. szoba', 1, 4, 65000, 1),
(65, 6, '102. szoba', 1, 2, 40000, 1),
(66, 6, '103. szoba', 1, 1, 25000, 1),
(67, 6, '104A. szoba', 1, 3, 45000, 1),
(68, 6, '104B. szoba', 1, 3, 47500, 1),
(69, 6, '201. szoba', 2, 1, 28000, 1),
(70, 6, '202. szoba', 2, 4, 60000, 1),
(71, 6, '203. szoba', 2, 3, 48650, 1),
(72, 6, '204. szoba', 2, 4, 63000, 1),
(73, 6, '205. szoba', 2, 2, 38000, 1),
(74, 6, '301. szoba', 3, 1, 25730, 1),
(75, 6, '302. szoba', 3, 2, 40000, 1),
(76, 6, '303. szoba', 3, 4, 70000, 1),
(77, 6, '304A. szoba', 3, 2, 33000, 1),
(78, 6, '304B. szoba', 3, 4, 62000, 1),
(79, 6, '305. szoba', 3, 6, 115000, 1),
(80, 7, 'Kőszivárvány Szoba 1', 1, 2, 40000, 1),
(81, 7, 'Kőszivárvány Szoba 2', 1, 2, 42000, 1),
(82, 7, 'Barlangi Kényelem 1', 1, 2, 45000, 1),
(83, 7, 'Barlangi Kényelem 2', 1, 2, 45000, 1),
(84, 7, 'Mélységi Nyugalom 1', 1, 2, 48000, 1),
(85, 7, 'Mélységi Nyugalom 2', 1, 2, 48000, 1),
(86, 7, 'Földi Harmónia 1', 2, 2, 40000, 1),
(87, 7, 'Földi Harmónia 2', 2, 2, 42000, 1),
(88, 7, 'Bányász Panoráma 1', 2, 2, 47000, 1),
(89, 7, 'Bányász Panoráma 2', 2, 2, 47000, 1),
(90, 7, 'Ősi Barlang 1', 3, 2, 50000, 1),
(91, 7, 'Ősi Barlang 2', 3, 2, 50000, 1),
(92, 7, 'Kőszikla Lak 1', 3, 3, 55000, 1),
(93, 7, 'Kőszikla Lak 2', 3, 3, 55000, 1),
(94, 7, 'Csendes Mély', 3, 2, 43000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `service`
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
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `hotel_id`, `category_id`, `price`, `available`, `allYear`, `startDate`, `endDate`, `openTime`, `closeTime`) VALUES
(1, 1, 1, 13500, 1, 1, NULL, NULL, '00:00:00', '00:00:00'),
(2, 1, 2, 20000, 1, 1, NULL, NULL, '00:00:00', '00:00:00'),
(3, 1, 9, 8000, 1, 1, NULL, NULL, '07:00:00', '20:00:00'),
(4, 1, 13, 10000, 1, 0, '0100-04-05', '0100-11-30', '00:00:00', '00:00:00'),
(5, 1, 14, 7500, 1, 1, NULL, NULL, '12:00:00', '00:00:00'),
(6, 1, 15, 12500, 1, 0, '0100-12-05', '0100-04-10', '06:00:00', '18:00:00'),
(7, 1, 17, 8000, 1, 1, NULL, NULL, '17:00:00', '19:00:00'),
(8, 2, 1, 16000, 1, 1, NULL, NULL, '00:00:00', '00:00:00'),
(9, 2, 2, 24000, 1, 1, NULL, NULL, '00:00:00', '00:00:00'),
(10, 2, 3, 2500, 1, 1, NULL, NULL, '00:00:00', '00:00:00'),
(11, 2, 4, 7000, 1, 0, '0100-05-30', '0100-09-15', '07:30:00', '21:00:00'),
(12, 2, 7, 4000, 1, 1, NULL, NULL, '07:30:00', '23:00:00'),
(13, 2, 16, 8750, 1, 1, NULL, NULL, '18:00:00', '21:00:00'),
(14, 2, 17, 10000, 1, 1, NULL, NULL, '14:00:00', '15:00:00'),
(15, 3, 1, 15000, 1, 1, NULL, NULL, '00:00:00', '00:00:00'),
(16, 3, 2, 24750, 1, 1, NULL, NULL, '00:00:00', '00:00:00'),
(17, 3, 3, 4500, 1, 1, NULL, NULL, '00:00:00', '00:00:00'),
(18, 3, 4, 5000, 1, 1, NULL, NULL, '00:00:00', '00:00:00'),
(19, 3, 5, 4500, 1, 1, NULL, NULL, '10:00:00', '20:00:00'),
(20, 3, 7, 4000, 1, 1, NULL, NULL, '06:00:00', '20:00:00'),
(21, 3, 10, 8000, 1, 1, NULL, NULL, '00:00:00', '00:00:00'),
(22, 3, 18, 17500, 1, 0, '0100-10-01', '0100-04-20', '14:00:00', '18:00:00'),
(23, 4, 1, 20000, 1, 1, NULL, NULL, '00:00:00', '00:00:00'),
(24, 4, 2, 27500, 1, 1, NULL, NULL, '00:00:00', '00:00:00'),
(25, 4, 19, 22000, 1, 1, NULL, NULL, '13:00:00', '16:00:00'),
(26, 4, 20, 17500, 1, 0, '0100-03-12', '0100-10-24', '08:00:00', '19:00:00'),
(27, 5, 1, 12000, 1, 1, NULL, NULL, '00:00:00', '00:00:00'),
(28, 5, 2, 19000, 1, 1, NULL, NULL, '00:00:00', '00:00:00'),
(29, 5, 5, 4000, 1, 1, NULL, NULL, '13:30:00', '20:00:00'),
(30, 5, 6, 2500, 1, 1, NULL, NULL, '09:00:00', '21:30:00'),
(31, 5, 21, 8500, 1, 1, NULL, NULL, '14:00:00', '15:00:00'),
(32, 6, 1, 15000, 1, 1, NULL, NULL, '00:00:00', '00:00:00'),
(33, 6, 2, 25000, 1, 1, NULL, NULL, '00:00:00', '00:00:00'),
(34, 6, 6, 5000, 1, 1, NULL, NULL, '07:00:00', '21:00:00'),
(35, 6, 8, 7500, 1, 1, NULL, NULL, '10:00:00', '20:00:00'),
(36, 6, 9, 8000, 1, 1, NULL, NULL, '07:30:00', '20:00:00'),
(37, 6, 11, 10000, 1, 1, NULL, NULL, '00:00:00', '00:00:00'),
(38, 7, 1, 12000, 1, 1, NULL, NULL, '00:00:00', '00:00:00'),
(39, 7, 2, 17500, 1, 1, NULL, NULL, '00:00:00', '00:00:00'),
(40, 7, 4, 5000, 1, 0, '0100-04-14', '0100-09-15', '11:00:00', '20:00:00'),
(41, 7, 5, 6000, 1, 1, NULL, NULL, '17:00:00', '01:00:00'),
(42, 7, 22, 17500, 1, 1, NULL, NULL, '14:00:00', '16:00:00'),
(43, 7, 23, 9000, 1, 1, NULL, NULL, '18:00:00', '20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `servicecategory`
--

CREATE TABLE `servicecategory` (
  `serviceCategory_id` int(11) NOT NULL,
  `serviceName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `servicecategory`
--

INSERT INTO `servicecategory` (`serviceCategory_id`, `serviceName`) VALUES
(1, 'Félpanzió'),
(2, 'Teljes ellátás'),
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
-- Table structure for table `user`
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
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `lastName`, `firstName`, `birthDate`, `phonenumber`, `email`, `password`, `created_at`, `updated_at`, `active`, `profilePic`) VALUES
(1, 'Misike28', 'Kovács', 'Mihály Dániel', '2024-05-17', '+36709477699', 'Szekelymegafia@freemail.com', '$2y$12$U.6/gsWyUXQkxD2TSibXne5OqQ1lPVKJ2oYu5FXgX6KeA89td3ffy', '2025-02-24 09:55:37', '2025-03-05 15:52:24', 1, 1),
(2, 'Gyuszi', 'Molnár', 'Gyula Dániel', '1982-06-17', '+36307675240', 'gyula_molnar@hotmail.com', '$2y$12$ldDrheSUdRZMXSEi.hJ.3.qb/76.OZ70ON8zHgBSoRmEglh9RHLHK', '2025-02-24 11:10:34', '2025-03-31 09:55:11', 1, 5),
(3, 'Mikudayoo', 'Hatsune', 'Miku', '2007-08-31', '+36701234567', 'hatsunemiku@vocaloid.com', '$2y$12$LQyV6fWT83nezYRP53EPDO6aiXmFzA0zHj6uYFzzs/rWWb1BwJrdW', '2025-03-05 16:37:16', '2025-03-05 16:37:52', 1, 2),
(4, 'Ila68', 'Kiss', 'Ilona', '2015-10-30', '+36205126141', 'jarfasila68@hotmail.com', '$2y$12$.qAyWsqzqtHgSY47KmxP8umE9/8dQm/jrlXpDxG1FfJdXdPlCU5dm', '2025-03-05 16:48:31', '2025-03-05 16:52:06', 0, 4),
(5, 'Vajdani', 'Vajda', 'Dániel', '2006-05-19', '+36201111111', 'vajda.daniel@valami.com', '$2y$12$Rm8jQoZqrkUJBcx40wD80.y5FNaOYD0eO/GfBWKBZiIOWNq77uhpG', '2025-03-05 16:53:08', '2025-04-04 12:13:30', 1, 2),
(6, 'horvathAti', 'Dr.', 'Horváth Attila', '1980-04-01', '+36307672240', 'horvath.attila@verebelyszki.hu', '$2y$12$aZDS/wu./xR5FRm9.OC52uYh8AMN4ANxPG4WK72SwSiv0E.1kzZPO', '2025-03-17 11:05:58', '2025-03-17 11:13:15', 1, 1),
(7, 'Tulaj', 'Lakatos', 'István', '1969-08-06', '+36201111112', 'boss@gmail.com', '$2y$12$ChUtVpaPJbIrYSD9qIDw8eXDyqvkB60I7CQxSdqqrSVsfGfaaE1v.', '2025-03-20 09:02:09', '2025-03-20 09:02:09', 1, 0),
(8, 'CzarTwinkle', 'Szőke', 'Vivien', '2025-03-24', '+36701111111', 'some@email1.com', '$2y$12$Rm8jQoZqrkUJBcx40wD80.y5FNaOYD0eO/GfBWKBZiIOWNq77uhpG', '2025-03-24 00:00:00', '2025-03-24 00:00:00', 1, 7),
(9, 'Ryrgeldosand', 'Pál', 'Zsombor Imre', '2025-03-24', '+36701111112', 'some@email2.com', '$2y$12$Rm8jQoZqrkUJBcx40wD80.y5FNaOYD0eO/GfBWKBZiIOWNq77uhpG', '2025-03-24 00:00:00', '2025-03-24 00:00:00', 1, 6),
(10, 'Canosher', 'Mészáros', 'Izabella Dorottya', '2025-03-24', '+36701111113', 'some@email3.com', '$2y$12$Rm8jQoZqrkUJBcx40wD80.y5FNaOYD0eO/GfBWKBZiIOWNq77uhpG', '2025-03-24 00:00:00', '2025-03-24 00:00:00', 1, 0),
(11, 'Xpes', 'Kocsis', 'Nikoletta Borbála', '2025-03-24', '+36701111114', 'some@email4.com', '$2y$12$Rm8jQoZqrkUJBcx40wD80.y5FNaOYD0eO/GfBWKBZiIOWNq77uhpG', '2025-03-24 00:00:00', '2025-03-24 00:00:00', 1, 6),
(12, 'Fairyonal', 'Nemes', 'Kálmán', '2025-03-24', '+36701111115', 'some@email5.com', '$2y$12$Rm8jQoZqrkUJBcx40wD80.y5FNaOYD0eO/GfBWKBZiIOWNq77uhpG', '2025-03-24 00:00:00', '2025-03-24 00:00:00', 1, 0),
(13, 'Mythio', 'Fekete', 'György', '2025-03-24', '+36701111116', 'some@email6.com', '$2y$12$Rm8jQoZqrkUJBcx40wD80.y5FNaOYD0eO/GfBWKBZiIOWNq77uhpG', '2025-03-24 00:00:00', '2025-03-24 00:00:00', 1, 5),
(14, 'Wittyna', 'Váradi', 'Nóra Dorina', '2025-03-24', '+36701111117', 'some@email7.com', '$2y$12$Rm8jQoZqrkUJBcx40wD80.y5FNaOYD0eO/GfBWKBZiIOWNq77uhpG', '2025-03-24 00:00:00', '2025-03-24 00:00:00', 1, 1),
(15, 'Komunisti', 'Borbély', 'Katalin Laura', '2025-03-28', '+36702222221', 'some_other@email1.com', '$2y$12$Rm8jQoZqrkUJBcx40wD80.y5FNaOYD0eO/GfBWKBZiIOWNq77uhpG', '2025-03-28 00:00:00', '2025-03-28 00:00:00', 1, 0),
(16, 'Sardiden', 'Váradi', 'Milán', '2025-03-28', '+36702222222', 'some_other@email2.com', '$2y$12$Rm8jQoZqrkUJBcx40wD80.y5FNaOYD0eO/GfBWKBZiIOWNq77uhpG', '2025-03-28 00:00:00', '2025-03-28 00:00:00', 1, 7),
(17, 'Gurlinue', 'Illés', 'Zalán', '2025-03-28', '+36702222223', 'some_other@email3.com', '$2y$12$Rm8jQoZqrkUJBcx40wD80.y5FNaOYD0eO/GfBWKBZiIOWNq77uhpG', '2025-03-28 00:00:00', '2025-03-28 00:00:00', 1, 1),
(18, 'Hartia', 'Virág', 'Roland', '2025-03-28', '+36702222224', 'some_other@email4.com', '$2y$12$Rm8jQoZqrkUJBcx40wD80.y5FNaOYD0eO/GfBWKBZiIOWNq77uhpG', '2025-03-28 00:00:00', '2025-03-28 00:00:00', 1, 3),
(19, 'Bancaja', 'Székely', 'Beatrix', '2025-03-28', '+36702222225', 'some_other@email5.com', '$2y$12$Rm8jQoZqrkUJBcx40wD80.y5FNaOYD0eO/GfBWKBZiIOWNq77uhpG', '2025-03-28 00:00:00', '2025-03-28 00:00:00', 1, 3),
(20, 'Nostrik', 'Barta', 'Bence', '2025-03-28', '+36702222226', 'some_other@email6.com', '$2y$12$Rm8jQoZqrkUJBcx40wD80.y5FNaOYD0eO/GfBWKBZiIOWNq77uhpG', '2025-03-28 00:00:00', '2025-03-28 00:00:00', 1, 6),
(21, 'Polymax', 'Szücs', 'Ottó', '2025-03-28', '+36702222227', 'some_other@email7.com', '$2y$12$Rm8jQoZqrkUJBcx40wD80.y5FNaOYD0eO/GfBWKBZiIOWNq77uhpG', '2025-03-28 00:00:00', '2025-03-28 00:00:00', 1, 5),
(22, 'Gyuszika', 'Horváth', 'Mihály', '2004-01-23', '+36307675340', 'asd@sjlkdjad.ca', '$2y$12$n.RKQI5FFzN.HUwwsVyDKe7W.Ue0x8H69c.O9/JEXbnkoceiJ8kj.', '2025-03-31 10:00:03', '2025-03-31 10:03:26', 0, 0),
(23, 'Skeyestu', 'Hegedűs', 'Barnabás', '1998-03-07', '+36703849364', 'bHegedu@gmail.com', '$2y$12$9kmjFJeNcLrKf6gbDx6jour7eil7.CMIRt67Ic6WD6OI8HtjJMG2W', '2025-04-04 12:29:43', '2025-04-04 12:29:43', 1, 6),
(24, 'Vensumer', 'Bálint', 'Iván Zsombor', '1980-06-26', '+36408473847', 'bivanz@citromail.hu', '$2y$12$df4KDzw.qQdcEJ9WzvjgqONPy5Ai.IRJ.8YICYgot8.nXUy/jaD9O', '2025-04-04 12:33:28', '2025-04-04 12:33:28', 1, 2),
(25, 'Ditechan', 'Balázs', 'Adrián Milán', '2005-07-19', '+36208469385', 'milchan@gmail.com', '$2y$12$lUL0GWklSKr49VauZBAxGu5tYN9vKnj2Znw9igIDB7FPEHgQrOoVu', '2025-04-04 12:34:31', '2025-04-04 12:34:31', 1, 5),
(26, 'Gingeric', 'Bogdán', 'Renáta Regina', '2006-09-24', '+36709368285', 'gingerina@protonmail.com', '$2y$12$yJzk.KicDGWBNyI0kPMTNeYrW9qC7xY1xUJ8g6OlOaW7SygrU95Xu', '2025-04-04 12:36:50', '2025-04-04 12:36:50', 1, 0),
(27, 'Xoserna', 'Váradi', 'Aranka', '2003-12-09', '+36706496492', 'xoserna@gmail.com', '$2y$12$ZcnobFNDlkqaLC68zOC5DulyhJp0vstKbtHsLK.UepEBs7Oj8qiLS', '2025-04-04 12:38:39', '2025-04-04 12:38:39', 1, 4),
(28, '2cool2Spyder', 'Pál', 'Sándor', '1994-04-29', '+36708358263', 'spyderpal@protonmail.com', '$2y$12$rw4pgCaaQpWqn04IN5NVXuC.6f4Bn7nrlVIfSDTaKOutwaGr0tyF6', '2025-04-04 12:40:21', '2025-04-04 12:40:21', 1, 7),
(29, 'Vestriv', 'Tóth', 'Ottó', '2001-01-05', '+36208468365', 'vestriv@gmail.com', '$2y$12$K4NFp4om7A4ys89on3s6XeZihf7N5zxpsAwsBLYkTPRumvfFfqioi', '2025-04-04 12:43:10', '2025-04-04 12:43:10', 1, 3),
(30, 'ThedevilSkate', 'Szabó', 'Ervin', '2005-08-25', '+36708452938', 'skatedevil666@citromail.hu', '$2y$12$vC8O31RNaQp/zZ0Xhdp./uaYgnmo1ad49uv6W1/M/JBC7fQvAMAZW', '2025-04-04 12:45:13', '2025-04-04 12:45:13', 1, 1),
(31, 'Interon', 'Mészáros', 'Márta Ibolya', '1970-07-07', '+36208469294', 'interon34283@gmail.com', '$2y$12$dx7SuxpseSnaaAdBR.uajuIYp/M48fkMLQfAtB3E7AN2pqmgHla/S', '2025-04-04 12:47:18', '2025-04-04 12:47:18', 1, 0),
(32, 'Kixan', 'Bodnár', 'Dominik Győző', '2003-02-28', '+36708347733', 'kix__@protonmail.com', '$2y$12$0jh2/eQvDarYSGeLBddY9.HaT4IPn98HbydwGDpa2hHEpDF86Meu2', '2025-04-04 12:48:30', '2025-04-04 12:48:30', 1, 6),
(33, 'Dragon286', 'Kiss', 'Barnabás', '2003-07-21', '+368579283', 'barnobruno@hotmail.com', '$2y$12$6f1m8o0P5h/7594H.BaD7uRn0oSx35dgsQ22Iw9gBAU.HZ2b37cby', '2025-04-04 12:57:43', '2025-04-04 12:57:43', 1, 2),
(34, 'Gubacs_mester', 'Kresz', 'Vince', '2005-04-12', '+368579253', 'Gubi@gmail.com', '$2y$12$MhlDFc7DhSKReV9RqFYVmeWqPzKKQBm.P.d8GZ/95/Niyel.of/pu', '2025-04-04 12:58:24', '2025-04-04 12:58:24', 1, 6),
(35, 'Kecifei', 'Bánki', 'Gábor', '2005-08-13', '+368578582', 'Bgabor@freemail.hu', '$2y$12$k1hIkFXZ23ezqy.t.UNXZeRvaZLJ8IHNpprj9IP.sNz1J.yqjrQwW', '2025-04-04 12:59:05', '2025-04-04 12:59:05', 1, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`billing_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`,`room_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD KEY `hotel_id` (`hotel_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`hotel_id`),
  ADD KEY `city_id` (`city_id`) USING BTREE;

--
-- Indexes for table `loyalty`
--
ALTER TABLE `loyalty`
  ADD PRIMARY KEY (`loyalty_id`),
  ADD KEY `rank_id` (`rank_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `loyaltyrank`
--
ALTER TABLE `loyaltyrank`
  ADD PRIMARY KEY (`rank_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`,`hotel_id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `hotel_id` (`hotel_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `servicecategory`
--
ALTER TABLE `servicecategory`
  ADD PRIMARY KEY (`serviceCategory_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `billing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `hotel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `loyalty`
--
ALTER TABLE `loyalty`
  MODIFY `loyalty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `loyaltyrank`
--
ALTER TABLE `loyaltyrank`
  MODIFY `rank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `servicecategory`
--
ALTER TABLE `servicecategory`
  MODIFY `serviceCategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billing`
--
ALTER TABLE `billing`
  ADD CONSTRAINT `billing_ibfk_1` FOREIGN KEY (`billing_id`) REFERENCES `booking` (`booking_id`);

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`);

--
-- Constraints for table `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `hotel_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`);

--
-- Constraints for table `loyalty`
--
ALTER TABLE `loyalty`
  ADD CONSTRAINT `loyalty_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `loyalty_ibfk_2` FOREIGN KEY (`rank_id`) REFERENCES `loyaltyrank` (`rank_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`);

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `servicecategory` (`serviceCategory_id`),
  ADD CONSTRAINT `service_ibfk_2` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
