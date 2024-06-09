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

// Retrieve form data
$doctorUsername = $_POST['username'];
$doctorPassword = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
$name = $_POST['name'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$specialty = $_POST['specialty'];

// Handle file upload
$profile_picture = "";
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
        $profile_picture = $target_file;
    } else {
        echo "Error uploading profile picture.";
    }
}

$sql = "INSERT INTO doctors (username, password, name, gender, email, phone, specialty, profile_picture)
        VALUES ('$doctorUsername', '$doctorPassword', '$name', '$gender', '$email', '$phone', '$specialty', '$profile_picture')";

if ($conn->query($sql) === TRUE) {
    header("Location: admin_dashboard.php"); // Redirect to admin dashboard
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
