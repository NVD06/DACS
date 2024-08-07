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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="events.css">
    <title>Sự kiện</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
</head>
<body background="">
    <div class="main_body">
        <div class="menu">
            <div class="chung">
                <div class="function">
                    <div class="viTri">
                        <a href="index.php"><img src="https://cinestar.com.vn/_next/image/?url=%2Fassets%2Fimages%2Fheader-logo.png&w=1920&q=75" alt="Home page logo"></a>
                        <div class="bookAndpd">
                            <a href="datve.php" class="Booking_T">ĐẶT VÉ NGAY</a>
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
                        <div class="first">
                            <a href="lichChieu.php"><i class="fas fa-calendar"></i> Lịch chiếu</a>
                            <a href="khuyenmai.php">Khuyến mãi</a>
                            <a href="events.php">Thuê sự kiện</a>
                            <a href="giaitri.php">Giải trí</a>
                            <a href="about.php">Giới thiệu</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <div class="Page_Content">
        <div class="promotion-movie-wr">
                                <div class="promotion-movie-list row pb-80">
                                    <div class="promotion-it col" data-aos="fade-up">
                                        <div class="promotion-content">
                                            <div class="head">
                                                <h4 class="sub-tittle">Marathon Siêu anh hùng</h4>
                                                <p class="desc">Tham gia vào một đại tiệc phim với loạt phim siêu anh hùng. Hóa trang thành siêu anh hùng yêu thích và nhận được những ưu đãi đặc biệt!</p>
                                            </div>
                                            <div class="inner">
                                                <p class="tt">Chi tiết</p>
                                                <ul class="list object">
                                                    <li>Địa điểm: Rạp Cinestar</li>
                                                    <li>Ngày: 25 Tháng 6, 2024</li>
                                                    <li>Thời gian: Từ 10:00 sáng</li>
                                                </ul>
                                            </div>
                                            <div class="inner">
                                                <p class="tt">Lưu ý</p>
                                                <ul class="list note">
                                                    <li>Ưu đãi đặc biệt dành cho khách đến sớm.</li>
                                                    <li>Yêu cầu hóa trang nhưng không bắt buộc.</li>
                                                </ul>
                                            </div>
                                            <a href="/datve" title="Đăng ký ngay" class="btn btn--pri">Đăng ký ngay</a>
                                        </div>
                                    </div>
                                    <div class="promotion-it col" data-aos="fade-up">
                                        <div class="promotion-image">
                                            <img src="https://example.com/images/marathon-sieu-anh-hung.jpg" alt="Marathon Siêu anh hùng">
                                        </div>
                                    </div>
                                </div>
                                <div class="promotion-movie-list row pb-80">
                                    <div class="promotion-it col" data-aos="fade-up">
                                        <div class="promotion-content">
                                            <div class="head">
                                                <h4 class="sub-tittle">Mùa hè Đại nhạc kịch</h4>
                                                <p class="desc">Trải nghiệm sự hồi hộp của các bộ phim bom tấn mới nhất tại Cinestar. Giá đặc biệt áp dụng!</p>
                                            </div>
                                            <div class="inner">
                                                <p class="tt">Chi tiết</p>
                                                <ul class="list object">
                                                    <li>Địa điểm: Rạp Cinestar</li>
                                                    <li>Thời gian: Từ 15 Tháng 7 đến 31 Tháng 7, 2024</li>
                                                    <li>Thời gian: Cả ngày</li>
                                                </ul>
                                            </div>
                                            <div class="inner">
                                                <p class="tt">Lưu ý</p>
                                                <ul class="list note">
                                                    <li>Giảm giá cho tất cả các vé phim trong thời gian khuyến mãi.</li>
                                                    <li>Có hiệu lực cho cả mua trực tuyến và tại rạp.</li>
                                                </ul>
                                            </div>
                                            <a href="/datve" title="Đặt vé" class="btn btn--pri">Đặt vé</a>
                                        </div>
                                    </div>
                                    <div class="promotion-it col" data-aos="fade-up">
                                        <div class="promotion-image">
                                            <img src="https://example.com/images/mua-he-dai-nhac-kich.jpg" alt="Mùa hè Đại nhạc kịch">
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                            <div class="footer-list row" style="margin-left:16%;">
                                <div class="footer-item col col-4">
                                    <a href="/" class="ft-logo" aria-label="The logo of Cinestar">
                                        <img src="https://cinestar.com.vn/_next/image/?url=%2Fassets%2Fimages%2Fheader-logo.png&w=1920&q=75" alt="">
                                    </a>
                                    <div class="ft-text">
                                        <p class="txt-deskop">BE HAPPY, BE A STAR</p>
                                    </div>
                                    <div class="ft-group-btn">
                                        <a class="btn btn--pri" href="/movie">
                                            <span class="btn__text">ĐẶT VÉ</span>
                                        </a>
                                        <a class="btn btn--border" href="#">
                                            <span class="btn__text">ĐẶT BẮP NƯỚC</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="footer-item col col-4">
                                    <p class="footer-title">TÀI KHOẢN</p>
                                    <ul class="footer-list-item">
                                        <li class="footer-list-item"><a href="#">Đăng nhập</a></li>
                                        <li class="footer-list-item"><a href="#">Đăng ký</a></li>
                                        <li class="footer-list-item"><a href="#">Membership</a></li>
                                    </ul>
                                </div>
                                <div class="footer-item col col-4">
                                    <p class="footer-title">XEM PHIM</p>
                                    <ul class="footer-list-item">
                                        <li class="footer-list-item"><a href="#">Phim đang chiếu</a></li>
                                        <li class="footer-list-item"><a href="#">Phim sắp chiếu</a></li>
                                        <li class="footer-list-item"><a href="#">Suất chiếu đặc biệt</a></li>
                                    </ul>
                                </div>
                                <div class="footer-item col col-4">
                                    <p class="footer-title">THUÊ SỰ KIỆN</p>
                                    <ul class="footer-list-item">
                                        <li class="footer-list-item"><a href="#">Thuê rạp</a></li>
                                        <li class="footer-list-item"><a href="#">Các loại hình cho thuê khác</a></li>
                                    </ul>
                                </div>
                                <div class="footer-item col col-4">
                                    <p class="footer-title">DỊCH VỤ KHÁC</p>
                                    <ul class="footer-list-item">
                                        <li class="footer-list-item"><a href="#">Nhà hàng</a></li>
                                        <li class="footer-list-item"><a href="#">Kidzone</a></li>
                                        <li class="footer-list-item"><a href="#">Bowling</a></li>
                                        <li class="footer-list-item"><a href="#">Billiards</a></li>
                                        <li class="footer-list-item"><a href="#">Gym</a></li>
                                        <li class="footer-list-item"><a href="#">Nhà hát Opera</a></li>
                                        <li class="footer-list-item"><a href="#">Coffee</a></li>
                                    </ul>
                                </div>
                                <div class="footer-item col col-4">
                                    <p class="footer-title">HỆ THỐNG RẠP</p>
                                    <ul class="footer-list-item">
                                        <li class="footer-list-item"><a href="#">Cinerstar Hà Nội </a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="footer-bottom">
                                <div class="footer-social">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-youtube"></i></a>
                                    <a href="#"><i class="fab fa-tiktok"></i></a>
                                    <a href="#"><i class="fab fa-zalo"></i></a>
                                </div>
                                <div class="footer-language">
                                    <span>Ngôn ngữ:</span>
                                    <a href="#" class="language-active"><img src="images/flag-vn.png" alt="VN"></a>
                                </div>
                            </div>
                            <div class="footer-copyright">
                                &copy; 2023 Cinestar. All rights reserved.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
 