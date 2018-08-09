-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2018 at 01:02 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scope-mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `Id` int(10) UNSIGNED NOT NULL,
  `FirstName` varchar(10) DEFAULT NULL,
  `LastName` varchar(10) DEFAULT NULL,
  `Image` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`Id`, `FirstName`, `LastName`, `Image`) VALUES
(27, 'John', 'Doe', 'f3ccdd27d2000e3f9255a7e3e.jpg'),
(28, 'john', 'doe', 'fe5df232cafa4c4e0f1a02944.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(10) UNSIGNED NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `Password` varchar(60) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `GroupId` int(10) UNSIGNED NOT NULL,
  `Status` tinyint(1) DEFAULT '0',
  `SubscriptionDate` date NOT NULL,
  `LastLogin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `UserName`, `Password`, `Email`, `GroupId`, `Status`, `SubscriptionDate`, `LastLogin`) VALUES
(27, 'admin', '$2a$07$wOuAuWbJ67Oa4EgqO11Gj.2fdA4b3xiTIFTSaWhCScM/TONlmHFNC', 'admin@yahoo.com', 6, 2, '2018-08-08', '2018-08-09 12:55:04'),
(28, 'user', '$2a$07$wOuAuWbJ67Oa4EgqO11Gj.2fdA4b3xiTIFTSaWhCScM/TONlmHFNC', 'user@gmail.com', 7, 1, '2018-08-09', '2018-08-09 12:59:42');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `GroupId` int(3) UNSIGNED NOT NULL,
  `GroupName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`GroupId`, `GroupName`) VALUES
(6, 'Amdin'),
(7, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups_privileges`
--

CREATE TABLE `users_groups_privileges` (
  `Id` int(3) UNSIGNED NOT NULL,
  `PrivilegeId` int(3) UNSIGNED NOT NULL,
  `GroupId` int(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups_privileges`
--

INSERT INTO `users_groups_privileges` (`Id`, `PrivilegeId`, `GroupId`) VALUES
(41, 10, 6),
(42, 13, 6),
(43, 19, 6),
(44, 11, 6),
(45, 6, 6),
(46, 7, 6),
(47, 8, 6),
(48, 9, 6),
(49, 12, 6),
(50, 14, 6),
(51, 15, 6),
(52, 16, 6),
(54, 18, 6),
(55, 17, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users_privileges`
--

CREATE TABLE `users_privileges` (
  `PrivilegeId` int(3) UNSIGNED NOT NULL,
  `PrivilegeName` varchar(40) NOT NULL,
  `Privilege` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_privileges`
--

INSERT INTO `users_privileges` (`PrivilegeId`, `PrivilegeName`, `Privilege`) VALUES
(6, 'Add Privilege', '/usersprivileges/create'),
(7, 'Edit Privilege', '/usersprivileges/edit'),
(8, 'Delete Privilege', '/usersprivileges/delete'),
(9, 'Show Privileges', '/usersprivileges/default'),
(10, 'DashBoard', '/index/default'),
(11, 'Show Users Groups', '/usersgroups/default'),
(12, 'Create Users Groups', '/usersgroups/create'),
(13, 'Edit Users Groups', '/usersgroups/edit'),
(14, 'Delete Users Groups', '/usersgroups/delete'),
(15, 'Show Users', '/users/default'),
(16, 'Create users', '/users/create'),
(17, 'Edit Users', '/users/edit'),
(18, 'Delete Users', '/users/delete'),
(19, 'Access To Admin', '/changepath/default');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `UserName` (`UserName`),
  ADD KEY `PK_GROUP_ID` (`GroupId`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`GroupId`);

--
-- Indexes for table `users_groups_privileges`
--
ALTER TABLE `users_groups_privileges`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `PK_GROUPID_USERSGROUPS` (`GroupId`),
  ADD KEY `PK_PRIVILEGEID_USERSPRIVILEGES` (`PrivilegeId`);

--
-- Indexes for table `users_privileges`
--
ALTER TABLE `users_privileges`
  ADD PRIMARY KEY (`PrivilegeId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `GroupId` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users_groups_privileges`
--
ALTER TABLE `users_groups_privileges`
  MODIFY `Id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users_privileges`
--
ALTER TABLE `users_privileges`
  MODIFY `PrivilegeId` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `PK_USER_ID` FOREIGN KEY (`Id`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `PK_GROUP_ID` FOREIGN KEY (`GroupId`) REFERENCES `users_groups` (`GroupId`);

--
-- Constraints for table `users_groups_privileges`
--
ALTER TABLE `users_groups_privileges`
  ADD CONSTRAINT `PK_GROUPID_USERSGROUPS` FOREIGN KEY (`GroupId`) REFERENCES `users_groups` (`GroupId`),
  ADD CONSTRAINT `PK_PRIVILEGEID_USERSPRIVILEGES` FOREIGN KEY (`PrivilegeId`) REFERENCES `users_privileges` (`PrivilegeId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
