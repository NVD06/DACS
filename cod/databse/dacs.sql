-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 12, 2024 lúc 04:29 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dacs`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblmovie`
--

CREATE TABLE `tblmovie` (
  `movie_id` int(50) NOT NULL,
  `movie_name` varchar(50) NOT NULL,
  `image_movie` text NOT NULL,
  `describe_movie` text NOT NULL,
  `date` date NOT NULL,
  `number_tickets_sold` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `status_movie` varchar(10) NOT NULL,
  `screen_id` int(11) NOT NULL,
  `thoiLuong` int(10) NOT NULL,
  `daoDien` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tblmovie`
--

INSERT INTO `tblmovie` (`movie_id`, `movie_name`, `image_movie`, `describe_movie`, `date`, `number_tickets_sold`, `price`, `status_movie`, `screen_id`, `thoiLuong`, `daoDien`) VALUES
(1, 'qqq23', 'https://th.bing.com/th/id/OIP.aMh1Cym0hAwil7GF3HHlkwHaFj?w=237&h=180&c=7&r=0&o=5&pid=1.7', 'qelfql', '0000-00-00', '10', '10000', 'playing', 9, 120, '0'),
(5, 'as', 'https://scontent.fhan2-4.fna.fbcdn.net/v/t39.30808-6/449632693_509769851489742_9156914807177748195_n.jpg?stp=dst-jpg_p600x600&_nc_cat=105&ccb=1-7&_nc_sid=aa7b47&_nc_ohc=gSUlIpBNRyMQ7kNvgGnI0GM&_nc_ht=scontent.fhan2-4.fna&gid=ADcRI35RyO-WMLngnznoBgT&oh=00_AYDQESYbVVRvN1vW7JWGurryjlxWw05AWzresz2RwkV95Q&oe=668D609A', 'asdasd', '0000-00-00', '10', '10000', 'playing', 10, 123, '22'),
(6, 'qanque', 'https://scontent.fhan2-3.fna.fbcdn.net/v/t39.30808-6/449786790_1154246499153373_7789522500839181561_n.jpg?stp=dst-jpg_s600x600&_nc_cat=101&ccb=1-7&_nc_sid=aa7b47&_nc_ohc=J4YBA3N4I7wQ7kNvgHZI8J6&_nc_ht=scontent.fhan2-3.fna&gid=Afo2eZBlS_oNSJOC_mGbzsP&oh=00_AYCLsXkNqmUUi7QMnJMCkPnIo0zfEQhSjc_RkbItPJ-sVQ&oe=668D6A4B', 'anh quan que', '0000-00-00', '10', '10000', 'playing', 11, 241, '0'),
(8, 'qq', 'https://scontent.fhan2-5.fna.fbcdn.net/v/t39.30808-6/449924170_1154246569153366_6496021831540113558_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=aa7b47&_nc_ohc=8L6u02ASPacQ7kNvgFRmOGC&_nc_ht=scontent.fhan2-5.fna&gid=AslZVGqSSKi1wsFQy80Y2q8&oh=00_AYBBSQLIFOzBV2Rsa22g1Sox5pDWsK7XiyhlIESTRT0DkA&oe=668D5108', 'âsd', '0000-00-00', '0', '10000', 'playing', 12, 123, '0'),
(11, 'chanrh', 'https://scontent.fhan20-1.fna.fbcdn.net/v/t39.30808-6/449715432_774461518213509_6486492988495652848_n.jpg?stp=dst-jpg_p180x540&_nc_cat=102&ccb=1-7&_nc_sid=833d8c&_nc_ohc=-Il8mxMiAOQQ7kNvgGAuJVp&_nc_ht=scontent.fhan20-1.fna&gid=AgMu2zYGDEI1rlORcbEy622&oh=00_AYAvsK6pQAPXpCNBSCZGaXtvY5R6epb7G2JGyV5cLso7jA&oe=668D0D59', 'ádasd', '2024-06-30', '12', '100', 'comming', 13, 12, 'aa'),
(12, 'chanrh', 'https://scontent.fhan2-3.fna.fbcdn.net/v/t39.30808-6/449613113_8096872803665276_6563164721179065115_n.jpg?stp=dst-jpg_p180x540&_nc_cat=111&ccb=1-7&_nc_sid=aa7b47&_nc_ohc=A9O3piCClXYQ7kNvgGG54Ip&_nc_ht=scontent.fhan2-3.fna&gid=APhLMSygCWsTjkR_dVopShl&oh=00_AYApP0hFip0Zun_2j6dao8Y0PVUDXb7Bv61OCjAJU30XvA&oe=668D6D62', 'ádasd', '2024-06-30', '12', '100', 'comming', 13, 12, 'aa'),
(13, 'qưqwe', 'https://scontent.fhan20-1.fna.fbcdn.net/v/t39.30808-6/449715432_774461518213509_6486492988495652848_n.jpg?stp=dst-jpg_p180x540&_nc_cat=102&ccb=1-7&_nc_sid=833d8c&_nc_ohc=-Il8mxMiAOQQ7kNvgGAuJVp&_nc_ht=scontent.fhan20-1.fna&gid=AgMu2zYGDEI1rlORcbEy622&oh=00_AYAvsK6pQAPXpCNBSCZGaXtvY5R6epb7G2JGyV5cLso7jA&oe=668D0D59', 'ád', '2024-07-04', '0', '12', 'comming', 1, 12, 'a'),
(14, 'qưqwe', 'https://scontent.fhan2-5.fna.fbcdn.net/v/t39.30808-6/449964192_965756462226939_7818703905406624512_n.jpg?stp=dst-jpg_s720x720&_nc_cat=104&ccb=1-7&_nc_sid=127cfc&_nc_ohc=LlPcKDcgqKMQ7kNvgHVKo1K&_nc_ht=scontent.fhan2-5.fna&gid=APhLMSygCWsTjkR_dVopShl&oh=00_AYC1uUFs8cfhsMFMYlNpqE8QaGhyQgFAsaghkobXKGAnHw&oe=668D4AE4', 'ád', '2024-07-04', '0', '12', 'comming', 2, 12, 'a'),
(15, 'qưqwe', 'https://scontent.fhan20-1.fna.fbcdn.net/v/t39.30808-6/449974065_1098039805009553_3844813000063352753_n.jpg?stp=dst-jpg_p526x296&_nc_cat=1&ccb=1-7&_nc_sid=127cfc&_nc_ohc=P8brSId-EmoQ7kNvgG-k3Wl&_nc_ht=scontent.fhan20-1.fna&oh=00_AYBcJ2vTZvCsU7iXCFKOkEHgf7oTT85z9s5ZAMMoYDsmUQ&oe=668D61A1', 'ád', '2024-07-04', '0', '12', 'comming', 4, 12, 'a'),
(30, 'asfafs', 'https://scontent.fhan20-1.fna.fbcdn.net/v/t39.30808-6/450451462_350218318113495_6644553441156951295_n.jpg?stp=dst-jpg_s600x600&_nc_cat=103&ccb=1-7&_nc_sid=127cfc&_nc_ohc=_UD3oUL9KMYQ7kNvgEkuv2w&_nc_ht=scontent.fhan20-1.fna&oh=00_AYAzjBiQo7g-bCZZGkimIMuNqFkT7buyg70MKMzz2brnEQ&oe=66967001', 'asdafv wgfw vd fdgeg rgewgr', '2024-07-04', '13', '1313', 'playing', 2, 123, 'asd');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblscreen`
--

CREATE TABLE `tblscreen` (
  `screen_id` int(11) NOT NULL,
  `movie_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblseat`
--

CREATE TABLE `tblseat` (
  `seat_id` int(11) NOT NULL,
  `seat_name` varchar(5) NOT NULL,
  `screen_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tblseat`
--

INSERT INTO `tblseat` (`seat_id`, `seat_name`, `screen_id`, `status`) VALUES
(41, 'A1', 1, 'available'),
(42, 'A2', 1, 'available'),
(43, 'A3', 1, 'available'),
(44, 'A4', 1, 'available'),
(45, 'A5', 1, 'available'),
(46, 'B1', 1, 'available'),
(47, 'B2', 1, 'available'),
(48, 'B3', 1, 'available'),
(49, 'B4', 1, 'available'),
(50, 'B5', 1, 'available'),
(51, 'C1', 1, 'available'),
(52, 'C2', 1, 'available'),
(53, 'C3', 1, 'available'),
(54, 'C4', 1, 'available'),
(55, 'C5', 1, 'available'),
(56, 'D1', 1, 'available'),
(57, 'D2', 1, 'available'),
(58, 'D3', 1, 'available'),
(59, 'D4', 1, 'available'),
(60, 'D5', 1, 'available'),
(61, 'E1', 1, 'available'),
(62, 'E2', 1, 'available'),
(63, 'E3', 1, 'available'),
(64, 'E4', 1, 'available'),
(65, 'E5', 1, 'available');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblshowtime`
--

CREATE TABLE `tblshowtime` (
  `showtime_id` int(11) NOT NULL,
  `thoiGian` time NOT NULL,
  `date` date NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tblshowtime`
--

INSERT INTO `tblshowtime` (`showtime_id`, `thoiGian`, `date`, `movie_id`) VALUES
(1, '12:00:00', '2024-07-05', 1),
(2, '22:52:00', '2024-07-10', 1),
(3, '14:00:00', '2024-07-05', 1),
(4, '15:00:00', '2024-07-05', 1),
(5, '00:00:00', '2024-07-10', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbltickets`
--

CREATE TABLE `tbltickets` (
  `ticket_id` int(11) NOT NULL,
  `showtime_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbluser`
--

CREATE TABLE `tbluser` (
  `user_id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `leveluser` varchar(50) NOT NULL,
  `userName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbluser`
--

INSERT INTO `tbluser` (`user_id`, `email`, `password`, `leveluser`, `userName`) VALUES
(6, 'nguyenvu00304@gmail.com', '$2y$10$FJX.XqJMbY16/K4UWLL0Z.cat2EThyuMBsdVvZv5yHmrYtgqQe/R6', '1', 'vu04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tblmovie`
--
ALTER TABLE `tblmovie`
  ADD PRIMARY KEY (`movie_id`);

--
-- Chỉ mục cho bảng `tblscreen`
--
ALTER TABLE `tblscreen`
  ADD PRIMARY KEY (`screen_id`);

--
-- Chỉ mục cho bảng `tblseat`
--
ALTER TABLE `tblseat`
  ADD PRIMARY KEY (`seat_id`);

--
-- Chỉ mục cho bảng `tblshowtime`
--
ALTER TABLE `tblshowtime`
  ADD PRIMARY KEY (`showtime_id`);

--
-- Chỉ mục cho bảng `tbltickets`
--
ALTER TABLE `tbltickets`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Chỉ mục cho bảng `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tblmovie`
--
ALTER TABLE `tblmovie`
  MODIFY `movie_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `tblscreen`
--
ALTER TABLE `tblscreen`
  MODIFY `screen_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tblseat`
--
ALTER TABLE `tblseat`
  MODIFY `seat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT cho bảng `tblshowtime`
--
ALTER TABLE `tblshowtime`
  MODIFY `showtime_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tbltickets`
--
ALTER TABLE `tbltickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
