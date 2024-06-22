<?php
include "connectToDatabase.php";

$idPhim = $_POST['idPhim'];
$tenPhim = $_POST['tenPhim'];
$image = $_POST['fileImage']; // URL of the image
$Mota = $_POST['Mota'];
$ngayChieu = $_POST['ngayChieu'];
$phongChieu = $_POST['phongChieu'];
$soVe = $_POST['soVe'];
$soVeDaBan = $_POST['soVeDaBan'];
$status = $_POST['status'];
$price = $_POST['price'];

// Check if the idPhim already exists
$checkSql = "SELECT COUNT(*) as count FROM tblmovie WHERE movie_id='$idPhim'";
$result = $conn->query($checkSql);
$row = $result->fetch_assoc();

if ($row['count'] > 0) {
    echo "Error: Movie ID already exists.";
} else {
    // Insert new record if idPhim does not exist
    $sql = "INSERT INTO tblmovie (movie_id, movie_name, image_movie, describe_movie,screen_id ,date, number_tickets, number_tickets_sold, status_movie, price)
            VALUES ('$idPhim', '$tenPhim', '$image', '$Mota','$phongChieu' ,'$ngayChieu', '$soVe', '$soVeDaBan', '$status', '$price')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
