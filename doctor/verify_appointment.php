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
$action = $_POST['action'];
$doctor_comment = $_POST['doctor_comment'];

if ($action == 'accept') {
    $status = 'Accepted';
} else if ($action == 'reject') {
    $status = 'Rejected';
}

// Prepare the SQL statement to prevent SQL injection
$stmt = $conn->prepare("UPDATE appointments SET status = ?, doctor_comment = ? WHERE id = ?");
$stmt->bind_param("ssi", $status, $doctor_comment, $appointment_id);

if ($stmt->execute() === TRUE) {
    header("Location: doctor_dashboard.php"); // Redirect back to the doctor dashboard
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
