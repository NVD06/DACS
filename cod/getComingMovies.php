<?php
include "connectToDatabase.php";

$sql = "SELECT * FROM tblmovie WHERE status_movie='coming'";
$result = $conn->query($sql);

$movies = array();
while ($row = $result->fetch_assoc()) {
    $movies[] = $row;
}

echo json_encode($movies);
$conn->close();
?>
