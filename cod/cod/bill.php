<?php
session_start();
if (!isset($_SESSION['booking_details'])) {
    die('No booking details found.');
}

if (!isset($_SESSION['userName'])) {
    die(json_encode(['success' => false, 'message' => 'Bạn phải đăng nhập để đặt vé']));
}

$bookingDetails = $_SESSION['booking_details'];

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn đặt vé</title>
    <link rel="stylesheet" href="bill.css">
</head>
<body>
    <div class="container">
        <h1>Hóa đơn đặt vé</h1>
        <p>Người đặt: <?php echo htmlspecialchars($_SESSION['userName']); ?></p>
        <p>Tên phim: <?= htmlspecialchars($bookingDetails['movie_name']) ?></p>
        <p>Ngày chiếu: <?= htmlspecialchars($bookingDetails['date']) ?></p>
        <p>Giờ chiếu: <?= htmlspecialchars($bookingDetails['time']) ?></p>
        <p>Ghế: <?= implode(', ', array_map('htmlspecialchars', $bookingDetails['seats'])) ?></p>
        <p>Thức ăn: 
            <ul>
                <?php foreach ($bookingDetails['food'] as $food => $quantity): ?>
                    <li><?= htmlspecialchars($food) ?>: <?= htmlspecialchars($quantity) ?></li>
                <?php endforeach; ?>
            </ul>
        </p>
        <p>Tổng giá: <?= htmlspecialchars($bookingDetails['total_price']) ?></p>
        <form action="sendEmail.php" method="post">
            <input type="hidden" name="booking_details" value="<?= htmlspecialchars(json_encode($bookingDetails)) ?>">
            <button type="submit">Thanh toán</button>
        </form>
    </div>
</body>
</html>
