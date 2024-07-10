-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 10, 2024 lúc 09:52 PM
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
  `date` datetime NOT NULL,
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
(1, 'qqq', 'https://th.bing.com/th/id/OIP.aMh1Cym0hAwil7GF3HHlkwHaFj?w=237&h=180&c=7&r=0&o=5&pid=1.7', 'qelfql', '2024-07-05 10:13:00', '10', '10000', 'playing', 9, 120, 'duc gay'),
(5, 'as', 'https://scontent.fhan2-4.fna.fbcdn.net/v/t39.30808-6/449632693_509769851489742_9156914807177748195_n.jpg?stp=dst-jpg_p600x600&_nc_cat=105&ccb=1-7&_nc_sid=aa7b47&_nc_ohc=gSUlIpBNRyMQ7kNvgGnI0GM&_nc_ht=scontent.fhan2-4.fna&gid=ADcRI35RyO-WMLngnznoBgT&oh=00_AYDQESYbVVRvN1vW7JWGurryjlxWw05AWzresz2RwkV95Q&oe=668D609A', 'asdasd', '2024-05-28 00:00:00', '10', '10000', 'playing', 10, 0, ''),
(6, 'qanque', 'https://scontent.fhan2-3.fna.fbcdn.net/v/t39.30808-6/449786790_1154246499153373_7789522500839181561_n.jpg?stp=dst-jpg_s600x600&_nc_cat=101&ccb=1-7&_nc_sid=aa7b47&_nc_ohc=J4YBA3N4I7wQ7kNvgHZI8J6&_nc_ht=scontent.fhan2-3.fna&gid=Afo2eZBlS_oNSJOC_mGbzsP&oh=00_AYCLsXkNqmUUi7QMnJMCkPnIo0zfEQhSjc_RkbItPJ-sVQ&oe=668D6A4B', 'anh quan que', '2024-06-04 00:00:00', '10', '10000', 'playing', 11, 0, ''),
(8, 'qq', 'https://scontent.fhan2-5.fna.fbcdn.net/v/t39.30808-6/449924170_1154246569153366_6496021831540113558_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=aa7b47&_nc_ohc=8L6u02ASPacQ7kNvgFRmOGC&_nc_ht=scontent.fhan2-5.fna&gid=AslZVGqSSKi1wsFQy80Y2q8&oh=00_AYBBSQLIFOzBV2Rsa22g1Sox5pDWsK7XiyhlIESTRT0DkA&oe=668D5108', 'âsd', '2024-07-11 00:00:00', '0', '10000', 'playing', 12, 123, 'đứuc gay'),
(10, 'qq', 'https://scontent.fhan20-1.fna.fbcdn.net/v/t39.30808-6/449171846_475496298503946_5828589451051767265_n.jpg?stp=cp6_dst-jpg_s261x260&_nc_cat=103&ccb=1-7&_nc_sid=bd9a62&_nc_ohc=0uG2uZ24A4kQ7kNvgGMcA30&_nc_ht=scontent.fhan20-1.fna&gid=Afo2eZBlS_oNSJOC_mGbzsP&oh=00_AYCWy3oCGNVRejncDo_7aEd1uftrs6E_WJcMf7WdX6s8dA&oe=668D44AD', 'âsd', '2024-07-11 00:00:00', '0', '10000', 'playing', 5, 123, 'đứuc gay'),
(11, 'chanrh', 'https://scontent.fhan20-1.fna.fbcdn.net/v/t39.30808-6/449715432_774461518213509_6486492988495652848_n.jpg?stp=dst-jpg_p180x540&_nc_cat=102&ccb=1-7&_nc_sid=833d8c&_nc_ohc=-Il8mxMiAOQQ7kNvgGAuJVp&_nc_ht=scontent.fhan20-1.fna&gid=AgMu2zYGDEI1rlORcbEy622&oh=00_AYAvsK6pQAPXpCNBSCZGaXtvY5R6epb7G2JGyV5cLso7jA&oe=668D0D59', 'ádasd', '2024-06-30 00:00:00', '12', '100', 'comming', 13, 12, 'aa'),
(12, 'chanrh', 'https://scontent.fhan2-3.fna.fbcdn.net/v/t39.30808-6/449613113_8096872803665276_6563164721179065115_n.jpg?stp=dst-jpg_p180x540&_nc_cat=111&ccb=1-7&_nc_sid=aa7b47&_nc_ohc=A9O3piCClXYQ7kNvgGG54Ip&_nc_ht=scontent.fhan2-3.fna&gid=APhLMSygCWsTjkR_dVopShl&oh=00_AYApP0hFip0Zun_2j6dao8Y0PVUDXb7Bv61OCjAJU30XvA&oe=668D6D62', 'ádasd', '2024-06-30 00:00:00', '12', '100', 'comming', 13, 12, 'aa'),
(13, 'qưqwe', 'https://scontent.fhan20-1.fna.fbcdn.net/v/t39.30808-6/449715432_774461518213509_6486492988495652848_n.jpg?stp=dst-jpg_p180x540&_nc_cat=102&ccb=1-7&_nc_sid=833d8c&_nc_ohc=-Il8mxMiAOQQ7kNvgGAuJVp&_nc_ht=scontent.fhan20-1.fna&gid=AgMu2zYGDEI1rlORcbEy622&oh=00_AYAvsK6pQAPXpCNBSCZGaXtvY5R6epb7G2JGyV5cLso7jA&oe=668D0D59', 'ád', '2024-07-04 00:00:00', '0', '12', 'comming', 1, 12, 'a'),
(14, 'qưqwe', 'https://scontent.fhan2-5.fna.fbcdn.net/v/t39.30808-6/449964192_965756462226939_7818703905406624512_n.jpg?stp=dst-jpg_s720x720&_nc_cat=104&ccb=1-7&_nc_sid=127cfc&_nc_ohc=LlPcKDcgqKMQ7kNvgHVKo1K&_nc_ht=scontent.fhan2-5.fna&gid=APhLMSygCWsTjkR_dVopShl&oh=00_AYC1uUFs8cfhsMFMYlNpqE8QaGhyQgFAsaghkobXKGAnHw&oe=668D4AE4', 'ád', '2024-07-04 00:00:00', '0', '12', 'comming', 2, 12, 'a'),
(15, 'qưqwe', 'https://scontent.fhan20-1.fna.fbcdn.net/v/t39.30808-6/449974065_1098039805009553_3844813000063352753_n.jpg?stp=dst-jpg_p526x296&_nc_cat=1&ccb=1-7&_nc_sid=127cfc&_nc_ohc=P8brSId-EmoQ7kNvgG-k3Wl&_nc_ht=scontent.fhan20-1.fna&oh=00_AYBcJ2vTZvCsU7iXCFKOkEHgf7oTT85z9s5ZAMMoYDsmUQ&oe=668D61A1', 'ád', '2024-07-04 00:00:00', '0', '12', 'comming', 4, 12, 'a');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tblmovie`
--
ALTER TABLE `tblmovie`
  ADD PRIMARY KEY (`movie_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tblmovie`
--
ALTER TABLE `tblmovie`
  MODIFY `movie_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
