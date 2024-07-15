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

$date = $_GET['date'];
$time = $_GET['time'];

$sql = "SELECT seat_name, status FROM tblseat WHERE screen_id = 1"; //sửa 
$result = $conn->query($sql);

$seats = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $seats[] = $row;
    }
}

echo json_encode(['seats' => $seats]);

$conn->close();
?>
