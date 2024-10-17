-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2024 at 10:25 AM
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
-- Database: `group04_hdcse_cmu_65`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'hslanka', 'hslanka7', 'hslanka7@gmail.com', '2024-10-03 07:30:43');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `code`, `name`, `image`, `description`) VALUES
(1, '001', 'Beauty Products', './uploads/categories/bg6.jpg', 'This category involves all the cosmetics.'),
(2, '002', 'Electronics', './uploads/categories/adminbg.jpeg', 'all electronic items'),
(3, '003', 'Home and Living', './uploads/categories/spc2.png', 'home needed items'),
(4, '004', 'Watches and Bags', './uploads/categories/spc3.jpg', 'watches and bags for men and women');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `username`, `email`, `password`) VALUES
(4, 'vajira', 'vaji56@gmail.com', '$2y$10$rowsEdkRCnMr70T8uAxAOe7RA0WwoA0OFSBFQk4kLce4w5rFSxO7y'),
(5, 'Anusha', 'anusha67@gmail.com', '$2y$10$WHWQnEJOWTAJsowg.5h6Q.TC0nIl9WAXdXsqiUA8l2PBjFX87.lvC');

-- --------------------------------------------------------

--
-- Table structure for table `customer_profile`
--

CREATE TABLE `customer_profile` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `address_line1` varchar(255) DEFAULT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `District` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `Email_address` varchar(100) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `Profile_image` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_profile`
--

INSERT INTO `customer_profile` (`id`, `first_name`, `last_name`, `address_line1`, `address_line2`, `District`, `City`, `postal_code`, `Email_address`, `phone_number`, `Profile_image`) VALUES
(1, 'Vajira', 'Bandara', 'NO 17/A,', 'Kandy', 'Kandy', 'Kandy', '20000', 'vajira56@gmail.com', '0773036034', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `facility_id` int(11) NOT NULL,
  `facility_name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`facility_id`, `facility_name`, `description`) VALUES
(1, 'online delivery option', 'we provide you a fast online delivery to your door step');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `offer_id` int(11) NOT NULL,
  `offer_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`offer_id`, `offer_name`, `description`, `created_at`) VALUES
(1, '50%', 'we provide you 50% offer if you purchase 3 items at onces ', '2024-10-03 07:25:25');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `availability` tinyint(1) NOT NULL DEFAULT 1,
  `image` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `description`, `quantity`, `Price`, `availability`, `image`, `category_id`) VALUES
(1, '0001', 'eyeliner', 'The miss Rose eyeliner black', 7, 700, 1, './uploads/products/be8.jpg', 1),
(2, '003', 'face wash', 'good face wash acneces remover', 3, 850, 1, './uploads/products/ba3.jpg', 1),
(4, '004', 'under arm hair remover', 'this machine is used to remove any unwanted hair in under arms.', 10, 1500, 1, './uploads/products/e3.jpg', 2),
(5, '005', 'whitening face wash', 'mild formular, deep cleansing, extra mositurizing and pH- balance', 20, 1250, 1, './uploads/products/ba4.jpg', 1),
(6, '006', 'Jovees Face Wash', 'remove dull,oily,combination skins and give a fresh bright skin', 13, 1020, 1, './uploads/products/be2.jpg', 1),
(7, '007', 'Miss rose matte Lipstick', 'Matte can use 24/7 hours', 15, 650, 1, './uploads/products/be3.jpg', 1),
(8, '008', 'Headset', 'compatible with Bluetooth- enable Appliances such as smartphones/Laptops/smart TV\'s', 24, 2580, 1, './uploads/products/e1.jpg', 2),
(9, '009', 'head light lamp', 'this includes spray humidification system, soft night light set and a mild mosquito repellent', 40, 1800, 1, './uploads/products/e5.jpg', 2),
(10, '010', 'Mini Waffle Marker', 'non strick surface . fast and easy to work.', 10, 4500, 1, './uploads/products/e6.jpg', 2),
(11, '011', 'Air cooler Fan', 'strong air supply of thrid gear turbine', 104, 1850, 1, './uploads/products/f1.jpg', 2),
(12, '013', 'Dumpling marker', 'make your home work easier', 13, 2450, 1, './uploads/products/d1.jpg', 3),
(13, '018', 'Bunny Bag', 'cute bag for ladies and children', 13, 1700, 1, './uploads/products/b2.jpg', 4),
(14, '019', 'ladies watch', 'brand new ladies watches', 20, 1200, 1, './uploads/products/IMG-20240811-WA0026.jpg', 4),
(15, '014', 'Silver saucepan', 'a set with 6 saucepans', 45, 3000, 1, './uploads/products/h1.jpg', 3),
(16, '015', 'waterproof sticker', 'waterproof sticker for kitchen 8m long one', 16, 1200, 1, './uploads/products/k2.jpg', 3),
(17, '017', 'cooking lunch box', 'set of lunch boxes consist of 4 pieces and a cooking pan', 13, 2700, 1, './uploads/products/l1.jpg', 3),
(18, '016', 'clothe rank', 'clothing rank', 15, 5000, 1, './uploads/products/rk2.jpg', 3),
(19, '020', 'Fancy hand bags', 'cute hand bags 6cm - 8cm hight ', 20, 1400, 1, './uploads/products/IMG-20240828-WA0021.jpg', 4),
(20, '021', 'men watches', 'fancy mens  ', 20, 1300, 1, './uploads/products/p1.jpg', 4),
(21, '022', 'led watch ', 'both men and wemen can wear', 30, 890, 1, './uploads/products/w3.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `customer_username` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `email`, `customer_username`, `message`, `created_at`) VALUES
(1, 'ruwini yashodhara', 'ria56@gmail.com', 'ruwini', 'I really love this shop', '2024-10-03 07:23:52');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `description`, `created_at`) VALUES
(1, 'online', 'the online service', '2024-10-03 07:25:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_profile`
--
ALTER TABLE `customer_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`facility_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`offer_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer_profile`
--
ALTER TABLE `customer_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `facility_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
