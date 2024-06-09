<?php
session_start();

$adminUsername = "Admin";
$adminPassword = "mediconnect123";

$username = $_POST['username'];
$password = $_POST['password'];

if ($username === $adminUsername && $password === $adminPassword) {
    $_SESSION['admin'] = $username;
    header("Location: admin_dashboard.php");
    exit();
} else {
    echo "Invalid username or password.";
}
?>
