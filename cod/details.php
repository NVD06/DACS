<?php
include "connectToDatabase.php";

if (isset($_GET['movie_name'])) {
    $movie_name = $_GET['movie_name'];
    $sql = "SELECT * FROM tblmovie WHERE movie_name = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Lỗi khi chuẩn bị câu lệnh SQL: " . $conn->error);
    }
    $stmt->bind_param("s", $movie_name);
    $stmt->execute();
    $result = $stmt->get_result();  

    if ($result->num_rows > 0) {
        $movie = $result->fetch_assoc();
    } else {
        echo "No movie found";
        exit;
    }

    $stmt->close();
    $conn->close();
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
    <title>Chi Tiết Phim</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
</head>
<body background="" style="background-color: brown;">
    <div class="main_body">
        <div class="menu">
            <div class="chung">
                <div class="function">
                    <div class="viTri">
                        <a href=""><img src="https://cinestar.com.vn/_next/image/?url=%2Fassets%2Fimages%2Fheader-logo.png&w=1920&q=75" alt="Home page logo"></a>
                        <div class="bookAndpd">
                            <a href="" class="Booking_T">ĐẶT VÉ NGAY</a>
                            <a href="" class="Booking_F">ĐẶT BẮP NƯỚC</a>
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
                            <div class="Login">
                                <a href="logout.php">Đăng xuất</a>
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
                            <a href=""><i class="fas fa-calendar"></i> Lịch chiếu</a>
                            <a href="">Khuyến mãi</a>
                            <a href="">Thuê sự kiện</a>
                            <a href="">Giải trí</a>
                            <a href="">Giới thiệu</a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>  
        <div class="Page_Content">
            <div class="chiTietPhim">
                <img src="<?php echo $movie['image_movie']; ?>" id="chiTietImg" alt="">
                <div class="MoTa">
                    <h1 id="chiTietTenPhim"><?php echo $movie['movie_name']; ?></h1>
                    <div class="khoangCach">
                        <div class="phanMot"><p>Khởi chiếu:</p></div>
                        <div class="phan2" id="chiTietNgayKhoiChieu"><p><?php echo $movie['date']; ?></p></div>
                    </div>
                    <div class="khoangCach">
                        <div class="phanMot"><p>Đạo diễn:</p></div>
                        <div class="phan2" id="chiTietDaoDien"><p><?php echo $movie['daoDien']; ?></p></div>
                    </div>
                    <p id="chiTietMoTa" style="color: white; margin-top: 30px;"><?php echo $movie['describe_movie']; ?></p>
                    <div class="LienKet">
                        <a href=""><h2>TRAILER</h2></a>
                        <a href="lichChieu.php?movie_name=<?php echo $movie['movie_name']; ?>"><h2>Đặt vé</h2></a>
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
                                   
