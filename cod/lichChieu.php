<?php
session_start();
include "takeSchedule.php";
include "connectToDatabase.php";

function isLoggedIn() {
    return isset($_SESSION['userName']);
}

if (!isLoggedIn()) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header("Location: login.php?redirect_url=" . urlencode($_SERVER['REQUEST_URI']));
    exit;
}

if (isset($_GET['movie_name'])) {
    $movie_name = $_GET['movie_name'];
    // Perform actions to show movie schedule
    // ...
} else {
    echo "No movie name provided";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Lịch chiếu</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
</head>
<body background="" style="background-color: brown;">
    <div class="main_body">
        <div class="menu">
            <div class="chung">
                <div class="function">
                    <div class="viTri">
                        <a href="index.php"><img src="https://cinestar.com.vn/_next/image/?url=%2Fassets%2Fimages%2Fheader-logo.png&w=1920&q=75" alt="Home page logo"></a>
                        <div class="bookAndpd">
                            <a href="datve.php" class="Booking_T">ĐẶT VÉ NGAY</a>
                            <a href="bapnuoc.php" class="Booking_F">ĐẶT BẮP NƯỚC</a>
                        </div>
                        <div class="searchAndLogin">
                            <div class="searchIcon">
                                <div class="search-container">
                                    <input type="text" placeholder="Tìm kiếm">
                                    <button type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.415l-3.85-3.85a1.007 1.007 0 0 0-.115-.098zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <?php if (isLoggedIn()): ?>
                                    <div class="dropdown" style="display:flex;">
                                        <p style="color:aqua; cursor:pointer;"><?php echo htmlspecialchars($_SESSION['userName']); ?></p>
                                        <div class="dropdown-content">
                                            <a href="profile.php">Thông tin cá nhân</a>
                                            <a href="viewTicket.php">Lịch sử thanh toán</a>
                                            <a href="logout.php">Đăng xuất</a>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="Login"> <a href="login.php">Đăng nhập</a></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chose_feature">
                    <div class="Location2">
                        <nav class="first">
                            <button><i class="fas fa-map-marker-alt"></i> Chọn rạp</button>
                            <ul class="menu1">
                                <li><a href="">Cinerstar Hồ Chí Minh</a></li>
                                <li><a href="">Cinerstar Hà Nội</a></li>
                                <li><a href="">Cinerstar Đà Nẵng</a></li>
                            </ul>
                        </nav>
                        <div class="second">
                            <a href="lichChieu.php"><i class="fas fa-calendar"></i> Lịch chiếu</a>
                            <a href="">Khuyến mãi</a>
                            <a href="events.php">Thuê sự kiện</a>
                            <a href="">Giải trí</a>
                            <a href="gioithieu.php">Giới thiệu</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <div class="Page_Content">
            <?php
            if (isset($showtimes)) {
                if (isset($movie_id)) {
                    echo "<div class='thoiGianChieu'>";
                    echo "<div class='anhPhim'>";
                    echo "<img src='" . htmlspecialchars($image_movie ?? 'images/default_image.jpg') . "' alt=''>";
                    echo "<h2>" . htmlspecialchars($movie_name ?? 'Tất cả các phim') . "</h2>";
                    echo "</div>";
                    echo "<div class='gioChieu'>";

                    // Kiểm tra và hiển thị trạng thái của phim
                    if (isset($status_movie) && $status_movie === 'comming') {
                        echo "<p>Phim sắp chiếu</p>";
                    }

                    foreach ($showtimes as $date => $times) {
                        echo "<p><strong>$date</strong></p>";
                        echo "<div class='showtimes-container'>"; // Container for showtimes
                        foreach ($times as $time) {
                            echo "<div class='showtime-item'>";
                            echo "<p><a href='booking.php?thoiGian=" . urlencode($time) . "&date=" . urlencode($date) . "&screen_id=" . urlencode($screen_id)  . "&movie_name=" . urlencode($movie_name) . "'>$time</a></p>";
                            echo "</div>";
                        }
                        echo "</div>";
                        echo "<br>";
                    }
                    echo "</div>";
                    echo "</div>";
                } else {
                    foreach ($showtimes as $movie => $dates) {
                        // Lấy thông tin phim từ CSDL dựa trên $movie
                        $stmt = $conn->prepare("SELECT image_movie, status_movie FROM tblmovie WHERE movie_name = ?");
                        if ($stmt === false) {
                            die('Prepare failed: ' . htmlspecialchars($conn->error));
                        }
                        $stmt->bind_param("s", $movie);
                        $stmt->execute();
                        $stmt->bind_result($image_movie, $status_movie);
                        $stmt->fetch();
                        $stmt->close();

                        echo "<div class='thoiGianChieu'>";
                        echo "<div class='anhPhim'>";
                        echo "<img src='" . htmlspecialchars($image_movie ?? 'images/default_image.jpg') . "' alt=''>";
                        echo "<h2>" . htmlspecialchars($movie) . "</h2>";
                        echo "</div>";
                        echo "<div class='gioChieu'>";

                        // Kiểm tra và hiển thị trạng thái của phim
                        if ($status_movie === 'comming') {
                            echo "<p>Phim sắp chiếu</p>";
                        }

                        foreach ($dates as $date => $times) {
                            echo "<p><strong>$date</strong></p>";
                            echo "<div class='showtimes-container'>"; // Container for showtimes
                            foreach ($times as $time) {
                                echo "<div class='showtime-item'>";
                                echo "<p><a href='details.php?thoiGian=" . urlencode($time) . "&date=" . urlencode($date) . "%screen_id" . urlencode($screen_id) . "&movie_name=" . urlencode($movie) . "'>$time</a></p>";
                                echo "</div>";
                            }
                            echo "</div>";
                            echo "<br>";
                        }
                        echo "</div>";
                        echo "</div>";
                    }
                }
            }
            ?>

        </div>
    </div>
</div>
    </div>
        </div>
        <div class="end_page">
            <div class="footer">
                <div>
                    <div class="container">
                    <div class="footer-wr">
                        <div class="footer-top-mobile">&nbsp;</div>
                        <div class="footer-list row">
                            <div class="footer-item col col-4"><a href="/" class="ft-logo" aria-label="The logo of Cinestar"><img src="/assets/images/footer-logo.png" alt=""></a>
                                <div class="ft-text">
                                    <p class="txt-deskop">BE HAPPY, BE A STAR</p>
                                </div>
                                <div class="ft-group-btn"><a class="btn btn--pri" href="/movie"><span class="btn__text">mua vé</span><span class="btn__icon"><i class="icon-ic-tickets"></i></span></a>
                                    <a class="btn btn--border" href="https://cinestar.com.vn/news/detail/tuyendung"><span class="btn__text">Tuyển dụng</span><span class="btn__icon"><i class="icon-ic-career"></i></span></a>
                                </div>
                            </div>
                            <div class="footer-item col col-4">
                                <p class="footer-title">CÔNG TY CỔ PHẦN GIẢI TRÍ CINESTAR</p>
                                <ul class="footer-list-item">
                                    <li class="footer-list-item"><a href="#">Giới thiệu</a></li>
                                    <li class="footer-list-item"><a href="#">Tiện ích online</a></li>
                                    <li class="footer-list-item"><a href="#">Thẻ quà tặng</a></li>
                                    <li class="footer-list-item"><a href="#">Tuyển dụng</a></li>
                                    <li class="footer-list-item"><a href="#">Liên hệ quảng cáo</a></li>
                                    <li class="footer-list-item"><a href="#">Liên hệ công ty</a></li>
                                </ul>
                            </div>
                            <div class="footer-item col col-4">
                                <p class="footer-title">điều khoản và quy định</p>
                                <ul class="footer-list-item">
                                    <li class="footer-list-item"><a href="#">Điều khoản chung</a></li>
                                    <li class="footer-list-item"><a href="#">Điều khoản giao dịch</a></li>
                                    <li class="footer-list-item"><a href="#">Chính sách thanh toán</a></li>
                                    <li class="footer-list-item"><a href="#">Chính sách bảo mật</a></li>
                                    <li class="footer-list-item"><a href="#">Câu hỏi thường gặp</a></li>
                                    <li class="footer-list-item"><a href="#">Kết nối</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-copyright">&copy; 2022 <a href="https://cinestar.com.vn" target="_self">Cinestar.com.vn</a>. All rights reserved.</div>
                    </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</body>
</html>
