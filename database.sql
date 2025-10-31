-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `database`
--

-- --------------------------------------------------------

--
--  `catagories`
--

CREATE TABLE `catagories` (
  `ID` tinyint(3) UNSIGNED NOT NULL,
  `DESCRIPTION` varchar(64) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- empty `catagories`
--

INSERT INTO `catagories` (`ID`, `DESCRIPTION`) VALUES
(1, 'PC PART'),
(4, 'PERIPHERAL'),
(3, 'SUPPLIES');

-- --------------------------------------------------------

--
-- structure`manufacturer`
--

CREATE TABLE `manufacturer` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `description` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `municipalityID` int(11) NOT NULL,
  `municipalityName` varchar(30) NOT NULL,
  `countyID` int(11) NOT NULL,
  `countyName` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone1` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- empty `manufacturer`
--

INSERT INTO `manufacturer` (`id`, `description`, `username`, `municipalityID`, `municipalityName`, `countyID`, `countyName`, `address`, `phone1`) VALUES
(441, 'PC SUPPLIERS ', 'user101', 0, '', 0, '', '', ''),
(442, 'SUPPLY CHAIN LTD', 'user102', 0, '', 0, '', '', ''),
(443, 'PC ALL ', 'user103', 0, '', 0, '', '', ''),
(444, 'PC&PARTS LTD', 'user104', 0, '', 0, '', '', ''),
(445, 'DIGITAL SUPPLIES', 'user105', 0, '', 0, '', '', ''),
(446, 'DSP', 'user106', 0, '', 0, '', '', ''),
(447, 'SFPCM', 'user107', 0, '', 0, '', '', ''),
(451, 'SUP4TECH', 'user108', 0, '', 0, '', '', '');

-- --------------------------------------------------------

--
-- structure`orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `productID` int(10) UNSIGNED NOT NULL,
  `username` varchar(45) NOT NULL,
  `quantity` smallint(5) UNSIGNED NOT NULL,
  `when` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- empty `orders`
--

INSERT INTO `orders` (`orderID`, `productID`, `username`, `quantity`, `when`) VALUES
(1, 2523, 'user111', 200, '2024-06-08 10:04:47'),
(2, 2524, 'user112', 300, '2024-06-17 10:04:47');

-- --------------------------------------------------------

--
-- specific structure of `pricedata`
-- real projection
--
CREATE TABLE `pricedata` (
`productID` int(10) unsigned
,`manufacturer` smallint(5) unsigned
,`category` tinyint(3) unsigned
,`subcategory` tinyint(3) unsigned
,`details` varchar(98)
,`description` varchar(128)
,`price` decimal(4,3)
,`dateUpdated` timestamp
,`isPremium` tinyint(1)
);

-- --------------------------------------------------------

--
-- structure of`products`
--

CREATE TABLE `products` (
  `productID` int(10) UNSIGNED NOT NULL,
  `manufacturer` smallint(5) UNSIGNED NOT NULL,
  `category` tinyint(3) UNSIGNED NOT NULL,
  `subcategory` tinyint(3) UNSIGNED NOT NULL,
  `description` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `price` decimal(4,3) NOT NULL,
  `dateUpdated` timestamp NULL DEFAULT current_timestamp(),
  `isPremium` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- empty`products`
--

INSERT INTO `products` (`productID`, `manufacturer`, `category`, `subcategory`, `description`, `price`, `dateUpdated`, `isPremium`) VALUES
(2484, 441, 1, 1, 'MOTHERBOARD ACTION 6', 1.379, '2016-12-01 03:54:39', 0),
(2485, 441, 1, 1, 'MOTHERBOARD ACTION 7', 1.545, '2016-12-01 03:54:46', 0),
(2486, 441, 4, 1, 'A4 PAPER PREMIUM', 9.999, '2016-12-01 03:55:07', 1),
(2487, 441, 4, 2, 'A4 PAPER RECYCLED', 1.047, '2016-12-01 03:55:00', 0),
(2488, 442, 1, 3, 'RAM 32GB SUPER', 1.478, '2016-11-30 04:31:14', 1),
(2489, 442, 1, 3, 'RAM 16GB SUPER', 1.398, '2016-11-30 04:31:02', 0),
(2490, 442, 1, 3, 'RAM 8GB SUPER', 1.745, '2016-11-30 04:31:23', 1),
(2491, 442, 4, 2, 'REC A4 F32 L', 1.065, '2016-11-30 04:31:36', 0),
(2492, 442, 4, 2, 'REC BQ GG4 L', 1.145, '2016-11-30 04:31:46', 1),
(2493, 443, 1, 1, 'MOTHERBOARD ACTION 12 99', 1.395, '2016-11-03 05:49:57', 0),
(2494, 443, 1, 1, 'MOTHERBOARD ACTION 10 09', 1.568, '2016-11-03 05:50:19', 0),
(2495, 443, 2, 1, 'KEYBOARD TYPICAL ASCII', 1.098, '2016-11-03 05:50:35', 0),
(2496, 443, 2, 1, 'KEYBOARD TYPICAL EXTENDED', 1.148, '2016-11-03 05:50:44', 1),
(2497, 444, 2, 1, 'KEYBOARD MECHANICAL', 1.395, '2016-11-07 04:01:24', 0),
(2498, 444, 2, 1, 'KEYBOARD GREEK USB', 1.568, '2016-10-11 09:57:33', 0),
(2499, 444, 2, 2, 'WIRED MOUSE 3K', 1.098, '2016-10-11 09:57:48', 0),
(2500, 444, 2, 2, 'MOUSE WF 8', 1.148, '2016-10-05 04:29:49', 1),
(2501, 445, 1, 3, 'WD HDD 1T', 1.378, '2016-11-25 09:34:30', 0),
(2502, 445, 1, 3, 'WD HDD 2T', 1.048, '2016-12-01 08:53:35', 0),
(2503, 446, 1, 3, 'WD HDD 4T', 1.378, '2016-12-01 00:16:03', 0),
(2504, 446, 1, 4, 'WD SSD 1T', 1.545, '2016-12-01 00:16:12', 0),
(2505, 446, 1, 4, 'WD SSD 2T', 1.049, '2016-12-01 00:16:20', 0),
(2506, 447, 1, 4, 'WD SSD 4T', 1.478, '2016-12-01 02:52:20', 1),
(2538, 451, 4, 2, 'RCPAPERA4 001', 0.900, '2016-11-10 02:03:27', 0),
(2539, 451, 4, 2, 'RCPAPERA4 002', 0.900, '2016-11-12 13:53:44', 0),
(2540, 451, 4, 2, 'RCPAPERA4 003', 0.920, '2016-11-30 09:33:37', 0),
(2541, 451, 4, 1, 'PAPER A4 001', 0.900, '2016-11-30 09:32:44', 1),
(2542, 451, 4, 1, 'PAPER A4 002', 0.900, '2016-11-30 09:32:30', 0),
(2543, 451, 4, 1, 'PAPER A4 001', 0.920, '2016-11-14 04:08:14', 1),
(3496, 443, 2, 1, 'AX KEYBOARD TYPICAL EXTENDED', 1.148, '2016-11-03 05:50:44', 1),
(3497, 444, 2, 1, 'AX KEYBOARD MECHANICAL', 1.395, '2016-11-07 04:01:24', 0),
(3498, 444, 2, 1, 'AC KEYBOARD GREEK USB', 1.568, '2016-10-11 09:57:33', 0),
(3499, 444, 2, 2, 'AX WIRED MOUSE 3K', 1.098, '2016-10-11 09:57:48', 0),
(3500, 444, 2, 2, 'AD MOUSE WF 8', 1.148, '2016-10-05 04:29:49', 1),
(3501, 445, 1, 3, 'FIREGATE HDD 1T', 1.378, '2016-11-25 09:34:30', 0),
(3502, 445, 1, 3, 'FIREGATE HDD 2T', 1.048, '2016-12-01 08:53:35', 0),
(3503, 446, 1, 3, 'FIREGATE HDD 4T', 1.378, '2016-12-01 00:16:03', 0),
(3504, 446, 1, 4, 'FIREGATE SSD 1T', 1.545, '2016-12-01 00:16:12', 0),
(3505, 446, 1, 4, 'FIREGATE SSD 2T', 1.049, '2016-12-01 00:16:20', 0),
(3506, 447, 1, 4, 'FIREGATE SSD 4T', 1.478, '2016-12-01 02:52:20', 1);

-- --------------------------------------------------------

--
-- structure of `subcategories`
--

CREATE TABLE `subcategories` (
  `ID` int(11) NOT NULL,
  `DESCRIPTION` varchar(30) NOT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- empty `subcategories`
--

INSERT INTO `subcategories` (`ID`, `DESCRIPTION`, `category`) VALUES
(1, 'Motherboard', 1),
(1, 'KEYBOARD', 2),
(1, 'PARER A4', 4),
(2, 'RAM', 1),
(2, 'MOUSE', 2),
(2, 'RECYCLED PAPER A4', 4),
(3, 'HDD', 1),
(4, 'SSD', 1);

-- --------------------------------------------------------

--
-- structure of`users`
--

CREATE TABLE `users` (
  `username` varchar(45) NOT NULL,
  `password` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- empty `users`
--

INSERT INTO `users` (`username`, `password`, `email`) VALUES
('user000', '000000', 'user000@user.gr'),
('user10', 'pass10', 'email10@gmail.com'),
('user100', 'pass100', 'email100@gmail.com'),
('user101', 'pass101', 'email101@gmail.com'),
('user102', 'pass102', 'email102@gmail.com'),
('user103', 'pass103', 'email103@gmail.com'),
('user104', 'pass104', 'email104@gmail.com'),
('user105', 'pass105', 'email105@gmail.com'),
('user106', 'pass106', 'email106@gmail.com'),
('user107', 'pass107', 'email107@gmail.com'),
('user108', 'pass108', 'email108@gmail.com'),
('user109', 'pass20', 'email20@gmail.com');

-- --------------------------------------------------------

--
-- structure of projection of `pricedata`
--
DROP TABLE IF EXISTS `pricedata`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pricedata`  AS SELECT `products`.`productID` AS `productID`, `products`.`manufacturer` AS `manufacturer`, `products`.`category` AS `category`, `products`.`subcategory` AS `subcategory`, concat(`catagories`.`DESCRIPTION`,' >> ',`subcategories`.`DESCRIPTION`) AS `details`, `products`.`description` AS `description`, `products`.`price` AS `price`, `products`.`dateUpdated` AS `dateUpdated`, `products`.`isPremium` AS `isPremium` FROM ((`products` join `subcategories`) join `catagories`) WHERE `products`.`category` = `subcategories`.`category` AND `products`.`subcategory` = `subcategories`.`ID` AND `catagories`.`ID` = `subcategories`.`category` ;

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- table of indices of `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`id`);

--
-- table of indices of`orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `fk_orders_users1_idx` (`username`),
  ADD KEY `fk_orders_pricedata1_idx` (`productID`);

--
-- table of indices of `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`);

--
-- table of indices of `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`ID`,`category`);

--
-- table of indices of `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
