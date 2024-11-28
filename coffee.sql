-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2024 at 07:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffee`
--

-- --------------------------------------------------------

--
-- Table structure for table `coffeeorder`
--

CREATE TABLE `coffeeorder` (
  `orderID` int(11) NOT NULL,
  `orderDate` datetime NOT NULL,
  `username` char(50) NOT NULL,
  `billstatus` char(50) NOT NULL,
  `totalprice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menuID` int(11) NOT NULL,
  `menuname` char(50) NOT NULL,
  `price` int(11) NOT NULL,
  `image` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menuID`, `menuname`, `price`, `image`) VALUES
(1, 'เอสเพรสโซ (espresso)', 45, 'https://coffeepressthailand.com/wp-content/uploads/2020/10/Blog-%E0%B8%AB%E0%B8%A1%E0%B8%A7%E0%B8%942-%E0%B9%80%E0%B8%A1%E0%B8%99%E0%B8%B9%E0%B8%81%E0%B8%B2%E0%B9%81%E0%B8%9F_201007_4_resize.jpg'),
(2, 'คาปูชิโน (cappuccino)', 45, 'https://coffeepressthailand.com/wp-content/uploads/2020/10/Blog-%E0%B8%AB%E0%B8%A1%E0%B8%A7%E0%B8%942-%E0%B9%80%E0%B8%A1%E0%B8%99%E0%B8%B9%E0%B8%81%E0%B8%B2%E0%B9%81%E0%B8%9F_201007_1_resize.jpg'),
(3, 'ลาเต้ (Latte)', 45, 'https://coffeepressthailand.com/wp-content/uploads/2020/10/coffeelatte_resize.jpg'),
(4, 'มอคค่า (Mocha)', 45, 'https://coffeepressthailand.com/wp-content/uploads/2020/10/Blog-%E0%B8%AB%E0%B8%A1%E0%B8%A7%E0%B8%942-%E0%B9%80%E0%B8%A1%E0%B8%99%E0%B8%B9%E0%B8%81%E0%B8%B2%E0%B9%81%E0%B8%9F_201007_5_resize.jpg'),
(5, 'อเมริกาโน (Americano)', 45, 'https://coffeepressthailand.com/wp-content/uploads/2020/10/88984090_638301056740708_3188132572890660864_n_resize.jpg'),
(6, 'แมคเคียโต้ (Macchiato)', 45, 'https://coffeepressthailand.com/wp-content/uploads/2020/10/Macchiato_resize.jpg'),
(9, 'ช็อคโกแลต', 45, 'https://www.pholfoodmafia.com/wp-content/uploads/2018/03/HomemadeHotChocolateAdver-1200x718.jpg'),
(10, 'ชาเขียว', 45, 'https://hilight.kapook.com/img_cms2/user/surauch/Test/erwrewwe4.jpg'),
(11, 'ชาเย็น', 45, 'https://เมนู.net/media/images/recipe/%E0%B8%8A%E0%B8%B2%E0%B9%84%E0%B8%97%E0%B8%A2%E0%B8%9B%E0%B8%B1%E0%B9%88%E0%B8%99.jpg'),
(12, 'น้ำแข็งใส', 30, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRpkMKPYWMFPZu_CHJR7TWNL3f5FLyJsDw1xA&usqp=CAU');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `orderDID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `menuID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `totalPrice` decimal(10,2) NOT NULL,
  `type` varchar(50) NOT NULL,
  `sweetOption` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `paymentType` varchar(255) NOT NULL,
  `orderDate` datetime NOT NULL,
  `totalPrice` decimal(10,2) NOT NULL,
  `picture` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `realname` varchar(100) NOT NULL,
  `userType` varchar(50) NOT NULL,
  `mobile` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `createDate` date NOT NULL,
  `image` longtext NOT NULL,
  `status` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `realname`, `userType`, `mobile`, `email`, `createDate`, `image`, `status`) VALUES
('admin', '1234', 'pathipat mattra', 'Admin', 990123456, 'pathipat.m@kkumail.com', '2024-03-10', 'data:image/jpeg;base64,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', b'1'),
('DOM1213', '1234', 'Worachot Thonglert', 'Employee', 990123456, 'Worachot.t@kkumail.com', '2024-03-20', 'data:image/jpeg;base64,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', b'1'),
('Pathipat', '1234', 'pathipat mattra', 'Employee', 990123456, 'pathipat.m@kkumail.com', '2024-03-10', 'data:image/jpeg;base64,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', b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coffeeorder`
--
ALTER TABLE `coffeeorder`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menuID`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`orderDID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coffeeorder`
--
ALTER TABLE `coffeeorder`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `orderDID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
