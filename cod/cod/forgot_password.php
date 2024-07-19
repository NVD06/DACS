<?php
session_start();

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Kết nối cơ sở dữ liệu
require 'connectToDatabase.php';


// Truy vấn để lấy địa chỉ email từ bảng tbluser
$sql = "SELECT email FROM tbluser WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($email);
$stmt->fetch();
$stmt->close();

if (empty($email)) {
    echo "User email not found.";
    exit;
}


try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'concoko35@gmail.com';
    $mail->Password = 'your_email_password'; // Lưu ý: Không nên lưu mật khẩu trực tiếp trong mã nguồn
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    //Recipients
    $mail->setFrom('concoko35@gmail.com', 'Your Name');
    $mail->addAddress($userEmail);

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Test Email';
    $mail->Body    = 'HTML message body in <b>bold</b>';
    $mail->AltBody = 'Body in plain text for non-HTML mail clients';

    $mail->send();
    echo "Mail has been sent successfully!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
