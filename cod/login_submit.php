<?php
include 'connectToDatabase.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT leveluser, password,userName FROM tbluser WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($level, $hashed_password, $username);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
        session_start();
        $_SESSION['leveluser'] = $level;
        $_SESSION['userName'] = $username;
        if($level == 1){
            header("Location: admin.php");
        }else if($level == 0){
            header("Location: index.php");
        }
    } else {
        echo "<script>alert('invalid email or password'); window.location.href='login.php';</script>";
        }

    $stmt->close();
    $conn->close();
}
?>
