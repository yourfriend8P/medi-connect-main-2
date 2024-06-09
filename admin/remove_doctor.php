<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit();
}

// Connect to the database
include('C:\xampp\htdocs\medi-connect-main-2\db_connect.php');

// Retrieve the doctor ID from the form
$doctorId = $_POST['doctor_id'];

// Delete the doctor from the database
$sql = "DELETE FROM doctors WHERE id = $doctorId";

if ($conn->query($sql) === TRUE) {
    header("Location: admin_dashboard.php"); // Redirect back to the admin dashboard
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
