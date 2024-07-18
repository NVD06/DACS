<?php
include "connectToDatabase.php";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);
$ticket_id = $data['ticket_id'];

// Lấy thông tin ghế từ bảng tblticket
$sql_seat = "SELECT seat FROM tblticket WHERE ticket_id='$ticket_id'";
$result_seat = $conn->query($sql_seat);

if ($result_seat->num_rows > 0) {
    $row_seat = $result_seat->fetch_assoc();
    $seat = $row_seat['seat'];
    
    // Xóa vé từ bảng tblticket
    $sql_delete_ticket = "DELETE FROM tblticket WHERE ticket_id='$ticket_id'";
    if ($conn->query($sql_delete_ticket) === TRUE) {
        // Cập nhật trạng thái ghế về available
        $sql_update_seat = "UPDATE tblseat SET status='available' WHERE seat_name='$seat'";
        if ($conn->query($sql_update_seat) === TRUE) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Lỗi cập nhật trạng thái ghế: ' . $conn->error]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Lỗi xóa vé: ' . $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Không tìm thấy vé với ID: ' . $ticket_id]);
}

$conn->close();
?>