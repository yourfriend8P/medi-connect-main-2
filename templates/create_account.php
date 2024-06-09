<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Account - Hospital Management System</title>
    <link rel="stylesheet" type="text/css" href="/medi-connect-main-2/css/user/create_account_styles.css">
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
        <div class="image-section">
            <!-- This section can contain a background image or promotional content -->
        </div>
            <div class = horiz_line>
            </div>
        <div class="create-account-section">
            <div class="create-account-header">
                <img src="/medi-connect-main-2/main-logo.png" alt="MediConnect Logo" class="logo">
                <h1>MediConnect</h1>
                <h2>Hospital Management System</h2>
            </div>
            <div class="create-account-form">
                <h2>Create New Account</h2>
                <form action="register_user.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="username" placeholder="Username" class="input-box" required>
                    <input type="password" name="password" placeholder="Password" class="input-box" required>
                    <input type="email" name="email" placeholder="Email" class="input-box" required>
                    <input type="text" name="first_name" placeholder="First Name" class="input-box" required>
                    <input type="text" name="last_name" placeholder="Last Name" class="input-box" required>
                    <input type="date" name="date_of_birth" placeholder="Date of Birth" class="input-box" required>
                    <input type="text" name="address" placeholder="Address" class="input-box" required>
                    <input type="text" name="phone" placeholder="Phone" class="input-box" required>
                    <input type="text" name="blood_type" placeholder="Blood Type (e.g., O+, A+)" class="input-box" required>
                    <textarea name="medical_problem" placeholder="Medical Problems" class="input-box" rows="3"></textarea>
                    <label for="profile_picture" class="upload-label">Upload Profile Picture</label>
                    <input type="file" name="profile_picture" id="profile_picture" class="input-box">
                    <button type="submit" class="create-account-button">Create Account</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
