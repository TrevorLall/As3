-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2016 at 04:47 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment3`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(9) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `city` varchar(20) NOT NULL,
  `province` varchar(15) NOT NULL,
  `street` varchar(50) NOT NULL,
  `postal_code` varchar(7) NOT NULL,
  `country` varchar(20) NOT NULL,
  `user_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(9) NOT NULL,
  `cat_desc` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_desc`) VALUES
(1, 'Electronics');

-- --------------------------------------------------------

--
-- Table structure for table `inv_items`
--

CREATE TABLE `inv_items` (
  `item_id` int(9) NOT NULL,
  `item_name` varchar(20) NOT NULL,
  `item_price` double(10,2) NOT NULL,
  `item_desc` varchar(38) NOT NULL,
  `item_qoh` int(38) NOT NULL,
  `item_image` blob,
  `sale_start` date NOT NULL,
  `sale_end` date NOT NULL,
  `cat_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inv_items`
--

INSERT INTO `inv_items` (`item_id`, `item_name`, `item_price`, `item_desc`, `item_qoh`, `item_image`, `sale_start`, `sale_end`, `cat_id`) VALUES
(1, 'Earphones', 22.00, 'The best for the price!', 22, NULL, '2016-04-13', '2016-04-14', 1),
(3, 'Television', 22.00, 'Cheap! Cheap!', 5, 0x6e756c6c, '2016-04-08', '2016-04-15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_roles`
--

CREATE TABLE `login_roles` (
  `role_id` int(9) NOT NULL,
  `role_desc` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_roles`
--

INSERT INTO `login_roles` (`role_id`, `role_desc`) VALUES
(1, 'admin'),
(2, 'client');

-- --------------------------------------------------------

--
-- Table structure for table `login_users`
--

CREATE TABLE `login_users` (
  `user_id` int(9) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_users`
--

INSERT INTO `login_users` (`user_id`, `username`, `password`, `role_id`) VALUES
(13, 'admin', 'admin', 1),
(17, 'Trevor', 'Lall', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(9) NOT NULL,
  `order_date` date DEFAULT NULL,
  `user_id` int(9) NOT NULL,
  `address_id` int(9) NOT NULL,
  `payment_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `od_id` int(9) NOT NULL,
  `quantity` int(38) NOT NULL,
  `sale_price` double(10,2) NOT NULL,
  `item_id` int(9) NOT NULL,
  `order_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `payment_id` int(9) NOT NULL,
  `credit_type` varchar(20) NOT NULL,
  `card_number` varchar(9) NOT NULL,
  `security_code` varchar(9) NOT NULL,
  `exp_date` date NOT NULL,
  `user_id` int(9) NOT NULL,
  `address_id` int(9) NOT NULL,
  `card_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `inv_items`
--
ALTER TABLE `inv_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `cat_id_2` (`cat_id`);

--
-- Indexes for table `login_roles`
--
ALTER TABLE `login_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `login_users`
--
ALTER TABLE `login_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `address_id` (`address_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`od_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `address_id` (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `inv_items`
--
ALTER TABLE `inv_items`
  MODIFY `item_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `login_roles`
--
ALTER TABLE `login_roles`
  MODIFY `role_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login_users`
--
ALTER TABLE `login_users`
  MODIFY `user_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `od_id` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `payment_id` int(9) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `login_users` (`user_id`);

--
-- Constraints for table `inv_items`
--
ALTER TABLE `inv_items`
  ADD CONSTRAINT `inv_items_cat_id_fk` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`);

--
-- Constraints for table `login_users`
--
ALTER TABLE `login_users`
  ADD CONSTRAINT `login_users_role_id_fk` FOREIGN KEY (`role_id`) REFERENCES `login_roles` (`role_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `order_address_id_fk` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`),
  ADD CONSTRAINT `order_payment_id_fk` FOREIGN KEY (`payment_id`) REFERENCES `payment_method` (`payment_id`),
  ADD CONSTRAINT `order_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `login_users` (`user_id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `od_item_id_fk` FOREIGN KEY (`item_id`) REFERENCES `inv_items` (`item_id`),
  ADD CONSTRAINT `od_order_id_fk` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD CONSTRAINT `pm_address_id_fk` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`),
  ADD CONSTRAINT `pm_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `login_users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
