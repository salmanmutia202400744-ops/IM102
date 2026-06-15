-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2026 at 04:13 AM
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
-- Database: `im102_lab2`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Coffee Beans'),
(2, 'Syrups & Sauces'),
(3, 'Fresh Pastries'),
(4, 'Dairy & Alternatives'),
(5, 'Branded Merchandise');

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
  `category_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `category_id`, `supplier_id`, `created_at`) VALUES
(1, 'Espresso Blend (1kg)', 'Dark roast, chocolate notes', 1250.00, 25, 1, 1, '2026-06-15 01:22:06'),
(2, 'Ethiopian Yirgacheffe (1kg)', 'Light roast, floral and citrus', 1450.00, 12, 1, 1, '2026-06-15 01:22:06'),
(3, 'Decaf Colombia (500g)', 'Medium roast, smooth finish', 750.00, 8, 1, 1, '2026-06-15 01:22:06'),
(4, 'Vanilla Syrup (1L)', 'Premium Madagascar vanilla', 480.00, 30, 2, 3, '2026-06-15 01:22:06'),
(5, 'Caramel Sauce (2kg)', 'Rich, buttery ice cream & drink topper', 950.00, 15, 2, 3, '2026-06-15 01:22:06'),
(6, 'Pure Matcha Powder (500g)', 'Culinary grade ceremonial matcha', 1100.00, 10, 2, 3, '2026-06-15 01:22:06'),
(7, 'Butter Croissant', 'Flaky, French style, baked daily', 95.00, 40, 3, 2, '2026-06-15 01:22:06'),
(8, 'Blueberry Muffin', 'Real blueberries with crumble top', 110.00, 20, 3, 2, '2026-06-15 01:22:06'),
(9, 'Whole Milk (1L)', 'Barista edition, high foamability', 85.00, 60, 4, 2, '2026-06-15 01:22:06'),
(10, 'Oat Milk (1L)', 'Plant-based, unsweetened', 150.00, 48, 4, 2, '2026-06-15 01:22:06'),
(11, 'Ceramic Logo Mug (12oz)', 'Matte black with white logo', 350.00, 18, 5, 3, '2026-06-15 01:22:06'),
(12, 'Insulated Tumbler (20oz)', 'Keeps drinks cold for 24 hours', 890.00, 14, 5, 3, '2026-06-15 01:22:06');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(150) NOT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_name`, `contact_person`, `phone`) VALUES
(1, 'Summit Roasters Co.', 'Alex Mercer', '0912-345-6789'),
(2, 'Golden Harvest Dairy', 'Elena Rostova', '0917-987-6543'),
(3, 'Barista Essentials Ltd.', 'Kenji Sato', '0922-555-0192');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

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
  ADD PRIMARY KEY (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
