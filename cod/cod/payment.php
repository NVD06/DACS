<?php
session_start();

// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Xử lý thanh toán
$error_message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $card = $_POST['card'];
    $exp = $_POST['exp'];
    $cvv = $_POST['cvv'];

    // Lưu thông tin thanh toán vào cơ sở dữ liệu (ví dụ)
    $stmt = $conn->prepare("INSERT INTO payments (name, email, phone, card, exp, cvv) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $phone, $card, $exp, $cvv);

    if ($stmt->execute()) {
        echo "Thanh toán thành công!";
    } else {
        $error_message = "Đã xảy ra lỗi trong quá trình thanh toán. Vui lòng thử lại.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán - Đặt Vé Xem Phim</title>
    <link rel="stylesheet" href="../css/">
</head>
<body>
    <header>
        <div class="container">
            <h1>Thanh Toán</h1>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="payment-section">
                <h2>Thông Tin Phim</h2>
                <div class="movie-info">
                    <img src="https://cinestar.com.vn/pictures/movies/f4aa652b-c2cd-4247-9ad8-2d4bb3d0143b.jpg" alt="Movie Poster">
                    <div class="movie-details">
                        <h3>Tên Phim: Mẫu Tên Phim</h3>
                        <p>Thể Loại: Hành Động, Phiêu Lưu</p>
                        <p>Thời Gian: 120 phút</p>
                        <p>Suất Chiếu: 19:00, 26/06/2024</p>
                        <p>Rạp: Cinestar Quốc Thanh</p>
                    </div>
                </div>
            </div>
            <div class="payment-section">
                <h2>Thông Tin Thanh Toán</h2>
                <form action="payment.php" method="post">
                    <?php
                    if (!empty($error_message)) {
                        echo '<p style="color:red;">' . $error_message . '</p>';
                    }
                    ?>
                    <div class="form-group">
                        <label for="name">Họ và Tên:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số Điện Thoại:</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="card">Số Thẻ:</label>
                        <input type="text" id="card" name="card" required>
                    </div>
                    <div class="form-group">
                        <label for="exp">Ngày Hết Hạn:</label>
                        <input type="text" id="exp" name="exp" required>
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV:</label>
                        <input type="text" id="cvv" name="cvv" required>
                    </div>
                    <button type="submit">Thanh Toán</button>
                </form>
            </div>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 Trang Đặt Vé Xem Phim. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
