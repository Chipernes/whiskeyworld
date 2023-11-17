-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 18, 2023 at 01:35 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WhiskeyWorld`
--

-- --------------------------------------------------------

--
-- Table structure for table `Brand`
--

CREATE TABLE `Brand` (
  `BrandId` int NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Country` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Brand`
--

INSERT INTO `Brand` (`BrandId`, `Name`, `Country`) VALUES
(1, 'Jameson', 'Ірландія');

-- --------------------------------------------------------

--
-- Table structure for table `Categories`
--

CREATE TABLE `Categories` (
  `CategoryId` int NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Categories`
--

INSERT INTO `Categories` (`CategoryId`, `Name`, `Image`) VALUES
(1, 'Віскі', '655672c668722.jpg'),
(2, 'Тихе вино', '65567377628e6.jpg'),
(3, 'Шампанське та ігристе вино', '6556738a9729d.jpg'),
(4, 'Вермут', '655673a1cabf6.jpg'),
(5, 'Ром', '655673ab63908.jpg'),
(6, 'Лікери та аперитиви', '655673b51fa05.jpg'),
(7, 'Горілка', '655673bdc64da.jpg'),
(8, 'Джин', '655673c8490d7.jpg'),
(9, 'Текіла та мескаль', '655673d433412.jpg'),
(10, 'Коньяк та бренді', '655673ddf3cac.jpg'),
(11, 'Абсент', '655673e875440.jpg'),
(12, 'Пиво', '655673f139629.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `GrapeVariety`
--

CREATE TABLE `GrapeVariety` (
  `GrapeVarietyId` int NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `GrapeVariety`
--

INSERT INTO `GrapeVariety` (`GrapeVarietyId`, `Name`) VALUES
(1, 'Глера');

-- --------------------------------------------------------

--
-- Table structure for table `OrderItems`
--

CREATE TABLE `OrderItems` (
  `OrderItemId` int NOT NULL,
  `OrderId` int NOT NULL,
  `ProductId` int NOT NULL,
  `Count` int NOT NULL,
  `Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `OrderId` int NOT NULL,
  `UserId` int NOT NULL,
  `Date` date NOT NULL,
  `TotalPrice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE `Products` (
  `ProductId` int NOT NULL,
  `CategoryId` int DEFAULT NULL,
  `Name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Type` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `BrandId` int DEFAULT NULL,
  `Volume` float DEFAULT NULL,
  `Strength` float DEFAULT NULL,
  `Taste` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `GrapeVarietyId` int DEFAULT NULL,
  `Aging` tinyint DEFAULT NULL,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `Count` int DEFAULT NULL,
  `Price` float DEFAULT NULL,
  `Image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Visibility` tinyint DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`ProductId`, `CategoryId`, `Name`, `Type`, `Color`, `BrandId`, `Volume`, `Strength`, `Taste`, `GrapeVarietyId`, `Aging`, `Description`, `Count`, `Price`, `Image`, `Visibility`) VALUES
(1, 1, 'Irish Whiskey', 'Бленд', 'Теплий, золотий захід', 1, 0.7, 40, 'Пряний, фруктовий', NULL, 5, NULL, 10, 599, NULL, 1),
(19, 1, 'Temp', NULL, 'Temp', NULL, 1, 40, 'Temp', NULL, 5, '<p>Some Temp Text</p>', 15, 1000, '6557e73ae5f06.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UserId` int NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Login` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Firstname` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Lastname` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `BirthDate` date DEFAULT NULL,
  `Gender` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `AccessLevel` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserId`, `Email`, `Login`, `Password`, `Firstname`, `Lastname`, `BirthDate`, `Gender`, `AccessLevel`) VALUES
(1, 'Admin', 'Admin', 'e3afed0047b08059d0fada10f400c1e5', 'Admin', 'Admin', '1990-01-01', 'Admin', 10),
(2, 'nikonprofiz@gmail.com', 'Chipernes', '81dc9bdb52d04dc20036dbd8313ed055', 'Нікіта', 'Мотицький', '2004-09-29', 'Чоловічий', 10),
(3, 'temper123@gmail.com', 'Horny', '81dc9bdb52d04dc20036dbd8313ed055', 'James', 'Hornigold', NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Brand`
--
ALTER TABLE `Brand`
  ADD PRIMARY KEY (`BrandId`);

--
-- Indexes for table `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`CategoryId`);

--
-- Indexes for table `GrapeVariety`
--
ALTER TABLE `GrapeVariety`
  ADD PRIMARY KEY (`GrapeVarietyId`);

--
-- Indexes for table `OrderItems`
--
ALTER TABLE `OrderItems`
  ADD PRIMARY KEY (`OrderItemId`),
  ADD KEY `FK_1` (`OrderId`),
  ADD KEY `FK_2` (`ProductId`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`OrderId`),
  ADD KEY `FK_1` (`UserId`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`ProductId`),
  ADD KEY `FK_1` (`CategoryId`),
  ADD KEY `FK_2` (`BrandId`),
  ADD KEY `FK_3` (`GrapeVarietyId`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Brand`
--
ALTER TABLE `Brand`
  MODIFY `BrandId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Categories`
--
ALTER TABLE `Categories`
  MODIFY `CategoryId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `GrapeVariety`
--
ALTER TABLE `GrapeVariety`
  MODIFY `GrapeVarietyId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `OrderItems`
--
ALTER TABLE `OrderItems`
  MODIFY `OrderItemId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `OrderId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `ProductId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `UserId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `OrderItems`
--
ALTER TABLE `OrderItems`
  ADD CONSTRAINT `FK_10` FOREIGN KEY (`ProductId`) REFERENCES `Products` (`ProductId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_9` FOREIGN KEY (`OrderId`) REFERENCES `Orders` (`OrderId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `FK_8` FOREIGN KEY (`UserId`) REFERENCES `Users` (`UserId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `Products`
--
ALTER TABLE `Products`
  ADD CONSTRAINT `FK_5` FOREIGN KEY (`CategoryId`) REFERENCES `Categories` (`CategoryId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_6` FOREIGN KEY (`BrandId`) REFERENCES `Brand` (`BrandId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_7` FOREIGN KEY (`GrapeVarietyId`) REFERENCES `GrapeVariety` (`GrapeVarietyId`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
