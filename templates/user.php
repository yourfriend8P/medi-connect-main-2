<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Login - Hospital Management System</title>
    <link rel="stylesheet" type="text/css" href="/medi-connect-main-2/css/user/user_styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="animation.css"> 
    <style>
        body{
            animation: transitionIn-Y-over 0.5s;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="header-container">
                <img src="/medi-connect-main-2/main-logo.png" alt="MediConnect Logo" class="logo-header">
                <div class="header-text">
                    <h1 class="mediconnect-title">MediConnect | </h1>
                    <p class="subtitle">&nbsp Hospital Management System</p>
                </div>
                <div class="empty-header"></div>
                <div class = "header_button">
                    <a href="/medi-connect-main-2/index.php" class="header_button">Home</a>
                    <a href="/medi-connect-main-2/templates/create_account.php" class="header_button">Register</a>
                </div>
                
            </div>
    </header>
        <div class ="content">
            <div class = "group1">
            <div class="image-section">
             <img src="/medi-connect-main-2/doc-paitient.png"></img>

                <!-- This section can contain a background image or promotional content -->
            </div>
             <div class = horiz_line>
            
            </div>
        <div class="login-section">
            <div class="login-header">
                <img src="/medi-connect-main-2/main-logo.png" alt="MediConnect Logo" class="logo">
                <h1>MediConnect</h1>
                <h2>Hospital Management System</h2>
            </div>
            <div class="login-form">
                <div class = "login-title">Login with your details to continue</div>

                <?php
                session_start();
                if (isset($_SESSION['error'])) {
                    echo "<div class='error-message'>" . $_SESSION['error'] . "</div>";
                    unset($_SESSION['error']); // Unset the error after displaying it
                }
                ?>
                
                <form action="login_user.php" method="post">
                    <div class = "login-element">Username</div>
                    <input type="text" name="username" placeholder="Username" class="input-box" required>
                    <div class = "login-element">Password<br>
                    <input type="password" name="password" placeholder="Password" class="input-box" required><br>
                    <a href="#" class="forgot-password">Forgot Password?</a>
                    </div>
                    <button type="submit" class="login-button">Login</button>
                </form>
                <div class = "end-text">Don't have an account? 
                <a href="/medi-connect-main-2/templates/create_account.php" class="create-account-button">Sign Up</a><br>
                </div> 

            </div>
        </div>
        </div>
    </div>
</body>
</html>