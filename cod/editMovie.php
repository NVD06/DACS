<?php
include "connectToDatabase.php";

// Kiểm tra nếu có dữ liệu được gửi từ form POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form POST
    $idPhim = $_POST['idPhim'];
    $tenPhim = $_POST['tenPhim'];
    $fileImage = $_POST['fileImage'];
    $Mota = $_POST['Mota'];
    $ngayChieu = $_POST['ngayChieu'];
    $phongChieu = $_POST['phongChieu'];
    $soVe = $_POST['soVe'];
    $soVeDaBan = $_POST['soVeDaBan'];
    $status = $_POST['status'];
    $price = $_POST['price'];

    // Validate input
    if (empty($idPhim)) {
        echo "Error: Movie's id is required.";
        exit;
    }

    // Kiểm tra sự tồn tại của idPhim trong CSDL
    $checkSql = "SELECT COUNT(*) as count FROM tblmovie WHERE movie_id=?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("s", $idPhim);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count == 0) {
        echo "Error: Movie id does not exist. idPhim: " . $idPhim;
    } else {
        // Update thông tin phim trong CSDL
        $updateSql = "UPDATE tblmovie SET movie_name=?, image_movie=?, describe_movie=?, date=?, screen_id=?, number_tickets=?, number_tickets_sold=?, status_movie=?, price=? WHERE movie_id=?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("ssssiiisds", $tenPhim, $fileImage, $Mota, $ngayChieu, $phongChieu, $soVe, $soVeDaBan, $status, $price, $idPhim);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "Movie updated successfully";
            } else {
                echo "Error: Failed to update the movie.";
            }
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>
