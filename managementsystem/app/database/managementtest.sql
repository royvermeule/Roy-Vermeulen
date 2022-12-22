-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2022 at 08:24 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `managementtest`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `registration` (IN `Firstname` VARCHAR(50), IN `Infix` VARCHAR(10), IN `Lastname` VARCHAR(50), IN `Email` VARCHAR(50), IN `UserPass` VARCHAR(12), IN `Age` INT(3))   INSERT INTO userdetails (Firstname, Infix, Lastname, Age)
VALUES (Firstname, Infix, Lastname, Age)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `logindetails`
--

CREATE TABLE `logindetails` (
  `Id` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `UserPass` varchar(100) NOT NULL,
  `UserDetailsId` int(11) NOT NULL,
  `RollId` int(11) NOT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logindetails`
--

INSERT INTO `logindetails` (`Id`, `Email`, `UserPass`, `UserDetailsId`, `RollId`, `IsActive`) VALUES
(37, 'Roy@mail.com', 'superboy200!', 60, 1, b'1'),
(54, 'winter@mail.com', 'dddddddddddd', 77, 2, b'1'),
(55, 'vandevalk@mail.com', '123456789123', 78, 2, b'1'),
(56, 'hobbit@mail.com', 'dddddddddddd', 79, 2, b'1'),
(57, 'royvermeulen@mail.com', 'superboy200!', 80, 1, b'1'),
(58, 'friesroels@mail.com', 'Superderoel200', 81, 2, b'1'),
(59, 'werner@mail.com', 'timowerner200', 82, 2, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `roll`
--

CREATE TABLE `roll` (
  `Id` int(11) NOT NULL,
  `RollName` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roll`
--

INSERT INTO `roll` (`Id`, `RollName`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `Id` int(11) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Infix` varchar(10) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Age` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`Id`, `Firstname`, `Infix`, `Lastname`, `Age`) VALUES
(60, 'Roy', '', 'Vermeulen', 19),
(77, 'Maron', 'de', 'Winter', 18),
(78, 'Aaron', 'van der', 'Valk', 34),
(79, 'Alex', '', 'Hobs', 40),
(80, 'Roy', '', 'Vermeulen', 19),
(81, 'Roel', 'de', 'Fries', 14),
(82, 'Time', '', 'Werner', 29);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logindetails`
--
ALTER TABLE `logindetails`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_UserDetailsId` (`UserDetailsId`),
  ADD KEY `RollId` (`RollId`);

--
-- Indexes for table `roll`
--
ALTER TABLE `roll`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logindetails`
--
ALTER TABLE `logindetails`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `roll`
--
ALTER TABLE `roll`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `logindetails`
--
ALTER TABLE `logindetails`
  ADD CONSTRAINT `FK_RollId` FOREIGN KEY (`RollId`) REFERENCES `roll` (`Id`),
  ADD CONSTRAINT `FK_UserDetailsId` FOREIGN KEY (`UserDetailsId`) REFERENCES `userdetails` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
