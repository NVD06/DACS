<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);

    $stmt->execute();

    $stmt->bind_result($id, $db_username, $hashed_password, $role);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $db_username;
        $_SESSION['role'] = $role;

        if ($role == 'admin') {
            header("Location: admin_dashboard.php"); 
        } else {
            header("Location: user_dashboard.php"); 
        }
        exit();
    } else {
        echo "Email hoặc mật khẩu không đúng.";
    }

    $stmt->close();
}

$conn->close();
?>
