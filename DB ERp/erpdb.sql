-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2025 at 12:13 PM
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
-- Database: `erpdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `billNo` varchar(10) NOT NULL,
  `itemCode` varchar(10) NOT NULL,
  `id` varchar(10) NOT NULL,
  `unitCount` int(5) NOT NULL,
  `netPrice` decimal(10,0) NOT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`billNo`, `itemCode`, `id`, `unitCount`, `netPrice`, `timeStamp`) VALUES
('1293847506', 'itm100006', 'cst1005', 3, 630000, '2025-03-15 11:50:00'),
('1938475620', 'itm100016', 'cst1019', 3, 255000, '2025-04-06 07:00:00'),
('2405918376', 'itm100004', 'cst1016', 2, 360000, '2025-04-02 03:55:00'),
('2956713084', 'itm100018', 'cst1012', 3, 84000, '2025-03-25 11:15:00'),
('3649105728', 'itm100017', 'cst1015', 6, 48000, '2025-03-29 02:30:00'),
('3849201573', 'itm100001', 'cst1001', 2, 290000, '2025-03-05 04:30:00'),
('4815093726', 'itm100015', 'cst1004', 1, 85000, '2025-03-12 03:30:00'),
('5182069473', 'itm100022', 'cst1014', 1, 98000, '2025-03-27 05:20:00'),
('5479031826', 'itm100019', 'cst1008', 4, 72000, '2025-03-19 04:40:00'),
('6189374502', 'itm100011', 'cst1009', 1, 55000, '2025-03-21 06:30:00'),
('6519372048', 'itm100024', 'cst1018', 2, 460000, '2025-04-05 06:15:00'),
('7092836154', 'itm100028', 'cst1010', 2, 120000, '2025-03-22 10:10:00'),
('7361509482', 'itm100012', 'cst1003', 1, 72000, '2025-03-10 09:00:00'),
('7368205914', 'itm100026', 'cst1013', 2, 420000, '2025-03-26 03:50:00'),
('8201934756', 'itm100025', 'cst1011', 1, 180000, '2025-03-24 06:00:00'),
('8362054719', 'itm100010', 'cst1007', 1, 200000, '2025-03-18 08:15:00'),
('8527013946', 'itm100005', 'cst1020', 1, 325000, '2025-04-07 10:25:00'),
('9154726038', 'itm100007', 'cst1002', 1, 245000, '2025-03-07 05:45:00'),
('9275613048', 'itm100020', 'cst1006', 2, 104000, '2025-03-17 03:20:00'),
('9305841726', 'itm100021', 'cst1017', 1, 72000, '2025-04-03 08:40:00');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `idCt` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `categorySub` varchar(50) NOT NULL,
  `timeStamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`idCt`, `category`, `categorySub`, `timeStamp`) VALUES
(1, 'Electronics', 'Mobile Phones', '2025-11-04 19:45:22'),
(2, 'Electronics', 'Laptops', '2025-11-04 19:45:22'),
(3, 'Electronics', 'Televisions', '2025-11-04 19:45:22'),
(4, 'Electronics', 'Headphones', '2025-11-04 19:45:22'),
(5, 'Electronics', 'Cameras', '2025-11-04 19:45:22'),
(6, 'Electronics', 'Smart Watches', '2025-11-04 19:45:22'),
(7, 'Electronics', 'Speakers', '2025-11-04 19:45:22'),
(8, 'Electronics', 'Tablets', '2025-11-04 19:45:22'),
(9, 'Electronics', 'Gaming Consoles', '2025-11-04 19:45:22'),
(10, 'Electronics', 'Monitors', '2025-11-04 19:45:22'),
(11, 'Furniture', 'Sofas', '2025-11-04 19:45:22'),
(12, 'Furniture', 'Chairs', '2025-11-04 19:45:22'),
(13, 'Furniture', 'Beds', '2025-11-04 19:45:22'),
(14, 'Furniture', 'Dining Tables', '2025-11-04 19:45:22'),
(15, 'Furniture', 'Wardrobes', '2025-11-04 19:45:22'),
(16, 'Furniture', 'Coffee Tables', '2025-11-04 19:45:22'),
(17, 'Furniture', 'TV Stands', '2025-11-04 19:45:22'),
(18, 'Furniture', 'Bookshelves', '2025-11-04 19:45:22'),
(19, 'Furniture', 'Office Desks', '2025-11-04 19:45:22'),
(20, 'Furniture', 'Recliners', '2025-11-04 19:45:22');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` varchar(10) NOT NULL,
  `title` varchar(5) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `district` varchar(20) NOT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `title`, `firstName`, `lastName`, `contact`, `district`, `timeStamp`) VALUES
('cst1001', 'Mr', 'Kavindu', 'Perera', '0712345670', 'Colombo', '2025-01-10 04:00:00'),
('cst1002', 'Mrs', 'Sanduni', 'Silva', '0771234567', 'Gampaha', '2025-01-12 04:45:00'),
('cst1003', 'Miss', 'Nadeesha', 'Fernando', '0759876543', 'Kandy', '2025-01-15 09:15:00'),
('cst1004', 'Dr', 'Ruwan', 'Jayasinghe', '0781122334', 'Galle', '2025-01-18 02:50:00'),
('cst1005', 'Mr', 'Tharindu', 'De Silva', '0745566778', 'Matara', '2025-01-20 05:30:00'),
('cst1006', 'Mrs', 'Dilani', 'Perera', '0766677889', 'Kurunegala', '2025-01-23 11:15:00'),
('cst1007', 'Miss', 'Hasini', 'Wijesinghe', '0717788990', 'Anuradhapura', '2025-02-02 03:30:00'),
('cst1008', 'Dr', 'Chaminda', 'Karunaratne', '0785566778', 'Polonnaruwa', '2025-02-05 07:50:00'),
('cst10090', 'Mr', 'Isuru', 'Gunawardena', '0778899001', 'Nuwara Eliya', '2025-02-10 12:00:00'),
('cst1010', 'Mrs', 'Nirosha', 'Dissanayake', '0749900112', 'Kalutara', '2025-02-15 02:15:00'),
('cst1011', 'Miss', 'Amaya', 'Rathnayake', '0712233445', 'Hambantota', '2025-03-03 10:00:00'),
('cst1012', 'Dr', 'Suren', 'Wijeratne', '0753344556', 'Badulla', '2025-03-05 03:45:00'),
('cst1013', 'Mr', 'Chathura', 'Senanayake', '0774455667', 'Matale', '2025-03-08 05:20:00'),
('cst1014', 'Mrs', 'Nisansala', 'Ekanayake', '0785566777', 'Kegalle', '2025-03-10 13:10:00'),
('cst1015', 'Miss', 'Piumi', 'Hettiarachchi', '0766677880', 'Ampara', '2025-03-15 06:55:00'),
('cst1016', 'Dr', 'Manjula', 'Ranasinghe', '0757788999', 'Trincomalee', '2025-03-20 01:40:00'),
('cst1017', 'Mr', 'Ashen', 'Dias', '0718899000', 'Jaffna', '2025-04-02 08:35:00'),
('cst1018', 'Mrs', 'Shashika', 'Bandara', '0749900221', 'Kilinochchi', '2025-04-06 11:00:00'),
('cst1019', 'Miss', 'Sajini', 'Abeywickrama', '0780011223', 'Mannar', '2025-04-09 04:15:00'),
('cst1020', 'Dr', 'Nalin', 'Pathirana', '0761122334', 'Vavuniya', '2025-04-13 06:25:00'),
('cst1021', 'Mr', 'Pasindu', 'Kumara', '0752233445', 'Mullaitivu', '2025-04-15 08:00:00'),
('cst1022', 'Mrs', 'Ishara', 'Weerasinghe', '0713344556', 'Batticaloa', '2025-04-18 05:10:00'),
('cst1023', 'Miss', 'Chalani', 'Rajapaksha', '0774455668', 'Ratnapura', '2025-04-20 09:30:00'),
('cst1024', 'Dr', 'Lasantha', 'Gunasekara', '0785566779', 'Monaragala', '2025-04-25 12:15:00'),
('cst1025', 'Mr', 'Kasun', 'Wickramasinghe', '0746677889', 'Puttalam', '2025-05-01 03:50:00'),
('cst1026', 'Mrs', 'Thisara', 'Jayawardena', '0767788991', 'Kurunegala', '2025-05-05 02:40:00'),
('cst1027', 'Miss', 'Iresha', 'Fernando', '0788899002', 'Colombo', '2025-05-10 13:30:00'),
('cst1028', 'Dr', 'Samantha', 'Perera', '0759900112', 'Kandy', '2025-05-13 02:05:00'),
('cst1029', 'Mr', 'Dinuka', 'Karunarathna', '0770011223', 'Colombo', '2025-05-17 05:55:00'),
('cst1030', 'Mrs', 'Harshini', 'Dias', '0712233554', 'Kandy', '2025-05-20 11:25:00');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemCode` varchar(10) NOT NULL,
  `itemName` varchar(50) NOT NULL,
  `idCt` int(11) NOT NULL,
  `quantity` int(100) NOT NULL,
  `unitPrice` varchar(20) NOT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemCode`, `itemName`, `idCt`, `quantity`, `unitPrice`, `timeStamp`) VALUES
('itm100001', 'Dell Inspiron 15', 1, 25, '145000', '2025-01-01 04:40:00'),
('itm100002', 'HP Pavilion x360', 2, 40, '152000', '2025-01-02 05:30:00'),
('itm100003', 'Lenovo ThinkPad E14', 3, 35, '165000', '2025-01-03 06:30:00'),
('itm100004', 'Asus Vivobook 16', 4, 50, '142000', '2025-01-04 07:30:00'),
('itm100005', 'Acer Aspire 5', 5, 60, '138000', '2025-01-05 08:30:00'),
('itm100006', 'Samsung Galaxy S23', 6, 80, '210000', '2025-01-06 09:30:00'),
('itm100007', 'iPhone 15 Pro', 7, 70, '245000', '2025-01-07 10:30:00'),
('itm100008', 'OnePlus 12', 8, 90, '198000', '2025-01-08 11:30:00'),
('itm100009', 'Xiaomi 14 Ultra', 9, 60, '175000', '2025-01-09 12:30:00'),
('itm100010', 'Google Pixel 8', 10, 45, '200000', '2025-01-10 13:30:00'),
('itm100011', 'Wooden Office Table', 11, 15, '55000', '2025-01-11 03:30:00'),
('itm100012', 'Glass Dining Table', 12, 10, '72000', '2025-01-12 04:45:00'),
('itm100013', 'Adjustable Study Table', 13, 20, '38000', '2025-01-13 05:50:00'),
('itm100014', 'Foldable Table', 14, 25, '32000', '2025-01-14 06:55:00'),
('itm100015', 'Executive Desk', 15, 10, '85000', '2025-01-15 08:00:00'),
('itm100016', 'Wooden Armchair', 16, 30, '45000', '2025-01-16 09:05:00'),
('itm100017', 'Plastic Chair', 17, 90, '8000', '2025-01-17 10:10:00'),
('itm100018', 'Office Revolving Chair', 18, 50, '28000', '2025-01-18 11:15:00'),
('itm100021', 'Asus TUF Gaming Laptop', 21, 25, '175000', '2025-01-21 03:30:00'),
('itm100022', 'Samsung A55', 22, 55, '98000', '2025-01-22 04:45:00'),
('itm100023', 'Mini Study Table', 23, 15, '30000', '2025-01-23 06:00:00'),
('itm100024', 'Comfort Office Chair', 24, 40, '42000', '2025-01-24 07:15:00'),
('itm100025', 'HP Victus 16', 25, 30, '180000', '2025-01-25 07:30:00'),
('itm100026', 'iPhone 14 Plus', 26, 60, '210000', '2025-01-26 08:40:00'),
('itm100027', 'Samsung Fold 5', 27, 25, '230000', '2025-01-27 09:50:00'),
('itm100028', 'Classic Wooden Table', 28, 20, '60000', '2025-01-28 11:00:00'),
('itm100029', 'Recliner Chair', 29, 10, '95000', '2025-01-29 12:10:00'),
('itm100030', 'MacBook Air M3', 30, 45, '210000', '2025-01-30 13:20:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`billNo`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`idCt`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `idCt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
