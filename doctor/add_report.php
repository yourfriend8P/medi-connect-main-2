<?php
session_start();

if (!isset($_SESSION['doctor_username'])) {
    header("Location: doctor.php");
    exit();
}

// Connect to the database
include('C:\xampp\htdocs\hms\db_connect.php');

// Retrieve form data
$appointment_id = $_POST['appointment_id'];
$report = $_POST['report'];

$sql = "UPDATE appointments SET report = '$report' WHERE id = $appointment_id";

if ($conn->query($sql) === TRUE) {
    header("Location: doctor_dashboard.php"); // Redirect back to the doctor dashboard
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
