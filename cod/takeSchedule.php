<?php
include 'connectToDatabase.php';

if (isset($_GET['movie_name'])) {
    $movie_name = $_GET['movie_name'];

    // Bảo vệ dữ liệu nhập từ URL
    $movie_name = mysqli_real_escape_string($conn, $movie_name);

    // Lấy movie_id từ tbluser dựa trên movie_name
    $stmt = $conn->prepare("SELECT movie_id, image_movie FROM tblmovie WHERE movie_name = ?");
    $stmt->bind_param("s", $movie_name);
    $stmt->execute();
    $stmt->bind_result($movie_id, $image_movie);
    $stmt->fetch();
    $stmt->close();

    // Kiểm tra nếu movie_id tồn tại
    if ($movie_id) {
        // Lấy dữ liệu từ tblshowtime dựa trên movie_id
        $stmt = $conn->prepare("SELECT thoiGian, date FROM tblshowtime WHERE movie_id = ?");
        $stmt->bind_param("i", $movie_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $showtimes = [];
        while ($row = $result->fetch_assoc()) {
            $date = $row['date'];
            $thoiGian = $row['thoiGian'];
            if (!isset($showtimes[$date])) {
                $showtimes[$date] = [];
            }
            $showtimes[$date][] = $thoiGian;
        }
        $stmt->close();
    } else {
        echo "Movie not found.";
        exit;
    }

    $conn->close();
}
?>