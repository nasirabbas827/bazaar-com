-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2024 at 01:38 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bazaar_db`
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
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(3, 'Men'),
(4, 'Women'),
(5, 'Kids'),
(6, 'Home'),
(7, 'Electronics'),
(8, 'Pets'),
(9, 'Handbag'),
(10, 'Shoes'),
(11, 'Jewelry & Accessories'),
(12, 'Makeup'),
(14, 'Cycle');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `ComplaintID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ComplaintReason` varchar(255) NOT NULL,
  `Text` text NOT NULL,
  `SubmissionDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`ComplaintID`, `UserID`, `ComplaintReason`, `Text`, `SubmissionDate`) VALUES
(1, 12, 'aeg', 'dage', '2024-04-13 09:55:35');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `TotalPrice` decimal(10,2) NOT NULL,
  `DeliveryAddress` varchar(255) NOT NULL,
  `OrderStatus` enum('Pending','Processing','Shipped','Delivered','Cancelled') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `UserID`, `TotalPrice`, `DeliveryAddress`, `OrderStatus`) VALUES
(1, 12, 1353.75, 'jampur', 'Pending'),
(2, 12, 76712.50, 'jampur', 'Delivered'),
(3, 12, 270.75, 'jampur', 'Pending'),
(4, 12, 3790.50, 'jampur', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `OrderItemID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`OrderItemID`, `OrderID`, `ProductID`, `Quantity`) VALUES
(1, 1, 1, 5),
(2, 2, 2, 17),
(3, 3, 1, 1),
(4, 4, 1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `StockQuantity` int(11) NOT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `SellerID` int(11) DEFAULT NULL,
  `ImageURL` varchar(255) DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `ProductName`, `Description`, `Price`, `StockQuantity`, `CategoryID`, `SellerID`, `ImageURL`, `Timestamp`) VALUES
(1, 'product 1', 'daette', 300.00, 2, 11, 11, '6617be38e1943.png', '2024-04-13 10:34:57'),
(2, 'product 2', 'afeeg', 5000.00, 3, 3, 11, '6618dd345baf3.png', '2024-04-13 10:34:57'),
(3, 'abb', 'asr', 5000.00, 2345, 3, 13, '661a6d7b43e17.jpeg', '2024-04-13 08:33:15'),
(4, 'grass', 'dfgf', 4000.00, 2345, 3, 13, '661a6d920fdf1.jpeg', '2024-04-13 08:33:38');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `ReviewID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Comment` text NOT NULL,
  `Rating` int(11) NOT NULL,
  `Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`ReviewID`, `OrderID`, `UserID`, `Comment`, `Rating`, `Image`) VALUES
(1, 2, 12, 'product is good', 3, '661a3c72626934.44380107.png');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `StoreID` int(11) NOT NULL,
  `StoreName` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Location` varchar(255) NOT NULL,
  `SellerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`StoreID`, `StoreName`, `Description`, `Location`, `SellerID`) VALUES
(2, 'Nasir\'s Store', 'fgh', 'lahore', 11);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` enum('buyer','seller') NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `status` varchar(10) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `usertype`, `email`, `phone`, `status`) VALUES
(11, 'seller', '$2y$10$B7pk8QGDrTC1y2CxgKz2JekXileklwNu5IKolPVnCKwjnFUIZDT0i', 'seller', 'seller@gmail.com', '031887895222', 'approved'),
(12, 'Buyer', '$2y$10$K17n1/b0aH78M7O1gBc.qeepCZ62NUjM3UGlW6RRyKVyCs4ItbtQ2', 'buyer', 'saifx280@gmail.com', '3176526827', 'approved'),
(13, 'seller2', '$2y$10$rOGbCo70yS2G4IhIQCnzUuSdDGGMZTLyFo3r/ip03NZRnAlMuYuMy', 'seller', 'seller2@gmail.com', '03176526835', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_complaints`
--

CREATE TABLE `visitor_complaints` (
  `ComplaintID` int(11) NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `ComplaintReason` varchar(255) NOT NULL,
  `Text` text NOT NULL,
  `SubmissionDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitor_complaints`
--

INSERT INTO `visitor_complaints` (`ComplaintID`, `Username`, `ComplaintReason`, `Text`, `SubmissionDate`) VALUES
(1, '', 'aeg', 'xvcbd', '2024-04-13 08:21:31'),
(2, 'Anonymous User', 'asfdadfdgfre', 'adsf', '2024-04-13 08:23:20');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_orders`
--

CREATE TABLE `visitor_orders` (
  `OrderID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `TotalPrice` decimal(10,2) NOT NULL,
  `DeliveryAddress` varchar(255) NOT NULL,
  `OrderStatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitor_orders`
--

INSERT INTO `visitor_orders` (`OrderID`, `username`, `TotalPrice`, `DeliveryAddress`, `OrderStatus`) VALUES
(1, 'Visitor', 4512.50, 'jampur', 'Cancelled'),
(2, 'Visitor', 4512.50, 'jampur', 'Cancelled'),
(3, 'Visitor', 4512.50, 'jampur', 'Pending'),
(4, 'Visitor', 285.00, 'jampur', 'Cancelled'),
(5, 'Visitor', 4750.00, 'erfg', 'Cancelled'),
(6, 'Visitor', 285.00, 'erfg', 'Cancelled'),
(7, 'Visitor', 285.00, 'erfg', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_order_items`
--

CREATE TABLE `visitor_order_items` (
  `OrderItemID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitor_order_items`
--

INSERT INTO `visitor_order_items` (`OrderItemID`, `OrderID`, `ProductID`, `Quantity`) VALUES
(1, 1, 2, 1),
(2, 2, 2, 1),
(3, 3, 2, 1),
(4, 4, 1, 1),
(5, 5, 2, 1),
(6, 6, 1, 1),
(7, 7, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`ComplaintID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`OrderItemID`),
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `CategoryID` (`CategoryID`),
  ADD KEY `SellerID` (`SellerID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ReviewID`),
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`StoreID`),
  ADD KEY `fk_seller_id` (`SellerID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitor_complaints`
--
ALTER TABLE `visitor_complaints`
  ADD PRIMARY KEY (`ComplaintID`);

--
-- Indexes for table `visitor_orders`
--
ALTER TABLE `visitor_orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `visitor_order_items`
--
ALTER TABLE `visitor_order_items`
  ADD PRIMARY KEY (`OrderItemID`),
  ADD KEY `OrderID` (`OrderID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `ComplaintID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `OrderItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `ReviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `StoreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `visitor_complaints`
--
ALTER TABLE `visitor_complaints`
  MODIFY `ComplaintID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `visitor_orders`
--
ALTER TABLE `visitor_orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `visitor_order_items`
--
ALTER TABLE `visitor_order_items`
  MODIFY `OrderItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`SellerID`) REFERENCES `users` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`id`);

--
-- Constraints for table `stores`
--
ALTER TABLE `stores`
  ADD CONSTRAINT `fk_seller_id` FOREIGN KEY (`SellerID`) REFERENCES `users` (`id`);

--
-- Constraints for table `visitor_order_items`
--
ALTER TABLE `visitor_order_items`
  ADD CONSTRAINT `visitor_order_items_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `visitor_orders` (`OrderID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
