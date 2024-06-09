<?php
session_start();

// Connect to MySQL database
include('C:\xampp\htdocs\medi-connect-main-2\db_connect.php');

// Get login details from form
$user = $_POST['username'];
$pass = $_POST['password'];

// Find doctor in the database
$sql = "SELECT password FROM doctors WHERE username = '$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($pass, $row['password'])) {
        // Valid login
        $_SESSION['doctor_username'] = $user;
        header("Location: doctor_dashboard.php"); // Redirect to doctor dashboard
        exit();
    } else {
        echo "Invalid username or password.";
    }
} else {
    echo "Invalid username or password.";
}

$conn->close();
