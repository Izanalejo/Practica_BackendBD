-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2026 at 02:43 PM
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
-- Database: `practicaevaluable`
--

-- --------------------------------------------------------

--
-- Table structure for table `streamers`
--

CREATE TABLE `streamers` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nombre_real` varchar(50) NOT NULL,
  `followers` int(11) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `destacado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `streamers`
--

INSERT INTO `streamers` (`id`, `username`, `nombre_real`, `followers`, `avatar`, `destacado`) VALUES
(1, 'streamer1', 'Paquito', 100000, 'img/avatar.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `ultima_visita` varchar(50) NOT NULL,
  `total_visitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `ultima_visita`, `total_visitas`) VALUES
(1, 'User1', '2026-01-01', 1),
(2, 'user2', '2026-01-29 14:17:50', 1),
(3, 'User3', '2026-01-29 14:20:59', 1),
(4, 'user4', '2026-01-29 14:26:07', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `streamers`
--
ALTER TABLE `streamers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `streamers`
--
ALTER TABLE `streamers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
