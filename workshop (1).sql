-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2025 at 05:33 PM
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
-- Database: `workshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `vehicle_make` varchar(50) NOT NULL,
  `vehicle_model` varchar(50) NOT NULL,
  `vehicle_year` int(11) NOT NULL,
  `service_type` varchar(100) NOT NULL,
  `preferred_date` date NOT NULL,
  `preferred_time` time NOT NULL,
  `additional_notes` text DEFAULT NULL,
  `status` enum('pending','confirmed','completed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `customer_name`, `email`, `phone`, `vehicle_make`, `vehicle_model`, `vehicle_year`, `service_type`, `preferred_date`, `preferred_time`, `additional_notes`, `status`, `created_at`) VALUES
(4, NULL, 'rae', 'faw@gmail.com', '1234567890', 'faeerg', 'gaew', 2020, 'General Service', '2025-04-17', '09:00:00', 'dfgh', 'pending', '2025-04-15 13:26:36'),
(8, NULL, '1', '1@gmail.com', '449848', 'toyota', 'camry', 2020, 'Brake Service', '2025-04-18', '10:00:00', '54654651564654', 'pending', '2025-04-15 15:04:08'),
(9, NULL, 'feawb', 'ifgsd@gmail.com', '1234567890', 'e', 'few', 2020, 'Oil Change', '2025-04-17', '10:00:00', 'feaw', 'pending', '2025-04-15 15:07:16'),
(11, 4, 'r', 'r@gmail.com', '8743784678', 'jhddyu', 'biuhd', 2020, 'General Service', '2025-04-16', '12:00:00', 'fuygdfufiusa', 'pending', '2025-04-15 15:20:06');

-- --------------------------------------------------------

--
-- Table structure for table `contact_inquiries`
--

CREATE TABLE `contact_inquiries` (
  `inquiry_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `submission_date` datetime DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0,
  `responded_by` int(11) DEFAULT NULL,
  `response` text DEFAULT NULL,
  `response_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_inquiries`
--

INSERT INTO `contact_inquiries` (`inquiry_id`, `name`, `email`, `subject`, `message`, `submission_date`, `is_read`, `responded_by`, `response`, `response_date`) VALUES
(1, 'rgeg', 'fhdh@gmail.com', 'gfdfdg', 'ga', '2025-04-15 18:32:33', 0, NULL, NULL, NULL),
(3, 'vdbisud', 'r@gmail.com', 'vsduygs', 'mnbjfbsjfbfbjkxckjcnidjfhw', '2025-04-15 20:51:17', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `status` enum('unread','read','replied') NOT NULL DEFAULT 'unread',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rating` int(1) NOT NULL,
  `message` text NOT NULL,
  `service_type` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `service_category` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `base_price` decimal(10,2) DEFAULT NULL,
  `duration_minutes` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `service_category`, `description`, `base_price`, `duration_minutes`, `is_active`) VALUES
(1, 'Basic Oil Change', 'Maintenance', 'Oil and filter change using standard oil', 39.99, 30, 1),
(2, 'Synthetic Oil Change', 'Maintenance', 'Oil and filter change using full synthetic oil', 69.99, 30, 1),
(3, 'Brake Pad Replacement', 'Repair', 'Front or rear brake pad replacement', 149.99, 60, 1),
(4, 'Engine Diagnostic', 'Diagnostic', 'Computer diagnostic to identify engine issues', 89.99, 45, 1),
(5, 'Wheel Alignment', 'Maintenance', 'Four-wheel alignment service', 79.99, 60, 1),
(6, 'Battery Replacement', 'Repair', 'Vehicle battery replacement including testing', 129.99, 30, 1),
(7, 'Air Conditioning Service', 'Maintenance', 'A/C system check and recharge', 99.99, 60, 1),
(8, 'Transmission Fluid Change', 'Maintenance', 'Complete transmission fluid flush and replacement', 149.99, 60, 1);

-- --------------------------------------------------------

--
-- Table structure for table `service_status`
--

CREATE TABLE `service_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL,
  `status_order` int(11) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_status`
--

INSERT INTO `service_status` (`status_id`, `status_name`, `status_order`, `description`) VALUES
(1, 'Received', 1, 'Vehicle received and awaiting inspection'),
(2, 'Inspection', 2, 'Vehicle undergoing diagnostic inspection'),
(3, 'In Service', 3, 'Service/repair work in progress'),
(4, 'Ready', 4, 'Service complete, vehicle ready for pickup'),
(5, 'Received', 1, 'Vehicle received and awaiting inspection'),
(6, 'Inspection', 2, 'Vehicle undergoing diagnostic inspection'),
(7, 'In Service', 3, 'Service/repair work in progress'),
(8, 'Ready', 4, 'Service complete, vehicle ready for pickup'),
(9, 'Received', 1, 'Vehicle received and awaiting inspection'),
(10, 'Inspection', 2, 'Vehicle undergoing diagnostic inspection'),
(11, 'In Service', 3, 'Service/repair work in progress'),
(12, 'Ready', 4, 'Service complete, vehicle ready for pickup'),
(13, 'Received', 1, 'Vehicle received and awaiting inspection'),
(14, 'Inspection', 2, 'Vehicle undergoing diagnostic inspection'),
(15, 'In Service', 3, 'Service/repair work in progress'),
(16, 'Ready', 4, 'Service complete, vehicle ready for pickup'),
(17, 'Received', 1, 'Vehicle received and awaiting inspection'),
(18, 'Inspection', 2, 'Vehicle undergoing diagnostic inspection'),
(19, 'In Service', 3, 'Service/repair work in progress'),
(20, 'Ready', 4, 'Service complete, vehicle ready for pickup'),
(21, 'Received', 1, 'Vehicle received and awaiting inspection'),
(22, 'Inspection', 2, 'Vehicle undergoing diagnostic inspection'),
(23, 'In Service', 3, 'Service/repair work in progress'),
(24, 'Ready', 4, 'Service complete, vehicle ready for pickup'),
(25, 'Received', 1, 'Vehicle received and awaiting inspection'),
(26, 'Inspection', 2, 'Vehicle undergoing diagnostic inspection'),
(27, 'In Service', 3, 'Service/repair work in progress'),
(28, 'Ready', 4, 'Service complete, vehicle ready for pickup'),
(29, 'Received', 1, 'Vehicle received and awaiting inspection'),
(30, 'Inspection', 2, 'Vehicle undergoing diagnostic inspection'),
(31, 'In Service', 3, 'Service/repair work in progress'),
(32, 'Ready', 4, 'Service complete, vehicle ready for pickup');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('customer','admin') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'c', 'c@gmail.com', '$2y$10$75vz2bQFI3dDnSgxaTT1K.Pk8govgIYBN6x/BE7eZxRrGwq6QTX52', 'customer', '2025-04-15 05:19:47'),
(2, 'a', 'a@gmail.com', '$2y$10$YtOHUCxB6E/DgCiOXyo0jet3WyTepHUAs5ZkmxNa7GDLF9swRR3d6', 'admin', '2025-04-15 13:58:43'),
(3, 'sh', 'sh@gmail.com', '$2y$10$F8KPfAUyTFvOnen25cld2ekih4ya4Doel6wP/2wZ312q7ncDTZ53O', 'customer', '2025-04-15 15:01:34'),
(4, 'r', 'r@gmail.com', '$2y$10$JpKsLdLaFkUf9YqFJAq0lOuddow.wDrhy/mrInbocV/EWUQ/MINpa', 'customer', '2025-04-15 15:18:32'),
(5, 's', 's@gmail.com', '$2y$10$gfLG08QfQ4I0R8ty5NvdiuR40/riCDYNFxrsL67rvEKLZSQkXmAgi', 'admin', '2025-04-15 15:23:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bookings_user_id` (`user_id`);

--
-- Indexes for table `contact_inquiries`
--
ALTER TABLE `contact_inquiries`
  ADD PRIMARY KEY (`inquiry_id`),
  ADD KEY `responded_by` (`responded_by`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `service_status`
--
ALTER TABLE `service_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact_inquiries`
--
ALTER TABLE `contact_inquiries`
  MODIFY `inquiry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `service_status`
--
ALTER TABLE `service_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_bookings_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `contact_inquiries`
--
ALTER TABLE `contact_inquiries`
  ADD CONSTRAINT `contact_inquiries_ibfk_1` FOREIGN KEY (`responded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
