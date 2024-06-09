<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
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
?>
