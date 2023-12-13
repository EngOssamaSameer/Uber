-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2023 at 12:22 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uber`
--

-- --------------------------------------------------------

--
-- Table structure for table `avalaibledriver`
--

CREATE TABLE `avalaibledriver` (
  `driverId` int(11) NOT NULL,
  `driverCase` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `avalaibledriver`
--

INSERT INTO `avalaibledriver` (`driverId`, `driverCase`) VALUES
(24, 1),
(26, 1),
(25, 1),
(27, 1),
(12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `userId` int(11) NOT NULL,
  `model` varchar(30) NOT NULL,
  `caeNumber` varchar(30) NOT NULL,
  `CaeKind` varchar(30) NOT NULL,
  `carImage` varchar(60) DEFAULT NULL,
  `fair` int(10) DEFAULT NULL,
  `cas` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`userId`, `model`, `caeNumber`, `CaeKind`, `carImage`, `fair`, `cas`) VALUES
(15, 'BMW', '189 | KG', 'Car', '../images/08-48-39IMG20210204171845.jpg', 11, 0),
(17, 'Uber Model', '123 | ABC', 'CAR', '../images/defaultCar.png', 11, 0),
(26, 'MG', '889 | SER', '', '../images/09-51-08carGraphic.jpeg', 11, 0),
(27, 'Uber Model', '123 | ABC', 'CAR', '../images/09-50-01kiacarjpeg.jpeg', 11, 0),
(24, 'Minivan', '111 | FG', 'Jeep', '../images/05-56-58careee.png', 11, 0),
(29, 'Ampere', '156 | G', 'Scooter', '../images/11-20-31scooterjpeg.jpeg', 11, 0),
(32, 'BMW', 'ERT | 125', 'Car', '../images/03-00-33BMWCar.jpg', 250, 0),
(12, 'PTg', '18 | PT', 'Moto', '../images/03-18-47moto.jpg', 23, 0),
(36, 'Mercedes-Benz', '123 | WH', 'Car', '../images/02-43-05mecedesBenz.jpeg', 120, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cash`
--

CREATE TABLE `cash` (
  `cashId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `funds` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cash`
--

INSERT INTO `cash` (`cashId`, `userId`, `funds`) VALUES
(1, 27, 29),
(2, 28, 2200),
(3, 9, 19),
(4, 31, 15),
(5, 32, 0),
(6, 24, 77),
(7, 11, 999),
(8, 29, 19),
(9, 33, 1),
(10, 14, 123),
(11, 34, 1040),
(12, 35, 56),
(13, 36, 125),
(14, 37, 0);

-- --------------------------------------------------------

--
-- Table structure for table `driverava`
--

CREATE TABLE `driverava` (
  `driverId` int(11) NOT NULL,
  `cas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driverava`
--

INSERT INTO `driverava` (`driverId`, `cas`) VALUES
(27, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kindofrent`
--

CREATE TABLE `kindofrent` (
  `kindOfRentId` int(11) NOT NULL,
  `kindOfRentName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kindofrent`
--

INSERT INTO `kindofrent` (`kindOfRentId`, `kindOfRentName`) VALUES
(1, 'bike'),
(2, 'scooter'),
(3, 'care');

-- --------------------------------------------------------

--
-- Table structure for table `market`
--

CREATE TABLE `market` (
  `marketId` int(11) NOT NULL,
  `marketName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `market`
--

INSERT INTO `market` (`marketId`, `marketName`) VALUES
(1, 'KFC'),
(2, ' Wally El Sham'),
(3, 'Bazooka'),
(4, 'Burger Cheese'),
(5, 'Heind'),
(6, 'MAC'),
(7, 'LGH'),
(29, 'Hekaya'),
(30, 'DOOM');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `marketId` int(11) NOT NULL,
  `item` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `menuId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`marketId`, `item`, `price`, `menuId`) VALUES
(1, 'BOX', 55, 26),
(29, 'Crip', 32, 27),
(29, 'KONA c', 88, 28);

-- --------------------------------------------------------

--
-- Table structure for table `notifi`
--

CREATE TABLE `notifi` (
  `userId` int(11) NOT NULL,
  `description` varchar(120) NOT NULL,
  `date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifi`
--

INSERT INTO `notifi` (`userId`, `description`, `date`) VALUES
(17, 'You changed your Password in 5:55 1/1/200', '06-54-20'),
(17, 'You Ordered a rent 1 in 9:10 2/1/2023', '06-54-20'),
(17, 'You uploaded a new photo in 10:10 2/1/2023', '06-54-20'),
(22, 'You changed your Password in 15:55 1/1/200', '06-54-20'),
(22, 'You Ordered a rent 18 in 9:10 2/1/2023', '06-54-20'),
(20, 'You Ordered a rent 31 in 11:10 2/1/2023', '06-54-20'),
(20, 'You are updated your profile info', '23-04-25-07-15'),
(20, 'You are updated your profile info', '23-04-25-07-16'),
(17, 'You are updated your profile info', '23-04-25-07-17'),
(17, 'You are uploaded a new photo', '23-04-25-07-28'),
(17, 'You are changed password', '23-04-25-07-32'),
(17, 'You are updated your profile info', '23-04-25-07-48'),
(17, 'You are uploaded a new photo', '23-04-25-08-04'),
(22, 'You are uploaded a new photo', '23-04-25-08-06'),
(22, 'You are uploaded a new photo', '23-04-25-08-06'),
(22, 'You are updated your profile info', '23-04-25-08-07'),
(16, 'You are uploaded a new photo', '23-04-25-03-23'),
(23, 'You are uploaded a new photo', '23-04-25-04-15'),
(21, 'You are uploaded a new photo', '23-04-25-06-11'),
(15, 'You are uploaded a new photo', '23-04-25-06-26'),
(15, 'You are uploaded a new photo', '23-04-25-08-11'),
(25, 'You are uploaded a new photo', '23-04-25-08-32'),
(25, 'You are uploaded a new photo', '23-04-25-08-32'),
(25, 'You are uploaded a new photo for Car info', '23-04-25-08-41'),
(25, 'You are uploaded a new photo for Car info', '23-04-25-08-42'),
(15, 'You are uploaded a new photo for Car info', '23-04-25-08-48'),
(25, 'You are uploaded a new photo for Car info', '23-04-25-09-34'),
(25, 'You are uploaded a new photo for Car info', '23-04-25-09-34'),
(25, 'You are uploaded a new photo for Car info', '23-04-25-09-35'),
(25, 'You are uploaded a new photo for Car info', '23-04-25-09-35'),
(25, 'You are uploaded a new photo for Car info', '23-04-25-09-36'),
(25, 'You are uploaded a new photo for Car info', '23-04-25-09-36'),
(27, 'You are uploaded a new photo for Car info', '23-04-25-09-37'),
(27, 'You are uploaded a new photo for Car info', '23-04-25-09-50'),
(28, 'You are uploaded a new photo', '23-04-25-10-14'),
(24, 'You are updated your car info', '23-04-25-10-34'),
(24, 'You are updated your car info', '23-04-25-10-38'),
(24, 'You are updated your car info', '23-04-25-10-39'),
(29, 'You are uploaded a new photo for Car info', '23-04-25-11-20'),
(29, 'You are updated your car info', '23-04-25-11-21'),
(29, 'You are uploaded a new photo', '23-04-25-11-22'),
(9, 'You are updated your profile info', '23-04-25-11-25'),
(9, 'You are changed password', '23-04-25-11-27'),
(9, 'You are changed password', '23-04-25-11-33'),
(9, 'You are uploaded a new photo', '23-04-25-11-37'),
(9, 'You are uploaded a new photo', '23-04-25-11-37'),
(16, 'Ammar', '23-04-26-12-12'),
(17, 'Ammar', '23-04-26-12-12'),
(17, 'Ammar', '23-04-26-12-12'),
(17, 'Ammar', '23-04-26-12-13'),
(22, 'Ammar', '23-04-26-12-17'),
(22, 'Ammar', '23-04-26-12-17'),
(23, 'Ammar', '23-04-26-12-17'),
(28, 'You are uploaded a new photo', '23-04-26-12-18'),
(28, 'You are uploaded a new photo', '23-04-26-12-24'),
(9, 'You are updated your profile info', '23-04-26-01-04'),
(31, 'You added many to yuor balance ', '01-36-05'),
(31, 'You added many to yuor balance ', '01-38-17'),
(31, 'You are uploaded a new photo', '23-05-02-02-05'),
(31, 'You are uploaded a new photo', '23-05-02-02-06'),
(31, 'You are uploaded a new photo', '23-05-02-02-07'),
(31, 'You are uploaded a new photo', '23-05-02-02-08'),
(31, 'You are uploaded a new photo', '23-05-02-02-09'),
(31, 'You are uploaded a new photo', '23-05-02-02-09'),
(31, 'You are uploaded a new photo', '23-05-02-02-10'),
(31, 'You are uploaded a new photo', '23-05-02-02-10'),
(31, 'You are uploaded a new photo', '23-05-02-02-11'),
(31, 'You are uploaded a new photo', '23-05-02-02-20'),
(31, 'You are uploaded a new photo', '23-05-02-02-22'),
(31, 'You are uploaded a new photo', '23-05-02-02-36'),
(31, 'You are uploaded a new photo', '23-05-02-02-40'),
(32, 'You are updated your car info', '23-05-02-02-58'),
(32, 'You are uploaded a new photo for Car info', '23-05-02-03-00'),
(32, 'You are uploaded a new photo', '23-05-02-03-01'),
(21, 'You are uploaded a new photo for Car info', '23-05-02-03-15'),
(21, 'You are uploaded a new photo for Car info', '23-05-02-03-15'),
(21, 'You are uploaded a new photo for Car info', '23-05-02-03-15'),
(21, 'You are uploaded a new photo for Car info', '23-05-02-03-15'),
(12, 'You are uploaded a new photo for Car info', '23-05-02-03-16'),
(12, 'You are uploaded a new photo for Car info', '23-05-02-03-18'),
(12, 'You are updated your car info', '23-05-02-03-19'),
(12, 'You are uploaded a new photo', '23-05-02-03-40'),
(12, 'You are updated your profile info', '23-05-02-03-41'),
(12, 'You are updated your profile info', '23-05-02-03-41'),
(24, 'You are updated your profile info', '23-05-02-05-55'),
(24, 'You are uploaded a new photo for Car info', '23-05-02-05-56'),
(33, 'You added many to yuor balance ', '07-04-33'),
(33, 'You are uploaded a new photo', '23-05-03-07-05'),
(33, 'You are updated your profile info', '23-05-03-07-06'),
(14, 'You added many to yuor balance ', '07-18-35'),
(34, 'You added many to yuor balance ', '07-21-22'),
(26, 'You are uploaded a new photo', '23-05-06-05-38'),
(31, 'You added many to yuor balance ', '05-47-10'),
(35, 'You added many to yuor balance ', '02-34-17'),
(36, 'You are updated your car info', '23-05-08-02-41'),
(36, 'You are uploaded a new photo for Car info', '23-05-08-02-43'),
(34, 'You added many to yuor balance ', '06-21-11'),
(34, 'You added many to yuor balance ', '06-21-25');

-- --------------------------------------------------------

--
-- Table structure for table `profilephoto`
--

CREATE TABLE `profilephoto` (
  `userId` int(11) NOT NULL,
  `photo` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profilephoto`
--

INSERT INTO `profilephoto` (`userId`, `photo`) VALUES
(17, '\"D:\\Ossama\\my photos\\00000PORTRAIT_00000_BURST20220809131632933.jpg\"');

-- --------------------------------------------------------

--
-- Table structure for table `rentcase`
--

CREATE TABLE `rentcase` (
  `rentCaseId` int(11) NOT NULL,
  `rentCaseName` varchar(33) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rentcase`
--

INSERT INTO `rentcase` (`rentCaseId`, `rentCaseName`) VALUES
(1, 'Available'),
(2, 'Unvailable');

-- --------------------------------------------------------

--
-- Table structure for table `rents`
--

CREATE TABLE `rents` (
  `rentId` int(11) NOT NULL,
  `rentPrice` int(11) NOT NULL,
  `rentKind` int(11) NOT NULL,
  `rentCase` int(11) NOT NULL,
  `rentUserName` varchar(30) NOT NULL,
  `rentUserEmail` varchar(30) NOT NULL,
  `userId` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rents`
--

INSERT INTO `rents` (`rentId`, `rentPrice`, `rentKind`, `rentCase`, `rentUserName`, `rentUserEmail`, `userId`) VALUES
(4, 805, 3, 2, 'Ola', 'Ola@eg.com', 31),
(5, 58, 1, 2, 'Ola', 'Ola@eg.com', 31),
(6, 556, 3, 1, 'null', 'null', NULL),
(7, 188, 2, 1, 'null', 'null', NULL),
(8, 111, 2, 1, 'null', 'null', NULL),
(9, 66, 2, 1, 'null', 'null', NULL),
(10, 555, 1, 1, 'null', 'null', NULL),
(11, 1566, 1, 1, 'null', 'null', NULL),
(12, 1566, 1, 1, 'null', 'null', NULL),
(13, 0, 1, 1, 'null', 'null', NULL),
(14, 111, 1, 1, 'null', 'null', NULL),
(15, 111, 1, 1, 'null', 'null', NULL),
(16, 111, 1, 1, 'null', 'null', NULL),
(17, 0, 1, 1, 'null', 'null', NULL),
(21, 11, 3, 1, 'null', 'null', NULL),
(22, 5555, 2, 1, 'null', 'null', NULL),
(23, 200, 3, 1, 'null', 'null', NULL),
(24, 100, 2, 1, 'null', 'null', NULL),
(25, 1000, 1, 1, 'null', 'null', NULL),
(26, 999, 1, 1, 'null', 'null', NULL),
(27, 500, 1, 1, 'null', 'null', NULL),
(28, 300, 1, 1, 'null', 'null', NULL),
(29, 120, 2, 1, 'null', 'null', NULL),
(30, 89, 2, 1, 'null', 'null', NULL),
(31, 996, 3, 1, 'null', 'null', NULL),
(32, 50, 3, 1, 'null', 'null', NULL),
(33, 20, 2, 1, 'null', 'null', NULL),
(34, 99, 2, 1, 'null', 'null', NULL),
(35, 66, 1, 1, 'null', 'null', NULL),
(36, 89, 2, 1, 'null', 'null', NULL),
(37, 89, 2, 1, 'null', 'null', NULL),
(38, 10, 2, 2, 'Mohamed', 'mohamed@archo.cairo.edu.eg', 33),
(39, 33, 2, 1, 'null', 'null', NULL),
(40, 56, 3, 1, 'null', 'null', NULL),
(41, 44, 2, 1, 'null', 'null', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `requestorder`
--

CREATE TABLE `requestorder` (
  `orderId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `userEmail` varchar(20) NOT NULL,
  `address` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `market` varchar(20) NOT NULL,
  `item` varchar(20) NOT NULL,
  `case` int(11) NOT NULL,
  `driverId` int(11) NOT NULL,
  `cash` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requesttrip`
--

CREATE TABLE `requesttrip` (
  `requestTrip` int(11) NOT NULL,
  `passengerId` int(11) NOT NULL,
  `driverId` int(11) NOT NULL,
  `pickup` varchar(30) NOT NULL,
  `drop` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `payment` varchar(30) NOT NULL,
  `cash` int(11) NOT NULL,
  `sDate` datetime DEFAULT NULL,
  `eDate` datetime DEFAULT NULL,
  `cas` int(10) DEFAULT NULL,
  `totalFair` int(11) NOT NULL,
  `driverName` varchar(30) NOT NULL,
  `driverPhone` varchar(30) NOT NULL,
  `carInfo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requesttrip`
--

INSERT INTO `requesttrip` (`requestTrip`, `passengerId`, `driverId`, `pickup`, `drop`, `name`, `phone`, `payment`, `cash`, `sDate`, `eDate`, `cas`, `totalFair`, `driverName`, `driverPhone`, `carInfo`) VALUES
(14, 31, 29, 'el Shobak', 'dddd', 'Ossama Samir Abdel Moneim', '01143633027', 'Wallet', 11, '2023-05-06 05:41:40', '0000-00-00 00:00:00', 3, 0, '', '', ''),
(31, 34, 26, 'Helwan', 'Gezira', 'Omr Ali Heaba', '01143633027', 'Wallet', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '', '', ''),
(32, 34, 27, 'Helwan', 'Gezira', 'Omr Ali Heaba', '01143633027', 'Wallet', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '', '', ''),
(33, 31, 17, 'ee', 'ee', 'eeeeeeeeeee', 'e', 'Cash', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '', '', ''),
(34, 31, 36, 'ww', 'ww', 'omina', '123456', 'Cash', 120, '2023-05-09 12:16:12', '2023-05-09 12:16:17', 4, 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roleId` int(11) NOT NULL,
  `roleName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleId`, `roleName`) VALUES
(1, 'admin'),
(2, 'driver'),
(3, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `q1` varchar(22) NOT NULL,
  `q2` varchar(22) NOT NULL,
  `q3` varchar(22) NOT NULL,
  `q4` varchar(22) NOT NULL,
  `q5` varchar(22) NOT NULL,
  `q6` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`q1`, `q2`, `q3`, `q4`, `q5`, `q6`) VALUES
('6', ' 34', '1124', '36', '50', '10');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userEmail` varchar(30) NOT NULL,
  `userPhone` varchar(30) NOT NULL,
  `userPassowrd` varchar(30) NOT NULL,
  `userRoleId` int(11) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT 1.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `userName`, `userEmail`, `userPhone`, `userPassowrd`, `userRoleId`, `image`, `rate`) VALUES
(2, 'ali sayed HEABA', 'aly_sayed@org.com', '01289116925', '999', 3, '00000IMG_00000_BURST20220809131640340_COVER.jpg', 3.00),
(9, 'Ossama Samir', 'ossamasamir.work@gmail.cocm', '01014435698', '145', 1, '../images/11-37-40IMG20210225133911.jpg', 3.00),
(11, 'AYA ', 'aya@org.com', '01289116925', '123', 3, '../images/05-39-58FB_IMG_1659093655171.jpg', 3.00),
(12, 'Eng:Ossama Samir', 'ossamasamir@org.com', '01211584150', '111', 2, '../images/03-40-19IMG20220630203622.jpg', 3.00),
(14, 'Islam Mansour', 'isalam@org.eg', 'isalam@org.eg', '123', 3, NULL, 3.00),
(15, 'Kadre Samir', 'kadre@org.com', 'kadre@org.com', '123', 2, '../images/08-11-12IMG_20210730_153359.jpg', 3.00),
(16, 'Essraa', 'Essraa@fcai-hu.edue.eg', '01211584150', '123', 3, '../images/03-23-21IMG_٢٠٢٠١١٠٧_١١١٩٤٩.jpg', 3.00),
(17, 'ABDOO', 'abdo@yahoo.com', '0111111111111', '123', 3, '../images/08-04-2220221129_115311_811.jpg', 5.00),
(19, 'Hazeem Mohamed Omran', 'hazeem@yahoo.com', '0111111111111', '123', 3, '../images/05-51-009e111260-70dd-4bf6-9b9d-7f6c2050', 3.00),
(20, 'nada', 'nada@fcai.edu.eg', '01236547789', '123', 3, '../../view/images/R.png', 3.00),
(21, 'Shuraq ', 'shuraq@fcai.edu.eg', 'shuraq@fcai.edu.eg', '123', 2, '../images/06-11-32IMG_٢٠٢٠١١٠٧_١١١٩٤٩.jpg', 3.00),
(22, 'OsOs', 'ossamasamir.work@gmail.com', '0111111111111', '123', 3, '../images/08-06-57IMG_20210730_153359.jpg', 3.00),
(23, 'Shakeer', 'nour@gmail.com', 'nour@gmail.com', '123', 3, '../images/04-15-48IMG20210204171845.jpg', 3.00),
(24, 'Mansour', 'isalam_mansour@gmail.com', '12365479', '123', 2, '../images/05-16-37IMG20210101170808.jpg', 3.00),
(25, 'Hany', 'hany@org.com', 'hany@org.com', '123', 2, '../images/08-32-47IMG_٢٠٢١٠٥١٣_٠٦١٧٤٦.jpg', 3.00),
(26, 'Fares', 'fares@gmail.com', '0123654789', '123', 2, '../images/05-38-19IMG_20220712_151936.jpg', 3.00),
(27, 'Omr', 'omr@org.eg', 'omr@org.eg', '123', 2, '../../view/images/R.png', 3.00),
(28, 'Ammar', 'ammar@azhar.edu.eg', 'ammar@azhar.edu.eg', '123', 3, '../images/12-24-46IMG20210226194042.jpg', 3.00),
(29, 'Saeid', 'saeid@org.eg', 'saeid@org.eg', '123', 2, '../images/11-22-2020221129_115311_811.jpg', 3.00),
(30, 'Remas', 'remas@ud.org.com', 'remas@ud.org.com', '123', 3, '../../view/images/R.png', 3.00),
(31, 'Ola', 'Ola@eg.com', 'Ola@eg.com', '123', 3, '../images/02-40-19IMG_20220814_085240.jpg', 2.50),
(32, 'Mamoun', 'mamoun@org.com', 'mamoun@org.com', '123', 2, '../images/03-01-30٢٠٢٢١١٢٩_١٥٣٥٣٨.jpg', 0.00),
(33, 'Mohamed', 'mohamed@archo.cairo.edu.eg', '123654789', '123', 3, '../images/07-05-471d3eaa60-1287-4c98-9a8a-1af5b995', 0.00),
(34, 'Rahma', 'rahma@org.com', 'rahma@org.com', '123', 3, '../../view/images/R.png', 0.00),
(35, 'Dolagy', 'dolagy@fcai.helwan.edu.eg', 'dolagy@fcai.helwan.edu.eg', '123', 3, '../../view/images/R.png', 4.00),
(36, 'Wahid', 'wahid@fcai.helwan.edu.eg', 'wahid@fcai.helwan.edu.eg', '123', 2, '../../view/images/R.png', 0.00),
(37, 'Noura', 'noura@fcai.hewan.edu.eg', 'noura@fcai.hewan.edu.eg', '123', 3, '../../view/images/R.png', 5.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avalaibledriver`
--
ALTER TABLE `avalaibledriver`
  ADD KEY `driverId` (`driverId`);

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `cash`
--
ALTER TABLE `cash`
  ADD PRIMARY KEY (`cashId`),
  ADD KEY `cash_ibfk_1` (`userId`);

--
-- Indexes for table `driverava`
--
ALTER TABLE `driverava`
  ADD KEY `driverId` (`driverId`);

--
-- Indexes for table `kindofrent`
--
ALTER TABLE `kindofrent`
  ADD PRIMARY KEY (`kindOfRentId`);

--
-- Indexes for table `market`
--
ALTER TABLE `market`
  ADD PRIMARY KEY (`marketId`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menuId`),
  ADD KEY `marketId` (`marketId`);

--
-- Indexes for table `notifi`
--
ALTER TABLE `notifi`
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `profilephoto`
--
ALTER TABLE `profilephoto`
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `rentcase`
--
ALTER TABLE `rentcase`
  ADD PRIMARY KEY (`rentCaseId`);

--
-- Indexes for table `rents`
--
ALTER TABLE `rents`
  ADD PRIMARY KEY (`rentId`),
  ADD KEY `rentCase` (`rentCase`),
  ADD KEY `rentKind` (`rentKind`);

--
-- Indexes for table `requestorder`
--
ALTER TABLE `requestorder`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `requesttrip`
--
ALTER TABLE `requesttrip`
  ADD PRIMARY KEY (`requestTrip`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD KEY `userRoleId` (`userRoleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cash`
--
ALTER TABLE `cash`
  MODIFY `cashId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kindofrent`
--
ALTER TABLE `kindofrent`
  MODIFY `kindOfRentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `market`
--
ALTER TABLE `market`
  MODIFY `marketId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menuId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `rentcase`
--
ALTER TABLE `rentcase`
  MODIFY `rentCaseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rents`
--
ALTER TABLE `rents`
  MODIFY `rentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `requestorder`
--
ALTER TABLE `requestorder`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `requesttrip`
--
ALTER TABLE `requesttrip`
  MODIFY `requestTrip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `avalaibledriver`
--
ALTER TABLE `avalaibledriver`
  ADD CONSTRAINT `avalaibledriver_ibfk_1` FOREIGN KEY (`driverId`) REFERENCES `user` (`userId`);

--
-- Constraints for table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);

--
-- Constraints for table `cash`
--
ALTER TABLE `cash`
  ADD CONSTRAINT `cash_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);

--
-- Constraints for table `driverava`
--
ALTER TABLE `driverava`
  ADD CONSTRAINT `driverava_ibfk_1` FOREIGN KEY (`driverId`) REFERENCES `user` (`userId`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`marketId`) REFERENCES `market` (`marketId`);

--
-- Constraints for table `notifi`
--
ALTER TABLE `notifi`
  ADD CONSTRAINT `notifi_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);

--
-- Constraints for table `profilephoto`
--
ALTER TABLE `profilephoto`
  ADD CONSTRAINT `profilephoto_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);

--
-- Constraints for table `rents`
--
ALTER TABLE `rents`
  ADD CONSTRAINT `rents_ibfk_1` FOREIGN KEY (`rentCase`) REFERENCES `rentcase` (`rentCaseId`),
  ADD CONSTRAINT `rents_ibfk_2` FOREIGN KEY (`rentKind`) REFERENCES `kindofrent` (`kindOfRentId`);

--
-- Constraints for table `requestorder`
--
ALTER TABLE `requestorder`
  ADD CONSTRAINT `requestorder_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`userRoleId`) REFERENCES `roles` (`roleId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
