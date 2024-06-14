<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Login - Hospital Management System</title>
    <link rel="stylesheet" type="text/css" href="/medi-connect-main-2/css/doctor/doctor_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
           
    <div class="container">
         <header>
            <div class="header-container">
                <img src="/medi-connect-main-2/main-logo.png" alt="MediConnect Logo" class="header-logo">
                <div class="header-text">
                    <h1 class="mediconnect-title">MediConnect | </h1>
                    <p class="subtitle">&nbsp Hospital Management System</p>
                </div>
                <div class="empty-header"></div>
                <div class = "header_button">
                    <a href="/medi-connect-main-2/index.php" class="header_button">Home</a>
                
            </div>
            </header>
        <div class = "container-2">
            
        <div class="login-section">
            <div class="login-header">
                <img src="/medi-connect-main-2/main-logo.png" alt="MediConnect Logo" class="logo">
                <h1>MediConnect</h1>
                <h2>Doctor Panel</h2>
            </div>
            <div class="login-form">
                <h2>Doctor Login</h2>
                <form action="doctor_login_handler.php" method="post">
                    <input type="text" name="username" placeholder="Username" class="input-box" required>
                    <input type="password" name="password" placeholder="Password" class="input-box" required>
                    <button type="submit" class="login-button">Login</button>
                </form>
            </div>
        </div>
        </div>
    </div>
</body>
</html>
