<?php
session_start();

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Kết nối cơ sở dữ liệu
require 'connectToDatabase.php';


// Truy vấn để lấy địa chỉ email từ bảng tbluser
$sql = "SELECT email FROM tbluser WHERE userName = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userName);
$stmt->execute();
$stmt->bind_result($userEmail); 
$stmt->fetch();
$stmt->close();


$mail = new PHPMailer(true);

try {
	$mail->SMTPDebug = 2;									
	$mail->isSMTP();											
	$mail->Host	 = 'smtp.gmail.com';					
	$mail->SMTPAuth = true;							
	$mail->Username = 'concoko35@gmail.com';				
	$mail->Password = 'password';						
	$mail->SMTPSecure = 'tls';							
	$mail->Port	 = 587;

	$mail->setFrom('from@gmail.com', 'Name');		
	$mail->addAddress($userEmail);
	
	
	$mail->isHTML(true);								
	$mail->Subject = 'Test Email';
	$mail->Body = 'HTML message body in <b>bold</b> ';
	$mail->AltBody = 'Body in plain text for non-HTML mail clients';
	$mail->send();
	echo "Mail has been sent successfully!";
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>
