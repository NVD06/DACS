<?php
include "connectToDatabase.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idPhim2 = $_POST['idPhim2'];
    $thoiGian = $_POST['thoiGian'];
    $date_time = $_POST['date_time'];
    $showtime_id = $_POST['showtime_id'];

    // Check if the showtime_id already exists in tblshowtime
    $checkSql = "SELECT COUNT(*) as count FROM tblshowtime WHERE showtime_id='$showtime_id'";
    $result = $conn->query($checkSql);
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        echo "Error: showtime ID already exists.";
    } else {
        $sql = "INSERT INTO tblshowtime (movie_id, showtime_id, date_time)
                VALUES ('$idPhim2', '$showtime_id', '$date_time $thoiGian')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
