<?php

    if( isset( $_POST["btn"] ) ){
        $noidung = $_POST["noidung"];
    }else{
        echo $noidung = false;
    }
?>

<?php
    include "index.php";

    $sql = " SELECT * from tblmovie WHERE movie_name LIKE '%$noidung%' ";

    $result = mysqli_query( $conn, $sql );
     
    while( $row = mysqli_fetch_assoc( $result ) ){
        echo $row['movie_name'];
    }
?>