-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 13, 2025 at 12:35 PM
-- Server version: 8.0.22-0ubuntu0.20.04.3
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE `configs` (
  `ID` int NOT NULL,
  `Type` enum('number','varchar','text','html','date','datetime') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Alias` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Label` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Value` text CHARACTER SET utf8 COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `configs`
--

INSERT INTO `configs` (`ID`, `Type`, `Alias`, `Label`, `Value`) VALUES
(1, 'varchar', 'sitename', 'Site name', 'MCG'),
(2, 'varchar', 'email', 'Email', NULL),
(3, 'varchar', 'youtubekey', 'youtube Key', NULL),
(4, 'varchar', 'facebook', 'Facebook', NULL),
(5, 'varchar', 'tel', 'Téléphone', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `connexions`
--

CREATE TABLE `connexions` (
  `ID` int NOT NULL,
  `User` int DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  `Client` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Source` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Device` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Navigateur` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `connexions`
--

INSERT INTO `connexions` (`ID`, `User`, `Date`, `Client`, `Source`, `Device`, `Navigateur`) VALUES
(89, 21, '2020-01-20 15:07:27', '192.168.1.22', 'Desktop App', 'computer', 'Google Chrome'),
(90, 21, '2020-01-21 14:58:12', '192.168.1.13', 'Desktop App', 'computer', 'Google Chrome'),
(91, 21, '2020-01-21 16:22:17', '192.168.1.13', 'Desktop App', 'computer', 'Google Chrome'),
(92, 21, '2020-01-22 15:05:57', '192.168.1.11', 'Desktop App', 'computer', 'Google Chrome'),
(128, 28, '2020-02-27 18:57:35', '160.179.40.111', 'Desktop App', 'computer', 'Google Chrome'),
(129, 28, '2020-02-27 19:59:02', '41.143.1.83', 'Desktop App', 'computer', 'Google Chrome'),
(130, 28, '2020-02-28 14:14:23', '196.65.93.212', 'Desktop App', 'computer', 'Google Chrome'),
(153, 28, '2021-01-19 12:34:01', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(154, 28, '2021-01-19 12:35:15', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(155, 28, '2021-01-19 12:36:46', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(156, 28, '2021-01-19 12:38:53', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(157, 28, '2021-01-19 12:47:46', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(158, 45, '2021-01-19 12:51:12', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(161, 28, '2021-01-19 14:36:33', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(162, 28, '2021-01-19 15:47:18', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(163, 45, '2021-01-19 15:47:31', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(167, 28, '2021-01-19 18:59:58', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(168, 45, '2021-01-19 19:00:21', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(179, 41, '2021-02-03 16:19:44', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(180, 41, '2021-02-03 16:54:06', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(181, 41, '2021-02-10 10:34:05', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(182, 41, '2021-02-10 16:41:57', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(183, 41, '2021-02-11 09:43:05', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(184, 41, '2021-02-11 14:41:46', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(185, 41, '2021-02-11 17:43:12', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(186, 41, '2021-02-12 09:38:27', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(187, 31, '2021-02-12 09:43:31', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(188, 31, '2021-02-12 10:50:18', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(189, 31, '2021-02-12 12:58:29', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(190, 41, '2021-02-12 15:10:54', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(191, 41, '2021-02-13 14:53:29', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(192, 41, '2021-02-13 17:49:36', '127.0.0.1', 'Desktop App', 'computer', 'Mozilla Firefox'),
(193, 41, '2021-02-15 09:17:22', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(194, 31, '2021-02-15 09:31:54', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(195, 41, '2021-02-15 14:49:10', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(196, 41, '2021-02-15 18:16:28', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(197, 41, '2021-02-16 09:22:28', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(198, 41, '2021-02-16 17:14:39', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(199, 28, '2021-02-17 09:10:01', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(200, 41, '2021-02-17 09:10:15', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(201, 41, '2021-02-22 11:31:00', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(202, 41, '2021-02-22 14:57:57', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(203, 41, '2021-02-22 15:47:34', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(204, 31, '2021-02-22 16:25:20', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(205, 41, '2021-02-23 12:43:43', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(206, 41, '2021-02-23 14:28:04', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(207, 31, '2021-02-23 14:29:30', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(208, 41, '2021-02-23 18:18:44', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(209, 41, '2021-02-24 09:24:01', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(210, 31, '2021-02-24 09:47:37', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(211, 41, '2021-03-02 16:13:40', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(212, 41, '2021-03-03 15:26:44', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(213, 31, '2021-03-03 16:39:21', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(214, 31, '2021-03-03 18:11:07', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(215, 31, '2021-03-03 18:16:41', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(216, 41, '2021-03-03 18:17:45', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(217, 31, '2021-03-04 10:27:29', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(218, 41, '2021-03-10 12:43:15', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(219, 31, '2021-03-10 12:43:35', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(220, 41, '2021-03-12 09:22:25', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(221, 41, '2021-03-15 17:59:05', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(222, 41, '2021-04-29 15:12:11', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(223, 41, '2021-05-05 12:59:23', '::1', 'Desktop App', 'computer', 'Google Chrome'),
(224, 21, '2025-01-13 11:45:25', '::1', 'Desktop App', 'computer', 'Google Chrome');

-- --------------------------------------------------------

--
-- Table structure for table `etablissements`
--

CREATE TABLE `etablissements` (
  `ID` int NOT NULL,
  `Label` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Abreviation` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Logo` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `OrdreTBD` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `IP_Adress` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Port` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Index` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `etablissements`
--

INSERT INTO `etablissements` (`ID`, `Label`, `Abreviation`, `Logo`, `OrdreTBD`, `IP_Adress`, `Port`, `Index`) VALUES
(1, 'CIGMA', 'C', 'rupo96mez4.jpg', NULL, '196.70.254.174', '4370', NULL),
(22, 'ESMC', NULL, 'ydf9yi7ow0.jpg', NULL, NULL, NULL, NULL),
(23, 'Steve jobs school', NULL, 'mvigp11e3r.jpg', NULL, NULL, NULL, NULL),
(24, 'Kaizen school', NULL, 'pavcdgzv25.jpg', NULL, NULL, NULL, NULL),
(25, 'Next Skills', NULL, 'kyu7t6ghhg.png', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `ID` int NOT NULL,
  `Parent` int DEFAULT NULL,
  `Label` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Alias` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`ID`, `Parent`, `Label`, `Alias`) VALUES
(1, NULL, 'Admin', 'admin'),
(2, NULL, 'Collaborateur', 'collaborateur');

-- --------------------------------------------------------

--
-- Table structure for table `userpermissions`
--

CREATE TABLE `userpermissions` (
  `ID` int NOT NULL,
  `TypePermission` int NOT NULL,
  `Collaborateur` int NOT NULL,
  `DateDebut` datetime DEFAULT NULL,
  `DateFin` datetime DEFAULT NULL,
  `Jours` double DEFAULT NULL,
  `PermissionEnHeure` tinyint(1) DEFAULT NULL,
  `DateAjout` datetime NOT NULL,
  `UserAjout` int NOT NULL,
  `Motif` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `CommentaireAdmin` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `AdminValidationDate` datetime DEFAULT NULL,
  `AdminValidationUser` int DEFAULT NULL,
  `AdminRefusDate` datetime DEFAULT NULL,
  `AdminRefusUser` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `userpermissions`
--

INSERT INTO `userpermissions` (`ID`, `TypePermission`, `Collaborateur`, `DateDebut`, `DateFin`, `Jours`, `PermissionEnHeure`, `DateAjout`, `UserAjout`, `Motif`, `CommentaireAdmin`, `AdminValidationDate`, `AdminValidationUser`, `AdminRefusDate`, `AdminRefusUser`) VALUES
(45, 5, 15, NULL, NULL, NULL, NULL, '2021-02-22 15:08:59', 41, 'dfhfhfhy', NULL, '2021-02-22 16:03:00', 41, NULL, NULL),
(46, 5, 15, '2021-02-22 00:00:00', '2021-02-22 16:00:00', 1, NULL, '2021-02-22 15:54:57', 41, 'fghfdghfguyjhyttiuu', NULL, '2021-02-23 19:01:55', 41, NULL, NULL),
(47, 7, 15, '2021-02-22 00:00:00', '2021-02-22 16:30:00', 1, NULL, '2021-02-22 16:18:09', 41, 'dghfgfhjjghjkghjk', NULL, '2021-02-24 09:25:46', 41, NULL, NULL),
(48, 5, 15, '2021-02-22 00:00:00', '2021-03-10 16:30:00', 15, NULL, '2021-02-22 16:18:21', 41, 'hgjkhgjkhj', NULL, '2021-02-24 09:27:12', 41, NULL, NULL),
(49, 6, 5, '2021-02-22 00:00:00', '2021-02-22 16:30:00', 1, NULL, '2021-02-22 16:25:31', 31, 'hgfhjhh', NULL, NULL, NULL, '2021-02-24 09:27:22', 41),
(50, 5, 5, '2021-02-22 00:00:00', '2021-02-22 16:30:00', 1, NULL, '2021-02-22 16:28:41', 31, 'dgdfhfhj', NULL, '2021-02-24 09:26:27', 41, NULL, NULL),
(51, 6, 15, '2021-02-23 00:00:00', '2021-02-23 00:00:00', 1, NULL, '2021-02-23 18:20:00', 41, 'wrwefddfgsd', NULL, '2021-02-23 18:28:51', 41, NULL, NULL),
(52, 5, 15, '2021-02-23 08:00:00', '2021-02-23 18:00:00', 1.25, 1, '2021-02-23 18:31:56', 41, 'asdfsdgfdhfh', NULL, '2021-02-24 09:25:00', 41, NULL, NULL),
(53, 5, 15, '2021-02-23 08:00:00', '2021-02-23 18:00:00', 1.25, 1, '2021-02-23 18:51:15', 41, 'DSAFSDFGDHGFJGF', NULL, '2021-02-24 09:46:40', 41, NULL, NULL),
(54, 5, 15, '2021-02-23 08:00:00', '2021-02-23 18:00:00', 1.25, 1, '2021-02-23 18:52:50', 41, 'afsdrtyfth', NULL, '2021-02-23 19:03:21', 41, NULL, NULL),
(55, 5, 15, '2021-02-23 08:00:00', '2021-02-23 18:00:00', 1.25, 1, '2021-02-23 19:03:13', 41, 'dgs', NULL, NULL, NULL, NULL, NULL),
(56, 5, 15, '2021-02-24 08:00:00', '2021-02-24 18:00:00', 1.25, 1, '2021-02-24 09:24:49', 41, 'asfgdsfgdhgfgfdgdfff\r\nhjklhj', NULL, NULL, NULL, NULL, NULL),
(57, 6, 5, '2021-02-24 00:00:00', '2021-03-13 00:00:00', 16, NULL, '2021-02-24 09:48:38', 31, 'asdfsgsdagdfhgsdhgdfhg\r\nfghfdj\r\nghjhjsdfgdsgs', NULL, NULL, NULL, NULL, NULL),
(58, 5, 5, '2021-02-24 08:00:00', '2021-02-24 18:00:00', 1.25, 1, '2021-02-24 10:07:02', 31, 'werterytreyuy', NULL, NULL, NULL, NULL, NULL),
(59, 5, 5, '2021-02-24 08:00:00', '2021-02-24 18:00:00', 1.25, 1, '2021-02-24 10:07:46', 31, 'werterytreyuy', NULL, NULL, NULL, NULL, NULL),
(60, 5, 5, '2021-02-24 08:00:00', '2021-02-24 18:00:00', 1.25, 1, '2021-02-24 10:08:29', 31, 'sdfgdfgdfhgffg', 'adfasdfg', '2021-02-24 10:11:48', 41, NULL, NULL),
(61, 5, 5, '2021-02-24 08:00:00', '2021-02-24 18:00:00', 1.25, 1, '2021-02-24 10:15:55', 31, 'asdfgsdfgdhgfdfhg', NULL, '2021-02-24 10:17:13', 41, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int NOT NULL,
  `Role` int NOT NULL,
  `Etablissement` int DEFAULT NULL,
  `CodePointage` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Login` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Password` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Key` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Forgot` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Fingerprint` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `TokenID` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `TokenDevice` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Nom` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Prenom` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Tel` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Adresse` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Fonction` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Homme` tinyint(1) DEFAULT NULL,
  `Image` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateNaissance` date DEFAULT NULL,
  `Enabled` tinyint(1) DEFAULT NULL,
  `Valide` tinyint(1) DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  `Sup` int DEFAULT NULL,
  `ReceiveTaskNotification` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Role`, `Etablissement`, `CodePointage`, `Login`, `Password`, `Key`, `Forgot`, `Fingerprint`, `TokenID`, `TokenDevice`, `Nom`, `Prenom`, `Email`, `Tel`, `Adresse`, `Fonction`, `Homme`, `Image`, `DateNaissance`, `Enabled`, `Valide`, `Date`, `Sup`, `ReceiveTaskNotification`) VALUES
(21, 1, 24, NULL, 'sys', '3239da36bdb3e9e8f31327474df4b7e04a3af794', 'CbLQ9FnOvGM5xhGJFBCRGnOJx8ZGoI', NULL, NULL, NULL, NULL, 'Boutee', 'Imane', 'imane.boute@gmail.com', '060000111', NULL, 'Service Manager', 0, 'gaqkzihlo8.jpg', '1981-12-11', 1, 1, '2019-12-26 11:38:44', 41, 1),
(41, 1, 1, '010', 'admin', 'de50117f6b815ee9ccd5aea7ad7b713c6ca0a826', '54o1P3qBHp14yIUEdQMIJaXgAwqzdS', NULL, NULL, NULL, NULL, 'MAHFOUD', 'Mounir', 'belharradi.j@gmail.com', '06 61 18 43 85', NULL, 'Résponsable pédagogique', 1, NULL, NULL, 1, NULL, '2020-02-27 18:55:20', 41, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `connexions`
--
ALTER TABLE `connexions`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_user_connexions` (`User`);

--
-- Indexes for table `etablissements`
--
ALTER TABLE `etablissements`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `unq_alias` (`Alias`),
  ADD KEY `fk_role_parent` (`Parent`);

--
-- Indexes for table `userpermissions`
--
ALTER TABLE `userpermissions`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_userpermissions_employe` (`Collaborateur`),
  ADD KEY `fk_userpermissions_userajout` (`UserAjout`),
  ADD KEY `fk_userpermissions_typepermission` (`TypePermission`),
  ADD KEY `fk_userpermissions_validationadmin` (`AdminValidationUser`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_user_role` (`Role`),
  ADD KEY `fk_user_etablissement` (`Etablissement`),
  ADD KEY `Sup` (`Sup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `configs`
--
ALTER TABLE `configs`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `connexions`
--
ALTER TABLE `connexions`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `etablissements`
--
ALTER TABLE `etablissements`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userpermissions`
--
ALTER TABLE `userpermissions`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `connexions`
--
ALTER TABLE `connexions`
  ADD CONSTRAINT `fk_user_connexions` FOREIGN KEY (`User`) REFERENCES `users` (`ID`);

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `fk_role_parent` FOREIGN KEY (`Parent`) REFERENCES `roles` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `userpermissions`
--
ALTER TABLE `userpermissions`
  ADD CONSTRAINT `userpermissions_ibfk_1` FOREIGN KEY (`TypePermission`) REFERENCES `typespermissions` (`ID`),
  ADD CONSTRAINT `userpermissions_ibfk_2` FOREIGN KEY (`Collaborateur`) REFERENCES `collaborateurs` (`ID`),
  ADD CONSTRAINT `userpermissions_ibfk_3` FOREIGN KEY (`UserAjout`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `userpermissions_ibfk_4` FOREIGN KEY (`AdminValidationUser`) REFERENCES `users` (`ID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_etablissement` FOREIGN KEY (`Etablissement`) REFERENCES `etablissements` (`ID`),
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`Role`) REFERENCES `roles` (`ID`),
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`Sup`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`Sup`) REFERENCES `users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
