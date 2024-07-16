<?php
session_start();
include "connectToDatabase.php";

function isLoggedIn() {
    return isset($_SESSION['userName']);
}

function searchMovies($query) {
    global $conn; // Assuming you have a global $conn variable for the DB connection

    $stmt = $conn->prepare("SELECT * FROM tblmovie WHERE movie_name LIKE ?");
    $searchTerm = "%" . $query . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    $movies = [];
    while ($row = $result->fetch_assoc()) {
        $movies[] = $row;
    }

    return $movies;
}

$movies = [];
if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $movies = searchMovies($query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="searchMovies.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <title>Search Results</title>
</head>
<body>
<div class="main_body">
    <div class="menu">
        <div class="chung">
            <div class="function">  
                <div class="viTri">
                    <a href=""><img src="https://cinestar.com.vn/_next/image/?url=%2Fassets%2Fimages%2Fheader-logo.png&w=1920&q=75" alt="Home page logo"></a>
                    <div class="bookAndpd">
                        <a href="datve.php" class="Booking_T">ĐẶT VÉ NGAY</a>
                        <a href="bapnuoc.php" class="Booking_F">ĐẶT BẮP NƯỚC</a>
                    </div>
                    <div class="searchAndLogin">
                        <div class="search-container">
                            <form action="searchMovies.php" method="GET">
                                <input type="text" name="query" placeholder="Tìm kiếm">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.415l-3.85-3.85a1.007 1.007 0 0 0-.115-.098zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <div>
                            <?php if (isLoggedIn()): ?>
                                <div class="dropdown" style="display:flex;">
                                    <p style="color:aqua; cursor:pointer;"><?php echo htmlspecialchars($_SESSION['userName']); ?></p>
                                    <div class="dropdown-content">
                                        <a href="profile.php">Thông tin cá nhân</a>
                                        <a href="settings.php">Lịch sử thanh toán</a>
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
                        <a href="">Giới thiệu</a>
                        <a href="viewTicket.php">Vé đã đặt</a> 
                        <a href="gioithieu.php">Giới thiệu</a>
                    </div>
                </div>
            </div>
        </div>
    </div>  

    <div class="Page_Content">
        <h2 style="color:white;text-align: center;">Kết quả tìm kiếm "<?php echo htmlspecialchars($query); ?>"</h2>
        <div class="search_results">
            <?php if (!empty($movies)): ?>
                <?php foreach ($movies as $movie): ?>
                    <div class="movie">
                        <img src="<?php echo htmlspecialchars($movie['image_movie']); ?>" alt="<?php echo htmlspecialchars($movie['movie_name']); ?>">
                        <div style="padding-left:20px;">
                        <h3><?php echo htmlspecialchars($movie['movie_name']); ?></h3>
                        <p><?php echo htmlspecialchars($movie['thoiLuong']); ?></p>
                        <p><?php echo htmlspecialchars($movie['daoDien']); ?></p>
                        <a href="details.php?movie_name=<?php echo urlencode($movie['movie_name']); ?>">Chi tiết</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="color:white;font-size:50px;">Không tìm thấy thông tin của phim</p>
            <?php endif; ?>
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
