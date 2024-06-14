<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="/medi-connect-main-2/css/admin/admin_styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="login-section">
            <div class="login-header">
                <img src="/medi-connect-main-2/main-logo.png" alt="MediConnect Logo" class="logo">
                <h1>MediConnect</h1>
                <h2>Hospital Management System</h2>
            </div>
            <div class="login-form">
                <div class="login-title">Admin Panel</div>

                <?php
                session_start();
                if (isset($_SESSION['error'])) {
                    echo "<div class='error-message'>" . $_SESSION['error'] . "</div>";
                    unset($_SESSION['error']); // Unset the error after displaying it
                }
                ?>

                <form action="admin_login.php" method="post">
                    <input type="text" name="username" placeholder="Username" class="input-box" required>
                    <input type="password" name="password" placeholder="Password" class="input-box" required>
                    <button type="submit" class="login-button">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
