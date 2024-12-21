-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 21, 2024 at 12:56 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `address` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`, `created_at`) VALUES
(1, 'Bhautik Agheda', 'bhautik5471@gmail.com', '1234567890', '123 Elm Street', '2024-12-18 11:33:39'),
(6, 'Timothy Bowen', 'nisi.nibh@google.net', '1-473-744-2622', '343-5853 Ut St.', '2024-12-21 06:39:38'),
(12, 'Carolyn Burgess', 'quis@google.com', '(330) 185-7754', '3238 Duis St.', '2024-12-21 06:44:12'),
(13, 'Garth Weaver', 'erat.vel.pede@aol.ca', '1-594-799-6606', '520-8108 Placerat, Avenue', '2024-12-21 06:44:46'),
(14, 'John Doe', 'john.doe@example.com', '1234567890', '123 Main St, Springfield', '2024-12-21 06:46:44'),
(15, 'Jane Smith', 'jane.smith@example.com', '2345678901', '456 Elm St, Shelbyville', '2024-12-21 06:46:44'),
(16, 'Alice Johnson', 'alice.johnson@example.com', '3456789012', '789 Maple St, Ogdenville', '2024-12-21 06:46:44'),
(17, 'Bob Brown', 'bob.brown@example.com', '4567890123', '321 Oak St, Capital City', '2024-12-21 06:46:44'),
(18, 'Charlie White', 'charlie.white@example.com', '5678901234', '654 Pine St, Evergreen', '2024-12-21 06:46:44'),
(19, 'Daisy Black', 'daisy.black@example.com', '6789012345', '987 Cedar St, Springfield', '2024-12-21 06:46:44'),
(20, 'Ethan Green', 'ethan.green@example.com', '7890123456', '123 Birch St, Shelbyville', '2024-12-21 06:46:44'),
(21, 'Fiona Blue', 'fiona.blue@example.com', '8901234567', '456 Walnut St, Ogdenville', '2024-12-21 06:46:44'),
(22, 'George Red', 'george.red@example.com', '9012345678', '789 Cherry St, Capital City', '2024-12-21 06:46:44'),
(23, 'Hannah Yellow', 'hannah.yellow@example.com', '0123456789', '321 Fir St, Evergreen', '2024-12-21 06:46:44'),
(24, 'Isaac Grey', 'isaac.grey@example.com', '1122334455', '654 Beech St, Springfield', '2024-12-21 06:46:44'),
(25, 'Jenna Violet', 'jenna.violet@example.com', '2233445566', '987 Ash St, Shelbyville', '2024-12-21 06:46:44'),
(26, 'Kyle Orange', 'kyle.orange@example.com', '3344556677', '123 Poplar St, Ogdenville', '2024-12-21 06:46:44'),
(27, 'Laura Cyan', 'laura.cyan@example.com', '4455667788', '456 Spruce St, Capital City', '2024-12-21 06:46:44'),
(28, 'Michael Brown', 'michael.brown@example.com', '5566778899', '789 Sycamore St, Evergreen', '2024-12-21 06:46:44'),
(29, 'Nina Pink', 'nina.pink@example.com', '6677889900', '321 Chestnut St, Springfield', '2024-12-21 06:46:44'),
(30, 'Oscar Purple', 'oscar.purple@example.com', '7788990011', '654 Redwood St, Shelbyville', '2024-12-21 06:46:44'),
(31, 'Paula Lime', 'paula.lime@example.com', '8899001122', '987 Sequoia St, Ogdenville', '2024-12-21 06:46:44'),
(32, 'Quincy Gold', 'quincy.gold@example.com', '9900112233', '123 Willow St, Capital City', '2024-12-21 06:46:44'),
(33, 'Rita Silver', 'rita.silver@example.com', '0011223344', '456 Magnolia St, Evergreen', '2024-12-21 06:46:44');

-- --------------------------------------------------------

--
-- Table structure for table `email_logs`
--

CREATE TABLE `email_logs` (
  `id` int NOT NULL,
  `customer_id` int NOT NULL,
  `email_template_id` int NOT NULL,
  `subject` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `status` enum('sent','failed') COLLATE utf8mb4_general_ci NOT NULL,
  `sent_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `error_message` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email_logs`
--

INSERT INTO `email_logs` (`id`, `customer_id`, `email_template_id`, `subject`, `email`, `message`, `status`, `sent_at`, `error_message`) VALUES
(1, 1, 3, 'Welcome to Our Service!', 'bhautik5471@gmail.com', 'Hello Bhautik Agheda, welcome to our service! We\'re excited to have you on board.', 'failed', '2024-12-21 06:22:45', 'SMTP Error: Could not connect to SMTP host. Failed to connect to serverSMTP server error: Failed to connect to server Additional SMTP info: php_network_getaddresses: getaddrinfo for smtp.gmail.com failed: No such host is known. '),
(2, 1, 4, 'Exclusive Offer Just for You!', 'bhautik5471@gmail.com', 'Hello Bhautik Agheda, check out our latest exclusive offer just for you!', 'sent', '2024-12-21 06:27:34', NULL),
(3, 1, 3, 'Welcome to Our Service!', 'bhautik5471@gmail.com', 'Hello Bhautik Agheda, welcome to our service! We\'re excited to have you on board.', 'sent', '2024-12-21 06:27:48', NULL),
(4, 1, 3, 'Welcome to Our Service!', 'bhautik5471@gmail.com', 'Hello Bhautik Agheda, welcome to our service! We\'re excited to have you on board.', 'sent', '2024-12-21 06:51:19', NULL),
(5, 6, 3, 'Welcome to Our Service!', 'nisi.nibh@google.net', 'Hello Timothy Bowen, welcome to our service! We\'re excited to have you on board.', 'sent', '2024-12-21 06:51:26', NULL),
(7, 12, 3, 'Welcome to Our Service!', 'quis@google.com', 'Hello Carolyn Burgess, welcome to our service! We\'re excited to have you on board.', 'sent', '2024-12-21 06:51:37', NULL),
(8, 13, 3, 'Welcome to Our Service!', 'erat.vel.pede@aol.ca', 'Hello Garth Weaver, welcome to our service! We\'re excited to have you on board.', 'sent', '2024-12-21 06:51:43', NULL),
(9, 14, 3, 'Welcome to Our Service!', 'john.doe@example.com', 'Hello John Doe, welcome to our service! We\'re excited to have you on board.', 'sent', '2024-12-21 06:51:48', NULL),
(10, 15, 3, 'Welcome to Our Service!', 'jane.smith@example.com', 'Hello Jane Smith, welcome to our service! We\'re excited to have you on board.', 'sent', '2024-12-21 06:51:54', NULL),
(11, 16, 3, 'Welcome to Our Service!', 'alice.johnson@example.com', 'Hello Alice Johnson, welcome to our service! We\'re excited to have you on board.', 'sent', '2024-12-21 06:51:59', NULL),
(12, 17, 3, 'Welcome to Our Service!', 'bob.brown@example.com', 'Hello Bob Brown, welcome to our service! We\'re excited to have you on board.', 'sent', '2024-12-21 06:52:05', NULL),
(13, 18, 3, 'Welcome to Our Service!', 'charlie.white@example.com', 'Hello Charlie White, welcome to our service! We\'re excited to have you on board.', 'sent', '2024-12-21 06:52:11', NULL),
(14, 19, 3, 'Welcome to Our Service!', 'daisy.black@example.com', 'Hello Daisy Black, welcome to our service! We\'re excited to have you on board.', 'sent', '2024-12-21 06:52:16', NULL),
(15, 20, 3, 'Welcome to Our Service!', 'ethan.green@example.com', 'Hello Ethan Green, welcome to our service! We\'re excited to have you on board.', 'sent', '2024-12-21 06:52:21', NULL),
(16, 21, 3, 'Welcome to Our Service!', 'fiona.blue@example.com', 'Hello Fiona Blue, welcome to our service! We\'re excited to have you on board.', 'sent', '2024-12-21 06:52:28', NULL),
(17, 22, 3, 'Welcome to Our Service!', 'george.red@example.com', 'Hello George Red, welcome to our service! We\'re excited to have you on board.', 'sent', '2024-12-21 06:52:33', NULL),
(18, 23, 3, 'Welcome to Our Service!', 'hannah.yellow@example.com', 'Hello Hannah Yellow, welcome to our service! We\'re excited to have you on board.', 'sent', '2024-12-21 06:52:37', NULL),
(19, 24, 3, 'Welcome to Our Service!', 'isaac.grey@example.com', 'Hello Isaac Grey, welcome to our service! We\'re excited to have you on board.', 'sent', '2024-12-21 06:52:43', NULL),
(20, 25, 3, 'Welcome to Our Service!', 'jenna.violet@example.com', 'Hello Jenna Violet, welcome to our service! We\'re excited to have you on board.', 'sent', '2024-12-21 06:52:48', NULL),
(21, 26, 3, 'Welcome to Our Service!', 'kyle.orange@example.com', 'Hello Kyle Orange, welcome to our service! We\'re excited to have you on board.', 'sent', '2024-12-21 06:52:54', NULL),
(22, 27, 3, 'Welcome to Our Service!', 'laura.cyan@example.com', 'Hello Laura Cyan, welcome to our service! We\'re excited to have you on board.', 'sent', '2024-12-21 06:52:59', NULL),
(23, 28, 3, 'Welcome to Our Service!', 'michael.brown@example.com', 'Hello Michael Brown, welcome to our service! We\'re excited to have you on board.', 'sent', '2024-12-21 06:53:05', NULL),
(24, 29, 3, 'Welcome to Our Service!', 'nina.pink@example.com', 'Hello Nina Pink, welcome to our service! We\'re excited to have you on board.', 'sent', '2024-12-21 06:53:12', NULL),
(25, 30, 3, 'Welcome to Our Service!', 'oscar.purple@example.com', 'Hello Oscar Purple, welcome to our service! We\'re excited to have you on board.', 'sent', '2024-12-21 06:53:18', NULL),
(26, 31, 3, 'Welcome to Our Service!', 'paula.lime@example.com', 'Hello Paula Lime, welcome to our service! We\'re excited to have you on board.', 'sent', '2024-12-21 06:53:23', NULL),
(27, 32, 3, 'Welcome to Our Service!', 'quincy.gold@example.com', 'Hello Quincy Gold, welcome to our service! We\'re excited to have you on board.', 'sent', '2024-12-21 06:53:29', NULL),
(28, 33, 3, 'Welcome to Our Service!', 'rita.silver@example.com', 'Hello Rita Silver, welcome to our service! We\'re excited to have you on board.', 'sent', '2024-12-21 06:53:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `body` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `name`, `subject`, `body`, `created_at`) VALUES
(3, 'Welcome Email', 'Welcome to Our Service!', 'Hello {{name}}, welcome to our service! We\'re excited to have you on board.', '2024-12-21 04:25:39'),
(4, 'Special Offer', 'Exclusive Offer Just for You!', 'Hello {{name}}, check out our latest exclusive offer just for you!', '2024-12-21 04:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'admin', '$2y$10$QfkH2R2iSwnMuf5QVNHKvuCK.26/f2IXpxR7OYu0omuBwpWfe/ku2', 'admin@admin.com', '2024-12-21 06:20:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `email_logs`
--
ALTER TABLE `email_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `email_template_id` (`email_template_id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
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
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `email_logs`
--
ALTER TABLE `email_logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `email_logs`
--
ALTER TABLE `email_logs`
  ADD CONSTRAINT `email_logs_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `email_logs_ibfk_2` FOREIGN KEY (`email_template_id`) REFERENCES `email_templates` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
