<?php
session_start();

if (!isset($_SESSION['doctor_username'])) {
    header("Location: doctor.php");
    exit();
}

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
?>
