-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2024 at 01:23 PM
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
(12, 'น้ำแข็งใส', 30, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRpkMKPYWMFPZu_CHJR7TWNL3f5FLyJsDw1xA&usqp=CAU'),
(15, 'แมง', 444, 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c7/Melolontha_melolontha01.jpg/1200px-Melolontha_melolontha01.jpg');

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
-- Table structure for table `typemenu`
--

CREATE TABLE `typemenu` (
  `typemenuID` int(11) NOT NULL,
  `typename` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `typemenu`
--

INSERT INTO `typemenu` (`typemenuID`, `typename`) VALUES
(1, 'ร้อน'),
(2, 'เย็น'),
(3, 'ปั่น');

-- --------------------------------------------------------

--
-- Table structure for table `typesweet`
--

CREATE TABLE `typesweet` (
  `typesweetID` int(11) NOT NULL,
  `sweetLevel` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `typesweet`
--

INSERT INTO `typesweet` (`typesweetID`, `sweetLevel`) VALUES
(1, '100%'),
(2, '75%'),
(3, '50%'),
(4, '25%'),
(5, '0%');

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
('DOM1213', '1234', 'pathipat mattra', 'Employee', 990123456, 'pathipat.m@kkumail.com', '2024-03-18', 'data:image/jpeg;base64,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', b'1'),
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
-- Indexes for table `typemenu`
--
ALTER TABLE `typemenu`
  ADD PRIMARY KEY (`typemenuID`);

--
-- Indexes for table `typesweet`
--
ALTER TABLE `typesweet`
  ADD PRIMARY KEY (`typesweetID`);

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
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `orderDID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `typemenu`
--
ALTER TABLE `typemenu`
  MODIFY `typemenuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `typesweet`
--
ALTER TABLE `typesweet`
  MODIFY `typesweetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
