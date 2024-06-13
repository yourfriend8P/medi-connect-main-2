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

// Fetch current status of the doctor
$sql = "SELECT status FROM doctors WHERE id = $doctorId";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Toggle the status
$new_status = $row['status'] ? 0 : 1;
$sql = "UPDATE doctors SET status = $new_status WHERE id = $doctorId";

if ($conn->query($sql) === TRUE) {
    header("Location: admin_dashboard.php"); // Redirect back to the admin dashboard
    exit();
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
