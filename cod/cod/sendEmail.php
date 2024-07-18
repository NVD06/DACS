<?php
session_start();
if (!isset($_POST['booking_details'])) {
    die('No booking details provided.');
}

$bookingDetails = json_decode($_POST['booking_details'], true);
if ($bookingDetails === null) {
    die('Invalid booking details.');
}

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Kết nối cơ sở dữ liệu
require 'connectToDatabase.php';

// Lấy tên người dùng từ session
$userName = $_SESSION['userName'];

// Truy vấn để lấy địa chỉ email từ bảng tbluser
$sql = "SELECT email FROM tbluser WHERE userName = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userName);
$stmt->execute();
$stmt->bind_result($userEmail);
$stmt->fetch();
$stmt->close();

if (!$userEmail) {
    die('Không tìm thấy địa chỉ email cho người dùng này.');
}

$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'nguyenvu00304@gmail.com'; // Replace with your email address
$mail->Password = 'ojss bihy qyrb wlrf'; // Replace with your email password
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('nguyenvu00304@gmail.com', 'RAP CHiEU PHIM');
$mail->addAddress($userEmail); // Sử dụng địa chỉ email từ tbluser

$mail->isHTML(true);
$mail->Subject = 'BIll';
$mail->Body    = '
    <h1>Hóa đơn đặt vé</h1>
    <p>Người đặt: ' . htmlspecialchars($_SESSION['userName']) . '</p>
    <p>Tên phim: ' . htmlspecialchars($bookingDetails['movie_name']) . '</p>
    <p>Ngày chiếu: ' . htmlspecialchars($bookingDetails['date']) . '</p>
    <p>Giờ chiếu: ' . htmlspecialchars($bookingDetails['time']) . '</p>
    <p>Ghế: ' . implode(', ', array_map('htmlspecialchars', $bookingDetails['seats'])) . '</p>
    <p>Thức ăn: 
        <ul>';
foreach ($bookingDetails['food'] as $food => $quantity) {
    $mail->Body .= '<li>' . htmlspecialchars($food) . ': ' . htmlspecialchars($quantity) . '</li>';
}
$mail->Body .= '</ul></p>
    <p>Tổng giá: ' . htmlspecialchars($bookingDetails['total_price']) . '000 VNĐ</p>
    <p>Mã đặt vé: ' . uniqid() . '</p>'; // Add a unique booking code

if(!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo '<script type="text/javascript">
        alert("Email đã được gửi thành công!");
        window.location.href = "index.php";
      </script>';
}

$conn->close(); // Đóng kết nối cơ sở dữ liệu
?>
