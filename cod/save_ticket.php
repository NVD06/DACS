<?php
include "connectToDatabase.php";
$data = json_decode(file_get_contents('php://input'), true);

if ($data === null) {
    die(json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ']));
}

<<<<<<< HEAD
$seats = $data['seats'] ?? [];
if (empty($seats)) {
    die(json_encode(['success' => false, 'message' => 'Không có ghế nào được chọn']));
}
=======
// Kết nối tới cơ sở dữ liệu
include "connectToDatabase";
>>>>>>> 06cd1b6430c5ebdf8f49515c7daf71a57d69fb52

$food = json_encode($data['food']);
$total_price = floatval(str_replace(',', '', explode(' ', $data['total_price'])[0]));

$sql_movie = "SELECT movie_name, image_movie FROM tblmovie LIMIT 1";
$result_movie = $conn->query($sql_movie);
if ($result_movie === false || $result_movie->num_rows === 0) {
    die(json_encode(['success' => false, 'message' => 'Không tìm thấy thông tin phim hoặc lỗi truy vấn']));
}

$movie = $result_movie->fetch_assoc();
$movie_name = $movie['movie_name'];
$image_movie = $movie['image_movie'];

$date = $data['date'];
$time = $data['time'];

$conn->begin_transaction();

try {
    foreach ($seats as $seat) {
        $sql_ticket = $conn->prepare("INSERT INTO tblticket (movie, date, time, seat, food, total_price) 
                                      VALUES (?, ?, ?, ?, ?, ?)");
        if ($sql_ticket === false) {
            throw new Exception('Lỗi chuẩn bị câu truy vấn: ' . $conn->error);
        }

        $sql_ticket->bind_param("sssssd", $movie_name, $date, $time, $seat, $food, $total_price);
        if ($sql_ticket->execute() === false) {
            throw new Exception('Lỗi chèn dữ liệu vào bảng tblticket: ' . $sql_ticket->error);
        }

        $sql_seat = $conn->prepare("UPDATE tblseat SET status='unavailable' WHERE seat_name=?");
        if ($sql_seat === false) {
            throw new Exception('Lỗi chuẩn bị câu truy vấn cập nhật ghế: ' . $conn->error);
        }

        $sql_seat->bind_param("s", $seat);
        if ($sql_seat->execute() === false) {
            throw new Exception('Lỗi cập nhật trạng thái ghế: ' . $sql_seat->error);
        }
    }

    $conn->commit();
    echo json_encode(['success' => true, 'message' => 'Đặt vé thành công']);

} catch (Exception $e) {
    $conn->rollback();
    error_log($e->getMessage());
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conn->close();
?>