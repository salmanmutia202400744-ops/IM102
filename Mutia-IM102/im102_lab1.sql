-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2026 at 03:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `im102_lab1`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `course`, `year`, `date_added`, `email`, `phone`, `address`) VALUES
(5, 'Allysa Gaton', 'BSIT', 2, '2026-06-10 00:36:33', 'allysa@gmail.com', '2432345', 'zone 12'),
(6, 'Jenrex Pitogo', 'BSIT', 2, '2026-06-10 00:49:05', 'jenrex@gmail.com\r\n', '8787654623', 'Abuno'),
(9, 'Mark ', 'BSCS', 2, '2026-06-10 01:00:22', 'mark@gmail.com', '096487515', 'Zone 4 abuno'),
(11, 'Alindayo', 'BSIT', 2, '2026-06-10 01:28:25', 'angelo@gmail.com', '12345678', 'Brgy. Saray'),
(12, 'Alindayo', 'BSIT', 2, '2026-06-10 01:28:33', 'angelo@gmail.com', '12345678', 'Brgy. Saray'),
(13, 'Alindayo Angelo', 'BSIT', 2, '2026-06-10 01:30:04', 'angelo@gmail.com', '12345678', 'Brgy. Saray'),
(14, 'Alindayo Angelo', 'BSIT', 2, '2026-06-10 01:31:29', 'angelo@gmail.com', '12345678', 'Brgy. Saray'),
(15, 'Alindayo Angelo', 'BSIT', 2, '2026-06-10 01:31:33', 'angelo@gmail.com', '12345678', 'Brgy. Saray'),
(16, 'Alindayo Angelo', 'BSIT', 2, '2026-06-10 01:35:25', 'angelo@gmail.com', '12345678', 'Brgy. Saray'),
(17, 'Alindayo Angelo', 'BSIT', 2, '2026-06-10 01:50:09', 'angelo@gmail.com', '12345678', 'Brgy. Saray'),
(18, 'Salman Mutia', 'BSCS', 5, '2026-06-10 01:50:25', 'angelo@gmail.com', '12345678', 'Brgy. Saray');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
