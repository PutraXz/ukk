-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2023 at 12:26 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pkk`
--

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `name_url` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `filename`, `name_url`) VALUES
(9, '1678014849164047981aee28.jpg', 'Putra-Rever'),
(10, '1678014849164047981af2fd.jpg', 'Putra-Rever'),
(11, '1678015025164047a31cde48.jpg', 'Putra-Rever'),
(12, '1678015025164047a31ce6a6.jpg', 'Putra-Rever');

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `theme_id` int(11) NOT NULL,
  `name_theme` varchar(75) NOT NULL,
  `preview` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(35) NOT NULL,
  `name_user` varchar(50) NOT NULL,
  `level` enum('admin','user') NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `name_user`, `level`, `status`) VALUES
(1, 'user', 'user', '', 'user', 1);

-- --------------------------------------------------------

--
-- Table structure for table `weddings`
--

CREATE TABLE `weddings` (
  `name_url` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_groom` varchar(75) NOT NULL,
  `child_groom` char(10) NOT NULL,
  `father_groom` varchar(70) NOT NULL,
  `mother_groom` varchar(70) NOT NULL,
  `photo_groom` varchar(50) NOT NULL,
  `name_bride` varchar(70) NOT NULL,
  `child_bride` char(10) NOT NULL,
  `father_bride` varchar(70) NOT NULL,
  `mother_bride` varchar(70) NOT NULL,
  `photo_bride` varchar(50) NOT NULL,
  `image` text NOT NULL,
  `date_count` date DEFAULT NULL,
  `theme_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `weddings`
--

INSERT INTO `weddings` (`name_url`, `user_id`, `name_groom`, `child_groom`, `father_groom`, `mother_groom`, `photo_groom`, `name_bride`, `child_bride`, `father_bride`, `mother_bride`, `photo_bride`, `image`, `date_count`, `theme_id`) VALUES
('Putra-Rever', 1, 'Budi', 'Kedua', 'Joko', 'Kartini', 'molid-square.jpg', 'Putri', 'Pertama', 'Fahrezi', 'Tuminem', 'rehan-square.jpg', 'couple.jpg', '2023-03-05', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`theme_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `weddings`
--
ALTER TABLE `weddings`
  ADD PRIMARY KEY (`name_url`),
  ADD UNIQUE KEY `name_url` (`name_url`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `theme_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
