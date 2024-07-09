<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dacs";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]));
}

$data = json_decode(file_get_contents('php://input'), true);

$phim = $data['phim'];
$ngayChieu = $data['ngayChieu'];
$gioChieu = $data['gioChieu'];
$ghe = $data['ghe'];
$doAn = json_encode($data['doAn']);
$tongTien = $data['tongTien'];

$sql = "INSERT INTO tblbooking (date, time, seat, food, total_price) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("issssi", $ngayChieu, $gioChieu, $ghe, $doAn, $tongTien);

$response = [];
if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['error'] = $stmt->error;
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>