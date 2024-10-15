-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2024 at 03:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'r.r.soni', '50856371'),
(2, 'a.a.mandaliya ', '792001');

-- --------------------------------------------------------

--
-- Table structure for table `careers`
--

CREATE TABLE `careers` (
  `id` int(11) NOT NULL,
  `position` varchar(255) NOT NULL,
  `cover_letter` text DEFAULT NULL,
  `portfolio` varchar(255) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `careers`
--

INSERT INTO `careers` (`id`, `position`, `cover_letter`, `portfolio`, `resume`) VALUES
(1, 'sales', 'i wan to ', '', 'uploads/84.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `collaborations`
--

CREATE TABLE `collaborations` (
  `id` int(11) NOT NULL,
  `company` varchar(255) NOT NULL,
  `collab_type` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collaborations`
--

INSERT INTO `collaborations` (`id`, `company`, `collab_type`, `website`, `message`) VALUES
(2, 'rrsoni', 'event', 'http://localhost/finalhomepagewithjoint/contackus.html', 'i want to work with you'),
(3, 'rrsoni', 'event', 'http://localhost/finalhomepagewithjoint/contackus.html', 'i want to work with you');

-- --------------------------------------------------------

--
-- Table structure for table `couple`
--

CREATE TABLE `couple` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `carat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `couple`
--

INSERT INTO `couple` (`id`, `image`, `description`, `carat`) VALUES
(1, 'https://cdn.augrav.com/online/jewels/2018/11/23113318/Stylish-Heart-Couple-Pendants-1.jpg', 'pendal couple', 92);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `feedback` text NOT NULL,
  `rating` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `user_email`, `name`, `feedback`, `rating`) VALUES
(1, 'rakshitrsoni@gmail.com', 'Soni Rakshit R', 'good', 5),
(2, 'rakshitrsoni@gmail.com', 'Soni Rakshit R', 'good', 5);

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `type` enum('general','career','collaboration','vendor') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`id`, `name`, `email`, `phone`, `subject`, `message`, `type`, `created_at`) VALUES
(1, 'Soni Rakshit R ', 'rakshitsoni544@gmail.com', '6354798703', 'product', 'hi', 'general', '2024-10-14 11:28:35'),
(2, 'Soni Rakshit R ', 'rakshitsoni544@gmail.com', '6354798703', 'product', 'hi', 'general', '2024-10-14 11:28:35'),
(3, 'Soni Rakshit R', 'rakshitsoni544@gmail.com', '07226804453', NULL, NULL, 'general', '2024-10-14 11:31:15'),
(4, 'Soni Rakshit R', 'rakshitsoni544@gmail.com', '07226804453', NULL, NULL, 'general', '2024-10-14 11:31:21'),
(5, 'Soni Rakshit R', 'rakshitrsoni@gmail.com', '63547987', 'general', 'i want to work with you', 'general', '2024-10-14 11:31:34'),
(6, 'Soni Rakshit R', 'rakshitrsoni@gmail.com', '63547987', 'general', 'i want to work with you', 'general', '2024-10-14 11:31:34'),
(7, 'Soni Rakshit R', 'rakshitsoni544@gmail.com', '07226804453', NULL, NULL, 'general', '2024-10-14 11:39:46'),
(8, 'Soni Rakshit R', 'rakshitrsoni@gmail.com', '63547987', 'general', 'i', 'general', '2024-10-14 11:57:42');

-- --------------------------------------------------------

--
-- Table structure for table `man`
--

CREATE TABLE `man` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `carat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `man`
--

INSERT INTO `man` (`id`, `image`, `description`, `carat`) VALUES
(2, 'https://www.tanishq.co.in/on/demandware.static/-/Sites-Tanishq-product-catalog/default/dwcefbc364/images/hi-res/512621PKCAAA00_1.jpg', 'pendal', 92),
(3, 'https://www.tanishq.co.in/on/demandware.static/-/Sites-Tanishq-product-catalog/default/dwcefbc364/images/hi-res/512621PKCAAA00_1.jpg', 'pendal', 92);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `cardname` varchar(100) DEFAULT NULL,
  `cardnumber` varchar(20) DEFAULT NULL,
  `expmonth` varchar(10) DEFAULT NULL,
  `expyear` varchar(10) DEFAULT NULL,
  `cvv` varchar(10) DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `email`, `firstname`, `address`, `city`, `state`, `zip`, `cardname`, `cardnumber`, `expmonth`, `expyear`, `cvv`, `payment_status`, `created_at`) VALUES
(1, 'rakshitrsoni@gmail.com', 'ofp', 'v', 'mu', 'beglor', '382424', 'om', '1234567890', 'oc', '2018', '366', 'Not Completed', '2024-10-14 12:02:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES
(1, 'r.r.soni', 'rakshitrsoni@gmail.com', '$2y$10$bSIKPL/dB5iKYShORrkx8eHdm/ExJWcDOtYxpBt/hfr4sHmwhpJgG');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `company` varchar(255) NOT NULL,
  `product_service` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `company`, `product_service`, `website`, `message`, `created_at`) VALUES
(1, 'rrsoni', 'making', 'http://localhost/finalhomepagewithjoint/contackus.html', 'i want to work with you', '2024-10-14 11:55:16');

-- --------------------------------------------------------

--
-- Table structure for table `woman`
--

CREATE TABLE `woman` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `carat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `woman`
--

INSERT INTO `woman` (`id`, `image`, `description`, `carat`) VALUES
(1, 'https://www.tanishq.co.in/on/demandware.static/-/Sites-Tanishq-product-catalog/default/dwcefbc364/images/hi-res/512621PKCAAA00_1.jpg', 'pendal', 84),
(2, 'https://www.tanishq.co.in/on/demandware.static/-/Sites-Tanishq-product-catalog/default/dwcefbc364/images/hi-res/512621PKCAAA00_1.jpg', 'pendal', 92),
(3, 'https://di2ponv0v5otw.cloudfront.net/posts/2022/10/21/63531037c026864831398c31/m_635314037dfcc21abd8bd0d6.jpeg', 'woman pendal', 92);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `careers`
--
ALTER TABLE `careers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collaborations`
--
ALTER TABLE `collaborations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `couple`
--
ALTER TABLE `couple`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_email` (`user_email`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `man`
--
ALTER TABLE `man`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `woman`
--
ALTER TABLE `woman`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `careers`
--
ALTER TABLE `careers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `collaborations`
--
ALTER TABLE `collaborations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `couple`
--
ALTER TABLE `couple`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `man`
--
ALTER TABLE `man`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `woman`
--
ALTER TABLE `woman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
