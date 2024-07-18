<?php
session_start();
include "connectToDatabase.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Validate the user credentials
    // ...

    // Assuming credentials are valid
    $_SESSION['userName'] = $username;

    // Redirect to the intended page
    if (isset($_GET['redirect_url'])) {
        $redirect_url = $_GET['redirect_url'];
        header("Location: $redirect_url");
    } else {
        header("Location: index.php");
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel = "stylesheet" href = "login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper">
        <div class="form-signin"> 
            <form action="login_submit.php" method="post">
                <h1>
                    Login
                </h1>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" required id="email">
                    <i class='bx bx-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required id="password">
                    <i class='bx bx-lock'></i>
                </div>
                <button type="submit">Login</button>
                <div class="signUp-link">
                    <p>Không có tài khoản?<a href="signup.php" class="signUpbtn">Đăng ký</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
