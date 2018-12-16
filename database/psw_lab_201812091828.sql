-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 09, 2018 at 06:28 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `psw_lab`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `category_name` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_category`, `category_name`) VALUES
(1, 'Books'),
(2, 'Videos'),
(3, 'Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `order_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_stock`
--

CREATE TABLE `orders_stock` (
  `id_order` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id_item` int(11) NOT NULL,
  `item_name` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `id_subcategory` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '100.00',
  `photo_url` varchar(100) COLLATE utf8_polish_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id_item`, `item_name`, `id_subcategory`, `price`, `photo_url`, `description`, `quantity`) VALUES
(6, 'Effective Modern C++', 2, '210.00', 'img/effective_modern_cpp.jpg', 'Scott Meyers', 20),
(7, 'Thinking In C++', 2, '80.00', 'img/thinking_in_cpp.jpg', 'Bruce Eckel', 15),
(8, 'The C++ Programming Language', 2, '100.00', 'img/the_cpp_programming_language.jpg', 'Bjarne Stroustrup', 5),
(9, 'Programming: Principles and Practice Using C++', 2, '93.45', 'img/principles_practical_using_cpp.jpg', 'Bjarne Stroustrup', 10),
(10, 'Modern C++ Design', 2, '60.00', 'img/modern_cpp_design.jpg', 'Andrei Alexandrescu\r\n', 12),
(11, 'The C Programming Language', 3, '67.16', 'img/the_c_programming_language.jpg', 'Brian Kernighan, Dennis Ritchie', 20),
(12, 'Practical C programming', 3, '25.57', 'img/practical_c_programming.jpg', 'Steve Oualline', 7),
(13, 'C Traps and Pitfalls', 3, '100.00', 'img/c_traps_and_pitfalls.jpg', 'Andrew Koenig', 2),
(14, 'C How to Program', 3, '12.24', 'img/c_how_to_program.jpg', 'Harvey Deitel, Paul Deitel', 1),
(15, 'Programming in ANSI C', 3, '34.90', 'img/programming_in_ansi_c.jpg', 'Stephen G. Kochan', 6);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id_subcategory` int(11) NOT NULL,
  `subcategory_name` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id_subcategory`, `subcategory_name`, `id_category`) VALUES
(2, 'C++', 1),
(3, 'C', 1),
(4, 'Java', 1),
(5, 'Python', 1),
(6, 'C++', 2),
(7, 'C', 2),
(8, 'Java', 2),
(9, 'Python', 2),
(10, 'T-shirts', 3),
(11, 'Caps/hats', 3),
(12, 'Mugs', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `surname` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `mobile`, `birth_date`) VALUES
(1, 'Test Name', 'Test Surname', 'test@sample.com', '', '+48 123 456 789', '2018-11-17'),
(2, 'Maciej', 'Krynica', 'm.krynica@mail.com', '', '', '2018-06-28'),
(3, 'Marta', 'Dela', 'marta.d@mail.com', '', NULL, '2018-11-02'),
(14, 'michal', 'wawrow', 'wawrow@mail.com', '$2y$10$hX9C.rbakbRjMe/7iYbGteN4crqPC3NmJZkZu1q.Wu6XW75a3ai5K', NULL, '2018-08-16'),
(15, 'Kamil', 'Nowicki', 'nowicki@mail.com', '$2y$10$sC9XofTVCCQzL1sQnFqfZ.fodJAlaPT7EO96fFkWmQCDqJsnNV.cC', '785 432 879', '1990-03-15'),
(16, 'test', '', 'test@mail.com', '$2y$10$GeUYsI0v3nPW4G.tckDpAuFZ2xeK9CklTwQMT03X0KGr7TsOQTq/G', NULL, '2018-11-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `fk_id_user_users` (`id_user`);

--
-- Indexes for table `orders_stock`
--
ALTER TABLE `orders_stock`
  ADD PRIMARY KEY (`id_order`,`id_item`),
  ADD KEY `fk_id_item_stock` (`id_item`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `fk_stock_subcategories` (`id_subcategory`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id_subcategory`),
  ADD KEY `fk_subcategories_categories` (`id_category`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_unique` (`email`),
  ADD UNIQUE KEY `mobile_unique` (`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id_subcategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_id_user_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `orders_stock`
--
ALTER TABLE `orders_stock`
  ADD CONSTRAINT `fk_id_item_stock` FOREIGN KEY (`id_item`) REFERENCES `stock` (`id_item`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_order_orders` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `fk_stock_subcategories` FOREIGN KEY (`id_subcategory`) REFERENCES `subcategories` (`id_subcategory`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `fk_subcategories_categories` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
