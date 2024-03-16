-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 16, 2024 lúc 04:39 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `hotel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact`
--

CREATE TABLE `contact` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `phoneno` int(10) DEFAULT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `cdate` date DEFAULT NULL,
  `approval` text CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `contact`
--

INSERT INTO `contact` (`id`, `fullname`, `phoneno`, `email`, `cdate`, `approval`) VALUES
(1, 'Quan Nguyen', 974039385, 'assassjin1@gmail.com', '2023-10-10', 'Cho phép'),
(2, 'Nguyen Anh Quan', 974039385, 'abc@gmail.com', '2023-10-01', 'Không cho phép'),
(3, 'Nguyễn Thanh Thủy', 909090909, 'assassjin1432@gmail.com', '2023-12-04', 'Không cho phép'),
(6, 'Nguyễn ANh Quân', 2147483647, 'ass9876@gmail.com', '2023-12-25', 'Không cho phép');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `login`
--

CREATE TABLE `login` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `user` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `usname` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `pass` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `login`
--

INSERT INTO `login` (`id`, `role`, `email`, `user`, `usname`, `pass`) VALUES
(100, 0, 'assassjin1@gmail.com', 'Nguyễn Anh Quân', 'Quanna', '674f3c2c1a8a6f90461e8a66fb5550ba'),
(101, 0, 'assassjin12@gmail.com', 'Quân rất đẹp trai', 'Quandz', '81dc9bdb52d04dc20036dbd8313ed055'),
(102, 1, NULL, NULL, 'Admin', '81dc9bdb52d04dc20036dbd8313ed055'),
(103, 1, NULL, NULL, 'Adminphu', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `newsletterlog`
--

CREATE TABLE `newsletterlog` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(52) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `subject` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `news` text CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `newsletterlog`
--

INSERT INTO `newsletterlog` (`id`, `title`, `subject`, `news`) VALUES
(1, 'xin chao ban', 'nguyen anh quan', 'toi rat vui khi ban nt cho chung toi\r\n'),
(2, 'Chào mọi người', 'everyone', 'rất vui thông báo với các bạn'),
(3, 'Job', 'everyone', 'Cảm ơn bạn');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment`
--

CREATE TABLE `payment` (
  `id` int(11) DEFAULT NULL,
  `title` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `fname` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `lname` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `troom` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `tbed` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `nroom` int(11) DEFAULT NULL,
  `cin` date DEFAULT NULL,
  `cout` date DEFAULT NULL,
  `ttot` double(20,0) DEFAULT NULL,
  `fintot` double(20,0) DEFAULT NULL,
  `mepr` double(10,0) DEFAULT NULL,
  `meal` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `btot` double(20,0) DEFAULT NULL,
  `noofdays` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `payment`
--

INSERT INTO `payment` (`id`, `title`, `fname`, `lname`, `troom`, `tbed`, `nroom`, `cin`, `cout`, `ttot`, `fintot`, `mepr`, `meal`, `btot`, `noofdays`) VALUES
(68, 'Đặt p', 'Quân', 'Nguyễn Anh', 'Phòng sang trọng', 'Đơn', 1, '2024-01-03', '2024-01-04', 2200000, 2222030, 30, 'Cả ngày', 22000, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room`
--

CREATE TABLE `room` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` text CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `bedding` text CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `place` text CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `cusid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `room`
--

INSERT INTO `room` (`id`, `type`, `bedding`, `place`, `cusid`) VALUES
(1, 'Phòng cao cấp', 'Đơn', 'Free', NULL),
(2, 'Phòng cao cấp', 'Đôi', 'Free', NULL),
(3, 'Phòng cao cấp', 'Ba', 'Free', NULL),
(4, 'Phòng cao cấp', 'Bốn', 'Free', NULL),
(5, 'Phòng sang trọng', 'Đơn', 'NotFree', 68),
(6, 'Phòng sang trọng', 'Đôi', 'Free', NULL),
(7, 'Phòng sang trọng', 'Ba', 'Free', NULL),
(8, 'Phòng sang trọng', 'Bốn', 'Free', NULL),
(9, 'Phòng khách', 'Đơn', 'Free', 0),
(10, 'Phòng khách', 'Đôi', 'Free', NULL),
(11, 'Phòng khách', 'Ba', 'Free', NULL),
(12, 'Phòng khách', 'Bốn', 'Free', NULL),
(13, 'Phòng đơn', 'Đơn', 'Free', NULL),
(14, 'Phòng đơn', 'Đôi', 'Free', NULL),
(15, 'Phòng đơn', 'Ba', 'Free', NULL),
(16, 'Phòng đơn', 'Bốn', 'Free', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roombook`
--

CREATE TABLE `roombook` (
  `id` int(10) UNSIGNED NOT NULL,
  `Title` varchar(5) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `FName` text CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `LName` text CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Email` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Country` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Phone` text CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `TRoom` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Bed` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `NRoom` varchar(2) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Meal` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `cin` date DEFAULT NULL,
  `cout` date DEFAULT NULL,
  `stat` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `nodays` int(11) DEFAULT NULL,
  `description` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `roombook`
--

INSERT INTO `roombook` (`id`, `Title`, `FName`, `LName`, `Email`, `Country`, `Phone`, `TRoom`, `Bed`, `NRoom`, `Meal`, `cin`, `cout`, `stat`, `nodays`, `description`) VALUES
(53, 'Đặt p', 'Anh Quân', 'Nguyễn', 'assassjin4321@gmail.com', 'Thái Nguyên', '0974039385', 'Phòng cao cấp', 'Bốn', '1', 'Cả ngày', '2023-12-21', '2023-12-30', 'Đã thanh toán', 9, NULL),
(54, 'Đặt p', 'Anh Quân', 'Nguyễn', 'assassjin4321@gmail.com', 'Thái Nguyên', '1234567891', 'Phòng sang trọng', 'Đơn', '1', 'Cả ngày', '2023-12-29', '2023-12-30', 'Đã thanh toán', 1, NULL),
(55, 'Đặt p', 'Anh Quân', 'Nguyễn', 'assassjin4321@gmail.com', 'Móng Cái', '123456789', 'Phòng đơn', 'Đơn', '1', 'Cả ngày', '2023-12-28', '2023-12-30', 'Đã thanh toán', 2, NULL),
(56, 'Đặt p', 'Anh Quân', 'Nguyễn', 'assassjin4321@gmail.com', 'Hà Nội', '555555555', 'Phòng sang trọng', 'Đơn', '1', 'Cả ngày', '2023-12-30', '2023-12-31', 'Đã thanh toán', 1, NULL),
(57, 'Đặt p', 'Anh Quân', 'Nguyễn', 'assassjin4321@gmail.com', 'Nam Định', '0974039385', 'Phòng cao cấp', 'Đơn', '1', 'Cả ngày', '2023-12-28', '2023-12-30', 'Đã bị hủy', 2, 'Phòng đang có người sử dụng'),
(58, 'Đặt p', 'Anh Quân', 'Nguyễn', 'assassjin4321@gmail.com', 'Cần Thơ', '0987654321', 'Phòng đơn', 'Đơn', '1', 'Bữa sáng', '2023-12-29', '2023-12-30', 'Xác nhận', 1, NULL),
(59, 'Đặt p', 'Anh Quân', 'Nguyễn', 'assassjin4321@gmail.com', 'Hà Nội', '123456789', 'Phòng khách', 'Đơn', '1', 'Cả ngày', '2023-12-23', '2023-12-31', 'Đã thanh toán', 8, NULL),
(60, 'Đặt p', 'Anh Quân', 'Nguyễn', 'assassjin4321@gmail.com', 'Mỹ Tho', '123456789', 'Phòng sang trọng', 'Đơn', '1', 'Cả ngày', '2023-12-22', '2023-12-31', 'Chưa xác nhận', 9, NULL),
(61, 'Đặt p', 'Quân', 'Nguyễn Anh', 'assassjin4321@gmail.com', 'Việt Trì', '0974039385', 'Phòng cao cấp', 'Đôi', '2', 'Bữa sáng', '2024-01-03', '2024-01-04', 'Chưa xác nhận', 1, NULL),
(64, 'Đặt p', 'Kiệt', 'Nguyễn Tuấn', 'as@gmail.com', 'Nam Định', '0909090909', 'Phòng sang trọng', 'Đơn', '1', 'Cả ngày', '2024-01-03', '2024-01-04', 'Đã bị hủy', 1, 'Phòng đã hết'),
(65, 'Đặt p', 'Quân', 'Nguyễn Anh', 'assassjin1@gmail.com', 'Hà Nội', '0974039385', 'Phòng sang trọng', 'Đơn', '1', 'Bữa sáng', '2024-01-03', '2024-01-04', 'Chưa xác nhận', 1, NULL),
(66, 'Đặt p', 'Quân', 'Nguyễn Anh', 'assassjin1@gmail.com', 'Hà Nội', '0974039385', 'Phòng cao cấp', 'Đôi', '1', 'Bữa đầy đủ', '2024-01-01', '2024-01-04', 'Chưa xác nhận', 3, NULL),
(67, 'Đặt p', 'Quân', 'Nguyễn Anh', 'assassjin1@gmail.com', 'Hà Nội', '0974039385', 'Phòng đơn', 'Ba', '3', 'Cả ngày', '2024-01-01', '2024-01-04', 'Chưa xác nhận', 3, NULL),
(68, 'Đặt p', 'Quân', 'Nguyễn Anh', 'assassjin1@gmail.com', 'Hà Nội', '0974039743', 'Phòng sang trọng', 'Đơn', '1', 'Cả ngày', '2024-01-03', '2024-01-04', 'Xác nhận', 1, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `newsletterlog`
--
ALTER TABLE `newsletterlog`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `roombook`
--
ALTER TABLE `roombook`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `login`
--
ALTER TABLE `login`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT cho bảng `newsletterlog`
--
ALTER TABLE `newsletterlog`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `room`
--
ALTER TABLE `room`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT cho bảng `roombook`
--
ALTER TABLE `roombook`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
