<?php
include "connectToDatabase.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    // Check if form data is being received
    if (empty($email) || empty($name) || empty($password) || empty($repassword)) {
        die("Please fill in all fields.");
    }

    // Check if password and repassword match
    if ($password !== $repassword) {
        die("Passwords do not match.");
    }

    // Check if email already exists
    $sql = "SELECT email FROM tbluser WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare statement failed: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        die("Email already exists.");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert user into database
    $sql = "INSERT INTO tbluser (email, userName, password, password_check, leveluser) VALUES (?, ?, ?, ?, 0)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare statement failed: " . $conn->error);
    }
    $stmt->bind_param("ssss", $email, $name, $hashed_password, $password);

    if ($stmt->execute()) {
        echo "Registration successful!";
        // Redirect to login page or another page
        header("Location: login.php");
        exit;
    } else {
        die("Error: " . $stmt->error);
    }

    $stmt->close();  // Close the statement
}

$conn->close();
?>
