-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2026 at 04:17 AM
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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Electronics'),
(2, 'Office Supplies'),
(3, 'Computer Accessories'),
(4, 'Networking'),
(5, 'Storage Devices');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `category_id`, `supplier_id`) VALUES
(2, 'HP Pavilion Laptop', '14-inch Ryzen 5 Laptop', 38000.00, 15, 3, 2),
(3, 'Wireless Mouse', '2.4GHz USB Wireless Mouse', 650.00, 50, 3, 2),
(4, 'Mechanical Keyboard', 'RGB Gaming Keyboard', 1800.00, 30, 3, 1),
(5, 'USB Flash Drive 64GB', 'High-speed USB 3.0 Storage', 550.00, 60, 5, 5),
(6, 'External Hard Drive 1TB', 'Portable Backup Drive', 3500.00, 12, 5, 5),
(7, 'Network Switch 8-Port', 'Gigabit Ethernet Switch', 2200.00, 18, 4, 4),
(8, 'WiFi Router', 'Dual Band Wireless Router', 2800.00, 22, 4, 4),
(9, 'Printer Paper A4', '500 Sheets Bond Paper', 250.00, 100, 2, 3),
(10, 'Ballpen Blue', 'Smooth Writing Pen', 15.00, 200, 2, 3),
(11, 'Monitor 24 Inch', 'Full HD LED Monitor', 6500.00, 155, 1, 3),
(12, 'USB-C Hub', 'Multiport USB-C Adapter', 1200.00, 17, 3, 2),
(13, 'Cat6 Ethernet Cable', '5 Meter Networking Cable', 300.00, 45, 4, 4),
(14, 'SSD 512GB', 'Solid State Drive', 2800.00, 14, 5, 5),
(15, 'Notebook', 'Spiral Notebook 100 Pages', 45.00, 150, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `contact_person`, `phone`, `email`) VALUES
(1, 'TechSource Inc.', 'Juan Dela Cruz', '09171234567', 'sales@techsource.com'),
(2, 'Digital Hub', 'Maria Santos', '09181234567', 'info@digitalhub.com'),
(3, 'Office Plus', 'Carlo Reyes', '09191234567', 'support@officeplus.com'),
(4, 'NetWorld Solutions', 'Anna Cruz', '09201234567', 'sales@networld.com'),
(5, 'Storage Masters', 'Mark Lopez', '09211234567', 'contact@storagemasters.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','staff') DEFAULT 'staff',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `role`, `created_at`) VALUES
(1, 'Bahian jb', 'jb@gmail.com', '$2y$10$1M59m3GliTo51VAn.xPQB.0OcmebAKaQFAL3D1HZloRL3nFVKviYK', 'staff', '2026-06-23 00:48:17'),
(2, 'salman', 'jessereb@gmail.com', '$2y$10$3uTDuA69nhtjksVysH2Ly.h1Em57IOodal1xUNJsbkEdz05tAJx0a', 'admin', '2026-06-24 01:38:49'),
(3, 'Cyrell', 'dwasd@gmail.com', '$2y$10$LEv/naRGeXpVV3WabBH5QO.PXxkNZoM2bSP9RDMdR9asHX7mOQvzC', 'staff', '2026-06-24 01:54:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
