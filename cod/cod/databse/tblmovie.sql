-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 15, 2024 lúc 06:02 AM
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
(1, 'QUỶ ÁM', 'https://cinestar.com.vn/pictures/Cinestar/10-2023/quy-am-tin-do.jpg', 'Phần tiếp theo của bộ phim năm 1973 kể về một cô bé 12 tuổi bị ám bởi một thực thể ma quỷ bí ẩn, buộc mẹ cô phải tìm đến sự giúp đỡ của hai linh mục để cứu cô.', '2024-07-15', '', '45000', 'playing', 1, 75, 'Leslie Odom Jr., Ellen Burstyn, Lidya Jewett, Olivia Marcum, Ann Dowd'),
(2, 'ĐẤT RỪNG PHƯƠNG NAM (K)', 'https://cinestar.com.vn/pictures/Cinestar/10-2023/poster-dat-rung-phuong-nam.jpg', 'Sau bao ngày chờ đợi, dự án điện ảnh gợi ký ức tuổi thơ của nhiều thế hệ người Việt chính thức tung hình ảnh đầu tiên đầy cảm xúc. First look poster khắc họa hình ảnh đối lập: bé An đang ôm chặt mẹ giữa một khung cảnh chạy giặc loạn lạc. Cùng chờ đợi và theo dõi thêm hành trình bé An đi tìm cha khắp nam kỳ lục tỉnh cùng các người bạn đồng hành nhé!', '2024-07-16', '', '45000', 'playing', 2, 80, 'Nguyễn Quang Dũng'),
(3, 'KRAVEN THỢ SĂN THỦ LĨNH', 'https://cinestar.com.vn/pictures/Cinestar/10-2023/kraven.jpg', 'Gã nhập cư Nga Sergei Kravinoff đang thực hiện nhiệm vụ chứng minh rằng anh ta là thợ săn vĩ đại nhất thế giới.', '2024-07-16', '', '45000', 'playing', 3, 80, 'J.C. Chandor'),
(4, 'MỸ NHÂN ĐẠO CHÍCH', 'https://cinestar.com.vn/pictures/Cinestar/11-2023/my-nhan-dao-chich.jpg', 'Cặp mẹ con “đạo chích” Ji Hye - Joo Yeong từng thực hiện vô số phi vụ thành công, nhưng mà là… công cốc. Để khép lại sự nghiệp không mấy vẻ vang này, Ji Hye lên kế hoạch trộm số vàng với giá trị lên đến 60 tỷ Won bằng cách lợi dụng trái tim mong manh mới biết yêu của anh chàng tài phiệt Wan Gyu. Nhưng phi vụ đặc biệt này không hề suôn sẻ khi cũng có những kẻ khác đang nhòm ngó số vàng kếch xù này.', '2024-07-16', '', '45000', 'playing', 4, 80, 'Lee Seung-Joon'),
(5, 'MỸ NHÂN ĐẠO CHÍCH 2', 'https://cinestar.com.vn/pictures/Cinestar/11-2023/my-nhan-dao-chich.jpg', 'Cặp mẹ con “đạo chích” Ji Hye - Joo Yeong từng thực hiện vô số phi vụ thành công, nhưng mà là… công cốc. Để khép lại sự nghiệp không mấy vẻ vang này, Ji Hye lên kế hoạch trộm số vàng với giá trị lên đến 60 tỷ Won bằng cách lợi dụng trái tim mong manh mới biết yêu của anh chàng tài phiệt Wan Gyu. Nhưng phi vụ đặc biệt này không hề suôn sẻ khi cũng có những kẻ khác đang nhòm ngó số vàng kếch xù này.', '2024-07-16', '', '45000', 'comming', 4, 80, 'Lee Seung-Joon'),
(6, 'QUỶ ÁM 2', 'https://cinestar.com.vn/pictures/Cinestar/10-2023/quy-am-tin-do.jpg', 'Phần tiếp theo của bộ phim năm 1973 kể về một cô bé 12 tuổi bị ám bởi một thực thể ma quỷ bí ẩn, buộc mẹ cô phải tìm đến sự giúp đỡ của hai linh mục để cứu cô.', '2024-07-14', '', '45000', 'comming', 1, 75, 'Leslie Odom Jr., Ellen Burstyn, Lidya Jewett, Olivia Marcum, Ann Dowd'),
(7, 'ĐẤT RỪNG PHƯƠNG NAM 2 (K)', 'https://cinestar.com.vn/pictures/Cinestar/10-2023/poster-dat-rung-phuong-nam.jpg', 'Sau bao ngày chờ đợi, dự án điện ảnh gợi ký ức tuổi thơ của nhiều thế hệ người Việt chính thức tung hình ảnh đầu tiên đầy cảm xúc. First look poster khắc họa hình ảnh đối lập: bé An đang ôm chặt mẹ giữa một khung cảnh chạy giặc loạn lạc. Cùng chờ đợi và theo dõi thêm hành trình bé An đi tìm cha khắp nam kỳ lục tỉnh cùng các người bạn đồng hành nhé!', '2024-07-16', '', '45000', 'comming', 2, 80, 'Nguyễn Quang Dũng'),
(8, 'KRAVEN THỢ SĂN THỦ LĨNH 2', 'https://cinestar.com.vn/pictures/Cinestar/10-2023/kraven.jpg', 'Gã nhập cư Nga Sergei Kravinoff đang thực hiện nhiệm vụ chứng minh rằng anh ta là thợ săn vĩ đại nhất thế giới.', '2024-07-16', '', '45000', 'comming', 3, 80, 'J.C. Chandor'),
(9, 'HÀNH TINH CÁT PHẦN 2', 'https://cinestar.com.vn/pictures/Cinestar/11-2023/dune-poster.jpg', 'Dune: Hành tinh cát - Phần hai là bộ phim sử thi khoa học viễn tưởng của Mỹ ra mắt năm 2023 do Denis Villeneuve đạo diễn vởi kịch bản do Villeneuve, Jon Spaihts và Eric Roth cùng chấp bút.', '2024-07-15', '', '45000', 'playing', 5, 80, 'Denis Villeneuve'),
(10, 'HÀNH TINH CÁT PHẦN 3', 'https://cinestar.com.vn/pictures/Cinestar/11-2023/dune-poster.jpg', 'Dune: Hành tinh cát - Phần hai là bộ phim sử thi khoa học viễn tưởng của Mỹ ra mắt năm 2023 do Denis Villeneuve đạo diễn vởi kịch bản do Villeneuve, Jon Spaihts và Eric Roth cùng chấp bút.', '2024-07-15', '', '45000', 'comming', 5, 80, 'Denis Villeneuve');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tblmovie`
--
ALTER TABLE `tblmovie`
  ADD PRIMARY KEY (`movie_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
