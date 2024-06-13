<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit();
}


// Connect to the database
include('C:\xampp\htdocs\medi-connect-main-2\db_connect.php');

// Retrieve form data
$doctorUsername = $_POST['username'];
$doctorPassword = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
$name = $_POST['name'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$specialty = $_POST['specialty'];

$sql = "INSERT INTO doctors (username, password, name, gender, email, phone, specialty)
        VALUES ('$doctorUsername', '$doctorPassword', '$name', '$gender', '$email', '$phone', '$specialty')";

if ($conn->query($sql) === TRUE) {
    header("Location: admin_dashboard.php"); // Redirect to admin dashboard
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();