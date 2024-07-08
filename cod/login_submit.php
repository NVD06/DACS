<?php

include "connectToDatabase.php"; // Đảm bảo rằng file connectToDatabase.php chứa kết nối đến cơ sở dữ liệu

// Xử lý đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Bảo vệ dữ liệu nhập từ form
    $email = mysqli_real_escape_string($conn, $email);

    // Truy vấn kiểm tra thông tin người dùng
    $sql = "SELECT email, password, password_check, leveluser FROM tbluser WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare statement failed: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Lấy thông tin người dùng
        $row = $result->fetch_assoc();

        // Kiểm tra mật khẩu đã băm hoặc mật khẩu gốc
        if ($password===$row['password'] || $password === $row['password_check']) {
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
            // Mật khẩu không đúng
            echo "Đăng nhập thất bại. Vui lòng kiểm tra lại email và mật khẩu.";
        }
    } else {
        // Không tìm thấy người dùng với email này
        echo "Đăng nhập thất bại. Vui lòng kiểm tra lại email và mật khẩu.";
    }

    // Đóng kết nối
    $stmt->close();
}

$conn->close();
?>
