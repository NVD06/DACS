<?php

include "connectToDatabase.php"; // Đảm bảo rằng file connectToDatabase.php chứa kết nối đến cơ sở dữ liệu

// Xử lý đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Bảo vệ dữ liệu nhập từ form
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Mã hóa mật khẩu trước khi so sánh với cơ sở dữ liệu
      // Mã hóa mật khẩu
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
 

    // Truy vấn kiểm tra thông tin người dùng
    $sql = "SELECT email, password, leveluser FROM tbluser WHERE email = '$email'";

    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Đăng nhập thành công
        $row = $result->fetch_assoc();
        if ($row['leveluser'] == 1) {
            // Người dùng là admin
            header('Location: admin.php');
            exit; // Đảm bảo kết thúc kịch bản sau khi chuyển hướng
        } else if ($row['leveluser'] == 0) {
            // Người dùng là user
            header('Location: index.php');
            exit; // Đảm bảo kết thúc kịch bản sau khi chuyển hướng
        } else {
            // Trường hợp level không hợp lệ
            echo "Level không hợp lệ";
        }
    } else {
        // Đăng nhập thất bại
        echo "Đăng nhập thất bại. Vui lòng kiểm tra lại email và mật khẩu.";
        
    }
}

// Đóng kết nối
$conn->close();
?>
