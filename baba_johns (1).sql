-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2024 at 05:23 PM
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
-- Database: `baba_johns`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `created_at`) VALUES
(48, 7, '2024-12-16 08:56:15'),
(50, 9, '2024-12-18 03:08:27'),
(52, 12, '2024-12-18 05:04:17'),
(53, 20, '2024-12-18 07:39:16'),
(54, 22, '2024-12-18 07:46:18'),
(55, 19, '2024-12-18 07:48:16'),
(57, 25, '2024-12-18 07:53:30'),
(58, 27, '2024-12-22 16:20:51');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `item_name`, `item_price`, `quantity`, `created_at`) VALUES
(72, 48, 'Chocolate Milkshake', 75.00, 1, '2024-12-16 08:56:15'),
(74, 50, '6 Cheese', 350.00, 1, '2024-12-18 03:08:27'),
(76, 52, '3 Cheese X 2 Toppings', 400.00, 1, '2024-12-18 05:04:17'),
(77, 50, 'Margherita', 300.00, 1, '2024-12-18 07:30:25'),
(78, 50, 'cola', 35.00, 1, '2024-12-18 07:30:37'),
(79, 50, 'caramel milkshakes', 75.00, 1, '2024-12-18 07:30:46'),
(80, 50, 'orange juice', 50.00, 1, '2024-12-18 07:30:49'),
(83, 54, 'Super Papa', 500.00, 1, '2024-12-18 07:46:18'),
(84, 55, 'Super Papa', 500.00, 5, '2024-12-18 07:48:16'),
(87, 57, 'Chocolate Cake', 65.00, 5, '2024-12-18 07:53:30'),
(88, 57, '6 Cheese', 350.00, 1, '2024-12-18 07:53:34'),
(90, 57, 'caramel milkshakes', 75.00, 1, '2024-12-18 07:53:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `address`, `phone_number`, `password`, `email`, `is_deleted`) VALUES
(6, 'youstena', 'victoria street', '01065163220', '$2y$10$jjF.l0VHWrO0NJInacazleNafY4Fwf2eHhjfdsqMxjQdhLEFLH45y', '', 0),
(7, 'sama', 'victoria street', '01065163220', '$2y$10$Q3fbWPI.bpI05xrrrSNVD.4LeEmkHQb6LCFu42WNGUQKagLWs.NVW', '', 1),
(9, 'ahmed', 'victoria street', '01065163220', '$2y$10$SFgYPcOgSac2LMAcByvj/.MxGU6GyBzbW6OhI9z9utxktrtn.Ov4y', '', 0),
(11, 'sally', 'miami', '01236949632', '$2y$10$EFqZxPB1iYBp1CleqryIse7tThBP9Eb6Dsnx5slzPzJ50AfSDwQ6y', '', 0),
(12, 'tena', 'miami', '01142803764', '$2y$10$MPFiL.HJy09HHG/1X3X7mOkNPHVYazj7LvtvGX51TRUQkkt5w2wJe', 'tena@gmail.com', 1),
(14, 'kero', 'sidibshr', '01284885551', '$2y$10$5gRWNE25QO.E1IG3/gD.MOsUkhZbK3aV2SXjUbCGSYqKYwhbu9gGa', 'kero@gmail.com', 1),
(15, 'karas', 'miami', '01284885551', '$2y$10$OJbXZLQvnagq2ZOwG5i/ee.p5MNZcEJrHomly9lbMWP.aKSlxR7My', 'karas@gmail.com', 1),
(19, 'sama1234', 'miami', '01284885551', '$2y$10$Ol6yJbEaEYajpVmY2.isHOFN8YdLRu0VJ2YbltD8KbJRgumQfSeNu', 'sama@gmail.com', 0),
(20, 'walaaa', 'miami', '01202855822', '$2y$10$a/21b9p099P0yB9fbUaqpu6WlvgnoEGQ9GrZDbovX2QB5FS9L7n76', '', 1),
(22, 'walaaaa', 'miami', '01202855822', '$2y$10$KCD2ROG2lFujlZUVvbdeluzKahKwArz6Lgqt0xQnF/vMeZALwIa5O', '', 0),
(23, 'seif0x3', 'agami', '01211474766', '$2y$10$qw8Y3jssplyz7a5kPA9EIOXsq4HL/AKaQYAi.KG/kjfzyyTcz62rK', 'seif@gmail.com', 1),
(25, 'seif1234', 'miami', '01211474766', '$2y$10$nEMfqn7wv0iuk7si9JTwoOsHLQYNT3oKaTKcanS0IaeQlZYEtnMZa', 'seif@gmail.com', 1),
(27, 'tena1234', 'miami', '01284885551', '$2y$10$mHB6Xb1d7qKTCgZMLLgr4.9Ud/OeGmp.tGXnnCHMoHDtnq5bjeoT2', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
