-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2019 at 11:40 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chamelne__pa`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_licenses`
--

CREATE TABLE `contact_licenses` (
  `id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `license_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `state_id` int(11) NOT NULL,
  `license_number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `expiry_date` datetime NOT NULL,
  `fee` float(11,2) NOT NULL,
  `paid_by` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `retesting_required` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `retesting_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `retest_years` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `next_retest_date` date NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_licenses`
--
ALTER TABLE `contact_licenses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_licenses`
--
ALTER TABLE `contact_licenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
