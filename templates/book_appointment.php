<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: user.php");
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
$user = $_SESSION['username'];
$doctor_id = $_POST['doctor_id'];
$date = $_POST['date'];
$day_of_week = $_POST['day_of_week'];
$problem = $_POST['problem'];

$sql = "INSERT INTO appointments (user_username, doctor_id, date, day_of_week, problem)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sisss", $user, $doctor_id, $date, $day_of_week, $problem);

if ($stmt->execute() === TRUE) {
    header("Location: user_dashboard.php"); // Redirect back to the user dashboard
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
