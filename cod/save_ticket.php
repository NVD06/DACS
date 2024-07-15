<?php
session_start();
if (!isset($_SESSION['userName'])) {
    header("Location: login.php");
    exit();
}

// Kết nối tới cơ sở dữ liệu
include "connectToDatabase";

$userName = $_SESSION['userName'];
$sql = "SELECT * FROM tblticket WHERE userName = '$userName'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vé đã đặt</title>
    <link rel="stylesheet" href="viewticket.css">
</head>
<body>
    <div class="main_body">
        <h1>Vé đã đặt của bạn</h1>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Tên phim</th>
                <th>Ngày</th>
                <th>Giờ</th>
                <th>Ghế</th>
                <th>Thức ăn</th>
                <th>Tổng giá</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['movie']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['time']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['seat']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['food']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['total_price']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Bạn chưa đặt vé nào.</td></tr>";
            }
            $conn->close();
            ?>
        </table>
        <a href="index.php">Quay lại trang chủ</a>
    </div>
</body>
</html>